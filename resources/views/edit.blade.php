@extends('layout/main')
@section('container')
    <section class="database">
        <div class="container">
            <div class="row">
                <div class="col-8">
                    <h2>Edit Data Mahasiswa</h2>
                    <form action="{{ url('show/' . $pasien->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="_method" value="patch">
                        <div class="mb-3 col-4">
                            <label for="nama" class="form-label">Nama</label>
                            <input name="nama" type="text" class="form-control" id="nama" aria-describedby="nama"
                                value="{{ $pasien->nama }}">
                        </div>
                        <div class="mb-3 col-4">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input name="alamat" type="text" class="form-control" id="alamat"
                                value="{{ $pasien->alamat }}">
                        </div>
                        <button type="submit" class="btn btn-primary" value="Submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
