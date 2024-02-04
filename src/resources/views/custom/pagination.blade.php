<style>
    .pagination {
        list-style-type: none;
        display: flex;
        justify-content: center;
        padding: 0;
    }

    .arrow__left,
    .arrow__right {
        width: 35px;
        height: 45px;
        line-height: 45px;
        font-size: 10px;
        color: #1e90ff;
        background: white;
        border: solid 0.5px #d3d3d3;
    }

    .arrow__left {
        border-radius: 3px 0 0 3px;
        /* padding-right: 10px; */
    }

    .arrow__right {
        border-radius: 0 3px 3px 0;
    }

    .pagination-elements {
        display: flex;
    }

    .active,
    .passive,
    .three-dots {
        width: 45px;
        height: 45px;
        line-height: 45px;
        font-size: 14px;
        border: solid 0.5px #d3d3d3;
    }

    .active {
        color: white;
        background: #1e90ff;
    }

    .passive {
        color: #1e90ff;
        background: white;
    }

    .three-dots {
        color: black;
        background: white;
    }

    span,a {
        text-decoration: none;
    }

</style>
@if ($paginator->hasPages())
    <ul class="pagination">
        <div class="arrow__left">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled"><span>&lt;</span></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">&lt;</a></li>
        @endif
        </div>

        <div class="pagination-elements">
        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled three-dots"><span>{{ $element }}</span></li>
            @endif

            {{-- Array of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active"><span>{{ $page }}</span></li>
                    @else
                        <li class="passive"><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach
        </div>

        <div class="arrow__right">
        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">&gt;</a></li>
        @else
            <li class="disabled"><span>&gt;</span></li>
        @endif
        </div>
    </ul>
@endif