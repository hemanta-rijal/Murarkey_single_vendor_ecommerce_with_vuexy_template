<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="{!! get_meta_by_key('site_name') !!} admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, {!! get_meta_by_key('site_name') !!} admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>@yield('title') Dashboard | {!! get_meta_by_key('site_name') !!} </title>
    <link rel="apple-touch-icon" href="{{URL::asset('backend/app-assets/images/ico/apple-icon-120.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{URL::asset('backend/app-assets/images/ico/favicon.ico')}}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{URL::asset('backend/app-assets/vendors/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('backend/app-assets/vendors/css/charts/apexcharts.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('backend/app-assets/vendors/css/extensions/tether-theme-arrows.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('backend/app-assets/vendors/css/extensions/tether.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('backend/app-assets/vendors/css/extensions/shepherd-theme-default.css')}}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{URL::asset('backend/app-assets/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('backend/app-assets/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('backend/app-assets/css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('backend/app-assets/css/components.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('backend/app-assets/css/themes/dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('backend/app-assets/css/themes/semi-dark-layout.css')}}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{URL::asset('backend/app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('backend/app-assets/css/core/colors/palette-gradient.css')}}">
    
    {{-- for analytics dashboard --}}
    <link rel="stylesheet" type="text/css" href="{{URL::asset('backend/app-assets/css/pages/dashboard-analytics.css')}}">
    
    {{-- for ecommerce dashboard --}}
    <link rel="stylesheet" type="text/css" href="{{URL::asset('backend/app-assets/css/pages/card-analytics.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('backend/app-assets/css/pages/dashboard-ecommerce.css')}}">
    
    <link rel="stylesheet" type="text/css" href="{{URL::asset('backend/app-assets/css/plugins/tour/tour.css')}}">
    <!-- END: Page CSS-->


    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{URL::asset('backend/assets/css/style.css')}}">
    <!-- END: Custom CSS-->

    <!-- BEGIN: Yield CSS-->
    @yield('css')
    <!-- End: Yield CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern semi-dark-layout 2-columns  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="semi-dark-layout">

    @include('admin.partials.header')

    @include('admin.partials.sidebar')

    @yield('content')

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    @include('admin.partials.footer')
    
    <!-- BEGIN: Yield Custom JS-->
            @yield('js')
    <!-- END: Yield Custom JS-->
    
    <!-- BEGIN: Vendor JS-->
    <script src="{{URL::asset('backend/app-assets/vendors/js/vendors.min.js')}}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{URL::asset('backend/app-assets/vendors/js/charts/apexcharts.min.js')}}"></script>
    <script src="{{URL::asset('backend/app-assets/vendors/js/extensions/tether.min.js')}}"></script>
    <script src="{{URL::asset('backend/app-assets/vendors/js/extensions/shepherd.min.js')}}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{URL::asset('backend/app-assets/js/core/app-menu.js')}}"></script>
    <script src="{{URL::asset('backend/app-assets/js/core/app.js')}}"></script>
    <script src="{{URL::asset('backend/app-assets/js/scripts/components.js')}}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->

    {{-- for dashboard-analytics dashboard --}}
    {{-- <script src="{{URL::asset('backend/app-assets/js/scripts/pages/dashboard-analytics.js')}}"></script> --}}
    
    {{-- for dashboard-ecommerce dashboard --}}
    <script src="{{URL::asset('backend/app-assets/js/scripts/pages/dashboard-ecommerce.js')}}"></script>
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>