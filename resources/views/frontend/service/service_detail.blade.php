@extends('frontend.layouts.app')
@section('meta')
@endsection
@section('body')
<<<<<<< HEAD
    <!-- services explorer -->
    <section class="services-explorer">
        <div class="container-fluid">
            <div class="section-title">
                <h1>{{$service->serviceCategory->name}}</h1>
            </div>
            <div class="row">
                <div class="col-md-3 first-col">
                    <div class="sticky-wrapper">
                        <ul class="nav nav-tabs" id="serviceExplorer" role="tablist">
                            <?php $serviceCategoryCount = 0;
                            $serviceCategoryServicesCount = 0;
                            ?>
                            @foreach($serviceCategories as $category)
                                <li class="nav-item">
                                    <a
                                            class="nav-link {{$category->id==$service->category_id?'active':''}}"
                                            id="{{$category->slug}}"
                                            data-toggle="tab"
                                            href="{{'#'.$category->slug.'content'}}"
                                            role="tab"
                                            aria-controls="home"
                                            aria-selected="true"
                                    >
                                        {{$category->name}}
                                    </a>
                                    <?php $serviceCategoryCount++ ?>
                                </li>
                            @endforeach
                        </ul>
                        @isset($recommended)
                        <!-- other services -->
                            <div class="other-services">
                                <h2>You may also like</h2>
                                <div class="other-services-container">
                                    @foreach ($recommended as $recommend)
                                        <a href="{{route('service_category.detail',$recommend->slug)}}" class="card">
                                            <img src="{{resize_image_url($recommend->banner_image,'200X200')}}" alt="">
                                            <h3>{{$recommend->title}}</span> </h3>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                            <!-- other services -->
                        @endisset
                    </div>
                </div>
                <div class="col-md-4 second-col">
                    <div class="tab-content" id="serviceExplorerContent">
                        @foreach($serviceCategories as $category)
                            <div
                                    class="tab-pane fade {{$category->id==$service->category_id?'show active':''}}"
                                    id="{{$category->slug.'content'}}"
                                    role="tabpanel"
                            >
                                @if(!$category->services->isEmpty())
                                    @foreach($category->services as $allCategoryServices)
                                        <div class="service-explore-card">
                                            <div class="rating">
                                                <i class="fa fa-star"></i> 4.5
                                                {{--TODO:: write function to calculate service review --}}
                                            </div>
                                            <div class="intro">
                                                <h2 onclick="openServiceDeatilSection('{{$allCategoryServices->id}}')"
                                                    class="dexExpTitle">{{$allCategoryServices->title}}</h2>
                                                {{--                                                TODO:: write code to popup which will display on mobile version only--}}
                                                <h2 onclick="openServiceDeatilSection('{{$allCategoryServices->id}}')"
                                                    class="mbExpTitle" data-target="#mbServiceExPopup"
                                                    data-toggle="modal">{{$allCategoryServices->title}}</h2>
                                                <p>
                                                    {!! $allCategoryServices->short_description !!}
                                                </p>
                                            </div>
                                            <div class="thumbnail">
                                                @foreach ($allCategoryServices->images as $image)
                                                    <img
                                                            src="{{resize_image_url($image->image,'200X200')}}"
                                                            alt="{{$allCategoryServices->title}}"
                                                            id="options_{{$allCategoryServices->id}}"
                                                            style="width: 180px;height: 140px"
                                                    />
                                                @endforeach
                                            </div>

                                            <ul class="details">
                                                <li>Duration:
                                                    <strong>{{$allCategoryServices->min_duration .' to ' .$allCategoryServices->max_duration}} {{$allCategoryServices->max_duration_unit}} </strong>
                                                </li>
                                            </ul>
                                            <div class="price"
                                                 style="color: #21a179;font-weight: 600;">{{convert($allCategoryServices->service_charge)}}</div>
                                            <div class="quantity">
                                                <div class="pro-qty">
                                                    <input type="text" id="qty_{{$allCategoryServices->id}}" value="1"/>
                                                </div>
                                                <a onclick="addServiceToCart({{$allCategoryServices->id}})" href="#"
                                                   class="primary-btn pd-cart">Add To Cart</a>
                                            </div>

                                            <a onclick="openServiceDeatilSection('{{$allCategoryServices->id}}')"
                                               href="#" class="view-btn">View Details <i
                                                        class="fa fa-chevron-right"></i></a>
                                            <a onclick="openServiceDeatilSection('{{$allCategoryServices->id}}')"
                                               href="#" data-target="#mbServiceExPopup" data-toggle="modal"
                                               class="view-btn-mobile">View Details <i
                                                        class="fa fa-chevron-right"></i></a>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <?php $serviceCategoryServicesCount++; ?>
                        @endforeach
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="service-sub-details">

                    </div>


                </div>

            </div>
        </div>
    </section>
    <!-- services explorer -->

    <div class="modal fade" id="mbServiceExPopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
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
=======
	<!-- services explorer -->
	<section class="services-explorer">
		<div class="container-fluid">
			<div class="section-title">
				<h1>{{ $service->serviceCategory->name }}</h1>
			</div>
			<div class="row">
				<div class="col-md-3 first-col">
					<div class="sticky-wrapper">
						<ul class="nav nav-tabs" id="serviceExplorer" role="tablist">
							<?php $serviceCategoryCount = 0;
							$serviceCategoryServicesCount = 0;
							?>
							@foreach ($serviceCategories as $category)
								<li class="nav-item">
									<a class="nav-link {{ $category->id == $service->category_id ? 'active' : '' }}" id="{{ $category->slug }}" data-toggle="tab" href="{{ '#' . $category->slug . 'content' }}" role="tab"
										aria-controls="home" aria-selected="true">
										{{ $category->name }}
									</a>
									<?php $serviceCategoryCount++; ?>
								</li>
							@endforeach
						</ul>
						@isset($recommended)
							<!-- other services -->
							<div class="other-services">
								<h2>You may also like</h2>
								<div class="other-services-container">

									@foreach ($recommended as $recommend)
										<a href="{{ route('service_category.detail', $recommend->slug) }}" class="card">
											<img src="{{ resize_image_url($recommend->banner_image, '200X200') }}" alt="">
											<h3>{{ $recommend->title }}</span> </h3>
										</a>
									@endforeach


								</div>

							</div>
							<!-- other services -->
						@endisset
					</div>
				</div>
				<div class="col-md-4 second-col">
					<div class="tab-content" id="serviceExplorerContent">
						@foreach ($serviceCategories as $category)
							<div class="tab-pane fade {{ $category->id == $service->category_id ? 'show active' : '' }}" id="{{ $category->slug . 'content' }}" role="tabpanel">
								@if (!$category->services->isEmpty())
									@foreach ($category->services as $allCategoryServices)
										<div class="service-explore-card">
											<div class="rating">
												<i class="fa fa-star"></i> 4.5
												{{-- TODO:: write function to calculate service review --}}
											</div>
											<div class="intro">
												<h2 onclick="openServiceDeatilSection('{{ $allCategoryServices->id }}')" class="dexExpTitle">{{ $allCategoryServices->title }}</h2>
												{{-- TODO:: write code to popup which will display on mobile version only --}}
												<h2 onclick="openServiceDeatilSection('{{ $allCategoryServices->id }}')" class="mbExpTitle" data-target="#mbServiceExPopup" data-toggle="modal">{{ $allCategoryServices->title }}
												</h2>
												<p>
													{!! $allCategoryServices->short_description !!}
												</p>
											</div>
											<div class="thumbnail">
												@foreach ($allCategoryServices->images as $image)
													<img src="{{ resize_image_url($image->image, '200X200') }}" alt="{{ $allCategoryServices->title }}" id="options_{{ $allCategoryServices->id }}"
														style="width: 180px;height: 140px" />
												@endforeach
											</div>

											<ul class="details">
												<li>Duration:
													<strong>{{ $allCategoryServices->min_duration . ' to ' . $allCategoryServices->max_duration }} {{ $allCategoryServices->max_duration_unit }} </strong>
												</li>
											</ul>
											<div class="price" style="color: #21a179;font-weight: 600;">{{ convert($allCategoryServices->service_charge) }}</div>
											<div class="quantity">
												<div class="pro-qty">
													<input type="text" id="qty_{{ $allCategoryServices->id }}" value="1" />
												</div>
												<a onclick="addServiceToCart({{ $allCategoryServices->id }})" href="#" class="primary-btn pd-cart">Add To Cart</a>
											</div>

											<a onclick="openServiceDeatilSection('{{ $allCategoryServices->id }}')" href="#" class="view-btn">View Details <i class="fa fa-chevron-right"></i></a>
											<a onclick="openServiceDeatilSection('{{ $allCategoryServices->id }}')" href="#" data-target="#mbServiceExPopup" data-toggle="modal" class="view-btn-mobile">View Details <i
													class="fa fa-chevron-right"></i></a>
										</div>
									@endforeach
								@endif
							</div>
							<?php $serviceCategoryServicesCount++; ?>
						@endforeach
					</div>
				</div>

				<div class="col-md-5">
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
>>>>>>> e3079069193ebb45b5a86b4fb45661a695e7e108
@endsection

@section('js')
	<script>
	 $(document).ready(function() {
	  openServiceDeatilSection('{{ $service->id }}')
	 });

	 function openServiceDeatilSection(serviceId) {
	  // alert(serviceId);

	  $.post('{{ route('service.detail.click') }}', {
	   _token: '{{ @csrf_token() }}',
	   serviceId: serviceId
	  }, function(data) {
	   $('.service-sub-details').html('');
	   $('.service-sub-details').html(data);
	   $('.service-sub-details').attr('style', 'display:contents');
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
