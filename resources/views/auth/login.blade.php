@extends('layouts.app')

@section('title')
    {{get_meta_by_key('site_name')}} Sign In
@endsection


@section('styles')
    <link rel="stylesheet" href="/assets/css/remodal.css">
    <link rel="stylesheet" href="/assets/css/remodal-default-theme.css">
    <style>
        footer {
            background-color: #2e2e54;
        }
        #logo_wala {
            background-color: #ffffff;
        }
    </style>
@endsection

@section('content')
    <!-- logo, search, myaccount -->
        @include('partials.header')
    <!-- logo, search, myaccount -->
<div class="login">
    <div class="container py-5">
      <div class="row">
        <div class="col-6  mx-auto">
          <div class="login-details">
            <h5 class="logo text-center py-3">Logo</h5>
            <nav>
              <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-register-tab" data-toggle="tab" href="#nav-register"
                  role="tab" aria-controls="nav-register" aria-selected="true">Register</a>
                <a class="nav-item nav-link" id="nav-signin-tab" data-toggle="tab" href="#nav-signin" role="tab"
                  aria-controls="nav-signin" aria-selected="false">Sign in</a>
              </div>
            </nav>

            <div class="tab-content py-3 px-3 px-sm-0" id="nav-tab">
              <div class="tab-pane fade show active" id="nav-register" role="tabpanel"
                aria-labelledby="nav-register-tab">
                <div class="form py-3">
                    <form action="{{route('register')}}" method="POST">
                    {{ csrf_field() }}
                   
                    <div class="form-group">
                      <input type="text" class="form-control" name="fname" id="name" aria-describedby="emailHelp"
                        placeholder="Full Name" required>
                    </div>
                    <div class="form-group">
                      <input type="tel" class="form-control" id="phone" name="phone" placeholder="Contact Number"
                        required>
                    </div>

                    <div class="form-group">
                      <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp"
                        placeholder="Email" required>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control" name="password" id="password" placeholder="Password"
                        required>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control" name="cpass" id="cpass" placeholder="Confirm Password"
                        required>
                    </div>
                    <div class="form-group">
                      <input type="submit" class="form-control" value="create account" name="submit">
                    </div>
                  </form>
                  <div class="alternate text-center mt-4">
                    <p>OR</p>
                    <p>Quick access with</p>
                    <div class="icons mt-3">
                      <span><i class="fab fa-google"></i></span>
                      <span><i class="fab fa-facebook-f"></i></span>
                      <span><i class="fab fa-twitter"></i></span>
                    </div>
                  </div>


                </div>
              </div>

              <div class="tab-pane fade show" id="nav-signin" role="tabpanel" aria-labelledby="nav-signin-tab">
                <div class="form py-3">
                  <form method="POST" action="{{route('auth.login')}}">
                    {{ csrf_field() }}
                    @if (request('back_to'))
                        <input type="hidden" name="back_to" value="{{ request('back_to') }}">
                    @endif
                    <div class="form-group">
                      <input type="text" class="form-control" name="email" id="email" aria-describedby="emailHelp"
                        placeholder="Enter Email or Mobile Number" required>
                       
                    </div>

                    <div class="form-group">
                      <input type="password" class="form-control" name="password" id="password" placeholder="Password"
                        required>
                        
                    </div>
                    <div class="form-group">
                      {{--  <input type="submit" class="form-control"  name="submit">  --}}
                      <button type="submit" class="form-control">Sign In</button>
                    </div>  
                    <div class="row mt-3">
                      <div class="col-auto mr-auto">
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                          <label class="form-check-label" for="inlineCheckbox1">Remember Me</label>
                        </div>
                        
                      </div>
                      <div class="col-auto">
                        <a href="/password/reset">Forgot Password?</a>
                      </div>
                    </div>
                  </form>
                  <div class="alternate text-center mt-4">
                    <p>OR</p>
                    <p>Quick access with</p>
                    <div class="icons mt-3">
                      <span><i class="fab fa-google"></i></span>
                      <span><a href="{!! route('facebook.login') !!}"><i class="fab fa-facebook-f"></i></a></span>
                      <span><i class="fab fa-twitter"></i></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@if(session('success_message'))
    <div class="remodal p-0" data-remodal-id="success" role="dialog" aria-labelledby="modal1Title"
            aria-describedby="modal1Desc" style="max-width: 500px;">
        <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
        <div>
            <h4 id="modal1Title">Forgot Password?</h4>
            <section id="seller_registration" class="m-0 p-b-30 p-t-20">
                <form action="">
                    <p class="p-b-13 text-left">Enter the email address associated with your account.
                        we will email you a link for password reset.</p>


                    <div class="form-horizontal">
                        <div class="form-group">
                            <div class="col-md-12">
                                <!-- <p class="warning_box plz_fill"> ! Email address is not yet registered. Please try again.</p> -->
                                <div class="success_box">
                                    <p>
                                        Email sent! Please check your email and follow the link to reset
                                        password.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn cs_btn m-0 p-12 " data-remodal-action="close"
                            style="width: 105px;">OK ! got it.
                    </button>
                </form>
            </section>

        </div>
    </div>
@endif

@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/remodal/1.0.6/remodal.min.js"></script>
@endsection
