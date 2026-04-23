<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - StockMaster Pro</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-50 font-sans antialiased text-gray-900">
    @include('sweetalert::alert')
    <div class="flex h-screen overflow-hidden">
        
        <aside class="hidden w-64 overflow-y-auto bg-indigo-950 text-white md:block flex-shrink-0">
            <div class="flex items-center justify-center h-16 bg-indigo-900 shadow-md">
                <span class="text-xl font-bold tracking-wider">StockMaster Pro</span>
            </div>
            <nav class="p-4 space-y-2 text-sm font-medium">
                <a href="#" class="flex items-center px-4 py-3 bg-indigo-800 rounded-lg text-white">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Dashboard
                </a>
                <a href="#" class="flex items-center px-4 py-3 text-indigo-200 rounded-lg hover:bg-indigo-800 hover:text-white transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    Data Barang
                </a>
                <a href="#" class="flex items-center px-4 py-3 text-indigo-200 rounded-lg hover:bg-indigo-800 hover:text-white transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Laporan
                </a>
            </nav>
        </aside>

        <div class="flex flex-col flex-1 overflow-hidden">
            
            <header class="flex items-center justify-between px-6 py-4 bg-white border-b border-gray-200">
                <div class="flex items-center">
                    <button class="text-gray-500 focus:outline-none md:hidden">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                    <h2 class="ml-4 text-xl font-semibold text-gray-800 md:ml-0">Tinjauan Sistem</h2>
                </div>

                <div class="flex items-center gap-4">
                    <span class="text-sm font-medium text-gray-600">
                        Halo, {{ auth()->user()->name ?? 'Administrator' }}
                    </span>
                    
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white transition-colors bg-red-600 border border-transparent rounded-lg shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            Keluar
                        </button>
                    </form>
                    </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6">
                <div class="p-6 mb-6 bg-white border border-gray-100 rounded-xl shadow-sm">
                    <h3 class="text-lg font-bold text-gray-800">Selamat datang di StockMaster Pro</h3>
                    <p class="mt-2 text-sm text-gray-600">
                        Anda telah berhasil masuk ke dalam sistem. Silakan gunakan menu di sebelah kiri untuk mengelola master data barang atau memantau transaksi inventaris hari ini.
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                    <div class="p-6 bg-white border border-gray-100 rounded-xl shadow-sm">
                        <p class="text-sm font-medium text-gray-500">Total Barang</p>
                        <p class="mt-2 text-3xl font-bold text-gray-900">0</p>
                    </div>
                    <div class="p-6 bg-white border border-gray-100 rounded-xl shadow-sm">
                        <p class="text-sm font-medium text-gray-500">Barang Masuk Bulan Ini</p>
                        <p class="mt-2 text-3xl font-bold text-gray-900">0</p>
                    </div>
                    <div class="p-6 bg-white border border-gray-100 rounded-xl shadow-sm">
                        <p class="text-sm font-medium text-gray-500">Barang Keluar Bulan Ini</p>
                        <p class="mt-2 text-3xl font-bold text-gray-900">0</p>
                    </div>
                </div>
            </main>
        </div>
    </div>

</body>
</html>