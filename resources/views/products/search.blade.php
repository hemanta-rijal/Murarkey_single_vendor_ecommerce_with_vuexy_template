@extends('layouts.search')

@section('title')

    @if (request('search'))
        {{ request('search') }} - Find it on Kabmart
    @elseif (request('category'))
        {{ $categoryPage->name }} - Online Shopping Store in Nepal Kabmart.com
    @endif
@endsection

@section('sub-content')
    <div class="filter-col p-3">
        <div class="row">
            <div class="col-auto mr-auto">
                <h6 class="head">{{ $categoryPage ? $categoryPage->name : ''}}
                    <p class="pb-3">
                        {{ $products->count() }} items found
                        {{--  for <a href="">"Samsung"</a> in Mobiles & Tablets  --}}
                    </p>

            </div>

            <div class="col-auto">
                <form class="d-inline mr-3">
                    <label for="sort">Sort by:</label>
                    <select name="shortBy" id="shortBy" onchange="getShortByValue();">
                        <option value="best" {{ !request('order_by') ? 'selected' : '' }}>
                            <a href="?{{ http_build_query(request()->except('page', 'order_by')) }}">Best Match</a>
                        </option>
                        <option value="recently_added" {{ !request('order_by')=='recently_added' ? 'selected' : '' }}>
                            <a href="?{{ http_build_query(array_merge(request()->except('page', 'order_by'), ['order_by' => 'recently_added'])) }}">Recently
                                Added</a>
                        </option>
                        <option value="lowest_price" {{ !request('order_by')=='lowest_price' ? 'selected' : '' }}>
                            <a href="?{{ http_build_query(array_merge(request()->except('page', 'order_by'), ['order_by' => 'lowest_price'])) }}">Lowest
                                Price</a>
                        </option>
                        <option value="highest_price" {{ !request('order_by')=='highest_price' ? 'selected' : '' }}>
                            <a href="?{{ http_build_query(array_merge(request()->except('page', 'order_by'), ['order_by' => 'highest_price'])) }}">Highest
                                Price</a>
                        </option>
                    </select>
                </form>
            </div>
            <span>View By:</span>
            <nav class="d-inline">
                <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-grid-tab" data-toggle="tab" href="#nav-grid" role="tab"
                       aria-controls="nav-grid" aria-selected="true"><i class="fas fa-th-large"></i></a>
                    <a class="nav-item nav-link" id="nav-list-tab" data-toggle="tab" href="#nav-list" role="tab"
                       aria-controls="nav-list" aria-selected="false"><i class="fas fa-list"></i></a>

                </div>
            </nav>

        </div>
        <span class="mt-2">Filter By:
            @foreach(request()->except('page') as $key => $value)
                <span class="filter-group">
                    {{ $key }} :
                    {{$value }}
                    <span class="times">
                    <a href="?{!! http_build_query(request()->except($key) )!!}">&times </a>
                    </span>
                </span>
            @endforeach
        </span>

        {{--  <div>
            @if(request()->get('category') )
            <a href="?{!! http_build_query(request()->except('category')) !!}" class="clear">Clear all category filter</a>
            @endif
        </div>  --}}
    </div>



    @if($products->count()>0)
        <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
            <div class="tab-pane product-item fade show active" id="nav-grid" role="tabpanel"
                 aria-labelledby="nav-grid-tab">
                @foreach ($products->chunk(4) as $productList)
                    <div class="product-item">
                        <div class="row py-5 px-3">
                            @foreach ($productList as $product)
                                <div class="col-3">
                                    <a href="{{ route('products.show', $product->slug) }}">
                                        <img src="{{resize_image_url($product->images->first()->image, '600X600')}}"
                                             alt="{{$product->name}}"/>
                                    </a>
                                    <div class="item-details">
                                        <h6>{{str_limit($product->name, 30)}}</h6>
                                        <p class="price">Rs. {{$product->price}}</p>
                                        <div class="d-inline product-rating">
                                            <i class="fa fa-star checked"></i>
                                            <i class="fa fa-star checked"></i>
                                            <i class="fa fa-star checked"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <span>(5)</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif


    {{-- {!! $products->appends(request()->all())->links('partials.search-pagination') !!} --}}
    <script>
        function getShortByValue() {
            var selectedValue = document.getElementById("shortBy").value;
            window.location.href = window.location.href + '&order_by=' + selectedValue;
        }

        $(document).ready(function () {
            $('#shortBy').change(function () {
                console.log('hey');
            });
        });
    </script>
@endsection
{{-- @section('scripts')
    <script>
        $(document).ready(function(){
            $('#sort').change(function(){
                console.log("hey"+$(this).val())
                window.location.href = window.location.href + '?'+ http_build_query(array_merge(request()->except('page', 'order_by'), ['order_by' => $(this).val() ]));
            });
        });
    </script>
@endsection --}}