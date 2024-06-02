@extends('layouts.dashboard-volt')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 d-flex align-items-center">
                <a href="{{ route('users.index') }}" class="text-center">
                    <button type="submit" class="btn btn-primary btn-sm m-2">
                        <i class='fas fa-angle-double-left' style='font-size:;color:'></i>
                        Back</button>
                </a>
                <div>Update Data: <span class="fw-bold fs-3">{{ $user->name }}</span></div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <img class="w-100" src="{{ $user->getImageAsset() }}"
                            alt="">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('users.update', $user->id) }}" method="post" enctype="multipart/form-data"
                            class="row">
                            @method('PUT')
                            @csrf
                            <div class="form-group col-md-6 mb-3">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" id="name" value="{{ $user->name }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 mb-3">
                                <label for="email">Email</label>
                                <input type="email" value="{{ $user->email }}"
                                    class="form-control @error('email') is-invalid @enderror" name="email" id="email"
                                    placeholder="example@email.com">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 mb-3">
                                <label for="password">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" id="password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 mb-3">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password_confirmation" id="password_confirmation">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 mb-3">
                                <label for="">Upload Foto Profil</label>
                                <input type="file" class="form-control @error('gambar') is-invalid @enderror"
                                    name="gambar" value="{{ $user->gambar }}">
                                @error('gambar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="roles" class="col-form-label me-2 text-start">Roles</label>
                                <div class="">
                                    <select class="form-select @error('roles') is-invalid @enderror" {{ ($userRole == 'Super Admin') ? 'size=1' : 'size='.sizeof($roles) }}
                                        id="roles" name="roles[]">
                                        @if ($userRole == 'Super Admin')
                                            <option selected>{{ $userRole }}</option>
                                        @else
                                            @foreach ($roles as $role)
                                                @continue($role == 'Super Admin')
                                                <option {{ $role == $userRole ? 'selected' : '' }}>
                                                    {{ $role }}
                                                </option>
                                            @endforeach
                                        @endif

                                    </select>
                                    @if ($errors->has('roles'))
                                        <span class="text-danger">{{ $errors->first('roles') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group my-3">
                                <label for="uang">Keuangan</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">Rp</span>
                                    <input type="number" class="form-control @error('uang') is-invalid @enderror"
                                        name="uang" id="uang" value="{{ $user->uang }}">
                                </div>
                                @error('uang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

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
