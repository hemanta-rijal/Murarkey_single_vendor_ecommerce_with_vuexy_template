@extends('layouts.app')


@section('title')
    {{ $product->name }} On yeecomart.com
@endsection

@section('metas')
    <meta property="og:title" content="{{ $product->name }}">
    <meta name="og:description" content="{{ $product->description }}">
    <meta property="og:type" content="product"/>
    <meta property="og:image" content="{{ resize_image_url($product->images->first()->image,'600X600')  }}"/>
    <meta property="og:image:width" content="600"/>
    <meta property="og:image:height" content="600"/>
    <meta property="og:site_name" content="{{ $product->name. ' | '. get_meta_by_key('site_name') }}"/>
    <meta property="og:url" content="{{ route('products.show', $product->slug)}}"/>
    <meta property="amount" content="{{ $product->price }}"/>
    <meta property="og:price:standard_amount" content="{{ $product->price }}"/>
    <meta property="fb:app_id" content="{{ config('services.facebook.client_id') }}">


@endsection

@section('styles')

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css"/>

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

        .qty {
            width: 75px;
            height: 25px;
            text-align: center;
            border: 1px solid #cecece;
        }

        input.qtyplus {
            width: 25px;
            height: 25px;
            background: #fff;
            border: 1px solid #cecece;
        }

        input.qtyminus {
            width: 25px;
            height: 25px;
            background: #fff;
            border: 1px solid #cecece;
        }

        .table > tbody > tr > td {
            border: 0px;
        }

        .wish {
            border: 0 !important;
        }

        .wish:hover {
            background: transparent !important;
        }
    </style>

    @if(auth()->guest())
        <link rel="stylesheet" href="/assets/css/remodal.css">
        <link rel="stylesheet" href="/assets/css/remodal-default-theme.css">
    @endif

