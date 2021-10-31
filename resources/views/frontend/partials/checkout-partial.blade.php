<ul class="order-table">
	<li>
		<span>Product/service</span>
		<span>qty</span>
		<span>Total</span>
		<span><i class="ti-close"></i></span>
	</li>
	{{-- <form class="submitcartform" action="{{ route('user.carts-content.update') }}" method="POST">
		@csrf --}}
	@foreach ($carts['content'] as $cart)
		<li class="fw-normal">
			<div class="item">
				<div class="item-img">
					@if (isset($cart->options['photo']))
						<img src="{{ $cart->options['photo'] }}" alt="{{ $cart->name }}">
					@endif
				</div>
				<div class="item-title">
					{{ substr($cart->name, 0, 10) }}
				</div>
			</div>
			<input type="hidden" name="row_ids[]" value="{{ $cart->rowId }}">
			<div class="quantity">
				<div class="pro-qty">
					<input type="text" id="update-cart-content" name="qty[{{ $cart->rowId }}]" value="{{ $cart->qty }}" onclick="updateCartContent(this.val())">
				</div>
			</div>
			<span>{{ convert($cart->price) }}</span>
			<input type="hidden" name="row_ids[]" value="{{ $cart->rowId }}">
			<div class="close-td first-row" style="cursor: pointer; color:red">
				<i class=" ti-close" onclick=""></i>
			</div>
		</li>
	@endforeach
	{{-- </form> --}}

	<li class="fw-subtotal"><span>Subtotal</span> <span></span> <span> {{ convert($carts['subTotal']) }}</span></li>
	<li class="fw-subtotal"><span>TAX</span> <span></span> <span> {{ convert($carts['tax']) }}</span></li>
	<li class="fw-subtotal"><span>Shipping Ammount</span> <span></span> <span> {{ convert($carts['shippingAmount']) }}</span></li>
	<li class="fw-subtotal"><span></span> <span></span> <span></span></li>
	<li class="total-price"><span>Total</span> <span></span> <span>{{ convert($carts['total']) }}</span></li>
</ul>
