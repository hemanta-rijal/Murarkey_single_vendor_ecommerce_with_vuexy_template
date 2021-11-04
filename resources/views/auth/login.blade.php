@extends('frontend.layouts.app')

@section('title')
    {{get_meta_by_key('site_name')}}   | Sign In
@endsection


@section('css')

@endsection

@section('body')
    @include('partials.header')

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
                            <form action="#">
                                <div class="group-input">
                                    <label for="username">Username or email address *</label>
                                    <input type="text" id="username">
                                </div>
                                <div class="group-input">
                                    <label for="pass">Password *</label>
                                    <input type="text" id="pass">
                                </div>

                                <button type="submit" class="site-btn login-btn">Sign In</button>
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

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/remodal/1.0.6/remodal.min.js"></script>
@endsection
