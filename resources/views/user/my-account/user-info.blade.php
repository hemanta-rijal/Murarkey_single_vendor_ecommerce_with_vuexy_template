@extends('user.my-account.layout')

@section('sub-sub-content')
    <div class="form-horizontal">
        <div class="form-group">
            <label class="col-md-3 control-label f-w-400"><span
                        class="red">*</span> Email</label>
            <div class="col-md-9">
                <p class="black m-0 p-t-7">{{ $user->email }}</p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label f-w-400"><span
                        class="red">*</span> First Name</label>
            <div class="col-md-9">
                <p class="black m-0 p-t-7">{{ $user->first_name }}</p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label f-w-400"><span
                        class="red">*</span> Last Name</label>
            <div class="col-md-9">
                <p class="black m-0 p-t-7">{{ $user->last_name }}</p>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 control-label f-w-400"><span
                        class="red">*</span> Phone Number</label>
            <div class="col-md-9">
                <p class="black m-0 p-t-7">{{ $user->phone_number }}</p>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 control-label f-w-400"><span
                        class="red">*</span> Password</label>
            <div class="col-md-9">
                <p class="black m-0 p-t-7">XXXXXXXXXX <span class="m-l-30"><a
                                href="/user/my-account/change-password">Change Password</a></span></p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label f-w-400"><span
                        class="red"></span></label>
            <div class="col-md-8">
                <a href="/user/my-account/user-info/edit" class="btn cs_btn pull-right black"
                   style="padding:3px 15px;">Edit</a>
            </div>
        </div>
    </div>
@endsection
