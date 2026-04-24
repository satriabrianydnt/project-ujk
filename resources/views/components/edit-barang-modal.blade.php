@props(['barang', 'kategoris'])

<div id="editBarangModal-{{ $barang->id }}" tabindex="-1" aria-hidden="true"
    class="fixed inset-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto h-full bg-slate-900/60 backdrop-blur-sm flex items-center justify-center transition-opacity duration-300 opacity-0">

    <div class="relative w-full max-w-lg transition-transform duration-300 scale-95 transform"
        id="editBarangModal-{{ $barang->id }}Content">
        <div class="relative bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden">

            <div class="flex items-start justify-between p-5 border-b border-gray-100 bg-gray-50/50">
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Edit Data Barang</h3>
                    <p class="text-xs text-gray-500 mt-1">Perbarui informasi barang: <span
                            class="font-bold text-indigo-600">{{ $barang->kode_barang }}</span></p>
                </div>
                <button type="button" onclick="window.location.reload()"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <form action="{{ route('data-barang.update', $barang->id) }}" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="id" value="{{ $barang->id }}">

                @php
                    // Cek apakah form ini yang sedang gagal divalidasi
                    $isThisModal = old('id') == $barang->id;
                @endphp

                <div class="p-6 space-y-5 text-left">
                    <div>
                        <label class="block mb-1.5 text-sm font-semibold text-gray-900">Nama Barang <span
                                class="text-red-500">*</span></label>
                        @php $errNama = $isThisModal && $errors->has('nama_barang'); @endphp
                        <input type="text" name="nama_barang"
                            value="{{ $isThisModal ? old('nama_barang') : $barang->nama_barang }}"
                            class="bg-gray-50 border {{ $errNama ? 'border-red-500' : 'border-gray-300' }} text-sm rounded-xl block w-full p-2.5 outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
                        @if ($errNama)
                            <p class="mt-1 text-xs text-red-500 font-medium">{{ $errors->first('nama_barang') }}</p>
                        @endif
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-1.5 text-sm font-semibold text-gray-900">Kode Barang <span
                                    class="text-red-500">*</span></label>
                            @php $errKode = $isThisModal && $errors->has('kode_barang'); @endphp
                            <input type="text" name="kode_barang"
                                value="{{ $isThisModal ? old('kode_barang') : $barang->kode_barang }}"
                                class="bg-gray-50 border {{ $errKode ? 'border-red-500' : 'border-gray-300' }} text-sm rounded-xl block w-full p-2.5 font-mono outline-none uppercase">
                            @if ($errKode)
                                <p class="mt-1 text-xs text-red-500 font-medium">{{ $errors->first('kode_barang') }}
                                </p>
                            @endif
                        </div>

                        <div>
                            <label class="block mb-1.5 text-sm font-semibold text-gray-900">Kategori <span
                                    class="text-red-500">*</span></label>
                            @php $errKat = $isThisModal && $errors->has('kategori_id'); @endphp
                            <select name="kategori_id"
                                class="bg-gray-50 border {{ $errKat ? 'border-red-500' : 'border-gray-300' }} text-sm rounded-xl block w-full p-2.5 outline-none">
                                @foreach ($kategoris as $kategori)
                                    @php $selectedVal = $isThisModal ? old('kategori_id') : $barang->kategori_id; @endphp
                                    <option value="{{ $kategori->id }}"
                                        {{ $selectedVal == $kategori->id ? 'selected' : '' }}>
                                        {{ $kategori->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errKat)
                                <p class="mt-1 text-xs text-red-500 font-medium">{{ $errors->first('kategori_id') }}
                                </p>
                            @endif
                        </div>
                    </div>

                    <div>
                        <label class="block mb-1.5 text-sm font-semibold text-gray-900">Stok Barang</label>
                        @php $errStok = $isThisModal && $errors->has('stok'); @endphp
                        <input type="number" name="stok" min="0"
                            value="{{ $isThisModal ? old('stok') : $barang->stok }}"
                            class="bg-gray-50 border {{ $errStok ? 'border-red-500' : 'border-gray-300' }} text-sm rounded-xl block w-full p-2.5 outline-none">
                        @if ($errStok)
                            <p class="mt-1 text-xs text-red-500 font-medium">{{ $errors->first('stok') }}</p>
                        @endif
                    </div>
                </div>

                <div class="flex items-center justify-end p-5 border-t border-gray-100 bg-gray-50/50 gap-3">
                    <button type="button" onclick="window.location.reload()"
                        class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-50">Batal</button>
                    <button type="submit"
                        class="px-5 py-2.5 text-sm font-medium text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 shadow-md">Update
                        Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

@if ($errors->any() && old('_method') == 'PUT' && old('id') == $barang->id)
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            toggleModal('editBarangModal-{{ $barang->id }}');
        });
    </script>
@endif
