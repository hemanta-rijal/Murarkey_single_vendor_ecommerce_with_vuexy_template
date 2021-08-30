<style>
    .pagination{
        margin-top: 10px !important;
    }
</style>
  @if ($paginator->lastPage() > 1)
  <nav aria-label="Page navigation" class="pagination">
    <ul class="pagination">
    <li class="page-item">
        <a class="page-link" href="{{ $paginator->url(1) }}" aria-label="Previous">
        <i class="fa fa-chevron-left"></i>
        <span class="sr-only">Previous</span>
        </a>
    </li>
     @for ($i = 1; $i <= $paginator->lastPage(); $i++)
        <li class="page-item {{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
            <a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a>
        </li>
        @endfor
        {{-- <li class="page-item active"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item"><a class="page-link" href="#">4</a></li>
    <li class="page-item"><a class="page-link" href="#">5</a></li>
    <li class="page-item"><a class="page-link" href="#">6</a></li> --}}
    @if($paginator->currentPage() == $paginator->lastPage())
    <li class="page-item">
        <a class="page-link" href="{{ $paginator->url($paginator->currentPage()+1) }}" aria-label="Next">
        <i class="fa fa-chevron-right"></i>
        <span class="sr-only">Next</span>
        </a>
    </li>
    @endif
    </ul>
</nav>
@endif