@endsection
@section('content')
    <!-- logo, search, myaccount -->
    @include('partials.header')
    <!-- logo, search, myaccount -->

    @include('partials.categories', ['showBreadCrumb' => true])

    <section id="product_details">
        <div class="container">
            <div class="row">
                <div class="col-md-9 pad_resp">
                    <!-- SINGLE PRODUCT -->
                    <div class="single-product">
                        <div class="row">
                            <!-- PRODUCT GALLERY -->
                            <div class="col-md-4 pad_zero_right">
                                <div class="left_box">

                                    <div id="product-images" class="carousel slide product-images"
                                         data-ride="carousel" data-interval="false">
                                        <div class="carousel-inner">

                                            @foreach($product->images as $image)
                                                <div class="item {{ $loop->first? 'active' : '' }}">
                                                    <a href="{{ resize_image_url($image->image,'600X600') }}"
                                                       rel="gallery[pp_gal]"><img
                                                                src="{{ resize_image_url($image->image,'600X600') }}"
                                                                class="img-responsive" alt="">
                                                        @if($product->a_discount_price)
                                                            <div class="discount-label discount-label-xs orangetag">
                                                          <span>-{{ ceil((1 - ($product->a_discount_price/ $product->price)) * 100) }}
                                                          %</span></div>
                                                        @endif
                                                    </a>
                                                </div>
                                            @endforeach


                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div id="product-image-thumbnails"
                                         class="carousel slide product-image-thumbnails" data-interval="false">
                                        <div class="carousel-inner">
                                            @foreach($product->images->chunk(8) as $imageList)
                                                <div class="item {{ $loop->first ? 'active' : '' }}">
                                                    @foreach($imageList as $image)
                                                        <div data-target="#product-images"
                                                             data-slide-to="{{ $loop->parent->index * 4 + $loop->index   }}"
                                                             class="thumb">
                                                            <img src="{{ resize_image_url($image->image, '50X50') }}"
                                                                 alt="Product Image"></div>
                                                    @endforeach
                                                </div>

                                            @endforeach
                                        </div>

                                    </div>


                                </div>
                            </div>
                            <!-- END PRODUCT GALLERY -->
                            <!-- PRODUCT INFO -->
                            <div class="col-md-8 pad_zero_left right_box">
                                @if (!$product->auction)
                                    <section class="product-info no-margin p-0 product-info-desktop">


                                        <h1 class="p-t-17  p-l-12">{{ str_limit($product->name,160) }} @if($product->out_of_stock)
                                                <small class="p-l-12" style="color:red">Out Of Stock</small>@endif</h1>

                                        <form method="POST" action="{{ route('user.cart.store') }}" id="cart-form">
                                            <div class="col-md-12">
                                                <button class="btn btn-default pull-right wish" type="submit"
                                                        name="wishlist" id="btn-wishlist">
                                                <span class="fa fa-heart-o wishlist">
                                                </span>
                                                </button>
                                                <div class="rating">
                                                    @for($i = 0; $i < ceil($avgRating); $i++)
                                                        <span class="fa fa-star checked"></span>
                                                    @endfor

                                                    @for($i = 0; $i < 5 - ceil($avgRating); $i++)
                                                        <span class="fa fa-star"></span>
                                                    @endfor
                                                    <span>({{ $reviewInfo->sum('review_count') }})</span>
                                                </div>
                                            </div>

                                            <div class="clearfix"></div>
                                            <div class="col-md-12">
                                                <div class="product_share">
                                                    <p class="black">Share | </p>
                                                    <a href="https://www.facebook.com/sharer.php?u={{ route('products.show', $product->slug) }}"><img
                                                                src="/assets/img/facebook.png" alt=""></a>
                                                    <a href="https://twitter.com/share?url={{ route('products.show', $product->slug) }}"><img
                                                                src="/assets/img/twitter-icon-32.png" alt=""></a>
                                                    <a href="http://www.linkedin.com/shareArticle?mini=true&url={{ route('products.show', $product->slug) }}"><img
                                                                src="/assets/img/linkedin.png" alt=""></a>
                                                    <a href="https://plus.google.com/share?url={{ route('products.show', $product->slug) }}"><img
                                                                src="/assets/img/googleplus_32.png" alt=""></a>
                                                </div>

                                            </div>


                                            <div class="col-md-12">
                                                <div class="product_share">
                                                    <p class="black">
                                                    @if($product->a_discount_price || $product->has_discount)
                                                        <div>
                                                            <span class="sale">SALE</span>
                                                            <span class="spcolor f-s-22 display-total"
                                                                  style="font-weight: bold;">Rs {{ $product->discount_price  }}</span>
                                                            <strike>Rs {{ $product->price }}</strike>
                                                        </div>
                                                    @else
                                                        <span class="spcolor f-s-18 display-total">
                                                    Rs {{ $product->price }}</span>
                                                @endif
                                                <!-- @if($product->has_discount)
                                                    <strike>Rs {{ $product->price }}</strike>
                                                        (-{{ $product->discount_percentage }}%)
                                                        Rs {{ $product->discount_price }}
                                                @else
                                                    <span class="spcolor f-s-18 display-total">Rs {{ $product->price }}</span>
                                                    @endif -->
                                                    </p>
                                                </div>
                                            </div>


                                            <div class="">
                                                <table class="table table-responsive table-bordererd price_det_table m-b-0">

                                                    <tbody>
                                                    <tr>
                                                        <td class="starting_price p-t-17 p-b-17">
                                                            <div class="flex-start">
                                                                <p class="black p-r-45 m-b-0 p-t-3">Quantity</p>
                                                                <form id='myform' method='POST' action='#' class=""
                                                                      onkeypress="return event.keyCode != 13;">
                                                                    <input type='button' value='-' class='qtyminus'
                                                                           field='qty'/>
                                                                    <input type='number' name='qty' value='1'
                                                                           class='qty' id="qty-input-1"/>
                                                                    <input type='button' value='+' class='qtyplus'
                                                                           field='qty'/>
                                                                </form>
                                                                <p class="black p-l-15 m-b-0 p-t-3">{{ $product->unit_type }}</p>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="box">
                                                                @if($product->available_colors)
                                                                    Color:
                                                                    @foreach($product->available_colors as $color)
                                                                        <label>
                                                                            <input type="radio" name="options[color]"
                                                                                   value="{{ $color }}" {{ $loop->first ? 'checked' : '' }}>
                                                                            <span>{{ $color }}</span>
                                                                        </label>
                                                                    @endforeach
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <div class="box">
                                                                @if($product->available_sizes)
                                                                    Size:

                                                                    @foreach($product->available_sizes as $size)
                                                                        <label>
                                                                            <input type="radio" name="options[size]"
                                                                                   value="{{ $size }}" {{ $loop->first ? 'checked' : '' }}>
                                                                            <span>{{ strtoupper($size) }}</span>
                                                                        </label>
                                                                    @endforeach
                                                                @endif

                                                            </div>

                                                            <div>
                                                                @if($product->size_chart)
                                                                    <a href="#sizechart" data-toggle="modal"
                                                                       class="sizechart">Size Chart</a>
                                                                @endif

                                                                <div id="sizechart" class="modal fade" role="dialog">
                                                                    <div class="modal-dialog">

                                                                        <!-- Modal content-->
                                                                        <div class="modal-content">
                                                                            <div class="modal-header"
                                                                                 style="border:0px;">
                                                                                <button type="button" class="close"
                                                                                        data-dismiss="modal">&times;
                                                                                </button>

                                                                            </div>
                                                                            <div class="modal-body">
                                                                                {!! $product->size_chart !!}

                                                                                <div>
                                                                                    <strong>Reference</strong>
                                                                                    All the measurement are given in
                                                                                    centi meters (cm).
                                                                                    0.254cm = 1 inch
                                                                                    <br>
                                                                                    Varation of 1-3 cm may occur.
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="starting_price p-t-17 p-b-17 ">
                                                            <div class="flex-start">
                                                                <p class="black p-r-45 m-b-0 p-t-3">Total Amount</p>

                                                                <p class="black p-l-15 m-b-0"><span
                                                                            class="f-s-18 display-quantity"></span>
                                                                    selected
                                                                    , <span
                                                                            class="spcolor f-s-18 display-total">{{ $product->price }}</span>
                                                                </p>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    </tbody>
                                                </table>

                                                <div class="email_btn my_flex m-b-10 " style="background:white;">


                                                    <button class="buynow-desktop" type="submit"
                                                            name="buy_now" {{ $product->out_of_stock ? 'disabled' : '' }}>
                                                        BUY NOW
                                                    </button>

                                                    <button class="addtocart-desktop" type="submit"
                                                            name="add_to_cart" {{ $product->out_of_stock ? 'disabled' : '' }}>
                                                        ADD
                                                        TO CART
                                                    </button>


                                                    @if (auth()->check() && auth()->user()->isSeller())


                                                        <a class="buynow-desktop"
                                                           href="{{ route('user.products.edit', $product) }}">EDIT</a>

                                                    @endif

                                                </div>

                                                <div class="product-price-fix " style="background:white;">


                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <button class="msg-mobile" style="width:10%;"
                                                            onclick="{!! auth()->check() ? "createConversation({$product->company->owner_id})": 'showLoginForm()' !!}">
                                                        <i class="fa fa-comments"></i></button>

                                                    <button type="submit" class="buynow-mobile" name="buy_now"
                                                            {{ $product->out_of_stock ? 'disabled' : '' }}
                                                            style="width:38%;"> BUY NOW
                                                    </button>

                                                    <button type="submit" class="addtocart-mobile" name="add_to_cart"
                                                            {{ $product->out_of_stock ? 'disabled' : '' }}
                                                            style="width:49%;">ADD TO
                                                        CART
                                                    </button>


                                                </div>


                                            </div>


                                    </section>
                                @endif
                            <!--     auction sale -->

                                @if ($product->auction)
                                    <section class="auction">
                                        <h1 class="p-t-17  p-l-12">{{ str_limit($product->name,160) }} @if($product->out_of_stock)
                                                <small class="p-l-12" style="color:red">Out Of Stock</small>
                                            @endif
                                        </h1>
                                        <div class="col-md-12">

                                            <div class="product_share">
                                                <p class="black">Share | </p>
                                                <a href="https://www.facebook.com/sharer.php?u={{ route('products.show', $product->slug) }}"><img
                                                            src="/assets/img/facebook.png" alt=""></a>
                                                <a href="https://twitter.com/share?url={{ route('products.show', $product->slug) }}"><img
                                                            src="/assets/img/twitter-icon-32.png" alt=""></a>
                                                <a href="http://www.linkedin.com/shareArticle?mini=true&url={{ route('products.show', $product->slug) }}"><img
                                                            src="/assets/img/linkedin.png" alt=""></a>
                                                <a href="https://plus.google.com/share?url={{ route('products.show', $product->slug) }}"><img
                                                            src="/assets/img/googleplus_32.png" alt=""></a>
                                            </div>

                                        </div>
                                        <div>

                                            <table class="table table-responsive table-bordererd price_det_table m-b-0">
                                                <tr>
                                                    <td>
                                                        <div class="box">
                                                            @if($product->available_colors)
                                                                Color:
                                                                @foreach($product->available_colors as $color)
                                                                    <label>
                                                                        <input type="radio" name="options[color]"
                                                                               value="{{ $color }}" {{ $loop->first ? 'checked' : '' }}>
                                                                        <span>{{ $color }}</span>
                                                                    </label>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <div class="box">
                                                            @if($product->available_sizes)
                                                                Size:

                                                                @foreach($product->available_sizes as $size)
                                                                    <label>
                                                                        <input type="radio" name="options[size]"
                                                                               value="{{ $size }}" {{ $loop->first ? 'checked' : '' }}>
                                                                        <span>{{ strtoupper($size) }}</span>
                                                                    </label>
                                                                @endforeach
                                                            @endif

                                                        </div>

                                                        <div>
                                                            @if($product->size_chart)
                                                                <a href="#sizechart" data-toggle="modal"
                                                                   class="sizechart">Size Chart</a>
                                                            @endif

                                                            <div id="sizechart" class="modal fade" role="dialog">
                                                                <div class="modal-dialog">

                                                                    <!-- Modal content-->
                                                                    <div class="modal-content">
                                                                        <div class="modal-header" style="border:0px;">
                                                                            <button type="button" class="close"
                                                                                    data-dismiss="modal">&times;
                                                                            </button>

                                                                        </div>
                                                                        <div class="modal-body">
                                                                            {!! $product->size_chart !!}
                                                                            <div>
                                                                                <strong>Reference</strong>
                                                                                All the measurement are given in
                                                                                centimeters (cm).
                                                                                0.254cm = 1 inch
                                                                                <br>
                                                                                Varation of 1 - 3 cm may occur.
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        @if(!$product->auction_end_date)
                                            <h1>Stay Tuned for the Sales!</h1>
                                        @endif
                                        @if($product->auction_end_date)
                                            <h1>Want this ? Bid your price.</h1>

                                            @if($product->max_auction_price)
                                                <span class="bidprice">Rs {{ $product->max_auction_price }}</span>
                                                Current Bid
                                            @endif

                                            @if ($errors->has('price'))
                                                <p style="color: red">Price must be more
                                                    than {{ $product->max_auction_price }}</p>
                                            @endif

                                            @if (Carbon\Carbon::now()->diffInSeconds($product->auction_end_date, false) > 0)
                                                <form action="{{ route('user.auction') }}" method="POST">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <div class="col-md-6 col-xs-6 col-sm-6 p-l-0">
                                                        <input name="price" class="form-control bidinp"
                                                               placeholder="Enter your price ..." required type="number"
                                                               step="1" aria-required="true" value="{{ old('price') }}"
                                                               min="{{ $product->max_auction_price }}">
                                                    </div>
                                                    <div class="col-md-6 col-xs-6 col-sm-6 ">
                                                        <button type="submit" class="auctionbtn" style="width:49%;">
                                                            Bid
                                                        </button>
                                                    </div>
                                                </form>
                                            @else
                                                <p>Bidding Closed</p>
                                            @endif

                                            @if($product->max_auction_price)
                                                <p>Bid More than Rs {{ $product->max_auction_price }}.</p>
                                            @endif
                                            <div class="col-md-12 salescounter m-t-5 p-l-0">
                                                <div class="clockdiv" id="clockdiv">
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

                                    </section>
                                @endif
                                <hr>
                                <div style="margin-left:10px;">
                                    <p class="down_title black m-b-20"><strong>Delivery Time</strong><br>
                                        <span class="expectedtime">Your expected delivery   will be within 2 to 3 days</span>
                                    </p>
                                </div>
                                @endif

                                @if (!$product->auction)
                                    <section class="product-info no-margin p-0 product-info-mobile">


                                        <h1 class="p-t-17  p-l-12">{{ str_limit($product->name,160) }} @if($product->out_of_stock)
                                                <small class="p-l-12" style="color:red">Out Of Stock</small>@endif</h1>

                                        <div class="col-md-12">
                                            <div class="rating" style="display: inline-block;">
                                                @for($i = 0; $i < ceil($avgRating); $i++)
                                                    <span class="fa fa-star checked"></span>
                                                @endfor

                                                @for($i = 0; $i < 5 - ceil($avgRating); $i++)
                                                    <span class="fa fa-star"></span>
                                                @endfor
                                                <span>({{ $reviewInfo->sum('review_count') }})</span>
                                            </div>

                                            <button class="btn btn-default pull-right wish" type="button"
                                                    onclick="submitCartForm()"><span
                                                        class="fa fa-heart-o wishlist"></span></button>
                                        </div>

                                        <div class="clearfix"></div>
                                        <div class="col-md-12">
                                            <div class="product_share">
                                                <p class="black">Share | </p>
                                                <a href="https://www.facebook.com/sharer.php?u={{ route('products.show', $product->slug) }}"><img
                                                            src="/assets/img/facebook.png" alt=""></a>
                                                <a href="https://twitter.com/share?url={{ route('products.show', $product->slug) }}"><img
                                                            src="/assets/img/twitter-icon-32.png" alt=""></a>
                                                <a href="http://www.linkedin.com/shareArticle?mini=true&url={{ route('products.show', $product->slug) }}"><img
                                                            src="/assets/img/linkedin.png" alt=""></a>
                                                <a href="https://plus.google.com/share?url={{ route('products.show', $product->slug) }}"><img
                                                            src="/assets/img/googleplus_32.png" alt=""></a>
                                            </div>

                                        <!--     @if($product->a_discount_price)
                                            <div class="discount-label discount-label-desktop orangetag"><span>-{{ ceil((1 - ($product->a_discount_price/ $product->price)) * 100) }}%</span> </div>
                                        @endif -->
                                        <!--   <br>
                                        <span class="spcolor f-s-22 display-total"
                                              style="font-weight: bold;">{{ $product->price }}</span> -->
                                            @if($product->a_discount_price || $product->has_discount)
                                                <div>
                                                    <span class="sale">SALE</span>
                                                    <span class="spcolor f-s-22 display-total"
                                                          style="font-weight: bold;">Rs {{ $product->discount_price  }}</span>
                                                    <strike>Rs {{ $product->price }}</strike>
                                                </div>
                                            @else
                                                <span class="spcolor f-s-18 display-total">
                                                Rs {{ $product->price }}</span>
                                            @endif
                                            <hr>
                                            <p class="down_title black m-b-20">Delivery Time<br>
                                                <span>Your expected delivery   will be within {{ \Carbon\Carbon::now()->addDays(20)->format('jS F') }}</span>
                                            </p>
                                            <hr>
                                            <p class="down_title black m-b-15"><strong>Disclaimer</strong></p>
                                            <ul>
                                                <li>
                                                    The above mentioned time may be slightly different than prescribed.
                                                    (Can
                                                    be either earlier or late)
                                                </li>
                                                <li>We ensure confirm delivery of the product once the order is
                                                    confirmed.
                                                </li>
                                            </ul>

                                            @if($product->size_chart)
                                                <hr>
                                                <strong>Size Chart</strong>
                                                <div class="sizechart-xs">
                                                    {!! $product->size_chart !!}
                                                </div>
                                            @endif
                                        </div>
                                        </form>

                                        <div id="myModal" class="modal fade" role="dialog">
                                            <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header" style="border:0px;">
                                                        <button type="button" class="close" data-dismiss="modal">&times;
                                                        </button>

                                                    </div>
                                                    <div class="modal-body">

                                                        <form method="POST" action="{{ route('user.cart.store') }}"
                                                              id="cart-form">
                                                            {{ csrf_field() }}
                                                            <div class="">

                                                                <div class="col-md-4 col-xs-4">

                                                                    <img src="{{ resize_image_url($image->image, '100X100') }}"
                                                                         alt="Product Image"
                                                                         style="height:80px;width:80px;">
                                                                </div>


                                                            </div>
                                                            <div class="col-md-8 col-xs-8">
                                                                <p class="m-l-10"
                                                                   style="max-width: 130px;">{{ str_limit($product->name,100) }} @if($product->out_of_stock)
                                                                        <small class="p-l-12" style="color:red">Out Of
                                                                            Stock
                                                                        </small>@endif</p>
                                                            </div>
                                                            <input type="hidden" name="product_id"
                                                                   value="{{ $product->id }}">


                                                            <table class="table table-responsive  price_det_table m-b-0"
                                                                   style="border:0px;">

                                                                <tbody>
                                                                <tr>
                                                                    <td class="starting_price p-t-17 p-b-17">
                                                                        <div class="flex-start">
                                                                            <p class="black p-r-45 m-b-0 p-t-3">
                                                                                Quantity</p>

                                                                            <input type='button' value='-'
                                                                                   class='qtyminus'
                                                                                   field='qty'/>
                                                                            <input type='number' name='qty' value='1'
                                                                                   class='qty' id="qty-input-1"/>
                                                                            <input type='button' value='+'
                                                                                   class='qtyplus'
                                                                                   field='qty'/>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="box">
                                                                            Color:<br>

                                                                            @foreach($product->available_colors as $color)
                                                                                <label>
                                                                                    <input type="radio"
                                                                                           name="options[color]"
                                                                                           value="{{ $color }}" {{ $loop->first ? 'checked' : '' }}>
                                                                                    <span>{{ $color }}</span>
                                                                                </label>
                                                                            @endforeach
                                                                        </div>
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td>
                                                                        <div class="box">
                                                                            Size:<br>

                                                                            @foreach($product->available_sizes as $size)
                                                                                <label>
                                                                                    <input type="radio"
                                                                                           name="options[size]"
                                                                                           value="{{ $size }}" {{ $loop->first ? 'checked' : '' }}>
                                                                                    <span>{{ strtoupper($size) }}</span>
                                                                                </label>
                                                                            @endforeach
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="starting_price p-t-17 p-b-17 ">
                                                                        <div class="flex-start">
                                                                            <p class="black p-r-45 m-b-0 p-t-3">Total
                                                                                Amount</p>

                                                                            <p class="black p-l-15 m-b-0"><span
                                                                                        class="f-s-18 display-quantity"></span>
                                                                                selected
                                                                                , <span
                                                                                        class="spcolor f-s-18 display-total">{{ $product->price }}</span>
                                                                            </p>
                                                                        </div>
                                                                    </td>
                                                                </tr>

                                                                </tbody>
                                                            </table>

                                                            <button id="btn-modal-mbl" type="submit"
                                                                    class="buynow-mobile"
                                                                    name="buy_now"
                                                                    style="width:100%;" {{ $product->out_of_stock ? 'disabled' : '' }}>
                                                                BUY NOW
                                                            </button>

                                                        </form>

                                                    </div>

                                                </div>

                                            </div>
                                        </div>

                                    </section>
                                @endif

                                @if (!$product->auction)
                                    <div class="product-price-fix " style="background:white;">


                                        {{ csrf_field() }}
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button class="msg-mobile" style="width:10%;"
                                                onclick="{!! auth()->check() ? "createConversation({$product->company->owner_id})": 'showLoginForm()' !!}">
                                            <i class="fa fa-comments"></i></button>

                                        <button type="submit" class="buynow-mobile" name="buy_now" style="width:38%;"
                                                {{ $product->out_of_stock ? 'disabled' : '' }}
                                                onclick="openModal('Buy Now', 'buy_now')"> BUY NOW
                                        </button>

                                        <button type="submit" class="addtocart-mobile" name="add_to_cart"
                                                style="width:49%;"
                                                {{ $product->out_of_stock ? 'disabled' : '' }}
                                                onclick="openModal('ADD TO CART', 'add_to_cart')">ADD TO
                                            CART
                                        </button>


                                    </div>
                                @endif

                                <div class="clearfix"></div>

                                @if(get_banner_by_slug('product-details'))
                                    <a href="{{ get_banner_by_slug('product-details')->link }}">
                                        <img src="{{ get_banner_by_slug('product-details')->image_url }}"
                                             class="img-responsive wid_100"
                                             alt="Image">
                                    </a>
                                @endif

                            </div>
                            <!-- END PRODUCT INFO -->


                        </div>


                    </div>

                    <!-- END SINGLE PRODUCT -->
                    <div class="pad_resp tab_setup1">

                        <!-- BASIC TAB -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="active"><a href="#home" role="tab" data-toggle="tab">Product Details</a></li>
                            <li><a href="#profile" role="tab" data-toggle="tab">Shipping & Delivery</a></li>
                            <li><a href="#review" role="tab" data-toggle="tab">Reviews</a></li>

                        </ul>
                        <div class="tab-content p-0">
                            <div class="tab-pane fade in active" id="home">
                                <div class="down_block p-15 p_setup">
                                    <p class="down_title black m-b-20">
                                        Quick Details
                                    </p>
                                    <div class="row">
                                        <div class="col-md-4">
                                            @if($product->brand_name)
                                                <p>Brand Name: <span class="black">{!! $product->brand_name !!}</span>
                                                </p>
                                            @endif

                                            @if($product->made_in)
                                                <p>Made in: <span class="black">{{ $product->made_in_obj->name }}</span>
                                                </p>
                                            @endif
                                            @if($product->assembled_in)
                                                <p>Assembled in: <span
                                                            class="black">{{ $product->assembled_in_obj->name }}</span>
                                                </p>
                                            @endif
                                            @if($product->origin)
                                                <p>Place Of Origin: <span
                                                            class="black">{{ $product->origin->name }}</span></p>
                                            @endif
                                        </div>

                                        @foreach($product->attributes->chunk(2) as $attributeList)
                                            @foreach($attributeList as $attribute)
                                                <div class="col-md-4">
                                                    <p>{{ $attribute->key }}: <span class="black">{{ $attribute->value }}
                                                    </span></p>
                                                </div>
                                            @endforeach
                                        @endforeach
                                    </div>
                                </div>
                                <div class="down_block p-15" style="border-top:1px solid #e3e3e3;">
                                    <p class="down_title black m-b-20">
                                        Product Details
                                    </p>
                                    <div class="row">
                                        <div class="col-md-12">
                                            {!!   $product->details !!}
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="profile">
                                <div class="down_block p-15" style="border-top:1px solid #e3e3e3; margin-top:-1px;">
                                    <p class="down_title black m-b-15">
                                        Shipping Details
                                    </p>
                                    <div class="row">
                                        <div class="col-md-12">
                                            {!! $product->shipping_details !!}


                                            Shipping/Delivery charge of Rs.100 will be levied at the time of delivery of
                                            the product to the customer.
                                            <hr>
                                            <br>
                                            <p class="down_title black m-b-15">Delivery Time</p>
                                            <span>Your expected delivery will be within {{ \Carbon\Carbon::now()->addDays(20)->format('jS F') }}</span>
                                            <br>
                                            <hr>
                                            <p class="down_title black m-b-15"><strong>Disclaimer</strong></p>
                                            <ul>
                                                <li>The above mentioned time may be slightly different than prescribed.
                                                    (Can be either earlier or late)
                                                </li>
                                                <li>We ensure confirm delivery of the product once the order is
                                                    confirmed.
                                                </li>
                                            </ul>

                                        </div>
                                    </div>
                                </div>
                            <!--          <div class="down_block p-15 p-t-0">
                                    <p class="down_title black m-b-15">
                                        Packaging Details
                                    </p>
                                    <div class="row">
                                        <div class="col-md-12">
                                            {!! $product->packing_details !!}

                                    </div>
                                </div>
                            </div> -->

                            </div>


                            <div class="tab-pane fade" id="review">
                                <div class="down_block p-15 p_setup">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-4 col-xs-12">
                                                <h4>{{ $avgRating }}/<span>5</span></h4>

                                                @for($i = 0; $i < ceil($avgRating); $i++)
                                                    <span class="fa fa-star checked"></span>
                                                @endfor

                                                @for($i = 0; $i < 5 - ceil($avgRating); $i++)
                                                    <span class="fa fa-star"></span>
                                                @endfor

                                                <p>{{ $reviewInfo->sum('review_count') }} ratings</p>
                                            </div>
                                            <div class="col-md-8 col-xs-12">
                                                <div class="col-md-12 col-xs-12">

                                                    @foreach($reviewInfo as $info)
                                                        <div>
                                                            <div class="side">
                                                                @for($i = 0; $i < $info->rating; $i++)
                                                                    <span class="fa fa-star checked"></span>
                                                                @endfor
                                                            </div>
                                                            <div class="middle">
                                                                <div class="bar-container">
                                                                    <div class="bar-{{ ceil(($info->review_count / $reviewInfo->sum('review_count')) * 10) }}"></div>
                                                                </div>
                                                            </div>
                                                            <div class="side right">
                                                                <div>{{ $info->review_count }}</div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>

                                    <div>
                                        <p class="down_title black m-b-20">
                                            Product Reviews
                                        </p>

                                        <div class="row">

                                            @foreach($product->reviews as $review)
                                                <div class="rating-exp">
                                                    <div class="col-md-6 ">
                                                        <div class="rating">

                                                            @for($i = 0; $i < $review->rating; $i++)
                                                                <span class="fa fa-star checked"></span>
                                                            @endfor

                                                        </div>
                                                        <div class="rating-person">by
                                                            <span>{{ $review->user->first_name }}</span></div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p class="pull-right">{{ $review->formated_created_at }}</p>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="col-md-12">
                                                        <p class="black">{{ $review->comment }}</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    @if(auth()->check() && get_can_review(auth('web')->user(),$product->id))
                                        <hr>
                                        <button data-toggle="modal" data-target="#myReview">
                                            write a review
                                        </button>
                                @endif

                                <!-- Modal -->
                                    <div class="modal fade" id="myReview" role="dialog">
                                        <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;
                                                    </button>
                                                    <h4 class="modal-title">Write a Review</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Help others by sharing your experience</p>

                                                    <form action="{{ route('user.reviews.store') }}" method="POST">

                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="product_id"
                                                               value="{{ $product->id }}">
                                                        <div class="form-group">
                                                            <label class="radio-inline">
                                                                <input type="radio" name="rating"
                                                                       value="1" {{ old('rating') == 1 ? 'checked' : '' }}>
                                                                <div class="rating"><span
                                                                            class="fa fa-star checked"></span></div>
                                                            </label>
                                                            <label class="radio-inline">
                                                                <input type="radio" name="rating"
                                                                       value="2" {{ old('rating') == 2 ? 'checked' : '' }}>
                                                                <div class="rating"><span
                                                                            class="fa fa-star checked"></span><span
                                                                            class="fa fa-star checked"></span></div>
                                                            </label>
                                                            <label class="radio-inline">
                                                                <input type="radio" name="rating"
                                                                       value="3" {{ old('rating') == 3 ? 'checked' : '' }}><span
                                                                        class="fa fa-star checked"></span><span
                                                                        class="fa fa-star checked"></span><span
                                                                        class="fa fa-star checked"></span>
                                                            </label>
                                                            <label class="radio-inline">
                                                                <input type="radio" name="rating"
                                                                       value="4" {{ old('rating') == 4 ? 'checked' : '' }}><span
                                                                        class="fa fa-star checked"></span><span
                                                                        class="fa fa-star checked"></span><span
                                                                        class="fa fa-star checked"></span><span
                                                                        class="fa fa-star checked"></span>
                                                            </label>
                                                            <label class="radio-inline">
                                                                <input type="radio" name="rating"
                                                                       value="5" {{ ! old('rating') || old('rating') == 5 ? 'checked' : '' }}><span
                                                                        class="fa fa-star checked"></span><span
                                                                        class="fa fa-star checked"><span
                                                                            class="fa fa-star checked"></span><span
                                                                            class="fa fa-star checked"></span><span
                                                                            class="fa fa-star checked"></span>
                                                            </label>
                                                        </div>

                                                        <div class="form-group">
                                                            <textarea name="comment" class="form-control" required
                                                                      placeholder="Your experience .."
                                                                      style="width: 100%; height: 150px;">{{ old('comment') }}</textarea>
                                                        </div>

                                                        <div class="form-group">
                                                            <input type="submit" name="btnSubmit" class="btnContact"
                                                                   value="Submit"/>
                                                        </div>
                                                    </form>


                                                </div>

                                            </div>

                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>
                        <!-- END BASIC TAB -->

                    </div>

                </div>
                <div class="col-md-3">

                    <div class="delivery-box">

                        Delivery

                        <div class="delivery-info">
                            <span class="delivery-icons">
                                <i class="fa fa-map-marker delivery-icons"></i>
                            </span>
                            <div class="delivery-address">
                                <select class="selectpicker" data-live-search="true">
                                    @foreach(get_cities() as $city)
                                        <option value="{{ $city->id }}"
                                                data-cod="{{ $city->cod_available }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="delivery-info">
                            <span class="delivery-icons">
                                <i class="fa fa-truck delivery-icons"></i>
                            </span>
                            <div class="delivery-address">
                                Home Delivery
                            </div>

                        </div>

                        <div class="delivery-info">
                        <span class="delivery-icons">
                            <i class="fa fa-money delivery-icons"></i>
                        </span>
                            <div class="delivery-address">
                                Cash On delivery <span class="cod-message"></span>
                            </div>
                        </div>


                    </div>


                    <div class="return-box">

                        Return & Exchange

                        <div class="delivery-info">
                    <span class="delivery-icons">
                        <i class="fa fa-share delivery-icons"></i>
                    </span>
                            <div class="delivery-address">


                                Easy Refund

                            </div>
                        </div>

                        <div class="delivery-info">
                    <span class="delivery-icons">
                        <i class="fa fa-retweet delivery-icons"></i>
                    </span>
                            <div class="delivery-address">
                                Easy Exchange
                            </div>
                        </div>


                    </div>
                    <div class="extra_right_box">
                        <p class="black heading">{{ $product->company->name }}</p>
                        <p class="">{{ $product->company->city_obj ? $product->company->city_obj->name.', '. $product->company->province_obj->name.', '. $product->company->country->name :  'company address' }}</p>
                        <div class="two_btns">
                            <a href="{{ route('companies.show', $product->company->slug) }}" class="btn">Company
                                Page</a>
                            <a href="{{ route('companies.info', $product->company->slug) }}" class="btn">Company
                                Info</a>

                        </div>
                        <div>
                            <button
                                    onclick="{!! auth()->check() ? "createConversation({$product->company->owner_id})": 'showLoginForm()' !!}"
                                    class="btn  m-t-30 m-b-20 send-message">SEND MESSAGE
                            </button>
                        </div>
                    </div>

                    @if($product->seller_id)
                        <div class="company_contacts bg_white" style="margin-right: 0;">
                            <div class="media text-center">
                                <a class="" href="#">
                                    <img class="media-object" src="{{ $product->seller->profile_pic_url }}"
                                         alt="Image"
                                         style="margin: 0 auto;" height="100">
                                </a>
                                <div class="media-body oh_media_con">
                                    <h4 class="media-heading">{{ $product->seller->name }}</h4>
                                    {{-- <p>{{ $product->seller->seller->position }}</p> --}}
                                </div>
                            </div>
                            <div class="">
                                @if(!empty($product->seller->seller->mobile_number))
                                    <div class="flex-start p-l-15 m-b-4 p-b-15">
                                        <p class="p-r-25" style="width:75px;">Mobile</p>
                                        <div class="det_all l-h-20">
                                            @foreach($product->seller->seller->presentable_mobile_number_a as $number)
                                                <p class="l-h-20 m-0">{{ $number }}</p>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                @if(!empty($product->seller->seller->landline_number))
                                    <div class="flex-start p-l-15 m-b-4">
                                        <p class="p-r-25" style="width:75px;">Landline</p>
                                        <div class="det_all l-h-20">
                                            @foreach($product->seller->seller->presentable_landline_number_a as $number)
                                                <p class="l-h-20 m-0">{{ $number }}</p>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                @if(!empty($product->seller->seller->fax))
                                    <div class="flex-start p-l-15 m-b-4 p-b-23">
                                        <p class="p-r-25" style="width:75px;">Fax</p>
                                        <div class="det_all l-h-20">
                                            @foreach($product->seller->seller->presentable_fax_a as $number)
                                                <p class="l-h-20 m-0">{{ $number }}</p>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="p-l-15">

                                {{-- @if($product->seller->seller->skype)
                                    <div class="other_media flex-start">
                                        <img src="/assets/img/skype.png" class="img-responsive height_20 m-r-12"
                                             alt="Image">
                                        <p class="m-b-0">{{ $product->seller->seller->skype }}</p>
                                    </div>
                                @endif --}}
                                {{-- @if($product->seller->seller->viber)
                                    <div class="other_media flex-start">
                                        <img src="/assets/img/viber.png" class="img-responsive height_20 m-r-12"
                                             alt="Image">
                                        <p class="m-b-0">{{ $product->seller->seller->viber }}</p>
                                    </div>
                                @endif

                                @if($product->seller->seller->whatsapp)
                                    <div class="other_media flex-start">
                                        <img src="/assets/img/whatsapp.png" class="img-responsive height_20 m-r-12"
                                             alt="Image">
                                        <p class="m-b-0">{{ $product->seller->seller->whatsapp }}</p>
                                    </div>
                                @endif
                                @if($product->seller->seller->wechat)
                                    <div class="other_media flex-start">
                                        <img src="/assets/img/wechat.png" class="img-responsive height_20 m-r-12"
                                             alt="Image">
                                        <p class="m-b-0">{{ $product->seller->seller->wechat }}</p>
                                    </div>
                                @endif
                            </div> --}}
                                <div class="btn_box my_flex">

                                    <a href="javascript:void(0)" class="btn send-message"
                                       onclick="{!! auth()->check() ? 'createConversation('.$product->seller->id.')': 'showLoginForm()' !!}">Send
                                        Message </a>
                                </div>
                            </div>
                            @endif

                        </div>
                </div>
                <div class="row m-t-30">

                </div>
            </div>
    </section>

    @if(auth()->check())
        <div id="app">
            <chat-app :chat_data="chatAppData"></chat-app>
        </div>
        <audio id="message-notification" src="/assets/sounds/message-beep.mp3" autostart="false"></audio>
    @else
        @include('partials.login')
    @endif
