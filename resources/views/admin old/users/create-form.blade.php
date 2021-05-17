{!! BootForm::openHorizontal(['md' => [4, 8]])->action(route('admin.users.store'))->multipart() !!}
<div class="row">
    <div class="col-md-8">
        {!! BootForm::text('First Name*', 'user[first_name]') !!}
        {!! BootForm::text('Last Name', 'user[last_name]') !!}
        {!! BootForm::email('Email*', 'user[email]') !!}
        {!! BootForm::text('Phone No*', 'user[phone_number]') !!}
        {!! BootForm::password('Password', 'user[password]') !!}
        {!! BootForm::password('Confirm Password', 'user[password_confirmation]') !!}
        {!! BootForm::checkbox('Verified', 'user[verified]') !!}
        {!! BootForm::select('Role', 'user[role]')->options(array_combine(config('auth.roles'), config('auth.roles')))->onchange("roleChangeListener(this)") !!}
    </div>
</div>

<div class="panel panel-default"
     id="seller-div" {!! old('user.role') == 'associate-seller' ||  old('user.role') == 'main-seller' ?: 'style="display:none"' !!}>
    <div class="panel-heading">Seller Info</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-8">
                {!! BootForm::text('Position','seller[position]') !!}

                @include('partials.numbers-input')

                {!! BootForm::text('Skype Id','seller[skype]') !!}


                {!! BootForm::text('Viber ID','seller[viber]') !!}



                {!! BootForm::text('Whatsapp ID','seller[whatsapp]') !!}


                {!! BootForm::text('WeChat ID','seller[wechat]') !!}
            </div>
        </div>
    </div>
</div>

<div class="panel panel-default" id="company-div" {!! old('user.role') == 'main-seller' ?: 'style="display:none"' !!}>
    <div class="panel-heading">Company Info</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-8">
                {!! BootForm::text('Name','company[name]') !!}

                {!! BootForm::text('Year Established','company[established_year]') !!}
                <div class="form-group">
                    <label class="col-md-4 control-label"><span class="red">*</span>Business Type</label>
                    <div class="col-md-8">
                        @foreach(get_business_type() as $type)
                            <div>
                                <label class="fancy-checkbox {{ $loop->index == 0 ? 'm-t-7' : '' }}">
                                    <input type="checkbox" name="company[business_type][]" value="{{ $type }}">
                                    <span>{{ $type }}</span>
                                </label>
                            </div>
                        @endforeach
                        {!! $errors->first('company.business_type', '<div class="text-danger">:message</div>') !!}
                    </div>
                </div>

                {!! BootForm::text('Main Products','company[products]')->placeholder("Enter main products, separated with comma") !!}

                {!! BootForm::text('Main Operational Address', 'company[operational_address]') !!}
                <div class="form-group">
                    <label class="col-md-4 control-label"><span class="red">*</span>Country</label>
                    <div class="col-md-8">
                        <select id="countryId" name="company[country_id]"
                                class="form-control selecto countries required {{ get_css_class($errors, 'company.country') }}">
                            <option value="">Select Country</option>
                        </select>
                        {!! $errors->first('company.country_id', '<div class="text-danger">:message</div>') !!}
                    </div>

                </div>


                <div class="form-group">
                    <label class="col-md-4 control-label"><span class="red">*</span>Province</label>
                    <div class="col-md-8">
                        <select name="company[province]"
                                class="form-control selecto states  {{ get_css_class($errors, 'company.province') }} required"
                                id="stateId">
                            <option value="">Select Province</option>
                        </select>
                        {!! $errors->first('company.province', '<div class="text-danger">:message</div>') !!}

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label"><span class="red">*</span>City</label>
                    <div class="col-md-8">
                        <select name="company[city]"
                                class="form-control selecto cities  {{ get_css_class($errors, 'company.city') }} required"
                                id="cityId">
                            <option value="">Select City</option>
                        </select>
                        {!! $errors->first('company.city', '<div class="text-danger">:message</div>') !!}

                    </div>
                </div>

                {!! BootForm::text('Website','company[website]') !!}

                <div class="form-group">
                    <label class="col-md-4 control-label"><span class="red">*</span>Government
                        Business Permit</label>
                    <div class="col-md-8">
                        <div id="pum_uploadinput">
                            <div class="form-group">
                                <input type="file" name="government_business_permit" id="file"
                                       class="input-file">
                                <label for="file" class="btn btn-tertiary js-labelFile">
                                    <span class="js-fileName has_input_error">Upload Attachment</span>
                                </label>
                                <span class="p-l-18 p-t-9"> Max 25 Mb</span>
                                {!! $errors->first('government_business_permit', '<div class="text-danger">:message</div>') !!}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="panel panel-default"
     id="company-selector-div" {!! old('user.role') == 'associate-seller' ?: 'style="display:none"' !!}>
    <div class="panel-heading">Company Selector</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-8">
                {!! BootForm::select('Company', 'seller[company_id]')->options(get_companies()) !!}
            </div>
        </div>
    </div>
</div>

<div class="row">
    {!! BootForm::submit('create' , null)->class("btn btn-primary pull-right")->style('margin-right:5%') !!}
</div>

{!! BootForm::close() !!}
