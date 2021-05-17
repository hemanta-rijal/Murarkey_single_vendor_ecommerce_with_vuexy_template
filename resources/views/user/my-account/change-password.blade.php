@extends('user.my-account.layout')

@section('sub-sub-content')
    <h3 class="col_title p-t-0">User Account Information</h3>
    {!! Form::open(['url' => '/user/my-account/change-password', 'method' => 'PUT']) !!}
    <div class="form-horizontal">

        <div class="form-group">
            <label class="col-md-3 control-label f-w-400"></label>
            <div class="col-md-5">
                @include('partials.error-message')
            </div>
        </div>

        <div class="form-group m-b-0">
            <label class="col-md-3 control-label f-w-400"><span class="red"></span><b class="black">change password</b></label>

        </div>
        <div class="form-group">
            <label class="col-md-3 control-label f-w-400"><span class="red">*</span>Current Password</label>
            <div class="col-md-5">
                <input name="current_password" type="password" class="form-control" placeholder="" required="">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label f-w-400"><span class="red">*</span> Password</label>
            <div class="col-md-5">
                <input name="password" type="password" class="form-control" placeholder="" required="">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label f-w-400"><span class="red">*</span> Confirm Password</label>
            <div class="col-md-5">
                <input name="password_confirmation" type="password" class="form-control" placeholder="" required="">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label f-w-400"><span class="red"></span> </label>
            <div class="col-md-5">
                <div class="flex_end">
                    <button class="btn btn-info no_border" style="background:#556678;">Cancel</button>
                    <button class="btn btn-info m-l-13 no_border" style="background:#1f73f0">Save</button>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection