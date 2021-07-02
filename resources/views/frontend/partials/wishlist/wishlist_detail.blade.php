<!-- Shopping Cart Section Begin -->
<section class="shopping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="cart-table">
                    <?php $wishlist = getWishlistForUser();
                    ?>
                    @if(countWishlistForUser() >0)
                        <table>
                            <thead>
                            <tr>
                                <th>Image</th>
                                <th class="p-name">Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Add To Cart</th>
                                <th>Total</th>
                                <th><i class="ti-close"></i></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(getWishlistForUser() as $wish)
                                <tr>
                                    <td class="cart-pic first-row">
                                        @if(isset($wish->options['photo']))
                                            <img style="width: 70px" src="{{$wish->options['photo']}}" alt="{{$wish->name}}" />
                                        @endif
                                    </td>
                                    <td class="cart-title first-row">
                                        <h5>{{$wish->name}}</h5>
                                    </td>
                                    <td class="p-price first-row">Rs. {{$wish->price}}</td>
                                    <td class="p-price first-row">{{$wish->qty}}</td>
                                    {{-- <td class="qua-col first-row">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="text" value="{{$wish->qty}}" onchange="updateCart('{{$wish->rowId}}')">
                                            </div>
                                        </div>
                                    </td> --}}
                                    <td class="close-td first-row"><i class="ti-shopping-cart" onclick="updateWishlist('{{$wish->rowId}}')"> </i> </td>
                                    <td class="total-price first-row">Rs. {{$wish->price * $wish->qty}}</td>
                                    <td class="close-td first-row"><i class="ti-close" onclick="removeFromWishlist('{{$wish->rowId}}')"></i></td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    @else
                        <li class="list-group-item" style="color: red">Wishlist is Empty.</li>
                    @endif
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="cart-buttons">
                            <a href="{{URL::to('products/search')}}" class="primary-btn continue-shop">Continue shopping</a>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shopping Cart Section End -->