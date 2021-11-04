@extends('layouts.app')
@section('styles')
    <style>


        /* shop by category */
        .category-toggle {
            -moz-border-radius-bottomleft: 0;
            -webkit-border-bottom-left-radius: 0;
            border-bottom-left-radius: 0;
            -moz-border-radius-bottomright: 0;
            -webkit-border-bottom-right-radius: 0;
            border-bottom-right-radius: 0;
            border: 1px solid transparent;
            font-size: 13px;
            font-weight: 800;
            background-color: #fff;
        }

        .category-toggle:hover + .category-nav {
            display: block;
        }

        .navbar-nav > li > .category-toggle {
            padding: 7px 10px 7px 0px;
        }

        .shop-by-category.open {
            border-bottom: 1px solid #DDD;
        }

        .shop-by-category.open .category-toggle {
            border-top: 1px solid #DDD;
            border-left: 1px solid #DDD;
            border-right: 1px solid #DDD;
        }

        .nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
            border-bottom: inherit;
        }

        #company_pro_photo1 {
            height: 100px;
            width: 100px;
            border-radius: 50px;
            float: left;
            overflow: hidden;
        }

        .profile-pic-div-width {
            width: 410px;
        }

        .custom-img-circle {
            border-radius: 50%;
        }

        @media only screen and (max-width: 992px) {
            .carousel-inner > .item > img, .carousel-inner > .item > a > img {
                height: 140px !important;
                object-fit: cover !important;
            }
        }

        .product-carousel .product-item {
            padding: 0px;
            height: 90px;
        }

        .slider {
            overflow: hidden;
        }


    </style>
@endsection

@section('content')
    <!-- logo, search, myaccount -->
    @include('partials.header')
    <!-- logo, search, myaccount -->

    <section id="pum_categ_drop" class="m-b-0">

        <div class="shop-header">
            <div class="bottom-header">
                <div class="container">
                    <div class="row">

                        <div class="col-md-2 hidden-xs">
                            @include('partials.new-categories-layout')

                        </div>

                    </div>

                </div>
            </div>

        </div>

    </section>




    <!--banner container-->
    <div class="slider">

        <div class="row">
            <div class="col-md-12 p-0">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        @foreach(get_slides() as $index => $slide)
                            <div class="item {{  $index == 0 ? 'active' : ''}}">
                                <a href="{{ $slide->link }}">
                                    <img src="{{ map_storage_path_to_link($slide->image) }}"
                                         alt="{{ $slide->caption }}"
                                         style="height: 350px;object-fit: cover;">
                                </a>
                            </div>
                        @endforeach
                    </div>
                    @if(get_slides()->count() > 1)
                        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev"><i
                                    class="fa fa-angle-left"></i></a>
                        <a class="right carousel-control" href="#carousel-example-generic"
                           data-slide="next"><i
                                    class="fa fa-angle-right"></i></a>

                    @endif

                </div>
            </div>
        <!--     <div class="col-md-3 pad_fix_respond hidden-xs hidden-sm p-0">
                            <div class="side_banner">
                                <div class="col-md-12 col-sm-6 side_1">
                                    @if(get_banner_by_slug('homepage-1'))
            <a href="{{ get_banner_by_slug('homepage-1')->link }}">
                                            <img class="img-responsive"
                                                 src="{!! get_banner_by_slug('homepage-1')->image_url !!}"
                                                 alt="" style="height: 210px;object-fit: cover;">
                                        </a>
                                    @endif

                </div>
                <div class="col-md-12 col-sm-6 side_2 m-t-10">
