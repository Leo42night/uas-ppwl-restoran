@extends('layouts.dashboard-volt')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <a href="{{ route('menu.index') }}" class="text-center">
                <button type="submit" class="btn btn-primary btn-sm m-2">
                <i class='fas fa-angle-double-left' style='font-size:;color:'></i>
                Back</button>
            </a>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header fw-bold">Add new data Menu</div>
                    <div class="card-body">
                        <form action="{{ route('menu.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group ">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control @error('nama')
                                    is-invalid
                                @enderror" name="nama" id="nama">
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group my-3">
                                <label for="">Upload Gambar</label>
                                <input type="file" class="form-control @error('gambar')
                                    is-invalid
                                @enderror" name="gambar" >
                                @error('gambar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            men

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-sm my-2">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection