<!--==============================
          MEGAFOOTER
   ==============================-->
<section id="mega-footer">
    <div class="container-fluid mx-auto">

        <div class="offers text-center py-5">
            <h6>Keep Updated & get unlimited offfers</h6>
            @if(session()->has('news_letter_subscriber_added'))
                You are subscribed to the newsletter.
            @endif
            <p>Sign up for our newsletter to receive updates & exclusive offers.</p>
            <div class="col-lg-12">
                {!! Form::open(['route' => 'newsletter.add-subscriber', 'class' => 'footer-form']) !!}
                <div class="form-group mt-4">
                    <input type="email" name="subscriber_email" class="form-control" id="email"
                           aria-describedby="emailHelp" placeholder="Your email address......" required>
                    <input type="submit" name="submit" id="subscribe" value="Subscribe">
                </div>
                {!! $errors->first('subscriber_email', '<div class="text-danger">:message</div>') !!}
                {!! Form::close() !!}
            </div>
        </div>

        <div class="row pb-5">
            <div class="col-lg-2 col-md-4 col-sm-6">
                <div class="footer-item">
                    <h6>{{get_meta_by_key('site_name')}}</h6>
                    <p>{{get_meta_by_key('site_description')}}</p>
                </div>
            </div>

            <div class="col-lg-2 col-md-4 col-sm-6">
                <div class="footer-item">
                    <h6>Your Order</h6>
                    <ul class="footer-list">
                        <li><a href="/login">Login to yout Account</a></li>
                        <li><a href="/wishlist">Your Wishlist</a></li>
                        <li><a href="/comparision_list">Comparison List</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-2 col-md-4 col-sm-6">
                <div class="footer-item">
                    <h6>Quick Links</h6>
                    <ul class="footer-list">
                        <li><a href="">About Us</a></li>
                        <li><a href="/pages/user-agreement">User Agreement</a></li>
                        <li><a href="">Gift Cards</a></li>
                        <li><a href="">Our Stories</a></li>
                        <li><a href="/pages/privacy-policy">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-2 col-md-4 col-sm-6">
                <div class="footer-item">
                    <h6>Connect With Us</h6>
                    <ul class="footer-list">
                        <li><a href="">
                                <i class="fas fa-phone-volume"></i>+977 98372829
                            </a></li>
                        <li><a href="mailto:{{get_meta_by_key('contact_email')}}">
                                <i class="fas fa-envelope"></i>{!! get_meta_by_key('contact_email') !!}
                            </a></li>
                        <li><a href=""><i class="fas fa-map-marker-alt"></i>
                                location</a></li>
                    </ul>
                    <div class="social-icons">
                        <a href="{{get_meta_by_key('facebook_link')}}}}"> <i class="fab fa-facebook-f"></i></a>
                        <a href="{{get_meta_by_key('instagram_link')}}"> <i class="fab fa-instagram"></i></a>
                        <a href="{{get_meta_by_key('twitter_link')}}"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-lg-2 col-md-4 col-sm-6">
                <div class="footer-item">
                    <h6>Need Help?</h6>
                    <ul class="footer-list">
                        <li><a href="">Track Order</a></li>
                        <li><a href="">Return Policy</a></li>
                        <li><a href="">Shipping Information</a></li>
                        <li><a href="">FAQs</a></li>
                        <li><a href="/pages/user-agreement">Terms & Conditions</a></li>
                        <li><a href="/pages/privacy-policy">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-2 col-md-4 col-sm-6">
                <div class="footer-item">
                    <h6>Online Payment Options</h6>
                    <ul class="footer-list">
                        <li><a href=""><img src="{{URL::asset('frontend/assets/img/esewa logo.png')}}" alt="E-sewa"></a>
                        </li>
                        <li><a href=""><img src="{{URL::asset('frontend/assets/img/khalti.png')}}" alt="Khalti"></a>
                        </li>
                        <li><a href=""><img src="{{URL::asset('frontend/assets/img/ime_pay.png')}}" alt="IME Pay"></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!--=====END OF MEGAFOOTER=====-->

<!--==============================
             FOOTER
    ==============================-->
<section id="footer">
    <div class="container-fluid">
        <p>Copyright &copy; 2020. All Right Reserved</p>
    </div>
</section>
<!--=====END OF FOOTER=====-->