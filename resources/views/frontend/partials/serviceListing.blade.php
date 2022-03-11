<!-- popular services section -->
<section class="popular-section">
    <div class="container">
        <div class="section-title pb-3">
            <h2>Popular Services at Home</h2>
        </div>

        <div class="row">
            @foreach ($services->take(8) as $service)
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="service-card">
                        <div class="imgbox">
                            <a href="{{route('service.detail',$service->id)}}">
                                <img
                                        src="{{resize_image_url($service->featured_image,'600X600')}}"
                                        alt="{{$service->title}}">
                                <input type="hidden" id="options_{{$service->id}}" name="options[photo]"
                                       value="{!! resize_image_url($service->featured_image,'200X200') !!}">
                                />
                            </a>
                            <div class="duration">
                                <i class="fa fa-clock-o"></i>
                                {{$service->min_duration.' '.$service->min_duration_unit." to ".$service->max_duration.' '.$service->max_duration_unit}}
                            </div>

                        </div>
                        <a href="{{route('service.detail',$service->id)}}">
                            <h3 class="title">{{$service->title}}</h3>
                            <div class="price">Price: <strong>{{convert($service->applyDiscount())}}</strong>

                                @if($service->price!=$service->applyDiscount())
                                    <span class="old-price" style="text-decoration: line-through;font-weight:400;margin-left: 13px">{{ convert($service->price) }}</span>
                                @endif
                            </div>
                        </a>
                        <div class="quantity  mt-4">
                            <div class="pro-qty">
                                <input id="qty_{{$service->id}}" type="text" value="1"/>
                            </div>
                            <a onclick="addServiceToCart({{$service->id}})" href="#" class="primary-btn pd-cart ">Add To
                                Cart</a>
                        </div>
                    </div>
                </div>

            @endforeach
        </div>
    </div>
</section>
<!-- popular services section -->