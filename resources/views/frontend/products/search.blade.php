@extends('frontend.layouts.app')
@section('meta')
    {{-- @include('frontend.partials.ogForIndexPage') --}}
@endsection
@section('body')
       <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="breadcrumb-text">
              <a href="{{route('home')}}"><i class="fa fa-home"></i> Home</a>
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
          <div
            class="
              col-lg-3 col-md-6 col-sm-8
              order-2 order-lg-1
              produts-sidebar-filter
            "
          >
            <div class="filter-widget">
              <h4 class="fw-title">Currency Selector</h4>

              <div id="currency-selector">
                <select>
                  <option
                    value="yt"
                    data-image="{{asset('frontend/img/flag-1.jpg')}}"
                    data-title="Nepalese"
                  >
                    Nepalese
                  </option>
                  <option
                    value="yu"
                    data-image="{{asset('frontend/img/flag-2.jpg')}}"
                    data-title="Australian"
                  >
                    Australian
                  </option>
                </select>
              </div>
            </div>
            @isset($brands)
               {{-- {{dd(request()->except('page'))}} --}}
            <div id="brands-filter" class="filter-widget">
              <h4 class="fw-title">Fiter by Brands</h4>
              <div class="fw-brand-check viewParent">
                @foreach ($brands->take(5) as $brand)
                <div class="bc-item">
                  <label for="bc-diesel">
                    {{$brand->name}}
                    <a href="?{!! http_build_query(array_merge(request()->except('page', 'brand'), ['brand' => $brand->slug])) !!}">
                    <input type="checkbox" id="bc-diesel" {{in_array($brand->slug,request()->except('page')) ? 'checked' : ''}} />
                    <span class="checkmark">
                    </span>
                  </a>
                  </label>
                </div>
                @endforeach
              </div>
            </div>
            @endisset
            <div id="categories-filter" class="filter-widget">
              <h4 class="fw-title">Fiter by Categories</h4>
              <div class="fw-cat-check viewParent">
                {{-- {{dd(request()->except('page'))}} --}}
                @foreach ($categories as $category)
                    <div class="bc-item">
                      <label for="bc-{{$category->slug}}">
                        {{$category->name}}
                        <a href="?{!! http_build_query(array_merge(request()->except('page', 'category'), ['category' => $category->slug])) !!}">
                          <input type="checkbox" {{in_array($category->slug,request()->except('page')) ? 'checked' : ''}} id="bc-{{$category->slug}}" />
                          <span class="checkmark"></span>
                        </a>
                      </label>
                    </div>
                    
                @endforeach
              </div>
            </div>

            <div class="filter-widget">
              <h4 class="fw-title">Price</h4>
              <div class="filter-range-wrap">
                <div class="range-slider">
                  <div class="price-input">
                    <input type="text" id="minamount" />
                    <input type="text" id="maxamount" />
                  </div>
                </div>
                <div
                  class="
                    price-range
                    ui-slider
                    ui-corner-all
                    ui-slider-horizontal
                    ui-widget
                    ui-widget-content
                  "
                  data-min="33"
                  data-max="98"
                >
                  <div
                    class="ui-slider-range ui-corner-all ui-widget-header"
                  ></div>
                  <span
                    tabindex="0"
                    class="ui-slider-handle ui-corner-all ui-state-default"
                  ></span>
                  <span
                    tabindex="0"
                    class="ui-slider-handle ui-corner-all ui-state-default"
                  ></span>
                </div>
              </div>
              <button class="filter-btn" onclick="priceFilter()">Filter</button>
              {{-- <a  class="filter-btn"  href="">Filter</a> --}}
            </div>
          </div>
            <div class="col-lg-9 order-1 order-lg-2">
            <div class="product-show-option">
              <div class="row">
                <div class="col-lg-5 col-md-5 text-left">
                  <p>Showing 12/200 Products</p>
                </div>
                <div class="col-lg-7 col-md-7">
                  <div class="select-option float-right">
                    <select class="sorting" id="shortBy" onchange="getShortByValue();">
                        <option value="recently_added" {{ request('order_by')=='recently_added' ? 'selected' : '' }}>
                          <a href="?{{ http_build_query(array_merge(request()->except('page', 'order_by'), ['order_by' => 'recently_added'])) }}">Recently Added</a>
                        </option>
                          <option value="lowest_price" {{ request('order_by')=='lowest_price' ? 'selected' : '' }}>
                          <a href="?{{ http_build_query(array_merge(request()->except('page', 'order_by'), ['order_by' => 'lowest_price'])) }}">Sort by Price: low to high</a>
                        </option>
                        <option value="highest_price" {{ request('order_by')=='highest_price' ? 'selected' : '' }}>
                          <a href="?{{ http_build_query(array_merge(request()->except('page', 'order_by'), ['order_by' => 'highest_price'])) }}">Sort by Price: high to low</a>
                        </option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
           @if($products->count() > 0)
            <div class="product-list">
              <div class="row">
                @foreach ($products->take(6) as $product)
                {{-- <form action=""> --}}
                    <div class="col-lg-4 col-sm-6">
                      <div class="product-item">
                        <a href="{{ route('products.show', $product->slug) }}">
                          <div class="pi-pic">
                            <img src="{{resize_image_url($product->featured_image, '600X600')}}" alt="{{$product->name}}" />
                             @isset($product->featured_image)
                            <input type="hidden" id="options_{{$product->id}}" name="options[photo]" value="{!! resize_image_url($product->featured_image,'200X200') !!}">
                            @endisset
                            <div class="icon">
                              <a onclick="addToWishlist({{$product->id}})" href="#">
                              <i class="icon_heart_alt"></i></a>
                            </div>
                            <ul>
                              <li class="addtocart" ><a onclick="addToCart({{$product->id}})" href="#">Add to Cart</a></li>
                            </ul>
                          </div>
                        </a>
                        <div class="pi-text">
                          @isset($product->category)
                          <div class="catagory-name">{{str_limit($product->category->name, 28)}}</div>
                          @endisset
                          <a href="#">
                            <h5>
                              {{str_limit($product->name, 25)}}
                            </h5>
                          </a>
                          <div class="product-price">
                            Rs. {{$product->price}}
                            <span>$ {{$product->price}}</span>
                          </div>
                          </div>
                      </div>
                    </div>
                {{-- </form> --}}
                  @endforeach
              </div>
            </div>
            {{-- {{dd($products)}} --}}
             {{-- <div class="d-flex">
                  <div class="mx-auto">
                      {{$products->links("pagination::bootstrap-4")}}
                  </div>
              </div> --}}
             @else
            <div class="no_results">
                No results found. Please try your search again
            </div>
          @endif
            {{-- <div class="loading-more">
              <i class="icon_loading"></i>
              <a href="#"> Loading More </a>
            </div> --}}
          </div>
        </div>
      </div>
    </section>
    <!-- Product Shop Section End -->
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
      <script>

       function priceFilter() {
           var min=$('#minamount').val();
           var min=min.substring(1);
           
           var max = $('#maxamount').val();
           var max=max.substring(1);

          let url_string = window.location.href;
          let url = new URL(url_string);
          let params = new URLSearchParams(url.search);
          // alert(params);
          // console.log(url_string.includes('?'))
          if(url_string.includes("lower_price")==false && url_string.includes("upper_price")==false){
              params.set('lower_price',min);
              params.set('upper_price',max);
              // window.location.href= window.location.href+'?'+params.toString();
              var new_url = params.toString();
               window.location.href= url_string.split('?')[0]+'?'+new_url;
           }else{
            if(params.has('lower_price') && params.has('upper_price')){
                  params.set('lower_price',min);
                  params.set('upper_price',max);
                  //  params = params.toString();
                    var new_url = params.toString();
                  window.location.href= url_string.split('?')[0]+'?'+new_url;
            }
           }
           
          }
      
    </script>

      <script>
        function addToCart(productId) {
           var auth = {{auth('web')->check() ? 'true' :'false'}}
          if(auth==true){

          var auth = {{ auth()->check() ? 'true' : 'false' }};
          var optionsId ='options_'+productId; 
          var photo = document.getElementById(optionsId).value;
           $.ajaxSetup({
                        headers: {'X-CSRF-TOKEN': '{{ Session::token() }}'}
                    });
            $.ajax({
                type:"POST",
                url:'<?php echo e(route("user.cart.store")) ?>',
                data:{
                  qty:1,
                  type: 'product',
                  options: {'photo':photo,'product_type':'product'},
                  product_id:productId,
                },
                success:function (data) {
                    updateCartDropDown();
                    new swal({
                       buttons: true,
                        icon: String(data.icon),
                        timer: 2000,
                        text: data.message
                    });
                },
             

            })
              }else{
            swal({
                        buttons: false,
                        icon: "error",
                        timer: 2000,
                        text: "Please Login First"
                    });
                    location.href = ('{{route('auth.login')}}')
          }
        }
        function addToWishlist(productId) {
           var auth = {{auth('web')->check() ? 'true' :'false'}}
          if(auth==true){
                var optionsId ='options_'+productId; 
                var photo = document.getElementById(optionsId).value;
                // console.log(options);
                  $.ajaxSetup({
                              headers: {'X-CSRF-TOKEN': '{{ Session::token() }}'}
                          });
                  $.ajax({
                      type:"POST",
                      url:'<?php echo e(route("user.wishlist.store")) ?>',
                      data:{
                        qty:1,
                        options: {'photo':photo},
                        type: 'product',
                        product_id:productId,
                      },
                      success:function (success) {
                          updateWishlistDropDown();
                          swal({
                              buttons: false,
                              icon: "success",
                              timer: 3000,
                              text: "Item added in Wishlist"
                          });
                      },

                  })
                  }else{
                    swal({
                                buttons: false,
                                icon: "error",
                                timer: 2000,
                                text: "Please Login First"
                            });
                    location.href = ('{{route('auth.login')}}')
          }
        }

    </script>

    <script>
        function getShortByValue()
        {
            var selectedValue = document.getElementById("shortBy").value;
            window.location.href = window.location.href +'&order_by='+selectedValue;  
        }
     $(document).ready(function(){
        $('#shortBy').change(function(){
            console.log('hey');
        });
    });
</script>

@endsection