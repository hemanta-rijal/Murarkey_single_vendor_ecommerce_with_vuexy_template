@extends('frontend.layouts.app')
@section('meta')

@endsection
@section('body')

{{-- {{dd($product)}}
{{dd($product->price ,$product->a_discount_price)}} --}}
<!-- Header Section Begin -->
    <div id="useHeader"></div>
    <!-- Header End -->
    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="breadcrumb-text product-more">

              <a href="./home.html"><i class="fa fa-home"></i> Home</a>
              <a href="{{products_search_route($product->category->slug)}}">{{$product->category->name}}</a>
              {{str_limit($product->name,40)}}

            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Product Shop Section Begin -->
    <section class="product-shop spad page-details">
      <div class="container">
        <div class="row">
          <!--  -->


          <!--  -->
         <div class="col-lg-12 mx-auto">
            <div class="row">
              <div class="col-lg-6">
                <div class="product-pic-zoom">
                  @if($product->images->count() > 0)
                  <img class="product-big-img" src="{{resize_image_url($product->images->first()->image,'600X600')}}" alt="{{$product->slug}}"/>
                  @endif
                  <div class="zoom-icon">
                    <i class="fa fa-search-plus"></i>
                  </div>
                </div>
                <div class="product-thumbs">
                  <div class="product-thumbs-track ps-slider owl-carousel">
                      @foreach($product->images as $image)
                          <div class="pt  {{ $loop->first ? 'active': ''}}" data-imgbigurl="{{resize_image_url($image->image,'200X200')}}" >
                            <img src="{{resize_image_url($image->image,'600X600')}}" alt="{{$product->slug}}" />
                          </div>
                      @endforeach
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                  <form id="option-choice-form" >
                      @csrf
                        <div class="product-details">
                          <div class="pd-title">
                            <span>{{$product->category->name}}</span>
                            <h3>{{str_limit($product->name, 160)}}</h3>
                          </div>

                          <div class="pd-desc mt-5">
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                              <input type="hidden" name="options[photo]" value="{{resize_image_url($image->image,'200X200')}}">
                            <input type="hidden" name="price" value="{{$product->price_after_discount}}" class="actual_price" />
                            <h4 class="display-total" >Rs. {{$product->price_after_discount}} <span>{{$product->price}}</span></h4>
                          </div>

                          <div class="quantity">
                            <div class="pro-qty">
                              <input type="text" name="qty" class='qty' id="qty-input-1"  value="1" />
                            </div>
                            <a href="#" id="addToCartListAjax" class="primary-btn pd-cart" onclick="addToCart({{$product->id}})">Add To Cart</a>
                          </div>
                          <a href="#" class="heart-icon btn btn-outline-danger mb-4 btn-block" id="addToWishListAjax" data-value="{{$product->id}}" ><i class="icon_heart_alt"></i > save in Wishlist </a>
                          <ul class="pd-tags">
                            <li>
                              <span>CATEGORIES</span>: {{$product->category->name}}
                            </li>
                            <li><span>TAGS</span>: Clothing, T-shirt, Woman</li>
                          </ul>
                          <div class="pd-share">
                            <div class="p-code">Sku : 00012</div>
                            <div class="pd-social">
                              <a href="#"><i class="ti-facebook"></i></a>
                              <a href="#"><i class="ti-twitter-alt"></i></a>
                              <a href="#"><i class="ti-linkedin"></i></a>
                            </div>
                          </div>
                        </div>
                  </form>
              </div>
            </div>
            <div class="product-tab">
              <div class="tab-item">
                <ul class="nav" role="tablist">
                  <li>
                    <a class="active" data-toggle="tab" href="#tab-1" role="tab"
                      >DESCRIPTION</a
                    >
                  </li>
                  <li>
                    <a data-toggle="tab" href="#tab-2" role="tab"
                      >Specification</a
                    >
                  </li>

                </ul>
              </div>
              <div class="tab-item-content">
                <div class="tab-content">
                  <div
                    class="tab-pane fade-in active"
                    id="tab-1"
                    role="tabpanel"
                  >
                    <div class="product-content">
                      <div class="row">
                        <div class="col-lg-7">
                          <h5>Details</h5>
                          {!! str_limit($product->details,3000) !!}
                        </div>
                        <div class="col-lg-5">
                          <img src="img/products/rustic1.jpg" alt="" />
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="tab-2" role="tabpanel">
                    <div class="specification-table">
                      <table>

                        <tr>
                          <td class="p-catagory">Price</td>
                          <td>
                            <div class="p-price">Rs. {{$product->price_after_discount}}</div>
                          </td>
                        </tr>
                        <tr>
                          <td class="p-catagory">Availability</td>
                          <td>
                            <div class="p-stock">{{$product->out_of_stock ? 'Out Of Stock' : 'In Stock'}}</div>
                          </td>
                        </tr>
                        <tr>
                          <td class="p-catagory">Weight</td>
                          <td>
                            <div class="p-weight">250gm</div>
                          </td>
                        </tr>

                        <tr>
                          <td class="p-catagory">Sku</td>
                          <td>
                            <div class="p-code">00012</div>
                          </td>
                        </tr>
                      </table>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Product Shop Section End -->

    <!-- Related Products Section End -->
    <div class="related-products spad ">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="section-title">
              <h2>Related Products</h2>
            </div>
          </div>
        </div>
        <div class="row">
          
          @foreach (get_similar_products_for_product_page($product) as $sim_product)
          <div class="col-lg-3 col-sm-6">
            <div class="product-item">
              <div class="pi-pic">
                <img src="{{resize_image_url($sim_product->images->first()->image,'200X200')}}" alt="{{$product->slug}}" />
                <div class="icon">
                  <i class="icon_heart_alt"></i>
                </div>
                <ul>

                  <li class="quick-view"><a href="#">Add to Card</a></li>

                </ul>
              </div>
              <div class="pi-text">
                <div class="catagory-name">{{$sim_product->category->name}}</div>
                <a href="#">
                  <h5>    {{str_limit($sim_product->name,40)}}
                  </h5>
                </a>
                <div class="product-price">{{$product->price_after_discount}}</div>
              </div>
            </div>
          </div>
            @endforeach

        </div>
      </div>
    </div>
    <!-- Related Products Section End -->
    <!-- Modal -->
    <div class="modal fade" id="addToCart" >
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="addToCart-modal-body">

                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
       <script type="text/javascript">
      $(document).ready(function(){
            $("#addToWishListAjax").on('click', function (e) {
                var product_id = $(this).attr('data-value');
                var quantity = document.getElementById('qty-input-1').value;
                // var auth = {{ auth()->check() ? 'true' : 'false' }};
                    $.ajaxSetup({
                        headers: {'X-CSRF-TOKEN': '{{ Session::token() }}'}
                    });
                    $.ajax({
                        type: 'POST',
                        url: '{{ url('user/cart') }}',
                        dataType: 'json',
                        data: {
                            'product_id': product_id,
                            'wishlist': 'on',
                            'qty': quantity,
                        },
                        success: function (result) {
                          swal({
                              buttons: false,
                              icon: "success",
                              timer: 2000,
                              text: result.message,
                          });   
                          // window.location = '{{route('user.wishlist.index')}}';
                        },
                        
                        error: function (result) {
                          // if (auth==false) {
                          //    swal({
                          //     buttons: false,
                          //     icon: "warning",
                          //     timer: 2000,
                          //     text: '{{ session()->get('result.error') }}',
                          //     text: 'Please Sign-In And Try Again.'
                          // });
                          //  window.location = '{{route('login')}}';
                          // }else{
                            swal({
                              buttons: false,
                              icon: "warning",
                              timer: 2000,
                              text: result.message
                          });
                          // }
                        // window.location = '{{route('user.wishlist.index')}}';
                        }
                    });
            });

            {{--$("#addToCartListAjax").on('click', function (e) {--}}
            {{--     var product_id = $(this).attr('data-value');--}}
            {{--    var quantity = document.getElementById('qty-input-1').value;--}}
            {{--    // var cartCount = jQuery("#cartItemCount").text();--}}
            {{--    // var total = parseInt(quantity)+parseInt( cartCount);--}}
            {{--    var image = document.getElementById('product_image').value;--}}
            {{--     var auth = {{ auth()->check() ? 'true' : 'false' }};--}}
            {{--    --}}
            {{--    $.ajaxSetup({--}}
            {{--      headers: {'X-CSRF-TOKEN': '{{ Session::token() }}'}--}}
            {{--    });--}}
            {{--        $.ajax({--}}
            {{--            type: 'POST',--}}
            {{--            url: '{{ url('user/cart') }}',--}}
            {{--            dataType: 'json',--}}
            {{--            data: {--}}
            {{--              'product_id': product_id,--}}
            {{--              'add_to_cart': 'on',--}}
            {{--              'qty': quantity,--}}
            {{--              'options': image,--}}
            {{--            },--}}
            {{--            success: function (result) {--}}
            {{--               $("#cartItemCount").text(total);--}}
            {{--              swal({--}}
            {{--                  buttons: false,--}}
            {{--                  icon: "success",--}}
            {{--                  timer: 2000,--}}
            {{--                  text: result.message,--}}
            {{--              });  --}}
            {{--            },--}}
            {{--            --}}
            {{--            error: function (result) {--}}
            {{--              if (auth==false) {--}}
            {{--                 swal({--}}
            {{--                  buttons: false,--}}
            {{--                  icon: "warning",--}}
            {{--                  timer: 2000,--}}
            {{--                  text: '{{ session()->get('result.error') }}',--}}
            {{--                  text: 'Please Sign-In And Try Again.'--}}
            {{--              });--}}
            {{--               window.location = '{{route('login')}}';--}}
            {{--              }else{--}}
            {{--                swal({--}}
            {{--                  buttons: false,--}}
            {{--                  icon: "warning",--}}
            {{--                  timer: 2000,--}}
            {{--                  text: result.message--}}
            {{--              });--}}
            {{--              }--}}
            {{--            }--}}
            {{--        });--}}
            {{--});--}}
        });
    </script>

    <script>
        function addToCart(productId) {

            $.ajax({
                type:"POST",
                url:'<?php echo e(route("user.cart.store")) ?>',
                data:$('#option-choice-form').serializeArray(),
                success:function (data) {
                    updateCartDropDown();
                    $('#addToCart').modal();
                    $('#addToCart-modal-body').html(data)
                }

            })
        }

    </script>


    <script type="text/javascript">
        $(document).ready(function(){
            $("#deleteCartItemAjax").on('click', function (e) {
                var rowId = $(this).attr('data-value');
                    $.ajaxSetup({
                        headers: {'X-CSRF-TOKEN': '{{ Session::token() }}'}
                    });
                    $.ajax({
                        type: 'DELETE',
                        url: '{{ url('/user/cart') }}'+'/'+rowId,
                        dataType: 'json',
                        data: {
                            'rowId': rowId,
                            '_method': 'DELETE'
                        },
                        success: function (result) {
                          swal({
                              buttons: false,
                              icon: "success",
                              timer: 2000,
                              text: result.success
                          });
                         $("div").remove('.cart-item-'+rowId);
                        },
                        
                        error: function (result) {
                          swal({
                                buttons: false,
                                icon: "warning",
                                timer: 2000,
                                text: result.error
                            });
                        }
                    });
            });
        });

            $("#deleteWishlistItem").on('click', function (e) {
                var rowId = $(this).attr('data-value');
                    $.ajaxSetup({
                        headers: {'X-CSRF-TOKEN': '{{ Session::token() }}'}
                    });
                    $.ajax({
                        type: 'POST',
                        url: '{{ url('/user/wishlist') }}'+'/'+rowId,
                        dataType: 'json',
                        data: {
                            'rowId': rowId,
                            '_method': 'DELETE'
                        },
                        success: function (result) {
                          console.log(result);
                          swal({
                              buttons: false,
                              icon: "success",
                              timer: 2000,
                              text: result.success
                          });
                         $("div").remove('.cart-item-'+rowId);
                        },
                        
                        error: function (result) {

                          console.log(result);
                          swal({
                                buttons: false,
                                icon: "warning",
                                timer: 2000,
                                text: result.error
                            });
                        }
                    });
            });

    </script>
@endsection