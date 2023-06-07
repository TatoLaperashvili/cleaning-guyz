@if ($paginator->hasPages())
@if ($paginator->onFirstPage())
<li class="disabled"><span>&laquo;</span></li>
  @else
<a class="pagination-prew" href="{{ $paginator->previousPageUrl() }}">Prew</a>
@endif
<a class="pagination-next" href="{{ $paginator->nextPageUrl() }}">next</a>
@endif
