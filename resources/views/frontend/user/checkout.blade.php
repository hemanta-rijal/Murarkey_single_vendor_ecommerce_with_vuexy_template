@extends('frontend.layouts.app')
@section('meta')
    @include('frontend.partials.ogForIndexPage')
@endsection
@section('body')
    <!-- Shopping Cart Section Begin -->
    <section class="checkout-section spad">
        <div class="container">
            <div class="checkout-form">
                <div class="row">
                    <div class="col-lg-8">
                        <form action="{{route('user.checkout.store')}}" method="POST">
                            @csrf
                        <div class="place-order">
                            <h4>Your Order</h4>
                            <div class="order-total">
                                <ul class="order-table">
                                    <li>Product <span>Total</span></li>
                                    <?php $carts = getCartForUser();
                                    ?>
                                    {{-- {{dd($carts)}} --}}
                                    @if($carts['content']->count()>0)
                                    @foreach($carts['content'] as $cart)
                                    <li class="fw-normal">
                                        <div class="item">
                                            <div class="item-img">
                                                <img src="{{$cart->options['photo']}}" alt="{{$cart->name}}">
                                            </div>
                                            <div class="item-title">
                                                {{$cart->name}}
                                            </div>
                                        </div>
                                        <span>{{convert($cart->qty * $cart->price)}}</span>
                                    </li>
                                    @endforeach
                                    @endif
                                    {{-- {{dd($carts)}} --}}
                                    <li class="fw-subtotal">Subtotal <span> {{convert($carts['subTotal'])}} </span></li>
                                    <li class="total-price">Total <span>{{convert($carts['total'])}}</span></li>
                                </ul>

                                <h5>Pay with</h5>

                                <div id="payment-type">
                                    <label>
                                        <input type="radio" name="payment_method" value="esewa" onclick="loadPaymentOptionWithEsewa('product')">
                                        <div>
                                            <img alt="esewa" title="esewa" src="{{URL::asset('frontend/img/esewa.png')}}">
                                        </div>
                                    </label>

                                    <label>
                                        <input type="radio" name="payment_method" value="paypal"  onclick="loadPaymentOptionWithPayPal('product')">
                                        <div>
                                            <img alt="paypal" title="paypal" src="{{URL::asset('frontend/img/paypal.png')}}" >

                                        </div>
                                    </label>
                                    <label>
                                        <input type="radio" name="payment_method" value="wallet" onclick="loadPaymentOptionWithWallet('product')">
                                        <div>
                                            <img alt="wallet" title="wallet" src="{{URL::asset('frontend/img/wallet.png')}}">

                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="order-btn d-flex justify-content-center mt-5">
                            <div id="esewa"></div>
                            <button type="submit" id="submitButton" style="display: none" class="site-btn place-btn">Place Order</button>
                        </div>
                    </form>
                    </div>

                    <div class="col-lg-4">
                        <div class="checkout-billing">
                            <div class="checkout-billing-group">
                                <h3>Shipping and Billing</h3>

                                <ul>
                                    @if($user->billing_details)
                                    <li>
                                        <div>
                                            <i class="fa fa-map-marker"></i>
                                            <span>{{$user->billing_details->specific_address}} {{$user->billing_details->city}} ,{{$user->billing_details->state}}, {{$user->billing_details->country}}</span>
                                        </div>
                                    </li>
                                    @else
                                        <div class="checkout-billing-group">
                                            <ul>
                                                <li>
                                                    <div class="d-flex justify-content-between">
                                                <span>
                                                    <i class="fa fa-th-list" onclick="showBillingAddressPopup()"></i>
                                                    Add Billing Address
                                                </span>
                                                        <a href="#" class="text-info" onclick="showBillingAddressPopup()">
                                                            Add
                                                        </a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    @endif
                                    @if($user->phone_number)
                                    <li>
                                        <div>
                                            <i class="fa fa-phone"></i>
                                            <span>{{$user->phone_number}}</span>
                                        </div>
                                    </li>
                                    @endif

                                    @if($user->email)
                                        <li>
                                            <div>
                                                <i class="fa fa-envelope"></i>
                                                <span>{{$user->email}}</span>
                                            </div>
                                        </li>
                                    @endif


                                </ul>

                            </div>

                            @if($user->billing_details)
                            <div class="checkout-billing-group">
                                <ul>
                                    <li>
                                        <div class="d-flex justify-content-between">
                                                <span>
                                                    <i class="fa fa-th-list" onclick="showBillingAddressPopup()"></i>
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
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->
    @include('frontend.partials.address.billingAddressPopup')
    @include('frontend.partials.address.shippingAddressPopup')
@endsection

@section('js')
    <script>

        function showBillingAddressPopup(){
            $('#billingModal').modal('toggle')
        }
        function showShippingAddressPopup(){
            $('#shippingModal').modal('toggle')
        }

    </script>
@endsection