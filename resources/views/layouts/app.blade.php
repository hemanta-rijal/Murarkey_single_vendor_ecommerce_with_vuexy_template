<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="description" content="Murarkey Template" />
    <meta name="keywords" content="Murarkey, unica, creative, html" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Murarkey &ndash; (Unlock Your Beauty)</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('backend/css/bootstrap.min.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('backend/css/font-awesome.min.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('backend/css/themify-icons.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('backend/css/elegant-icons.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('backend/css/owl.carousel.min.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('backend/css/nice-select.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('backend/css/jquery-ui.min.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('backend/css/slicknav.min.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('backend/css/style.css')}}" type="text/css" />
    <!-- <link rel="stylesheet" href="css/production.css"> -->

    <link rel="shortcut icon" href="img/favicon.ico" type="" />
   <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
 @yield('styles')  
</head>
  <body>

     @yield('content')
     
     @include('partials.footer')

    <!-- Js Plugins -->
    <script src="{{ asset('backend/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{ asset('backend/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('backend/js/jquery-ui.min.js')}}"></script>
    <script src="{{ asset('backend/js/jquery.countdown.min.js')}}"></script>
    <script src="{{ asset('backend/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{ asset('backend/js/jquery.zoom.min.js')}}"></script>
    <script src="{{ asset('backend/js/jquery.dd.min.js')}}"></script>
    <script src="{{ asset('backend/js/jquery.slicknav.js')}}"></script>
    <script src="{{ asset('backend/js/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('backend/js/main.js')}}"></script>
    <script>

        $("#useHeader").load("index.html .header-section");
        $("#useFooter").load("index.html .footer-section");
            // only for dev purpose
    window.setTimeout(() => {
      $('.search-type-selector:visible').niceSelect()
    }, 600);
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <script type="text/javascript">
          toastr.options = {
          "closeButton": true,
          "newestOnTop": true,
          "positionClass": "toast-top-center"
        };
      </script>
      <script type="text/javascript">
      $(document).ready(function(){
            $("#addToWishListAjax").on('click', function (e) {
                var product_id = $(this).attr('data-value');
                var quantity = document.getElementById('qty-input-1').value;
                var auth = {{ auth()->check() ? 'true' : 'false' }};
                    $.ajaxSetup({
                        headers: {'X-CSRF-TOKEN': '{{ Session::token() }}'}
                    });
                    $.ajax({
                        type: 'POST',
                        url: '{{ url('user/cart') }}',
                        dataType: 'json',
                        data: {
                            'product_id': product_id,
                            'wishlist': 'on',
                            'qty': quantity,
                        },
                        success: function (result) {
                          swal({
                              buttons: false,
                              icon: "success",
                              timer: 2000,
                              text: result.message,
                          });   
                          // window.location = '{{route('user.wishlist.index')}}';
                        },
                        
                        error: function (result) {
                          if (auth==false) {
                             swal({
                              buttons: false,
                              icon: "warning",
                              timer: 2000,
                              text: '{{ session()->get('result.error') }}',
                              text: 'Please Sign-In And Try Again.'
                          });
                           window.location = '{{route('login')}}';
                          }else{
                            swal({
                              buttons: false,
                              icon: "warning",
                              timer: 2000,
                              text: result.message
                          });
                          }
                        // window.location = '{{route('user.wishlist.index')}}';
                        }
                    });
            });

            $("#addToCartListAjax").on('click', function (e) {
                 var product_id = $(this).attr('data-value');
                var quantity = document.getElementById('qty-input-1').value;
                var cartCount = jQuery("#cartItemCount").text();
                var total = parseInt(quantity)+parseInt( cartCount);
                var image = document.getElementById('product_image').value;
                 var auth = {{ auth()->check() ? 'true' : 'false' }};
                
                $.ajaxSetup({
                  headers: {'X-CSRF-TOKEN': '{{ Session::token() }}'}
                });
                    $.ajax({
                        type: 'POST',
                        url: '{{ url('user/cart') }}',
                        dataType: 'json',
                        data: {
                          'product_id': product_id,
                          'add_to_cart': 'on',
                          'qty': quantity,
                          'options': image,
                        },
                        success: function (result) {
                           $("#cartItemCount").text(total);
                          swal({
                              buttons: false,
                              icon: "success",
                              timer: 2000,
                              text: result.message,
                          });  
                        },
                        
                        error: function (result) {
                          if (auth==false) {
                             swal({
                              buttons: false,
                              icon: "warning",
                              timer: 2000,
                              text: '{{ session()->get('result.error') }}',
                              text: 'Please Sign-In And Try Again.'
                          });
                           window.location = '{{route('login')}}';
                          }else{
                            swal({
                              buttons: false,
                              icon: "warning",
                              timer: 2000,
                              text: result.message
                          });
                          }
                        }
                    });
            });
        });
    </script>


    <script type="text/javascript">
        $(document).ready(function(){
            $("#deleteCartItemAjax").on('click', function (e) {
                var rowId = $(this).attr('data-value');
                    $.ajaxSetup({
                        headers: {'X-CSRF-TOKEN': '{{ Session::token() }}'}
                    });
                    $.ajax({
                        type: 'DELETE',
                        url: '{{ url('/user/cart') }}'+'/'+rowId,
                        dataType: 'json',
                        data: {
                            'rowId': rowId,
                            '_method': 'DELETE'
                        },
                        success: function (result) {
                          swal({
                              buttons: false,
                              icon: "success",
                              timer: 2000,
                              text: result.success
                          });
                         $("div").remove('.cart-item-'+rowId);
                        },
                        
                        error: function (result) {
                          swal({
                                buttons: false,
                                icon: "warning",
                                timer: 2000,
                                text: result.error
                            });
                        }
                    });
            });
        });

            $("#deleteWishlistItem").on('click', function (e) {
                var rowId = $(this).attr('data-value');
                    $.ajaxSetup({
                        headers: {'X-CSRF-TOKEN': '{{ Session::token() }}'}
                    });
                    $.ajax({
                        type: 'POST',
                        url: '{{ url('/user/wishlist') }}'+'/'+rowId,
                        dataType: 'json',
                        data: {
                            'rowId': rowId,
                            '_method': 'DELETE'
                        },
                        success: function (result) {
                          console.log(result);
                          swal({
                              buttons: false,
                              icon: "success",
                              timer: 2000,
                              text: result.success
                          });
                         $("div").remove('.cart-item-'+rowId);
                        },
                        
                        error: function (result) {

                          console.log(result);
                          swal({
                                buttons: false,
                                icon: "warning",
                                timer: 2000,
                                text: result.error
                            });
                        }
                    });
            });

    </script>
   

    
    @if(session()->has('product_page_flash_message'))
        <script>
            swal({
                buttons: false,
                icon: "success",
                timer: 2500,
                text: '{{ session()->get('product_page_flash_message') }}'
            });
        </script>
    @endif
     @yield('scripts') 
  </body>
</html>
