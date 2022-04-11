@extends('frontend.layouts.app')
@section('meta')
    {{-- @include('frontend.partials.ogForIndexPage') --}}
@endsection

@php
    $to = request('currency');
@endphp
@section('body')
    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="{{ route('home') }}"><i class="fa fa-home"></i> Home</a>
                        <span>Shop</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->
    <!-- Product Shop Section Begin -->
    <section class="product-shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-8 order-2 order-lg-1 produts-sidebar-filter">
                    <div class="offcanvas-filter">
                        <button id="offcanvas-filter-closebtn">
                            hide Filters
                        </button>
                    </div>
                    <div class="filter-widget">
                        <h4 class="fw-title">Currency Selector</h4>

                        <div class="currency-selector">
                            <select id="currency-selector" onchange="getConvertTo(this, 'currency');">
                                <option value="nrs"
                                        {{ request('currency') == 'nrs' ? 'selected' : '' }} data-image="{{ asset('frontend/img/flag-1.jpg') }}"
                                        data-title="Nepalese">
                                    Nepalese
                                </option>
                                <option value="aud"
                                        {{ request('currency') == 'aud' ? 'selected' : '' }} data-image="{{ asset('frontend/img/flag-2.jpg') }}"
                                        data-title="Australian">
                                    Australian
                                </option>
                            </select>
                        </div>
                    </div>
                    @isset($brands)
                        <div id="brands-filter" class="filter-widget">
                            <h4 class="fw-title">Fiter by Brands</h4>
                            <div class="fw-brand-check viewParent" style="padding-bottom: 2rem;">
                                @foreach ($brands->take(5) as $brand)
                                    <div class="bc-item">
                                        <label for="bc-{{ $brand->slug }}">
                                            {{ $brand->name }}
                                            <input type="checkbox"
                                                   {{ in_array($brand->slug, request()->except('page')) ? 'checked' : '' }} id="bc-{{ $brand->slug }}"
                                                   value="{{ $brand->slug }}"
                                                   onclick="loadProduct(this,'brand')">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endisset
                    <div id="categories-filter" class="filter-widget">
                        <h4 class="fw-title">Fiter by Categories</h4>
                        <div class="fw-cat-check viewParent" style="padding-bottom: 2rem;">
                            @foreach ($categories->take(5) as $category)
                                <div class="bc-item">
                                    <label for="bc-{{ $category->slug }}">
                                        {{ $category->name }}
                                        <input type="checkbox"
                                               {{ in_array($category->slug, request()->except('page')) ? 'checked' : '' }} value="{{ $category->slug }}"
                                               onclick="loadProduct(this,'category')"
                                               id="bc-{{ $category->slug }}">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div id="skin-tone-filter" class="filter-widget">
                        <h4 class="fw-title">Fiter by Skin Tone</h4>
                        <div class="fw-cat-check viewParent">
                            <div class="bc-item">
                                <label for="bc-normal-skin">
                                    Normal Skin
                                    {{-- <a href="?{!! http_build_query(array_merge(request()->except('page'), ['tone' => 'normal-skin'])) !!}"> --}}
                                    <input type="checkbox"
                                           {{ in_array('normal-skin', request()->except('page')) ? 'checked' : '' }} value="normal-skin"
                                           onclick="loadProduct(this,'tone')" id="bc-normal-skin"/>
                                    <span class="checkmark"></span>
                                    {{-- </a> --}}
                                </label>
                            </div>
                            <div class="bc-item">
                                <label for="bc-dry-skin">
                                    Dry Skin
                                    {{-- <a href="?{!! http_build_query(array_merge(request()->except('page'), ['tone' => 'dry-skin'])) !!}"> --}}
                                    <input type="checkbox"
                                           {{ in_array('dry-skin', request()->except('page')) ? 'checked' : '' }} value="dry-skin"
                                           onclick="loadProduct(this,'tone')" id="bc-dry-skin"/>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="bc-item">
                                <label for="bc-oily-skin">
                                    Oily Skin
                                    {{-- <a href="?{!! http_build_query(array_merge(request()->except('page'), ['tone' => 'oily-skin'])) !!}"> --}}
                                    <input type="checkbox"
                                           {{ in_array('oily-skin', request()->except('page')) ? 'checked' : '' }} value="oily-skin"
                                           onclick="loadProduct(this,'tone')" id="bc-oily-skin"/>
                                    <span class="checkmark"></span>
                                    {{-- </a> --}}
                                </label>
                            </div>

                        </div>
                    </div>
                    <div class="filter-widget">
                        <h4 class="fw-title">Price</h4>
                        <div class="price-filter-box">
                            <input type="number" class="form-control-lg" placeholder="Min" name="" id=""
                                   value="{{ request()->lower_price }}">
                            <input type="number" class="form-control-lg" placeholder="Max" name="" id=""
                                   value="{{ request()->upper_price }}">
                            <a href="#" onclick="priceFilter()" class="filter-btn">
                                <i class="fa fa-arrow-right"></i>
                            </a>
                        </div>

                        <div class="filter-range-wrap d-none">
                            <div class="range-slider">
                                <div class="price-input">
                                    <input type="text" id="minamount" value="{{ request()->lower_price }}"/>
                                    <input type="text" id="maxamount" value="{{ request()->upper_price }}"/>
                                </div>
                            </div>
                            <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                 data-min="50" data-max="5000">
                                <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                            </div>
                        </div>
                        <button class="filter-btn d-none" onclick="priceFilter()">Filter</button>
                    </div>

                </div>
                <div class="col-lg-9 order-1 order-lg-2">
                    <div class="product-show-option">
                        <div class="row">
                            <div class="offcanvas-filter">
                                <button id="offcanvas-filter-btn">
                                    Show Filters
                                </button>
                            </div>
                            <div class="col-lg-7 col-md-5 text-left leftsorted-pglist">
                                <p>Showing {{ $searched_products_count }}/{{ $total_products_count }} Products</p>
                                <div class="select-option">
                                    <select class="sorting" onchange="getPerPageData()" id="per_page">
                                        <option selected="selected" value="12">12 products/page</option>
                                        <option value="24">24 products/page</option>
                                        <option value="36">36 products/page</option>
                                        <option value="48">48 products/page</option>
                                        <option value="64">64 products/page</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-4">
                                <div class="select-option float-right">
                                    <select class="sorting" id="shortBy" onchange="getShortByValue(this,'order_by');">
                                        <option value="recently_added" {{ request('order_by') == 'recently_added' ? 'selected' : '' }}>
                                            <a href="?{{ http_build_query(array_merge(request()->except('page', 'order_by'), ['order_by' => 'recently_added'])) }}">Recently
                                                Added</a>
                                        </option>
                                        <option value="lowest_price" {{ request('order_by') == 'lowest_price' ? 'selected' : '' }}>
                                            <a href="?{{ http_build_query(array_merge(request()->except('page', 'order_by'), ['order_by' => 'lowest_price'])) }}">Sort
                                                by Price: low to high</a>
                                        </option>
                                        <option value="highest_price" {{ request('order_by') == 'highest_price' ? 'selected' : '' }}>
                                            <a href="?{{ http_build_query(array_merge(request()->except('page', 'order_by'), ['order_by' => 'highest_price'])) }}">Sort
                                                by Price: high to low</a>
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($products->count() > 0)
                        <div class="product-list">
                            <div class="row">
                                @foreach ($products as $product)
                                    {{-- <form action=""> --}}
                                    <div class="col-lg-3 col-md-4 col-6">
                                        <div class="product-item">
                                            <a href="{{ route('products.show', $product->slug) }}">
                                                <div class="pi-pic">
                                                    <img src="{{ resize_image_url($product->featured_image, '600X600') }}"
                                                         alt="{!! $product->name !!}"/>
                                                    @isset($product->featured_image)
                                                        <input type="hidden" id="options_{{ $product->id }}"
                                                               name="options[photo]"
                                                               value="{!! resize_image_url($product->featured_image, '200X200') !!}">
                                                    @endisset
                                                    <div class="icon">
                                                        <a onclick="addToWishlist({{ $product->id }})" href="#">
                                                            <i class="icon_heart_alt"></i></a>
                                                    </div>
                                                    <ul>
                                                        <li class="addtocart"><a onclick="addToCart({{ $product->id }})"
                                                                                 href="#">Add to Cart</a></li>
                                                    </ul>
                                                </div>
                                            </a>
                                            <div class="pi-text">
                                                @isset($product->category)
                                                    <div class="catagory-name">{{ str_limit($product->category->name, 28) }}</div>
                                                @endisset
                                                <a href="{{ route('products.show', $product->slug) }}">
                                                    <h5>
                                                        {!! $product->name !!}
                                                    </h5>
                                                </a>
                                                <div class="product-price">
                                                    @if($product->price!=$product->applyDiscount())
                                                        <span class="old-price">{{ convert($product->price, $to) }}</span>
                                                    @endif
                                                    {{ convert($product->applyDiscount(), $to) }}
                                                    <span>inc. vat</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="d-flex">
                            <div class="mx-auto">
                                {!! $products->links('vendor.pagination.bootstrap-4') !!}

                            </div>
                        </div>
                    @else
                        <div class="container d-flex justify-content-center ">
                            <div class="card shaodw-lg card-1">
                                <div class="card-body d-flex pt-0">
                                    <div class="row no-gutters mx-auto justify-content-center flex-sm-row flex-column">
                                        <div class="col-md-3 text-center"><img class="irc_mi img-fluid mr-0"
                                                                               src="{{URL::asset('frontend/img/sad.png')}}"
                                                                               width="150" height="150"></div>
                                        <div class="col-md-9 ">
                                            <div class="card border-0 ">
                                                <div class="card-body">
                                                    <h5 class="card-title "><b> Sorry! Products not Found.</b></h5>
                                                    <p class="card-text ">
                                                    <p>Product not Found with this request</p>
                                                    </p>
                                                    <a href="{{route('products.search')}}"
                                                       class="btn btn-primary btn-round-lg btn-lg"> Continue
                                                        Shopping </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- Product Shop Section End -->
