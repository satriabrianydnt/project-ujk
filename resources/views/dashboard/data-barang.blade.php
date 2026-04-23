@extends('dashboard.layouts.app')

@section('title', 'Data Barang')

@section('content')
    <div class="flex flex-col gap-6 max-w-7xl mx-auto">

        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-2xl font-extrabold text-gray-900 tracking-tight">Daftar Inventaris</h2>
                <p class="text-sm text-gray-500 mt-1 leading-relaxed">
                    Kelola seluruh data master barang dan pantau ketersediaan stok secara real-time.
                </p>
            </div>

            <button onclick="toggleModal('addBarangModal')"
                class="w-full sm:w-auto inline-flex items-center justify-center px-5 py-2.5 text-sm font-semibold text-white transition-all bg-indigo-600 rounded-xl hover:bg-indigo-700 shadow-sm hover:shadow-indigo-500/30 focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                    </path>
                </svg>
                Tambah Barang Baru
            </button>
        </div>

        <div class="bg-white border border-gray-200/70 rounded-2xl shadow-sm overflow-hidden flex flex-col">

            <div
                class="p-4 sm:p-5 border-b border-gray-200/70 bg-gray-50/50 flex flex-col sm:flex-row justify-between items-center gap-3">
                <div class="relative w-full sm:max-w-md">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text"
                        class="block w-full pl-11 pr-4 py-2.5 border border-gray-300 rounded-xl leading-5 bg-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 sm:text-sm transition-all"
                        placeholder="Cari nama atau kode barang...">
                </div>

                <button
                    class="w-full sm:w-auto px-4 py-2.5 bg-white border border-gray-300 text-gray-700 font-medium text-sm rounded-xl hover:bg-gray-50 flex items-center justify-center shadow-sm transition-all">
                    <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z">
                        </path>
                    </svg>
                    Filter Data
                </button>
            </div>

            @if (isset($barangs) && count($barangs) > 0)

                <div class="hidden md:block w-full overflow-x-auto relative shadow-inner">
                    <table class="w-full text-left border-collapse whitespace-nowrap">
                        <thead class="bg-white border-b border-gray-200/70 sticky top-0 z-10">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest w-12 text-center">
                                    No</th>
                                <th scope="col"
                                    class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest">
                                    Informasi Barang</th>
                                <th scope="col"
                                    class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest">Kategori
                                </th>
                                <th scope="col"
                                    class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest text-right">
                                    Ketersediaan</th>
                                <th scope="col"
                                    class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest text-right">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($barangs as $index => $barang)
                                <tr class="hover:bg-indigo-50/30 transition-colors group">
                                    <td class="px-6 py-4 text-sm text-gray-500 font-medium text-center">{{ $index + 1 }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col items-start gap-1">
                                            <span
                                                class="text-sm font-bold text-gray-900 leading-none">{{ $barang->nama_barang }}</span>
                                            <span
                                                class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-indigo-50 text-indigo-600 border border-indigo-100">
                                                {{ $barang->kode_barang }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-700 border border-slate-200/60">
                                            <svg class="w-3 h-3 mr-1.5 text-slate-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                                </path>
                                            </svg>
                                            {{ $barang->kategori->nama_kategori ?? 'Tanpa Kategori' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        @if ($barang->stok > 0)
                                            <div
                                                class="inline-flex items-center px-2.5 py-1 bg-emerald-50 text-emerald-700 rounded-lg border border-emerald-100">
                                                <div class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-2 animate-pulse">
                                                </div>
                                                <span class="text-sm font-bold">{{ $barang->stok }} <span
                                                        class="text-[10px] font-normal opacity-80 uppercase">unit</span></span>
                                            </div>
                                        @else
                                            <div
                                                class="inline-flex items-center px-2.5 py-1 bg-red-50 text-red-700 rounded-lg border border-red-100 font-bold text-sm">
                                                <div class="w-1.5 h-1.5 rounded-full bg-red-500 mr-2"></div>
                                                Habis
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div
                                            class="flex items-center justify-end gap-1 md:opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                            <a href="#"
                                                class="p-2 text-gray-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all"
                                                title="Edit">
                                                <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                    </path>
                                                </svg>
                                            </a>
                                            <form action="#" method="POST"
                                                onsubmit="return confirm('Hapus barang ini secara permanen?');">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                    class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all"
                                                    title="Hapus">
                                                    <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="block md:hidden divide-y divide-gray-100/80 bg-gray-50/30">
                    @foreach ($barangs as $index => $barang)
                        <div class="p-4 hover:bg-indigo-50/50 transition-colors flex flex-col gap-3">
                            <div class="flex justify-between items-start">
                                <span
                                    class="inline-flex items-center px-2 py-1 rounded-md text-[10px] font-mono font-bold bg-indigo-50 text-indigo-600 border border-indigo-100">
                                    {{ $barang->kode_barang }}
                                </span>

                                <div class="flex gap-1">
                                    <a href="#"
                                        class="p-1.5 text-gray-400 hover:text-indigo-600 bg-white border border-gray-200 rounded-md shadow-sm">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                    </a>
                                    <form action="#" method="POST"
                                        onsubmit="return confirm('Hapus barang ini secara permanen?');">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="p-1.5 text-gray-400 hover:text-red-600 bg-white border border-gray-200 rounded-md shadow-sm">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <h4 class="text-sm font-bold text-gray-900 leading-snug">{{ $barang->nama_barang }}</h4>

                            <div class="flex justify-between items-center pt-2.5 border-t border-gray-100">
                                <div
                                    class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold bg-slate-100 text-slate-600 border border-slate-200/50">
                                    <svg class="w-3 h-3 mr-1 text-slate-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                        </path>
                                    </svg>
                                    {{ $barang->kategori->nama_kategori ?? 'Tanpa Kategori' }}
                                </div>

                                <div>
                                    @if ($barang->stok > 0)
                                        <div
                                            class="inline-flex items-center px-2 py-1 bg-emerald-50 text-emerald-700 rounded-md border border-emerald-100">
                                            <div class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5 animate-pulse">
                                            </div>
                                            <span class="text-[11px] font-bold">{{ $barang->stok }} <span
                                                    class="font-normal opacity-80 uppercase">unit</span></span>
                                        </div>
                                    @else
                                        <div
                                            class="inline-flex items-center px-2 py-1 bg-red-50 text-red-700 rounded-md border border-red-100">
                                            <div class="w-1.5 h-1.5 rounded-full bg-red-500 mr-1.5"></div>
                                            <span class="text-[11px] font-bold">Habis</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="flex flex-col items-center justify-center px-6 py-16 sm:py-24 text-center bg-white">
                    <div
                        class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-indigo-50 mb-5 shadow-inner">
                        <svg class="w-8 h-8 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-extrabold text-gray-900 mb-2">Inventaris Masih Kosong</h3>
                    <p class="text-sm text-gray-500 max-w-sm mx-auto mb-6 leading-relaxed">Anda belum menambahkan data
                        barang apa pun ke dalam sistem.</p>
                    <button onclick="toggleModal('addBarangModal')"
                        class="w-full sm:w-auto inline-flex items-center justify-center px-5 py-2.5 text-sm font-semibold text-indigo-700 bg-indigo-50 rounded-xl hover:bg-indigo-100 transition-colors">
                        Tambah Barang Pertama
                    </button>
                </div>
            @endif
        </div>
    </div>

    <x-add-barang-modal :kategoris="$kategoris" />
@endsection
