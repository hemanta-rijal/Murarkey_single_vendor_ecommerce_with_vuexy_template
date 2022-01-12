@extends('frontend.layouts.app')
@section('meta')
    @include('frontend.partials.ogForIndexPage')
@endsection
@section('body')
    <?php $carts = getCartForUser();?>
    <?php $checkoutSession = session()->get('checkout');
    //        dd($checkoutSession)
    ?>

    <!-- Shopping Cart Section Begin -->
    <section class="checkout-section spad">
        <div class="container">
            <div class="checkout-form">
                @if ($carts['content']->count() > 0)
                    <div class="row">
                        <div class="col-lg-8">
                            <form class="submitcartform" action="{{ url('user/orders') }}"
                                  method="POST">
                                @csrf
                                <div class="place-order">
                                    <h4>Your Order</h4>
                                    <div class="order-total">

                                        {{-- //repplace by blade --}}
                                        <ul class="order-table">
                                            <li>
                                                <span>Product</span>
                                                <span>qty</span>
                                                <span>Total</span>
                                                <div class="close-td"><i class="ti-close"></i></div>
                                            </li>
                                            @foreach ($carts['content'] as $cart)
                                                <li class="fw-normal">
                                                    <div class="item">
                                                        <div class="item-img">
                                                            <img src="{{ $cart->options['photo'] }}" alt="">
                                                        </div>
                                                        <div class="item-title">
                                                            {{ $cart->name }} <small
                                                                    class="text-success">@if(in_array($cart->rowId,$couponAppliedRowId))
                                                                    Coupon Applied @endif</small>
                                                        </div>
                                                    </div>
                                                    <div class="quantity">
                                                        <div class="pro-qty cartDiv">
                                                            <input type="text" value="{{ $cart->qty }}"
                                                                   id="update-cart-content" class="update-cart-content"
                                                                   data-rowId="{{$cart->rowId}}">
                                                        </div>
                                                    </div>
                                                    <span>{{ convert($cart->price) }}</span>
                                                    <div class="close-td first-row" style="cursor: pointer; color:red">
                                                        <i class=" ti-close"
                                                           onclick="removeFromCart('{{ $cart->rowId }}')"></i>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <div class="row mt-5 mb-4">
                                            <div class="col-lg-6 discount-coupon">
                                                <h6>Discount Codes</h6>
                                                <div class="discount-coupon">
                                                    <input type="text" placeholder="Enter your Discount codes"
                                                           class="coupon" name="coupon" id="coupon">
                                                    <a href="#" onclick="submitCoupon()" class="site-btn coupon-btn">Apply</a>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="proceed-checkout">
                                                    <ul>
                                                        <li class="subtotal">Subtotal
                                                            <span>{{convert($checkoutSession['subtotal'])}}</span></li>
                                                        <li class="subtotal"> Coupon
                                                            <span>{{convert($couponDiscountPrice)}}</span></li>
                                                        <li class="subtotal">Tax
                                                            <span> {{ convert($checkoutSession['tax']) }}</span></li>
                                                        <li class="cart-total">Total
                                                            <span>{{convert($checkoutSession['total'])}}</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- form to schedule service -->
                                        <div class="schedule-service-form">
                                            <div class="form-row">
                                                <div class="col-md-8">
                                                    <div class="group-input">
                                                        <label for="">Select Appointment/Delivery Date</label>
                                                        <input type="text" name="date" id="datepicker" required/></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="group-input">
                                                        <label for="">Select Time</label>
                                                        <input type="time" name="time" id="" required/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- form to schedule service -->

                                        <h5>Pay with</h5>

                                        <div id="payment-type">
                                            @if(get_meta_by_key('cash_on_delivery_status')=="on")
                                                <label>
                                                    <input type="radio" name="payment_method" value="Cash On Delivery"
                                                           onclick="loadPaymentOptionCashOnDelivery()">
                                                    <div>
                                                        <img alt="cash on delivery" title="cod"
                                                             src="{{ URL::asset('frontend/img/cod.png') }}">
                                                        Cash on delivery
                                                    </div>
                                                </label>
                                            @endif
                                            @if(get_meta_by_key('esewa_status')=="on")
                                                <label>
                                                    {{--       this option is in app.blade.php--}}
                                                    <input type="radio" name="payment_method" value="esewa"
                                                           onclick="loadPaymentOptionWithEsewa('product',{{ $pid }})">
                                                    <div>
                                                        <img alt="esewa" title="esewa"
                                                             src="{{ URL::asset('frontend/img/esewa.png') }}">
                                                        Esewa
                                                    </div>
                                                </label>
                                            @endif

                                            @if(get_meta_by_key('paypal')=="on")
                                                <label>
                                                    <input type="radio" name="payment_method" value="paypal"
                                                           onclick="loadPaymentOptionWithPayPal('product')">
                                                    <div>
                                                        <img alt="paypal" title="paypal"
                                                             src="{{ URL::asset('frontend/img/paypal.png') }}">
                                                        Paypal

                                                    </div>
                                                </label>
                                            @endif
                                            <label>
                                                <input type="radio" name="payment_method" value="wallet"
                                                       onclick="loadPaymentOptionWithWallet('product')">
                                                <div>
                                                    <img alt="wallet" title="wallet"
                                                         src="{{ URL::asset('frontend/img/wallet.png') }}">
                                                    Wallet
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="order-btn d-flex justify-content-center mt-5">
                                    <div id="esewa"></div>
                                    <button type="submit" id="submitButton" style="display: none"
                                            class="site-btn place-btn">Place Order
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="col-lg-4">
                            <div class="checkout-billing">
                                <div class="checkout-billing-group">
                                    <h3>Shipping and Billing</h3>
                                    <ul>
                                        @if ($user->billing_details)
                                            <li>
                                                <div>
                                                    <i class="fa fa-map-marker"></i>
                                                    <span>{{ $user->billing_details->specific_address }} {{ $user->billing_details->city }} ,{{ $user->billing_details->state }}, {{ $user->billing_details->country }}</span>
                                                </div>
                                            </li>
                                        @else
                                            <div class="checkout-billing-group">
                                                <ul>
                                                    <li>
                                                        <div class="d-flex justify-content-between">
															<span>
																<i class="fa fa-th-list"
                                                                   onclick="showBillingAddressPopup()"></i>
																Add Billing Address
															</span>
                                                            <a href="#" class="text-info"
                                                               onclick="showBillingAddressPopup()">
                                                                Add
                                                            </a>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        @endif
                                        @if (isset($user->billing_details->phone_number))
                                            <li>
                                                <div>
                                                    <i class="fa fa-phone"></i>
                                                    <span>{{ $user->billing_details->phone_number }}</span>
                                                </div>
                                            </li>
                                        @elseif($user->phone_number)
                                                <li>
                                                    <div>
                                                        <i class="fa fa-phone"></i>
                                                        <span>{{ $user->phone_number }}</span>
                                                    </div>
                                                </li>
                                        @else

                                        @endif

                                        @if ($user->email)
                                            <li>
                                                <div>
                                                    <i class="fa fa-envelope"></i>
                                                    <span>{{ $user->email }}</span>
                                                </div>
                                            </li>
                                        @endif
                                    </ul>
                                </div>

                                @if ($user->billing_details)
                                    <div class="checkout-billing-group">
                                        <ul>
                                            <li>
                                                <div class="d-flex justify-content-between">
													<span>
														<i class="fa fa-th-list"
                                                           onclick="showBillingAddressPopup()"></i>
														Bill to same address
													</span>
                                                    <a href="#" class="text-info" onclick="showBillingAddressPopup()">
                                                        Edit
                                                    </a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @else
                    <li class="list-group-item" style="color: red">Your Cart is Empty.</li>
                @endif
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->
    @include('frontend.partials.address.billingAddressPopup')
    @include('frontend.partials.address.shippingAddressPopup')
@endsection



@section('js')
    <script>
        function showBillingAddressPopup() {
            $('#billingModal').modal('toggle')
        }

        function showShippingAddressPopup() {
            $('#shippingModal').modal('toggle')
        }

        function updateCartContent(newval, rowId) {

        }
    </script>
    <script>
        /*-------------------
      Quantity change
  --------------------- */
        var proQty = $(".pro-qty");
        proQty.prepend('<span class="dec qtybtn">-</span>');
        proQty.append('<span class="inc qtybtn">+</span>');
        proQty.on("click", ".qtybtn", function () {
            var $button = $(this);
            var oldValue = $button.parent().find("input").val();
            if ($button.hasClass("inc")) {
                var newVal = parseFloat(oldValue) + 1;
            } else {
                // Don't allow decrementing below zero
                if (oldValue > 0) {
                    var newVal = parseFloat(oldValue) - 1;
                } else {
                    newVal = 0;
                }
            }
            $button.parent().find("input").val(newVal);
            $button.parent().find("input").attr("value", newVal);
            var rowId = $button.parent().find("input").attr("data-rowId");
            updateCartContent(newVal, rowId)
        });
    </script>
    <script>
        function submitCoupon() {
            if ($('#coupon').val() != '') {
                var coupon = $('#coupon').val();
                $.ajax({
                    type: 'GET',
                    url: "{{route('coupon.apply')}}?code=" + coupon,
                    success: function (data) {
                        location.reload();
                    }
                });
            } else {
                alert('coupon code required!')
            }
        }
    </script>
@endsection
