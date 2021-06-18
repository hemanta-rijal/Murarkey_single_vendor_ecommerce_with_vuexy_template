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
@endsection
