<?php

namespace App\Http\Controllers;

use App\Imports\pasienImport;
use App\Models\Data;
use App\Models\Pasien;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Facades\Excel;
use PDF;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $pasien = DB::table('pasien')
        //     ->select('*')
        //     ->get();
        // return view('0192_show', ['pasien' => $pasien]);
        $pasien = Data::select('*');
        if (request()->has('query')) {
            $q = request()->get('query');
            $pasien->where('nama', 'LIKE', '%' . $q . '%')
                ->orWhere('alamat', 'LIKE', '%' . $q . '%');
        }
        $pasien = $pasien->orderBy('nama', 'ASC')->get();
        return view('show')->with('pasien', $pasien);
        //->where('id_kelas', '=', '03')
        //->join('ms_kategori','ms_buku.kode_kategori','=','ms_kategori.kode_kategori')

        //dump($siswa);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // //Menangkap Data Yang Diinput
        // $nama = $request->get('nama');
        // $alamat = $request->get('alamat');
        // //Menyimpan data kedalam tabel
        // $save_pasien = new \App\Models\Data;
        // $save_pasien->nama = $nama;
        // $save_pasien->alamat = $alamat;
        // $save_pasien->save();
        // return redirect('0192_show');

        //Menangkap Data Yang Diinput
        $nama = $request->get('nama');
        $alamat = $request->get('alamat');
        //Menyimpan data kedalam tabel
        $save_pasien = new \App\Models\Data;
        $save_pasien->nama = $nama;
        $save_pasien->alamat = $alamat;
        $save_pasien->save();
        return redirect('show');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pasien = Data::find($id);
        return view('edit', ['pasien' => $pasien]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pasien = Data::find($id);
        $pasien->nama = $request->nama;
        $pasien->alamat = $request->alamat;
        $pasien->save();
        return redirect('show');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pasien = Data::find($id);
        $pasien->delete();
        return redirect('show');
    }

    public function generate()
    {
        $pasien = \App\Models\Data::All();
        $pdf = PDF::loadview('pasien_pdf', ['pasien' => $pasien]);
        return $pdf->stream();
    }

    public function import(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');

        // membuat nama file unik
        $nama_file = $file->hashName();

        //temporary file
        $path = $file->storeAs('public/excel/', $nama_file);

        // import data
        $import = Excel::import(new pasienImport(), storage_path('app/public/excel/' . $nama_file));

        $pasien = DB::table('pasien');
        if ($import) {
            //redirect
            //return redirect()->route('pasien.index')->with(['success' => 'Data Berhasil Diimport!']);
            //return view('0264_Tampil' , ['pasien' => $pasien]); 
            return redirect('/show');
        } else {
            //redirect
            //return redirect()->route('.index')->with(['error' => 'Data Gagal Diimport!']);
            //return view('0264_Tampil' , ['pasien' => $pasien]); 
            return redirect('/show');
        }
    }
}
