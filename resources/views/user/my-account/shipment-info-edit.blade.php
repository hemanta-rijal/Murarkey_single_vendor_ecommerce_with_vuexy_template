@extends('user.my-account.layout')


@section('sub-sub-content')
    <h3 class="col_title p-t-0">Shipment Information</h3>
    <div class="form-horizontal">
        {!! Form::model($user->shipment_details,['url' => '/user/my-account/shipment-info', 'method' => 'PUT']) !!}
        <div class="form-group">
            <label class="col-md-3 control-label f-w-400"></label>
            <div class="col-md-5">
                @include('partials.error-message')
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label f-w-400"><span class="red">*</span>Name:</label>
            <div class="col-md-5">
                {!! Form::text('name',null,['class' => 'form-control', 'required']) !!}

            </div>
        </div>


        <div class="form-group">
            <label class="col-md-3 control-label f-w-400"><span class="red">*</span>Address:</label>
            <div class="col-md-5">
                {!! Form::text('address',null,['class' => 'form-control', 'required']) !!}
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label f-w-400"><span class="red">*</span>City:</label>
            <div class="col-md-5">
                {!! Form::select('city', get_cities_for_normal_select(), null,['class' => 'form-control', 'required']) !!}
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-3 control-label f-w-400"><span class="red">*</span>Phone Number:</label>
            <div class="col-md-5">
                {!! Form::text('phone_number',null,['class' => 'form-control', 'required']) !!}
            </div>
        </div>

        <div class="form-group m-t-60">
            <label class="col-md-3 control-label f-w-400"><span class="red"></span> </label>
            <div class="col-md-5">
                <div class="flex_end">
                    <a href="/user/my-account/shipment-info" class="btn btn-info no_border" style="background:#556678;">Cancel</a>
                    <button type="submit" class="btn btn-info m-l-13 no_border" style="background:#1f73f0">Save</button>
                </div>
            </div>
        </div>

        {!! Form::close() !!}


    </div>
@endsection