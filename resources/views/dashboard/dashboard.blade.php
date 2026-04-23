@extends('dashboard.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="p-6 mb-6 bg-white border border-gray-100 rounded-xl shadow-sm">
        <h3 class="text-lg font-bold text-gray-800">Selamat datang di StockSystem.</h3>
        <p class="mt-2 text-sm text-gray-600">
            Anda telah berhasil masuk ke dalam sistem. Silakan gunakan menu di sebelah kiri untuk mengelola master data
            barang atau memantau transaksi inventaris hari ini.
        </p>
    </div>

    <div class="grid grid-cols-1 gap-4 md:gap-6 md:grid-cols-3">
        <div class="p-6 bg-white border border-gray-100 rounded-xl shadow-sm">
            <p class="text-sm font-medium text-gray-500">Total Barang</p>
            <p class="mt-2 text-3xl font-bold text-gray-900">0</p>
        </div>
        <div class="p-6 bg-white border border-gray-100 rounded-xl shadow-sm">
            <p class="text-sm font-medium text-gray-500">Barang Masuk Bulan Ini</p>
            <p class="mt-2 text-3xl font-bold text-gray-900">0</p>
        </div>
        <div class="p-6 bg-white border border-gray-100 rounded-xl shadow-sm">
            <p class="text-sm font-medium text-gray-500">Barang Keluar Bulan Ini</p>
            <p class="mt-2 text-3xl font-bold text-gray-900">0</p>
        </div>
    </div>
@endsection
