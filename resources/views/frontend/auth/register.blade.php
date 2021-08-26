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
                            <h2>Register</h2>
                            @include('flash::message')
                            <form action="{{route('auth.register')}}" method="POST">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="group-input col-lg-6">
                                        <label for="fname ">First Name *</label>
                                        <input type="text" id="first_name" name="first_name" value="{{ old('first_name')}}"  required >
                                        @if ($errors->has('first_name'))
                                            <div class="error" style="color: red"> {{ $errors->first('first_name') }}</div>
                                        @endif
                                    </div>
                                    <div class="group-input col-lg-6">
                                        <label for="fname ">Last Name *</label>
                                        <input type="text" id="last_name" name="last_name" value="{{ old('last_name')}}"  required >
                                        @if ($errors->has('last_name'))
                                            <div class="error" style="color: red"> {{ $errors->first('last_name') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="group-input">
                                    <label for="email">Email Or Phone Number *</label>
                                    <input type="text" id="userId" name="userId" value="{{ old('userId')}}"  required >
                                    @if ($errors->has('userId'))
                                        <div class="error" style="color: red"> {{ $errors->first('userId') }}</div>
                                    @endif
                                </div>
                                <div class="group-input">
                                    <label for="pass">Password *</label>
                                    <input type="password" name="password" id="pass"  required>
                                     @if ($errors->has('password'))
                                        <div class="error" style="color: red"> {{ $errors->first('password') }}</div>
                                    @endif
                                </div>

                                <button type="submit" class="site-btn login-btn">Sign Up</button>
                            </form>
                            <div class="switch-login">
                                <a href="#" class="forget-pass">Forget your Password ?</a>
                            </div>
                            <div class="switch-login">
                                <a href="./register.html" class="or-login">Or Create An Account</a>
                            </div>

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
                buttons: false,
                icon: "success",
                timer: 2500,
                text: '{{ session()->get('login_message') }}'
            });
        </script>
    @endif
@endsection
