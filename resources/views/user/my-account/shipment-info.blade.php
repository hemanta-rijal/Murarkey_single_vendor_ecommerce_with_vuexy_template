@extends('user.my-account.layout')

@section('sub-sub-content')
    <div class="form-horizontal">
        <div class="form-group">
            <label class="col-md-3 control-label f-w-400"><span
                        class="red">*</span> Name</label>
            <div class="col-md-9">
                <p class="black m-0 p-t-7">{{ $user->shipment_details ? $user->shipment_details->name : ''   }}</p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label f-w-400"><span
                        class="red">*</span> Address</label>
            <div class="col-md-9">
                <p class="black m-0 p-t-7">{{ $user->shipment_details ? $user->shipment_details->address : ''   }}</p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label f-w-400"><span
                        class="red">*</span> City</label>
            <div class="col-md-9">
                <p class="black m-0 p-t-7">{{ $user->shipment_details ? $user->shipment_details->city : ''   }}</p>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 control-label f-w-400"><span
                        class="red">*</span> Phone Number</label>
            <div class="col-md-9">
                <p class="black m-0 p-t-7">{{ $user->shipment_details ? $user->shipment_details->phone_number : ''   }}</p>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 control-label f-w-400"><span
                        class="red"></span></label>
            <div class="col-md-8">
                <a href="/user/my-account/shipment-info/edit" class="btn cs_btn pull-right black"
                   style="padding:3px 15px;">Edit</a>
            </div>
        </div>
    </div>
@endsection
