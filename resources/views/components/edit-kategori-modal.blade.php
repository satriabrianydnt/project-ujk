@props(['kategori'])

<div id="editKategoriModal-{{ $kategori->id }}" tabindex="-1" aria-hidden="true"
    class="fixed inset-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto h-full bg-slate-900/60 backdrop-blur-sm flex items-center justify-center transition-opacity duration-300 opacity-0">

    <div class="relative w-full max-w-md transition-transform duration-300 scale-95 transform"
        id="editKategoriModal-{{ $kategori->id }}Content">

        <div class="relative bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden">

            <div class="flex items-start justify-between p-5 border-b border-gray-100 bg-gray-50/50">
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Edit Kategori</h3>
                    <p class="text-xs text-gray-500 mt-1">Ubah nama kategori inventaris.</p>
                </div>
                <button type="button" onclick="window.location.reload()"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <form action="{{ route('kategori-barang.update', $kategori->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="kategori_id" value="{{ $kategori->id }}">

                <div class="p-6 space-y-5 text-left">
                    @php
                        $isThisModal = old('kategori_id') == $kategori->id;
                    @endphp

                    <div class="mb-4">
                        <label for="nama_kategori_{{ $kategori->id }}"
                            class="block mb-1.5 text-sm font-semibold text-gray-900">
                            Nama Kategori <span class="text-red-500">*</span>
                        </label>
                        @php $errNama = $isThisModal && $errors->has('nama_kategori'); @endphp
                        <input type="text" name="nama_kategori" id="nama_kategori_{{ $kategori->id }}"
                            value="{{ $isThisModal ? old('nama_kategori') : $kategori->nama_kategori }}"
                            class="bg-gray-50 border {{ $errNama ? 'border-red-500' : 'border-gray-300' }} text-sm rounded-xl block w-full p-2.5 outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
                        @if ($errNama)
                            <p class="mt-1 text-xs text-red-500 font-medium">{{ $errors->first('nama_kategori') }}</p>
                        @endif
                    </div>

                    <div class="mb-4">
                        <label for="deskripsi_{{ $kategori->id }}"
                            class="block mb-1.5 text-sm font-semibold text-gray-900">Deskripsi Kategori</label>
                        @php $errDesk = $isThisModal && $errors->has('deskripsi'); @endphp
                        <textarea name="deskripsi" id="deskripsi_{{ $kategori->id }}" rows="3"
                            class="bg-gray-50 border {{ $errDesk ? 'border-red-500' : 'border-gray-300' }} text-sm rounded-xl block w-full p-2.5 outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500"
                            placeholder="Ubah keterangan kategori...">{{ $isThisModal ? old('deskripsi') : $kategori->deskripsi }}</textarea>
                        @if ($errDesk)
                            <p class="mt-1 text-xs text-red-500 font-medium">{{ $errors->first('deskripsi') }}</p>
                        @endif
                    </div>
                </div>

                <div class="flex items-center justify-end p-5 border-t border-gray-100 bg-gray-50/50 gap-3">
                    <button type="button" onclick="window.location.reload()"
                        class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-50">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-5 py-2.5 text-sm font-medium text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 shadow-md">
                        Update Data
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

@if ($errors->any() && old('_method') == 'PUT' && old('kategori_id') == $kategori->id)
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            toggleModal('editKategoriModal-{{ $kategori->id }}');
        });
    </script>
@endif
