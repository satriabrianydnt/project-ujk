<?php

use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\barang\DataBarangController;
use App\Http\Controllers\barang\KategoriBarangController;
use App\Http\Controllers\dashboard\DashboardController;
use App\Http\Controllers\transaksi\TransaksiController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('login.post');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Route Barang & Kategori
    Route::resource('/data-barang', DataBarangController::class);
    Route::resource('/kategori-barang', KategoriBarangController::class);

    // Route Transaksi
    Route::resource('/transaksi', TransaksiController::class);
    Route::get('/transaksi/export/excel', [TransaksiController::class, 'exportExcel'])->name('transaksi.export.excel');
    Route::get('/transaksi/export/pdf', [TransaksiController::class, 'exportPdf'])->name('transaksi.export.pdf');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
