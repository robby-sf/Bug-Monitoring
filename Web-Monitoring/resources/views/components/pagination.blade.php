@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-center gap-2 mt-8">
        
        {{-- Tombol Previous --}}
        @if ($paginator->onFirstPage())
            <span class="px-4 py-2 text-sm font-medium text-zinc-600 bg-[#0f0f0f] border border-white/5 cursor-not-allowed rounded-xl shadow-sm flex items-center gap-2">
                <i class="fas fa-chevron-left text-[10px]"></i> Prev
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="px-4 py-2 text-sm font-medium text-zinc-300 bg-[#1a1a1a] border border-white/10 hover:bg-[#252525] hover:text-white rounded-xl transition-all shadow-sm flex items-center gap-2 active:scale-95">
                <i class="fas fa-chevron-left text-[10px]"></i> Prev
            </a>
        @endif

        {{-- Nomor Halaman (Hanya muncul di layar agak besar) --}}
        <div class="hidden sm:flex gap-2">
            @foreach ($elements as $element)
                {{-- Pemisah Tiga Titik (...) --}}
                @if (is_string($element))
                    <span class="px-4 py-2 text-sm font-medium text-zinc-500 bg-[#0f0f0f] border border-white/5 rounded-xl">{{ $element }}</span>
                @endif

                {{-- Array Link Halaman --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            {{-- Halaman Aktif --}}
                            <span class="px-4 py-2 text-sm font-bold text-white bg-indigo-600 border border-indigo-500 rounded-xl shadow-lg shadow-indigo-500/20 cursor-default">
                                {{ $page }}
                            </span>
                        @else
                            {{-- Halaman Lain --}}
                            <a href="{{ $url }}" class="px-4 py-2 text-sm font-medium text-zinc-400 bg-[#1a1a1a] border border-white/10 hover:bg-[#252525] hover:text-white rounded-xl transition-colors shadow-sm active:scale-95">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        {{-- Tombol Next --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="px-4 py-2 text-sm font-medium text-zinc-300 bg-[#1a1a1a] border border-white/10 hover:bg-[#252525] hover:text-white rounded-xl transition-all shadow-sm flex items-center gap-2 active:scale-95">
                Next <i class="fas fa-chevron-right text-[10px]"></i>
            </a>
        @else
            <span class="px-4 py-2 text-sm font-medium text-zinc-600 bg-[#0f0f0f] border border-white/5 cursor-not-allowed rounded-xl shadow-sm flex items-center gap-2">
                Next <i class="fas fa-chevron-right text-[10px]"></i>
            </span>
        @endif
        
    </nav>
@endif