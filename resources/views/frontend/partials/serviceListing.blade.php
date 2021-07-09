    <!-- popular services section -->
    <section class="popular-section">
      <div class="container">
        <div class="section-title pb-3">
          <h2>Popular Services</h2>
        </div>

        <div class="row">

          @foreach ($services as $service)
          <div class="col-md-3">
            <div class="service-card">
              <div class="imgbox">
                <img
                  src="{{resize_image_url($service->featured_image,'600X600')}}"
                  alt=""
                />

                <div class="overlay">
                  <a href="{{route('service.detail',$service->id)}}" class="btn btn-primary"> Book Now </a>
                </div>
              </div>
              <h3 class="title">{{$service->title}}</h3>
              <div class="price">starting from<span>RS.{{$service->service_charge}}</span></div>
            </div>
          </div>
          @endforeach

        </div>
      </div>
    </section>
    <!-- popular services section -->