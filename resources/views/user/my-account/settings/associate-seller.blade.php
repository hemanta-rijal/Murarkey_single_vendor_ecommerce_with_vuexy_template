@extends('user.my-account.layout')

@section('sub-sub-content')

    <h3 class="col_title p-t-0">Associate User Account Settings</h3>
    <p class="black">Do you wish to close your Associate User Account?</p>
    {{ Form::open(['url' => '/user/my-account/close-seller-account', 'method' => 'delete']) }}
        @if($errors->has('seller_reason'))
            <p class="warning_box plz_fill" style="max-width:inherit;">
                ! Please provide reason for closing Associate User Account.
            </p>
        @endif
        <textarea name="seller_reason" class="form-control"
                  placeholder="Please provide your reason for closing your account"
                  rows="10" style="">{{ old('seller_reason') }}</textarea>
    <div class=" pull-right">
        <div class="text-right">
            <button type="button" class="btn btn-default no_border pcolor_bg m-t-12 clickme"
                    style="background: rgb(85, 96, 114); color: rgb(255, 255, 255);">
                Close Account
            </button>
            <div class="sure_box text-center m-t-12"
                 style="background: rgb(255, 255, 255);max-width: 167px;border: 1px solid #e3e3e3;margin: 0;box-shadow: 3px 3px 20px -3px #dddddd;">
                <p class="black text-center f-s-16">Are You Sure?</p>
                You will not be able to undo this action.
                <div class="text-center">
                    <a href="javascript:void()" class="btn cs_btn m-t-10" onclick="submitClosetForm(this)">Yes</a>
                    <a href="/user" class="btn cs_btn m-t-10 m-r-0">No</a>
                </div>
                <i class="fa fa-sort-up" style="color: #e0e0e0;top:-11px;"></i>
            </div>
        </div>
    </div>
    {{ Form::close() }}
    <div class="clearfix"></div>
    <h3 class="col_title p-t-0 m-t-30">User Account Settings</h3>
    <p class="black">Do you wish to close your User Account for this website? this
        will include all accounts you have (including Company Account, Associate
        Seller)</p>
    {{ Form::open(['url' => '/user/my-account/close-user-account', 'method' => 'delete']) }}
        @if($errors->has('user_reason'))
            <p class="warning_box plz_fill" style="max-width:inherit;">
                ! Please provide reason for closing Seller Company account.
            </p>
        @endif
        <textarea name="user_reason" class="form-control"
                  placeholder="Please provide your reason for closing your account"
                  rows="10" style="">{{ old('user_reason') }}</textarea>

        <div class=" pull-right">
            <div class="text-right">
                <button type="button" class="btn btn-default no_border pcolor_bg m-t-12 clickme"
                        style="background: rgb(85, 96, 114); color: rgb(255, 255, 255);">
                    Close Account
                </button>
                <div class="sure_box text-center m-t-12"
                     style="background: rgb(255, 255, 255);max-width: 167px;border: 1px solid #e3e3e3;margin: 0;box-shadow: 3px 3px 20px -3px #dddddd;">
                    <p class="black text-center f-s-16">Are You Sure?</p>
                    You will not be able to undo this action.
                    <div class="text-center">
                        <a href="javascript:void()" class="btn cs_btn m-t-10" onclick="submitClosetForm(this)">Yes</a>
                        <a href="/user" class="btn cs_btn m-t-10 m-r-0">No</a>
                    </div>
                    <i class="fa fa-sort-up" style="color: #e0e0e0;top:-11px;"></i>
                </div>
            </div>
        </div>
        <div class="btn-group show-on-hover pull-right">
        </div>
    {{ Form::close() }}

@endsection
