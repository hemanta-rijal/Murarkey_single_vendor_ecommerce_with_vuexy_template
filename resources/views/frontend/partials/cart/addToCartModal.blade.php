<?php $cartItem = Cart::get($cartId);?>
<div class="cart-hover">
    <div class="select-items">
        <table>
            <tbody>
            <tr>
                <td class="si-pic">
                    <img src="{{$cartItem->options['photo']}}" alt="{{$cartItem->name}}">
                </td>
                <td class="si-text">
                    <div class="product-selected">
                        <p>{{convert($cartItem->price)}} x {{$cartItem->qty}}</p>
                        <h6>{{$cartItem->name}}</h6>
                    </div>
                </td>
                <td class="si-close">
                    <i class="ti-close"></i>
                </td>
            </tr>
            </tbody>
            <div class="select-total">
                <span>total:</span>
                <h5>{{convert($cartItem->price) * $cartItem->qty }}</h5>
            </div>
            <div class="select-button">
                <a href="{{URL::asset('cart')}}" class="primary-btn view-card">VIEW CART</a>
                <a href="#" class="primary-btn checkout-btn">CHECK OUT</a>
            </div>
        </table>
    </div>
</div>
