            
            <link rel="stylesheet" href="{{URL::asset('frontend/css/owl.carousel.min.css')}}" type="text/css" />
            <div class="service-sub-card">
              <div id="service-sub-carousel" class="carousel owl-carousel">
                @foreach ($service->images as $image)
                <img src="{{resize_image_url($image->image,'200X200')}}" alt="{{$service->title}}">
                @endforeach
              </div>
              <form id="service-detail-form" enctype="multipart/form-data">
                  <input type="hidden" name="options[photo]" value="{{resize_image_url($service->images->first()->image,'600X600')}}">
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
                      <b>{!!$servicelabel->service_label->name!!}</b> :</br> {!! $servicelabel->label_value!!}</p>
                      @endisset
                    @endforeach
                    
                    @endisset

                  </div>

                  <div class="price">{{convert($service->service_charge)}}</div>
                </div>

                <ul class="details">
                  <li>Duration: <strong>{{$service->min_duration . ' '.$service->min_duration_unit.' to '.$service->max_duration . ' '.$service->max_duration_unit}}</strong></li>
                </ul>
                {!! $service->description !!}
                <div class="quantity">
                  <div class="pro-qty">
                    <input type="text"  name="qty" value="1" />
                  </div>
                  <a onclick="addServiceToCartFromDetail({{$service->id}})" href="#" class="primary-btn pd-cart">Add To Cart</a>
                </div>
                 {{-- </form> --}}
            </div>
<script src="{{URL::asset('frontend/js/owl.carousel.min.js')}}"></script>
    <script>
        $("#service-sub-carousel").owlCarousel({
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
      </script> 
