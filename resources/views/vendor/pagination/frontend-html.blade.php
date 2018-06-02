@if ($paginator->hasPages())
        <div class="findhome-pagination">
                <ul class="page-numbers">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <li class="disabled button small grey"><span><i class="fa fa-angle-left"></i></span></li>
                    @else
                        <li><a class="button small grey" href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="fa fa-angle-left"></i></a></li>
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
                                    
                                    <li><span class="page-numbers current">{{ $page }}</span></li>
                                @else
                                    <!-- <li><a class="button small grey" href="{{ $url }}">{{ $page }}</a></li> -->
                                    <li><span class="page-numbers">{{ $page }}</span></li>

                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <li><a class="button small grey" href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="fa fa-angle-right"></i></a></li>
                    @else
                        <li class="disabled button small grey"><span><i class="fa fa-angle-right"></i></span></li>
                    @endif
                </ul>
        </div>
@endif
