@extends('user.my-account.layout')

@section('sub-sub-content')
    <h3 class="col_title p-t-0">User Account Settings</h3>
    <p class="black">Do you wish to close your User Account for this website?</p>
    {{ Form::open(['url' => '/user/my-account/close-user-account', 'method' => 'delete']) }}
    @if($errors->has('user_reason'))
        <p class="warning_box plz_fill" style="max-width:inherit;">
            ! Please provide reason for closing you account.
        </p>
    @endif
    <textarea name="user_reason" class="form-control" placeholder="Please provide your reason for closing your account"
              rows="10"
              style="">{{ old('user_reason') }}</textarea>

    <div class=" pull-right">
        <div class="text-right">
            <button type="button" class="btn btn-default no_border pcolor_bg m-t-12 clickme"
                    style="background: rgb(85, 96, 114); color: rgb(255, 255, 255);">
                Close Account
            </button>
            <div class="sure_box text-center m-t-12"
                 style="background: rgb(255, 255, 255); max-width: 167px; border: 1px solid rgb(227, 227, 227); margin: 0px; box-shadow: rgb(221, 221, 221) 3px 3px 20px -3px; display: block;">
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
@endsection

