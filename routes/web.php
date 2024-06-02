<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/',[\App\Http\Controllers\HomeController::class,'index'])->name('welcome');
Route::get('/detail-spot/{slug}',[\App\Http\Controllers\HomeController::class,'detailSpot'])->name('detail-spot');

Auth::routes();

Route::middleware(['auth'])->group(function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/simple-map', [App\Http\Controllers\HomeController::class, 'simple_map'])->name('simple-map');
    Route::get('/markers', [App\Http\Controllers\HomeController::class, 'marker'])->name('markers');
    Route::get('/circle', [App\Http\Controllers\HomeController::class, 'circle'])->name('circle');
    Route::get('/polygon', [App\Http\Controllers\HomeController::class, 'polygon'])->name('polygon');
    Route::get('/polyline', [App\Http\Controllers\HomeController::class, 'polyline'])->name('polyline');
    Route::get('/rectangle', [App\Http\Controllers\HomeController::class, 'rectangle'])->name('rectangle');
    Route::get('/layer', [App\Http\Controllers\HomeController::class, 'layers'])->name('layer');
    Route::get('/layer-group', [App\Http\Controllers\HomeController::class, 'layer_group'])->name('layer-group');
    Route::get('/geojson', [App\Http\Controllers\HomeController::class, 'geojson'])->name('geojson');
    Route::get('/get-coordinate', [App\Http\Controllers\HomeController::class, 'getCoordinate'])->name('getCoordinate');
    
    ## Route Datatable
    Route::get('/centre-point/data',[\App\Http\Controllers\Backend\DataController::class,'centrepoint'])->name('centre-point.data');
    Route::get('/spot/data',[\App\Http\Controllers\Backend\DataController::class,'spot'])->name('spot.data');
    
    Route::resource('centre-point',(\App\Http\Controllers\Backend\CentrePointController::class));
    Route::resource('spot',(\App\Http\Controllers\Backend\SpotController::class));

    #MANAGE menu User
    // Route::get('/menu', [App\Http\Controllers\HomeController::class, 'menu'])->name('menu'); 
    Route::get('/menu/data',[\App\Http\Controllers\Backend\DataController::class,'menu'])->name('menu.data');
    Route::get('/menu/clean',[\App\Http\Controllers\Backend\DataController::class,'clean'])->name('menu.clean');
    
    Route::get('/users/data',[\App\Http\Controllers\Backend\DataController::class,'user'])->name('users.data');
    Route::resources([
        'menu' => \App\Http\Controllers\MenuController::class,
        'users' => \App\Http\Controllers\UserController::class
    ]);
    Route::get('pesanan', [\App\Http\Controllers\MenuController::class, 'pesanan'])->name('pesanan.index');

    
});
