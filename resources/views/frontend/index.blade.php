@extends('frontend.layouts.app')
@section('title') Murarkey | Unlock your Beauty @endsection

@section('meta')
	@include('frontend.partials.ogForIndexPage')
@endsection
@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('jqueryui/jquery-ui.min.css') }}">
@endsection
@section('body')
	@include('flash::message')
	@include('frontend.includes.banner')

	@include('frontend.includes.benefit')

	@include('frontend.partials.serviceListing')
	<!-- Services Section Begin -->

	@include('frontend.partials.serviceSchedule')


	@include('frontend.partials.categorySlider')

	@include('frontend.partials.skintone')

	@include('frontend.partials.parlorListing')

	<!-- why murarkey section -->
	<section class="why-us-section">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-3">
					<div class="product-large set-bg px-3" data-setbg="{{URL::asset('frontend/img/servicebg.jpeg')}}">
						<h2>Why <br> Murarkey Pro?</h2>

						<a href="" class="btn btn-cta">
							View Form
						</a>
					</div>
				</div>

				<div class="col-lg-9 d-flex align-items-center">
					<div class="row d-flex ">
						<div class="col-md-3 col-6">
							<div class="why-us-card card">
								<div class="card-img">
									<img src="https://images.pexels.com/photos/4449797/pexels-photo-4449797.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" alt="">
								</div>
								<div class="card-body">
									<h3 class="card-title">
										MAKE MONEY
									</h3>
									<p>
										Receive Money For Each Services Instantly
									</p>
								</div>
							</div>
						</div>

						<div class="col-md-3 col-6">
							<div class="why-us-card card">
								<div class="card-img">
									<img src="https://images.pexels.com/photos/4467687/pexels-photo-4467687.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" alt="">
								</div>

								<div class="card-body">
									<h3 class="card-title">
										OWN YOUR CAREER
									</h3>
									<p>
										You Are Your Own Boss
									</p>
								</div>
							</div>
						</div>


						<div class="col-md-3 col-6">
							<div class="why-us-card card">
								<div class="card-img">
									<img src="https://images.pexels.com/photos/761993/pexels-photo-761993.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" alt="">
								</div>
								<div class="card-body">
									<h3 class="card-title">
										UNLIMITED OPPURTUNITY
									</h3>
									<p>
										Work At Your Friendly Neighborhood
									</p>
								</div>
							</div>
						</div>


						<div class="col-md-3 col-6">
							<div class="why-us-card card">
								<div class="card-img">
									<img src="https://images.pexels.com/photos/4348404/pexels-photo-4348404.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" alt="">
								</div>
								<div class="card-body">
									<h3 class="card-title">
										BOOST YOUR BUSINESS
									</h3>
									<p>
										Training And Advice
									</p>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- why murarkey section -->



	@include('frontend.partials.brandSlider')

	@include('frontend.includes.benefits_mobile')

@endsection

@section('js')
	<!-- Script -->
{{--	<script src="{{ URL::asset('backend/custom/customfuncitons.js') }}"></script>--}}
{{--	<script src="{{ asset('jqueryui/jquery-ui.min.js') }}" type="text/javascript"></script>--}}

	<script>
	 function addServiceToCart(serviceId) {
	  var auth =
	   {{ auth('web')->check() ? 'true' : 'false' }}
	  if (auth == true) {
	   var auth = {{ auth()->check() ? 'true' : 'false' }};
	   var optionsId = 'options_' + serviceId;
	   var qtyId = 'qty_' + serviceId;
	   var photo = document.getElementById(optionsId).value;
	    console.log(photo);
	   var qty = document.getElementById(qtyId).value;

	   $.ajaxSetup({
	    headers: {
	     'X-CSRF-TOKEN': '{{ Session::token() }}'
	    }
	   });
	   $.ajax({
	    type: "POST",
	    url: '<?php echo e(route('user.cart.store')); ?>',
	    data: {
	     qty: qty,
	     type: 'service',
	     options: {
	      'image': photo,
	      'product_type': 'service'
	     },
	     product_id: serviceId,
	    },
	    success: function(data) {
	     updateCartDropDown();
	     new swal({
	      buttons: true,
	      icon: "success",
	      timer: 3000,
	      text: "Service  added in Cart"
	     });
	    }

	   })
	  } else {
	   new swal({
	    buttons: false,
	    icon: "error",
	    timer: 2000,
	    text: "Please Login First"
	   });
	   location.href = ('{{ route('auth.login') }}')
	  }
	 }
	</script>
	<script>
		/*-------------------
      Quantity change
  --------------------- */
		var proQty = $(".pro-qty");
		proQty.prepend('<span class="dec qtybtn">-</span>');
		proQty.append('<span class="inc qtybtn">+</span>');
		proQty.on("click", ".qtybtn", function () {
			var $button = $(this);
			var oldValue = $button.parent().find("input").val();
			if ($button.hasClass("inc")) {
				var newVal = parseFloat(oldValue) + 1;
			} else {
				// Don't allow decrementing below zero
				if (oldValue > 0) {
					var newVal = parseFloat(oldValue) - 1;
				} else {
					newVal = 0;
				}
			}
			$button.parent().find("input").val(newVal);
			$button.parent().find("input").attr("value", newVal);
		});
	</script>

@endsection
