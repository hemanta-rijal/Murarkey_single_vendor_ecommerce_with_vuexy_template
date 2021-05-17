@extends('layouts.app')

@section('title')
   Kabmart Create New Seller Company
@endsection

@section('styles')
    <style>
        footer {
            background-color: #f6f6f6;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <section id="logo_wala" class="m-b-0">
            <!--logo-->
            <div class="row">
                <div class="col-md-4">
                    <div class="signup_logo">
                        <a href="/"><img src="{!! get_site_logo() !!}" alt="Kabmart"
                                         class="img-responsive" style="max-height:75px;"></a>
                    </div>
                </div>
            </div>
            <!--logo-->
        </section>

        <section id="seller_registration">

            <div class="row m-b-40">
                <div class="col-md-12">
                    <h4 class="seller_title pull-left black">Create New Seller Company <a
                                href="{{ route('user.dashboard') }}"
                                class="p-l-20 f-s-14"><i
                                    class="fa fa-angle-left"></i> Back</a></h4>
                </div>
            </div>
            <div class="row">
                {!! Form::open(['files' => true, 'id' => 'create-seller-form']) !!}
                <div class="col-md-12">
                    <!--seller box-->
                    <div class="seller_box">
                        <p class="m-b-33 slight_black" style="font-size:17px;">Seller Contact Information <span
                                    class="f-s-14" style="color:dimgray;">(This information will be seen by buyers on the website)</span>
                        </p>
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label class="col-md-3 control-label"><span class="red">*</span> Position in the
                                    company</label>
                                <div class="col-md-9">
                                    {!! Form::text('seller[position]', null, ['class' => "form-control required".get_css_class($errors, 'seller.position'), 'placeholder' => "Enter position in the company",
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
                    <div class="seller_box">
                        <p class="m-b-33 slight_black" style="font-size:17px;">Company Information <span
                                    class="f-s-14" style="color:dimgray;">(This information will be seen by buyers on the website)</span>
                        </p>
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label class="col-md-3 control-label"><span class="red">*</span> Company
                                    Name</label>
                                <div class="col-md-9">
                                    {!! Form::text('company[name]', null, ['class' => "form-control required".get_css_class($errors, 'company.name'), 'placeholder' => "Enter Company Name"]) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"><span class="red">*</span> Year
                                    Established</label>
                                <div class="col-md-9">
                                    {!! Form::number('company[established_year]', null, ['class' => "form-control year_estd ignore required".get_css_class($errors, 'company.established_year'), 'placeholder' => "Enter year established", 'required', 'minlength' => "4", 'maxlength' => "4"]) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label"><span class="red">*</span> Business
                                    Type</label>
                                <div class="col-md-9 required">
                                    @foreach(get_business_type() as $type)
                                        <label class="fancy-checkbox {{ $loop->index == 0 ? 'm-t-7' : '' }}">
                                            <input type="checkbox" class="business-type" name="company[business_type][]"
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
                                    {!! Form::text('company[products]', null, ['class' => "form-control required".get_css_class($errors, 'company.products'), 'placeholder' => "Enter main products, separated with comma"]) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"><span class="red">*</span> Main
                                    Operational Address</label>
                                <div class="col-md-9">
                                    {!! Form::text('company[operational_address]', null, ['class' => "form-control required".get_css_class($errors, 'company.operational_address'), 'placeholder' => "Enter Main Operational Address"]) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"><span class="red">*</span>Country</label>
                                <div class="col-md-9">
                                    <select id="countryId" name="company[country_id]"
                                            class="form-control selecto countries required {{ get_css_class($errors, 'company.country') }}">
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
                                            class="form-control selecto states  {{ get_css_class($errors, 'company.province') }} required"
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
                                            class="form-control selecto cities  {{ get_css_class($errors, 'company.city') }} required"
                                            id="cityId">
                                        <option value="">Select City</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"><span class="red"></span>Website
                                    Address</label>
                                <div class="col-md-9">
                                    {!! Form::url('company[website]', null, ['class' => "form-control". get_css_class($errors, 'company.website') , 'placeholder' => "Enter website address ex. http://www.yourcompanyname.com", 'title' => "Enter website address ex. http://www.yourcompanyname.com"]) !!}
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
                                                   class="input-file required" required
                                                   title="Please upload government permit">
                                            <label for="file" class="btn btn-tertiary js-labelFile">
                                                <span class="js-fileName ">Upload Attachment</span>
                                            </label>
                                            <span class="p-l-18 p-t-9"> Max 25 Mb</span>
                                        </div>
                                        <div id="file-error-message">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                            <div class="form-group">
                                <label class="col-md-3 control-label"><span class="red"></span></label>
                                <div class="col-md-9">
                                    <label class="fancy-checkbox m-t-15">
                                        {!! Form::checkbox('user_agreement', true, null, ['required','title' => 'Please agree on user agreement']) !!}
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
                    <!--seller box-->

                </div>
                {!! Form::close() !!}
            </div>

        </section>
    </div>
@endsection

@section('scripts')
    <script src="/assets/js/seller.js"></script>
    <script src="/assets/js/location.js"></script>
    <script src="/assets/validation/jquery.validate.min.js"></script>
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

        $(".required").prop('required', true);
        $.validator.addMethod("business-type", validateBusinessType, "Please check at least one Business type");

        function validateBusinessType() {
            var counter = 0;
            $('.business-type').each(function (index, item) {
                if ($(item).prop('checked'))
                    counter++;
            });

            return counter !== 0;
        }

        $('#create-seller-form').validate({
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
                    default:
                        break;
                }

            }
        });


    </script>
@endsection
