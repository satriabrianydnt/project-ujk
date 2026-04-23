@extends('auth.layouts.app')

@section('title', 'Login')

@section('content')
    <div class="flex min-h-screen">
        <div class="hidden lg:flex w-1/2 relative items-center justify-center p-12 text-white bg-indigo-950">
            <img src="https://images.unsplash.com/photo-1517694712202-14dd9538aa97?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80"
                alt="Ilustrasi Pemrograman" class="absolute inset-0 w-full h-full object-cover opacity-15 mix-blend-overlay">

            <div class="relative z-10 max-w-md space-y-6">
                <h1 class="text-4xl font-extrabold tracking-tight text-white">Stock<span
                        class="font-medium text-indigo-200">System<span
                            class="text-base align-baseline font-bold text-white">.</span>
                    </span>
                </h1>
                <p class="text-lg text-indigo-100 font-light">
                    Sistem manajemen inventaris terintegrasi untuk efisiensi operasional gudang.
                </p>

                <div class="pt-8">
                    <div class="p-5 bg-white/5 rounded-2xl backdrop-blur-md border border-white/10 shadow-xl text-center">
                        <p class="text-xs font-semibold text-indigo-300 uppercase tracking-widest mb-2">Waktu Saat Ini</p>

                        <p class="text-2xl font-bold text-white">
                            {{ now()->format('d F Y') }}
                        </p>
                        <p class="text-xl font-medium text-indigo-100" id="live-time">
                            {{ now()->format('H:i:s') }} <span class="text-sm text-indigo-200">WIB</span>
                        </p>

                    </div>
                </div>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 sm:p-12 bg-white">
            <div class="w-full max-w-md space-y-8">
                <div>
                    <div class="lg:hidden text-center mb-8">
                        <h1 class="text-3xl font-extrabold tracking-tight text-indigo-950">Stock<span class="font-medium text-indigo-500">System<span class="text-sm align-top font-bold text-indigo-950">.</span>
                            </span>
                        </h1>
                    </div>

                    <h2 class="text-2xl font-extrabold text-gray-900 text-center lg:text-left">Selamat Datang</h2>
                    <p class="mt-2 text-sm text-gray-600 text-center lg:text-left">
                        Silahkan masuk terlebih dahulu untuk mengakses dashboard.</p>
                </div>

                <form class="mt-8 space-y-6" action="{{ route('login.post') }}" method="POST">
                    @csrf
                    <div class="space-y-5">

                        @if ($errors->has('email'))
                            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 font-medium">
                                {{ $errors->first('email') }}
                            </div>
                        @endif

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Alamat Email</label>
                            <input id="email" name="email" type="email" required value="{{ old('email') }}"
                                class="mt-1 block w-full px-4 py-3 bg-gray-50 border @error('email') border-red-500 @else border-gray-200 @enderror rounded-lg text-gray-900 focus:ring-2 focus:ring-indigo-200 focus:border-indigo-400 sm:text-sm transition-all outline-none"
                                placeholder="email@inventaris.com">
                        </div>
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi</label>
                            <input id="password" name="password" type="password" required
                                class="mt-1 block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-gray-900 focus:ring-2 focus:ring-indigo-200 focus:border-indigo-400 sm:text-sm transition-all outline-none"
                                placeholder="••••••••">
                        </div>
                    </div>

                    <div class="flex items-center justify-between text-sm mt-4">
                        <div class="flex items-center">
                            <input id="remember-me" name="remember-me" type="checkbox"
                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded cursor-pointer">
                            <label for="remember-me" class="ml-2 block text-gray-700 cursor-pointer">Ingat sesi saya</label>
                        </div>
                        <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500 transition-colors">Lupa
                            password?</a>
                    </div>

                    <button type="submit"
                        class="w-full flex justify-center py-3.5 px-4 border border-transparent text-sm font-semibold rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all shadow-md hover:shadow-lg mt-6">
                        Masuk ke Dashboard
                    </button>
                </form>

                <p class="text-center text-xs text-gray-400 pt-8 font-mono">
                    &copy; 2026 All rights reserved.
                </p>
            </div>
        </div>
    </div>

    <script>
        function updateClock() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            const timeString = `${hours}:${minutes}:${seconds} <span class="text-sm text-indigo-200">WIB</span>`;
            document.getElementById('live-time').innerHTML = timeString;
        }
        setInterval(updateClock, 1000);
    </script>
@endsection
