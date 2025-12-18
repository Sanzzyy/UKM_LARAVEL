@if ($paginator->hasPages())
    <div class="mt-6 flex justify-center">
        <nav class="inline-flex items-center gap-1 rounded-lg bg-white px-3 py-2 shadow-md">

            {{-- ================= MOBILE ================= --}}
            <div class="flex items-center gap-2 sm:hidden">

                {{-- Prev --}}
                @if ($paginator->onFirstPage())
                    <span class="px-3 py-1.5 text-sm text-gray-400">Prev</span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}"
                        class="px-3 py-1.5 text-sm rounded-md hover:bg-gray-100">
                        Prev
                    </a>
                @endif

                {{-- Info --}}
                <span class="px-3 py-1.5 text-sm font-medium text-gray-700">
                    {{ $paginator->currentPage() }} / {{ $paginator->lastPage() }}
                </span>

                {{-- Next --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-1.5 text-sm rounded-md hover:bg-gray-100">
                        Next
                    </a>
                @else
                    <span class="px-3 py-1.5 text-sm text-gray-400">Next</span>
                @endif
            </div>

            {{-- ================= DESKTOP ================= --}}
            <div class="hidden sm:flex items-center gap-1">

                {{-- Prev --}}
                @if ($paginator->onFirstPage())
                    <span class="px-3 py-1.5 text-sm text-gray-400 cursor-not-allowed">
                        Prev
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}"
                        class="px-3 py-1.5 text-sm rounded-md hover:bg-gray-100">
                        Prev
                    </a>
                @endif

                @php
                    $start = max(1, $paginator->currentPage() - 1);
                    $end = min($paginator->lastPage(), $paginator->currentPage() + 1);
                @endphp

                {{-- First --}}
                @if ($start > 1)
                    <a href="{{ $paginator->url(1) }}" class="px-3 py-1.5 text-sm rounded-md hover:bg-gray-100">1</a>

                    @if ($start > 2)
                        <span class="px-2 text-gray-400">…</span>
                    @endif
                @endif

                {{-- Middle --}}
                @for ($page = $start; $page <= $end; $page++)
                    @if ($page == $paginator->currentPage())
                        <span class="px-3 py-1.5 text-sm font-semibold text-white bg-orange-500 rounded-md">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $paginator->url($page) }}" class="px-3 py-1.5 text-sm rounded-md hover:bg-gray-100">
                            {{ $page }}
                        </a>
                    @endif
                @endfor

                {{-- Last --}}
                @if ($end < $paginator->lastPage())
                    @if ($end < $paginator->lastPage() - 1)
                        <span class="px-2 text-gray-400">…</span>
                    @endif

                    <a href="{{ $paginator->url($paginator->lastPage()) }}"
                        class="px-3 py-1.5 text-sm rounded-md hover:bg-gray-100">
                        {{ $paginator->lastPage() }}
                    </a>
                @endif

                {{-- Next --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-1.5 text-sm rounded-md hover:bg-gray-100">
                        Next
                    </a>
                @else
                    <span class="px-3 py-1.5 text-sm text-gray-400 cursor-not-allowed">
                        Next
                    </span>
                @endif
            </div>

        </nav>
    </div>
@endif
