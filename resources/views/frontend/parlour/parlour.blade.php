@extends('frontend.layouts.app')
@section('meta')

@endsection
@section('body')

    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">

                        <a href="{{ route('home') }}"><i class="fa fa-home"></i> Home</a>
                        <a href="{{ route('parlourInfo', $parlour->slug) }}">{{ $parlour->name }}</a>
                        {{ $parlour->name }}

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Product Shop Section Begin -->
    <section class="parlour-page">
        <div style="
                background: url({{ resize_image_url($parlour->feature_image, '600X600') }});
                " {{-- style="
                  background: url('https://images.pexels.com/photos/1654834/pexels-photo-1654834.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940');
                " --}} class="full-cover">
            <div class="overlay">
                <div class="logo">
                    <img src=" {{ resize_image_url($parlour->feature_image, '200X200') }}" alt=""/>
                </div>
                <h2>{{ $parlour->name }}</h2>

                <p class="">{{ $parlour->address }}</p>

                <div class="pd-rating">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-o"></i>
                    <span>(4/5)</span>
                </div>

                <div class="social-links">
                    <a class="facebook" href="{{ $parlour->facebook }}"><i class="fa fa-facebook"></i></a>
                    <a class="insta" href="{{ $parlour->instagram }}"><i class="fa fa-instagram"></i></a>
                    <a class="youtube" href="{{ $parlour->youtube }}"><i class="fa fa-youtube-play"></i></a>
                </div>
            </div>
        </div>

        <section class="blog-details spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="blog-details-inner">
                            <div class="blog-detail-title">
                                <h6 class="text-left">About {{ $parlour->name }}</h6>
                                <!-- <p>travel <span>- May 19, 2019</span></p> -->
                            </div>
                            <div class="blog-large-pic d-none">
                                <img src="{{ resize_image_url($parlour->feature_image, '200X200') }}" alt=""/>
                            </div>
                            <div class="blog-detail-desc">
                                {!! $parlour->about !!}
                            </div>
                            <h2 class="font-weight-bold mb-3">Our Services</h2>
                            <div class="parlour-service mb-5">
                                <div class="row">
                                    <div class="col-lg-6 second-col">
                                        <div class="" id="serviceExplorerContent">
                                            <div
                                                    class="tab-pane fade show active"
                                                    id="serExplorerTab_content1"
                                                    role="tabpanel"
                                            >
                                                @if($parlour->services)
                                                    @foreach($parlour->services as $service)
                                                        <div class="service-explore-card">
                                                            <div class="rating"><i class="fa fa-star"></i> 4.5</div>
                                                            <div class="intro">
                                                                <h2 class="dexExpTitle">{{$service->title}}</h2>
                                                                <h2 class="mbExpTitle" data-target="#mbServiceExPopup"
                                                                    data-toggle="modal">{{$service->title}}</h2>
                                                                <p>
                                                                    {!! $service->service_quote !!}
                                                                </p>
                                                            </div>

                                                            <div class="thumbnail">
                                                                @foreach ($service->images as $image)
                                                                    <img
                                                                            src="{{resize_image_url($image->image,'200X200')}}"
                                                                            alt="{{$service->title}}"
                                                                            id="options_{{$service->id}}"
                                                                            style="width: 180px;height: 140px"
                                                                    />
                                                                @endforeach

                                                            </div>

                                                            <ul class="details">
                                                                <li><span>Duration:</span> <span>{{$service->min_duration .' to ' .$service->max_duration}} {{$service->max_duration_unit}}</span></li>
                                                                <div class="price"
                                                                     style="color: #21a179;font-weight: 600;">{{convert($service->service_charge)}}</div>

                                                            </ul>

                                                            <div class="quantity">
                                                                <div class="pro-qty">
                                                                    <input type="text" value="1"/>
                                                                </div>
                                                                <a href="#" class="primary-btn pd-cart">Add To Cart</a>
                                                            </div>

                                                            <a onclick="openServiceDeatilSection('{{$service->id}}')" href="" class="view-btn"
                                                            >View Details <i class="fa fa-chevron-right"></i
                                                                ></a>
                                                            <a onclick="openServiceDeatilSection('{{$service->id}}')" href="#" data-target="#mbServiceExPopup"
                                                               data-toggle="modal"
                                                               class="view-btn-mobile"
                                                            >View Details <i class="fa fa-chevron-right"></i
                                                                ></a>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="service-sub-details">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
    <!-- Product Shop Section End -->
    <!-- Map Section Begin -->
    {{-- @include('frontend.partials.mapSection') --}}
    <!-- Map Section Begin -->

@endsection

@section('js')
    @if(!$parlour->services->isEmpty())

    <script>
        $(document).ready(function () {
            openServiceDeatilSection('{{ $parlour->services->first()->id }}')
        });

        function openServiceDeatilSection(serviceId) {
            // alert(serviceId);

            $.post('{{ route('service.detail.click') }}', {
                _token: '{{ @csrf_token() }}',
                serviceId: serviceId
            }, function (data) {
                $('.service-sub-details').html('');
                $('.service-sub-details').html(data);
                $('.service-sub-details').attr('style', 'display:contents');
            });

        }
    </script>
    @endif
    @if (session()->has('contact_us_success_message'))
        <script>
            Swal.fire({
                position: "center",
                icon: "success",
                title: "{!! Session()->get('contact_us_success_message') !!}",
                showConfirmButton: false,
                timer: 3500,
            });
        </script>
    @endif
@endsection
