@extends('admin.layouts.app')
@section('css')
    {{-- for ecommerce dashboard --}}
    <link rel="stylesheet" type="text/css" href="{{URL::asset('backend/app-assets/css/pages/card-analytics.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{URL::asset('backend/app-assets/css/pages/dashboard-ecommerce.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('backend/app-assets/css/plugins/tour/tour.css')}}">
    <!-- END: Page CSS-->
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css"
          href="{{URL::asset('backend/app-assets/vendors/css/charts/apexcharts.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{URL::asset('backend/app-assets/vendors/css/extensions/tether-theme-arrows.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{URL::asset('backend/app-assets/vendors/css/extensions/tether.min.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{URL::asset('backend/app-assets/vendors/css/extensions/shepherd-theme-default.css')}}">
    <!-- END: Vendor CSS-->
@endsection

@section('js')
    <!-- BEGIN: Page JS-->
    {{-- for dashboard-ecommerce dashboard --}}
    <script src="{{URL::asset('backend/app-assets/js/scripts/pages/dashboard-ecommerce.js')}}"></script>
    <!-- END: Page JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{URL::asset('backend/app-assets/vendors/js/charts/apexcharts.min.js')}}"></script>
    <script src="{{URL::asset('backend/app-assets/vendors/js/extensions/tether.min.js')}}"></script>
    <script src="{{URL::asset('backend/app-assets/vendors/js/extensions/shepherd.min.js')}}"></script>
    <!-- END: Page Vendor JS-->
@endsection

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            @include('flash::message')
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Dashboard Ecommerce Starts -->
                <section id="dashboard-ecommerce">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header d-flex flex-column align-items-start pb-0">
                                    <div class="avatar bg-rgba-primary p-50 m-0">
                                        <div class="avatar-content">
                                            <i class="feather icon-users text-primary font-medium-5"></i>
                                        </div>
                                    </div>
                                    <h2 class="text-bold-700 mt-1">{{ App\Models\User::count() }}</h2>
                                    <p class="mb-0">Users</p>
                                </div>
                                <div class="card-content" style="padding-bottom: 10px;">
                                    {{-- <div id="line-area-chart-1"></div> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header d-flex flex-column align-items-start pb-0">
                                    <div class="avatar bg-rgba-primary p-50 m-0">
                                        <div class="avatar-content">
                                            <i class="feather icon-package text-primary font-medium-5"></i>
                                        </div>
                                    </div>
                                    <h2 class="text-bold-700 mt-1">{{ App\Models\Product::count() }}</h2>
                                    <p class="mb-0">Products</p>
                                </div>
                                <div class="card-content" style="padding-bottom: 10px;">
                                    {{-- <div id="line-area-chart-2"></div> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header d-flex flex-column align-items-start pb-0">
                                    <div class="avatar bg-rgba-primary p-50 m-0">
                                        <div class="avatar-content">
                                            <i class="feather icon-tag text-primary font-medium-5"></i>
                                        </div>
                                    </div>
                                    <h2 class="text-bold-700 mt-1">{{ App\Models\Product::where('status', 'pending')->count() }}</h2>
                                    <p class="mb-0">Pending Products</p>
                                </div>
                                <div class="card-content" style="padding-bottom: 10px;">
                                    {{-- <div id="line-area-chart-3"></div> --}}
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header d-flex flex-column align-items-start pb-0">
                                    <div class="avatar bg-rgba-primary p-50 m-0">
                                        <div class="avatar-content">
                                            <i class="feather icon-shopping-cart text-primary font-medium-5"></i>
                                        </div>
                                    </div>
                                    <h2 class="text-bold-700 mt-1">{{ $totalOrderCount }}</h2>
                                    <p class="mb-0">Total Orders</p>
                                </div>
                                <div class="card-content" style="padding-bottom: 10px;">
                                    {{-- <div id="line-area-chart-4"></div> --}}
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header d-flex flex-column align-items-start pb-0">
                                    <div class="avatar bg-rgba-primary p-50 m-0">
                                        <div class="avatar-content">
                                            <i class="feather icon-truck text-primary font-medium-5"></i>
                                        </div>
                                    </div>
                                    <h2 class="text-bold-700 mt-1">{{ App\Models\Service::count() }}</h2>
                                    <p class="mb-0">Services</p>
                                </div>
                                <div class="card-content" style="padding-bottom: 10px;">
                                    {{-- <div id="line-area-chart-3"></div> --}}
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header d-flex flex-column align-items-start pb-0">
                                    <div class="avatar bg-rgba-primary p-50 m-0">
                                        <div class="avatar-content">
                                            <i class="feather icon-list text-primary font-medium-5"></i>
                                        </div>
                                    </div>
                                    <h2 class="text-bold-700 mt-1">{{ App\Models\ParlourListing::where('status', true)->count() }}</h2>
                                    <p class="mb-0">Parlour Listings</p>
                                </div>
                                <div class="card-content" style="padding-bottom: 10px;">
                                    {{-- <div id="line-area-chart-3"></div> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header d-flex flex-column align-items-start pb-0">
                                    <div class="avatar bg-rgba-primary p-50 m-0">
                                        <div class="avatar-content">
                                            <i class="feather icon-award text-primary font-medium-5"></i>
                                        </div>
                                    </div>
                                    <h2 class="text-bold-700 mt-1">{{ App\Models\Brand::count() }}</h2>
                                    <p class="mb-0">Brands</p>
                                </div>
                                <div class="card-content" style="padding-bottom: 10px;">
                                    {{-- <div id="line-area-chart-3"></div> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header d-flex flex-column align-items-start pb-0">
                                    <div class="avatar bg-rgba-primary p-50 m-0">
                                        <div class="avatar-content">
                                            <i class="feather icon-user-plus text-primary font-medium-5"></i>
                                        </div>
                                    </div>
                                    <h2 class="text-bold-700 mt-1">{{ App\Models\JoinMurarkey::count() }}</h2>
                                    <p class="mb-0">Profession Subscribers</p>
                                </div>
                                <div class="card-content" style="padding-bottom: 10px;">
                                    {{-- <div id="line-area-chart-3"></div> --}}
                                </div>
                            </div>
                        </div>


                    </div>

                </section>
                <!-- Dashboard Ecommerce ends -->

            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection