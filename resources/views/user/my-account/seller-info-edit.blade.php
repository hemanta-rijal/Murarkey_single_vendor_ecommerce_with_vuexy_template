@extends('user.my-account.layout')

@section('sub-sub-content')
    <h3 class="col_title p-t-0">User Account Information</h3>
    <section id="seller_registration">
        {!! Form::model($seller,['url' => '/user/my-account/seller-info', 'method' => 'PUT', 'id' => 'seller-form']) !!}
        <div class="form-horizontal">
            <div class="form-group">
                <label class="col-md-3 control-label f-w-400"></label>
                <div class="col-md-5">
                    @include('partials.error-message')
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label p-l-0"><span class="red"></span> Position in the
                    company</label>
                <div class="col-md-9">
                    {!! Form::text('position', null, ['class' => "form-control required".get_css_class($errors, 'position'), 'placeholder' => "Enter position in the company", 'required'
                                       ]) !!}
                </div>
            </div>

            @include('partials.numbers-input', ['data' => ['seller' => $seller->toArray()]])
            <div class="form-group">
                <label class="col-md-3 control-label"><span class="red"></span>Skype ID</label>
                <div class="col-md-9">
                    {!! Form::text('skype', null, ['class' => "form-control"]) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label"><span class="red"></span>Viber ID</label>
                <div class="col-md-9">
                    {!! Form::text('viber', null, ['class' => "form-control".get_css_class($errors, 'viber')]) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label"><span class="red"></span>Whatsapp ID</label>
                <div class="col-md-9">
                    {!! Form::text('whatsapp', null, ['class' => "form-control".get_css_class($errors, 'whatsapp')]) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label"><span class="red"></span>WeChat ID</label>
                <div class="col-md-9">
                    {!! Form::text('wechat', null, ['class' => "form-control".get_css_class($errors, 'wechat')]) !!}
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label f-w-400"><span class="red"></span> </label>
                <div class="col-md-9">
                    <div class="flex_end p-r-103">
                        <a href="/user/my-account/seller-info" class="btn btn-info no_border"
                           style="background:#556678;">Cancel</a>
                        <button type="submit" class="btn btn-info m-l-13 no_border" style="background:#1f73f0">Save
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {!! Form::close() !!}
    </section>
@endsection

@section('sub-sub-scripts')
    <script src="/assets/js/seller.js"></script>
    <script src="/assets/validation/jquery.validate.min.js"></script>
    <script>
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

        $('#seller-form').validate({
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