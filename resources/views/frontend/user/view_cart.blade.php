@extends('frontend.layouts.app')
@section('meta')
	@include('frontend.partials.ogForIndexPage')
@endsection
@section('body')
	@include('flash::message')
	<!-- Breadcrumb Section Begin -->
	<div class="breacrumb-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="breadcrumb-text product-more">
						<a href="{{ URL::to('/') }}"><i class="fa fa-home"></i> Home</a>
						<a href="{{ URL::to('products/search') }}">Shop</a>
						<span>Shopping Cart</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Breadcrumb Section Begin -->

	@include('frontend.partials.cart.cart_detail')

@endsection

@section('js')
	<script>
	 $(".submitcart").click(function(e) {
	  e.preventDefault();
	  $(".submitcartform").submit();
	 });
	</script>


@endsection
