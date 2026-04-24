<?php

use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\barang\DataBarangController;
use App\Http\Controllers\barang\KategoriBarangController;
use App\Http\Controllers\dashboard\DashboardController;
use App\Http\Controllers\settings\SettingsController;
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

    // Route Pengaturan
    Route::get('/pengaturan', [SettingsController::class, 'index'])->name('pengaturan.index');
    Route::put('/pengaturan/password', [SettingsController::class, 'updatePassword'])->name('pengaturan.password.update');
    Route::put('/pengaturan/sistem', [SettingsController::class, 'updateSystem'])->name('pengaturan.system.update');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
