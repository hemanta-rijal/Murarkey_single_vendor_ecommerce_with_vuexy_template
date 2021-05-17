@extends('layouts.app')

@section('content')
    @include('partials.header')
    <!-- logo, search, myaccount -->

    @include('partials.categories', ['showBreadCrumb' => true])

    <style>

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

        #myform {
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
        @media screen and (max-width: 768px){
        .table-responsive{
            display:none;
        }
             .left-box{
            display: none;
        }
        }

        #cart {
            background-color: white;
            margin-top: 20px;
            padding: 10px;
        }

             thead{
            background: #f1f1f1;
        }
        .table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td{
            border:0px;
        }
    </style>

    <script src="assets/js/plugins/prettyphoto/jquery.prettyPhoto.min.js"></script>

    <!--==============================
           PRODUCT
     ==============================-->
     <section id="product" class="cart py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 p-0">
                    <div class="cart-product bg-white">
                        <div class="px-3 py-2">
                            <div class="row">
                                <div class="col-auto mr-auto">
                                    <!--Title-->
                                    <h6 class="font-weight-bold mt-2">Wish List ({{$items->count()}})</h6>
                                  </div>
                                  <div class="col-auto mt-2 text-dark">
                                    <span class="time">Estimated Time:</span>
                                    <span class="font-weight-bold"> 4 October</span>
                                  </div>
                            </div>
                        </div>
    
                        <form class="select px-3 py-2">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                            <label class="form-check-label" for="inlineCheckbox1">Select all item(s)</label>
                          </div>
                        </form>
                    @foreach($items as $rowId => $item)
                            <div class="my-cart-item px-3 py-4 cart-item-{{$rowId}}">
                                <div class="row">
                                    <div class="col-3">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck2">
                                        <img src="{{ resize_image_url($item->name['image'][0]->image, '200X200') }}" alt="Product" width="100%">
                                    </div>
                                    <div class="col-7 py-3">
                                        <p class="item-head">
                                           {{ $item->name['title'] }}
                                        </p>
                                        <p>
                                            @foreach($item->options as $key => $value)
                                            {{$key .' : '.$value }}, 
                                            @endforeach
                                            {{--  Huawei, Storage Capacity:16GB, Color Family:Black  --}}
                                        </p>
                                        <a href="">Seller: <span>Huawei</span></a>

                                        <div class="row">
                                            <div class="quantity pt-3 pl-0">
                                                <span class="minus-btn"><i class="fas fa-minus ml-3"></i></span>
                                                <input type="text" name="name" value="{{$item->qty}}" id="qty-input-1">
                                                <span class="plus-btn"><i class="fas fa-plus ml-3"></i> </span>                                
                                            </div>
                                            <div class="delete pt-3">
                                                <a href="#" id="deleteWishlistItem" data-value="{{$rowId}}">
                                                    <span><i class="far fa-trash-alt text-muted"></i>Delete</span>
                                                </a>
                                            </div>
                                            <div class="save pt-3">
                                              <span> 
                                                <a href="#" id="addToCartList" data-value="{{$item->id}}">
                                                    <i class="fas fa-shopping-cart"></i>add to cart
                                                </a>
                                              </span>
                                            </div>
                                        </div>
                                    </div>
                                    {{--  {{dd($item->product)}}  --}}
                                    <div class="col-2 mt-4">
                                        <p class="product-price">
                                            Rs. 3,890
                                        </p>
                                        <span class="discount text-muted">Rs.{{$item->price}}</span>
                                        <span class="discount-per">@if ($item->doDiscount) <strike>{{ $item->price }}</strike>
                                                <b>{{ ceil( $item->price * 0.5 ) }}</b></span>  @else {{ $item->price }} @endif Off</span>
                                    </div>

                                </div>
                            </div>
                        @endforeach
    
                    <!--Product demo -->
                    {{--  <div class="my-cart-item px-3 py-4">
                        <div class="row">
                            <div class="col-3">
                                <input type="checkbox" class="form-check-input" id="exampleCheck2">
                                <img src="/frontend/assets/img/huawei.png" alt="Watch" width="100%">
                            </div>
                            <div class="col-7 py-3">
                                <p class="item-head">
                                    Huawei MediaPad T5 [10.1 inch, 2GB RAM, 16GB ROM]
                                </p>
                                <p>
                                    Huawei, Storage Capacity:16GB, Color Family:Black
                                </p>
                                <a href="">Seller: <span>Huawei</span></a>
    
                                <div class="row">
                                    <div class="quantity pt-3 pl-0">
                                      <span class="minus-btn"><i class="fas fa-minus ml-3"></i></span>
                                      <input type="text" name="name" value="1">
                                      <span class="plus-btn"><i class="fas fa-plus ml-3"></i> </span>                                 
                                    </div>
                                    <div class="delete  pt-3">
                                        <span><i class="far fa-trash-alt text-muted"></i>Delete</span>
                                    </div>
                                    <div class="save  pt-3">
                                       <span> <i class="far fa-heart text-muted"></i>Save for later</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2 mt-4">
                                <p class="product-price">
                                    Rs. 3,890
                                </p>
                                <span class="discount text-muted">Rs. 29,785</span>
                                <span class="discount-per">15% Off</span>
                            </div>
    
                        </div>
                    </div>  --}}
                    </div>

            
                <div class="row py-4">
                    <div class="col-auto mr-auto">
                      <span class="continue">Continue shopping <i class="fas fa-angle-double-right"></i></span>
                    </div>
                    <div class="col-auto button">
                        <a href="">
                            <button type="button" class="btn clear">Clear cart</button>
                        </a>

                        <a href="">
                            <button type="button" class="btn update">update cart</button>
                        </a>
                      </div>
                    </div>
            
            
            </div>


            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class="shipping details bg-white py-3">
                    <div class="delivery  px-3">
                        <div class="row pb-2">
                            <div class="col-auto mr-auto">
                              <span class="title">Delivery Pincode</span>
                            </div>
                            <div class="col-auto">
                                <i class="flaticon-information"></i>
                              </div>
                            </div>
                            <form class="pincode-form">
                                <div class="form-group">
                                    <input type="text" pattern="[0-9]{4}" maxlength="4" class="form-control" id="pin" name="pin" placeholder="Enter your pincode....">
                                  <input type="submit" name="submit" id="subscribe" value="Apply">
                                </div>            
                              </form>

                                <div class="home-delivery py-3">
                                    <img src="./assets/img/delivery_icon.png" alt="" class="d-inline">
                                    <span class="title">Estimate Shippng</h6>
                                        <div class="row pb-2">
                                            <div class="col-auto mr-auto">
                                                <i class="fas fa-map-marker-alt"></i>
                                                <span class="location">Sukhanagar-Butwal, Rupandehi</span>
                                            </div>
                                            <div class="col-auto">
                                                <a href="" class="change">Change</a>
                                              </div>
                                            </div>
                                </div>
                    </div>

                    <div class="order-summary px-3 py-4">
                        <span class="title">Order Summary</h6>
                        <div class="row py-2">
                            <div class="col-auto mr-auto">
                              <span class="order-title">Subtotals (2 items)</span>
                            </div>
                            <div class="col-auto">
                                <span class="order-price">Rs. 51,800</span>
                              </div>
                            </div>

                            <div class="row py-2">
                                <div class="col-auto mr-auto">
                                  <span class="order-title">Shipping fee</span>
                                </div>
                                <div class="col-auto">
                                    <span>Rs. 80</span>
                                  </div>
                                </div>
                    </div>

                    <div class="total-price px-3 py-4">
                        <div class="row py-2">
                            <div class="col-auto mr-auto">
                                <span class="title">Total Amount</h6>
                            </div>
                            <div class="col-auto">
                                <span class="order-price font-weight-bold">Rs. 51,880</span>
                              </div>
                            </div>
                    </div>

                    <div class="button">
                        <a href="">
                            <button type="button" class="btn">Proceed to checkout</button>
                        </a>
                        </div>

                </div>
            </div>
        </div>
     </section>
       <!--=====END OF PRODUCT=====-->
