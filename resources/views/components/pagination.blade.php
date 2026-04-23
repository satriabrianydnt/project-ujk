@if ($paginator->hasPages())
    <div class="flex flex-col md:flex-row justify-between items-center w-full gap-4">
        <div class="flex items-center gap-1.5">

            @if ($paginator->onFirstPage())
                <span
                    class="p-2 text-gray-400 bg-gray-50 border border-gray-200 rounded-lg cursor-not-allowed shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                        </path>
                    </svg>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                    class="p-2 text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-indigo-50 hover:text-indigo-600 transition-all shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                        </path>
                    </svg>
                </a>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="px-3 py-2 text-sm font-medium text-gray-500">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span
                                class="px-3.5 py-2 text-sm font-bold text-white bg-indigo-600 border border-indigo-600 rounded-lg shadow-md">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}"
                                class="px-3.5 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-indigo-50 hover:text-indigo-600 transition-all shadow-sm">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                    class="p-2 text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-indigo-50 hover:text-indigo-600 transition-all shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            @else
                <span
                    class="p-2 text-gray-400 bg-gray-50 border border-gray-200 rounded-lg cursor-not-allowed shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </span>
            @endif

        </div>
    </div>
@endif
