@extends('user.my-account.layout')


@section('sub-sub-content')
    <h3 class="col_title p-t-0">User Account Information</h3>
    <div class="form-horizontal">
        {!! Form::model($user,['url' => '/user/my-account/user-info', 'method' => 'PUT']) !!}
        <div class="form-group">
            <label class="col-md-3 control-label f-w-400"></label>
            <div class="col-md-5">
                @include('partials.error-message')
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label f-w-400"><span class="red">*</span>Email:</label>
            <div class="col-md-5">
                {!! Form::email('email',null,['class' => 'form-control', 'required']) !!}

            </div>
        </div>


        <div class="form-group">
            <label class="col-md-3 control-label f-w-400"><span class="red">*</span>First Name:</label>
            <div class="col-md-5">
                {!! Form::text('first_name',null,['class' => 'form-control', 'required']) !!}
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label f-w-400"><span class="red">*</span>Last Name:</label>
            <div class="col-md-5">
                {!! Form::text('last_name',null,['class' => 'form-control', 'required']) !!}
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 control-label f-w-400"><span class="red">*</span>Phone Number:</label>
            <div class="col-md-5">
                {!! Form::text('phone_number',null,['class' => 'form-control', 'required']) !!}
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 control-label f-w-400"><span class="red">*</span> Password</label>
            <div class="col-md-9">
                <p class="black m-0 p-t-7">XXXXXXXXXX <span class="m-l-30"><a
                                href="/user/my-account/change-password">Change Password</a></span></p>
            </div>
        </div>

        <div class="form-group m-t-60">
            <label class="col-md-3 control-label f-w-400"><span class="red"></span> </label>
            <div class="col-md-5">
                <div class="flex_end">
                    <a href="/user/my-account/user-info" class="btn btn-info no_border" style="background:#556678;">Cancel</a>
                    <button type="submit" class="btn btn-info m-l-13 no_border" style="background:#1f73f0">Save</button>
                </div>
            </div>
        </div>

        {!! Form::close() !!}


    </div>
@endsection