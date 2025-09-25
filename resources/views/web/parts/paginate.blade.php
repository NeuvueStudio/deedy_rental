@if ($products->hasPages())
<div class="pagination-area mt-20 mb-20">
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-start">

            {{-- Previous Page Link --}}
            @if ($products->onFirstPage())
                <li class="page-item disabled"><span class="page-link"><i class="fi-rs-arrow-small-left"></i></span></li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $products->previousPageUrl() }}"><i class="fi-rs-arrow-small-left"></i></a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                @if ($page == $products->currentPage())
                    <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                @elseif ($page == 1 || $page == $products->lastPage() || abs($products->currentPage() - $page) < 2)
                    <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                @elseif ($loop->first || $loop->last)
                    <li class="page-item disabled"><span class="page-link dot">...</span></li>
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($products->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $products->nextPageUrl() }}"><i class="fi-rs-arrow-small-right"></i></a>
                </li>
            @else
                <li class="page-item disabled"><span class="page-link"><i class="fi-rs-arrow-small-right"></i></span></li>
            @endif

        </ul>
    </nav>
</div>
@endif