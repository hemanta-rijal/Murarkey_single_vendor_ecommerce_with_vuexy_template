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

              <a href="{{route('home')}}"><i class="fa fa-home"></i> Home</a>
              <a href="{{route('parlourInfo',$parlour->slug)}}">{{$parlour->name}}</a>
              {{$parlour->name}}

            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Product Shop Section Begin -->
    <section class="parlour-page">
      <div
        style="
          background: url({{resize_image_url($parlour->feature_image,'600X600')}});
        "
        {{-- style="
          background: url('https://images.pexels.com/photos/1654834/pexels-photo-1654834.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940');
        " --}}
        class="full-cover"
      >
        <div class="overlay">
          <div class="logo">
            <img src=" {{ asset('frontend/img/shenaz logo.jpg') }}" alt="" />
          </div>
          <h2>{{$parlour->name}}</h2>

          <p class="">{{$parlour->address}}</p>

          <div class="pd-rating">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star-o"></i>
            <span>(4/5)</span>
          </div>

          <div class="social-links">
            <a class="facebook" href="{{$parlour->facebook}}"><i class="fa fa-facebook"></i></a>
            <a class="insta" href="{{$parlour->instagram}}"><i class="fa fa-instagram"></i></a>
            <a class="youtube" href="{{$parlour->youtube}}"><i class="fa fa-youtube-play"></i></a>
          </div>
        </div>
      </div>

      <section class="blog-details spad">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="blog-details-inner">
                <div class="blog-detail-title">
                  <h6 class="text-left">About {{$parlour->name}}</h6>
                  <!-- <p>travel <span>- May 19, 2019</span></p> -->
                </div>
                <div class="blog-large-pic d-none">
                  <img src="{{resize_image_url($parlour->feature_image, '200X200')}}" alt="" />
                </div>
                <div class="blog-detail-desc">
                  <p>{!! $parlour->about !!}
                  </p>
                </div>
                <h2 class="font-weight-bold mb-3">Our Services</h2>
                <div class="parlour-service mb-5">
                  <div class="row">
                    @isset($services)
                      @foreach ($services->take(3) as $service)
                      <div class="col-sm-4">
                        <a href="{{route('service.detail',$service->id)}}">
                          <img src=" {{resize_image_url($service->featured_image,'600X600')}}" alt="" />
                          <h3>{{$service->title}}</h3>
                        </a>
                        <a href="{{route('service.detail',$service->id)}}" class="book-btn">
                          Book Now <i class="fa fa-arrow-right"></i>
                        </a>
                      </div>
                      @endforeach
                    @endisset

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
                          <img src=" {{ asset('frontend/img/blog/prev-blog.png')}}" alt="" />
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
                          <img src="{{ asset('frontend/img/blog/next-blog.png')}}" alt="" />
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
                    <img src="{{ asset('frontend/img/blog/post-by.png')}}" alt="" />
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
                  <form action="{{route('post.contact-us')}}" method="POST" class="comment-form">
                    @csrf
                    <div class="row">
                      <div class="col-lg-6">
                        <input type="text" name="name" placeholder="Name" required />
                         {!! $errors->first('name', '<p class="text-danger">:message</p>') !!}
                      </div>
                      <div class="col-lg-6">
                        <input type="text" name="email" placeholder="Email" required />
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
    @include('frontend.partials.mapSection');
    <!-- Map Section Begin -->

@endsection

@section('js')
  @if(session()->has('contact_us_success_message'))
    <script>        
        Swal.fire({
            position: "center",
            icon: "success",
            title: "{!!Session()->get('contact_us_success_message')!!}",
            showConfirmButton: false,
            timer: 3500,
        });
    </script>
  @endif
@endsection


