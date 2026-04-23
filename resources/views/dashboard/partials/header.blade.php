<header class="flex items-center justify-between px-6 py-4 bg-white border-b border-gray-100 sticky top-0 z-10">
    <div class="flex items-center">
        <button class="p-2 -ml-2 text-gray-500 rounded-lg focus:outline-none md:hidden hover:bg-gray-100" onclick="toggleSidebar()">
            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
        <h2 class="ml-4 text-xl font-bold text-gray-800 md:ml-0 tracking-tight">@yield('title')</h2>
    </div>

    <div class="flex items-center gap-3">
        <div class="hidden text-right sm:block">
            <p class="text-sm font-semibold text-gray-700 leading-none mb-1">
                {{ auth()->user()->name ?? 'Administrator' }}
            </p>
            <p class="text-xs text-gray-500 font-medium leading-none">
                {{ auth()->user()->email ?? 'admin@inventaris.com' }}
            </p>
        </div>
        
        <div class="flex items-center justify-center w-10 h-10 font-bold text-indigo-700 bg-indigo-100 border-2 border-indigo-200 rounded-full shadow-sm">
            {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
        </div>
    </div>
</header>