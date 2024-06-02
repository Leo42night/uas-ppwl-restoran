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
                    <div class="card-body text-center">
                        <img src="{{ $menu->getImageAsset() }}" alt="{{ $menu->getImageAsset() }}" class="object-fit-contain">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Update Menu - <strong>{{ $menu->nama }}</strong></div>
                    <div class="card-body">
                        <form action="{{ route('menu.update', $menu->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text"
                                    class="form-control @error('nama')
                                    is-invalid
                                @enderror"
                                    name="nama" id="nama" value="{{ $menu->nama }}">
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="my-3">
                                <label for="harga">Harga</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">Rp</span>
                                    <input type="number" class="form-control @error('harga')
                                            is-invalid
                                        @enderror" name="harga" value="{{ $menu->harga }}" id="harga"
                                        placeholder="harga" aria-label="harga">
                                </div>
                                @error('harga')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group my-3">
                                <label for="">Upload Gambar</label>
                                <input type="file"
                                    class="form-control @error('gambar')
                                    is-invalid
                                @enderror"
                                    name="gambar">
                                @error('gambar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-sm my-2">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
