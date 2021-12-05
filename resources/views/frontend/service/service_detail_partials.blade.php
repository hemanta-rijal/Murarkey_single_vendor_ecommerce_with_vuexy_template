<link rel="stylesheet" href="{{URL::asset('frontend/css/owl.carousel.min.css')}}" type="text/css"/>
<div class="service-sub-card">
    <div id="service-sub-carousel" class="carousel owl-carousel service-sub-carousel">
        @foreach ($service->images as $image)
            <img src="{{resize_image_url($image->image,'200X200')}}" alt="{{$service->title}}">
        @endforeach
    </div>
    <form id="service-detail-form" class="service-detail-form" enctype="multipart/form-data">
        <input type="hidden" name="options[photo]"
               value="{{resize_image_url($service->images->first()->image,'600X600')}}">
        <input type="hidden" name="options[product_type]" value="service">
        <input type="hidden" name="type" value="service">
        <input type="hidden" name="product_id" value="{{$service->id}}">

        <div class="top">
            <div class="intro">
                <h3>{!!$service->title!!}</h3>
                <p>
                    {!!$service->short_description!!}
                </p>
                @isset($service->labels)
                    @foreach ($service->labels as $servicelabel)
                        <p>
                            @isset($servicelabel->service_label)
                                <b>{!!$servicelabel->service_label->name!!}</b> :</br> {!! $servicelabel->label_value!!}
                        </p>
                        @endisset
                    @endforeach

                @endisset

            </div>

            <div class="price">{{convert($service->service_charge)}}</div>
        </div>

        <ul class="details">
            <li>Duration:
                <strong>{{$service->min_duration . ' '.$service->min_duration_unit.' to '.$service->max_duration . ' '.$service->max_duration_unit}}</strong>
            </li>
        </ul>
        {!! $service->description !!}
        <div class="quantity">
            <div class="pro-qty">
                <input type="text" id="qty_{{$service->id}}" value="1"/>
            </div>
            <a onclick="addServiceToCartFromDetail({{$service->id}})" href="#" class="primary-btn pd-cart">Add To
                Cart</a>
        </div>
     </form>
</div>

{{-- review and comment section --}}
<div class="customer-review-option">
    <h4>{{$service->reviews->count()}} Comments</h4>
    <div class="comment-option">
        @foreach($service->reviews->take(5) as $review)
            <div class="co-item">
                <div class="avatar-pic">
                    <img src="{{$review->user->profile_pic_url}}" alt="{{$review->user->name}}">
                </div>
                <div class="avatar-text">
                    <div class="at-rating">
                        @for ($i=1; $i<=5; $i++)
                            @if ($i<=$review->rating)
                                <i class="fa fa-star"></i>
                            @else
                                <i class="fa fa-star-o"></i>
                            @endif
                        @endfor
                    </div>
                    <h5>{{$review->user->name}} <span>{{$review->formated_created_at}}</span></h5>
                    <div class="at-reply">{{$review->comment}}</div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- review and comment section --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(get_can_review($service->id))
        <div class="leave-comment mt-5 mb-2">
            <h4 class="mb-3">Your Review</h4>
            <form action="{{route('user.reviews.store')}}" method="POST" class="comment-form">
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
                    <input type="hidden" name="rating" id="rating" required/>
                    <input type="hidden" name="reviewable_id" value="{{$service->id}}">
                    <input type="hidden" name="reviewable_type" value="App\Models\Service">
                </div>
                <div class="row">
                    <div class="col-lg-12 mt-3 mb-4">
                        <textarea placeholder="your review" class="form-control" name="comment">

                        </textarea>
                    </div>
                    <div></div>
                    <div class="col-lg-6 mt-3 mb-4">
                        <button type="submit" class="primary-btn ">
                            Submit
                        </button>
                    </div>
                </div>
            </form>
        </div>
    @endif
</div>


<script src="{{URL::asset('frontend/js/owl.carousel.min.js')}}"></script>
<script>
    $(".service-sub-carousel").owlCarousel({
        loop: true,
        margin: 0,
        nav: true,
        items: 1,
        dots: false,
        animateOut: "fadeOut",
        animateIn: "fadeIn",
        navText: ['<i class="ti-angle-left"></i>', '<i class="ti-angle-right"></i>'],
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true,
    });

    $(".user-rating").click(function (e) {
        e.preventDefault();
        var rating = $(this).attr('data-value');
        $("#rating").val(rating);
    });
</script>

