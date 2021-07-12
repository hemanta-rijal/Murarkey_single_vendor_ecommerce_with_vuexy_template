<div class="service-sub-card">
    <div class="top">
        <div class="thumbnail">
            <img src="{{resize_image_url($service->featured_image,'200X200')}}" alt="{{$service->name}}">
        </div>

        <div class="intro">
            <h3>{{$service->title}}</h3>
            <p>
                {{$service->short_description}}
            </p>
        </div>

        <div class="price">रू. {{$service->service_charge}}</div>
    </div>

    <ul class="details">
        <li>Duration: <strong>{{$service->min_duration . ' '.$service->min_duration_unit.' to '.$service->max_duration . ' '.$service->max_duration_unit}}</strong></li>
        <li>Beauty Professional : Female only.</li>
    </ul>

    <div class="quantity">
        <div class="pro-qty"><span class="dec qtybtn">-</span>
            <input type="text" value="1">
            <span class="inc qtybtn">+</span></div>
        <a href="#" class="primary-btn pd-cart">Add To Cart</a>
    </div>
</div>