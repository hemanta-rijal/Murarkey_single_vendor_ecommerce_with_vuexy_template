@extends('frontend.layouts.app')
@section('meta')
    @include('frontend.partials.ogForIndexPage')
@endsection
@section('body')
@include('flash::message')
<!-- Contact Section Begin -->
    <section class="contact-section spad">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 pl-0">
                    <div class="contact-left">
                        <div class="contact-title">
                            <h4>Contacts Us</h4>
                            <p>We Deal With Various Makeup & Cosmetic Products! We Also Provide Beauty & Grooming Services At Home.</p>
                        </div>
                        <div class="contact-widget">
                            <div class="cw-item">
                                <div class="ci-icon">
                                    <i class="ti-location-pin"></i>
                                </div>
                                <div class="ci-text">
                                    <span>Address:</span>
                                    <p>Ward No.9, Battisputali, Kathmandu, Nepal</p>
                                </div>
                            </div>
                            <div class="cw-item">
                                <div class="ci-icon">
                                    <i class="ti-mobile"></i>
                                </div>
                                <div class="ci-text">
                                    <span>Phone:</span>
                                    <p>+977 9866426111</p>
                                </div>
                            </div>
                            <div class="cw-item">
                                <div class="ci-icon">
                                    <i class="ti-email"></i>
                                </div>
                                <div class="ci-text">
                                    <span>Email:</span>
                                    <p>customercare@murarkey.com</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6  pr-0">
                    <div class="contact-form">
                        <div class="leave-comment">
                            <h4>Drop a message</h4>
                            <p>We will get back to you soon.</p>
                            <form action="#" class="comment-form">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input type="text" placeholder="Your name">
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="text" placeholder="Your email">
                                    </div>
                                    <div class="col-lg-12">
                                        <textarea placeholder="Your message"></textarea>
                                        <button type="submit" class="site-btn">Send message</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->

    {{-- //map section --}}
@include('frontend.partials.mapSection');
    

@endsection

@section('js')
    <script>        
    @if(session()->has('loggedin_message'))
        Swal.fire({
            position: "center",
            icon: "success",
            title: "Successfully Logged In !!!",
            showConfirmButton: false,
            timer: 1500,
        });
    </script>
        @endif
@endsection
