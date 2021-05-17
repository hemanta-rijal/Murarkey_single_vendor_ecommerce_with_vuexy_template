<div class="shop-header">
    <div class="top-header clearfix hidden-xs hide">
        <div class="container">
            <ul class="list-unstyled list-inline pull-right top-nav">
                <!-- <li><a href="#">Help</a></li> -->
                @if(auth()->guest())
                    <li>Are you a Supplier ? <a href="{{ route('register') }}" class="pcolor f-s-14"
                                                style="font-weight:bold;"> Join Free</a></li>
                @else
                    @role('ordinary-user')
                    <li>Are you a Supplier ? <a href="/user/create-seller-company" class="pcolor f-s-14"
                                                style="font-weight:bold;">Create Company</a></li>
                    @endrole
                    @if(auth()->user()->isSeller())
                        @if(auth()->user()->seller->company->is_pending)
                            <li>Your company application is pending approval.</li>
                        @else
                                <li><a href="/user/products/create" class="pcolor f-s-14"
                                                style="font-weight:bold;">Post New Product</a></li>
                        @endif
                    @endif
                @endif
                <li class="dropdown help_menu">
                    <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">Help
                        <span class="caret"></span></button>
                    <ul class="dropdown-menu help_tooltip_style">
                        <li><a href="/pages/how-to-find-supplier">Help Center</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-header " id="menubar-fix-desktop">
        <div class="container">
            <!-- LOGO -->
            <div class="row" id="menubar-desktop">
                <div class="col-md-3">
                    <div class="logo">
                        <h1><a href="/"><img src="{!! get_site_logo() !!}" alt="Kabmart"
                                             style="max-height:75px;width:100%;"><span class="sr-only">Kabmart</span></a></h1>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="col-md-6">
                    <div class="bottom-header p-t-23">
                        <!-- SEARCH FORM -->
                        <div class="search-box p_search_box" id="search-desktop">
                            <form class="form form-horizontal" id="header-search-form" action="/products/search">
                                <div class="input-group search_by">
                               <!--      <div class="input-group-btn">
                                        <select id="search-type-select" name="type"
                                                onchange="changeSearchFromAction(this.value)"
                                                class="multiselect search-type-select" data-role="multiselect">
                                            <option value="products" selected="selected">All Products</option>
                                            <option value="companies">All Suppliers</option>
                                        </select>
                                    </div> -->
                                    <input class="form-control" name="search" placeholder="Search for products,brands and categories ..." required style="background: #f8f8f8;"/>
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-default btn-search-go f-s-15"
                                        style="height"> Search</button>

                                        <button type="submit"
                                        class="btn btn-default btn-search-go respond_mob_button f-s-15"
                                        style="height"><i class="fa fa-search f-s-19 m-r-10"></i></button>
                                    </span>
                                </div>
                                <div class="clearfix"></div>
                            </form>
                            <div class="clearfix"></div>
                        </div>
                        <!-- END SEARCH FORM -->
                        <div class="clearfix"></div>
                    </div>

                    <div class="clearfix"></div>
                </div>
                <div class="col-md-3">
                    <!-- ACCOUNT -->
                    <div class="account p-t-23 ">
                        <nav class="navbar navbar-default">
                            <div id="account-nav" class="navbar-nocollapse">
                                <ul class="nav navbar-nav">
                                    <li class="shopping-cart"><a href="{{ route('user.cart.index') }}"><i class="fa fa-shopping-cart"></i>@if(auth()->check()) <span class="cart-count">{{ Cart::count() }}</span> @endif </a></li>
                                    <li class="dropdown user-menu">


                                        @if(auth()->guest())
                                            <a href="#" class="dropdown-toggle m-l-15" data-toggle="dropdown">
                                                <!--<img src="assets/img/user.png" class="avatar" alt="User Avatar">-->
                                                <span class="pcolor">Sign In | Join Free <i
                                                            class="fa fa-angle-down"></i> </span>
                                                <br><span class="f-s-15 white">My Account</span></a>
                                            <ul class="dropdown-menu p-b-0 auth_menu p-t-13 m-t-12 tooltip_style"
                                                role="menu" style="padding:0;">
                                                <li class="mm_flex">
                                                    <a class="btn btn-info my_auth" href="{{ route('login') }}">Sign
                                                        In</a>
                                                    <span> or </span>
                                                    <a href="{{ route('register') }}" class="btn btn-info my_auth"
                                                       style="background-color:rgba(31, 114, 240, 0.16);color:#000;border:2px solid #1F72F0; padding-top:5px;">Join
                                                        Free</a>
                                                </li>
                                                <li class="divider m-b-0"></li>
                                                <li class="p-t-0 p-l-20 f-s-15"><a href="#">My Account</a></li>
                                            </ul>
                                        @else
                                            <a href="#" class="dropdown-toggle m-l-15" data-toggle="dropdown" aria-expanded="false">
                                                <span class="pcolor"> Hello User </span>
                                                <br><span class="f-s-15">My Account @if(total_count_of_notification()) 
                                                    <span class="red_badge">{{ total_count_of_notification() }}</span>
                                                </span> @endif</a>
                                            <ul class="dropdown-menu p-b-0 auth_menu p-t-13 m-t-12 tooltip_style"
                                                id="loggedIn" role="menu" style="padding:0;">
                                                <li class="p-t-0 f-s-15"><a href="{!! route('user.dashboard') !!}">User
                                                        Dashboard</a></li>

                                                <li class="p-t-0 f-s-15"><a href="{!! route('user.my-orders.index') !!}">My Orders</a></li>
                                                <li class="p-t-0 f-s-15"><a href="/user/wishlist">Wishlist</a></li>
                                                @role('main-seller|associate-seller')
                                                <li class="p-t-0 f-s-15"><a href="/user/products">My Products</a></li>
                                                <li class="p-t-0 f-s-15"><a href="/user/orders">Company Orders</a></li>

                                                @endrole
                                                <li class="p-t-0 f-s-15"><a
                                                            href="{!! route('user.message-center.conversations') !!}">Message
                                                        Center ({{ getUnreadMessagesCount() }})</a></li>
                                                <li class="p-t-0 f-s-15"><a
                                                            href="{!! route('user.message-center.system-news') !!}">System News ({{ get_unread_system_message_count() }})</a></li>
                                                @role('ordinary-user|associate-seller')
                                                <li class="p-t-0 f-s-15"><a
                                                            href="/user/message-center/invite-requests">Invite
                                                        Requests
                                                        @if( $invitation_count = get_invitation_count())
                                                            ({{ $invitation_count }})
                                                        @endif</a>
                                                </li>
                                                @endrole
                                                <li class="p-t-0 f-s-15"><a href="{!! route('user.my-account') !!}">My
                                                        Account Settings</a></li>
                                                <li class="p-t-0 f-s-15"><a
                                                            href="{{ route('logout') }}"><p id="user_name">Not {{ auth()->user()->first_name }}</p>
                                                        ? Sign Out</a></li>
                                            </ul>
                                        @endif
                                    </li>

                                    <div class="clearfix"></div>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                        </nav>
                    </div>
                    <!-- END ACCOUNT -->
                </div>


            </div>

            <!-- END LOG -->


  
        </div>
    </div>

            <div class="main-header" id="menubar-fix-mobile">
                <div class="container">
                          <div class="row" id="menubar-mobile">
                     <div class="col-xs-2">

                        <div class="navbar " >
                            <ul class="nav navbar-nav" style="margin:0;">
                             
                                  <li class="all_categ "><a href="/categories" class=" f-s-14"> <i class="fa fa-list" style="color:white;"></i></a></li>
                            
                            </ul>
                        </div>
                    </div>

                    <div class="col-xs-5">
                        <div class="logo">
                            <h1><a href="/"><img src="{!! get_site_logo() !!}" alt="Kabmart"
                               style="max-height:75px;"><span class="sr-only">Kabmart</span></a></h1>
                           </div>
                           <div class="clearfix"></div>
                       </div>

                       <div class="col-xs-5">
                        <!-- ACCOUNT -->
                        <div class="account p-t-12">
                            <nav class="navbar navbar-default">
                                <div id="account-nav" class="navbar-nocollapse">
                                    <ul class="nav navbar-nav">
                                            <li class="shopping-cart"><a href="{{ route('user.cart.index') }}"><i class="fa fa-shopping-cart"></i>@if(auth()->check()) <span class="cart-count">{{ Cart::count() }}</span> @endif </a></li>
                                        <li class="dropdown user-menu">

                                            @if(auth()->guest())
                                            <a href="#" class="dropdown-toggle " data-toggle="dropdown">
                                                <!--<img src="assets/img/user.png" class="avatar" alt="User Avatar">-->
                                                <span class="pcolor">login<i
                                                    class="fa fa-angle-down"></i> </span>
                                                  
                                                    <ul class="dropdown-menu p-b-0 auth_menu p-t-13 m-t-12 tooltip_style"
                                                    role="menu" >
                                                    <li class="p-t-0 f-s-15">
                                                        <a class="my_auth" href="{{ route('login') }}">Sign
                                                        In</a>
                                                        </li>
                                                        <li class="p-t-0 f-s-15">

                                                        <a href="{{ route('register') }}" class=" my_auth">Join
                                                    Free</a>
                                                </li>
                                             
                                            </ul>
                                            @else
                                            <a href="#" class="dropdown-toggle m-l-15" data-toggle="dropdown" aria-expanded="false">
                                                <span class="pcolor"> Hello {{ auth()->user()->first_name }} </span>
                                                <br><span class="f-s-15" style="color:white;">My Account @if(total_count_of_notification()) <span class="red_badge">{{ total_count_of_notification() }}</span></span> @endif</a>
                                                <ul class="dropdown-menu p-b-0 auth_menu p-t-13 m-t-12 tooltip_style"
                                                id="loggedIn" role="menu" style="padding:0;">
                                                <li class="p-t-0 f-s-15"><a href="{!! route('user.dashboard') !!}">User
                                                Dashboard</a></li>

                                                 <li class="p-t-0 f-s-15"><a href="{!! route('user.my-orders.index') !!}">My Orders</a></li>

                                                @role('main-seller|associate-seller')
                                                <li class="p-t-0 f-s-15"><a href="/user/products">My Products</a></li>
                                                <li class="p-t-0 f-s-15"><a href="/user/orders">Company Orders</a></li>
                                                @endrole
                                                <li class="p-t-0 f-s-15"><a href="/user/wishlist">Wishlist</a></li>
                                                <li class="p-t-0 f-s-15"><a
                                                    href="{!! route('user.message-center.conversations') !!}">Message
                                                Center ({{ getUnreadMessagesCount() }})</a></li>
                                                <li class="p-t-0 f-s-15"><a
                                                    href="{!! route('user.message-center.system-news') !!}">System News ({{ get_unread_system_message_count() }})</a></li>
                                                    @role('ordinary-user|associate-seller')
                                                    <li class="p-t-0 f-s-15"><a
                                                        href="/user/message-center/invite-requests">Invite
                                                        Requests
                                                        @if( $invitation_count = get_invitation_count())
                                                        ({{ $invitation_count }})
                                                    @endif</a>
                                                </li>
                                                @endrole
                                                <li class="p-t-0 f-s-15"><a href="{!! route('user.my-account') !!}">My
                                                Account Settings</a></li>
                                                <li class="p-t-0 f-s-15"><a
                                                    href="{{ route('logout') }}"><p id="user_name">Not {{ auth()->user()->first_name }}</p>
                                                ? Sign Out</a></li>
                                            </ul>
                                            @endif
                                        </li>

                                        <div class="clearfix"></div>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                            </nav>
                        </div>
                        <!-- END ACCOUNT -->
                    </div>
                </div>
                <div class="row">
                  <div class="search-box p_search_box " id="search-mobile">
                    <form class="form form-horizontal" id="header-search-form" action="/products/search">
                        <div class="input-group search_by">
                            <input class="form-control" name="search" placeholder="Search for products,brands and categories ..." required style="background: #f8f8f8;"/>
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-default btn-search-go f-s-15"
                                > Search</button>
                                <button type="submit"
                                class="btn btn-default btn-search-go respond_mob_button f-s-15"><i class="fa fa-search f-s-19 "></i></button>
                            </span>
                        </div>
                        <div class="clearfix"></div>
                    </form>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</div>