@endsection
@section('js')
    {{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>--}}
    {{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>--}}
    <script>
        function priceFilter() {
            var min = $('#minamount').val();
            var min = min.substring(1);

            var max = $('#maxamount').val();
            var max = max.substring(1);

            let url_string = window.location.href;
            let url = new URL(url_string);
            let params = new URLSearchParams(url.search);
            // alert(params);
            // console.log(url_string.includes('?'))
            if (url_string.includes("lower_price") == false && url_string.includes("upper_price") == false) {
                params.set('lower_price', min);
                params.set('upper_price', max);
                // window.location.href= window.location.href+'?'+params.toString();
                var new_url = params.toString();
                window.location.href = url_string.split('?')[0] + '?' + new_url;
            } else {
                if (params.has('lower_price') && params.has('upper_price')) {
                    params.set('lower_price', min);
                    params.set('upper_price', max);
                    //  params = params.toString();
                    var new_url = params.toString();
                    window.location.href = url_string.split('?')[0] + '?' + new_url;
                }
            }

        }
    </script>

    <script>
        function addToCart(productId) {
            var auth =
            {{ auth('web')->check() ? 'true' : 'false' }}
            if (auth == true) {

                var auth = {{ auth()->check() ? 'true' : 'false' }};
                var optionsId = 'options_' + productId;
                var photo = document.getElementById(optionsId).value;
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{ Session::token() }}'
                    }
                });
                $.ajax({
                    type: "POST",
                    url: '<?php echo e(route('user.cart.store')); ?>',
                    data: {
                        qty: 1,
                        type: 'product',
                        options: {
                            'image': photo,
                            'product_type': 'product'
                        },
                        product_id: productId,
                    },
                    success: function (data) {
                        updateCartDropDown();
                        new swal({
                            buttons: true,
                            icon: String(data.icon),
                            timer: 2000,
                            text: data.message
                        });
                    },


                })
            } else {
                swal({
                    buttons: false,
                    icon: "error",
                    timer: 2000,
                    text: "Please Login First"
                });
                location.href = ('{{ route('auth.login') }}')
            }
        }

        function addToWishlist(productId) {
            var auth =
            {{ auth('web')->check() ? 'true' : 'false' }}
            if (auth == true) {
                var optionsId = 'options_' + productId;
                var photo = document.getElementById(optionsId).value;
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{ Session::token() }}'
                    }
                });
                $.ajax({
                    type: "POST",
                    url: '<?php echo e(route('user.wishlist.store')); ?>',
                    data: {
                        qty: 1,
                        options: {
                            'image': photo
                        },
                        type: 'product',
                        product_id: productId,
                    },
                    success: function (success) {
                        updateWishlistDropDown();
                        swal({
                            buttons: false,
                            icon: "success",
                            timer: 3000,
                            text: "Item added in Wishlist"
                        });
                    },

                })
            } else {
                swal({
                    buttons: false,
                    icon: "error",
                    timer: 2000,
                    text: "Please Login First"
                });
                location.href = ('{{ route('auth.login') }}')
            }
        }
    </script>

    <script>
        function getConvertTo(param, convertBy) {
            getShortByValue(param, convertBy)
        }

        function getShortByValue(param, searchBy) {
            let url_string = window.location.href;
            const urlObj = new URL(url_string);
            let searchParams = new URLSearchParams(urlObj.search);
            searchParams.set(searchBy, param.value)
            const new_url = searchParams.toString();
            window.location.href = url_string.split('?')[0] + '?' + new_url;

        }

        function getPerPageData() {
            var perPageSelectedValue = document.getElementById("per_page").value;
            window.location.href = window.location.href + '&per_page=' + perPageSelectedValue
        }

        function getSelectedPerPage() {

        }

        $(document).ready(function () {

        });
    </script>
    <script>
        var checkboxes = $('.bc-item input[type="checkbox"]');
        checkboxes.change(function () {
            var ser = checkboxes.serialize() + location.hash;
            console.log(ser)
        });

        function loadProduct(cb, searchBy) {
            let url_string = window.location.href;
            const urlObj = new URL(url_string);
            let searchParams = new URLSearchParams(urlObj.search);
            if (cb.checked) {
                searchParams.set(searchBy, cb.value)
                const new_url = searchParams.toString();
                window.location.href = url_string.split('?')[0] + '?' + new_url;
            } else {
                searchParams.delete(searchBy)
                const new_url = searchParams.toString();
                window.location.href = url_string.split('?')[0] + '?' + new_url;
            }
        }
    </script>
    <script async>
        $.ajax({
            type: "GET",
            url: '<?php echo e(route('brands.get')); ?>',
            success: function (data) {
                console.log(data)
            },

        })
    </script>
@endsection
