@extends('frontend.layouts.app')
@section('meta')
    @include('frontend.partials.ogForIndexPage')
@endsection
@section('css')
        <link rel="stylesheet" type="text/css" href="{{asset('jqueryui/jquery-ui.min.css')}}">
        <style type="text/css">
            .ui-autocomplete-row
            {
                padding:8px;
                background-color: #f4f4f4;
                border-bottom:1px solid #ccc;
                font-weight:bold;
            }
            .ui-autocomplete-row:hover
            {
                background-color: #ddd;
            }

        </style>
@endsection
@section('body')
@include('flash::message')
    @include('frontend.includes.banner')
    <!-- -------Benefit section----- -->
    <div class="container">
        <div class="benefit-items">
            <div class="row">
                <div class="col-lg-3">
                    <div class="single-benefit">
                        <div class="sb-icon">
                            <img src="{{URL::asset('frontend/img/icon-1.png')}}" alt="Free Shipping" />
                        </div>
                        <div class="sb-text">
                            <h6>Free Shipping</h6>
                            <p>Inside Ringroad</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="single-benefit">
                        <div class="sb-icon">
                            <img src="{{URL::asset('frontend/img/icon-2.png')}}" alt="100% Authentic" />
                        </div>
                        <div class="sb-text">
                            <h6>100% Authentic</h6>
                            <p>IDirectly from Brand</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="single-benefit">
                        <div class="sb-icon">
                            <img src="{{URL::asset('frontend/img/icon-1.png')}}" alt="Home Services"/>
                        </div>
                        <div class="sb-text">
                            <h6>Home Services</h6>
                            <p>Wide Range</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="single-benefit">
                        <div class="sb-icon">
                            <img src="{{URL::asset('frontend/img/icon-2.png')}}" alt="5% Cashback" />
                        </div>
                        <div class="sb-text">
                            <h6>5% Cashback</h6>
                            <p>On Every Purchase</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- -------Benefit section----- -->

    <!-- Services Section Begin -->
    <div class="services-section">
        <div class="container-fluid">
            <div class="section-title pb-3">
                <h2>Our Services</h2>
            </div>

            <div class="row">
                <a href="" class="col">
                    <div class="img-box">
                        <img src="{{URL::asset('frontend/img/icons/make-up.svg')}}" alt="" />
                    </div>
                    <h3>Make up at home</h3>
                </a>

                <a href="" class="col">
                    <div class="img-box">
                        <img src="{{URL::asset('frontend/img/icons/bride.svg')}}" alt="" />
                    </div>
                    <h3>Bridal makeup</h3>
                </a>

                <a href="" class="col">
                    <div class="img-box">
                        <img src="{{URL::asset('frontend/img/icons/hair-cut-tool.svg')}}" alt="" />
                    </div>
                    <h3>Haircut at home</h3>
                </a>

                <a href="" class="col">
                    <div class="img-box">
                        <img src="{{URL::asset('frontend/img/icons/hairdresser.svg')}}" alt="" />
                    </div>
                    <h3>Parlour at home</h3>
                </a>

                <a href="" class="col">
                    <div class="img-box">
                        <img src="{{URL::asset('frontend/img/icons/woman-hair.svg')}}" alt="" />
                    </div>
                    <h3>Salon at home</h3>
                </a>
            </div>
        </div>
    </div>

    @include('frontend.partials.categorySlider')
    @include('frontend.partials.parlorListing')

    @include('frontend.partials.serviceSchedule')


    @include('frontend.partials.brandSlider')

@endsection

@section('js')
<!-- Script -->
<script src="{{URL::asset('backend/custom/customfuncitons.js')}}"></script>
    <script src="{{asset('jqueryui/jquery-ui.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('jqueryui/jquery-ui.min.js')}}" type="text/javascript"></script>



@endsection
