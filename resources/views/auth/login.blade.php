@extends('auth.layouts.app')

@section('title', 'Masuk - StockMaster Pro')

@section('content')
<div class="flex min-h-screen">
    <div class="hidden lg:flex w-1/2 bg-blue-600 items-center justify-center p-12 text-white">
        <div class="max-w-md space-y-6">
            <h1 class="text-4xl font-bold italic tracking-tight">StockMaster Pro</h1>
            <p class="text-lg text-blue-100">
                Sistem manajemen inventaris terintegrasi untuk efisiensi operasional gudang dan pemantauan stok secara real-time.
            </p>
            <div class="pt-8">
                <div class="inline-block p-4 bg-white/10 rounded-2xl backdrop-blur-md border border-white/20">
                    <p class="text-sm">"Kelola aset perusahaan dengan presisi dan akurasi tinggi."</p>
                </div>
            </div>
        </div>
    </div>

    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 sm:p-12">
        <div class="w-full max-w-md space-y-8">
            <div>
                <h2 class="text-3xl font-extrabold text-gray-900 text-center lg:text-left">Selamat Datang</h2>
                <p class="mt-2 text-sm text-gray-600 text-center lg:text-left">Silakan masuk ke akun administrator Anda</p>
            </div>

            <form class="mt-8 space-y-6" action="#" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Alamat Email</label>
                        <input id="email" name="email" type="email" required 
                            class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition-shadow"
                            placeholder="admin@perusahaan.com">
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi</label>
                        <input id="password" name="password" type="password" required 
                            class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition-shadow"
                            placeholder="••••••••">
                    </div>
                </div>

                <div class="flex items-center justify-between text-sm">
                    <div class="flex items-center">
                        <input id="remember-me" name="remember-me" type="checkbox" 
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="remember-me" class="ml-2 block text-gray-900">Ingat saya</label>
                    </div>
                    <a href="#" class="font-medium text-blue-600 hover:text-blue-500">Lupa password?</a>
                </div>

                <button type="submit" 
                    class="w-full flex justify-center py-3 px-4 border border-transparent text-sm font-semibold rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors shadow-lg hover:shadow-xl">
                    Masuk ke Dashboard
                </button>
            </form>
            
            <p class="text-center text-xs text-gray-500 pt-8">
                &copy; 2026 PT Inventaris Jaya. Versi 1.0.0
            </p>
        </div>
    </div>
</div>
@endsection