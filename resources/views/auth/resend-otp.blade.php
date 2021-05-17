
@extends('layouts.app')

@section('title')
    Kabmart Resend SMS Verification
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
    <div class="container">

        <section id="logo_wala" class="m-b-0">
            <!--logo-->
            <div class="row">
                <div class="col-md-12" align="center">
                    <div class="signup_logo">
                        <a href="/">
                            <img src="{!! get_site_logo() !!}" class="img-responsive" alt="Image">
                        </a>
                    </div>
                </div>
            </div>
            <!--logo-->
        </section>
        <section id="pumili_signup_form">
            <!--signup wrapper-->
            <div class="row">
                <div class="col-md-12">
                    <div class="signup_block">
                        <div class="col-md-8">

                            @if(get_banner_by_slug('login-page'))
                                <div class="image_block hidden-xs">
                                    <a href="{{ get_banner_by_slug('login-page')->link }}">
                                        <img src="{{ get_banner_by_slug('login-page')->image_url }}"
                                             class="img-responsive wid_100" alt="Image"
                                             style="max-height:425px;">
                                    </a>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <div class="signin_block">
                            	<h1>Please type the OTP again sent to your phone.</h1>
                                <form method="POST" action="" accept-charset="UTF-8" class="">
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Enter OTP number"
                                          name="" type="text" value="">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Enter Mobile no or  Number" name="" type="email">
                                    </div>
                                    <button type="submit" class="btn btn-primary wid_100 p-14">Confirm</button>
                                </form>

                            </div>

                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <!--signup wrapper-->
            </div>
        </section>

    </div>



@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/remodal/1.0.6/remodal.min.js"></script>
@endsection
