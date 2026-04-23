<?php

use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\barang\DataBarangController;
use App\Http\Controllers\barang\KategoriBarangController;
use App\Http\Controllers\dashboard\DashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('login.post');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::resource('/data-barang', DataBarangController::class);
    Route::resource('/kategori-barang', KategoriBarangController::class);

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});