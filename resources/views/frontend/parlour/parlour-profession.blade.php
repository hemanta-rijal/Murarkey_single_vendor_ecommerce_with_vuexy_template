@extends('frontend.layouts.app')
@section('meta')
    
@endsection
@section('body')
        <!-- Beauty Professional Header Section Begin -->
    <div
      class="register-login-section spad"
      style="background:linear-gradient(
        183deg,
        rgba(77, 17, 139, 1) 0%,
        rgba(103, 32, 132, 0.8) 100%
      ), url(/img/colorful-background.jpg)"
    >
      <div class="container">
        <div class="row">
          <div class="col">
            <div class="join-intro text-center text-white">

              <h1>ARE YOU A PROFESSIONAL?</h1>
              <div class="subtitle">Own Your Career With Murarkey</div>

              <p>
                Submit the form below to own your career, do what you love, and make money while doing it. After you submit the form, Murarkey team member will contact you! We’ll ask you to tell us a little about you and your work experience, and will stay in touch with you!
              </p>

              <a href="{{route('get.join-profession')}}" class="btn btn-cta">
              Apply Now</a>
            </div>


          </div>
        </div>
      </div>
    </div>
    <!-- Beauty Professional Header Form Section End -->

    <!-- steps section -->
    <section class="step-section">
      <div class="container">
        <div class="section-title">
          <div class="overline">WANNA KNOW!</div>
          <h2>
            How It Will Work?</h2>
        </div>
        <div class="row">
          <div class="col-md-3">

            <div class="step-card">

              <div class="step-card-icon">
                <img src="{{asset('frontend/img/icons/google-forms.svg')}}" alt="">
              </div>
              <h3>Submit Form</h3>
            </div>
          </div>

          <div class="col-md-3">

            <div class="step-card">

              <div class="step-card-icon">
                <img src="{{asset('frontend/img/icons/badge.svg')}}" alt="">
              </div>
              <h3>Show your Speciality</h3>
            </div>
          </div>


          <div class="col-md-3">

            <div class="step-card">

              <div class="step-card-icon">
                <img src="{{asset('frontend/img/icons/customer.svg')}}" alt="">
              </div>
              <h3>Get Client Details</h3>
            </div>
          </div>


          <div class="col-md-3">

            <div class="step-card">

              <div class="step-card-icon">
                <img src="{{asset('frontend/img/icons/hairdresser-color.svg')}}" alt="">
              </div>
              <h3>Provide Services</h3>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- steps section -->

       <!-- why murarkey section -->
    <section class="why-us-section">
      <div class="container-fluid">
       <div class="row">
        <div class="col-lg-3">
          <div class="product-large set-bg px-3" data-setbg="img/servicebg.jpeg">
            <h2>Why <br> Murarkey Pro?</h2>

            <a href="" class="btn btn-cta">
              View Form
            </a>
          </div>
        </div>

        <div class="col-lg-9 d-flex align-items-center">
          <div class="row d-flex ">
            <div class="col-md-3">
              <div class="why-us-card card">
                <div class="card-img">
                  <img src="https://images.pexels.com/photos/4449797/pexels-photo-4449797.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" alt="">
                </div>
                <div class="card-body">
                  <h3 class="card-title">
                    MAKE MONEY
                  </h3>
                  <p>
                    Receive Money For Each Services Instantly
                  </p>
                </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="why-us-card card">
                <div class="card-img">
               <img src="https://images.pexels.com/photos/4467687/pexels-photo-4467687.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" alt="">
                </div>

                <div class="card-body">
                  <h3 class="card-title">
                    OWN YOUR CAREER
                  </h3>
                  <p>
                    You Are Your Own Boss
                  </p>
                </div>
              </div>
            </div>


            <div class="col-md-3">
              <div class="why-us-card card">
                <div class="card-img">
               <img src="https://images.pexels.com/photos/761993/pexels-photo-761993.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" alt="">
                </div>
                <div class="card-body">
                  <h3 class="card-title">
                    UNLIMITED OPPURTUNITY
                  </h3>
                  <p>
                    Work At Your Friendly Neighborhood
                  </p>
                </div>
              </div>
            </div>


            <div class="col-md-3">
              <div class="why-us-card card">
                <div class="card-img">
                <img src="https://images.pexels.com/photos/4348404/pexels-photo-4348404.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" alt="">
                </div>
                <div class="card-body">
                  <h3 class="card-title">
                    BOOST YOUR BUSINESS
                  </h3>
                  <p>
                    Training And Advice
                  </p>

                </div>
              </div>
            </div>
          </div>
        </div>
       </div>
      </div>
    </section>
    <!-- why murarkey section -->
@endsection
