<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!--Google Fonts-->
    <link
      href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Lobster+Two:wght@400;700&family=PT+Sans&family=PT+Serif:wght@400;700&family=Roboto:wght@400;500;700&display=swap"
      rel="stylesheet"
    />

    <!-- Bootstrap CSS -->
    <link
      rel="stylesheet"
      type="text/css"
      href="{{URL::asset('frontend/vendors/bootstrap/css/bootstrap.min.css')}}"
    />

    <!--Fontawesome CSS-->
    <link
      rel="stylesheet"
      type="text/css"
      href="{{URL::asset('frontend/vendors/fontawesome/all.css')}}"
    />

    <!--Flaticon CSS-->
    <link rel="stylesheet" type="text/css" href="{{URL::asset('frontend/vendors/font/flaticon.css')}}">

  <!--Slick Slider Link-->
  <link rel="stylesheet" href="{{URL::asset('frontend/vendors/slick/slick-theme.css')}}">
  <link rel="stylesheet" href="{{URL::asset('frontend/vendors/slick/slick.css')}}">
  <!--Custom CSS-->
  <link rel="stylesheet" type="text/css" href="{{URL::asset('frontend/assets/css/style.css')}}" />
  <title>Ecommerce Website</title>
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

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    
    {{--  <script src="{{URL::asset('frontend/assets/js/jquery.min.js')}}"></script>  --}}
    <script type="text/javascript" src="{{URL::asset('frontend/vendors/bootstrap/js/jquery.min.js')}}"></script>
    <script
      type="text/javascript"
      src="{{URL::asset('frontend/vendors/bootstrap/js/popper.min.js')}}"
    ></script>
    <script  type="text/javascript" src="{{URL::asset('frontend/vendors/bootstrap/js/bootstrap.min.js')}}"> </script>

      <!--slick Js Link-->
      <script type="text/javascript" src="{{URL::asset('frontend/vendors/slick/slick.min.js')}}"></script>

      <!--Cutom Js-->
      <script type="text/javascript" src="{{URL::asset('frontend/assets/js/main.js')}}"></script>

      // custom functions
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
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
