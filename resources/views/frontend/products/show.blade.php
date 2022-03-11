@extends('frontend.layouts.app')
@section('meta')

@endsection
@section('body')
	@php
		$to = request('currency');
	@endphp

	<!-- Header Section Begin -->
	<div id="useHeader"></div>
	<!-- Header End -->
	<!-- Breadcrumb Section Begin -->
	<div class="breacrumb-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="breadcrumb-text product-more">

						<a href="{{URL::to('/')}}"><i class="fa fa-home"></i> Home</a>
						@isset($product->category)
							<a href="{{ products_search_route($product->category->slug) }}">{!! $product->category->name !!}</a>
						@endisset
						 {!! str_limit($product->name, 40) !!}

					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Breadcrumb Section Begin -->

	<!-- Product Shop Section Begin -->
	<section class="product-shop spad page-details">
		<div class="container">
			<div class="row">
				<!--  -->


				<!--  -->
				<div class="col-lg-12 mx-auto">
					<div class="row">
						<div class="col-lg-6">
							<div class="product-pic-zoom">
								@if ($product->images->count() > 0)
									<img class="product-big-img" src="{{ resize_image_url($product->featured_image, '600X600') }}" alt="{{ $product->slug }}" />
								@endif
								<div class="zoom-icon">
									<i class="fa fa-search-plus"></i>
								</div>
							</div>
							<div class="product-thumbs">
								<div class="product-thumbs-track ps-slider owl-carousel">
									@foreach ($product->images as $image)
										<div class="pt  {{ $loop->first ? 'active' : '' }}" data-imgbigurl="{{ resize_image_url($image->image, '600X600') }}">
											<img src="{{ resize_image_url($image->image, '50X50') }}" alt="{{ $product->slug }}" />
										</div>
									@endforeach
								</div>
							</div>
						</div>
						{{-- {{$image->image}} --}}
						<div class="col-lg-6">
							<form id="option-choice-form">
								@csrf
								<div class="product-details">
									<div class="pd-title">
										@isset($product->category)
											<span>{{ $product->category->name }}</span>
										@endisset
										<h3>{!! $product->name !!}</h3>
											@if(Auth::guard('admin')->user()==true)
												<span style="display: inline;float: right;clear: both;color: black;font-size: 1.5rem;text-decoration: none"><a href="{!! route('admin.products.edit', $product->id) !!}" style="color: black;"><i class="fa fa-edit"></i></a></span>
											@endif

									</div>

									<div class="pd-desc mt-5">
										<input type="hidden" name="product_id" value="{{ $product->id }}">
										@isset($image)
											<input type="hidden" name="options[photo]" value="{!! resize_image_url($image->image, '200X200') !!}">
											<input type="hidden" name="options[product_type]" value="product">
											<input type="hidden" name="type" value="product">
										@endisset
										<input type="hidden" name="price" value="{{ convert($product->applyDiscount()) }}" class="actual_price" />
										<h4 class="display-total">{{ convert($product->applyDiscount()) }}
											@if($product->price!=$product->applyDiscount())
												<span class="old-price">{{ convert($product->price, $to) }}</span>
											@endif
										</h4>
									</div>
									<div class="quantity">
										<div class="pro-qty">
											<input type="text" name="qty" class='qty' id="qty-input-1" value="1" />
										</div>
										<a href="#" class="primary-btn pd-cart" onclick="addToCart({{ $product->id }})">Add
											To Cart</a>
									</div>
									<a href="#" class="heart-icon btn btn-outline-danger mb-4 btn-block" onclick="addToWishlist({{ $product->id }})" data-value="{{ $product->id }}"><i class="icon_heart_alt"></i> save in
										Wishlist </a>
									<div class="sharethis-inline-share-buttons"></div>
									<ul class="pd-tags">
										<li><span>Availability</span>:
											<b> {{ $product->total_product_units > 0 ? ' Stock Available' : 'Out Of Stock' }}</b>
										</li>
										<li><span>CATEGORIES</span>: <b><a href="{{ route('products.search', 'category=' . $product->category->slug) }}" style="color: blue;">{{ $product->category->name }}</a></b></li>
										<li><span>Brand</span>: <b><a href="{{ route('products.search', 'brand=' . $product->brand->slug) }}" style="color: blue;"> {{ $product->brand->name }}</a></b></li>
										<li><span>SKU</span>: <b>{{ $product->sku }}</b></li>
										@if ($product->attributes->count() !== 0)
											@foreach ($product->attributes as $attribute)
											<li><span>{{ $attribute->attribute->name }}</span>: <strong>{!! $attribute->setHyperLinkOnValue() !!} </strong> </li>
											@endforeach
										@endif
										@if($product->skin_tone!=null)
											<li><span>SKIN TONE</span>: <strong>{!! $product->skin_type_hyperlink !!}</strong> </li>
										@endif
										@if($product->skin_concern!=null)
											<li><span>SKIN CONCERNS</span>: <strong>{!! $product->skin_concern_hyperlink !!}</strong> </li>
										@endif
										@if($product->product_type!=null)
											<li><span>PRODUCT TYPE</span>: <strong>{!! $product->product_type_hyperlink !!}</strong> </li>
										@endif
									</ul>
								</div>
							</form>
						</div>
					</div>
					<div class="product-tab">
						<div class="tab-item">
							<ul class="nav" role="tablist">
								<li>
									<a class="active" data-toggle="tab" href="#tab-1" role="tab">DESCRIPTION</a>
								</li>
								<li>
									<a data-toggle="tab" href="#tab-2" role="tab">Specification</a>
								</li>
								<li>
									<a data-toggle="tab" href="#tab-3" role="tab">Reviews
										({!! $product->averageRating() > 0 ? '<span data-value="1" class="user-rating"><i class="fa fa-star"></i></span>' : '<strong>No Reviews</strong>' !!}
										) </a>
								</li>
							</ul>
						</div>
						<div class="tab-item-content">
							<div class="tab-content">

								<div class="tab-pane fade-in active" id="tab-1" role="tabpanel">
									<div class="product-content">
										<div class="row">
											<div class="col-lg-12">
												<h5>Details</h5>
												{!! $product->details !!}
											</div>
											@if($product->shipping_details)
												<div class="col-lg-12">
													<h5>Shipment Detail</h5>
													{!! $product->shipping_details !!}
												</div>
											@endif
											@if($product->packing_details)
												<div class="col-lg-12">
													<h5>Packaging Details</h5>
													{!! $product->packing_details !!}
												</div>
											@endif
											<div class="col-lg-12">
												@if ($product->attributes->count() !== 0)
													<div class="specification-table">
														<table>
															@foreach ($product->attributes as $attribute)
																<tr>
																	<td class="p-catagory">{{ $attribute->key }}</td>
																	<td>
																		<div class="p-price">{{ $attribute->value }}</div>
																	</td>
																</tr>
															@endforeach
														</table>
													</div>
												@endif
											</div>
										</div>
									</div>
								</div>

								<div class="tab-pane fade" id="tab-2" role="tabpanel">
									<div class="specification-table">
										<table>
											<tr>
												<td class="p-catagory">Price</td>
												<td>
													<div class="p-price">{{ convert($product->price_after_discount) }}</div>
												</td>
											</tr>
											<tr>
												<td class="p-catagory">Availability</td>
												<td>
													<div class="p-stock">{{ $product->total_product_units > 0 ? ' Stock Available' : 'Out Of Stock' }}</div>
												</td>
											</tr>
											<tr>
												<td class="p-catagory">Sku</td>
												<td>
													<div class="p-code">{{ $product->sku }}</div>
												</td>
											</tr>
										</table>
									</div>
								</div>

								<div class="tab-pane fade" id="tab-3" role="tabpanel">
									<div class="customer-review-option">
										<div class="leave-comment mt-5 mb-2">
											<h4>{{ $product->reviews->count() }} Review</h4>
											<div class="comment-option">
												@foreach ($product->reviews->take(5) as $review)
													<div class="co-item">
														<div class="avatar-pic">
															<img src="{{ $review->user->profile_pic_url }}" alt="{{ $review->user->name }}" />
														</div>
														<div class="avatar-text">
															<div class="at-rating">
																@for ($i = 1; $i <= 5; $i++)
																	@if ($i <= $review->rating)
																		<i class="fa fa-star"></i>
																	@else
																		<i class="fa fa-star-o"></i>
																	@endif
																@endfor
															</div>
															<h5>{{ $review->user->name }}
																<span>{{ $review->formated_created_at }}</span>
															</h5>
															<div class="at-reply">
																{{ $review->comment }}
															</div>
														</div>
													</div>
												@endforeach

											</div>
											@if (get_can_review($product->id))
												<h4 class="mb-3">Your Review</h4>
												<form action="{{ route('user.reviews.store') }}" method="POST" class="comment-form">
													@csrf
													<div class="personal-rating form-group mt-3 mb-4">
														<h6>Your Rating</h6>
														<div class="product-rating give-stars mt-2">
															<span data-value="1" class="user-rating"><i class="fa fa-star"></i></span>
															<span data-value="2" class="user-rating"><i class="fa fa-star"></i></span>
															<span data-value="3" class="user-rating"><i class="fa fa-star"></i></span>
															<span data-value="4" class="user-rating"><i class="fa fa-star"></i></span>
															<span data-value="5" class="user-rating"><i class="fa fa-star"></i></span>
														</div>
														<input type="hidden" name="rating" id="rating" required />
														<input type="hidden" name="product_id" value="{{ $product->id }}">
													</div>
													<div class="row">
														<div class="col-lg-12">
															<textarea placeholder="your review" name="comment"></textarea>
															<button type="submit" class="primary-btn">
																Submit
															</button>
														</div>
													</div>
												</form>
											@endif
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Product Shop Section End -->

	<!-- Related Products Section End -->
	<div class="related-products spad ">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="section-title">
						<h2>Related Products</h2>
					</div>
				</div>
			</div>
			<div class="row related-slider owl-carousel owl-theme">

				@foreach (get_similar_products_for_product_page($product) as $sim_product)
					<div class="col-lg-3 col-sm-6">
						<div class="product-item">
							<div class="pi-pic">
								<a href="{{ route('products.show', $sim_product->slug) }}">
									<img src="{{ resize_image_url($sim_product->featured_image, '200X200') }}" alt="{{ $sim_product->slug }}" />
								</a>
								<div class="icon">
									<i class="icon_heart_alt"></i>
								</div>
								<ul>
									<li class="quick-view"><a href="{{ route('products.show', $sim_product->slug) }}">Add
											to Cart</a></li>
								</ul>
							</div>
							<div class="pi-text">
								<div class="catagory-name">{!! $sim_product->category->name !!}</div>
								<a href="{{ route('products.show', $sim_product->slug) }}">
									<h5> {!! $sim_product->name !!}
									</h5>
								</a>
								<div class="product-price">{{ convert($sim_product->price_after_discount) }}</div>
							</div>
						</div>
					</div>
				@endforeach

			</div>
		</div>
	</div>
	<!-- Related Products Section End -->
	<!-- Recenty Viewed Section End -->
	{{-- {{getRecentProductsFromCookies()}} --}}
	<div class="related-products spad ">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="section-title">
						<h2>Recently viewed Products</h2>
					</div>
				</div>
			</div>
			<div class="row related-slider owl-carousel owl-theme">

				@foreach (getRecentProductsFromCookies() as $recent_product)
					@isset($recent_product)
						<div class="col-lg-3 col-sm-6">
							<div class="product-item">
								<div class="pi-pic">
									<a href="{{ route('products.show', $recent_product->slug) }}">
										<img src="{{ resize_image_url($recent_product->featured_image, '200X200') }}" alt="{{ $recent_product->slug }}" />
									</a>
									<div class="icon">
										<i class="icon_heart_alt"></i>
									</div>
									<ul>
										<li class="quick-view"><a href="{{ route('products.show', $recent_product->slug) }}">Add to Cart</a></li>
									</ul>
								</div>
								<div class="pi-text">
									<div class="catagory-name">{!! $recent_product->category->name !!}</div>
									<a href="{{ route('products.show', $recent_product->slug) }}">
										<h5> {!! $recent_product->name !!}
										</h5>
									</a>
									<div class="product-price">{{ convert($recent_product->applyDiscount()) }}</div>
								</div>
							</div>
						</div>
					@endisset
				@endforeach

			</div>
		</div>
	</div>
	<!-- Recenty Viewed Section End -->
	<!-- Modal -->
	<div class="modal fade" id="addToCart">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div id="addToCart-modal-body">

				</div>
				<div class="modal-footer">

				</div>
			</div>
		</div>
	</div>
