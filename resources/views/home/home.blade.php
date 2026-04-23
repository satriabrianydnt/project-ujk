@extends('home.layouts.app')

@section('title', 'Welcome')

@section('content')

<!-- HERO SECTION -->
<section class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-20">
    <div class="container mx-auto px-6 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-6">
            Sistem Inventaris Modern
        </h1>
        <p class="text-lg mb-8 text-blue-100">
            Kelola barang, stok, dan kategori dengan mudah, cepat, dan efisien.
        </p>
        <a href="#" class="bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100">
            Mulai Sekarang
        </a>
    </div>
</section>

<!-- FEATURES -->
<section id="features" class="py-16">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-3xl font-bold mb-10">Fitur Utama</h2>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="font-semibold text-xl mb-2">Manajemen Barang</h3>
                <p class="text-gray-600">Kelola data barang dengan mudah dan terstruktur.</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="font-semibold text-xl mb-2">Monitoring Stok</h3>
                <p class="text-gray-600">Pantau stok barang secara real-time.</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="font-semibold text-xl mb-2">Kategori Fleksibel</h3>
                <p class="text-gray-600">Atur kategori sesuai kebutuhan bisnis Anda.</p>
            </div>
        </div>
    </div>
</section>

<!-- ABOUT -->
<section id="about" class="bg-gray-100 py-16">
    <div class="container mx-auto px-6 text-center max-w-2xl">
        <h2 class="text-3xl font-bold mb-6">Tentang Sistem</h2>
        <p class="text-gray-600">
            Sistem ini dirancang untuk membantu bisnis dalam mengelola inventaris secara efisien, 
            mengurangi kesalahan pencatatan, dan meningkatkan produktivitas.
        </p>
    </div>
</section>

<!-- CTA -->
<section class="py-16 text-center">
    <h2 class="text-3xl font-bold mb-4">Siap Mengelola Inventaris Anda?</h2>
    <p class="text-gray-600 mb-6">Daftar sekarang dan mulai gunakan sistem kami.</p>
    <a href="#" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">
        Daftar Sekarang
    </a>
</section>

@endsection