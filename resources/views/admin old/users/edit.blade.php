@extends('admin.layouts.app')

@section('styles')
    <style>
        #seller-div form label.control-label {
            padding-left: 18px
        }

        }
        #seller-div form .form-control {
            padding: 20px 12px;
            border-radius: 2px;
            max-width: 530px
        }

        #seller-div span.glyphicon {
            color: #4b525c
        }

        #seller-div .phone-list input.wid_plus {
            max-width: 351px
        }

        #seller-div .phone-list .height_41 {
            height: 41px
        }

        #seller-div .phone-list button.btn-add-phone {
            height: 41px;
            width: 41px;
            margin-left: 12px
        }

        #seller-div .phone-list button.btn-remove-phone {
            border-radius: 2px;
            background: #fde4dd;
            border-color: #ccc;
            height: 41px;
            width: 41px;
            margin-left: 12px
        }

        #seller-div .phone-input {
            margin-bottom: 15px;
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: start;
            -webkit-justify-content: flex-start;
            -ms-flex-pack: start;
            justify-content: flex-start
        }

        #seller-div .phone-input .my_select {
            /*height: 41px;*/
            padding: initial;
            padding-left: 12px;
            max-width: 180px
        }

        #seller-div .landline-list input.wid_plus {
            max-width: 351px
        }

        #seller-div .landline-list .height_41 {
            height: 41px
        }

        #seller-div .landline-list button.btn-add-landline {
            height: 41px;
            width: 41px;
            margin-left: 12px
        }

        #seller-div .landline-list button.btn-remove-landline {
            border-radius: 2px;
            background: #fde4dd;
            border-color: #ccc;
            height: 41px;
            width: 41px;
            margin-left: 12px
        }

        #seller-div .landline-input {
            margin-bottom: 15px;
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: start;
            -webkit-justify-content: flex-start;
            -ms-flex-pack: start;
            justify-content: flex-start
        }

        #seller-div .landline-input .my_select {
            /*height: 41px;*/
            padding: initial;
            padding-left: 12px;
            max-width: 180px
        }

        #seller-div .fax-list input.wid_plus {
            max-width: 351px
        }

        #seller-div .fax-list .height_41 {
            height: 41px
        }

        #seller-div .fax-list button.btn-add-fax {
            height: 41px;
            width: 41px;
            margin-left: 12px
        }

        #seller-div .fax-list button.btn-remove-fax {
            border-radius: 2px;
            background: #fde4dd;
            border-color: #ccc;
            height: 41px;
            width: 41px;
            margin-left: 12px
        }

        #seller-div .fax-input {
            margin-bottom: 15px;
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: start;
            -webkit-justify-content: flex-start;
            -ms-flex-pack: start;
            justify-content: flex-start
        }

        #seller-div .fax-input .my_select {
            /*height: 41px;*/
            padding: initial;
            padding-left: 12px;
            max-width: 180px
        }

        #seller-div .btn-add-landline, #seller-div .btn-add-phone, #seller-div .btn-add-fax {
            background: #add2ff;
            border-color: #ccc
        }

        .seller_box {
            margin-bottom: 40px
        }

        .create_reseller {
            width: 100%;
            max-width: 533px
        }

    </style>
@endsection

@section('content')
    <!-- Top bar starts -->
    <div class="top-bar clearfix">
        <div class="row gutter">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="page-title">
                    <h4>Edit User</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-primary">
        <div class="panel panel-default">
            <div class="panel-body">
                @include('admin.users.edit-form', array('data' => $data))
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/assets/js/seller.js"></script>
@endsection
