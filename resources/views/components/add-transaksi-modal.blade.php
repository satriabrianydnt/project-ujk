@props(['type', 'barangs'])

@php
    $isMasuk = $type === 'masuk';
    $modalID = $isMasuk ? 'addTransaksiMasukModal' : 'addTransaksiKeluarModal';
    $title = $isMasuk ? 'Tambah Barang Masuk' : 'Tambah Barang Keluar';
    $subTitle = $isMasuk ? 'Menambah stok inventaris ke gudang.' : 'Mencatat pengeluaran barang dari gudang.';
    $btnText = $isMasuk ? 'Simpan Data Masuk' : 'Simpan Data Keluar';
    $selectID = $isMasuk ? 'selectBarangMasuk' : 'selectBarangKeluar';
@endphp

<div id="{{ $modalID }}" tabindex="-1" aria-hidden="true"
    class="fixed inset-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto h-full bg-slate-900/60 backdrop-blur-sm flex items-center justify-center transition-opacity duration-300 opacity-0">

    <div class="relative w-full max-w-lg transition-transform duration-300 scale-95 transform"
        id="{{ $modalID }}Content">
        <div class="relative bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden text-left">

            <div class="flex items-start justify-between p-5 border-b border-gray-100 bg-gray-50/50">
                <div>
                    <h3 class="text-lg font-bold text-gray-900">{{ $title }}</h3>
                    <p class="text-xs text-gray-500 mt-1">{{ $subTitle }}</p>
                </div>
                <button type="button" onclick="window.location.reload()"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <form action="{{ route('transaksi.store') }}" method="POST">
                @csrf
                <input type="hidden" name="jenis" value="{{ $type }}">

                <div class="p-6 space-y-5">
                    <div>
                        <label class="block mb-1.5 text-sm font-semibold text-gray-900">Nama Barang <span
                                class="text-red-500">*</span></label>
                        <div class="relative">
                            <select name="barang_id" id="{{ $selectID }}" required class="w-full outline-none">
                                <option value=""></option>
                                @foreach ($barangs as $barang)
                                    <option value="{{ $barang->id }}"
                                        {{ old('barang_id') == $barang->id ? 'selected' : '' }}>
                                        [{{ $barang->kode_barang }}] {{ $barang->nama_barang }} (Stok:
                                        {{ $barang->stok }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('barang_id')
                            <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-1.5 text-sm font-semibold text-gray-900">Jumlah <span
                                    class="text-red-500">*</span></label>
                            <input type="number" name="jumlah" min="1" value="{{ old('jumlah') }}" required
                                class="bg-gray-50 border @error('jumlah') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-xl block w-full p-2.5 outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all"
                                placeholder="0">
                            @error('jumlah')
                                <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block mb-1.5 text-sm font-semibold text-gray-900">Tanggal <span
                                    class="text-red-500">*</span></label>
                            <input type="date" name="tanggal_transaksi"
                                value="{{ old('tanggal_transaksi', date('Y-m-d')) }}" required
                                class="bg-gray-50 border @error('tanggal_transaksi') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-xl block w-full p-2.5 outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">
                            @error('tanggal_transaksi')
                                <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block mb-1.5 text-sm font-semibold text-gray-900">Keterangan / Alasan</label>
                        <textarea name="keterangan" rows="3"
                            class="bg-gray-50 border @error('keterangan') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-xl block w-full p-2.5 outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all placeholder-gray-400"
                            placeholder="Contoh: Pengadaan rutin divisi IT atau Barang rusak...">{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                            <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center justify-end p-5 border-t border-gray-100 bg-gray-50/50 gap-3">
                    <button type="button" onclick="window.location.reload()"
                        class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 transition-colors">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-5 py-2.5 text-sm font-medium text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 shadow-md transition-all">
                        {{ $btnText }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#{{ $selectID }}').select2({
                placeholder: "Cari Kode atau Nama Barang...",
                allowClear: true,
                width: '100%',
                dropdownParent: $('#{{ $modalID }}')
            });
        });
    </script>
@endpush

@if ($errors->any() && old('jenis') == $type)
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            toggleModal('{{ $modalID }}');
        });
    </script>
@endif
