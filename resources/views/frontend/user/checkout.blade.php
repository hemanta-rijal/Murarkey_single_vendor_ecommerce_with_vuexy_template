@extends('frontend.layouts.app')
@section('meta')
	@include('frontend.partials.ogForIndexPage')
@endsection
@section('body')
	<?php $carts = getCartForUser();
	?>
	<!-- Shopping Cart Section Begin -->
	<section class="checkout-section spad">
		<div class="container">
			<div class="checkout-form">
				@if ($carts['content']->count() > 0)
					<div class="row">
						<div class="col-lg-8">
							<form class="submitcartform" action="{{ route('user.carts-content.update') }}" method="POST">
								@csrf
								<div class="place-order">
									<h4>Your Order</h4>
									<div class="order-total">

										{{-- //repplace by blade --}}
										<ul class="order-table">
											<li>
												<span>Product</span>
												<span>qty</span>
												<span>Total</span>
												<span><i class="ti-close"></i></span>
											</li>
											<li class="fw-normal">
												<div class="item">
													<div class="item-img">
														<img src="img/products/rustic1.jpg" alt="">
													</div>
													<div class="item-title">
														Rustic Art Coconut Nectar Baby Shampoo 175gms
													</div>
												</div>
												<div class="quantity">
													<div class="pro-qty">
														<input type="text" value="1" id="update-cart-content" onclick="updateCartContent(this.val())">
													</div>
												</div>
												<span>Rs 1265.00</span>
												<div class="close-td first-row" style="cursor: pointer; color:red">
													<i class=" ti-close" onclick=""></i>
												</div>
											</li>

											<li class="fw-subtotal"><span>Subtotal</span> <span></span> <span>Rs 5000.00</span></li>
											<li class="total-price"><span>Total</span> <span></span> <span>RS. 5000.00</span></li>
										</ul>
										{{-- @include('frontend.partials.checkout-partial') --}}
										{{-- <td class="close-td first-row"><i class="ti-close" onclick="removeFromCart('{{$cart->rowId}}')"></i></td> --}}

										<!-- form to schedule service -->
										<div class="schedule-service-form">
											<div class="form-row">
												<div class="col-md-8">
													<div class="group-input">
														<label for="">Select Appointment/Delivery Date</label>
														<input type="text" name="date" id="datepicker" required /></p>
													</div>
												</div>
												<div class="col-md-4">
													<div class="group-input">
														<label for="">Select Time</label>
														<input type="time" name="time" id="" required />
													</div>
												</div>
											</div>
										</div>
										<!-- form to schedule service -->

										<h5>Pay with</h5>

										<div id="payment-type">
											<label>
												<input type="radio" name="payment_method" value="esewa" onclick="loadPaymentOptionWithEsewa('product',{{ $pid }})">
												<div>
													<img alt="esewa" title="esewa" src="{{ URL::asset('frontend/img/esewa.png') }}">
												</div>
											</label>

											<label>
												<input type="radio" name="payment_method" value="paypal" onclick="loadPaymentOptionWithPayPal('product')">
												<div>
													<img alt="paypal" title="paypal" src="{{ URL::asset('frontend/img/paypal.png') }}">

												</div>
											</label>
											<label>
												<input type="radio" name="payment_method" value="wallet" onclick="loadPaymentOptionWithWallet('product')">
												<div>
													<img alt="wallet" title="wallet" src="{{ URL::asset('frontend/img/wallet.png') }}">

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
										@if ($user->billing_details)
											<li>
												<div>
													<i class="fa fa-map-marker"></i>
													<span>{{ $user->billing_details->specific_address }} {{ $user->billing_details->city }} ,{{ $user->billing_details->state }}, {{ $user->billing_details->country }}</span>
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
										@if ($user->phone_number)
											<li>
												<div>
													<i class="fa fa-phone"></i>
													<span>{{ $user->phone_number }}</span>
												</div>
											</li>
										@endif

										@if ($user->email)
											<li>
												<div>
													<i class="fa fa-envelope"></i>
													<span>{{ $user->email }}</span>
												</div>
											</li>
										@endif


									</ul>

								</div>

								@if ($user->billing_details)
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
				@else
					<li class="list-group-item" style="color: red">Your Cart is Empty.</li>
				@endif
			</div>
		</div>
	</section>
	<!-- Shopping Cart Section End -->
	@include('frontend.partials.address.billingAddressPopup')
	@include('frontend.partials.address.shippingAddressPopup')
@endsection



@section('js')
	<script>
	 // $.post('{{ route('admin.get.service-label-field') }}', {
	 //         _token: '{{ @csrf_token() }}',
	 //         labels: selected
	 //     }, function (data) {
	 //         $('#service-label-field').html(data);
	 //     });
	 //  function updateCartContent(qty) {
	 //   alert(qty)
	 //  }

	 function showBillingAddressPopup() {
	  $('#billingModal').modal('toggle')
	 }

	 function showShippingAddressPopup() {
	  $('#shippingModal').modal('toggle')
	 }

	 function updateCartContent(qty) {
	  console.log(qty);
	 }
	 //  $('#update-cart-content').change(function() {
	 //   alert('test')
	 //  })
	</script>
@endsection
