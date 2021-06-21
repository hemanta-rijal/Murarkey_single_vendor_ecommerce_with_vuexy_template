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
                                    <p>{{get_meta_by_key('full_address')}}</p>
                                </div>
                            </div>
                            <div class="cw-item">
                                <div class="ci-icon">
                                    <i class="ti-mobile"></i>
                                </div>
                                <div class="ci-text">
                                    <span>Phone:</span>
                                    <p>{{get_meta_by_key('primary_contact_number')}}</p>
                                </div>
                            </div>
                            <div class="cw-item">
                                <div class="ci-icon">
                                    <i class="ti-email"></i>
                                </div>
                                <div class="ci-text">
                                    <span>Email:</span>
                                    <p>{{get_meta_by_key('contact_email')}}</p>
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
                            <form action="{{route('post.contact-us')}}" method="POST" class="comment-form">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input type="text" name="name" placeholder="Your name" required> 
                                          {!! $errors->first('name', '<p class="text-danger">:message</p>') !!}
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="text" placeholder="Your email" name="email" required>
                                            {!! $errors->first('email', '<p class="text-danger">:message</p>') !!}
                                        </div>
                                        <div class="col-lg-12">
                                            <textarea placeholder="Your message" name="message" required></textarea>
                                            {!! $errors->first('message', '<p class="text-danger">:message</p>') !!}
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
    @if(session()->has('contact_us_success_message'))
        Swal.fire({
            position: "center",
            icon: "success",
            title: "{!!Session()->get('contact_us_success_message')!!}",
            showConfirmButton: false,
            timer: 3500,
        });
    </script>
        @endif
@endsection
