@extends('layouts.app')

@section('styles')
    <style>
        .home-category {
            margin: 3px;
            height: 32px;
            width: 32px;
            object-fit: cover;
            border-radius: 50%;
            display: inline;
        }
    </style>
@endsection
@section('content')
    {{--  {{dd(config::get('themeSetting'))}}  --}}
    <!-- logo, search, myaccount -->
    @include('partials.header')
    <!-- logo, search, myaccount -->
    @include('partials.heroSection')

    @if(config::get('themeSetting.first_ad_status')=='on')
        <!--==============================
            ADVERTISE
     ==============================-->
        <section class="advertise">
            <div class="advertise-item mt-4">
                <a href="{{url(get_theme_setting_by_key('first_ad_link'))}}">
                    <img src="{!! map_storage_path_to_link(get_theme_setting_by_key('first_ad_image')) !!}" alt="">
                </a>
            </div>
        </section>
        <!--=====END OF ADVERTISE=====-->
    @endif

    <!--==============================
            TODAYS DEAL Flash Sales
     ==============================-->
    @isset($flashSales)
        @if(config::get('themeSetting.flash_sale_status')=='on' )
            @foreach($flashSales as $flashSale)
                <section id="deal" class="py-5">
                    <div class="container-fluid bg-light py-4">

                        <div class="row">
                            <div class="col-auto mr-auto  deal-title">
                                <span class="font-weight-bold mt-2 deal-head">{{ $flashSale->title }}</span>
                                <a href="#"> See all deals</a>
                            </div>
                            <div class="col-auto">
                                <div class="countdown">
                                    <i class="far fa-clock mr-2"></i><span>Ends in:11:55:05</span>
                                </div>
                            </div>
                        </div>

                        <div class="slider py-4">
                            @foreach($flashSale->items->take(config::get('themeSetting.max_number_of_flash_sale_item')) as $item)
                                <div class="slider-item">
                                    <a href="{{ route('products.show', $item->product->slug) }}">
                                        <img src="{{ resize_image_url($item->product->images->first()->image, '200X200') }}"
                                             alt="Prodcuts1">
                                        <h6 class="info-title text-dark pl-4 mt-3">{{str_limit($item->product->name , 24) }}</h6>
                                        <div class=" row">
                                            <div class="col-auto mr-auto">
                                                <span class="product-price pl-4 mt-2">Rs. {{ $item->product->price }} </span>
                                                @if($item->product->a_discount_price)
                                                    <span class="discount">Rs. {{$item->product->price + $item->product->a_discount_price}}</span>
                                                @endif
                                            </div>
                                            <div class="col-auto pl-3">
                                                <a href=""><i class="flaticon-shopping-cart"></i></a>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </section>
            @endforeach
        @endif
    @endisset
    <!--=====END OF TODAYS DEAL=====-->

    @if(config::get('themeSetting.second_ad_status')=='on')
        <!--==============================
            ADVERTISE
     ==============================-->
        <section class="advertise">
            <div class="advertise-item mt-4">
                <a href="{{url(get_theme_setting_by_key('second_ad_link'))}}">
                    <img src="{!! map_storage_path_to_link(get_theme_setting_by_key('second_ad_image')) !!}" alt="">
                </a>
            </div>
        </section>
        <!--=====END OF ADVERTISE=====-->
    @endif


    <!--==============================
              NEW ARRIVALS
     ==============================-->
    @if(config::get('themeSetting.new_arrivals_status')=='on')
        <section id="trending" class="py-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-auto mr-auto">
                        <span class="font-weight-bold mt-2 head">New Arrivals</span>
                    </div>
                    <div class="col-auto">
                        <a href="#" class="link">View More</a>
                    </div>
                </div>

                <div class="trending-item pt-4">
                    <div class="row">
                        @foreach(get_recently_added_products_for_homepage(config::get('themeSetting.max_number_of_items_on_new_arrivals') ) as $product)
                            <div class="col-lg-2 col-md-4 col-sm-12">
                                <div class="product-item" style="padding-bottom: 40px;">
                                    <a href="{{ route('products.show', $product->slug) }}">
                                        <img src="{{ resize_image_url($product->images->first()->image, '200X200') }}"
                                             alt="Prodcuts3">
                                        @if($product->has_discount)
                                            <div class="discount-streak">
                                                <i class="fas fa-certificate"></i>
                                                <span>-{{ (int)(($product->discount_price/$product->price)*100)}}%</span>
                                            </div>
                                        @endif
                                        <h6 class="info-title text-dark mt-3">{{ \Illuminate\Support\Str::limit($product->name , 24) }}</h6>
                                        <span class="product-price">Rs. {{$product->a_discount_price ? $product->price-$product->a_discount_price : $product->price}}</span>
                                        @if($product->a_discount_price)
                                            <span class="discount">Rs {{$product->price}}</span>
                                        @endif
                                        @if($product->averageRating())
                                            <div class="product-rating">
                                                @for($i = 0; $i < ceil($product->averageRating()); $i++)
                                                    <i class="fa fa-star checked "></i>
                                                @endfor

                                                @for($i = 0; $i < 5 - ceil($product->averageRating()); $i++)
                                                    <i class="fa fa-star"></i>
                                                @endfor
                                                <span>({{$product->reviewCount}})</span>
                                            </div>
                                        @endif
                                    </a>
                                </div>
                            </div>
                        @endforeach


                    </div>
                </div>

            </div>
        </section>
    @endif
    <!--=====END OF TRENDING PRODUCTS=====-->

    @if(config::get('themeSetting.third_ad_status')=='on')
        <!--==============================
            ADVERTISE
      ==============================-->
        <section class="advertise">
            <div class="advertise-item mt-4">
                <a href="{{url(get_theme_setting_by_key('third_ad_link'))}}">
                    <img src="{!! map_storage_path_to_link(get_theme_setting_by_key('third_ad_image')) !!}" alt="">
                </a>
            </div>
        </section>
        <!--=====END OF ADVERTISE=====-->
    @endif

    <!--==============================
        Random Products Bewlo 1500
     ==============================-->
    @if(config::get('themeSetting.products_below_1500_status')=='on')
        <section id="trending" class="py-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-auto mr-auto">
                        <span class="font-weight-bold mt-2 head">Products Below 1500</span>
                    </div>
                    <div class="col-auto">
                        <a href="#" class="link">View More</a>
                    </div>
                </div>
                <div class="trending-item pt-4">
                    <div class="row">
                        @foreach(get_random_below_1500_products(config::get('themeSetting.max_number_of_item_on_products_below_1500')) as $product)
                            <div class="col-lg-2 col-md-4 col-sm-12">
                                <div class="product-item" style="padding-bottom: 40px;">
                                    <a href="{{ route('products.show', $product->slug) }}">
                                        <img src="{{ resize_image_url($product->images->first()->image, '200X200') }}"
                                             alt="Prodcuts">

                                        {{--  <div class="discount-streak">
                                          <i class="fas fa-certificate"></i>
                                          <span>-{{ (int)(($product->a_discount_price/$product->price)*100)}}%</span>
                                        </div>  --}}

                                        <h6 class="info-title text-dark mt-3">{{ \Illuminate\Support\Str::limit($product->name , 24) }}</h6>
                                        <span class="product-price">Rs. {{$product->a_discount_price ? $product->price - $product->a_discount_price : $product->price}}</span>
                                        @if($product->a_discount_price)
                                            <span class="discount">Rs {{$product->price}}</span>
                                        @endif
                                        @if($product->averageRating())
                                            <div class="product-rating">
                                                @for($i = 0; $i < ceil($product->averageRating()); $i++)
                                                    <i class="fa fa-star checked "></i>
                                                @endfor

                                                @for($i = 0; $i < 5 - ceil($product->averageRating()); $i++)
                                                    <i class="fa fa-star"></i>
                                                @endfor
                                                <span>({{$product->reviewCount}})</span>
                                            </div>
                                        @endif
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            </div>
        </section>
    @endif
    <!--=====END OF NEW ARRIVALS=====-->

    @if(config::get('themeSetting.fourth_ad_status')=='on')
        <!--==============================
            ADVERTISE
     ==============================-->
        <section class="advertise">
            <div class="advertise-item mt-4">
                <a href="{{url(get_theme_setting_by_key('fourth_ad_link'))}}">
                    <img src="{!! map_storage_path_to_link(get_theme_setting_by_key('fourth_ad_image')) !!}" alt="">
                </a>
            </div>
        </section>
        <!--=====END OF ADVERTISE=====-->
    @endif


    <!--==============================
            FEATURED PRODUCTS
     ==============================-->
    @if(config::get('themeSetting.featured_category_status')=='on')
        @if(get_homepage_featured_categories()->count()>0 )
            <section id="featured" class="py-5">
                <div class="container-fluid bg-light py-4 mx-auto">
                    <div class="row">
                        <div class="col-auto mr-auto">
                            <span class="font-weight-bold mt-2 head">Featured Products</span>
                        </div>
                        <div class="col-auto">
                            <a href="#" class="link">View More</a>
                        </div>
                    </div>

                    <div class="featured-item">
                        <div class="row">
                            <div class="col-lg-4 col-md-12 col-sm-12 py-5">
                                <a href=""><img src="{{URL::asset('frontend/assets/img/featured-head1.png')}}"
                                                alt="Featured Head"></a>
                            </div>

                            <div class="col-lg-8 col-md-12 col-sm-12 py-5">
                                <div class="row">
                                    @foreach (get_homepage_featured_categories() as $category)
                                        <div class="col-lg-6 col-md-12 col-sm-12">
                                            <div class="items bg-white">
                                                <h6>{{$category->name}}</h6>
                                                <div class="row">
                                                    @foreach ($category->FeaturedCategoriesHasProduct->take(4) as $FeaturedCategoriesHasProduct)
                                                        <a href=""><img
                                                                    src="{{resize_image_url($FeaturedCategoriesHasProduct->product->images->first()->image, '100X100') }}"
                                                                    style="max-width: 95px; object-fit:cover"
                                                                    alt=""></a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
            </section>
        @endif
    @endif

    <!--=====END OF FEATURED PRODUCTS=====-->

    @if(config::get('themeSetting.fifth_ad_status')=='on')
        <!--==============================
            ADVERTISE
     ==============================-->
        <section class="advertise">
            <div class="advertise-item mt-4">
                <a href="{{url(get_theme_setting_by_key('fifth_ad_link'))}}">
                    <img src="{!! map_storage_path_to_link(get_theme_setting_by_key('fifth_ad_image')) !!}" alt="">
                </a>
            </div>
        </section>
        <!--=====END OF ADVERTISE=====-->
    @endif

    <!--==============================
          Products You May Like
     ==============================-->
    @if(config::get('themeSetting.you_may_like_products_status')=='on')
        <section id="deal" class="py-5">
            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-auto mr-auto">
                        <span class="font-weight-bold mt-2 head">Products You May Like</span>
                    </div>
                    <div class="col-auto">
                        <a href="#" class="link">View More</a>
                    </div>
                </div>

                <div class="grocery py-4">
                @foreach(get_random_for_homepage(config::get('themeSetting.max_number_of_you_may_like_items')) as $product)
                    <!--Items-->
                        <div class="slider-item">
                            <a href="{{route('products.show', $product->slug)}}">
                                <img src="{{resize_image_url($product->images->first()->image, '200X200')}}"
                                     alt="Prodcuts1">
                                <h6 class="info-title text-dark mt-3">{{\Illuminate\Support\Str::limit($product->name , 24)}}</h6>
                                <div class=" row">
                                    <div class="col-auto mr-auto">
                                        <span class="product-price mt-2">Rs. {{$product->a_discount_price ? $product->price-$product->a_discount_price : $product->price}}</span>
                                        @if($product->a_discount_price)
                                            <span class="discount">Rs {{$product->price}}</span>
                                        @endif
                                    </div>
                                    <div class="col-auto pl-3">
                                        <a href=""><i class="flaticon-shopping-cart"></i></a>
                                    </div>
                                </div>
                                {{--  @if($product->averageRating())
                                  <div class="product-rating">
                                    @for($i = 0; $i < ceil($product->averageRating()); $i++)
                                        <i class="fa fa-star checked"></i>
                                    @endfor
                                    @for($j = 0; $j < 5 - ceil($product->averageRating()); $j++)
                                        <i class="fa fa-star"></i>
                                    @endfor
                                    <span>({{$product->reviewCount}})</span>
                                  </div>
                                @endif  --}}
                                <div class="product-rating">
                                    <span class="fa fa-star checked "></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    <!--=====Products You May Like=====-->


    <!--==============================
            SERVICES
     ==============================-->
    <section id="service" class="mb-5">
        <div class="container-fluid mx-auto">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="p-4 service-item text-center secure">
                        <img src="{{URL::asset('frontend/assets/img/secure.png')}}" alt="Secure Payments"
                             class="mx-auto">
                        <h6>100% Secure Payments</h6>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Id, veroconsec </p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="p-4 service-item text-center delivery">
                        <img src="{{URL::asset('frontend/assets/img/delivery.png')}}" alt="Delivery" class="mx-auto">
                        <h6>On Time Delivery</h6>
                        <p>Lorem ipsum dolor sit amet consectetur adipis consec </p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="p-4 service-item text-center cus-service">
                        <img src="{{URL::asset('frontend/assets/img/customer-service.png')}}" alt="Customer Service"
                             class="mx-auto">
                        <h6>Excellent Customer Service</h6>
                        <p>Lorem ipsum dolor sit amet consectetur adipis consec </p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="p-4 service-item text-center trust-pay">
                        <img src="{{URL::asset('frontend/assets/img/trust- pay.png')}}" alt="Trust Pay" class="mx-auto">
                        <h6>Trust Pay</h6>
                        <p>Lorem ipsum dolor sit amet consectetur adipis consec </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--=====END OF SERVICES=====-->
@endsection





