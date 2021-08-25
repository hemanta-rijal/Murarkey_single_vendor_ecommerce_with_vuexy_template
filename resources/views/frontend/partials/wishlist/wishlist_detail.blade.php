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
                                <th class="p-name">Product/Service Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Add To Cart</th>
                                <th>Total</th>
                                <th><i class="ti-close"></i></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(getWishlistForUser() as $wish)
                              {{-- <form id="option-choice-form" >
                            @csrf --}}
                                <tr>
                                    {{-- <input type="hidden" name="product_id" value="{{$wish->id}}">
                                    <input type="hidden" name="options[product_type]" value="product">
                                    <input type="hidden" name="type" value="product"> --}}
                                    <td class="cart-pic first-row">
                                        @if(isset($wish->options['photo']))
                                        <input type="hidden" name="options[photo]" value="{{$wish->options['photo'] }}">
                                        <img style="width: 70px" src="{{$wish->options['photo']}}" alt="{{$wish->name}}" />
                                        @endif
                                    </td>
                                    <td class="cart-title first-row">
                                        <h5>{{$wish->name}}</h5>
                                    </td>
                                    <td class="p-price first-row">Rs. {{$wish->price}}</td>
                                    <td class="p-price first-row">{{$wish->qty}}</td>
                                    <input type="hidden" name="qty" value="{{$wish->qty}}">
                                    {{-- <td class="qua-col first-row">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="text" value="{{$wish->qty}}" onchange="updateCart('{{$wish->rowId}}')">
                                            </div>
                                        </div>
                                    </td> --}}
                                    {{-- <td class="close-td first-row"><i class="ti-shopping-cart" onclick="addToCart('{{$wish->id}}')"> </i> </td> --}}
                                    <td class="close-td first-row"><i class="ti-shopping-cart" onclick="addToCart('{{$wish->rowId}}')"> </i> </td>

                                    <td class="total-price first-row">Rs. {{$wish->price * $wish->qty}}</td>

                                    <td class="close-td first-row"><i class="ti-close" onclick="removeFromWishlist('{{$wish->rowId}}')"></i></td>
                                </tr>
                              {{-- </form> --}}
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

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script>
        function addToCart(productId) {
            // alert(productId);
          var auth = {{auth('web')->check() ? 'true' :'false'}}
          if(auth==true){
            $.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': '{{ Session::token() }}'}
                });
            $.ajax({
                type:"POST",
                url:'<?php echo e(route("user.wishlist.updatetocart")) ?>',
                data:{
                    rowId: productId
                },
                success:function (data) {
                    updateCartDropDown();
                    updateWishlistDropDown();
                    swal({
                        buttons: false,
                        icon: "success",
                        timer: 2000,
                        text: "updated successfully"
                    });
                    window.location.reload();
                }
            });
          }else{
            swal({
                        buttons: false,
                        icon: "error",
                        timer: 2000,
                        text: "Please Login First"
                    });
                    location.href = ('{{route('auth.login')}}')
          }
        }
</script>
@endsection