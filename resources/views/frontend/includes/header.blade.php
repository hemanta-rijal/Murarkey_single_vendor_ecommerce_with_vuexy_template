<header class="header-section">
    <div class="header-top">
        <div class="container">
            <div class="ht-left">
                @if(getMenuItemByType(get_theme_setting_by_key('top_header_menu')))
                    @foreach(getMenuItemByType(get_theme_setting_by_key('top_header_menu'))->items as $menu)
                        <a class="{{$menu->class? $menu->class : 'pay-service'}}" @if(str_contains($menu->class,'venobox vbox-item')) data-vbtype="video" data-autoplay="true" @else data-type="{{$menu->label}}" @endif
                           href="{{URL::to($menu->link)}}"> {{$menu->label}}</a>
                    @endforeach
                @endif
            </div>
            <div class="ht-right">
                <a href="#" class="login-panel d-none"><i class="fa fa-user"></i>Login or Register</a>
                <div class="top-social mr-0 pr-0">
                    @if (get_meta_by_key('facebook_link'))
                        <a target="_blank" href="{{ get_meta_by_key('facebook_link') }}"><i class="ti-facebook"></i></a>
                    @endif
                    @if (get_meta_by_key('instagram_link'))
                        <a target="_blank" href="{{ get_meta_by_key('instagram_link') }}"><i
                                    class="ti-instagram"></i></a>
                    @endif
                    @if (get_meta_by_key('youtube_link'))
                        <a href="{{ get_meta_by_key('youtube_link') }}"><i class="ti-youtube"></i></a>
                    @endif
                    @if (get_meta_by_key('linkedin_link'))
                        <a href="{{ get_meta_by_key('linkedin_link') }}"><i class="ti-linkedin"></i></a>
                    @endif
                    @if (get_meta_by_key('twitter_link'))
                        <a href="{{ get_meta_by_key('twitter_link') }}"><i class="ti-twitter"></i></a>
                    @endif
                    @if (get_meta_by_key('google-plus_link'))
                        <a href="{{ get_meta_by_key('google-plus_link') }}"><i class="ti-google"></i></a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="inner-header">
            <div class="row align-items-center">
                <div class="col-lg-2 col-md-2">
                    <div class="logo">
                        <a href="{{ URL::to('/') }}">
                            <img src="{{ asset('frontend/img/logo-primary.png') }}" alt=""/>
                        </a>
                    </div>
                </div>
                <div class="col-lg-7 col-md-7">
                    <div class="advanced-search">
                        <!-- <button type="button" class="category-btn">All Categories</button> -->
                        <!-- service selector -->
                        <div class="search-type-selector">
                            <select>
                                <option value="product">Product</option>
                                <option value="services">Services</option>
                            </select>
                        </div>
                        <div id="search-input-wrapper" class="input-group">
                            <input id="Product_data" type="text" placeholder="What do you need?"/>
                            <button type="submit" onclick="searchQuery()"><i class="ti-search"></i></button>
                        </div>
                        <input type="hidden" id="project-id"/>
                        <p id="project-description"></p>
                    </div>
                </div>
                <div class="col-lg-3 text-right col-md-3">
                    <ul class="nav-right">

                        <li class="heart-icon" data-toggle="tooltip" data-placement="bottom" title="Wishlist">
                            <a href="#">
                                <i class="icon_heart_alt"></i>
                                <span id="countWishlist">{{ countWishlistForUser() }}</span>
                            </a>
                            <div class="cart-hover" id="wislist-hover">
                                @include('frontend.partials.wishlist.addToWishlistHover')
                            </div>
                        </li>
                        <li class="cart-icon" data-toggle="tooltip" data-placement="bottom" title="Cart">
                            <a href="#">
                                <i class="icon_bag_alt"></i>
                                <span id="countCart">{{ countCartForUser() }}</span>
                            </a>
                            <div class="cart-hover" id="cart-hover">
                                @if (Auth::guard('web')->check())
                                    @include('frontend.partials.cart.addToCartHover')
                                @endif
                            </div>
                        </li>

                        <li class="user-acc" data-toggle="tooltip" data-placement="bottom" title="account">
                            <a href="#">
                                @if (auth('web')->user())
                                    <img src="{{ auth('web')->user()->profile_pic_url }}" alt="user-default">
                                @else
                                    <img src="{{ URL::to('frontend/img/no-img.svg') }}" alt="user-default">
                                @endif
                            </a>
                            <div id="login-panel" class="cart-hover">
                                @if (!Auth::guard('web')->check())
                                    <a href="{{ route('login') }}" class="btn btn-primary">
                                        Sign In
                                    </a>

                                    <p class="mb-0 text-center">
                                        <small>New to Murarkey?</small>
                                    </p>
                                    <a href="{{ route('register') }}" class="btn site-btn">
                                        Register
                                    </a>
                                @else
                                    <a href="{{ route('user.dashboard') }}" class="btn btn-primary">
                                        My Account
                                    </a>
                                    <a href="{{ route('logout') }}" class="btn btn-info">
                                        Log Out
                                    </a>
                            </div>
                        {{-- <a href="{{route('user.dashboard')}}" class="login-panel"><i class="fa fa-user"></i>My Account</a> --}}
                        @endif
                        </li>
                        <!-- <li class="cart-price">$150.00</li> -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="nav-item">
        <div class="container">
            <nav class="nav-menu mobile-menu">
                <ul>
                    @if ($header_menu)
                        @foreach ($header_menu as $menu)

                            @if ($menu['child']->isEmpty() && $menu['parent'] == 0)
                                <li><a href="{{ URL::to($menu['link']) }}">{{ $menu['label'] }}</a></li>
                            @else
                                <li>
                                    <a href="{{ URL::to($menu['link']) }}">{{ $menu['label'] }}</a>

                                    <ul class="dropdown">
                                        @foreach ($menu['child'] as $child)
                                            <li><a href="{{ URL::to($child['link']) }}">{{ $child['label'] }}</a></li>
                                        @endforeach
                                    </ul>

                                </li>
                            @endif

                        @endforeach

                    @endif
                </ul>
            </nav>
            <div id="mobile-menu-wrap"></div>
        </div>
    </div>
</header>

<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="empModal" role="dialog">
    <div class="modal-dialog">
 
     <!-- Modal content-->
     <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
 
      </div>
      <div class="modal-footer">
       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
     </div>
    </div>
   </div>








<div id="myModel" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModelLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body" id="topMenuBody">
       
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    </div>
</div>
