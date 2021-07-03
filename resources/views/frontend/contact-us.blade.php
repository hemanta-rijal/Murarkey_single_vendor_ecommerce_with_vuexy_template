@extends('frontend.layouts.app')
@section('meta')
    @include('frontend.partials.ogForIndexPage')
@endsection
@section('body')
@include('flash::message')
<!-- Contact Section Begin -->
    <section class="contact-section spad">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 pl-0">
                    <div class="contact-left">
                        <div class="contact-title">
                            <h4>Contacts Us</h4>
                            <p>We Deal With Various Makeup & Cosmetic Products! We Also Provide Beauty & Grooming Services At Home.</p>
                        </div>
                        <div class="contact-widget">
                            <div class="cw-item">
                                <div class="ci-icon">
                                    <i class="ti-location-pin"></i>
                                </div>
                                <div class="ci-text">
                                    <span>Address:</span>
                                    <p>{{get_meta_by_key('full_address')}}</p>
                                </div>
                            </div>
                            <div class="cw-item">
                                <div class="ci-icon">
                                    <i class="ti-mobile"></i>
                                </div>
                                <div class="ci-text">
                                    <span>Phone:</span>
                                    <p>{{get_meta_by_key('primary_contact_number')}}</p>
                                </div>
                            </div>
                            <div class="cw-item">
                                <div class="ci-icon">
                                    <i class="ti-email"></i>
                                </div>
                                <div class="ci-text">
                                    <span>Email:</span>
                                    <p>{{get_meta_by_key('contact_email')}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6  pr-0">
                    <div class="contact-form">
                        <div class="leave-comment">
                            <h4>Drop a message</h4>
                            <p>We will get back to you soon.</p>
                            <form action="{{route('post.contact-us')}}" method="POST" class="comment-form">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input type="text" name="name" placeholder="Your name" required> 
                                          {!! $errors->first('name', '<p class="text-danger">:message</p>') !!}
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="text" placeholder="Your email" name="email" required>
                                            {!! $errors->first('email', '<p class="text-danger">:message</p>') !!}
                                        </div>
                                        <div class="col-lg-12">
                                            <textarea placeholder="Your message" name="message" required></textarea>
                                            {!! $errors->first('message', '<p class="text-danger">:message</p>') !!}
                                            <button type="submit" class="site-btn">Send message</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->

        <!-- stats section--------- -->
    <section class="stats-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-lg-3 text-center text-lg-left">
            <h2>Numbers Speak For Themselves!</h2>
          </div>
          <div class="col-md-4 col-lg-3">
            <div class="stat-card">
              <h3>{{$approvedProductCount}}+</h3>
              <p>Curated Products</p>
            </div>
          </div>
          <div class="col-md-4 col-lg-3">
            <div class="stat-card">
              <h3>{{$brandCount}}+</h3>
              <p>Brands</p>
            </div>
          </div>
          <div class="col-md-4 col-lg-3">
            <div class="stat-card">
              <h3>{{$parlourListingCount}}+</h3>
              <p>Listed Parlours</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- stats section--------- -->

    <!-- testimonial section------------ -->
    <section class="testimonial-section">
      <div class="decorative">
            <img src="{{ asset('frontend/img/leaf-free-img.png')}}" alt="">
          </div>
          <div class="container">
            <div class="row">
              <div class="col-md-6">
                <div class="testimonial-carousel">
                  <div class="testimonial-slider owl-carousel">
                @isset($testimonials)
                 @foreach ($testimonials as $testimonial)
                <div class="testimonial-item">
                  <a href=" " class="testimony-pic">
                    <img src="{{ resize_image_url($testimonial->image,'200X200')}}" alt="{{$testimonial->name}}" />
                  </a>
                  <div class="testimony-text">
                    <div class="testimony">{{$testimonial->description}}
                    </div>
                    <div class="testimony-name">{{$testimonial->name}}</div>
                    <div class="pd-rating">
                    <?php for($i=1; $i<$testimonial->ratings;$i++) { ?>
                      <i class="fa fa-star"></i>
                     <?php } ?>
                    </div>
                  </div>
                </div>
                @endforeach  
              @endisset
              </div>

            </div>
          </div>
          <div class="col-md-6">
              <div class="testimonial-about">
                  <h2>MURARKEY</h2>
                  <h3>Unlock Your Beauty</h3>
                  <p>
                    We Deal With Various Makeup & Cosmetic Products! We Also Provide Beauty & Grooming Services At Home.
                  </p>


                  <ul class="testimony-right-list">
                      <li>
                        <i class="fa fa-check-circle-o"></i>
                        Skin Care
                      </li>
                      <li>
                        <i class="fa fa-check-circle-o"></i>
                        Eyes
                      </li>
                      <li>
                        <i class="fa fa-check-circle-o"></i>
                        Lips
                      </li>
                      <li>
                        <i class="fa fa-check-circle-o"></i>
                        Face
                      </li>
                      <li>
                        <i class="fa fa-check-circle-o"></i>
                        Hair
                      </li>
                      <li>
                        <i class="fa fa-check-circle-o"></i>
                        Nails
                      </li>

                      <li>
                        <i class="fa fa-check-circle-o"></i>
                        Kits & Brushes
                      </li>
                      <li>
                        <i class="fa fa-check-circle-o"></i>
                        Makeup & Hairstyling
                      </li>
                      <li>
                        <i class="fa fa-check-circle-o"></i>
                        Parlour at Home
                      </li>
                      <li>
                        <i class="fa fa-check-circle-o"></i>
                        Salon at Home
                      </li>




                  </ul>

                  <a href="{{route('home')}}" class="btn btn-primary">
                    <i class="fa fa-cart"></i>
                    Start Shopping
                  </a>
              </div>
          </div>
        </div>
      </div>
      <div class="decorative2">
        <img src="{{ asset('frontend/img/leaf-free-img.png')}}" alt="">
    </div>
    </section>
    <!-- testimonial section------------ -->

    {{-- //map section --}}
@include('frontend.partials.mapSection');
    

@endsection

@section('js')
    <script>        
    @if(session()->has('contact_us_success_message'))
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
