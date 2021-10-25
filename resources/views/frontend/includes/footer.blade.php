<!-- Footer Section Begin -->
<footer class="footer-section">
    <div class="container">
        <div class="row">
            
            <div class="col-lg-4 col-6 mt-5 pt-4">
                @php
                    $menu =getMenuItemByType(get_theme_setting_by_key('quick_links_menu'));
                @endphp
                @if($menu)
                <div class="footer-widget">
                    <h5>{{$menu->name}}</h5>
                    <ul>
                       @foreach ($menu->items as $item)
                       <li><a href="{{$item->link}}">{{$item->label}}</a></li>
                       @endforeach
                    </ul>
                </div>
                @endif
            </div>

            <div class="col-lg-4 col-6 mt-5 pt-4">
                @php
                    $menu =getMenuItemByType(get_theme_setting_by_key('site_links_menu'));
                @endphp
                @if($menu)
                <div class="footer-widget">
                    <h5>{{$menu->name}}</h5>
                    <ul>
                       @foreach ($menu->items as $item)
                       <li><a href="{{$item->link}}">{{$item->label}}</a></li>
                       @endforeach
                    </ul>
                </div>
                @endif
            </div>

           <div class="col-lg-3 offset-lg-1 col-md-6 col-sm-6 mt-5 pt-4">
                <div class="footer-left">
                    <div class="footer-logo">
                        <a href="{{URL::to('/')}}"><img width="240px" src="{{getFrontendFooterLogo()}}" alt="" /></a>
                    </div>
                    {{-- <div class="footer-widget">
                    <h5>About Us</h5> --}}
                    <ul class="">
                        <li>
                            Address: <br />{{get_meta_by_key('full_address')}}
                        </li>
                        <li>Phone: {{get_meta_by_key('primary_contact_number')}}</li>
                        <li>Email: {{get_meta_by_key('contact_email')}}</li>
                    </ul>
                    {{-- </div> --}}
                </div>

                <div class="single-footer-widget">
                    <h6>Newsletter</h6>
                    <p>Subscribe Our News letter for offers and discounts</p>
                    <div class="" id="mc_embed_signup">

                        <form target="" novalidate="true" action="{{route('newsletter.add-subscriber')}}" method="post" class="form-inline">
                                @csrf
                            <div class="d-flex flex-row">

                                <input class="form-control" name="subscriber_email" placeholder="Enter Email " onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Email '"  type="email" required>

                                <button class="click-btn btn btn-default"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
                                <div style="position: absolute; left: -5000px;">
                                    <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
                                </div>

                                <!-- <div class="col-lg-4 col-md-4">
                                            <button class="bb-btn btn"><span class="lnr lnr-arrow-right"></span></button>
                                        </div>  -->
                            </div>
                            <div class="info"></div>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <blockquote class="text-white text-center mb-0">
                    One thought one click, to unlock all cosmetic and beauty needs,
                    together across nation.
                </blockquote>
            </div>
        </div>

    </div>
    <div class="copyright-reserved">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div class="copyright-text">
                    Copyright &copy;
                    <script>
                        document.write(new Date().getFullYear());
                    </script>
                    All rights reserved | Crafted with
                    <i class="fa fa-heart-o" aria-hidden="true"></i> by
                    <a href="https://webrootnepal.com" target="_blank">webroot Nepal</a>
                </div>
                <div class="footer-social">
                    <a href="{{get_meta_by_key('facebook_link')}}"><i class="fa fa-facebook"></i></a>
                    <a href="{{get_meta_by_key('instagram_link')}}"><i class="fa fa-instagram"></i></a>
                    <a href="{{get_meta_by_key('twitter_link')}}"><i class="fa fa-twitter"></i></a>
                    <a href="{{get_meta_by_key('youtube_link')}}"><i class="fa fa-youtube"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->