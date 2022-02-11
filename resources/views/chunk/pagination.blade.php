@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="pages-number pages-regular">
                <i class="pages-chevron-icon fa fa-chevron-left"></i>
            </li>
        @else
            <li class="pages-number pages-regular">
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="pages-chevron-icon fa fa-chevron-left"></i></a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="pages-number pages_current active"><span>{{ $page }}</span></li>
                        {{--<li class="active"><span>{{ $page }}</span></li>--}}
                    @else
                        <li>
                            <a href="{{ $url }}" class="pages-number  pages-regular">
                                <span class="jj">{{ $page }}</span>
                            </a>
                        </li>

                        {{--<li><a href="{{ $url }}">{{ $page }}</a></li>--}}
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="pages-number pages-regular">
                <a href="{{ $paginator->nextPageUrl() }}" rel="next">
                    <i class="pages-chevron-icon fa fa-chevron-right"></i>
                </a>
            </li>
            {{--<li><a href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a></li>--}}
        @else
            <li class="pages-number pages-regular">
                    <i class="pages-chevron-icon fa fa-chevron-right"></i>
            </li>
            {{--<li class="disabled"><span>&raquo;</span></li>--}}
        @endif
    </ul>
@endif
