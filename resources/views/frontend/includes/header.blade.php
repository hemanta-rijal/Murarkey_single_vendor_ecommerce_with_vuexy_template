  <header class="header-section">
    <div class="header-top">
      <div class="container">
        <div class="ht-left">
          {{-- <a href="" class="pay-service"> FonePay </a>
          <a href="" class="join-service"> Learn to join </a>
          <a href="" class="offer-service"> Offers </a> --}}
        </div>
        <div class="ht-right">
          <a href="#" class="login-panel d-none"><i class="fa fa-user"></i>Login or Register</a>

          <div class="top-social mr-0 pr-0">
            @if(get_meta_by_key('facebook_link'))
            <a href="{{get_meta_by_key('facebook_link')}}"><i class="ti-facebook"></i></a>
            @endif
            @if(get_meta_by_key('twitter_link'))
            <a href="{{get_meta_by_key('twitter_link')}}"><i class="ti-twitter-alt"></i></a>
            @endif
            {{-- <a href=""><i class="ti-linkedin"></i></a>
            <a href=""><i class="ti-pinterest"></i></a> --}}
        </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="inner-header">
        <div class="row align-items-center">
          <div class="col-lg-2 col-md-2">
            <div class="logo">
              <a href="{{URL::to('/')}}">
                <img src="{{ asset('frontend/img/logo-primary.png')}}" alt="" />
                    {{-- <img src="{{getFrontendPrimaryLogo()}}" alt="" /> --}}
                </a>
            </div>
          </div>
          <div class="col-lg-7 col-md-7">
            <form action="/products/search"  id="header-search-form">
              <div class="advanced-search">
                    <!-- <button type="button" class="category-btn">All Categories</button> -->
                    <!-- service selector -->
                    <div class="search-type-selector">
                      <select>
                        <option value="product">Product</option>
                        <option value="services">Services</option>
                      </select>
                    </div>
                    <div class="input-group autocomplete">
                      <input type="text" name="search" placeholder="Search for products and services,brands and categories ..." id="search_keys" />
                      <button type="button" value="submit"><i class="ti-search"></i></button>
                    </div>
              </div>
             </form>
          </div>
          <div class="col-lg-3 text-right col-md-3">
            <ul class="nav-right">

              <li class="heart-icon">
                <a href="#">
                  <i class="icon_heart_alt"></i>
                  <span>0</span>
                </a>
                <div class="cart-hover">
                  <div class="select-items">
                    <table>
                      <tbody>

                      {{-- <tr>
                        <td class="si-pic">
                          <img src="img/products/rustic1.jpg" alt="" />
                        </td>
                        <td class="si-text">
                          <a href="" class="product-selected">
                            <p>Rs. 12550</p>
                            <h6>Rustic Art Juniper Lavender Shampoo For Men 175gms</h6>
                          </a>
                        </td>
                        <td class="si-close">
                          <i class="ti-close"></i>
                        </td>
                      </tr>

                      <tr>
                        <td class="si-pic">
                          <img src="img/products/rustic5.jpg" alt="" />
                        </td>
                        <td class="si-text">
                          <a href="" class="product-selected">
                            <p>Rs. 3500</p>
                            <h6>Rustic Art Cinnamon Rosemary Shampoo Butter 100gms</h6>
                          </a>
                        </td>
                        <td class="si-close">
                          <i class="ti-close"></i>
                        </td>
                      </tr> --}}

                      </tbody>
                    </table>
                  </div>

                  <div class="select-button">
                    <a href="#" class="primary-btn view-card">Add all and Checkout</a>
                  </div>
                </div>
              </li>
              <li class="cart-icon">
                <a href="#">
                  <i class="icon_bag_alt"></i>
                  <span  id="countCart">{{countCartForUser()}}</span>
                </a>
                <div class="cart-hover" id="cart-hover">
                    @if(Auth::guard('web')->check())
                    @include('frontend.partials.cart.addToCartHover')
                    @endif
                </div>
              </li>
             
              <li class="user-acc">
                <a href="#">
                  @if(auth('web')->user())
                  <img src="{{auth('web')->user()->profile_pic_url}}" alt="user-default">
                  @else
                  <img src="{{URL::to('frontend/img/no-img.svg')}}" alt="user-default">
                  @endif
                </a>
                <div id="login-panel" class="cart-hover">
                 @if(!Auth::guard('web')->check())
                  <a href="{{route('login')}}" class="btn btn-primary">
                    Sign In
                  </a>

                  <p class="mb-0 text-center">
                    <small>New to Murarkey?</small>
                  </p>
                  <a href="{{route('register')}}" class="btn site-btn">
                    Register
                  </a>
                  @else
                  <a href="{{route('user.dashboard')}}" class="btn btn-primary">
                    My Account
                  </a>
                  <a href="{{route('logout')}}" class="btn btn-info">
                    Log Out
                  </a>
                </div>
                 
               {{-- <a href="{{route('user.dashboard')}}" class="login-panel"><i class="fa fa-user"></i>My Account</a> --}}
                @endif
                <!-- <a href="#">
                  <img src="img/insta-1.jpg" width="40px" height="40px" alt="" />
                </a>

                <div class="cart-hover">
                  <div class="select-items">
                    <table>
                      <tbody>
                        <tr>
                          <td>
                            <a href="">Jyoti Sharma</a>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <a href="">Account</a>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <a href="">Shop History</a>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <a href="">Refer and Earn</a>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>

                </div> -->

              </li>
              <!-- <li class="cart-price">$150.00</li> -->
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="nav-item">
      <div class="container">
        <div class="nav-depart d-none">
          <div class="depart-btn">
            <i class="ti-menu"></i>
            <span>All departments</span>
            <ul class="depart-hover">
              <li class="active"><a href="#">Women’s Clothing</a></li>
              <li><a href="#">Men’s Clothing</a></li>
              <li><a href="#">Underwear</a></li>
              <li><a href="#">Kid's Clothing</a></li>
              <li><a href="#">Brand Fashion</a></li>
              <li><a href="#">Accessories/Shoes</a></li>
              <li><a href="#">Luxury Brands</a></li>
              <li><a href="#">Brand Outdoor Apparel</a></li>
            </ul>
          </div>
        </div>
        <nav class="nav-menu mobile-menu">
          <ul>
            <li class="active"><a href="{{route('home')}}">Home</a></li>
            <li>
                <a >Shop</a>
                @if(get_homepage_featured_categories()->count())
                    <ul class="dropdown">
                        @foreach (get_homepage_featured_categories()->take(5) as $category)
                        <li><a href="{{route('products.search',$category->slug)}}">{{$category->name}}</a></li>
                        @endforeach
                </ul>
                @endif
            </li>
            <li>
              <a href="{{route('parlour.index')}}">Parlours</a>
            </li>
           
            <li>
              <a >Brands</a>
                    @if(get_homepage_featured_brands()->count())
                    <ul class="dropdown">
                      @foreach (get_homepage_featured_brands() as $brand)
                      <li><a href="{{route('products.search',$brand->slug)}}">{{$brand->name}}</a></li>
                      @endforeach
                    </ul>
                    @endif
                </li>
                    {{-- <li><a href="#">Pages</a></li> --}}
              <li>
              <a >Join Us</a>
              <ul class="dropdown">
                <li><a href="{{route('parlour-profession')}}">Are you a Beauty Professional</a></li>
                <li><a href="{{route('get.join-profession')}}">Join Murarkey</a></li>
              </ul>
            </li>
            <li><a href="{{route('page.contact-us')}}">Contact Us</a></li>
            <li><a href="{{route('user.my-account.wallet')}}">My Wallet</a></li>
            <li>
              <a href="#">Account</a>
              <ul class="dropdown">
                <li><a href="{{route('user.dashboard')}}">My Account</a></li>
                <li><a href="{{route('user.cart.index')}}">Cart</a></li>
                <li><a href="{{route('user.checkout.index')}}">Checkout</a></li>
              </ul>
            </li>
          </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
      </div>
    </div>
  </header>