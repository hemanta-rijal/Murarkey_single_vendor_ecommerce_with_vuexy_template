@extends('frontend.layouts.app')

@section('title')
    Reset Password | {{get_meta_by_key('site_name')}}
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
                        <a href="{{route('home')}}"><i class="fa fa-home"></i> Home</a>
                        <span>Reset Password</span>
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
            {{-- {{dd($errors)}} --}}
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="login-form-wrapper bg-white p-5">
                        <div class="login-form">
                            <h2>Reset Password</h2>
                            @include('flash::message')
                            <form action="{{route('password.reset')}}" method="POST">
                                {{ csrf_field() }}
                                {{-- @if (request('back_to'))
                                    <input type="hidden" name="back_to" value="{{ request('back_to') }}">
                                    @endif --}}
                                <input type="hidden" name="token" value="{{ $token }}">
                                {{-- <div class="group-input">
                                    <label for="identifier">Email / Phone Number *</label>
                                    <input type="text" id="identifier" name="identifier" required >
                                     @if ($errors->has('identifier'))
                                            <div class="error" style="color: red"> {{ $errors->first('identifier') }}</div>
                                        @endif
                                </div> --}}
                                <div class="group-input">
                                    <label for="password">New Password</label>
                                    <input type="password" id="password" name="password" required>
                                    @if ($errors->has('password'))
                                        <div class="error" style="color: red"> {{ $errors->first('password') }}</div>
                                    @endif
                                </div>
                                <div class="group-input">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                           required>
                                    @if ($errors->has('password_confirmation'))
                                        <div class="error"
                                             style="color: red"> {{ $errors->first('password_confirmation') }}</div>
                                    @endif
                                </div>

                                <button type="submit" class="site-btn login-btn">Reset Password</button>
                            </form>

                            <div class="switch-login">
                                <a href="{{route('register')}}" class="or-login">Or Create An Account</a>
                                <br/>
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
                buttons: true,
                icon: "success",
                timer: 2500,
                text: '{{ session()->get('login_message') }}'
            });
        </script>
    @endif
@endsection
