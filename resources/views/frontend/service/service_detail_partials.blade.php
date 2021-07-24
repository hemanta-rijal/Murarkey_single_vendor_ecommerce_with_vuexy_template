            <div class="service-sub-card">
                 <form id="service-detail-form" enctype="multipart/form-data">
                    {{-- @csrf --}}
                <div id="service-sub-carousel" class="carousel owl-carousel">
                    {{-- {{dd($service)}} --}}
                    @foreach ($service->images as $image)
                    <img src="{{resize_image_url($image->image,'200X200')}}" alt="{{$service->title}}">
                    @endforeach
                    <input type="hidden" name="options[photo]" value="{{resize_image_url($service->images->first()->image,'200X200')}}">
                    <input type="hidden" name="options[product_type]" value="service">
                    <input type="hidden" name="type" value="service">
                    <input type="hidden" name="service" value="{{true}}">
                    <input type="hidden" name="product_id" value="{{$service->id}}">
                </div>

                <div class="top">


                  <div class="intro">
                    <h3>{!!$service->title!!}</h3>
                    <p>
                        {!!$service->short_description!!}
                    </p>
                  </div>

                  <div class="price">रू. {{$service->service_charge}}</div>
                </div>

                <ul class="details">
                  <li>Duration: <strong>{{$service->min_duration . ' '.$service->min_duration_unit.' to '.$service->max_duration . ' '.$service->max_duration_unit}}</strong></li>

                  <li>
                    <span>Beauty Professional</span> <span>Female only</span>
                  </li>
                </ul>

                <div class="quantity">
                  <div class="pro-qty">
                    <input type="text"  name="qty" value="1" />
                  </div>
                  <a onclick="addServiceToCartFromDetail({{$service->id}})" href="#" class="primary-btn pd-cart">Add To Cart</a>
                </div>
                 {{-- </form> --}}
            </div>