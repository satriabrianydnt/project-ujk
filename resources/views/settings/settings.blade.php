@extends('dashboard.layouts.app')

@section('title', 'Pengaturan')

@section('content')
    <div class="flex flex-col gap-6 max-w-7xl mx-auto">

        <div>
            <h2 class="text-2xl font-extrabold text-gray-900 tracking-tight">Pengaturan Sistem</h2>
            <p class="text-sm text-gray-500 mt-1 leading-relaxed">
                Kelola keamanan dan preferensi aplikasi inventaris Anda.
            </p>
        </div>

        <div class="flex flex-col md:flex-row gap-6">

            <div class="w-full md:w-64 shrink-0">
                <div class="bg-white border border-gray-200/70 rounded-2xl shadow-sm p-2 flex flex-col gap-1">

                    <button onclick="switchTab('keamanan')" id="btn-keamanan"
                        class="tab-btn w-full flex items-center gap-3 px-4 py-3 text-sm font-semibold rounded-xl text-indigo-700 bg-indigo-50 transition-all text-left">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                            </path>
                        </svg>
                        Keamanan
                    </button>

                    <button onclick="switchTab('sistem')" id="btn-sistem"
                        class="tab-btn w-full flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl text-gray-600 hover:bg-gray-50 transition-all text-left">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Preferensi Sistem
                    </button>
                </div>
            </div>

            <div class="flex-1">

                <div id="tab-keamanan" class="tab-content block">
                    <div class="bg-white border border-gray-200/70 rounded-2xl shadow-sm overflow-hidden">
                        <div class="p-5 border-b border-gray-100">
                            <h3 class="font-bold text-gray-900 text-lg">Keamanan Akun</h3>
                            <p class="text-sm text-gray-500 mt-1">Pastikan akun Anda menggunakan password yang panjang dan
                                acak agar tetap aman.</p>
                        </div>
                        <div class="p-6">
                            <form action="{{ route('pengaturan.password.update') }}" method="POST"
                                class="space-y-6 max-w-lg">
                                @csrf
                                @method('PUT')
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Password Saat Ini</label>
                                    <input type="password" name="current_password"
                                        class="block w-full px-4 py-2.5 bg-white border border-gray-300 rounded-xl text-sm text-gray-900 focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all shadow-sm">
                                </div>

                                <hr class="border-gray-100">

                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Password Baru</label>
                                    <input type="password" name="password"
                                        class="block w-full px-4 py-2.5 bg-white border border-gray-300 rounded-xl text-sm text-gray-900 focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all shadow-sm">
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Konfirmasi Password
                                        Baru</label>
                                    <input type="password" name="password_confirmation"
                                        class="block w-full px-4 py-2.5 bg-white border border-gray-300 rounded-xl text-sm text-gray-900 focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all shadow-sm">
                                </div>

                                <div class="pt-4">
                                    <button type="submit"
                                        class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-xl transition-all shadow-sm focus:ring-4 focus:ring-indigo-500/20">Update
                                        Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div id="tab-sistem" class="tab-content hidden">
                    <div class="bg-white border border-gray-200/70 rounded-2xl shadow-sm overflow-hidden">
                        <div class="p-5 border-b border-gray-100">
                            <h3 class="font-bold text-gray-900 text-lg">Preferensi Sistem</h3>
                            <p class="text-sm text-gray-500 mt-1">Sesuaikan nama aplikasi dan peringatan sistem inventaris.
                            </p>
                        </div>
                        <div class="p-6">
                            <form action="{{ route('pengaturan.system.update') }}" method="POST"
                                class="space-y-6 max-w-lg">
                                @csrf
                                @method('PUT')
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Aplikasi</label>
                                    <input type="text" name="app_name" value="{{ $appName }}"
                                        class="block w-full px-4 py-2.5 bg-white border border-gray-300 rounded-xl text-sm text-gray-900 focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 outline-none transition-all shadow-sm">
                                </div>

                                <div class="pt-4">
                                    <button type="submit"
                                        class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-xl transition-all shadow-sm focus:ring-4 focus:ring-indigo-500/20">Simpan
                                        Konfigurasi</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        function switchTab(tabName) {
            document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));

            const targetTab = document.getElementById('tab-' + tabName);
            if (targetTab) {
                targetTab.classList.remove('hidden');
            }

            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.className =
                    'tab-btn w-full flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl text-gray-600 hover:bg-gray-50 transition-all text-left';
            });

            const activeBtn = document.getElementById('btn-' + tabName);
            if (activeBtn) {
                activeBtn.className =
                    'tab-btn w-full flex items-center gap-3 px-4 py-3 text-sm font-semibold rounded-xl text-indigo-700 bg-indigo-50 transition-all text-left';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            @if (session('active_tab'))
                switchTab('{{ session('active_tab') }}');
            @endif
        });
    </script>
@endsection
