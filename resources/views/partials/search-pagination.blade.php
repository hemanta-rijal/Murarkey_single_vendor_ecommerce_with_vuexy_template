<div class="tab_filter_box m-t-20 bottom_bar">
    <div class="row">
        <div class="col-md-4">
            @php
                $perPage = request()->get('per_page') ? request()->get('per_page') : 20;
            @endphp
            <p>Show:
                <span {!! $perPage == 20 ? 'class="active"' : '' !!}><a
                            href="?{!! http_build_query(array_merge(request()->only('category', 'search'), ['per_page' => 20])) !!}">20</a></span>
                |
                <span {!! $perPage == 38 ? 'class="active"' : '' !!}><a
                            href="?{!! http_build_query(array_merge(request()->only('category', 'search'), ['per_page' => 38])) !!}">38</a></span>
                |
                <span {!! $perPage == 50 ? 'class="active"' : '' !!}><a
                            href="?{!! http_build_query(array_merge(request()->only('category', 'search'), ['per_page' => 50])) !!}">50</a></span>
            </p>
        </div>
        <div class="col-md-4">
            <ul class="pagination pagination-sm m-0">

                @if ($paginator->onFirstPage())
                    <li class="disabled"><a href="#"><i class="fa fa-angle-left"></i><span
                                    class="sr-only">Previous</span></a></li>
                @else
                    <li><a href="{{ $paginator->previousPageUrl() }}"><i class="fa fa-angle-left"></i><span
                                    class="sr-only">Previous</span></a></li>
                @endif


                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="disabled"><span>{{ $element }}</span></li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if($page != 0 )
                                @if ($page == $paginator->currentPage())
                                    <li class="active"><span>{{ $page }}</span></li>
                                @else
                                    <li><a href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endif
                        @endforeach
                    @endif
                @endforeach

                @if ($paginator->hasMorePages())
                    <li><a href="{{ $paginator->nextPageUrl() }}">Next<span class="sr-only">Next</span></a></li>
                @else
                    <li class="disabled"><a href="#">Next<span class="sr-only">Next</span></a></li>
                @endif
            </ul>
        </div>

        <div class="col-md-4">
            <div class="min_order pull-right">
                <p class="m-r-10">Go to Page</p>
                <form class="flex-start">
                    @foreach(request()->except('page') as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach
                    <input type="text" name="page" id="input"
                           class="form-control small_height_width" value=""
                           required="required" title="">

                    <button type="submit" class="btn fix_this_go">Go</button>
                </form>
            </div>
        </div>

    </div>
</div>
