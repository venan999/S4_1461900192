@extends('layout/main')
@section('container')
    <section class="database">
        <div class="container">
            <div class="row">
                <div class="col-8">
                    <h3>Tambah Data Pasiean</h3>

                    <form action="/store" method="POST">
                        @csrf
                        <div class="mb-3 col-4">
                            <label for="nama" class="form-label">Nama</label>
                            <input name="nama" type="text" class="form-control" id="nama" aria-describedby="nama">
                        </div>
                        <div class="mb-3 col-4">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input name="alamat" type="text" class="form-control" id="alamat">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
