<header class="flex items-center justify-between px-6 py-4 bg-white border-b border-gray-100 sticky top-0 z-10">
    <div class="flex items-center">
        <button class="p-2 -ml-2 text-gray-500 rounded-lg focus:outline-none md:hidden hover:bg-gray-100"
            onclick="toggleSidebar()">
            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
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

        <div class="relative">
            <button id="profileMenuButton" onclick="toggleProfileDropdown(event)"
                class="flex items-center justify-center w-10 h-10 font-bold text-indigo-700 bg-indigo-100 border-2 border-indigo-200 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 hover:scale-105 transition-transform cursor-pointer">
                {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
            </button>

            <div id="profileDropdown"
                class="absolute right-0 z-50 hidden w-48 mt-3 origin-top-right bg-white border border-gray-100 rounded-xl shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none transition-all">
                <div class="p-1">
                    <a href="{{ route('pengaturan.index') }}"
                        class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-700 rounded-lg hover:bg-indigo-50 hover:text-indigo-700 transition-colors">
                        <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Pengaturan
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>