@endsection
@section('js')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
	<script>
	 function addToCart(productId) {
	  var auth =
	   {{ auth('web')->check() ? 'true' : 'false' }}
	  if (auth == true) {
	   $.ajax({
	    type: "POST",
	    url: '<?php echo e(route('user.cart.store')); ?>',
	    data: $('#option-choice-form').serializeArray(),
	    success: function(data) {
	     updateCartDropDown();
	     swal({
	      buttons: false,
	      icon: String(data.icon),
	      timer: 2000,
	      text: data.message
	     });
	    }
	   });
	  } else {
	   swal({
	    buttons: false,
	    icon: "error",
	    timer: 2000,
	    text: "Please Login First"
	   });
	   location.href = ('{{ route('auth.login') }}')
	  }

	 }

	 function addToWishlist(productId) {
	  var auth =
	   {{ auth('web')->check() ? 'true' : 'false' }}
	  if (auth == true) {
	   $.ajax({
	    type: "POST",
	    url: '<?php echo e(route('user.wishlist.store')); ?>',
	    data: $('#option-choice-form').serializeArray(),
	    success: function(data) {
	     updateWishlistDropDown();
	     swal({
	      buttons: false,
	      icon: "success",
	      timer: 2000,
	      text: "Item added in Wishlist"
	     });
	    }

	   })
	  } else {
	   swal({
	    buttons: false,
	    icon: "error",
	    timer: 2000,
	    text: "Please Login First"
	   });
	   location.href = ('{{ route('auth.login') }}')
	  }
	 }
	</script>


	<script type="text/javascript">
	 $(document).ready(function() {
	  $("#deleteCartItemAjax").on('click', function(e) {
	   var rowId = $(this).attr('data-value');
	   $.ajaxSetup({
	    headers: {
	     'X-CSRF-TOKEN': '{{ Session::token() }}'
	    }
	   });
	   $.ajax({
	    type: 'DELETE',
	    url: '{{ url('/user/cart') }}' + '/' + rowId,
	    dataType: 'json',
	    data: {
	     'rowId': rowId,
	     '_method': 'DELETE'
	    },
	    success: function(result) {
	     swal({
	      buttons: false,
	      icon: "success",
	      timer: 2000,
	      text: result.success
	     });
	     $("div").remove('.cart-item-' + rowId);
	    },

	    error: function(result) {
	     swal({
	      buttons: false,
	      icon: "warning",
	      timer: 2000,
	      text: result.error
	     });
	    }
	   });
	  });
	 });

	 $("#deleteWishlistItem").on('click', function(e) {
	  var rowId = $(this).attr('data-value');
	  $.ajaxSetup({
	   headers: {
	    'X-CSRF-TOKEN': '{{ Session::token() }}'
	   }
	  });
	  $.ajax({
	   type: 'POST',
	   url: '{{ url('/user/wishlist') }}' + '/' + rowId,
	   dataType: 'json',
	   data: {
	    'rowId': rowId,
	    '_method': 'DELETE'
	   },
	   success: function(result) {
	    console.log(result);
	    swal({
	     buttons: false,
	     icon: "success",
	     timer: 2000,
	     text: result.success
	    });
	    $("div").remove('.cart-item-' + rowId);
	   },

	   error: function(result) {

	    console.log(result);
	    swal({
	     buttons: false,
	     icon: "warning",
	     timer: 2000,
	     text: result.error
	    });
	   }
	  });
	 });

	 $(".user-rating").click(function(e) {
	  e.preventDefault();
	  var rating = $(this).attr('data-value');
	  $("#rating").val(rating);
	 });
	</script>
@endsection
