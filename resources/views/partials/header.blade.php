<!--==============================
           TOPBAR
    ==============================-->
<section id="topbar">
    <div class="container-fluid mx-auto">
        <div class="row">
            <div class="col-4">
                <p class="topbar-title font-weight-bold">
                    Fastest Online Shopping destination
                </p>
            </div>

            <div class="col-8">
                <div class="top-item d-flex">
                    <a href="#" class="top-links">Start Selling</a>
                    <a href="#" class="top-links">Browse Brands</a>
                    <a href="#" class="top-links">Buyers Guide</a>
                    <a href="#" class="top-links">Gift Cards</a>
                    <a href="#" class="top-links">Help Center</a>

                    <div class="social-icons">
                        <a href="#"> <i class="fab fa-facebook-f"></i></a>
                        <a href="#"> <i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                    </div>
                    <!--END OF SOCIAL ICON-->
                </div>
                <!--END OF TOP-ITEM-->
            </div>
        </div>
        <!--END OF ROW-->
    </div>
</section>
<!--=====END OF TOPBAR=====-->


<!--==============================
        HEADER SECTION
 ==============================-->
<header class="header-section">
    <div class="container-fluid mx-auto">
        <div class="header-top">
            <div class="row pb-2">
                <!--LOGO-->
                <div class="col-lg-2">
                    <a href="/">
                        <h2>Logo</h2>
                    </a>
                </div><!--End of col-2-->

                <!--SEARCH-->
                <div class="col-xl-7 col-lg- d-flex mt-4">
                    {{--  <select class="custom-select">
                      <option selected>All</option>
                      <option value="1">One</option>
                      <option value="2">Two</option>
                      <option value="3">Three</option>
                    </select>  --}}
                    <form class="header-search-form" action="/products/search" id="header-search-form">
                        <input type="text" name="search" placeholder="Search for products,brands and categories ..."
                               required style="background: #f8f8f8;">
                        <button><i class="fas fa-search"></i></button>
                    </form>
                </div><!--End of col-7-->

                <!--USER PANEL-->
                <div class="col-lg-3">
                    <div class="user-panel float-right">
                        <a href="{{route('user.cart.index')}}"><i class="fas fa-shopping-cart"></i>Cart
                            @if( auth()->check())
                                <span class="zero" id="cartItemCount">{{ Cart::count() }}</span>
                            @endif</a>
                        <a href="{{route('user.wishlist.index')}}"><i class="far fa-heart">
                            </i>Wishlist(
                            @if(auth()->check())
                                {{Cart::instance('wishlist')->content()->count()}}
                            @endif
                            )
                        </a>
                        <span class="user-account">
                <a href=""><i class="fas fa-user"></i>
                  My Account</a>
                <div class="dropdown-account">
                  <p>Welcome to company name</p>
                   @if(auth()->guest())
                        <a href="/auth/register">
                    <button type="button" class="btn join">Join Us</button>
                  </a>
                        <a href="/auth/login">
                    <button type="button" class="btn sign">Sign in</button>
                  </a>
                    @else
                        <a href="{!! route('user.dashboard') !!}">
                      <button type="button" class="btn sign">User Dashboard</button>
                    </a>
                        <ul class="account-list">
                      <li><a href="">my orders</a></li>
                      <li><a href="">message center</a></li>
                      <li><a href="{{route('user.wishlist.index')}}">wishlist</a></li>
                      <li><a href="">my coupons</a></li>
                      <li><a href="{{ route('logout') }}">Not {{ auth()->user()->first_name }} ?
                        Sign Out</a></li>
                    </ul>
                    @endif
                    
                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--===============
           NAVIGATION
   =======================-->
    <nav id="navigation" class="navbar navbar-expand-lg navbar-light">

        <ul class="navbar-nav pt-2 pl-5 mx-auto">
            @if(get_root_categories())
                @foreach (get_root_categories()->take(4) as $category)
                    <li class="nav-item dropdown active">
                        <a class="nav-link" href="{{products_search_route($category->slug)}}">
                            {{str_limit($category->name , 30)}}
                            <i class="fas fa-chevron-down ml-2"></i>
                        </a>

                        @if($category->children->count() > 0)
                            <ul class="dropdown-item">
                                <li class="dropdown-list">
                                    @foreach ($category->children as $subCategory)
                                        <a href="{{ products_search_route($subCategory->slug) }}">
                                            {{str_limit($subCategory->name)}}
                                        </a>
                                        @if($subCategory->children->count() > 0)
                                            <ul class="dropdown-item">
                                                @foreach ($subCategory->children as $subSubCategory)
                                                    <li class="dropdown-list">
                                                        <a href="{{ products_search_route($subSubCategory->slug) }}">
                                                            {{str_limit($subSubCategory->name)}}
                                                        </
                                                        a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    @endforeach
                                </li>
                            </ul>
                        @endif
                    </li>
                @endforeach
            @endif

        </ul>

        <div class="support float-right">
            <span><i class="far fa-question-circle"></i>Support</span>
        </div>
    </nav>


    </div>

</header>
