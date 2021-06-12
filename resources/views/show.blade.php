@extends('layout/main')
@section('container')
    <section class="database">
        <div class="container">
            <div class="row">
                <div class="col-8">
                    {{-- <a href="{{ route('mahasiswa.create') }}" class="tambah">Tambah Data</a> --}}
                    <h3>Data Buku</h3>

                    <form class="d-flex" action="/show" method="GET">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"
                            value="{{ request()->get('query') }}" name="query">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                    <br>
                    <a type="button" class="btn btn-primary" href="/tambah">Tambah Data</a>
                    <a type="button" class="btn btn-warning " href="{{ url('/show/pdf') }}">Print</a>
                    <button type="button" class="btn btn-secondary mr-5" data-toggle="modal" data-target="#importExcel">
                        Import Excel
                    </button>
                    <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form method="post" action="/pasien/import_excel" enctype="multipart/form-data">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                                    </div>
                                    <div class="modal-body">

                                        {{ csrf_field() }}

                                        <label>Pilih file excel</label>
                                        <div class="form-group">
                                            <input type="file" name="file" required="required">
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Import</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    {{-- <a class="tambah" href="{{ url('/mahasiswa/pdf') }}"> Print </a> --}}
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach ($pasien as $ps)
                                <tr>
                                    <th scope="row">{{ $no++ }}</th>
                                    <td>{{ $ps->nama }}</td>
                                    <td>{{ $ps->alamat }}</td>
                                    <td>
                                        <a type="button" class="btn btn-success"
                                            href="{{ url('show/' . $ps->id . '/edit') }}">Edit</a>
                                        {{-- <a type="button" class="btn btn-danger"
                                            href="{{ url('show/' . $ps->id) }}">Hapus</a> --}}
                                        <form action="{{ url('show/' . $ps->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="_method" value="delete">
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
@endsection
