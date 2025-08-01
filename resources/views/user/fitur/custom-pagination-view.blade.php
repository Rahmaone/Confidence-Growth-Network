@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Tombol Sebelumnya --}}
        @if ($paginator->onFirstPage())
            <li class="disabled page-item"><span class="page-link">«</span></li>
        @else
            <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">«</a></li>
        @endif

        {{-- Tombol Halaman --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="disabled page-item"><span class="page-link">{{ $element }}</span></li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active page-item"><span class="page-link">{{ $page }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Tombol Berikutnya --}}
        @if ($paginator->hasMorePages())
            <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">»</a></li>
        @else
            <li class="disabled page-item"><span class="page-link">»</span></li>
        @endif
    </ul>
@endif
