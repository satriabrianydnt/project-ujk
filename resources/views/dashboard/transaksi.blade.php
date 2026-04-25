@extends('dashboard.layouts.app')

@section('title', 'Barang Masuk & Keluar')

@section('content')
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-4 md:p-6">
        <div class="flex flex-col gap-6 max-w-7xl mx-auto">

            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div class="w-full sm:w-auto">
                    <h2 class="text-xl md:text-2xl font-extrabold text-gray-900 tracking-tight">Riwayat Transaksi</h2>
                    <p class="text-xs md:text-sm text-gray-500 mt-1 leading-relaxed">
                        Pantau alur keluar masuk barang inventaris.
                    </p>
                </div>

                <div class="grid grid-cols-2 sm:flex gap-2 w-full sm:w-auto">

                    <div class="col-span-2 flex gap-2 w-full sm:w-auto mb-2 sm:mb-0 sm:mr-2">
                        <a href="{{ route('transaksi.export.excel') }}"
                            class="flex-1 sm:flex-none inline-flex items-center justify-center px-3 py-2 text-xs md:text-sm font-semibold text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 hover:text-green-600 transition-all shadow-sm">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            Export Excel
                        </a>
                        <a href="{{ route('transaksi.export.pdf') }}" target="_blank"
                            class="flex-1 sm:flex-none inline-flex items-center justify-center px-3 py-2 text-xs md:text-sm font-semibold text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 hover:text-red-600 transition-all shadow-sm">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                </path>
                            </svg>
                            Export PDF
                        </a>
                    </div>

                    <button onclick="toggleModal('addTransaksiMasukModal')"
                        class="inline-flex items-center justify-center px-3 md:px-4 py-2 text-xs md:text-sm font-semibold text-white transition-all bg-emerald-600 rounded-xl hover:bg-emerald-700 shadow-sm hover:shadow-emerald-500/30">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                        </svg>
                        <span>Tambah Barang Masuk</span>
                    </button>

                    <button onclick="toggleModal('addTransaksiKeluarModal')"
                        class="inline-flex items-center justify-center px-3 md:px-4 py-2 text-xs md:text-sm font-semibold text-white transition-all bg-rose-600 rounded-xl hover:bg-rose-700 shadow-sm hover:shadow-rose-500/30">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                        </svg>
                        <span>Tambah Barang Keluar</span>
                    </button>
                </div>
            </div>

            <div
                class="bg-transparent md:bg-white md:border md:border-gray-200/70 rounded-2xl md:shadow-sm overflow-hidden flex flex-col">

                <div class="p-0 md:p-5 md:border-b border-gray-100 bg-transparent md:bg-white mb-4 md:mb-0">
                    <form action="{{ route('transaksi.index') }}" method="GET">
                        <div class="flex flex-col md:flex-row gap-3">

                            <div class="relative flex-1">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="Cari nama atau kode barang..."
                                    class="block w-full pl-11 pr-4 py-2.5 bg-white border border-gray-300 rounded-xl text-sm text-gray-900 focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all shadow-sm">
                            </div>

                            <div class="relative w-full md:w-56">
                                <select name="jenis"
                                    class="block w-full px-4 py-2.5 bg-white border border-gray-300 rounded-xl text-sm text-gray-700 focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all shadow-sm cursor-pointer appearance-none">
                                    <option value="">Semua Tipe</option>
                                    <option value="masuk" {{ request('jenis') == 'masuk' ? 'selected' : '' }}>Barang Masuk
                                    </option>
                                    <option value="keluar" {{ request('jenis') == 'keluar' ? 'selected' : '' }}>Barang
                                        Keluar</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>

                            <button type="submit"
                                class="inline-flex items-center justify-center px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-xl transition-all shadow-sm focus:ring-4 focus:ring-indigo-500/20 whitespace-nowrap">
                                Cari Data
                            </button>

                        </div>
                    </form>
                </div>

                <div class="hidden md:block overflow-x-auto">
                    <table class="w-full text-left border-collapse whitespace-nowrap">
                        <thead>
                            <tr class="bg-gray-50/80 border-b border-gray-200/70">
                                <th
                                    class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest text-center">
                                    Tanggal</th>
                                <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest">Nama
                                    Barang
                                </th>
                                <th
                                    class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest text-center">
                                    Tipe</th>
                                <th
                                    class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest text-center">
                                    Jumlah</th>
                                <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest">
                                    Keterangan</th>
                                <th
                                    class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest text-right">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($transaksis as $t)
                                <tr class="hover:bg-gray-50/50 transition-colors group">
                                    <td class="px-6 py-4 text-sm text-gray-600 text-center font-medium">
                                        {{ \Carbon\Carbon::parse($t->tanggal_transaksi)->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <span
                                                class="text-sm font-bold text-gray-900">{{ $t->barang->nama_barang }}</span>
                                            <span
                                                class="text-[11px] font-mono text-gray-400 uppercase">{{ $t->barang->kode_barang }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if ($t->jenis == 'masuk')
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-100 uppercase tracking-wide">
                                                Masuk
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-xs font-bold bg-rose-50 text-rose-700 border border-rose-100 uppercase tracking-wide">
                                                Keluar
                                            </span>
                                        @endif
                                    </td>
                                    <td
                                        class="px-6 py-4 text-center font-bold {{ $t->jenis == 'masuk' ? 'text-emerald-600' : 'text-rose-600' }}">
                                        {{ $t->jenis == 'masuk' ? '+' : '-' }} {{ $t->jumlah }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500 italic max-w-xs truncate">
                                        {{ $t->keterangan ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <form action="{{ route('transaksi.destroy', $t->id) }}" method="POST"
                                            onsubmit="return confirm('Hapus riwayat transaksi ini? Stok barang akan dikalibrasi ulang.');">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center">
                                            <svg class="w-12 h-12 text-gray-200 mb-3" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                                </path>
                                            </svg>
                                            <p class="text-gray-400 font-medium">Belum ada riwayat transaksi.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="block md:hidden space-y-3">
                    @forelse ($transaksis as $t)
                        <div
                            class="bg-white border border-gray-200 rounded-2xl p-4 shadow-sm flex flex-col gap-3 relative overflow-hidden">
                            <div
                                class="absolute left-0 top-0 bottom-0 w-1 {{ $t->jenis == 'masuk' ? 'bg-emerald-500' : 'bg-rose-500' }}">
                            </div>

                            <div class="flex justify-between items-start pl-2">
                                <div>
                                    <h4 class="text-sm font-bold text-gray-900 leading-tight">
                                        {{ $t->barang->nama_barang }}</h4>
                                    <span
                                        class="text-[10px] font-mono text-gray-400 uppercase">{{ $t->barang->kode_barang }}</span>
                                </div>
                                <div class="text-right flex flex-col items-end">
                                    <span
                                        class="text-sm font-extrabold {{ $t->jenis == 'masuk' ? 'text-emerald-600' : 'text-rose-600' }}">
                                        {{ $t->jenis == 'masuk' ? '+' : '-' }} {{ $t->jumlah }}
                                    </span>
                                    <span
                                        class="text-[10px] text-gray-400">{{ \Carbon\Carbon::parse($t->tanggal_transaksi)->format('d M Y') }}</span>
                                </div>
                            </div>

                            <div class="pl-2 border-t border-gray-100 pt-2 flex justify-between items-center">
                                <p class="text-xs text-gray-500 italic truncate pr-2 w-3/4">
                                    {{ $t->keterangan ?? 'Tanpa keterangan' }}
                                </p>

                                <form action="{{ route('transaksi.destroy', $t->id) }}" method="POST"
                                    onsubmit="return confirm('Hapus riwayat transaksi ini? Stok barang akan dikalibrasi ulang.');">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                        class="p-1.5 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div
                            class="bg-white border border-gray-200 rounded-2xl p-8 shadow-sm flex flex-col items-center justify-center">
                            <svg class="w-10 h-10 text-gray-300 mb-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                </path>
                            </svg>
                            <p class="text-sm text-gray-500">Belum ada riwayat transaksi.</p>
                        </div>
                    @endforelse
                </div>

                <div class="px-0 md:px-6 py-4 bg-transparent md:bg-gray-50/50 md:border-t border-gray-200/70 mt-4 md:mt-0">
                    @if ($transaksis->hasPages())
                        <div class="flex items-center gap-1.5">
                            {{ $transaksis->links('components.pagination') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>

    <x-add-transaksi-modal type="masuk" :barangs="$barangs" />
    <x-add-transaksi-modal type="keluar" :barangs="$barangs" />

@endsection
