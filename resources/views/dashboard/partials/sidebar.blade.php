<div id="sidebar-overlay" class="fixed inset-0 z-20 hidden bg-indigo-950/80 backdrop-blur-sm md:hidden"
    onclick="toggleSidebar()"></div>

<aside id="sidebar"
    class="fixed inset-y-0 left-0 z-30 w-72 transition-transform duration-300 transform -translate-x-full bg-indigo-950 text-indigo-100 md:relative md:translate-x-0 md:flex md:flex-col flex-shrink-0">

    <div class="flex flex-col items-center pt-8 pb-6 px-8 relative">

        <span class="text-3xl font-extrabold tracking-tight text-white drop-shadow-sm text-center">
            Stock<span class="font-normal text-indigo-300">System<span
                    class="text-xs align-baseline font-bold text-white">.</span></span>
        </span>

        <button class="absolute top-9 right-5 text-indigo-300 md:hidden hover:text-white focus:outline-none"
            onclick="toggleSidebar()">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    <nav class="flex-1 overflow-y-auto px-4 py-2 space-y-6 scrollbar-none">

        <div>
            <div class="space-y-1">
                <a href="{{ route('dashboard') }}"
                    class="flex items-center justify-between px-4 py-3.5 rounded-2xl transition-all {{ request()->routeIs('dashboard') ? 'bg-white/10 text-white' : 'text-indigo-200 hover:bg-white/5 hover:text-white' }}">
                    <div class="flex items-center">
                        <svg class="w-[22px] h-[22px] mr-4 opacity-80" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                            </path>
                        </svg>
                        <span class="font-medium text-[15px]">Dashboard</span>
                    </div>
                </a>
            </div>
        </div>

        <div>
            <p class="px-5 mb-2 text-[11px] font-semibold tracking-widest text-indigo-300/60 uppercase">Data Master</p>
            <div class="space-y-1">
                <a href="{{ route('data-barang.index') }}"
                    class="flex items-center justify-between px-4 py-3.5 rounded-2xl transition-all {{ request()->routeIs('data-barang.*') ? 'bg-white/10 text-white' : 'text-indigo-200 hover:bg-white/5 hover:text-white' }}">
                    <div class="flex items-center">
                        <svg class="w-[22px] h-[22px] mr-4 opacity-80" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                        <span class="font-medium text-[15px]">Data Barang</span>
                    </div>
                    <svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>

                <a href="{{ route('kategori-barang.index') }}"
                    class="flex items-center justify-between px-4 py-3.5 rounded-2xl transition-all {{ request()->routeIs('kategori-barang.*') ? 'bg-white/10 text-white' : 'text-indigo-200 hover:bg-white/5 hover:text-white' }}">
                    <div class="flex items-center">
                        <svg class="w-[22px] h-[22px] mr-4 opacity-80" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                            </path>
                        </svg>
                        <span class="font-medium text-[15px]">Kategori Barang</span>
                    </div>
                    <svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>

        <div>
            <p class="px-5 mb-2 text-[11px] font-semibold tracking-widest text-indigo-300/60 uppercase">Transaksi</p>
            <div class="space-y-1">
                <a href="#"
                    class="flex items-center justify-between px-4 py-3.5 rounded-2xl transition-all hover:bg-white/5 hover:text-white text-indigo-200">
                    <div class="flex items-center">
                        <svg class="w-[22px] h-[22px] mr-4 opacity-80" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                        </svg>
                        <span class="font-medium text-[15px]">Barang Masuk & Keluar</span>
                    </div>
                    <svg class="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </nav>

    <div class="p-4 mb-4">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                class="flex items-center justify-between w-full px-4 py-3.5 text-indigo-200 rounded-2xl transition-all hover:bg-red-500/10 hover:text-red-300 focus:outline-none">
                <div class="flex items-center">
                    <svg class="w-[22px] h-[22px] mr-4 opacity-80" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                        </path>
                    </svg>
                    <span class="font-medium text-[15px]">Keluar</span>
                </div>
            </button>
        </form>
    </div>
</aside>
