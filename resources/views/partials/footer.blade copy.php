<footer class="shop-footer ">
    <div class="container hidden-xs hidden-sm">
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <!-- COLUMN 1 -->
                <h3 class="footer-heading">About Us</h3>
                <div class="margin-bottom-30px">

                    <p><a href="/pages/about-us">About Kabmart</a></p>
                    <p><a href="/pages/payment-details">Payment details</a></p>


                </div>
                <!-- END COLUMN 1 -->
            </div>
            <div class="col-md-3 col-sm-6">
                <!-- COLUMN 1 -->
                <h3 class="footer-heading">Help Center</h3>
                <div class="margin-bottom-30px">

                    <ul class="list-unstyled footer-nav">
                        <li><a href="/pages/user-agreement">User Agreement</a></li>
                        <li><a href="/pages/privacy-policy">Privacy Policy</a></li>
                    </ul>


                </div>
                <!-- END COLUMN 1 -->
            </div>
            <div class="col-md-3 col-sm-6">
                <!-- COLUMN 1 -->
                <h3 class="footer-heading">Customer Service</h3>
                <div class="margin-bottom-30px">

                    <ul class="list-unstyled footer-nav">
                        <li><a href="/pages/how-to-find-supplier">Help Center</a></li>
                        <li>
                            <a href="mailto:{!! get_meta_by_key('contact_email') !!}"
                               target="_blank">Email: {!! get_meta_by_key('contact_email') !!}</a>
                        </li>
                    </ul>


                </div>
                <!-- END COLUMN 1 -->
            </div>

            <div class="col-md-3 col-sm-6">
                <!-- COLUMN 3 -->

                <div class="newsletter">
                    <h3 class="footer-heading">Newsletter</h3>
                    @if(session()->has('news_letter_subscriber_added'))
                    <div class="alert alert-success fade in alert-dismissable m-b-3" style="padding: 6px 12px;">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close"
                           style="right: 0;top: 2px;">×</a>
                        You're subscribed to the newsletter.
                    </div>
                    @endif
                    {!! Form::open(['route' => 'newsletter.add-subscriber', 'class' => 'newsletter-form m-t-13']) !!}

                    <div class="input-group input-group-lg">
                        {!! Form::email('subscriber_email', null, ['class' => 'form-control', 'placeholder' => 'your
                        email', 'required']) !!}
                        <span class="input-group-btn"><button class="btn btn-primary" type="submit"><i
                                        class="fa fa-spinner fa-spin"></i><span>Subscribe</span></button>
                        </span>
                    </div>
                    {!! $errors->first('subscriber_email', '
                    <div class="text-danger">:message</div>
                    ') !!}
                    <!--                                <div class="alert"></div>-->
                    {!! Form::close() !!}
                    <!--                            <p>Get the latest update from us by subscribing to our newsletter.</p>-->

                </div>
                <!-- END COLUMN 3 -->
            </div>
        </div>
    </div>

</footer>

<section class="m-b-0">

    <!-- COPYRIGHT -->
    <div class="container">
        <div class="row copyright">
            <div class="col-md-12 col-xs-12">
                <div class="col-md-4 col-xs-12">


                    <h5>Follow Us</h5>
                    <ul class="list-inline social-icons">
                        @if(get_meta_by_key('facebook_link'))
                        <li><a href="{!! get_meta_by_key('facebook_link') !!}" class="facebook-bg"><i
                                        class="fa fa-facebook"></i></a></li>
                        @endif
                        @if(get_meta_by_key('twitter_link'))
                        <li><a href="{!! get_meta_by_key('twitter_link') !!}" class="twitter-bg"><i
                                        class="fa fa-twitter"></i></a></li>
                        @endif
                        @if(get_meta_by_key('google-plus_link'))
                        <li><a href="{!! get_meta_by_key('google-plus_link') !!}" class="googleplus-bg"><i
                                        class="fa fa-google-plus"></i></a></li>
                        @endif


                        {{--
                        <li><a href="#" class="rss-bg"><i class="fa fa-rss"></i></a></li>
                        --}}
                        @if(get_meta_by_key('instagram_link'))
                        <li><a href="{{ get_meta_by_key('instagram_link') }}" class="instagram-bg"><i
                                        class="fa fa-instagram"></i></a></li>
                        @endif
                        @if(get_meta_by_key('youtube_link'))
                        <li><a href="{!! get_meta_by_key('youtube_link') !!}" class="youtube-bg"><i
                                        class="fa fa-youtube"></i></a></li>
                        @endif
                        @if(get_meta_by_key('linkedin_link'))
                        <li><a href="{!! get_meta_by_key('linkedin_link') !!}" class="linkedin-bg"><i
                                        class="fa fa-linkedin"></i></a></li>
                        @endif
                    </ul>
                </div>
                <div class="hidden-md hidden-lg col-md-4 col-xs-12">
                    <a href="/pages/contact-us">Contact Us</a> : 01 4155100
                </div>
                <div class="col-md-4 col-xs-12">
                    <h5>Download our App</h5>
                    <a href="https://play.google.com/store/apps/details?id=com.kabmart">
                        <img src="/assets/img/android.png" style="width:50%;">
                    </a>
                </div>
                <div class="col-md-4 col-xs-12">
                    <p>
                        {!! get_meta_by_key('all_right_reserved') !!}
                    </p>
                </div>

            </div>
        </div>
        <!-- END COPYRIGHT -->
    </div>
</section>
