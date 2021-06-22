<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="robots" content="index, follow">
    <title>@yield('meta_title', get_meta_by_key('site_name'))</title>
    <meta name="description" content="@yield('meta_description', config('systemSetting.seo_description'))" />
    <meta name="keywords" content="Murarkey, unica, creative, html" />
    <meta name="keywords" content="@yield('meta_keywords', config('systemSetting.site_keywords'))">
    <meta name="author" content="{{  config('systemSetting.seo_author') }}">
    <meta name="sitemap_link" content="{{ config('systemSetting.site_map_link') }}">

    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>@yield('title')</title>

    @yield('meta')
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
          rel="stylesheet" />
    <!-- Css Styles -->
    <link rel="stylesheet" href="{{URL::asset('frontend/css/bootstrap.min.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{URL::asset('frontend/css/font-awesome.min.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{URL::asset('frontend/css/themify-icons.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{URL::asset('frontend/css/elegant-icons.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{URL::asset('frontend/css/owl.carousel.min.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{URL::asset('frontend/css/nice-select.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{URL::asset('frontend/css/jquery-ui.min.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{URL::asset('frontend/css/slicknav.min.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{URL::asset('frontend/css/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('frontend/css/style.css')}}" type="text/css" />
    <!-- <link rel="stylesheet" href="css/production.css"> -->

    <link rel="shortcut icon" href="{{getFavIcon()}}" type="" />
</head>
<body>
    @include('frontend.includes.header')
    @yield('body')
    @include('frontend.includes.footer')
    <script src="{{URL::asset('frontend/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{URL::asset('frontend/js/bootstrap.min.js')}}"></script>
    <script src="{{URL::asset('frontend/js/jquery-ui.min.js')}}"></script>
    <script src="{{URL::asset('frontend/js/jquery.countdown.min.js')}}"></script>
    <script src="{{URL::asset('frontend/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{URL::asset('frontend/js/jquery.zoom.min.js')}}"></script>
    <script src="{{URL::asset('frontend/js/jquery.dd.min.js')}}"></script>
    <script src="{{URL::asset('frontend/js/jquery.slicknav.js')}}"></script>
    <script src="{{URL::asset('frontend/js/owl.carousel.min.js')}}"></script>
    <script src="{{URL::asset('frontend/js/main.js')}}"></script>
    <script src="{{URL::asset('frontend/js/sweetalert2.all.min.js')}}"></script>
    @include('frontend.includes.sweet-alerts');
      @yield('js')
    //custom js
    <script>
         function changeSearchFromAction() {
            var value=$('#search_keys').val()
            $('#header-search-form').attr('action', '/products/search?' + value);
        }
    </script>
    
    <script>
        function updateCartDropDown() {
            $.ajax({
                type:"GET",
                url:'<?php echo e(route("cart.dropdownlist")) ?>',
                success:function (data) {
                    countCartData()
                    $('#cart-hover').html(data);
                }
            })
        }
        function countCartData() {
            $.ajax({
                type:"GET",
                url:'<?php echo e(route("cart.count")) ?>',
                success:function (data) {
                    $('#countCart').html(data);
                }
            })
        }

        function removeFromCart(rowId){
            $.ajax({
                type:"DELETE",
                url:'/user/cart/'+rowId,
                data:{
                    _token:'<?php echo e(csrf_token()); ?>',
                    rowId:rowId
                },
                success:function (data) {
                        updateCartDropDown();
                        countCartData();
                        location.reload();
                }
            });


            {{--$.post('<?php echo e(route('user.cart.destroy',rowId)); ?>', {}, function(data){--}}
            {{--    updateCartDropDown();--}}
            {{--    countCartData();--}}
            {{--    location.reload();--}}
            {{--});--}}
        }
    </script>
     
</body>

</html>