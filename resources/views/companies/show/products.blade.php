@extends('companies.show.layout')
@section('sub-content')
    <div class="tab_filter_box p-t-25 p-b-50 bg_white">
        <div class="row">
            <div class="col-md-2">
                <section class="filters">
                    <div class="filter-item">
                        <h3 class="p-b-15 f-s-17">All Products</h3>
                        <ul class="list-unstyled p-l-15 all_prod_list">
                            <li><a href="{{ route('companies.products', $company->slug) }}" class="black">All Categories</a></li>
                            @foreach($categories as $category)
                            <li {!! request('category') == $category->slug ? 'class="active"' : '' !!}><a href="?{{ http_build_query(array_merge(request()->except('page'),['category' => $category->slug])) }}">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </section>
            </div>
            <div class="col-md-10">
                <div class="result_status">
                    @if(request('search'))
                        <p class="pull-left"><span class="pcolor">{{ $products->total() }} </span> Matching Products
                            found in all products</p>

                        <p class="pull-right"><a
                                    href="{{ $products->appends(['search' => request('search')])->previousPageUrl() }}"
                                    class="btn m-r-7 dim_border" {{ $products->currentPage() == 1? 'disabled' : ''}}><i
                                        class="fa fa-angle-left"></i></a><a
                                    href="{{ $products->appends(['search' => request('search')])->nextPageUrl() }}"
                                    class="btn m-r-7 dim_border"
                                    {{ $products->hasMorePages()?:'disabled'  }}><i
                                        class="fa fa-angle-right"></i></a>{{ $products->currentPage() }}
                            of {{ $products->lastPage()  }} pages
                        </p>
                    @endif
                    <div class="clearfix"></div>
                </div>
                <div class="col_wid_short">

                    @foreach($products->chunk(4) as $productList)
                        <div class="row">
                            @foreach($productList as $product)
                                <div class="col-md-3">
                                    <div class="feat_compo newly_added">
                                        <div class="">
                                            <div class="feat_compo_a">
                                                <div class="feat_item" style="">

                                                    <div class="dreamz-team">
                                                        <div class="pic">
                                                            <a href="{{ route('products.show', $product->slug) }}"><img
                                                                        src="{{ resize_image_url($product->images->first()->image, '200X200') }}"
                                                                        alt="{{ $product->name }}"
                                                                        class="img-responsive"></a>
                                                            <div class="social_media_team">
                                                                <ul class="team_social">
                                                                    <a href="{{ route('products.show', $product->slug) }}"
                                                                       class="btn btn-danger pcolor_bg">View
                                                                        detail</a>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="feat_item_det">
                                                        <a href="{{ route('products.show', $product->slug) }}"><h4>{{ str_limit($product->name,85) }}</h4></a>
                                                        <p >Rs. {{ $product->price }} / {{ $product->unit_type }}
                                                            <br>
                                                            {{ $product->unit_type }}</p>
                                                    </div>
                                                             <div class="rating">
                                         <span class="fa fa-star checked"></span>
                                         <span class="fa fa-star checked"></span>
                                         <span class="fa fa-star checked"></span>
                                         <span class="fa fa-star"></span>
                                         <span class="fa fa-star"></span>
                                         <span>(1)</span>
                                     </div>

                                                </div>
                                            </div>


                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
                {!! $products->appends(['search' => request('search')])->links('partials.search-pagination') !!}
            </div>
        </div>

    </div>
@endsection