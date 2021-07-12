

    <!-- popular services section -->
    <section class="popular-section">
      <div class="container">
        <div class="section-title pb-3">
          <h2>Popular Services</h2>
        </div>

        <div class="row">
          @foreach ($services as $service)
          <div class="col-md-4">
            <div class="service-card">
              <div class="imgbox">
                <img
                        src="{{resize_image_url($service->featured_image,'600X600')}}"
                        alt=""
                />
                <div class="duration">
                  <i class="fa fa-clock-o"></i>
                  {{$service->min_duration.' '.$service->min_duration_unit." to ".$service->max_duration.' '.$service->max_duration_unit}}
                </div>

              </div>
              <h3 class="title">{{$service->title}}</h3>
              <div class="price">starting from <span>RS. {{$service->service_charge}}</span></div>
              <div class="quantity  mt-4">
                <div class="pro-qty">
                  <input type="text" value="1" />
                </div>
                <a href="#" class="primary-btn pd-cart ">Add To Cart</a>
              </div>
            </div>
          </div>

         @endforeach
        </div>
      </div>
    </section>
    <!-- popular services section -->