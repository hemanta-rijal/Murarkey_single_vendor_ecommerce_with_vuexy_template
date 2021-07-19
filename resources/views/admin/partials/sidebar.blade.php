 <!-- BEGIN: Main Menu-->
 <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="{{URL::to('/admin')}}">
                    <div class="brand-logo"></div>
                    <h2 class="brand-text mb-0">{!! get_meta_by_key('site_name') !!}</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="icon-disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item"><a href="{{URL::to('/admin')}}"><i class="feather icon-home"></i><span class="menu-title" data-i18n="Dashboard">Dashboard</span></a>
            </li>
            <li class=" navigation-header"><span>CMS</span>
            </li>
            <li class="nav-item {{ request()->is('admin/menus*') ? 'active' : '' }} "><a href="#"><i class="feather icon-menu"></i>
                    <span class="menu-title" data-i18n="Users">Menus</span></a>
                <ul class="menu-content">
                    <li class=" "><a href="{{route('admin.menus.index')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="View All">View All</span></a>
                    </li>
                    {{-- <li  class=""><a href="{{route('admin.menus.create')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Add New">Add New</span></a> --}}
                    </li>
                </ul>
            </li>
            <li class="nav-item {{ request()->is('admin/users*') ? 'active' : '' }} "><a href="#"><i class="feather icon-user"></i>
                <span class="menu-title" data-i18n="Users">Users</span></a>
                <ul class="menu-content">
                    <li class=" {{\Request::route()->getName()=='admin.users.index' ? 'active' : ''}}"><a href="{{ route('admin.users.index') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="View All">View All</span></a>
                    </li>
                    <li  class="{{\Request::route()->getName()=='admin.users.create' ? 'active' : ''}}"><a href="{{ route('admin.users.create') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Add New">Add New</span></a>
                    </li>
                    {{-- <li><a href="{{ route('admin.users.sellers-trash') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Associate Seller Trash">Associate Seller Trash</span></a>
                    </li> --}}
                    <li  class="{{\Request::route()->getName()=='admin.users.sellers-trash' ? 'active' : ''}}"><a href="{{ route('admin.users.trash') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Trash">Trash</span></a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item {{ request()->is('admin/categories*') ? 'active' : '' }}"><a href="#"><i class="feather icon-list"></i>
                <span class="menu-title" data-i18n="Categories">Categories</span></a>
                <ul class="menu-content">
                    <li class="{{\Request::route()->getName()=='admin.categories.index' ? 'active' : ''}}"><a href="{{ route('admin.categories.index') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="View All">View All</span></a>
                    </li>
                    <li class="{{\Request::route()->getName()=='admin.categories.create' ? 'active' : ''}}"><a href="{{ route('admin.categories.create') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Add New">Add New</span></a>
                    </li>
                    <li class="{{\Request::route()->getName()=='admin.categories.order' ? 'active' : ''}}"><a href="{{ route('admin.categories.order') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Order">Order</span></a>
                    </li>
{{--                    <li class="{{\Request::route()->getName()=='admin.categories.import-export' ? 'active' : ''}}"><a href="{{ route('admin.categories.import-export') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Export Categories">Export Categories</span></a>--}}
{{--                    </li>--}}
                </ul>
            </li>
            <li class=" nav-item {{ request()->is('admin/service-categories*') ? 'active' : '' }}"><a href="#"><i class="feather icon-sliders"></i>
                <span class="menu-title" data-i18n="Service-Categories">Service-Categories</span></a>
                <ul class="menu-content">
                    <li class="{{\Request::route()->getName()=='admin.service-categories.index' ? 'active' : ''}}"><a href="{{ route('admin.service-categories.index') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="View All">View All</span></a>
                    </li>
                    <li class="{{\Request::route()->getName()=='admin.service-categories.create' ? 'active' : ''}}"><a href="{{ route('admin.service-categories.create') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Add New">Add New</span></a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item {{ request()->is('admin/service-labels*') ? 'active' : '' }}"><a href="#"><i class="feather icon-italic"></i>
                <span class="menu-title" data-i18n="Service Labels">Service Labels</span></a>
                <ul class="menu-content">
                    <li class="{{\Request::route()->getName()=='admin.service-labels.index' ? 'active' : ''}}"><a href="{{ route('admin.service-labels.index') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="View All">View All</span></a>
                    </li>
                    <li class="{{\Request::route()->getName()=='admin.service-labels.create' ? 'active' : ''}}"><a href="{{ route('admin.service-labels.create') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Add New">Add New</span></a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item {{ request()->is('admin/services*') ? 'active' : '' }}"><a href="#"><i class="feather icon-bell"></i>
                <span class="menu-title" data-i18n="Services">Services</span></a>
                <ul class="menu-content">
                    <li class="{{\Request::route()->getName()=='admin.services.index' ? 'active' : ''}}"><a href="{{ route('admin.services.index') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="View All">View All</span></a>
                    </li>
                    <li class="{{\Request::route()->getName()=='admin.services.create' ? 'active' : ''}}"><a href="{{ route('admin.services.create') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Add New">Add New</span></a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item {{ request()->is('admin/brands*') ? 'active' : '' }}"><a href="#"><i class="feather icon-award"></i>
                <span class="menu-title" data-i18n="Brands">Brands</span></a>
                <ul class="menu-content">
                    <li class="{{\Request::route()->getName()=='admin.brands.index' ? 'active' : ''}}"><a href="{{ route('admin.brands.index') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="View All">View All</span></a>
                    </li>
                    <li class="{{\Request::route()->getName()=='admin.brands.create' ? 'active' : ''}}"><a href="{{ route('admin.brands.create') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Add New">Add New</span></a>
                    </li>
                    <li class="{{\Request::route()->getName()=='admin.brands.import-export' ? 'active' : ''}}"><a href="{{ route('admin.brands.import-export') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Import/Export Brands">Import/Export Brands</span></a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item {{ request()->is('admin/coupons*') ? 'active' : '' }}"><a href="#"><i class="feather icon-tag"></i>
                <span class="menu-title" data-i18n="Coupon Management">Coupon Management</span></a>
                <ul class="menu-content">
                    <li class="{{\Request::route()->getName()=='admin.coupons.index' ? 'active' : ''}}"><a href="{{ route('admin.coupons.index') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="View All">View All</span></a>
                    </li>
                    <li class="{{\Request::route()->getName()=='admin.coupons.create' ? 'active' : ''}}"><a href="{{ route('admin.coupons.create') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Add New">Add New</span></a>
                    </li>
                </ul>
            </li>


            <li class=" nav-item {{ request()->is('admin/attributes*') ? 'active' : '' }}"><a href="#"><i class="feather icon-layers"></i>
                <span class="menu-title" data-i18n="Attributes">Attributes</span></a>
                <ul class="menu-content">
                    <li class="{{\Request::route()->getName()=='admin.attributes.index' ? 'active' : ''}}"><a href="{{ route('admin.attributes.index') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="View All">View All</span></a>
                    </li>
                    <li class="{{\Request::route()->getName()=='admin.attributes.create' ? 'active' : ''}}"><a href="{{ route('admin.attributes.create') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Add New">Add New</span></a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item {{ request()->is('admin/products*') ? 'active' : '' }}"><a href="#"><i class="feather icon-box"></i>
                <span class="menu-title" data-i18n="Products">Products</span></a>
                <ul class="menu-content">
                    <li class="{{\Request::route()->getName()=='admin.products.index' ? 'active' : ''}}"><a href="{{ route('admin.products.index') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="View All">View All</span></a>
                    </li>
                    <li class="{{\Request::route()->getName()=='admin.products.create' ? 'active' : ''}}"><a href="{{ route('admin.products.create') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Create New ">Create New </span></a>

                    <li class="{{\Request::route()->getName()=='admin.products.import-export' ? 'active' : ''}}"><a href="{{ route('admin.products.import-export') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Import/Export Products">Import/Export Productsl</span></a>
                    </li>
                    <li class="{{\Request::route()->getName()=='admin.products.update-status' ? 'active' : ''}}"><a href="{{ route('admin.products.index') }}?type=pending"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Pending Products">Pending Products</span></a>
                    </li>
                    <li class="{{\Request::route()->getName()=='admin.products.trash' ? 'active' : ''}}"><a href="{{ route('admin.products.trash') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Trash Items">Trash Items</span></a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item {{ request()->is('admin/parlour-listing*') ? 'active' : '' }}"><a href="#"><i class="feather icon-feather"></i>
                <span class="menu-title" data-i18n="Parlour Listing">Parlour Listing</span></a>
                <ul class="menu-content">
                    <li class="{{\Request::route()->getName()=='admin.parlour-listing.index' ? 'active' : ''}}"><a href="{{ route('admin.parlour-listing.index') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="View All">View All</span></a>
                    </li>
                    <li class="{{\Request::route()->getName()=='admin.parlour-listing.create' ? 'active' : ''}}"><a href="{{ route('admin.parlour-listing.create') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Add New">Add New</span></a>
                    </li>
                    <li class="{{\Request::route()->getName()=='admin.parlour-listing.update-status' ? 'active' : ''}}"><a href="{{ route('admin.parlour-listing.index') }}?type=pending"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Pending List">Pending List</span></a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item {{ request()->is('admin/flash-sales*') ? 'active' : '' }}"><a href="#"><i class="feather icon-zap"></i>
                <span class="menu-title" data-i18n="Flash Sale">Flash Sales</span></a>
                <ul class="menu-content">
                    <li class="{{\Request::route()->getName()=='admin.flash-sale.index' ? 'active' : ''}}"><a href="{{ route('admin.flash-sales.index') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="View All">View All</span></a>
                    </li>
                    <li class="{{\Request::route()->getName()=='admin.flash-sale.create' ? 'active' : ''}}"><a href="{{ route('admin.flash-sales.create') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Add New">Add New</span></a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item {{ request()->is('admin/orders*') ? 'active' : '' }}"><a href="#"><i class="feather icon-shopping-cart"></i>
                <span class="menu-title" data-i18n="Orders">Orders</span></a>
                <ul class="menu-content">
                    {{-- <li class="{{\Request::route()->getName()=='' ? 'active' : ''}}"><a href="#"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="View All">View All</span></a> --}}
                    </li>
                    <li class="{{\Request::route()->getName()=='admin.orders.index' ? 'active' : ''}}"><a href="{{route('admin.orders.index')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="View All">View All</span></a>
                    </li>
                </ul>
            </li>
            
            <li class=" nav-item {{ request()->is('admin/reports*') ? 'active' : '' }}"><a href="#"><i class="feather icon-bar-chart-2"></i>
                <span class="menu-title" data-i18n="Reports">Reports</span></a>
                <ul class="menu-content">
{{--                    <li class="{{\Request::route()->getName()=='admin.report.import-export' ? 'active' : ''}}"><a href="{{route('admin.report.import-export')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Export Report">Export Report</span></a>--}}
{{--                    </li>--}}
                    {{-- <li class="{{\Request::route()->getName()=='' ? 'active' : ''}}"><a href="#"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Add New">Add New</span></a>
                    </li> --}}
                </ul>
            </li>
            <li class=" nav-item {{ request()->is('admin/testimonials*') ? 'active' : '' }}"><a href="#"><i class="feather icon-thumbs-up"></i>
                <span class="menu-title" data-i18n="Testimonial">Testimonial</span></a>
                <ul class="menu-content">
                    <li class="{{\Request::route()->getName()=='admin.testimonials.index' ? 'active' : ''}}"><a href="{{route('admin.testimonials.index')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="View All">View All</span></a>
                    </li>
                    <li class="{{\Request::route()->getName()=='admin.testimonials.create' ? 'active' : ''}}"><a href="{{route('admin.testimonials.create')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Add New">Add New</span></a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item {{ request()->is('admin/faqs*') ? 'active' : '' }}"><a href="#"><i class="feather icon-help-circle"></i>
                <span class="menu-title" data-i18n="FAQs">FAQs</span></a>
                <ul class="menu-content">
                    <li class="{{\Request::route()->getName()=='admin.faqs.index' ? 'active' : ''}}"><a href="{{route('admin.faqs.index')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="View All">View All</span></a>
                    </li>
                    <li class="{{\Request::route()->getName()=='admin.faqs.create' ? 'active' : ''}}"><a href="{{route('admin.faqs.create')}}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Add New">Add New</span></a>
                    </li>
                </ul>
            </li>

            {{-- <li class=" nav-item {{ request()->is('admin/system-messages*') ? 'active' : '' }}"><a href="#"><i class="feather icon-message-square"></i>
                <span class="menu-title" data-i18n="System Messages">System Messages</span></a>
                <ul class="menu-content">
                    <li class="{{\Request::route()->getName()=='admin.system-messages.index' ? 'active' : ''}}"><a href="{{ route('admin.system-messages.index') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="View All">View All</span></a>
                    </li>
                    <li class="{{\Request::route()->getName()=='admin.system-messages.create' ? 'active' : ''}}"><a href="{{ route('admin.system-messages.create') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Add New">Add New</span></a>
                    </li>
                </ul>
            </li> --}}
            
            
            
        <li class=" navigation-header"><span>Support</span>
            <li class="{{\Request::route()->getName()=='admin.join-murarkey.index' ? 'active' : ''}}">
                <a href="{{ route('admin.join-murarkey.index') }}"><i class="feather icon-user-plus">
                    </i><span class="menu-item" data-i18n="Murarkey Pro Subscribers">Murarkey Pro Subscribers</span></a>
                </li>
            <li class="{{\Request::route()->getName()=='admin.get.contact-us.index' ? 'active' : ''}}">
                <a href="{{ route('admin.contact-us.index') }}"><i class="feather icon-search">
                    </i><span class="menu-item" data-i18n="Feed Back">Feed Back</span></a>
                </li>
                
            <li class=" nav-item {{ request()->is('admin/subscribers*') ? 'active' : '' }}"><a href="#"><i class="feather icon-mail"></i>
                <span class="menu-title" data-i18n="NewsLetters">NewsLetters</span></a>
                <ul class="menu-content">
                    <li class="{{\Request::route()->getName()=='admin.newsletter.subscribers' ? 'active' : ''}}"><a href="{{ route('admin.newsletter.subscribers') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="All Subscribers">All Subscribers</span></a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item {{ request()->is('admin/home-page*') || request()->is('admin/theme*') || request()->is('admin/sliders*') || request()->is('admin/banners*') ? 'active' : '' }}">
                <a href="#"><i class="feather icon-settings"></i><span class="menu-title" data-i18n="Settings">Settings</span></a>
                <ul class="menu-content">
                    <li><a href="#"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Frontend Settings">Frontend Settings</span></a>
                        <ul class="menu-content">
                            <li class="{{request()->is('admin/banners*') ? 'active' : ''}}"><a href="{!! route('admin.banners.index') !!}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Banner Setting">Banner Setting</span></a>
                            </li>
                             <li class="{{request()->is('admin/frontend-settings/homepage-setting') ? 'active' : ''}}"><a href="{!! route('admin.frontend-settings.homepage-setting') !!}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Home Page Settings">Home Page Settings</span></a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="#"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="System Settings">System Settings</span></a>
                        <ul class="menu-content">
                            <li class="{{request()->is('admin/system-settings/general-setting') ? 'active' : ''}}"><a href="{!! route('admin.system-settings.general-setting') !!}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="General Settings">General Settings</span></a>
                            </li>
                            <li class="{{request()->is('admin/policy-page-settings/general-setting') ? 'active' : ''}}"><a href="{!! route('admin.system-settings.policy-page-setting') !!}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Policy Page Settings">Policy Page Settings</span></a>
                            </li>
                           
                            <li class="{{request()->is('admin/system-settings/payment-setting') ? 'active' : ''}}"><a href="{!! route('admin.system-settings.payment-setting') !!}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Payment Settings">Payment Settings</span></a>
                            </li>
                            <li class="{{request()->is('admin/system-settings/shipping-setting') ? 'active' : ''}}"><a href="{!! route('admin.system-settings.shipping-setting') !!}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Shipping Settings">Shipping Settings</span></a>
                            </li>
                            <li class="{{request()->is('admin/system-settings/social-login-setting') ? 'active' : ''}}"><a href="{!! route('admin.system-settings.social-login-setting') !!}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Shipping Settings">Social Logins</span></a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>

            {{-- <li class=" nav-item {{ request()->is('admin/home-page*') || request()->is('admin/theme*') || request()->is('admin/sliders*') || request()->is('admin/banners*') ? 'active' : '' }}">
                <a href="#"><i class="feather icon-settings"></i>
                <span class="menu-title" data-i18n="System Messages">Settings</span></a>
                <ul class="menu-content">
                    <li class="{{request()->is('admin/banners*') ? 'active' : ''}}"><a href="{!! route('admin.banners.index') !!}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Banner Setting">Banner Setting</span></a>
                    </li>
                    <li class="{{request()->is('admin/system-settings*') ? 'active' : ''}}">
                        <a href="{!! route('admin.system-settings.index') !!}"><i class="feather icon-circle"></i>
                            <span class="menu-item" data-i18n="System Setting">System Setting</span>
                        </a>

                    </li>
                    <li class="{{request()->is('admin/system-settings*') ? 'active' : ''}}"><a href="{{ route('admin.system-settings.index') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="System Settings">System Settings</span></a>
                    </li>
                </ul>
            </li> --}}
        
        </li>
           
        </ul>
    </div>
</div>
<!-- END: Main Menu-->