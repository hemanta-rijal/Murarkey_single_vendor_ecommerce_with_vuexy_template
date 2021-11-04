<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title', get_meta_by_key('site_name'))</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="kabmart" content="ecommerce">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="socket-io-host" content="{{ env('SOCKET_IO_HOST', url('')) }}">
    <meta name="keywords" content="{!! get_meta_by_key('site_keywords') !!}">
    <meta name="description" content="{!! get_meta_by_key('site_description') !!}">
    <meta name="google-site-verification" content="NkVHCTpInJWH6wyEtl5h_sU51oHrNhIxwDbJWh2r4MI"/>
    @yield('metas')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" media="screen"
          href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.min.css">
    <link href="/assets/css/kabmart.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/mixins.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/styles.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/responsive.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/custom.css" rel="stylesheet" type="text/css">

    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>


    <!-- GOOGLE FONTS -->
    <!--    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400italic,400,600,700' rel='stylesheet' type='text/css'>-->
    <!--    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300,300italic,400italic,700,400,300' rel='stylesheet' type='text/css'>-->
    <!--    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Open+Sans:400,600,700" rel="stylesheet">-->

    <!-- FAVICON -->
    <link rel="shortcut icon" href="/assets/img/fav.ico">
    @yield('styles')
</head>
<body>
<div class="wrapper">
    @yield('content')
    @include('partials.footer')
</div>
<script src="/assets/js/kabmart.js"></script>
<script>
    $('.help_menu').hover(
        function () {
            $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn();
        },
        function () {
            $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut();
        }
    );


    //        /* shop by category navigation toggle */
    $('.shop-by-category .category-toggle').on('click', function (e) {
        e.preventDefault();
    });

    responseCategoryToggle();
    $(window).bind("resize", responseCategoryToggle);

    function responseCategoryToggle() {
        if ($(window).width() <= 992) {

            $('.shop-by-category .category-toggle').clickToggle(
                function () {
                    $(this).parent().addClass('open');
                },
                function () {
                    $(this).parent().removeClass('open');
                }
            );
        }
    }

    (function () {
        $('.js-vertical-tab-content').hide();
        $('.js-vertical-tab-content:first').show();
        $('.js-vertical-tab').click(function (event) {
            var activeTab;
            event.preventDefault();
            $('.js-vertical-tab-content').hide();
            activeTab = $(this).attr('rel');
            $('#' + activeTab).show();
            $('.js-vertical-tab').removeClass('is-active');
            $(this).addClass('is-active');
            $('.js-vertical-tab-accordion-heading').removeClass('is-active');
            $('.js-vertical-tab-accordion-heading[rel^=\'' + activeTab + '\']').addClass('is-active');
        });
        $('.js-vertical-tab-accordion-heading').click(function (event) {
            var accordion_activeTab;
            event.preventDefault();
            $('.js-vertical-tab-content').hide();
            accordion_activeTab = $(this).attr('rel');
            $('#' + accordion_activeTab).show();
            $('.js-vertical-tab-accordion-heading').removeClass('is-active');
            $(this).addClass('is-active');
            $('.js-vertical-tab').removeClass('is-active');
            $('.js-vertical-tab[rel^=\'' + accordion_activeTab + '\']').addClass('is-active');
        });
    }.call(this));

    function changeSearchFromAction(value) {
        console.log(value);
        $('#header-search-form').attr('action', '/' + value + '/search');
    }

</script>
{!! get_meta_by_key('tracking') !!}
@yield('scripts')

</body>


</html>
