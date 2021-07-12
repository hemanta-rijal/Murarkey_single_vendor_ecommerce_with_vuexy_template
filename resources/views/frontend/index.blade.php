@extends('frontend.layouts.app')
@section('meta')
    @include('frontend.partials.ogForIndexPage')
@endsection
@section('css')
        <link rel="stylesheet" type="text/css" href="{{asset('jqueryui/jquery-ui.min.css')}}">

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
    
    @include('frontend.partials.serviceListing')
    <!-- Services Section Begin -->


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
