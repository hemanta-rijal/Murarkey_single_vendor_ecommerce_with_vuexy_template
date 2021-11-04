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

        @media screen and (max-width: 768px) {
            .table-responsive {
                display: none;
            }

            .left-box {
                display: none;
            }
        }

        #cart {
            background-color: white;
            margin-top: 20px;
            padding: 10px;
        }

        thead {
            background: #f1f1f1;
        }

        .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
            border: 0px;
        }
    </style>

    <script src="assets/js/plugins/prettyphoto/jquery.prettyPhoto.min.js"></script>

    <div class="wrapper">
        <section>

            <div class="container">

                <div class="col-md-9 left-box" id="cart">
                    <div class="table-responsive">
                        <table class="table table-striped cart_summary table-responsive">
                            <thead>
                            <tr>
                                <th class="cart-product">Product</th>
                                <th>Description</th>

                                <th class="text-center">Price</th>
                                <th class="cart-quantity text-center">Quantity</th>
                                <th class="text-center">Total</th>

                                <th class="action"><i class="fa fa-trash-o"></i></th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($items as $rowId => $item)
                                <tr>
                                    <td class="cart_product">
                                        <a href="{{ route('products.show', $item->model->slug) }}">
                                            <img src="{{ resize_image_url($item->name['image'][0]->image, '200X200') }}"
                                                 alt="Product" style="width:70px;height:70px;">
                                        </a>
                                    </td>

                                    <td class="cart_description"><p class="product-name"><a
                                                    href="{{ route('products.show', $item->model->slug) }}">{{ $item->name['title'] }}</a>
                                        </p>

                                        @foreach($item->options as $key => $value)
                                            <small><a href="#">{{ $key }} : {{ $value }}</a></small>
                                            <br>
                                        @endforeach
                                    </td>

                                    <td class="price">
                                        <span>Rs. {{ $item->price }}</span>
                                    </td>
                                    <td class="qty">

                                        <div class="flex-start">

                                            <input type='button' value='-' class='qtyminus' field='quantity'
                                                   data-price="{{ $item->price }}"
                                                   data-row-id="{{ $item->rowId }}"/>
                                            <input type='text' name='quantity-{{ $item->rowId }}'
                                                   value='{{ $item->qty }}' class='qty'/>
                                            <input type='button' value='+' class='qtyplus' field='quantity'
                                                   data-price="{{ $item->price }}"
                                                   data-row-id="{{ $item->rowId }}"/>

                                        </div>

                                    </td>
                                    <td class="price"><span
                                                class="row-{{ $item->rowId }}">Rs. {{ $item->total() }}</span></td>

                                    <td class="action">

                                        <form method="POST" action="{{ route('user.cart.destroy', $rowId) }}">
                                            {{ csrf_field() }}
                                            {{ method_field('delete') }}
                                            <button type="submit" class="btn btn-danger"><i class="fa fa-close"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>


                <div class="mobile-cart" id="cart">
                    @foreach($items as $rowId => $item)

                        <div class="mobile-cart-detial">
                            <figure class="mobile-cart-product">
                                <img
                                        src="{{ resize_image_url($item->name['image'][0]->image, '200X200') }}"
                                        alt="Product" style="width:100px;height:100px;">
                            </figure>
                            <div class="mobile-cart-content">
                                <h4><a href="#">{{ $item->name['title'] }}</a></h4>

                                @foreach($item->options as $key => $value)
                                    <p><span>{{ $key }} : {{ $value }}</span></p>
                                @endforeach
                                <form method="POST" action="{{ route('user.cart.destroy', $rowId) }}">
                                    {{ csrf_field() }}
                                    {{ method_field('delete') }}
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                </form>
                                <div class="cart-plus-minus">
                                    <label for="qty">QTY :</label>

                                    <form id='myform' method='POST' action='#' class="">
                                        <input type='button' value='-' class='qtyminus' field='quantity'
                                               data-price="{{ $item->price }}"
                                               data-row-id="{{ $item->rowId }}"/>
                                        <input type='text' name='quantity-{{ $item->rowId }}'
                                               value='{{ $item->qty }}' class='qty'/>
                                        <input type='button' value='+' class='qtyplus' field='quantity'
                                               data-price="{{ $item->price }}"
                                               data-row-id="{{ $item->rowId }}"/>
                                    </form>

                                </div>
                                <div class="clearfix"></div>
                                <p id="cart_total"><span>Price :<b
                                                class="row-{{ $item->rowId }}"> Rs. {{ $item->price }}</b></span></p>
                            </div>
                        </div>

                    @endforeach
                </div>

                <div class="col-md-3 m-t-20">
                    <div class="totals right-box">
                        <p>Shopping Cart Total</p>
                        <div class="inner">
                            <table id="shopping-cart-totals-table" class="table shopping-cart-table-total">
                                <colgroup>
                                    <col>
                                    <col width="1">
                                </colgroup>
                                <tfoot>
                                <tr>
                                    <td style="width:40%;"><strong>Grand Total</strong></td>
                                    <td style="width:60%;"><strong>Rs. <span
                                                    class="price total-price">{{ $total }}</span></strong></td>
                                </tr>
                                </tfoot>
                                <tbody>
                                <!--    <tr>
                                    <td style="width:40%;"> Subtotal</td>
                                    <td style="width:60%;">Rs. <span
                                                class="price sub-total-price"> {{ $subTotal }}</span></td>
                                </tr> -->
                                </tbody>
                            </table>

                            <form action="{{ route('user.cart.update', 1) }}" method="POST">

                                {{ method_field('put') }}
                                {{ csrf_field() }}
                                @foreach($items as $item)
                                    <input type="hidden" name="{{ $item->rowId }}" value="{{ $item->qty }}">
                                @endforeach

                                <div class="proceed-checkout-desktop">
                                    <button type="submit" class="btn-proceed-checkout checkout">
                                        <span>Continue</span></button>

                                </div>

                                <div class="proceed-checkout-mobile">
                                    <div class="proceed-checkout-mobile">
                                        <div class="col-xs-6"
                                             style="background-color: white;height:44px;padding:0px;text-align: center;">
                                                <span style="line-height: 46px;">
                                                    <strong>Grand Total</strong>
                                                    <span class="price total-price">Rs. {{ $total }}</span>
                                                </span>
                                        </div>
                                        <div class="col-xs-6" style="padding:0px;">
                                            <button type="submit" class="btn-proceed-checkout checkout">
                                                <span>Continue</span></button>

                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>


                    </div>
                </div>
            </div>
        </section>
    </div>
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
                    $('[name=' + rowId + ']').val(qty)

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

                        $('[name=' + rowId + ']').val(qty)

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