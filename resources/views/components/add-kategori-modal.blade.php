<div id="addKategoriModal" tabindex="-1" aria-hidden="true"
    class="fixed inset-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto h-full bg-slate-900/60 backdrop-blur-sm flex items-center justify-center transition-opacity duration-300 opacity-0">

    <div class="relative w-full max-w-md transition-transform duration-300 scale-95 transform"
        id="addKategoriModalContent">

        <div class="relative bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden">

            <div class="flex items-start justify-between p-5 border-b border-gray-100 bg-gray-50/50">
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Tambah Kategori Baru</h3>
                    <p class="text-xs text-gray-500 mt-1">Lengkapi data kategori inventaris.</p>
                </div>
                <button type="button" onclick="window.location.reload()"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <form action="{{ route('kategori-barang.store') }}" method="POST">
                @csrf
                <div class="p-6 space-y-5 text-left">
                    <div class="mb-4">
                        <label for="nama_kategori" class="block mb-1.5 text-sm font-semibold text-gray-900">
                            Nama Kategori <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama_kategori" id="nama_kategori" value="{{ old('nama_kategori') }}"
                            class="bg-gray-50 border @error('nama_kategori') border-red-500 @else border-gray-300 @enderror text-sm rounded-xl block w-full p-2.5 outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500"
                            placeholder="Contoh: Elektronik, Mebel...">
                        @error('nama_kategori')
                            <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="deskripsi" class="block mb-1.5 text-sm font-semibold text-gray-900">Deskripsi
                            Kategori</label>
                        <textarea name="deskripsi" id="deskripsi" rows="3"
                            class="bg-gray-50 border @error('deskripsi') border-red-500 @else border-gray-300 @enderror text-sm rounded-xl block w-full p-2.5 outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500"
                            placeholder="Berikan keterangan singkat tentang kategori ini...">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <p class="mt-1 text-xs text-red-500 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center justify-end p-5 border-t border-gray-100 bg-gray-50/50 gap-3">
                    <button type="button" onclick="window.location.reload()"
                        class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-50">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-5 py-2.5 text-sm font-medium text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 shadow-md">
                        Simpan Data
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

@if ($errors->any() && !old('_method'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            toggleModal('addKategoriModal');
        });
    </script>
@endif