@endsection

@section('scripts')
    @if(auth()->check())
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/ajax-upload/js/vendor/jquery.ui.widget.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/ajax-upload/js/jquery.iframe-transport.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/ajax-upload/js/jquery.fileupload.js') }}"></script>
    @endif
    <script src="/assets/js/plugins/prettyphoto/jquery.prettyPhoto.min.js"></script>

    <script>
        var price = {{ $product->discount_price }};

        function submitCartForm() {
            document.getElementById('btn-wishlist').click()
        }

        function openModal(title, name) {
            $('#btn-modal-mbl').attr('name', name);
            $('#btn-modal-mbl').text(title)
            $('#myModal').modal('show')
        }

        $(document).ready(function () {
            // This button will increment the value
            $('.qtyplus').click(function (e) {
                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                fieldName = $(this).attr('field');
                // Get its current value
                var currentVal = parseInt($('input[name=' + fieldName + ']').val());
                // If is not undefined
                if (!isNaN(currentVal)) {
                    // Increment
                    $('input[name=' + fieldName + ']').val(currentVal + 1);
                } else {
                    // Otherwise put a 0 there
                    $('input[name=' + fieldName + ']').val(0);
                }

                calculate_and_display_qty_amount();
            });
            // This button will decrement the value till 0
            $(".qtyminus").click(function (e) {
                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                fieldName = $(this).attr('field');
                // Get its current value
                var currentVal = parseInt($('input[name=' + fieldName + ']').val());
                // If it isn't undefined or its greater than 0

                if (currentVal > 1) {
                    if (!isNaN(currentVal) && currentVal > 0) {
                        // Decrement one
                        $('input[name=' + fieldName + ']').val(currentVal - 1);
                    } else {
                        // Otherwise put a 0 there
                        $('input[name=' + fieldName + ']').val(0);
                    }
                    calculate_and_display_qty_amount();
                }
            });
        });

        function calculate_and_display_qty_amount() {
            var qty = parseInt($('[name=qty]').val());

            var total = price * qty;

            console.log(total, qty)

            $('.display-quantity').text(qty);
            $('.display-total').text('Rs. ' + total);
        }

        $('[name=quantity]').change(calculate_and_display_qty_amount);
        calculate_and_display_qty_amount();

        $('#qty-input-1').keyup(function (event) {
            var field = $('#qty-input-1');

            if (event.which < 48 || event.which > 57) {
                field.val(field.val().slice(0, -1));
                return false;
            }

            return true;
        });

        function locationChangeHandler() {
            var cod = $('.selectpicker').find(':selected').data('cod');

            if (cod == 1) {
                $('.cod-message').text('Available')
            } else {
                $('.cod-message').text('Not Available')
            }
        }

        $('.selectpicker').change(locationChangeHandler)

        locationChangeHandler()
    </script>

    @if ($product->auction)
        <script src="/assets/js/deadline.js"></script>
        <script>
            $(document).ready(function () {
                console.log('{{ $product->auction_end_date }}')

                var arr = '{{ $product->auction_end_date }}'.split(/[- :]/),
                    date = new Date(arr[0], arr[1] - 1, arr[2], arr[3], arr[4], arr[5]);
                {{--var deadline = new Date(Date.parse('{{ $product->auction_end_date }}'));--}}
                initializeClock('clockdiv', date);
            })
        </script>
    @endif

    @if(auth()->guest())
        <script src="https://cdnjs.cloudflare.com/ajax/libs/remodal/1.0.6/remodal.min.js"></script>
        <script>
            function showLoginForm() {
                var inst = $('[data-remodal-id=login-modal]').remodal();
                inst.open();
            }

            @if($errors->has('email') || $errors->has('password'))
            showLoginForm();
            @endif
        </script>
    @else
        <script>
            function createConversation(userId) {
                app.createConversation(userId);
            }

            function initUploadAttachment(conservation_id) {
                var c_id = conservation_id;

                $('#file-' + c_id).fileupload({
                    url: '/user/store-message',
                    formData: {
                        'conversation_id': c_id,
                        'type': 'attachment',
                        '_token': '{{ csrf_token() }}'
                    },
                    submit: function (e, data) {
                        if (data.files[0].size > 10485760) {
                            alert('File is too big(More than 10 MB).');
                            return false;
                        }

                        return true;
                    },
                    done: function (e, data) {
                        console.log('done');
                    },
                    error: function (e, data) {
                        alert('Something went wrong');
                    }
                });
            }
        </script>

    @endif
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
    @if(session()->has('product_page_flash_message'))
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
        <script>
            swal({
                buttons: false,
                icon: "success",
                timer: 1500,
                text: '{{ session()->get('product_page_flash_message') }}'
            });
        </script>
    @endif
@endsection