@extends('layouts.search')

@section('title')

    @if (request('search'))
        {{ request('search') }} - Find it on Kabmart
    @elseif (request('category'))
        {{ $categoryPage->name }} - Online Shopping Store in Nepal Kabmart.com
    @endif
@endsection

@section('sub-content')
    <div class="tab_filter_box p-t-25">
        <div class="row">
            <div class="col-md-7">
                <div class="box_one">
                    <p class="p-r-12">Quick Filters: </p>
                    <form class="flex-start">
                        <div class="price_range flex-start">
                            <p class="m-r-10">Price</p>

                            @foreach(request()->except('page') as $key => $value)
                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                            @endforeach
                            <input type="text" name="lower_price" id="input" class="form-control"
                                   value="{{ request('lower_price') }}"
                                   title="">
                            <span class="p-r-4 p-l-4"> - </span>
                            <input type="text" name="upper_price" id="input" class="form-control"
                                   value="{{ request('upper_price') }}"
                                   title="">
                        </div>


                        <button type="submit" class="btn fix_this_go">Go</button>


                    </form>
                </div>
            </div>
            <div class="col-md-5">
                <div class="box_two">
                    <div class="sort_by">
                        <p class="p-r-8">Sort By: </p>
                        <div class="input-group">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-default" tabindex="-1">
                                    {{ get_formated_sort_by(request('order_by')) }}
                                </button>
                                <button type="button" class="btn btn-default dropdown-toggle"
                                        data-toggle="dropdown" tabindex="-1">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li class="{{ !request('order_by') ? 'active' : '' }}"><a
                                                href="?{{ http_build_query(request()->except('page', 'order_by')) }}">Best
                                            Match</a></li>


                                    <li class="{{ request('order_by') == 'highest_price' ? 'active' : '' }}"><a
                                                href="?{{ http_build_query(array_merge(request()->except('page', 'order_by'), ['order_by' => 'recently_added'])) }}">Recently
                                            Added</a></li>

                                    <li class="{{ request('order_by') == 'lowest_price' ? 'active' : '' }}"><a
                                                href="?{{ http_build_query(array_merge(request()->except('page', 'order_by'), ['order_by' => 'lowest_price'])) }}">Lowest
                                            Price</a></li>
                                    <li class="{{ request('order_by') == 'highest_price' ? 'active' : '' }}"><a
                                                href="?{{ http_build_query(array_merge(request()->except('page', 'order_by'), ['order_by' => 'highest_price'])) }}">Highest
                                            Price</a></li>


                                </ul>
                            </div>
                        </div>


                    </div>
                    <div class="view_as">
                        <p class="p-l-25 p-r-8">View as: </p>
                        <a href="#" id="pum_list" class="m-r-8 mswitch p_list"><span
                                    class="glyphicon glyphicon-th-list"></span></a>
                        <a href="#" id="pum_grid" class="mswitch p_grid"><span
                                    class="glyphicon glyphicon-th"></span></a>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @if($products->count() > 0)
        <div class="tab_filter_box m-t-8 gridwala no_border {{ request('view_type') == 'list' ? 'no_display' : '' }} p-0"
             id="gridwala">
            <section id="custom_grid" class="m-b-0 hidden-xs">

                @foreach($products->chunk(4) as $productList)

                    <div class="row {{ !$loop->first ? 'm-t-8' : '' }}">
                        @foreach($productList as $product)
                            <div class="col-md-3 col-sm-4 col-xs-6">
                                <div class="feat_compo newly_added no_border p-0">

                                    <div class="product-item">
                                        <div class="feat_compo_a">
                                            <div class="feat_item" style="">

                                                <div class="dreamz-team">
                                                    <div class="pic">

                                                        <a href="{{ route('products.show', $product->slug) }}"><img
                                                                    src="{{ resize_image_url($product->images->first()->image, '200X200') }}"
                                                                    alt=""
                                                                    class="img-responsive">
                                                            @if($product->discount_rates)
                                                                <div class="discount-label discount-label-xs orangetag">
                                                          <span>-{{ ceil((1 - ($product->discount_rates/ $product->price)) * 100) }}
                                                          %</span></div>
                                                            @endif
                                                        </a>
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
                                                    <a href="{{ route('products.show', $product->slug) }}">
                                                        <h4>{{ str_limit($product->name,16) }}</h4>
                                                    </a>
                                                <!--           <p class="m-b-0 p-b-0">Rs. {{ $product->price }}
                                                        </p> -->

                                                    @if($product->discount_rates || $product->has_discount)
                                                        <div>
                                                            <span class="sale">SALE</span>
                                                            <span class="spcolor f-s-16 display-total">Rs{{ $product->discount_price  }}</span>
                                                            <strike>{{ $product->price }}</strike>
                                                        </div>
                                                    @else
                                                        <span class="spcolor f-s-16 display-total">
                                                        Rs {{ $product->price }}</span>
                                                @endif

                                                <!--        <div class="rating">
                                                         <span class="fa fa-star checked"></span>
                                                         <span class="fa fa-star checked"></span>
                                                         <span class="fa fa-star checked"></span>
                                                         <span class="fa fa-star"></span>
                                                         <span class="fa fa-star"></span>
                                                         <span>(1)</span>
                                                     </div> -->

                                                </div>

                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </section>

            <!-- mobile view-->
            <section id="custom_grid" class="m-b-0 hidden-lg">

                @foreach($products->chunk(4) as $productList)

                    <div class="row {{ !$loop->first ? 'm-t-8' : '' }}">
                        @foreach($productList as $product)


                            <div class="product-item col-xs-6">
                                <div class="product">

                                    <div class="dreamz-team">
                                        <div class="pic">
                                            <a href="{{ route('products.show', $product->slug) }}"><img
                                                        src="{{ resize_image_url($product->images->first()->image, '200X200') }}"
                                                        alt="Sunrise"
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
                                    <div class="product-info">
                                        <div class="product-name-twoline">

                                            <a href="{{ route('products.show', $product->slug) }}">
                                                <p class="m-l-5 m-b-0 product-twoline-height p-t-10">{{ str_limit($product->name,44) }}</p>
                                            </a>
                                        </div>
                                    <!--    <p class="m-l-5" style="font-size: 18px;color: orange;">Rs. {{ $product->price }}
                                            </p> -->

                                        @if($product->discount_rates || $product->has_discount)
                                            <div>
                                                <span class="sale">Sale</span>
                                                <span class="spcolor f-s-16 display-total">Rs{{ $product->discount_price  }}</span>
                                                <strike>{{ $product->price }}</strike>
                                            </div>
                                        @else
                                            <span class="spcolor f-s-16 display-total">
                                                        Rs{{ $product->price }}</span>
                                        @endif
                                    </div>
                                </div>


                            </div>


                        @endforeach
                    </div>
                @endforeach
            </section>
        </div>

        <div class="tab_filter_box p-0 listwala {{ request('view_type') !== 'list' ? 'no_display' : '' }}"
             id="listwala">

            @foreach($products as $product)
                <div class="row bottom_border m-0 hover_effect">
                    <div class="col-md-9" style="border-right:1px solid #cecece">
                        <div class="left_block">
                            <a href="{{ route('products.show', $product->slug) }}" class="m-r-15"><img
                                        src="{{ resize_image_url($product->images->first()->image, '200X200') }}"
                                        class="img-responsive pull-left prod_image"
                                        alt="Image"></a>
                            <div class="detailing">
                                <a href="{{ route('products.show', $product->slug) }}">
                                    <h4>{{ str_limit($product->name,120) }}</h4></a>
                                <p class="pcolor p-t-12">Rs. {{ $product->price }}</p>
                                <!--       <div class="rating">
                                       <span class="fa fa-star checked"></span>
                                       <span class="fa fa-star checked"></span>
                                       <span class="fa fa-star checked"></span>
                                       <span class="fa fa-star"></span>
                                       <span class="fa fa-star"></span>
                                       <span>(1)</span>
                                   </div> -->
                                <p class="black m-b-0"><span class="dim">Brand name:</span> {{ $product->brand_name }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="right_block">
                            <a href="{{ route('companies.show', $product->company->slug) }}"><p
                                        class="black heading">{{ $product->company->name }}</p></a>
                            <!--                                               <p class="">City name here, province name here, country name here</p>-->
                            <div class="height_gap"></div>
                            <div class="two_btns">
                                <a href="{{ route('companies.show', $product->company->slug) }}"
                                   class="btn company-btn">Company Page</a>
                                <a href="{{ route('companies.contact', $product->company->slug) }}" class="btn">Contact
                                    Info</a>
                            </div>
                        </div>
                    </div>

                </div>
            @endforeach

        </div>

    @else
        <div class="no_results">
            No results found. Please try your search again
        </div>
    @endif

    {!! $products->appends(request()->all())->links('partials.search-pagination') !!}

@endsection