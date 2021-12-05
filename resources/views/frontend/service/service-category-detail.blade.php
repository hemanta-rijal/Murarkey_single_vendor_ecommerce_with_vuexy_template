@extends('frontend.layouts.app')
@section('meta')
@endsection
@section('body')
	<!-- services explorer -->
	<section class="services-explorer">
		<div class="container-fluid">
			<div class="section-title">
				<h1>{{ $serviceCategory->name }}</h1>
			</div>
			<div class="row">
				<div class="col-md-3 first-col">
					<div class="sticky-wrapper">
						<ul class="nav nav-tabs" id="serviceExplorer" role="tablist">
							<?php $thirdChildTabCount = 0;
							$thirdChildTabForServicesDetailCount = 0;
							?>
							@foreach ($serviceCategoryChild as $thirdChild)
								<li class="nav-item">
									<a class="nav-link {{ $thirdChildTabCount == 0 ? 'active' : '' }}" id="{{ $thirdChild->slug }}" data-toggle="tab" href="{{ '#' . $thirdChild->slug . 'content' }}" role="tab" aria-controls="home"
										aria-selected="true">
										{!! $thirdChild->name !!}
									</a>
								</li>
								<?php $thirdChildTabCount++; ?>
							@endforeach
						</ul>
						<!-- other services -->
						<div class="other-services">
							<h2>You may also like</h2>
							<div class="other-services-container">
								@isset($recommended)
									@foreach ($recommended as $recommend)
										<a href="{{ route('service_category.detail', $recommend->slug) }}" class="card">
											<img src="{{ resize_image_url($recommend->banner_image, '200X200') }}" alt="">
											<h3>{{ $recommend->title }}</span> </h3>
										</a>
									@endforeach
								@endisset

							</div>

						</div>
						<!-- other services -->
					</div>
				</div>
				<div class="col-md-4 second-col">
					<div class="tab-content" id="serviceExplorerContent">
						@foreach ($serviceCategoryChild as $thirdChild)
							<div class="tab-pane fade {{ $thirdChildTabForServicesDetailCount == 0 ? 'show active' : '' }}" id="{{ $thirdChild->slug . 'content' }}" role="tabpanel">
								@if (!$thirdChild->services->isEmpty())
									@foreach ($thirdChild->services as $service)
										<div class="service-explore-card">
											{{ $service->avgRating != null ? '<div class="rating"><i class="fa fa-star"></i></div>' . $service->avgRating : '' }}
											<div class="intro">
												<h2 onclick="openServiceDeatilSection('{{ $service->id }}')" class="dexExpTitle">{{ $service->title }}</h2>
												{{-- TODO:: write code to popup which will display on mobile version only --}}
												<h2 onclick="openServiceDeatilSection('{{ $service->id }}')" class="mbExpTitle" data-target="#mbServiceExPopup" data-toggle="modal">{{ $service->title }}</h2>
												<p>
													{!! $service->service_quote !!}
												</p>
											</div>
											<div class="thumbnail">
												@foreach ($service->images as $image)
													<img src="{{ resize_image_url($image->image, '200X200') }}" alt="{{ $service->title }}" id="options_{{ $service->id }}" style="width: 180px;height: 140px" />
												@endforeach
											</div>
											<ul class="details">
												<li>Duration:
													<strong>{{ $service->min_duration . ' to ' . $service->max_duration }} {{ $service->max_duration_unit }} </strong>
												</li>

											</ul>
											<div class="price" style="color: #21a179;font-weight: 600;">{{ convert($service->service_charge) }}</div>
											<div class="quantity">
												<div class="pro-qty">
													<input type="text" id="qty_{{ $service->id }}" value="1" />
												</div>
												<a onclick="addServiceToCart({{ $service->id }})" href="#" class="primary-btn pd-cart">Add To Cart</a>
											</div>
											<a onclick="openServiceDeatilSection('{{ $service->id }}')" href="#" class="view-btn">View Details <i class="fa fa-chevron-right"></i></a>
											<a onclick="openServiceDeatilSection('{{ $service->id }}')" href="#" data-target="#mbServiceExPopup" data-toggle="modal" class="view-btn-mobile">View Details <i
													class="fa fa-chevron-right"></i></a>
										</div>
									@endforeach
								@endif
							</div>
							@php
								$thirdChildTabForServicesDetailCount++;
							@endphp
						@endforeach
					</div>
				</div>
				<div class="col-md-5 ">

					<div class="service-sub-details">

					</div>

				</div>
			</div>
		</div>
	</section>
	<!-- services explorer -->
	<div class="modal fade" id="mbServiceExPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="service-sub-details">

					</div>
				</div>

			</div>
		</div>
	</div>
@endsection

@section('js')
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
	<script>
	 $(document).ready(function() {
	  openServiceDeatilSection('{{ $serviceCategoryChild->first()->services->count() ? $serviceCategoryChild->first()->services->first()->id : null }}')
	 });

	 function openServiceDeatilSection(serviceId) {
	  $.post('{{ route('service.detail.click') }}', {
	   _token: '{{ @csrf_token() }}',
	   serviceId: serviceId
	  }, function(data) {
	   console.log(data);
	   $('.service-sub-details').html('');
	   $('.service-sub-details').html(data);
	   // $('.service-sub-details').attr('style', 'display:contents');
	  });
	 }
	</script>
	<script>
	 function addServiceToCart(serviceId) {
	  var auth =
	   {{ auth('web')->check() ? 'true' : 'false' }}
	  if (auth == true) {
	   var auth = {{ auth()->check() ? 'true' : 'false' }};
	   var optionsId = 'options_' + serviceId;
	   var qtyId = 'qty_' + serviceId;
	   var photo = document.getElementById(optionsId).src;
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
	     service: true,
	     type: 'service',
	     options: {
	      'photo': photo,
	      'product_type': 'service'
	     },
	     product_id: serviceId,
	    },
	    success: function(data) {
	     updateCartDropDown();
	     new swal({
	      buttons: false,
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

	 function addServiceToCartFromDetail(serviceId) {
	  var auth =
	   {{ auth('web')->check() ? 'true' : 'false' }}
	  if (auth == true) {
	   $.ajaxSetup({
	    headers: {
	     'X-CSRF-TOKEN': '{{ Session::token() }}'
	    }
	   });
	   $.ajax({
	    type: "POST",
	    url: '<?php echo e(route('user.cart.store')); ?>',
	    data: $('#service-detail-form').serializeArray(),
	    // data:{'product_id':serviceId },
	    success: function(data) {
	     updateCartDropDown();
	     new swal({
	      buttons: false,
	      icon: "success",
	      timer: 2000,
	      text: "Item added in Cart"
	     });
	    }
	   });
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

	 $(".user-rating").click(function(e) {
	  e.preventDefault();
	  var rating = $(this).attr('data-value');
	  $("#rating").val(rating);
	 });
	</script>
@endsection
