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
                    <div class="col-sm-4">
                      <img src=" {{ asset('frontend/img/makeup at home.jpe')}}g" alt="" />

                      <h3>Makeup at home</h3>

                      <a href="" class="book-btn">
                        Book Now <i class="fa fa-arrow-right"></i>
                      </a>
                    </div>
                    <div class="col-sm-4">
                      <img src=" {{ asset('frontend/img/bridal.jpg')}}" alt="" />

                      <h3>Bridal makeup</h3>

                      <a href="" class="book-btn">
                        Book Now <i class="fa fa-arrow-right"></i>
                      </a>
                    </div>
                    <div class="col-sm-4">
                      <img src=" {{ asset('frontend/img/parlour at home.jpe')}}g" alt="" />
                      <h3>Makeup at home</h3>

                      <a href="" class="book-btn">
                        Book Now <i class="fa fa-arrow-right"></i>
                      </a>
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
                  <div class="blog-share">
                    <span>Share:</span>
                    <div class="social-links">
                      <a href="#"><i class="fa fa-facebook"></i></a>
                      <a href="#"><i class="fa fa-twitter"></i></a>
                      <a href="#"><i class="fa fa-google-plus"></i></a>
                      <a href="#"><i class="fa fa-instagram"></i></a>
                      <a href="#"><i class="fa fa-youtube-play"></i></a>
                    </div>
                  </div>
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
                  <form action="#" class="comment-form">
                    <div class="row">
                      <div class="col-lg-6">
                        <input type="text" placeholder="Name" />
                      </div>
                      <div class="col-lg-6">
                        <input type="text" placeholder="Email" />
                      </div>
                      <div class="col-lg-12">
                        <textarea placeholder="Messages"></textarea>
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
    <div class="map spad">
      <div class="map-inner">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3533.3318668077395!2d85.3218043149497!3d27.676136033469994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb1995401331c1%3A0x954710647720c857!2sMurarkey%20(Unlock%20your%20beauty)!5e0!3m2!1sen!2snp!4v1624032973874!5m2!1sen!2snp"
          width="600"
          height="450"
          style="border: 0"
          allowfullscreen=""
          loading="lazy"
        ></iframe>
      </div>
    </div>
    <!-- Map Section Begin -->

@endsection

