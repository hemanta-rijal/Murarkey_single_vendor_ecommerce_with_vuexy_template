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
                            @if(!$parlour->services->isEmpty())
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
                                                @foreach($parlour->services as $service)
                                                    <div class="service-explore-card">
                                                        {{ $service->avgRating != null ? '<div class="rating"><i class="fa fa-star"></i></div>' . $service->avgRating : '' }}
                                                        <div class="intro">
                                                            <h2 onclick="openServiceDeatilSection({{$service->id}})" class="dexExpTitle">{{$service->title}}</h2>
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
                                                            <li><span>Duration:</span>
                                                                <span>{{$service->min_duration .' to ' .$service->max_duration}} {{$service->max_duration_unit}}</span>
                                                            </li>
                                                            <div class="price"
                                                                 style="color: #21a179;font-weight: 600;">{{convert($service->applyDiscount())}}
                                                                @if($service->price!=$service->applyDiscount())
                                                                    <span class="old-price"
                                                                          style="text-decoration: line-through;font-weight:400;margin-left: 13px">{{ convert($service->price) }}</span>
                                                                @endif
                                                            </div>
                                                        </ul>
                                                        <div class="quantity">
                                                            <div class="pro-qty">
                                                                <input type="text" value="1"/>
                                                            </div>
                                                            <a href="#" onclick="addServiceToCart({{$service->id}})" class="primary-btn pd-cart">Add To Cart</a>
                                                        </div>

                                                        <a onclick="openServiceDeatilSection('{{$service->id}}')"
                                                           href="" class="view-btn"
                                                        >View Details <i class="fa fa-chevron-right"></i
                                                            ></a>
                                                        <a onclick="openServiceDeatilSection('{{$service->id}}')"
                                                           href="#" data-target="#mbServiceExPopup"
                                                           data-toggle="modal"
                                                           class="view-btn-mobile"
                                                        >View Details <i class="fa fa-chevron-right"></i
                                                            ></a>
                                                    </div>
                                                @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="service-sub-details">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else

                                <div class="alert alert-danger" role="alert">
                                    No Any Services registered with this Parlour.
                                </div>
                            @endif
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

@endsection

@section('js')
    @if(!$parlour->services->isEmpty())
        <script>
            $(document).ready(function () {
                openServiceDeatilSection('{{ $parlour->services->first()->id }}')
            });
            function openServiceDeatilSection(serviceId) {
                $.post('{{ route('service.detail.click') }}', {
                    _token: '{{ @csrf_token() }}',
                    serviceId: serviceId
                }, function (data) {
                    $('.service-sub-details').html('');
                    $('.service-sub-details').html(data);
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
    <script>
        $(document).ready(function () {
            openServiceDeatilSection('{{ $service->id }}')
        });

        function openServiceDeatilSection(serviceId) {
            // alert(serviceId);

            $.post('{{ route('service.detail.click') }}', {
                _token: '{{ @csrf_token() }}',
                serviceId: serviceId
            }, function (data) {
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
                            'image': photo,
                            'product_type': 'service'
                        },
                        product_id: serviceId,
                    },
                    success: function (data) {
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
                    if (auth == true)
                    {
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
                            success: function (data) {
                                updateCartDropDown();
                                new swal({
                                    buttons: false,
                                    icon: "success",
                                    timer: 2000,
                                    text: "Item added in Cart"
                                });
                            }
                        });
                    }
                    else
                    {
                        new swal({
                            buttons: false,
                            icon: "error",
                            timer: 2000,
                            text: "Please Login First"
                        });
                        location.href = ('{{ route('auth.login') }}')
                    }

                }

            $(".user-rating").click(function (e) {
                e.preventDefault();
                var rating = $(this).attr('data-value');
                $("#rating").val(rating);
            });
    </script>
@endsection