@if(get_banner_by_slug('homepage-2'))
            <a href="{{ get_banner_by_slug('homepage-2')->link }}">
                                            <img class="img-responsive"
                                                 src="{!! get_banner_by_slug('homepage-2')->image_url !!}"
                                                 alt="" style="height: 210px;object-fit: cover;">
                                        </a>
                                    @endif

                </div>
            </div>
            <div class="clearfix"></div>
        </div> -->
        </div>
    </div>

    <!--banner container-->

    <!-- MAIN -->
    <div class="shop-main">
        <div class="container">

            <div class="row" id="main-cat-desktop">
                <div class="product-carousel">
                    @foreach(get_root_categories() as $category)
                        <div class="product-item">

                            <a href="/products/search?category={{ $category->slug }}">
                                <div class="homebutton">
                                    <div class="home-img">
                                        <img src="{{ resize_image_url($category->image_path, '200X200') }}">
                                        <div class="home-btn-txt ">
                                            {{ $category->name }}
                                        </div>
                                    </div>
                                </div>
                            </a>

                        </div>
                    @endforeach
                </div>
            </div>

            <div class="row " id="main-cat-mobile">

                @foreach(get_root_categories() as $category)

                    <div class="col-xs-15 col m-b-40">

                        <div class="homebutton">
                            <div class="home-img">

                                <div class="circle">
                                    <a href="/products/search?category={{ $category->slug }}">
                                        <img src="{{ resize_image_url($category->image_path, '200X200') }}">
                                        <div class="home-btn-txt">
                                            <p class="text-center m-t-5">{{ \Illuminate\Support\Str::limit($category->name , 5) }}</p>

                                        </div>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>

                @endforeach

            </div>


            @isset ($flashSales)
                @foreach($flashSales as $flashSale)

                    <div class="section">
                        <h3 class="compo_section_title" style="display: inline-block;">{{ $flashSale->title }}</h3>
                        <span class="pull-right"><a href="/flash-sales" class="shopmore">Shop More</a></span>
                        <span class="pull-right"></span>
                        <div class="col-md-12 salescounter m-t-5">
                            <div class="clockdiv" id="clockdiv-{{ $flashSale->id }}">
                                <div>
                                    <span class="days"></span>
                                    <div class="smalltext">Days</div>
                                </div>
                                <div>
                                    <span class="hours"></span>
                                    <div class="smalltext">Hours</div>
                                </div>
                                <div>
                                    <span class="minutes"></span>
                                    <div class="smalltext">Minutes</div>
                                </div>
                                <div>
                                    <span class="seconds"></span>
                                    <div class="smalltext">Seconds</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 " style="background-color: white;">

                            @foreach($flashSale->items->count() > 6 ? $flashSale->items->take(6) : $flashSale->items  as $item)
                                <div class="product-item col-md-2 col-xs-3 flashsales-lg">
                                    <div class="product">
                                        <div class="product-image">
                                            <a href="{{ route('products.show', $item->product->slug) }}"> <img
                                                        src="{{ resize_image_url($item->product->images->first()->image, '200X200') }}"
                                                        alt="Sunrise"
                                                        style="height: 180px;width: 180px;object-fit: cover;"></a>
                                        </div>

                                        <div class="product-info" style="background: white;width:180px;height:48px;">
                                            <a href="{{ route('products.show', $item->product->slug) }}">
                                                <p style="margin-left:5px;padding:5px;line-height: 16px;">{{ \Illuminate\Support\Str::limit($item->product->name , 44) }}</p>
                                            </a>
                                        </div>
                                        <p class="m-l-5 m-b-0 productprice">
                                            Rs. {{ $item->product->discount_price }} </p>
                                        <p class="m-l-5"><span
                                                    class="m-r-10 productdiscountprice"><strike>Rs. {{ $item->product->price }}</strike></span>- {{ $item->product->discount_percentage }}
                                            %
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div>
                            @if ($flashSale->items->count() > 3)
                                <div class="product-item  flashsales-xs">
                                    <div class="col-xs-7 p-2">
                                        <div class="product">
                                            <a href="{{ route('products.show', $flashSale->items->first()->product->slug) }}">
                                                <div class="product-image1">

                                                    <img src="{{ resize_image_url($flashSale->items->first()->product->images->first()->image, '200X200') }}"
                                                         class="img img-responsive">
                                                </div>

                                                <p class="m-l-5 m-b-0 productprice">
                                                    Rs. {{ $flashSale->items->first()->product->discount_price }} </p>
                                                <p class="m-l-5"><span
                                                            class="m-r-10 productdiscountprice"><strike>Rs. {{ $flashSale->items->first()->product->price }}</strike></span>- {{ $flashSale->items->first()->product->discount_percentage }}
                                                    %
                                                </p>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-xs-5 p-2">

                                        @foreach($flashSale->items->splice(1, 3) as $item)
                                            <div class="product m-b-5">
                                                <div>
                                                    <div class="product-image1">
                                                        <a href="{{ route('products.show', $item->product->slug) }}">
                                                            <img src="{{ resize_image_url($item->product->images->first()->image, '200X200') }}"
                                                                 style="height: 60px;width: 60px;object-fit: cover;">
                                                            <div style="display: inline-block;">
                                                                <p class="m-l-5 m-b-0 productprice">
                                                                    Rs. {{ $item->product->discount_price }} </p>
                                                                <p class="m-l-5"><span
                                                                            class="m-r-10 productdiscountprice"><strike>Rs. {{ $item->product->price }}</strike></span><br>- {{ $item->product->discount_percentage }}
                                                                    %
                                                                </p>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endisset
            <div class="row hidden-md hidden-lg">
                @if(get_banner_by_slug('homepage-1'))
                    <a href="{{ get_banner_by_slug('homepage-1')->link }}">
                        <img class="img-responsive"
                             src="{!! get_banner_by_slug('homepage-1')->image_url !!}"
                             alt="">
                    </a>
                @endif
            </div>

            @isset($auctionSaleComingSoon)
                @php
                    $auctionSaleComingSoon = get_coming_soon_auction_sales(6)
                @endphp

                @if ($auctionSaleComingSoon->count() > 0)

                <!-- auction sales desktop -->
                    <div class="section hide " id="auction-desktop">
                        <div>
                            <h3 class="compo_section_title" style="display: inline-block;">Auction Sales Comming
                                Soon</h3>
                            <span class="pull-right">
                            <a href="/auction-sales/coming-soon" class="shopmore">Shop More</a>
                        </span>
                        </div>
                        <div class="">
                            @foreach($auctionSaleComingSoon as $product)
                                <div class="product-item col-md-2 col-xs-4 ">
                                    <div class="product auction">
                                        <div class="auction-image">
                                            <a href="{{ route('products.show', $product->slug) }}"> <img
                                                        src="{{ resize_image_url($product->images->first()->image, '200X200') }}"
                                                        alt="{{ \Illuminate\Support\Str::limit($product->name , 40) }}"
                                                        style="height: 180px;width: 180px;object-fit: cover;"></a>
                                        </div>
                                        <div class="product-info" style="background: white;width:180px;">
                                            <div class="product-name-twoline">
                                                <a href="{{ route('products.show', $product->slug) }}">

                                                    <p class="m-l-5 m-b-0 product-twoline-height p-t-10 ">
                                                        {{ \Illuminate\Support\Str::limit($product->name , 30) }}
                                                    </p>
                                                </a>
                                            </div>

                                            <span class="spcolor f-s-16 display-total">
                                        Rs ?????</span>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="clearfix"></div>

                @endif
            @endisset

            @isset($auctionSalesRunning)

                @php
                    $auctionSalesRunning = get_running_auction_sales(6)
                @endphp




                @if ($auctionSalesRunning->count() > 0)

                    <div class="section " id="auction-desktop">
                        <h3 class="compo_section_title" style="display: inline-block;">Auction Sales</h3>
                        <span class="pull-right">
                        <a href="/auction-sales/running" class="shopmore">Shop More</a>
                    </span>
                        <div class="">
                            @foreach($auctionSalesRunning as $product)
                                <div class="product-item col-md-2 col-xs-4 ">
                                    <div class="product auction">
                                        <div class="auction-image">
                                            <a href="{{ route('products.show', $product->slug) }}"> <img
                                                        src="{{ resize_image_url($product->images->first()->image, '200X200') }}"
                                                        alt="{{ \Illuminate\Support\Str::limit($product->name , 40) }}"
                                                        style="height: 180px;width: 180px;object-fit: cover;"></a>
                                        </div>
                                        <div class="product-info" style="background: white;width:180px;">
                                            <div class="product-name-twoline">
                                                <a href="{{ route('products.show', $product->slug) }}">

                                                    <p class="m-l-5 m-b-0 product-twoline-height p-t-10 ">
                                                        {{ \Illuminate\Support\Str::limit($product->name , 40) }}
                                                    </p>
                                                </a>
                                            </div>

                                            <span class="spcolor f-s-16 display-total">
                                    Rs ?????</span>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="clearfix"></div>

                @endif

            @endisset

            <div class="section m-t-25" id="newarrival-desktop">
                <h3 class="compo_section_title" style="display: inline-block;">New Arrival</h3>
                <span class="pull-right"><a href="{{ route('products.search', ['order_by' => 'recently_added']) }}"
                                            class="shopmore">Shop More</a></span>
                <div class="">
                    @foreach(get_recently_added_products_for_homepage(6) as $product)
                        <div class="product-item col-md-2 col-xs-3">
                            <div class="product">
                                <div class="product-image">
                                    <a href="{{ route('products.show', $product->slug) }}"> <img
                                                src="{{ resize_image_url($product->images->first()->image, '200X200') }}"
                                                alt="Sunrise" style="height: 180px;width: 180px;object-fit: cover;"></a>

                                </div>

                                <div class="product-info" style="background: white;width:180px;height:48px;">
                                    <a href="{{ route('products.show', $product->slug) }}">
                                        <p style="margin-left:5px;padding:5px;line-height: 16px;">{{ \Illuminate\Support\Str::limit($product->name , 40) }}</p>
                                    </a>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>


            <div class="components p-b-0 m-b-15">
                <div class="row">

                    <div class="col-md-12">
                        <h3 class="compo_section_title">Look into</h3>

                        @foreach(get_categories_for_showcase_women(16) as $category)
                            <div class="col-md-8s col-xs-4 cat-mobile">
                                <a href="/products/search?category={{ $category->slug }}">
                                    <img src="{{ resize_image_url($category->image_path, '200X200') }}"
                                         class="img-responsive " alt="Image">
                                    <p class="compo_title">
                                        {{ \Illuminate\Support\Str::limit($category->name , 14) }}

                                    </p>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>


            <div class="clearfix"></div>

            <div class="section" id="below-desktop">
                <h3 class="compo_section_title" style="display: inline-block;">Products Below 1500</h3>
                <span class="pull-right"><a href="{{ route('products.search', ['upper_price' => 1500]) }}"
                                            class="shopmore">Shop More</a></span>
                <div>
                    @foreach(get_random_below_1500_products(12) as $product)
                        <div class="product-item col-md-2 col-xs-3">
                            <div class="product">
                                <div class="product-image">
                                    <a href="{{ route('products.show', $product->slug) }}"><img
                                                src="{{ resize_image_url($product->images->first()->image, '200X200') }}"
                                                alt="Sunrise" style="height: 180px;width: 180px;object-fit: cover;"></a>
                                    <div class="social_media_team">
                                        <ul class="team_social">
                                            <a href="{{ route('products.show', $product->slug) }}"
                                               class="btn btn-danger pcolor_bg">View detail</a>
                                        </ul>
                                    </div>
                                </div>

                                <div class="product-info" style="width: 180px;background: white;">
                                    <a href="{{ route('products.show', $product->slug) }}">
                                        <p style="margin-left:5px;padding:5px;">{{ \Illuminate\Support\Str::limit($product->name , 17) }}</p>
                                    </a>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>


            <div class="clearfix"></div>
            <div class="section " id="maylike-desktop">
                <h3 class="compo_section_title">Products You May Like</h3>
                <div class="">
                    @foreach(get_random_for_homepage(60) as $product)
                        <div class="product-item col-md-2 col-xs-6 ">
                            <div class="product">
                                <div class="product-image">
                                    <a href="{{ route('products.show', $product->slug) }}"> <img
                                                src="{{ resize_image_url($product->images->first()->image, '200X200') }}"
                                                alt="Sunrise" style="height: 180px;width: 180px;object-fit: cover;"></a>
                                    @if($product->a_discount_price)
                                        <div class="discount-label orangetag discount-label-home">
                                            <span>-{{ ceil((1 - ($product->a_discount_price/ $product->price)) * 100) }}
                                                %</span></div>
                                    @endif
                                    <div class="social_media_team">
                                        <ul class="team_social">
                                            <a href="{{ route('products.show', $product->slug) }}"
                                               class="btn btn-danger pcolor_bg">View detail</a>
                                        </ul>
                                    </div>
                                </div>

                                <div class="product-info" style="background: white;width:180px;">
                                    <div class="product-name-twoline">
                                        <a href="{{ route('products.show', $product->slug) }}">

                                            <p class="m-l-5 m-b-0 product-twoline-height p-t-10 ">
                                                {{ \Illuminate\Support\Str::limit($product->name , 40) }}
                                            </p>
                                        </a>
                                    </div>
                                    @if($product->a_discount_price || $product->has_discount)
                                        <div>
                                            <span class="sale">SALE</span>
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
            </div>


            <div class="clearfix"></div>

            <div class="row m-t-15  " id="newarrival-mobile" style="background-color: #e91e63;">
                <h3 class="compo_section_title  white m-15" style="display: inline-block;">New Arrival</h3>
                <span class="pull-right  m-15"
                      style="font-size:12px;border:1px solid white;border-radius:12px;padding:5px;"><a
                            href="{{ route('products.search', ['order_by' => 'recently_added']) }}" class="white">Shop More</a></span>
                <div class="container" style="background-color: white;margin:8px;border-radius:10px;">

                    @foreach(get_recently_added_products_for_homepage(12) as $product)
                        <div class="product-item col-xs-3 col-sm-2">
                            <div class="product">
                                <div class="product-image">
                                    <a href="{{ route('products.show', $product->slug) }}"> <img
                                                src="{{ resize_image_url($product->images->first()->image, '200X200') }}"
                                                alt=""></a>

                                </div>

                                <div class="product-info">
                                    <a href="{{ route('products.show', $product->slug) }}">
                                        <p style="margin-left:2px;padding:2px;margin:0;">{{ \Illuminate\Support\Str::limit($product->name , 10) }}</p>
                                    </a>
                                </div>

                            </div>
                        </div>
                    @endforeach

                </div>
            </div>


            <div class="components-mobile p-b-0 ">
                <div class="row">

                    <div class="col-md-12">
                        <h3 class="compo_section_title">Look into </h3>
                        <div class="product-carousel">
                            @foreach(get_categories_for_showcase_women(16) as $category)
                                <div class="product-item">
                                    <div class="col-xs-15 col-sm-2">
                                        <div class="homebutton">
                                            <div class="home-img">

                                                <div class="circle">
                                                    <a href="/products/search?category={{ $category->slug }}">
                                                        <img src="{{ resize_image_url($category->image_path, '200X200') }}">
                                                        <div class="home-btn-txt">
                                                            <p class="text-center m-t-5"
                                                               style="font-size:10px;">{{ \Illuminate\Support\Str::limit($category->name , 8) }}</p>

                                                        </div>
                                                    </a>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>


                            @endforeach
                        </div>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>


            <div class="section" id="below-mobile">

                <div class="row" style="background-color: #9c27b0;">
                    <h3 class="compo_section_title white m-15" style="display: inline-block;">Products Below
                        1500</h3>
                    <span class="pull-right  m-15" style="font-size:12px;"><a
                                href="{{ route('products.search', ['upper_price' => 1500]) }}" class="white"
                                style="font-size:12px;border:1px solid white;border-radius:12px;padding:5px;">Shop More</a></span>
                    <div class="container" style="background-color: white;margin:8px;border-radius:10px;">

                        @foreach(get_random_below_1500_products(12) as $product)
                            <div class="product-item col-md-2 col-xs-3 col-sm-2">
                                <div class="product">
                                    <div class="product-image">
                                        <a href="{{ route('products.show', $product->slug) }}"> <img
                                                    src="{{ resize_image_url($product->images->first()->image, '200X200') }}"
                                                    alt="Sunrise"
                                                    style="height: 180px;width: 180px;object-fit: cover;"></a>
                                        <div class="social_media_team">
                                            <ul class="team_social">
                                                <a href="{{ route('products.show', $product->slug) }}"
                                                   class="btn btn-danger pcolor_bg">View detail</a>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="product-info" style="width: 70px;background: white;">
                                        <a href="{{ route('products.show', $product->slug) }}">
                                            <p style="padding-left:2px;padding:2px;margin:0;">{{ \Illuminate\Support\Str::limit($product->name , 10) }}</p>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
                <div calss="clearfix"></div>
            </div>

            <div class="row hidden-md hidden-lg">
                @if(get_banner_by_slug('homepage-2'))
                    <a href="{{ get_banner_by_slug('homepage-2')->link }}">
                        <img class="img-responsive"
                             src="{!! get_banner_by_slug('homepage-2')->image_url !!}" alt="">
                    </a>
                @endif
            </div>


            <div class="section " id="maylike-mobile">
                <h3 class="compo_section_title">Products You May Like</h3>

            @foreach(get_random_for_homepage(300) as $product)
                <!--    <div class="product-item col-md-2 col-xs-6 col-sm-3">
                        <div class="product" align="center">
                            <div class="product-image-maylike">
                                <a href="{{ route('products.show', $product->slug) }}"> <img
                                            src="{{ resize_image_url($product->images->first()->image, '200X200') }}" class="img img-responsive"
                                            alt="" style="height: 160px;width: 160px;object-fit: cover;"></a>
                            </div>

                            <div class="product-info" style="background: white;width:160px;">
                                <div class="product-name-twoline">
                                    <a href="{{ route('products.show', $product->slug) }}">
                                        <p class="m-l-5 m-b-0 product-twoline-height p-t-10">{{ \Illuminate\Support\Str::limit($product->name , 44) }}</p>
                                    </a>
                                </div>
                                <p class="m-l-5" style="font-size: 18px;color: orange;text-align: left;">Rs. {{ $product->price }} </p>

                            </div>

                        </div>
                    </div> -->
                    <div class="product-item col-xs-6">
                        <div class="product">

                            <div class="dreamz-team">
                                <div class="pic">
                                    <a href="{{ route('products.show', $product->slug) }}"><img
                                                src="{{ resize_image_url($product->images->first()->image, '200X200') }}"
                                                alt="" class="img-responsive"></a>
                                    @if($product->a_discount_price)
                                        <div class="discount-label discount-label-xs orangetag">
                                            <span>-{{ ceil((1 - ($product->a_discount_price/ $product->price)) * 100) }}
                                                %</span></div>
                                    @endif

                                </div>
                            </div>
                            <div class="product-info p-1" style="background: white;">
                                <div class="product-name-twoline">
                                    <a href="{{ route('products.show', $product->slug) }}">

                                        <p class="m-l-5 m-b-0 product-twoline-height p-t-10">
                                            {{ \Illuminate\Support\Str::limit($product->name,44) }}</p>
                                    </a>
                                </div>

                                @if($product->a_discount_price || $product->has_discount)
                                    <div>
                                        <span class="sale">SALE</span>
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
        </div>
    </div>
    <!-- END MAIN -->
    @if(auth()->check())
        <div id="app">
            <chat-app :chat_data="chatAppData"></chat-app>
        </div>
        <audio id="message-notification" src="/assets/sounds/message-beep.mp3" autostart="false"></audio>
    @endif

    <!--     <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true"  id="onload">

    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="padding: 0px;border-bottom: 0px;">
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        <div class="modal-body">
        <img src="/assets/img/notice.png" class="img img-responsive"/>
        </div>
     
      </div>

    </div>
    </div> -->

@endsection

@section('scripts')
    @include('partials.chat-box-scripts')
    <script src="/assets/js/deadline.js"></script>

    @isset($flashSales)
        @foreach($flashSales as $flashSale)
            <script>
                $(document).ready(function () {
                    var deadline = new Date({{ $flashSale->end_time->timestamp * 1000 }});
                    initializeClock('clockdiv-{{ $flashSale->id }}', deadline);
                })
            </script>
        @endforeach
    @endisset
    <!--     <script>
        $(window).load(function () {
            $('#onload').modal('show');
        });
    </script> -->
@endsection




