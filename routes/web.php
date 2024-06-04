<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::middleware(['auth'])->group(function(){
    Route::get('/',[\App\Http\Controllers\HomeController::class,'index'])->name('welcome');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    #MANAGE menu User
    Route::get('/menu/data',[\App\Http\Controllers\Backend\DataController::class,'menu'])->name('menu.data');
    Route::get('/users/data',[\App\Http\Controllers\Backend\DataController::class,'user'])->name('users.data');
    
    Route::resources([
        'menu' => \App\Http\Controllers\MenuController::class,
        'users' => \App\Http\Controllers\UserController::class
    ]);
    Route::get('pesanan', [\App\Http\Controllers\MenuController::class, 'pesanan'])->name('pesanan.index');
});
