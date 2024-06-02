@extends('layouts.dashboard-volt')

@section('content')
    @foreach ($menus as $menu)
        <div class="col-6 col-xl-3 mb-4">
            <div class="card border-0 shadow" style="">
                <div class="card-body d-flex flex-col align-items-center">
                    <div class="col-12 mb-0 d-flex justify-content-around align-items-center">
                        <img src="{{ $menu->getImageAsset() }}" class="" alt="gambar tidak tersedia" 
                            style="height:80px; width:80px">
                        <div class="">
                            <h2 class="h6 text-gray-400">{{ $menu->nama }}</h2>
                            <h3 class="d-none d-xl-inline fw-bold text fs-5 mb-1">Rp @convert($menu->harga)</h3>
                            <h3 class="d-xl-none fw-bold text fs-6 mb-1">Rp @convert($menu->harga)</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
