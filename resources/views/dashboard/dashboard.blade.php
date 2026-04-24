@extends('dashboard.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="flex flex-col gap-6 max-w-7xl mx-auto">

        <div
            class="relative overflow-hidden p-8 bg-gradient-to-r from-indigo-600 to-indigo-700 rounded-2xl shadow-lg shadow-indigo-200">
            <div class="relative z-10">
                <h3 class="text-2xl font-bold text-white">Selamat datang kembali, {{ auth()->user()->name }}! 👋</h3>
                <p class="mt-2 text-indigo-100 max-w-xl">
                    Pantau ketersediaan inventaris dan kelola data master StockSystem dalam satu panel kendali terpusat.
                </p>
            </div>
            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
        </div>

        <div class="grid grid-cols-1 gap-4 md:gap-6 sm:grid-cols-2 lg:grid-cols-5">

            <div class="p-6 bg-white border border-gray-200/70 rounded-2xl shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-indigo-50 rounded-xl text-indigo-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Data Barang</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $totalBarang }} <span
                                class="text-xs font-normal text-gray-400">Item</span></p>
                    </div>
                </div>
            </div>

            <div class="p-6 bg-white border border-gray-200/70 rounded-2xl shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-amber-50 rounded-xl text-amber-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Kategori</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $totalKategori }} <span
                                class="text-xs font-normal text-gray-400">Grup</span></p>
                    </div>
                </div>
            </div>

            <div class="p-6 bg-white border border-gray-200/70 rounded-2xl shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-emerald-50 rounded-xl text-emerald-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Stok</p>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($totalStok) }} <span
                                class="text-xs font-normal text-gray-400">Unit</span></p>
                    </div>
                </div>
            </div>

            <div class="p-6 bg-white border border-gray-200/70 rounded-2xl shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-blue-50 rounded-xl text-blue-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Barang Masuk Hari Ini</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $barangMasukHariIni }} <span
                                class="text-xs font-normal text-gray-400">Unit</span></p>
                    </div>
                </div>
            </div>

            <div class="p-6 bg-white border border-gray-200/70 rounded-2xl shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-rose-50 rounded-xl text-rose-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Barang Keluar Hari Ini</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $barangKeluarHariIni }} <span
                                class="text-xs font-normal text-gray-400">Unit</span></p>
                    </div>
                </div>
            </div>

        </div>

        <div class="bg-white border border-gray-200/70 rounded-2xl shadow-sm overflow-hidden">
            <div class="p-5 border-b border-gray-100 flex justify-between items-center">
                <h3 class="font-bold text-gray-900 text-lg">Barang Terbaru</h3>
                <a href="{{ route('data-barang.index') }}"
                    class="text-sm font-semibold text-indigo-600 hover:text-indigo-700">Lihat Semua →</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50/50 text-[11px] font-bold text-gray-400 uppercase tracking-widest">
                        <tr>
                            <th class="px-6 py-4">Nama Barang</th>
                            <th class="px-6 py-4">Kode Barang</th>
                            <th class="px-6 py-4 text-center">Kategori</th>
                            <th class="px-6 py-4">Stok</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($recentBarangs as $item)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4">
                                    <span class="font-bold text-gray-900 text-sm">{{ $item->nama_barang }}</span>
                                </td>

                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded text-[11px] font-mono font-bold bg-indigo-50 text-indigo-600 border border-indigo-100 uppercase">
                                        {{ $item->kode_barang }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold bg-slate-100 text-slate-700 border border-slate-200/60 uppercase tracking-tight">
                                        <svg class="w-3 h-3 mr-1.5 text-slate-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                            </path>
                                        </svg>
                                        {{ $item->kategori->nama_kategori ?? 'N/A' }}
                                    </span>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div
                                            class="w-1.5 h-1.5 rounded-full {{ $item->stok <= 5 ? 'bg-red-500 animate-pulse' : 'bg-emerald-500' }} mr-2">
                                        </div>
                                        <span
                                            class="text-sm font-bold {{ $item->stok <= 5 ? 'text-red-600' : 'text-gray-900' }}">
                                            {{ $item->stok }} <span
                                                class="text-[10px] font-normal text-gray-400 ml-0.5 uppercase">Unit</span>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-10 text-center text-gray-400 text-sm italic">
                                    Belum ada data barang terbaru.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
