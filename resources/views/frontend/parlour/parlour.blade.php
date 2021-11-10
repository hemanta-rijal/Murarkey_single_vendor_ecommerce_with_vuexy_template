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
                                                                    {{$service->service_quote}}
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

                                            <div
                                                    class="tab-pane fade"
                                                    id="serExplorerTab_content2"
                                                    role="tabpanel"
                                            >
                                                <div class="service-explore-card">
                                                    <div class="intro">
                                                        <h2>HAIR COLOR</h2>
                                                        <p>
                                                            Wide Range Of Stylish Haircuts That Suits Your Face And
                                                            Enhances Your Hair Colour
                                                        </p>
                                                    </div>
                                                    <div class="thumbnail">
                                                        <img
                                                                src="https://images.pexels.com/photos/1570807/pexels-photo-1570807.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940"
                                                                alt=""
                                                        />
                                                    </div>
                                                    <ul class="details">
                                                        <li><span>Duration:</span> <span>30-45 mins</span></li>
                                                        <li>
                                                            <span>Price</span>
                                                            <span>रू. 1200</span>
                                                        </li>

                                                        <li>
                                                            <span>Beauty Professional</span> <span>Female only</span>
                                                        </li>
                                                    </ul>

                                                    <div class="quantity">
                                                        <div class="pro-qty">
                                                            <input type="text" value="1"/>
                                                        </div>
                                                        <a href="#" class="primary-btn pd-cart">Add To Cart</a>
                                                    </div>
                                                </div>

                                                <div class="service-explore-card">
                                                    <div class="intro">
                                                        <h2>Oil Massage</h2>
                                                        <p>
                                                            Wide Range Of Stylish Haircuts That Suits Your Face And
                                                            Enhances Your Hair Colour
                                                        </p>
                                                    </div>

                                                    <div class="thumbnail">
                                                        <img
                                                                src="https://images.pexels.com/photos/3997982/pexels-photo-3997982.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940"
                                                                alt=""
                                                        />
                                                    </div>
                                                    <ul class="details">
                                                        <li><span>Duration:</span> <span>30-45 mins</span></li>
                                                        <li>
                                                            <span>Price</span>
                                                            <span>रू. 1200</span>
                                                        </li>

                                                        <li>
                                                            <span>Beauty Professional</span> <span>Female only</span>
                                                        </li>
                                                    </ul>

                                                    <div class="quantity">
                                                        <div class="pro-qty">
                                                            <input type="text" value="1"/>
                                                        </div>
                                                        <a href="#" class="primary-btn pd-cart">Add To Cart</a>
                                                    </div>
                                                </div>

                                                <div class="service-explore-card">
                                                    <div class="intro">
                                                        <h2>Ironing</h2>
                                                        <p>
                                                            Wide Range Of Stylish Haircuts That Suits Your Face And
                                                            Enhances Your Hair Colour
                                                        </p>
                                                    </div>

                                                    <ul class="details">
                                                        <li><span>Duration:</span> <span>30-45 mins</span></li>
                                                        <li>
                                                            <span>Price</span>
                                                            <span>रू. 1200</span>
                                                        </li>

                                                        <li>
                                                            <span>Beauty Professional</span> <span>Female only</span>
                                                        </li>
                                                    </ul>

                                                    <div class="quantity">
                                                        <div class="pro-qty">
                                                            <input type="text" value="1"/>
                                                        </div>
                                                        <a href="#" class="primary-btn pd-cart">Add To Cart</a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div
                                                    class="tab-pane fade"
                                                    id="serExplorerTab_content3"
                                                    role="tabpanel"
                                            >
                                                <div class="service-explore-card">
                                                    <div class="intro">
                                                        <h2>Oil Massage</h2>
                                                        <p>
                                                            Wide Range Of Stylish Haircuts That Suits Your Face And
                                                            Enhances Your Hair Colour
                                                        </p>
                                                    </div>

                                                    <div class="thumbnail">
                                                        <img
                                                                src="https://images.pexels.com/photos/3997982/pexels-photo-3997982.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940"
                                                                alt=""
                                                        />
                                                    </div>
                                                    <ul class="details">
                                                        <li><span>Duration:</span> <span>30-45 mins</span></li>
                                                        <li>
                                                            <span>Price</span>
                                                            <span>रू. 1200</span>
                                                        </li>

                                                        <li>
                                                            <span>Beauty Professional</span> <span>Female only</span>
                                                        </li>
                                                    </ul>

                                                    <div class="quantity">
                                                        <div class="pro-qty">
                                                            <input type="text" value="1"/>
                                                        </div>
                                                        <a href="#" class="primary-btn pd-cart">Add To Cart</a>
                                                    </div>
                                                </div>

                                                <div class="service-explore-card">
                                                    <div class="intro">
                                                        <h2>Ironing</h2>
                                                        <p>
                                                            Wide Range Of Stylish Haircuts That Suits Your Face And
                                                            Enhances Your Hair Colour
                                                        </p>
                                                    </div>

                                                    <div class="thumbnail">
                                                        <img
                                                                src="https://images.pexels.com/photos/3738359/pexels-photo-3738359.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940"
                                                                alt=""
                                                        />
                                                    </div>

                                                    <ul class="details">
                                                        <li><span>Duration:</span> <span>30-45 mins</span></li>
                                                        <li>
                                                            <span>Price</span>
                                                            <span>रू. 1200</span>
                                                        </li>

                                                        <li>
                                                            <span>Beauty Professional</span> <span>Female only</span>
                                                        </li>
                                                    </ul>

                                                    <div class="quantity">
                                                        <div class="pro-qty">
                                                            <input type="text" value="1"/>
                                                        </div>
                                                        <a href="#" class="primary-btn pd-cart">Add To Cart</a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div
                                                    class="tab-pane fade"
                                                    id="serExplorerTab_content4"
                                                    role="tabpanel"
                                            >
                                                four
                                            </div>

                                            <div
                                                    class="tab-pane fade"
                                                    id="serExplorerTab_content5"
                                                    role="tabpanel"
                                            >
                                                five
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="service-sub-details">
                                            <div class="service-sub-card">

                                                <div id="service-sub-carousel" class="carousel owl-carousel">
                                                    <img
                                                            src="https://images.pexels.com/photos/1570807/pexels-photo-1570807.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940"
                                                            alt=""
                                                    />

                                                    <img
                                                            src="https://images.pexels.com/photos/897262/pexels-photo-897262.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940"
                                                            alt=""
                                                    />

                                                    <img
                                                            src="https://images.pexels.com/photos/2076932/pexels-photo-2076932.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500"
                                                            alt=""
                                                    />
                                                </div>

                                                <div class="top">


                                                    <div class="intro">
                                                        <h3>Burst Fade Mohawk</h3>
                                                        <p>
                                                            Wide Range Of Stylish Haircuts That Suits Your Face And
                                                            Enhances Your Hair Colour Lorem ipsum dolor sit, amet
                                                            consectetur adipisicing elit. Quibusdam exercitationem
                                                            dolores repellendus rem, ipsam voluptatem aliquam, incidunt
                                                            ratione sit quae esse labore iure magnam ut alias provident
                                                            explicabo nihil ipsa?Range Of Stylish Haircuts That Suit
                                                        </p>
                                                    </div>

                                                    <div class="price">
                                                        रू. 1200
                                                    </div>
                                                </div>

                                                <ul class="details">
                                                    <li><span>Duration:</span> <span>30-45 mins</span></li>
                                                    <li>
                                                        <span>Price</span>
                                                        <span>रू. 1200</span>
                                                    </li>

                                                    <li>
                                                        <span>Beauty Professional</span> <span>Female only</span>
                                                    </li>

                                                    <li><span>Duration:</span> <span>30-45 mins</span></li>
                                                    <li>
                                                        <span>Price</span>
                                                        <span>रू. 1200</span>
                                                    </li>

                                                    <li>
                                                        <span>Beauty Professional</span> <span>Female only</span>
                                                    </li>
                                                </ul>

                                                <div class="quantity">
                                                    <div class="pro-qty">
                                                        <input type="text" value="1"/>
                                                    </div>
                                                    <a href="#" class="primary-btn pd-cart">Add To Cart</a>
                                                </div>
                                            </div>

                                            <div class="customer-review-option">
                                                <h4>2 Comments</h4>
                                                <div class="comment-option">
                                                    <div class="co-item">
                                                        <div class="avatar-pic">
                                                            <img src="img/product-single/avatar-1.png" alt="">
                                                        </div>
                                                        <div class="avatar-text">
                                                            <div class="at-rating">
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star-o"></i>
                                                            </div>
                                                            <h5>Brandon Kelley <span>27 Aug 2019</span></h5>
                                                            <div class="at-reply">Nice !</div>
                                                        </div>
                                                    </div>
                                                    <div class="co-item">
                                                        <div class="avatar-pic">
                                                            <img src="img/product-single/avatar-2.png" alt="">
                                                        </div>
                                                        <div class="avatar-text">
                                                            <div class="at-rating">
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star"></i>
                                                                <i class="fa fa-star-o"></i>
                                                            </div>
                                                            <h5>Roy Banks <span>27 Aug 2019</span></h5>
                                                            <div class="at-reply">Nice !</div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="leave-comment mt-5 mb-2">
                                                    <h4 class="mb-3">Your Review</h4>
                                                    <form action="#" class="comment-form">
                                                        <div class="personal-rating form-group mt-3 mb-4">
                                                            <h6>Your Rating</h6>
                                                            <div class="product-rating give-stars mt-2">
                                                                <span><i class="fa fa-star"></i></span>
                                                                <span><i class="fa fa-star"></i></span>
                                                                <span><i class="fa fa-star"></i></span>
                                                                <span><i class="fa fa-star"></i></span>
                                                                <span><i class="fa fa-star"></i></span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <input type="text" placeholder="Name">
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <input type="text" placeholder="Email">
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <textarea placeholder="your review"></textarea>
                                                                <button type="submit" class="primary-btn">
                                                                    Submit
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tag-share">
                                <div class="details-tag d-none">
                                    <ul>
                                        <li><i class="fa fa-tags"></i></li>
                                        <li>Travel</li>
                                        <li>Beauty</li>
                                        <li>Fashion</li>
                                    </ul>
                                </div>
                                {{-- <div class="blog-share">
                                  <span>Share:</span>
                                  <div class="social-links">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-google-plus"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-youtube-play"></i></a>
                                  </div>
                                </div> --}}
                            </div>
                            <div class="blog-post d-none">
                                <div class="row">
                                    <div class="col-lg-5 col-md-6">
                                        <a href="#" class="prev-blog">
                                            <div class="pb-pic">
                                                <i class="ti-arrow-left"></i>
                                                <img src=" {{ asset('frontend/img/blog/prev-blog.png') }}" alt=""/>
                                            </div>
                                            <div class="pb-text">
                                                <span>Previous Post:</span>
                                                <h5>
                                                    The Personality Trait That Makes People Happier
                                                </h5>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-lg-5 offset-lg-2 col-md-6">
                                        <a href="#" class="next-blog">
                                            <div class="nb-pic">
                                                <img src="{{ asset('frontend/img/blog/next-blog.png') }}" alt=""/>
                                                <i class="ti-arrow-right"></i>
                                            </div>
                                            <div class="nb-text">
                                                <span>Next Post:</span>
                                                <h5>
                                                    The Personality Trait That Makes People Happier
                                                </h5>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="posted-by d-none">
                                <div class="pb-pic">
                                    <img src="{{ asset('frontend/img/blog/post-by.png') }}" alt=""/>
                                </div>
                                <div class="pb-text">
                                    <a href="#">
                                        <h5>Shane Lynch</h5>
                                    </a>
                                    <p>
                                        Aliquip ex ea commodo consequat. Duis aute irure dolor in
                                        reprehenderit in voluptate velit esse cillum bore et
                                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                        amodo
                                    </p>
                                </div>
                            </div>
                            <div class="leave-comment">
                                <h4>Leave A Comment</h4>
                                <form action="{{ route('post.contact-us') }}" method="POST" class="comment-form">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <input type="text" name="name" placeholder="Name" required/>
                                            {!! $errors->first('name', '<p class="text-danger">:message</p>') !!}
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="text" name="email" placeholder="Email" required/>
                                            {!! $errors->first('email', '<p class="text-danger">:message</p>') !!}
                                        </div>
                                        <div class="col-lg-12">
                                            <textarea placeholder="Messages" name="message" required></textarea>
                                            {!! $errors->first('message', '<p class="text-danger">:message</p>') !!}
                                            <button type="submit" class="site-btn">
                                                Send message
                                            </button>
                                        </div>
                                    </div>
                                </form>
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
    <script>
        {{--$(document).ready(function () {--}}
        {{--    openServiceDeatilSection('{{ $service->id }}')--}}
        {{--});--}}

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
