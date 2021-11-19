@extends('frontend.layouts.app')

@section('title')
    Sign In | {{get_meta_by_key('site_name')}}
@endsection


@section('css')

@endsection

@section('body')
    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="#"><i class="fa fa-home"></i> Home</a>
                        <span>Login</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Form Section Begin -->

    <!-- Register Section Begin -->
    <div class="register-login-section spad" style="background:     linear-gradient(
        62.57deg,
        rgba(77, 17, 139, 0.8) 0%,
        rgba(103, 32, 132, 0.8) 27%,
        rgba(110, 29, 138, 0.8) 63%,
        rgba(52, 40, 121, 0.8) 100%
      ), url('https://images.unsplash.com/photo-1521590832167-7bcbfaa6381f?ixid=MnwxMjA3fDB8MHxzZWFyY2h8Nnx8YmVhdXR5JTIwc2Fsb258ZW58MHx8MHx8&ixlib=rb-1.2.1&w=1000&q=80');">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="login-form-wrapper bg-white p-5">
                        <div class="login-form">
                            <h2>Login</h2>
                            @include('flash::message')
                            <form action="{{route('auth.login')}}" method="POST">
                                {{ csrf_field() }}
                                {{-- @if (request('back_to'))
                                    <input type="hidden" name="back_to" value="{{ request('back_to') }}">
                                @endif --}}
                                <div class="group-input">
                                    <label for="email">Email Address *</label>
                                    <input type="text" id="email" name="email" required>
                                </div>
                                <div class="group-input">
                                    <label for="pass">Password *</label>
                                    <input type="password" name="password" id="pass" required>
                                </div>

                                <button type="submit" class="site-btn login-btn">Sign In</button>
                            </form>
                            <!-- social login -->
                            <div class="social-login">
                                <a href="{{ url('/login/facebook') }}" class="btn btn-social btn-fb">
                                    <span>
                                        <i class="fa fa-facebook-square" aria-hidden="true"></i>
                                    </span>
                                    <p>Login with Facebook</p>
                                </a>
                                <a href="{{ url('/login/google') }}" class="btn btn-social">
                                    <span>
                                        <img src="{{ URL::asset('frontend/img/google-g-logo-web.png') }}" alt="">
                                    </span>
                                    <p>Login with Google</p>
                                </a>
{{--                                <a href="" class="btn btn-social">--}}
{{--                                    <span><i class="fa fa-apple" aria-hidden="true"></i></span>--}}
{{--                                    <p>Login with Apple</p>--}}
{{--                                </a>--}}
                            </div>
                            <!-- social login -->

                            <div class="switch-login">
                                <a href="{{route('register')}}" class="or-login">Or Create An Account</a>
                            </div>
                            <div class="switch-login">
                                <a href="{{route('forget-password.form')}}" class="or-login"
                                   style="color:red; position:inherit;">Forget your Password ?</a>
                            </div>

{{--                            <div class="form-group row">--}}
{{--                                --}}

{{--                                <div class="col-md-6 offset-md-3">--}}
{{--                                    --}}{{-- <button class="btn btn-success"> --}}
{{--                                    <a href="{{ url('/login/facebook') }}" class="btn btn-facebook"--}}
{{--                                       style="color: lightblue">Login with Facebook</a>--}}
{{--                                    --}}{{-- </button> --}}
{{--                                    --}}{{-- <button > --}}
{{--                                    <a href="{{ url('/login/google') }}" class="btn btn-google-plus"--}}
{{--                                       style="color: lightblue">Or Login with Google</a>--}}
{{--                                    --}}{{-- </button> --}}
{{--                                </div>--}}
{{--                            </div>--}}
                            {{-- <div class="switch-login">
                               <a href="{{ route('facebook.login') }}" class="btn btn-success btn-sm" style="display: inline-flex">  Login with Facebook </a>
                               
                            </div> --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Register Form Section End -->

@endsection

@section('js')
    @if(session()->has('login_message'))
        <script>
            swal({
                buttons: true,
                icon: "success",
                timer: 2500,
                text: '{{ session()->get('login_message') }}'
            });
        </script>
    @endif
@endsection
