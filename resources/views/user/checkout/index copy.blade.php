@extends('layouts.app')

@php
    if (session()->has('buy_now')) {
        session()->flash('buy_now', session()->get('buy_now'));
    }
@endphp

@section('content')
    @include('partials.header')
    <!-- logo, search, myaccount -->

    @include('partials.categories', ['showBreadCrumb' => true])
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css"/>

    <style>

        .category-toggle {
            -moz-border-radius-bottomleft: 0;
            -webkit-border-bottom-left-radius: 0;
            border-bottom-left-radius: 0;
            -moz-border-radius-bottomright: 0;
            -webkit-border-bottom-right-radius: 0;
            border-bottom-right-radius: 0;
            border: 1px solid transparent;
            font-size: 13px;
            font-weight: 800;
            background-color: #fff;
        }

        .category-toggle:hover + .category-nav {
            display: block;
        }

        .navbar-nav > li > .category-toggle {
            padding: 7px 10px 7px 0px;
        }

        .shop-by-category.open {
            border-bottom: 1px solid #DDD;
        }

        .shop-by-category.open .category-toggle {
            border-top: 1px solid #DDD;
            border-left: 1px solid #DDD;
            border-right: 1px solid #DDD;
        }

        #myform {
        }

        .qty {
            width: 75px;
            height: 25px;
            text-align: center;
            border: 1px solid #cecece;
        }

        input.qtyplus {
            width: 25px;
            height: 25px;
            background: #fff;
            border: 1px solid #cecece;
        }

        input.qtyminus {
            width: 25px;
            height: 25px;
            background: #fff;
            border: 1px solid #cecece;
        }

        #cart {
            background-color: white;
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #cecece;
        }

        thead {
            background: #f1f1f1;
        }

        .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
            border: 0px;
        }

        .bootstrap-select:not([class*=col-]):not([class*=form-control]):not(.input-group-btn) {
            width: 100%;
        }
    </style>

    <script src="assets/js/plugins/prettyphoto/jquery.prettyPhoto.min.js"></script>

    <div class="wrapper">
        <section>
            <form method="POST" action="{{ route('user.checkout.store') }}" id="shipment-details-form">

                <input type="hidden" name="otp" id="hidden-otp-code">
                <div class="container">
                    <div class="col-md-12">
                        <div id="cart">
                            <p>Delivery Information</p>


                            {{ csrf_field() }}
                            <div class="form-horizontal">


                                @if($user->shipment_details)
                                    <div class="col-md-12" id="shipment-info">
                                        <div>
                                            {{ $user->formatted_shipment }}
                                        </div>

                                        <button type="button" class="btn btn-danger "
                                                onclick="shipmentMethodChangeHandler()">Edit
                                        </button>
                                    </div>


                                @endif

                                <div id="shipment-form" @if($user->shipment_details) style="display: none" @endif>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label class="col-md-5 control-label"><span class="red">*</span> Full
                                                Name</label>
                                            <div class="col-md-7">
                                                <input class="form-control required" placeholder="Full Name" required=""
                                                       name="user[name]"
                                                       value="{{ $user->shipment_details ? $user->shipment_details->name : ''   }}"
                                                       type="text" aria-required="true">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-5 control-label"><span class="red">*</span> Phone
                                                Number</label>
                                            <div class="col-md-7">
                                                <input class="form-control required phone_number"
                                                       placeholder="Phone Number"
                                                       required=""
                                                       name="user[phone_number]"
                                                       value="{{ $user->shipment_details ? $user->shipment_details->phone_number : ''   }}"
                                                       type="text" aria-required="true" id="form-phone-number"
                                                       placeholder="Enter Phone Number. ex 9806941196"
                                                       regex="^9+([7-8][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]+)"
                                                       title="Phone number must be valid. example of valid phone is 9806941196">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label class="col-md-5 control-label"><span class="red">*</span>
                                                Address</label>
                                            <div class="col-md-7">
                                                <input class="form-control required"
                                                       placeholder="Eg : Sahiyonagar Marga , Mahadevsthan" required=""
                                                       name="user[address]"
                                                       type="text" aria-required="true"
                                                       value="{{ $user->shipment_details ? $user->shipment_details->address : ''   }}"
                                                >
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-5 control-label"><span class="red">*</span>
                                                City</label>
                                            <div class="col-md-7">
                                                <select id="city-selector" name="user[city]"
                                                        class="selectpicker required" data-live-search="true">
                                                    @foreach(get_cities() as $city)
                                                        <option value="{{ $city->name }}"
                                                                data-cod="{{ $city->cod_available }}" {{ ($user->shipment_details && $user->shipment_details->city == $city->name) || ( !$user->shipment_details && $city->id == 29790 ) ? 'selected' : '' }} >{{ $city->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="clearfix"></div>

                        </div>

                        <div id="cart">
                            <p>Payment Method</p>

                            <div class="form-horizontal">
                                <div class="col-md-6">

                                    <label class="radio-inline">
                                        <input id="payment-method-cod" type="radio" name="payment_method"
                                               value="{{ \App\Models\Order::PAYMENT_COD }}">Cash on Delivery
                                    </label>
                                </div>

                                <div class="col-md-6">
                                    <label class="radio-inline">
                                        <input id="payment-method-prepaid" type="radio" name="payment_method"
                                               value="{{ \App\Models\Order::PAYMENT_PREPAID }}">Pre Payment
                                    </label>
                                    <div class="payment-details">

                                        <strong>Note:</strong> Pleaser visit <a href="/pages/payment-details"
                                                                                style="color:orange;">Payment
                                            Details </a>for payment inqueries
                                    </div>

                                </div>


                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>


                    <div class="col-md-9  m-t-20">
                        <div class="left-box">
                            <div class="table-responsive p-10">
                                <table class="table   table-responsive table-striped">
                                    <thead>
                                    <tr>
                                        <th class="cart-product">Product</th>
                                        <th>Description</th>

                                        <th class="text-center">Price</th>
                                        <th class="cart-quantity text-center">Qantity</th>
                                        <th class="text-center">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($items as $item)

                                        <tr>
                                            <td class="cart_product">
                                                <a href="#"><img
                                                            src="{{ resize_image_url($item->name['image'][0]->image, '200X200') }}"
                                                            alt="Product" style="width:100px;height:100px;">
                                                </a>
                                            </td>

                                            <td class="cart_description"><p class="product-name"><a
                                                            href="#">{{ $item->name['title'] }}</a></p>

                                                @foreach($item->options as $key => $value)
                                                    <small><a href="#">{{ $key }} : {{ $value }}</a></small>
                                                    <br>
                                                @endforeach
                                            </td>

                                            <td class="price">

                                            <span>Rs. @if ($item->doDiscount) <strike>{{ $item->price }}</strike>
                                                <b>{{ ceil( $item->price * 0.5 ) }}</b></span>  @else {{ $item->price }} @endif</span>
                                            </td>
                                            <td class="qty">
                                                <span>{{ $item->qty }}</span>
                                            </td>
                                            <td class="price"><span>
                                            @if ($item->doDiscount)
                                                        Rs. {{ ceil($item->price * 0.5) }} <br>
                                                        Rs. {{ ceil($item->price * 0.13) }}  (TAX)
                                                    @else
                                                        {{ $item->total() }}

                                                    @endif

                                        </span></td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 m-t-20">

                        <div class="inner right-box">
                            <table id="shopping-cart-totals-table"
                                   class="table shopping-cart-table-total table-striped">
                                <colgroup>
                                    <col>
                                    <col width="1">
                                </colgroup>
                                <tfoot>
                                <tr>
                                    <td style="width:40%;"><strong>Grand Total</strong></td>
                                    <td style="width:60%;"><strong><span
                                                    class="price"> Rs {{ $total }}</span></strong></td>
                                </tr>
                                </tfoot>
                                <tbody>
                                <tr>
                                    <td style="width:40%;"> Subtotal</td>
                                    <td style="width:60%;"><span class="price">Rs {{ $subTotal }}</span></td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="place-order-desktop">

                                <button type="button" class="checkout checkout-continue">Continue</button>

                            </div>


                            <div id="continue" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header" style="border:0px;">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                                        </div>
                                        <div class="modal-body">

                                            <p>To complete your order, please pay via <strong>Bank</strong> , <strong>Remittances</strong>
                                                or <strong>eSewa</strong> within in <strong>24 hours</strong> by
                                                uploading the payment voucher on my order section .<br>
                                                Failure to make payment by deadline will lead to order cancellation.</p>

                                            <a href="/pages/payment-details">

                                                <button type="button" class="checkout"
                                                        style="display: inline-block;width: 45%;background-color: #F44336;">
                                                    <span>View Payment Details</span></button>
                                            </a>
                                            <button type="button" onclick="showOtpModal()" class="checkout"
                                                    style="display: inline-block;width: 45%;float: right"><span>Place Order</span>
                                            </button>
                                        </div>

                                    </div>

                                </div>
                            </div>

                            <div class="placeorder-mobile">
                                <div class="col-xs-6"
                                     style="background-color: white;height:44px;padding:0px;text-align: center;">
                                <span style="line-height: 46px;">
                                    <strong>Grand Total</strong>
                                    <span class="price">Rs. {{ $total }}</span>
                                </span>

                                </div>
                                <div class="col-xs-6" style="padding:0px;">
                                    <button type="button" class="checkout checkout-continue"><span>Place Order</span>
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>
            </form>


            <div id="otp" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header" style="border:0px;">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                        </div>
                        <div class="modal-body">

                            <h3 style="font-size:18px;"><strong>Verification Code will be sent
                                    to your mobile number <span id="display-mobile-number"
                                                                style="color:orange;font-size: 20px;"></span> to confirm
                                    your order.</strong></h3>

                            <p><strong> or</strong> Change the mobile number
                                <button id="phone-number-edit" class="btn btn-danger"><i
                                            class="fa fa-pencil" style="margin-right:10px;"></i>Edit
                                </button>
                            </p>

                            <div id="change-mobile-number-div" style="display: none">
                                <form id="different-mobile-number">
                                    <input class="form-control required phone_number "
                                           placeholder="Enter your Phone Number"
                                           type="text" aria-required="true"
                                           style="width:50%;margin-bottom: 10px;display: inline"
                                           placeholder="Enter Phone Number. ex 9806941196"
                                           regex="^9+([7-8][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]+)"
                                           title="Phone number must be valid. example of valid phone is 9806941196"
                                           id="changed-phone"
                                    >
                                    <div></div>
                                </form>
                            </div>


                            <button onclick="sendOtp()" class="btn btn-primary">Send verification Code</button>

                            <div style="margin-top:10px;">
                                <form id="otp-form">
                                    <input id="input-otp-code" class="form-control required number " minlength="6"
                                           maxlength="6" placeholder="Verification Code"
                                           required="" name="" value="" type="text" aria-required="true"
                                           style="width:50%;margin-bottom: 10px;display:inline;" required
                                           title="Otp code is 6 digit number, Please provide valid otp.">
                                </form>

                                <div class="otp-send-message"
                                     style="display: none;color:red;padding:5px;margin-top:5px;">
                                    Yo Yo
                                </div>

                                <button type="button" onclick="verifyOtp()" class="btn btn-success ">Submit</button>
                            </div>


                            <div>


                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection


@section('scripts')

    <script src="/assets/validation/jquery.validate.min.js"></script>
    <script>
        $.validator.addMethod(
            "regex",
            function (value, element, regexp) {
                var re = new RegExp(regexp);
                return this.optional(element) || re.test(value);
            },
            "Please check your input."
        );

        $("#shipment-details-form").validate({
            ignore: '.ignore',
            errorClass: 'has_input_error',
            errorElement: "p",
            errorPlacement: function (error, element) {
                element.addClass('has_input_error');
                error.addClass('warning_box plz_fill product-error-message');
                switch (element.attr('type')) {
                    case 'checkbox':
                        element.closest('div').append(error);
                        break;
                    case 'file':
                        $('#file-error-message').append(error);
                        break;
                    case 'url':
                        element.closest('div').append(error);
                        break;
                    case 'password':
                        element.closest('div').append(error);
                        break;
                    default:
                        break;
                }

                if (element.hasClass('phone_number'))
                    element.closest('div').append(error);

            }
        });


        $("#otp-form").validate({
            ignore: '.ignore',
            errorClass: 'has_input_error',
            errorElement: "p",
            errorPlacement: function (error, element) {
                element.addClass('has_input_error');
                error.addClass('warning_box plz_fill product-error-message');
                element.parent().append(error);

            }
        });


        $("#different-mobile-number").validate({
            ignore: '.ignore',
            errorClass: 'has_input_error',
            errorElement: "p",
            errorPlacement: function (error, element) {
                element.addClass('has_input_error');
                error.addClass('warning_box plz_fill product-error-message');

                if (element.hasClass('phone_number'))
                    element.parent().append(error);

            }
        });
    </script>

    <script>
        jQuery(document).ready(function () {
            // This button will increment the value
            $('.qtyplus').click(function (e) {
                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var rowId = $(this).data('row-id');
                var price = $(this).data('price');
                var fieldName = 'quantity-' + rowId;
                var priceSpan = '#row-' + rowId;

                // Get its current value
                var currentVal = parseInt($('input[name=' + fieldName + ']').val());
                // If is not undefined
                if (!isNaN(currentVal)) {
                    // Increment
                    var qty = currentVal + 1;
                    $('input[name=' + fieldName + ']').val(qty);

                    $(priceSpan).text('Rs. ' + (price * qty));
                } else {
                    // Otherwise put a 0 there
                    $('input[name=' + fieldName + ']').val(0);
                }
            });
            // This button will decrement the value till 0
            $(".qtyminus").click(function (e) {
                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var rowId = $(this).data('row-id');
                var price = $(this).data('price');
                var fieldName = 'quantity-' + rowId;
                var priceSpan = '#row-' + rowId;
                // Get its current value
                var currentVal = parseInt($('input[name=' + fieldName + ']').val());
                // If it isn't undefined or its greater than 0
                if (!isNaN(currentVal) && currentVal > 0) {
                    // Decrement one
                    var qty = currentVal - 1;

                    $('input[name=' + fieldName + ']').val(currentVal - 1);
                    $(priceSpan).text('Rs. ' + (price * qty));
                } else {
                    // Otherwise put a 0 there
                    $('input[name=' + fieldName + ']').val(0);
                }
            });

            function paymentMethodHandler() {
                var city_cod = $('#city-selector :selected').data('cod')
                var paymentMethodCod = $('#payment-method-cod');
                var paymentMethodPrepaid = $('#payment-method-prepaid');

                if (city_cod == 1) {
                    paymentMethodCod.attr('checked', true)
                    paymentMethodCod.attr('disabled', false)
                } else {
                    paymentMethodCod.attr('disabled', true)
                    paymentMethodCod.attr('checked', false)
                    paymentMethodPrepaid.attr('checked', true)
                }

            }

            $('#city-selector').change(paymentMethodHandler)

            paymentMethodHandler()

            var placeOrderBtn = $('.checkout-continue')


            function paymentMethodChangeHandler() {
                var pm = $('input[name=payment_method]:checked').val();

                if (pm === '{{ \App\Models\Order::PAYMENT_PREPAID }}') {

                    placeOrderBtn.attr('type', 'button');
                    placeOrderBtn.attr('data-toggle', 'modal');
                    // placeOrderBtn.attr('data-target', '#continue');

                } else {

                    placeOrderBtn.attr('type', 'button');

                }
            }

            $('[name=payment_method]').change(paymentMethodChangeHandler);

            paymentMethodChangeHandler()


            placeOrderBtn.click(function () {
                var pm = $('input[name=payment_method]:checked').val();

                if (!$("#shipment-details-form").valid()) {
                    // placeOrderBtn.attr('disabled', true)
                    $('#shipment-form').show()
                    $('#shipment-info').hide()
                } else {
                    // placeOrderBtn.attr('disabled', '')

                    if (pm === '{{ \App\Models\Order::PAYMENT_PREPAID }}') {
                        $('#continue').modal('show')
                    } else {
                        showOtpModal()
                    }
                }

            })


        });

        function shipmentMethodChangeHandler() {
            $('#shipment-form').show()
            $('#shipment-info').hide()
        }

        function showOtpModal() {
            console.log($('#form-phone-number').val())
            $('#display-mobile-number').html($('#form-phone-number').val())
            $('#continue').modal('hide')
            $('#otp').modal('show')
        }

        var changePhoneNumberShown = false

        $('#phone-number-edit').click(function () {
            changePhoneNumberShown = !changePhoneNumberShown
            $('#change-mobile-number-div').toggle()
        })

        function sendOtp() {
            var phoneNumber

            if (changePhoneNumberShown) {
                if (!$("#different-mobile-number").valid())
                    return false

                phoneNumber = $('#changed-phone').val()
            } else {
                phoneNumber = $('#form-phone-number').val()
            }

            $.post('{{ route('user.send-otp') }}', {_token: window.Laravel.csrfToken, phone_number: phoneNumber})
                .done(function () {
                    $('.otp-send-message').html('Verification code was send to ' + phoneNumber + '. Please enter verification code to place your order, If you have not received it, click Send again button or change mobile number.')
                    $('.otp-send-message').show()
                })
                .fail(function () {
                    $('.otp-send-message').html('Something went wrong. Please try again.')
                    $('.otp-send-message').show()
                })
        }


        function verifyOtp() {
            var otp = $('#input-otp-code').val()

            if ($("#otp-form").valid()) {
                $.post('{{ route('user.verify-otp') }}', {_token: window.Laravel.csrfToken, otp})
                    .done(function (data) {
                        console.log(data)
                        if (data.status)
                            $('#shipment-details-form').submit()
                        else {
                            $('.otp-send-message').html('Invalid Verification code provided')
                            $('.otp-send-message').show()
                        }

                    })
                    .fail(function () {
                        $('.otp-send-message').html('Something went wrong. Please try again.')
                        $('.otp-send-message').show()
                    })
            }
        }
    </script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
@endsection

