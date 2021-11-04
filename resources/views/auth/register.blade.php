@extends('layouts.app')
@section('styles')
    <style>
        footer {
            background-color: #2e2e54;
        }

        #logo_wala {
            background-color: #ffffff;
        }
    </style>
@endsection

@section('title')
    Kabmart Register
@endsection

@section('content')
    <div class="container" id="app">

        <section id="logo_wala" class="m-b-0">
            <!--logo-->
            <div class="row">
                <div class="col-md-12" align="center">
                    <div class="signup_logo">

                        <a href="/"><img src="{!! get_site_logo() !!}" alt="kabmart"
                                         class="img-responsive" style="max-height:75px;"></a>
                    </div>
                </div>
            </div>
            <!--logo-->
        </section>
        <section id="seller_registration">

            <div class="row m-b-40">
                <div class="col-md-12">
                    <h4 class="seller_title pull-left black">User Registration</h4>
                    <p class="text-right">Already have a seller account? <a href="{!! route('login') !!}"
                                                                            class="pcolor">Sign In</a></p>
                </div>
            </div>
            @if($errors->count() > 0)
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-md-3 control-label"><span class="red"></span></label>
                            <div class="col-md-9">
                                @include('partials.error-message')
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="row">
                {!! Form::open(['route' => 'register', 'files' => true]) !!}


                <div class="col-md-12">
                    <!--seller box-->
                    <div class="seller_box">
                        <p class="m-b-33 slight_black f-s-17">User Account Information</p>

                        <!--new register -->
                        <div class="form-horizontal">

                            <div class="form-group">
                                <label class="col-md-3 control-label"><span class="red">*</span>Mobile Number</label>
                                <div class="col-md-9">
                                    {!! Form::text('user[phone_number]', null, ['class' => "phone_number form-control ".get_css_class($errors, 'user.phone_number'), 'placeholder' => "Enter Phone Number. ex 9806941196", 'regex' => '^9+([7-8][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]+)',
                                                'title'=> "Phone number must be valid. example of valid phone is 9806941196",
                                                'required', 'id' => 'phone-number', 'maxlength' => '10' ]) !!}
                                    <button type="button" id="continue-btn" class="btn btn-info m-t-10 "
                                            @if(old('user.phone_number')) style="display: none" @endif>Continue
                                    </button>
                                    <a href="/auth/register" id="change-btn" class="btn btn-danger m-t-10"
                                       @if(!old('user.phone_number')) style="display: none" @endif>Change</a>
                                </div>
                            </div>

                            <div class="our-container" @if(!old('user.phone_number')) style="display: none" @endif>
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><span class="red">*</span> Enter Verification
                                        Code </label>
                                    <div class="col-md-9">
                                        <input id="otp" type="text" name="otp" class="form-control "
                                               placeholder="Please enter verification" required number
                                               title="Please provide vaild verification code" minlength="6"
                                               maxlength="6">

                                        <button id="resend-btn" type="submit" class="btn btn-danger m-t-10 ">
                                            Re-send
                                        </button>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"><span class="red">*</span> Set
                                        Password</label>
                                    <div class="col-md-9">
                                        {!! Form::password('user[password]', ['class' => "form-control".get_css_class($errors, 'user.password'), 'id' => "password-field", 'placeholder' => "Enter your password",
                                                    'required', 'minlength' => "8", 'regex' => "^(?=.*[A-Za-z])(?=.*\d).{8,}$", 'title'=>"Password must be minimum 8 characters at least 1 Alphabet and 1 Number"]) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><span class="red">*</span> Confirm
                                        Password</label>
                                    <div class="col-md-9">
                                        {!! Form::password('user[password_confirmation]', ['class' => "form-control".get_css_class($errors, 'user.password'), 'placeholder' => "Enter your password Again",
                                                    'required', 'equalTo'=> '#password-field', 'title' => '! Password Mismatch']) !!}
                                    </div>
                                </div>
                                <div class="form-horizontal">
                                    <div id="movable-div-1">
                                        <div id="movable-div-content">
                                            <div class="form-group">
                                                <label class="col-md-3 control-label"><span class="red"></span></label>
                                                <div class="col-md-9">
                                                    <label class="fancy-checkbox m-t-15">
                                                        {!! Form::checkbox('user_agreement', true, null, ['required','class' => 'user-agreement', 'title' => 'Please agree on user agreement']) !!}
                                                        <span>By registering in the platform, you must accept our <a
                                                                    href="/pages/user-agreement" class="pcolor">User Agreement</a></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label"><span class="red"></span></label>
                                                <div class="col-md-8">
                                                    <button type="submit"
                                                            class="btn btn-info pcolor_bg no_border m-t-0 m-r-26 p-13 create_reseller">
                                                        Create your account
                                                    </button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <!-- end of new format -->

                        <hr>

                    </div>
                    <!--seller box-->

                    <!--seller box-->
                    <div id="seller-info" class="seller_box hidden">
                        <p class="m-b-33 slight_black" style="font-size:17px;">Seller Contact Information <span
                                    class="f-s-14" style="color:dimgray;">(This information will be seen by buyers on the website)</span>
                        </p>
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label class="col-md-3 control-label"><span class="red">*</span> Position in the
                                    company</label>
                                <div class="col-md-9">
                                    {!! Form::text('seller[position]', null, ['class' => "form-control ignore required".get_css_class($errors, 'seller.position'), 'placeholder' => "Enter position in the company",
                                           ]) !!}
                                </div>
                            </div>

                            @include('partials.numbers-input')
                            <div class="form-group">
                                <label class="col-md-3 control-label"><span class="red"></span>Skype ID</label>
                                <div class="col-md-9">
                                    {!! Form::text('seller[skype]', null, ['class' => "form-control"]) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"><span class="red"></span>Viber ID</label>
                                <div class="col-md-9">
                                    {!! Form::text('seller[viber]', null, ['class' => "form-control".get_css_class($errors, 'seller.viber')]) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"><span class="red"></span>Whatsapp
                                    ID</label>
                                <div class="col-md-9">
                                    {!! Form::text('seller[whatsapp]', null, ['class' => "form-control".get_css_class($errors, 'seller.whatsapp')]) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"><span class="red"></span>WeChat ID</label>
                                <div class="col-md-9">
                                    {!! Form::text('seller[wechat]', null, ['class' => "form-control".get_css_class($errors, 'seller.wechat')]) !!}
                                </div>
                            </div>

                        </div>
                    </div>
                    <!--seller box-->

                    <!--seller box-->
                    <div id="company-info" class="seller_box hidden">
                        <p class="m-b-33 slight_black" style="font-size:17px;">Company Information <span
                                    class="f-s-14" style="color:dimgray;">(This information will be seen by buyers on the website)</span>
                        </p>
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label class="col-md-3 control-label"><span class="red">*</span> Company
                                    Name</label>
                                <div class="col-md-9">
                                    {!! Form::text('company[name]', null, ['class' => "form-control ignore required".get_css_class($errors, 'company.name'), 'placeholder' => "Enter Company Name"]) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"><span class="red">*</span> Year
                                    Established</label>
                                <div class="col-md-9">
                                    {!! Form::number('company[established_year]', null, ['class' => "form-control ignore year_estd required".get_css_class($errors, 'company.established_year'), 'placeholder' => "Enter year established", 'required', 'minlength' => "4", 'maxlength' => "4",'regex' => '^[0-9]+$']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label"><span class="red">*</span> Business
                                    Type</label>
                                <div class="col-md-9 required ignore">
                                    @foreach(get_business_type() as $type)
                                        <label class="fancy-checkbox {{ $loop->index == 0 ? 'm-t-7' : '' }}">
                                            <input type="checkbox" class="required ignore business-type"
                                                   name="company[business_type][]"
                                                   value="{{ $type }}">
                                            <span>{{ $type }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label"><span class="red">*</span> Main
                                    Products</label>
                                <div class="col-md-9">
                                    {!! Form::text('company[products]', null, ['class' => "form-control ignore required".get_css_class($errors, 'company.products'), 'placeholder' => "Enter main products, separated with comma"]) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"><span class="red">*</span> Main
                                    Operational Address</label>
                                <div class="col-md-9">
                                    {!! Form::text('company[operational_address]', null, ['class' => "form-control ignore required ".get_css_class($errors, 'company.operational_address'), 'placeholder' => "Enter Main Operational Address"]) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"><span class="red">*</span>Country</label>
                                <div class="col-md-9">
                                    <select id="countryId" name="company[country_id]"
                                            class="form-control selecto countries ignore required {{ get_css_class($errors, 'company.country') }}">
                                        <option value="">Select Country</option>
                                    </select>
                                    <input type="hidden" name="hidden_country_id" value="153">

                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-3 control-label"><span class="red">*</span>Province</label>
                                <div class="col-md-9">
                                    <!--                                                <input type="text" class="form-control" placeholder ="Enter Province" value="" required>-->
                                    <select name="company[province]"
                                            class="form-control selecto states ignore {{ get_css_class($errors, 'company.province') }} required"
                                            id="stateId">
                                        <option value="">Select Province</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"><span class="red">*</span>City</label>
                                <div class="col-md-9">
                                    <!--                                                <input type="text" class="form-control" placeholder ="Enter City" value="" required>-->
                                    <select name="company[city]"
                                            class="form-control selecto cities ignore  {{ get_css_class($errors, 'company.city') }} required"
                                            id="cityId">
                                        <option value="">Select City</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"><span class="red"></span>Website
                                    Address</label>
                                <div class="col-md-9">
                                    {!! Form::url('company[website]', null, ['class' => "form-control". get_css_class($errors, 'company.website') , 'placeholder' => "Enter website address ex. http://www.yourcompanyname.com",'title' => 'Enter website address ex. http://www.yourcompanyname.com']) !!}
                                </div>
                            </div>
                            @if(!hide_permit_upload())
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><span class="red">*</span>Government
                                        Business Permit</label>
                                    <div class="col-md-9">
                                        <div id="pum_uploadinput">
                                            <div class="form-group">
                                                <input type="file" name="government_business_permit" id="file"
                                                       class="input-file required ignore permit-file"
                                                       title="Please upload government permit">
                                                <label for="file" class="btn btn-tertiary js-labelFile">
                                                    <span class="js-fileName has_input_error">Upload Attachment</span>
                                                </label>
                                                <span class="p-l-18 p-t-9"> Max 25 Mb</span>
                                            </div>
                                            <div id="file-error-message">

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div id="movable-div-2">

                            </div>
                        </div>

                    </div>
                    <!--seller box-->
                </div>
                {!! Form::close() !!}
            </div>

        </section>

    </div>
    @if(isset($model))
        <div id="remodel-div" class="remodal" data-remodal-id="modal" role="dialog" aria-labelledby="modal1Title"
             aria-describedby="modal1Desc">
            <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
            <div>
                <h2 id="modal1Title">Congratulations <br>
                    You have been signed up</h2>
                <p id="modal1Desc">
                    Thank you for registering with Kabmart
                    <br>
                    We have send you an email confirmation with activation link.
                    <br>
                    Please click the link to activate your account.
                    @if($model == 'seller-account')
                        <br><br>
                        However, your application for Seller Company is still pending for approval.
                        <br>
                        You will receive a separate email once your Seller Company has been approved.
                    @endif
                </p>
            </div>
            <br>
            <a class="remodal-cancel remodal_goto_btn pcolor_bg" href="{{ route('home') }}">Go to Homepage</a>
        </div>
    @endif
@endsection

@section('scripts')
    <script src="/assets/js/seller.js"></script>
    <script src="/assets/js/location.js"></script>
    <script src="/assets/validation/jquery.validate.min.js"></script>
    {{--<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>--}}
    @if(isset($model))
        <script src="https://cdnjs.cloudflare.com/ajax/libs/remodal/1.0.6/remodal.min.js"></script>
        <script>
            var inst = $('#remodel-div').remodal({
                modifier: 'with-red-theme'
            });

            inst.open();
        </script>
    @endif

    <script>
        (function () {

            'use strict';

            $('.input-file').each(function () {
                var $input = $(this),
                    $label = $input.next('.js-labelFile'),
                    labelVal = $label.html();

                $input.on('change', function (element) {
                    var fileName = '';
                    if (element.target.value) fileName = element.target.value.split('\\').pop();
                    fileName ? $label.addClass('has-file').find('.js-fileName').html(fileName) : $label.removeClass('has-file').html(labelVal);
                });
            });

        })();

        function create_seller_company(e) {
            var requiredFields = $(".required");

            if ($('#create_seller_company').prop("checked")) {
                requiredFields.prop('required', true);
                requiredFields.removeClass('ignore');
                $('#seller-info').removeClass('hidden');
                $('#company-info').removeClass('hidden');
                $('#movable-div-content').appendTo($('#movable-div-2'));
            } else {
                $('#seller-info').addClass('hidden');
                $('#company-info').addClass('hidden');
                $('#movable-div-content').appendTo($('#movable-div-1'));
                requiredFields.prop('required', null);
                requiredFields.addClass('ignore');
            }
        }

        create_seller_company();
        $('#create_seller_company').change(create_seller_company);

        $.validator.addMethod("business-type", validateBusinessType, "Please check at least one Business type");

        $.validator.addMethod(
            "regex",
            function (value, element, regexp) {
                var re = new RegExp(regexp);
                return this.optional(element) || re.test(value);
            },
            "Please check your input."
        );

        function validateBusinessType() {
            var counter = 0;
            $('.business-type').each(function (index, item) {
                if ($(item).prop('checked'))
                    counter++;
            });

            return counter !== 0;
        }

        $('#continue-btn').click(preRegister)
        $('#resend-btn').click(preRegister)

        function preRegister() {
            var phone_number = $('#phone-number').val()

            $.post('/auth/pre-register', {phone_number, _token: '{{ csrf_token() }}'})
                .done(function (data) {
                    $('#phone-number').attr('readonly', true)
                    $('.our-container').show()
                    $('#change-btn').show()
                    $('#continue-btn').hide()

                    console.log(data.otp);
                    $('#phone-number').attr('readonly', true)
                    document.getElementById('otp').value = data.otp;
                    // $("#otp.sitebg").change(function() {
                    //     return this.value + data.otp;
                    // });
                }).fail(function (err) {
                if (err.status === 422)
                    alert('Already registered')
            })
        }

        $("form").validate({
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
                    case 'text':
                        element.closest('div').append(error);
                        break;
                    default:
                        break;
                }

                if (element.hasClass('phone_number'))
                    element.closest('div').append(error);

            }
        });

    </script>
@endsection