@endsection


@section('scripts')
    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
    <script>
        var items = {!! $items->toJson() !!};
        var totalAmount = 0;
    </script>

    <script>
        jQuery(document).ready(function () {
            // This button will increment the value
            $('.qtyplus').click(function (e) {
                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var rowId = $(this).data('row-id');
                var price = $(this).data('price');
                var fieldName = 'quantity-' + rowId;
                var priceSpan = '.row-' + rowId;

                // Get its current value
                var currentVal = parseInt($('input[name=' + fieldName + ']').val());
                // If is not undefined
                if (!isNaN(currentVal)) {
                    // Increment
                    var qty = currentVal + 1;
                    $('input[name=' + fieldName + ']').val(qty);

                    items[rowId].qty = qty
                    $('[name='+ rowId +']').val(qty)

                    $(priceSpan).text('Rs. ' + (numeral(price * qty).format('0,0')));

                    calculateAndDisplayTotal()

                } else {
                    // Otherwise put a 0 there
                    $('input[name=' + fieldName + ']').val(0);
                }
            });
            // This button will decrement the value till 0
            $(".qtyminus").click(function (e) {
                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var rowId = $(this).data('row-id');
                var price = $(this).data('price');
                var fieldName = 'quantity-' + rowId;
                var priceSpan = '.row-' + rowId;
                // Get its current value
                var currentVal = parseInt($('input[name=' + fieldName + ']').val());
                // If it isn't undefined or its greater than 0
                if (!isNaN(currentVal) && currentVal > 0) {
                    // Decrement one
                    var qty = currentVal - 1;

                    if (qty > 0) {
                        items[rowId].qty = qty;

                        $('[name='+ rowId +']').val(qty)

                        $('input[name=' + fieldName + ']').val(currentVal - 1);
                        $(priceSpan).text('Rs. ' + (numeral(price * qty).format('0,0')));

                        calculateAndDisplayTotal()
                    }
                } else {
                    // Otherwise put a 0 there
                    $('input[name=' + fieldName + ']').val(0);
                }
            });
        });


        function calculateAndDisplayTotal() {
            var total = 0;
            for (item in items) {
                total += items[item].qty * items[item].price
            }

            $('.total-price').text(numeral(total).format('0,0'))
        }

    </script>
@endsection