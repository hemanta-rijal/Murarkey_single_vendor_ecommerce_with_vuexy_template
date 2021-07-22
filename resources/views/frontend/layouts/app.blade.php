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
    <style type="text/css">
        .ui-autocomplete-row
        {
            padding:8px;
            background-color: #f4f4f4;
            border-bottom:1px solid #ccc;
            font-weight:bold;
        }
        .ui-autocomplete-row:hover
        {
            background-color: #ddd;
        }
        .ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active, a.ui-button:active, .ui-button:active, .ui-button.ui-state-active:hover{
            border: 0px solid #f4f4f4;
            background: #ddd;
            font-weight: normal;
            color: #000;
        }

    </style>
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
    @include('frontend.includes.sweet-alerts')
      @yield('js')
    <script type="text/javascript">

        $(document).ready(function(){
            $( "#Product_data" ).autocomplete({
                source: function( request, response ) {
                    // Fetch data
                    $.ajaxSetup({
                        headers: {'X-CSRF-TOKEN': '{{ Session::token() }}'}
                    });
                    $.ajax({
                        url:"{{route('products.autocomplete.search')}}",
                        type: 'post',
                        dataType: "json",
                        data: {
                            search: request.term
                        },
                        success: function( data ) {
                            response(data);
                        }
                    });
                },
                minlength:3,
                select: function (key, value) {
                    // Set selection
                    $('#search_keys').val(value.name); // display the selected text
                    // return false;
                }
            }).data("ui-autocomplete")._renderItem = function( ul, item ) {
                return $("<li class='ui-autocomplete-row'></li>")
                    .data("item.autocomplete", item)
                    .append(item.label)
                    .appendTo(ul);
            };

            $( "#Service_data" ).autocomplete({
                source: function( request, response ) {
                    // Fetch data
                    alert('test')
                    $.ajaxSetup({
                        headers: {'X-CSRF-TOKEN': '{{ Session::token() }}'}
                    });
                    $.ajax({
                        url:"{{route('products.autocomplete.search')}}",
                        type: 'post',
                        dataType: "json",
                        data: {
                            search: request.term
                        },
                        success: function( data ) {
                            response(data);
                        }
                    });
                },
                minlength:3,
                select: function (key, value) {
                    // Set selection
                    $('#search_keys').val(value.name); // display the selected text
                    // return false;
                }
            }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
                return $("<li class='ui-autocomplete-row'></li>")
                    .data("item.autocomplete", item)
                    .append(item.label)
                    .appendTo(ul);
            };

        });
    </script>

    <script>
         function changeSearchFromAction() {
            var value=$('#search_keys').val()
            $('#header-search-form').attr('action', '/products/search?' + value);
        }
        function changeSearchOptions(val) {
             alert('test')
             console.log(val)
            if(val=='service'){
                var search_field = document.getElementById('product_search_keys');
                alert(search_field)
            }
        }
    </script>
    
    <script>
        //cart 
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
        }

        //wishlist

          function updateWishlistDropDown() {
            $.ajax({
                type:"GET",
                url:'<?php echo e(route("wishlist.dropdownlist")) ?>',
                success:function (data) {
                    console.log(data);
                    countWishlistData()
                    $('#wislist-hover').html(data);
                }
            })
        }
        function countWishlistData() {
            $.ajax({
                type:"GET",
                url:'<?php echo e(route("wishlist.count")) ?>',
                success:function (data) {
                    $('#countWishlist').html(data);
                }
            })
        }

        function removeFromWishlist(rowId){
            $.ajax({
                type:"DELETE",
                url:'/user/wishlist/'+rowId,
                data:{
                    _token:'<?php echo e(csrf_token()); ?>',
                    rowId:rowId
                },
                success:function (data) {
                        updateWishlistDropDown();
                        countWishlistData();
                        location.reload();
                }
            });
        }

        function loadPaymentOptionWithEsewa(type,amt=null) {
            $.post('<?php echo e(route('esewa.load')); ?>', { _token:'<?php echo e(csrf_token()); ?>',payment_type:type,amount:amt}, function(data){
                $('#submitButton').css('display','block');
                $("form").attr("action","https://uat.esewa.com.np/epay/main");
                $('#esewa').html(data)
            });
        }
        function loadPaymentOptionWithWallet(type) {
            $.post('<?php echo e(route('wallet.verfiy')); ?>', { _token:'<?php echo e(csrf_token()); ?>',payment_type:type}, function(response){
                if(response.status){
                    $('#submitButton').css('display','block');
                }else{
                    alert(response.message)
                    $('#submitButton').css('display','none');
                }
            });
        }
        function loadPaymentOptionWithPayPal(type) {
            $('#submitButton').css('display','block');
            // $.post('<?php echo e(route('paypal.verfiy')); ?>', { _token:'<?php echo e(csrf_token()); ?>',payment_type:type}, function(response){
            //     if(response.status){
            //     }else{
            //         alert(response.message)
            //         $('#submitButton').css('display','none');
            //     }
            // });
        }
    </script>
</body>

</html>