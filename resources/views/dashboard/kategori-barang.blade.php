@extends('dashboard.layouts.app')

@section('title', 'Kategori Barang')

@section('content')
    <div class="flex flex-col gap-6 max-w-7xl mx-auto">

        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-2xl font-extrabold text-gray-900 tracking-tight">Kategori Barang</h2>
                <p class="text-sm text-gray-500 mt-1 leading-relaxed">
                    Kelola pengelompokan jenis barang untuk mempermudah pencarian dan filter di sistem inventaris.
                </p>
            </div>

            <button onclick="toggleModal('addKategoriModal')"
                class="w-full sm:w-auto inline-flex items-center justify-center px-5 py-2.5 text-sm font-semibold text-white transition-all bg-indigo-600 rounded-xl hover:bg-indigo-700 shadow-sm hover:shadow-indigo-500/30 focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                    </path>
                </svg>
                Tambah Kategori Baru
            </button>
        </div>

        <div class="bg-white border border-gray-200/70 rounded-2xl shadow-sm overflow-hidden flex flex-col">

            <div class="p-4 sm:p-5 border-b border-gray-200/70 bg-gray-50/50">
                <form action="{{ route('kategori-barang.index') }}" method="GET" class="flex flex-col sm:flex-row gap-3">

                    <div class="relative w-full flex-1">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}"
                            class="block w-full pl-11 pr-4 py-2.5 border border-gray-300 rounded-xl leading-5 bg-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 sm:text-sm transition-all"
                            placeholder="Cari nama kategori...">
                    </div>

                    <div class="flex items-center gap-2 w-full sm:w-auto">
                        <button type="submit"
                            class="w-full sm:w-auto px-5 py-2.5 bg-indigo-600 text-white font-semibold text-sm rounded-xl hover:bg-indigo-700 shadow-sm transition-all flex justify-center items-center">
                            Cari Data
                        </button>

                        @if (request('search'))
                            <a href="{{ route('kategori-barang.index') }}"
                                class="px-3 py-2.5 bg-white border border-gray-300 text-gray-500 rounded-xl hover:bg-gray-50 hover:text-red-500 transition-all shadow-sm"
                                title="Reset Pencarian">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            @if (isset($kategoris) && count($kategoris) > 0)
                <div class="hidden md:block w-full overflow-x-auto relative shadow-inner">
                    <table class="w-full text-left border-collapse whitespace-nowrap">
                        <thead class="bg-white border-b border-gray-200/70 sticky top-0 z-10">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest w-12 text-center">No</th>
                                <th scope="col" class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest">Nama Kategori</th>
                                <th scope="col" class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest">Deskripsi</th>
                                <th scope="col" class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest text-center">Jumlah Barang</th>
                                <th scope="col" class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($kategoris as $index => $kategori)
                                <tr class="hover:bg-indigo-50/30 transition-colors group">
                                    <td class="px-6 py-4 text-sm text-gray-500 font-medium text-center">
                                        {{ $kategoris->firstItem() + $index }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-[12px] font-bold bg-slate-100 text-slate-700 border border-slate-200/60 uppercase tracking-tight">
                                            <svg class="w-3.5 h-3.5 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                            </svg>
                                            {{ $kategori->nama_kategori }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-normal">
                                        <div class="text-sm text-gray-500 max-w-[200px] md:max-w-xs">
                                            <p id="desc-desktop-{{ $kategori->id }}" class="line-clamp-2 transition-all duration-300">
                                                {{ $kategori->deskripsi ?? '-' }}
                                            </p>
                                            @if($kategori->deskripsi && strlen($kategori->deskripsi) > 60)
                                                <button type="button" onclick="toggleReadMore('desktop-{{ $kategori->id }}')" id="btn-desktop-{{ $kategori->id }}" class="text-[11px] font-semibold text-indigo-600 hover:text-indigo-800 mt-1 focus:outline-none">
                                                    Baca selengkapnya
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="inline-flex items-center justify-center px-2.5 py-1 rounded-lg text-xs font-bold {{ $kategori->barang_count > 0 ? 'bg-indigo-50 text-indigo-700 border border-indigo-100' : 'bg-gray-50 text-gray-500 border border-gray-200' }}">
                                            {{ $kategori->barang_count }} Item
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-1 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                            <button type="button" onclick="toggleModal('editKategoriModal-{{ $kategori->id }}')" class="p-2 text-gray-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all" title="Edit">
                                                <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                            </button>
                                            <form action="{{ route('kategori-barang.destroy', $kategori->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ({{ $kategori->nama_kategori }}) ini?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all" title="Hapus">
                                                    <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
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
                    @foreach ($kategoris as $index => $kategori)
                        <div class="p-4 hover:bg-indigo-50/50 transition-colors flex justify-between items-start">
                            <div class="flex flex-col gap-1.5 w-3/4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-bold bg-slate-100 text-slate-700 border border-slate-200/60 uppercase tracking-tight w-fit">
                                    <svg class="w-3.5 h-3.5 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                    {{ $kategori->nama_kategori }}
                                </span>
                                
                                <div class="mt-1">
                                    <p id="desc-mobile-{{ $kategori->id }}" class="text-[11px] text-gray-500 leading-relaxed line-clamp-2 transition-all duration-300 pr-2">
                                        {{ $kategori->deskripsi ?? 'Tidak ada deskripsi' }}
                                    </p>
                                    @if($kategori->deskripsi && strlen($kategori->deskripsi) > 60)
                                        <button type="button" onclick="toggleReadMore('mobile-{{ $kategori->id }}')" id="btn-mobile-{{ $kategori->id }}" class="text-[10px] font-bold text-indigo-600 hover:text-indigo-800 mt-0.5 focus:outline-none">
                                            Baca selengkapnya
                                        </button>
                                    @endif
                                </div>

                                <span class="text-[10px] font-medium text-gray-500 mt-1">
                                    Total: <strong class="{{ $kategori->barang_count > 0 ? 'text-indigo-600' : 'text-gray-400' }}">{{ $kategori->barang_count }} Item</strong>
                                </span>
                            </div>

                            <div class="flex gap-1 mt-1">
                                <button type="button" onclick="toggleModal('editKategoriModal-{{ $kategori->id }}')" class="p-1.5 text-gray-400 hover:text-indigo-600 bg-white border border-gray-200 rounded-md shadow-sm">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </button>
                                <form action="{{ route('kategori-barang.destroy', $kategori->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ({{ $kategori->nama_kategori }}) ini?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-1.5 text-gray-400 hover:text-red-600 bg-white border border-gray-200 rounded-md shadow-sm">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="p-4 sm:p-5 border-t border-gray-200/70 bg-gray-50/30">
                    <div class="flex flex-col md:flex-row justify-between items-center w-full gap-4">
                        <div class="text-sm text-gray-500 font-medium text-center md:text-left">
                            @if (request()->filled('search'))
                                Hasil pencarian: <span class="font-bold text-indigo-600">{{ $kategoris->total() }}</span> Data ditemukan
                                <span class="text-gray-400 mx-1">|</span>
                                Halaman <span class="font-bold text-gray-900">{{ $kategoris->currentPage() }}</span>
                            @else
                                Menampilkan <span class="font-bold text-gray-900">{{ $kategoris->firstItem() ?? 0 }}</span> hingga <span class="font-bold text-gray-900">{{ $kategoris->lastItem() ?? 0 }}</span> dari <span class="font-bold text-indigo-600">{{ $kategoris->total() }}</span> Data
                            @endif
                        </div>
                        @if ($kategoris->hasPages())
                            <div class="flex items-center gap-1.5">
                                {{ $kategoris->appends(request()->query())->links('components.pagination') }}
                            </div>
                        @endif
                    </div>
                </div>
            @else
                <div class="flex flex-col items-center justify-center px-6 py-16 sm:py-24 text-center bg-white">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-indigo-50 mb-5 shadow-inner">
                        <svg class="w-8 h-8 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-extrabold text-gray-900 mb-2">Belum Ada Kategori</h3>
                    <p class="text-sm text-gray-500 max-w-sm mx-auto mb-6 leading-relaxed">Anda belum menambahkan data kategori apa pun ke dalam sistem.</p>
                    <button onclick="toggleModal('addKategoriModal')" class="w-full sm:w-auto inline-flex items-center justify-center px-5 py-2.5 text-sm font-semibold text-indigo-700 bg-indigo-50 rounded-xl hover:bg-indigo-100 transition-colors">
                        Tambah Kategori Pertama
                    </button>
                </div>
            @endif
        </div>
    </div>

    <x-add-kategori-modal />

    @if (isset($kategoris) && count($kategoris) > 0)
        @foreach ($kategoris as $kategori)
            <x-edit-kategori-modal :kategori="$kategori" />
        @endforeach
    @endif

    <script>
        function toggleReadMore(id) {
            const textElement = document.getElementById('desc-' + id);
            const btnElement = document.getElementById('btn-' + id);

            if (textElement.classList.contains('line-clamp-2')) {
                textElement.classList.remove('line-clamp-2');
                btnElement.innerText = 'Tutup deskripsi';
            } else {
                textElement.classList.add('line-clamp-2');
                btnElement.innerText = 'Baca selengkapnya';
            }
        }
    </script>
@endsection