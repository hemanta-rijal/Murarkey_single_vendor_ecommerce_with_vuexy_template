@extends('frontend.layouts.app')
@section('meta')
    @include('frontend.partials.ogForIndexPage')
@endsection
@section('body')
    <!-- Shopping Cart Section Begin -->
    <section class="checkout-section spad">
        <div class="container">
            <form action="#" class="checkout-form">
                <div class="row">
                    <div class="col-lg-6">

                        <h4>Biiling Details</h4>
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="fir">Name<span>*</span></label>
                                <input type="text" id="fir">
                            </div>
                            <div class="col-lg-6">
                                <label for="phone">Phone<span>*</span></label>
                                <input type="text" id="phone">
                            </div>

                            <div class="col-lg-12">
                                <label for="email">Email Address<span>*</span></label>
                                <input type="text" id="email">
                            </div>

                            <div class="col-lg-6">
                                <label for="street">City<span>*</span></label>
                                <input type="text" id="city" class="city-first">

                            </div>

                            <div class="col-lg-6">
                                <label for="street">Province<span>*</span></label>
                                <input type="text" id="province" class="province-first">

                            </div>

                            <div class="col-lg-12">
                                <label for="street">Street Address<span>*</span></label>
                                <input type="text" id="street" class="street-first">

                            </div>
                            <div class="col-lg-12">
                                <label for="zip">Postcode / ZIP (optional)</label>
                                <input type="text" id="zip">
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-6">

                        <div class="place-order">
                            <h4>Your Order</h4>
                            <div class="order-total">
                                <ul class="order-table">
                                    <li>Product <span>Total</span></li>
                                    @foreach($items as $item)

                                    <li class="fw-normal">{{$item->name}}<span>Rs {{$item->price * $item->qty}}</span></li>

                                    @endforeach
                                    <li class="fw-normal">Subtotal <span>Rs {{$subTotal}}</span></li>
                                    <li class="total-price">Total <span>RS. {{$total}}</span></li>
                                </ul>

                                <h5>Pay with</h5>
                                <div id="payment-type">
                                    <label>
                                        <input type="radio" name="test" value="esewa">
                                        <div>
                                            <img src="{{URL::asset('frontend/img/esewa.png')}}">

                                        </div>
                                    </label>
                                    <label>
                                        <input type="radio" name="test" value="paypal">
                                        <div>
                                            <img src="{{URL::asset('frontend/img/paypal.png')}}">

                                        </div>
                                    </label>


                                    <label>
                                        <input type="radio" name="test" value="wallet">
                                        <div>
                                            <img src="{{URL::asset('frontend/img/wallet.png')}}">

                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="order-btn mx-auto mt-5">
                        <button type="submit" class="site-btn place-btn">Place Order</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- Shopping Cart Section End -->
@endsection