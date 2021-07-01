
    <div class="select-items">
        <?php $carts = getCartForUser();
        ?>
        @if(countWishlistForUser() >0)

        <table>
            <tbody>
            @foreach(getWishlistForUser() as $cart)
            
            <tr>
                <td class="si-pic">
                    @if(isset($cart->options['photo']))
                        <img style="width: 70px" src="{{$cart->options['photo']}}" alt="{{$cart->name}}" />
                    @endif
                </td>
                <td class="si-text">
                    <div class="product-selected">
                        <p>{{$cart->price}} x {{$cart->qty}}</p>
                        <h6>{{$cart->name}}</h6>
                    </div>
                </td>
                <td class="si-close">
                    <i class="ti-close"></i>
                </td>
            </tr>
            @endforeach

            </tbody>
        </table>
        @else
            <h3>Your Cart is Empty</h3>
        @endif
    </div>
    @if($carts['content']->count()>0)
    <div class="select-total">
        <span>total:</span>
        <h5>{{$carts['total']}}</h5>
    </div>
    <div class="select-button">
        <a href="{{URL::to('user/cart')}}" class="primary-btn view-card">VIEW CART</a>
        <a href="{{route('user.checkout.index')}}" class="primary-btn checkout-btn">CHECK OUT</a>
    </div>
    @endif
