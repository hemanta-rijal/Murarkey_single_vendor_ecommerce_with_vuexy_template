
    <div class="select-items">
        <?php $carts = getCartForUser();
        ?>
        @if($carts['content']->count()>0)

        <table>
            <tbody>
            @foreach($carts['content'] as $cart)
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
        @endif
    </div>
    <div class="select-total">
        <span>total:</span>
        <h5>{{$carts['total']}}</h5>
    </div>
    <div class="select-button">
        <a href="#" class="primary-btn view-card">VIEW CART</a>
        <a href="#" class="primary-btn checkout-btn">CHECK OUT</a>
    </div>
