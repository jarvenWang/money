<link rel="stylesheet" href="../bower_components/bootstrap/bootstrap.min.css">
@if ($paginator->hasPages())
    <center>
    <ul class="pagination">
        <!-- Previous Page Link -->
        @if ($paginator->onFirstPage())
            <li><span style="cursor:pointer;" >首页</span></li>
        @else
            <li><a class="direction" render="{{ $paginator->previousPageUrl() }}" rel="prev" style="cursor:pointer;" >上一页</a></li>
        @endif

        <!-- Pagination Elements -->
        @foreach ($elements as $element)
            <!-- "Three Dots" Separator -->
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif

            <!-- Array Of Links -->
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active"><span  style="cursor:pointer;background-color:#AF0000;border:1px solid #AF0000">{{ $page }}</span></li>
                    @else
                        <li><a class="direction" style="cursor:pointer;" render="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        <!-- Next Page Link -->
        @if ($paginator->hasMorePages())
            <li><a class="direction" style="cursor:pointer;"  render="{{ $paginator->nextPageUrl() }}" rel="next">下一页</a></li>
        @else
            <li class="disabled"><span style="cursor:pointer;" >尾页</span></li>
        @endif
    </ul>
        </center>
@endif

