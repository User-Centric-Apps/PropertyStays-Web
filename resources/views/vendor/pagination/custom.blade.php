@if ($paginator->hasPages())
<nav class="d-flex justify-content-between pt-2" aria-label="Page navigation">
    <ul class="pagination">
        @if ($paginator->onFirstPage())
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1">
                    <i class="ci-arrow-left me-2"></i>
                    <span class="d-none d-sm-inline">Previous</span>
                </a>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}">
                    <i class="ci-arrow-left me-2"></i>
                    <span class="d-none d-sm-inline">Previous</span>
                </a>
            </li>
        @endif
    </ul>
    <ul class="pagination">  
        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="page-item disabled">{{ $element }}</li>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active">
                            <a class="page-link">{{ $page }}</a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach
    </ul>
    <ul class="pagination">   
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">
                    <span class="d-none d-sm-inline">Next</span>
                    <i class="ci-arrow-right ms-2"></i>
                </a>
            </li>
        @else
            <li class="page-item disabled">
                <a class="page-link" href="#">
                    <span class="d-none d-sm-inline">Next</span>
                    <i class="ci-arrow-right ms-2"></i>
                </a>
            </li>
        @endif
    </ul>
@endif