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

    @include('frontend.partials.serviceSchedule')


    @include('frontend.partials.categorySlider')
    
    @include('frontend.partials.skintone')
    
    @include('frontend.partials.parlorListing')




    <!-- why murarkey section -->
    <section class="why-us-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3">
                    <div class="product-large set-bg px-3" data-setbg="img/servicebg.jpeg">
                        <h2>Why <br> Murarkey Pro?</h2>

                        <a href="{{route('get.join-profession')}}" class="btn btn-cta">
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



    @include('frontend.partials.brandSlider')

@endsection

@section('js')
<!-- Script -->
<script src="{{URL::asset('backend/custom/customfuncitons.js')}}"></script>
    <script src="{{asset('jqueryui/jquery-ui.min.js')}}" type="text/javascript"></script>

      <script>
        function addServiceToCart(serviceId) {
            var auth = {{auth('web')->check() ? 'true' :'false'}}
            if(auth==true){
                var auth = {{ auth()->check() ? 'true' : 'false' }};
                var optionsId ='options_'+serviceId; 
          var qtyId = 'qty_'+serviceId;
          var photo = document.getElementById(optionsId).src;
        //  console.log(photo);
          var qty = document.getElementById(qtyId).value;

           $.ajaxSetup({
                        headers: {'X-CSRF-TOKEN': '{{ Session::token() }}'}
                    });
            $.ajax({
                type:"POST",
                url:'<?php echo e(route("user.cart.store")) ?>',
                data:{
                  qty:qty,
                  type: 'service',
                  options: {'photo':photo,'product_type':'service'},
                  product_id:serviceId,
                },
                success:function (data) {
                    updateCartDropDown();
                    new swal({
                        buttons: false,
                        icon: "success",
                        timer: 3000,
                        text: "Service  added in Cart"
                    });
                }

            })
              }else{
                    new swal({
                        buttons: false,
                        icon: "error",
                        timer: 2000,
                        text: "Please Login First"
                    });
                    location.href = ('{{route('auth.login')}}')
          }
        }
      

    </script>

@endsection
