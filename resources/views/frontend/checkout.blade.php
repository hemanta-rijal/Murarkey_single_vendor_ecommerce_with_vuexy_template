@extends('frontend.layouts.app')
@section('meta')
    @include('frontend.partials.ogForIndexPage')
@endsection
@section('body')
    @include('flash::message')
    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href="{{URL::to('/')}}"><i class="fa fa-home"></i> Home</a>
                        <a href="{{URL::to('products/search')}}">Shop</a>
                        <span>Shopping Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cart-table">
                        <?php $carts = getCartForUser();
                        ?>
                        @if($carts['content']->count()>0)
                        <table>
                            <thead>
                            <tr>
                                <th>Image</th>
                                <th class="p-name">Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th><i class="ti-close"></i></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($carts['content'] as $cart)
                                <tr>
                                    <td class="cart-pic first-row">
                                        @if(isset($cart->options['photo']))
                                            <img style="width: 70px" src="{{$cart->options['photo']}}" alt="{{$cart->name}}" />
                                        @endif
                                    </td>
                                    <td class="cart-title first-row">
                                        <h5>{{$cart->name}}</h5>
                                    </td>
                                    <td class="p-price first-row">{{$cart->price}}</td>
                                    <td class="qua-col first-row">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="text" value="{{$cart->qty}}" onchange="updateCart('{{$cart->rowId}}')">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="total-price first-row">{{$cart->price * $cart->qty}}</td>
                                    <td class="close-td first-row"><i class="ti-close" onclick="deleteCart('{{$cart->rowId}}')"></i></td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                        @else
                                <li class="list-group-item" style="color: red">Your Cart is Empty.</li>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="cart-buttons">
                                <a href="#" class="primary-btn continue-shop">Continue shopping</a>
                            </div>
                            <div class="discount-coupon">
                                <h6>Discount Codes</h6>
                                <form action="#" class="coupon-form">
                                    <input type="text" placeholder="Enter your codes">
                                    <button type="submit" class="site-btn coupon-btn">Apply</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-4 offset-lg-4">
                            <div class="proceed-checkout">
                                <ul>
                                    <li class="subtotal">Subtotal <span> Rs .{{$carts['total']}}</span></li>
                                    <li class="cart-total">Total <span>Rs. {{$carts['total']}}</span></li>
                                </ul>
                                <a href="#" class="proceed-btn">PROCEED TO CHECK OUT</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->

@endsection

@section('js')
    <script>
       function updateCart(rowId) {
           console.log(rowId)
       }

        function deleteCart(rowId) {

        }
    </script>

@endsection