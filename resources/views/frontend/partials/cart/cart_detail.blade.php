<!-- Shopping Cart Section Begin -->
<section class="shopping-cart spad">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="cart-table">
					<?php $carts = getCartForUser();
					?>
					@if ($carts['content']->count() > 0)
						<table>
							<thead>
								<tr>
									<th>Image</th>
									<th class="p-name">Product/Service Name</th>
									<th>Price</th>
									<th>Quantity</th>
									<th>Total</th>
									<th><i class="ti-close"></i></th>
								</tr>
							</thead>
							<tbody>
								<form class="submitcartform" action="{{ route('user.carts-content.update') }}" method="POST">
									@csrf
									@foreach ($carts['content'] as $cart)
										<tr>
											<td class="cart-pic first-row">
												@if (isset($cart->options['photo']))
													<img style="width: 70px" src="{{ $cart->options['photo'] }}" alt="{{ $cart->name }}" />
												@endif
											</td>
											<td class="cart-title first-row">
												<h5>{{ $cart->name }}</h5>
											</td>
											<td class="p-price first-row">{{ convert($cart->price) }}</td>
											<input type="hidden" name="row_ids[]" value="{{ $cart->rowId }}">
											<td class="qua-col first-row">
												<div class="quantity">
													<div class="pro-qty">
														<input type="text" name="qty[{{ $cart->rowId }}]" value="{{ $cart->qty }}">
													</div>
												</div>
											<td class="total-price first-row">{{ convert($cart->price * $cart->qty) }}</td>
											</td>
											<td class="close-td first-row"><i class="ti-close" onclick="removeFromCart('{{ $cart->rowId }}')"></i></td>
										</tr>
									@endforeach
								</form>
							</tbody>
						</table>
					@else
						<li class="list-group-item" style="color: red">Your Cart is Empty.</li>
					@endif
				</div>
				<div class="row">
					<div class="col-lg-4">
						<div class="cart-buttons">
							<input type="button" id="target" class="submitcart primary-btn up-cart" value="Update cart" />
							<a href="{{ URL::to('products/search') }}" class="primary-btn continue-shop">Continue shopping</a>
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
								<li class="subtotal">Subtotal <span> {{ convert($carts['subTotal']) }}</span></li>
								<li class="subtotal">Tax <span> {{ convert($carts['tax']) }}</span></li>
								<li class="subtotal">Shipping Ammount<span> {{ convert($carts['shippingAmount']) }}</span></li>
								<li class="cart-total">Total <span>{{ convert($carts['total']) }}</span></li>
							</ul>
							<a href="{{ URL::to('user/checkout') }}" class="proceed-btn">PROCEED TO CHECK OUT</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Shopping Cart Section End -->
