@extends('user.my-account.layout')

@section('sub-sub-content')
    <h3 class="col_title p-t-0">User Account Information</h3>
    <section id="seller_registration">
        {!! Form::model($company,['url' => '/user/my-account/company-info', 'method' => 'PUT']) !!}
        <div class="form-horizontal">
            <div class="form-group">
                <label class="col-md-3 control-label f-w-400"></label>
                <div class="col-md-9">
                    @include('partials.error-message')
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label"><span class="red">*</span> Company Name</label>
                <div class="col-md-9">
                    {!! Form::text('name', null, ['class' => "form-control required".get_css_class($errors, 'name'), 'placeholder' => "Enter Company Name", 'required']) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label"><span class="red">*</span> Year Established</label>
                <div class="col-md-9">
                    {!! Form::text('established_year', null, ['class' => "form-control required".get_css_class($errors, 'established_year'), 'placeholder' => "Enter year established", 'required']) !!}
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label"><span class="red">*</span> Business Type</label>
                <div class="col-md-9">
                    @foreach(get_business_type() as $type)
                        <label class="fancy-checkbox {{ $loop->index == 0 ? 'm-t-7' : '' }}">
                            {!! Form::checkbox('business_type[]', $type) !!}
                            <span>{{ $type }}</span>
                        </label>
                    @endforeach
                </div>

            </div>

            <div class="form-group">
                <label class="col-md-3 control-label"><span class="red"></span> Main Products</label>
                <div class="col-md-9">
                    {!! Form::text('products', null, ['class' => "form-control required".get_css_class($errors, 'products'), 'placeholder' => "Enter main products, separated with comma", 'required']) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label"><span class="red">*</span> Main Operational Address</label>
                <div class="col-md-9">
                    {!! Form::text('operational_address', null, ['class' => "form-control required".get_css_class($errors, 'operational_address'), 'placeholder' => "Enter Main Operational Address" , 'required']) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label"><span class="red">*</span>Country</label>
                <div class="col-md-9">
                    {!! Form::select('country_id', ['' => 'Select Country'], null, ['id' => 'countryId', 'class'=> 'form-control countries selecto']) !!}
                    {!! Form::hidden('hidden_country_id', $company->country_id) !!}
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label"><span class="red">*</span>Province</label>
                <div class="col-md-9">
                    {!! Form::select('province', [$company->province => $company->province_obj->name], null, ['id' => 'stateId', 'class'=> 'form-control selecto states']) !!}
                    {!! Form::hidden('hidden_state_id', $company->province) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label"><span class="red">*</span>City</label>
                <div class="col-md-9">
                    {!! Form::select('city', [$company->city => $company->city_obj->name], null, ['id' => 'cityId', 'class'=> 'form-control cities selecto']) !!}
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label"><span class="red"></span>Website Address</label>
                <div class="col-md-9">
                    {!! Form::url('website', null, ['class' => "form-control". get_css_class($errors, 'website') , 'placeholder' => "Enter website address ex. http://www.yourcompanyname.com"]) !!}
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label f-w-400"><span class="red"></span> </label>
                <div class="col-md-9">
                    <div class="flex_end p-r-103">
                        <a href="/user/my-account/company-info" class="btn btn-info no_border"
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
    <script src="/assets/js/location.js"></script>
@endsection