<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{!! get_meta_by_key('site_name') !!} | @section('title')@show</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
    <link rel="shortcut icon" href="/assets/img/favicon.png">

    <style>
        .remodal-bg.with-red-theme.remodal-is-opening,
        .remodal-bg.with-red-theme.remodal-is-opened {
            filter: none;
        }

        .remodal-overlay.with-red-theme {
            background-color: #f44336;
        }

        .remodal.with-red-theme {
            background: #fff;
        }

        .headerimage {
            cursor: hand;
            cursor: grab;
            cursor: -webkit-grab;
            position: relative;
        }

        .company_photo {
            width: 100%;
            height: 300px;
            display: inline-block;
            border: 1px solid #aaa;
        }

        #company_pro_photo1 {
            height: 100px;
            width: 100px;
            border-radius: 50px;
            float: left;
            overflow: hidden;
        }

        .special_admin {
            /*display: flex;*/
            /*justify-content: center;*/
            /*align-items: center;*/
            background: #337ab7;
            padding: 38px;
            max-width: 435px;
            margin: 0 auto;
        }

        .flex_wrap {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .special_buttons {
            list-style: none;
            margin-top: 23px;
            padding: 0;
        }

        .special_buttons ul {
            padding: 0;
        }

        .special_buttons li {
            display: inline;
            background: #fff;
            margin-right: 12px;
            padding: 10px 10px;
        }

        .profile_control {
            padding: 8px 12px;
            max-width: 435px;
            margin: 0 auto;
            border: 1px solid #ddd;
        }

    </style>
@yield('styles')
@yield('sub-styles')
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <!-- Main Header -->
@include('operator.partials.header')
<!-- Left side column. contains the logo and sidebar -->
@include('operator.partials.sidebar')
<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            @yield('content-header')
        </section>
        <!-- Main content -->
        <section class="content">
            @include('flash::message')
            @yield('content')

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
@include('operator.partials.footer')

<!-- Control Sidebar -->

    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<script src="{{ asset('assets/js/admin.js')  }}"></script>
@yield('scripts')
@if(Session::has('flash_message'))
    <script type="text/javascript">
        $(document).ready(function () {
            toastr.success("{!! Session::get('flash_message') !!}");
        });
    </script>
@endif
@yield('sub-scripts')
</body>
</html>