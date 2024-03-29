@if ($parlors->count() > 0)
	<!-- --------- Shop Listing---------- -->
	<section class="shop-listing">
		<div class="container">
			<div class="section-title pb-2">
				<h2>Popular Parlours</h2>
			</div>

			<div class="row">
				@foreach ($parlors->where('featured', '1')->take(8) as $parlor)
					<div class="col-md-3 col-sm-6">
						<div class="card">
							<a href="{{ route('parlourInfo', $parlor->slug) }}" class="img-box">
								{{-- <img src="{{map_storage_path_to_link($parlor->feature_image)}}" alt="{{$parlor->name}}"> --}}
								<img src="{{ resize_image_url($parlor->feature_image, '600X600') }}" alt="{{ $parlor->name }}">
							</a>
							<div class="card-body">
								<h3><a href="{{ route('parlourInfo', $parlor->slug) }}">
										{{ str_limit($parlor->name, 30) }}
									</a></h3>
								<p>{{ $parlor->address }}</p>
							</div>
						</div>
					</div>
				@endforeach

			</div>
			<div class="d-flex justify-content-center">
				<a href="{{ route('parlour.index') }}">
					View all Parlours<i class="fa fa-long-arrow-right ml-3" aria-hidden="true"></i>
				</a>
			</div>
		</div>
	</section>
	<!-- --------- Shop Listing---------- -->

@endif
