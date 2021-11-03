				<!-- schedule form -->
				<section id="browseServices" class="schedule-section bg-light">
				{{-- <div class="section-title pb-2">
            <br>
            <h2>Browse Best Service From Us</h2>
        </div> --}}
				<div class="row mx-0">
				<div class="col-md-4 p-0">
				<div class="schedule-right">
				<div class="overlay">
				<ul class="nav nav-tabs" id="popService" role="tablist">
				<?php
				$parentCategories = app(\Modules\ServiceCategories\Contracts\ServiceCategoryService::class)->getParentCategoryOnly();
				?>

				@foreach ($parentCategories as $category)
				<li class="nav-item">
				<a class="nav-link {{ $loop->index == 0 ? 'active' : '' }}" id="ServiceTab{{ $loop->index + 1 }}" data-toggle="tab" href="#serviceTab_content{{ $loop->index + 1 }}" role="tab"
				aria-controls="home" aria-selected="true">
				{{ $category->name }}
				</a>
				</li>
				@endforeach

				</ul>
				</div>
				</div>
				</div>
				<div class="col-md-8 p-0">
				<div class="tab-content" id="popServiceContent">
				<div class="section-title">
				{{-- <h2>{{$categoryContent->name}}</h2> --}}
				<h2>Browse Best Service From Us</h2>
				</div>
				@foreach ($parentCategories as $categoryContent)
				<div class="tab-pane fade {{ $loop->index == 0 ? 'show active' : '' }}" id="serviceTab_content{{ $loop->index + 1 }}" role="tabpanel">

				<div class="services-section d-nne">
				<div class="container">
				<div class="row">
				<?php
				$firstLevelCategories = app(\Modules\ServiceCategories\Contracts\ServiceCategoryService::class)->getChildren($categoryContent->id);
				?>
				@foreach ($firstLevelCategories as $firstLevelCategory)
				<a href="{{ route('service_category.detail', $firstLevelCategory->slug) }}" class="col">
				<div class="img-box">
				<img src="{{ URL::asset('frontend/img/icons/bride.svg') }}" alt="" />
				</div>
				<h3 style="text-transform: capitalize">{{ $firstLevelCategory->name }}</h3>
				</a>
				@endforeach

				</div>
				</div>
				</div>
				</div>
				@endforeach


				</div>
				</div>
				</div>
				</section>
				<!-- schedule form -->

				{{-- <!-- call to action --> --}}
				{{-- <div --}}
				{{-- style=" --}}
				{{-- background: url(img/salon\ vector.svg), --}}
				{{-- linear-gradient( --}}
				{{-- 62.57deg, --}}
				{{-- #4d118b 0%, --}}
				{{-- #672084 27%, --}}
				{{-- #6e1d8a 63%, --}}
				{{-- #342879 100% --}}
				{{-- ); --}}
				{{-- " --}}
				{{-- class="cta" --}}
				{{-- > --}}
				{{-- <h2> --}}
				{{-- No time to go to the Salon? --}}
				{{-- <div>Murarkey provides Beauty Parlour Services at Home.</div> --}}
				{{-- </h2> --}}
				{{-- @php --}}
				{{-- $category = $firstLevelCategories = app(\Modules\ServiceCategories\Contracts\ServiceCategoryService::class)->getChildren($parentCategories->first()->id); --}}
				{{-- @endphp --}}
				{{-- <a href="{{route('service_category.detail',$category->first()->slug)}}" class="cta-btn"> Book an Appointment </a> --}}
				{{-- </div> --}}
				{{-- <!-- call to action --> --}}
