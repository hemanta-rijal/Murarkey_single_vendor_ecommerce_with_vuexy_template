{!! Form::model($model, ['method' => 'PUT', 'files' => true, 'route' => ['admin.companies.update', $model->id]]) !!}


<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => "form-control required", 'placeholder' => "Enter Company Name", 'required']) !!}
    {!! $errors->first('key', '<div class="text-danger">:message</div>') !!}
</div>


<div class="form-group">
    {!! Form::label('established_year', 'Established Year:') !!}
    {!! Form::text('established_year', null, ['class' => "form-control required", 'placeholder' => "Enter year established", 'required']) !!}
    {!! $errors->first('established_year', '<div class="text-danger">:message</div>') !!}
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
    {!! Form::label('products', 'Main Products:') !!}
    {!! Form::text('products', null, ['class' => "form-control required", 'placeholder' => "Enter main products, separated with comma", 'required']) !!}
    {!! $errors->first('products', '<div class="text-danger">:message</div>') !!}
</div>

<div class="form-group">
    {!! Form::label('operational_address', 'Operational Address:') !!}
    {!! Form::text('operational_address', null, ['class' => "form-control required", 'placeholder' => "Enter Main Operational Address" , 'required']) !!}
    {!! $errors->first('operational_address', '<div class="text-danger">:message</div>') !!}
</div>


<div class="form-group">
    {!! Form::label('country_id', 'Country:') !!}
    {!! Form::select('country_id', ['' => 'Select Country'], null, ['id' => 'countryId', 'class'=> 'form-control countries selecto']) !!}
    {!! Form::hidden('hidden_country_id', $model->country_id) !!}
    {!! $errors->first('country_id', '<div class="text-danger">:message</div>') !!}
</div>

<div class="form-group">
    {!! Form::label('province', 'Province:') !!}
    {!! Form::select('province', [$model->province => $company->province_obj->name], null, ['id' => 'stateId', 'class'=> 'form-control selecto states']) !!}
    {!! Form::hidden('hidden_state_id', $company->province) !!}
    {!! $errors->first('province', '<div class="text-danger">:message</div>') !!}
</div>

<div class="form-group">
    {!! Form::label('city', 'City:') !!}
    {!! Form::select('city', [$model->city => $company->city_obj->name], null, ['id' => 'cityId', 'class'=> 'form-control cities selecto']) !!}
    {!! $errors->first('city', '<div class="text-danger">:message</div>') !!}
</div>

<div class="form-group">
    {!! Form::label('website', 'Web Site:') !!}
    {!! Form::url('website', null, ['class' => "form-control", 'placeholder' => "Enter website address ex. http://www.yourcompanyname.com"]) !!}
    {!! $errors->first('website', '<div class="text-danger">:message</div>') !!}
</div>

<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::select('status', get_general_status() ,null, ['class' => "form-control"]) !!}
    {!! $errors->first('status', '<div class="text-danger">:message</div>') !!}
</div>

<div class="form-group">
    {!! Form::label('government_business_permit', 'Government Business Permit:') !!}
    {!! Form::file('company[government_business_permit]') !!}
    {!! $errors->first('company.government_business_permit', '<div class="text-danger">:message</div>') !!}
    <a href="{{ map_storage_path_to_link($model->government_business_permit) }}" target="_blank">View File</a>
</div>

<div class="form-group">
    {!! Form::label('company.logo', 'Company Logo:') !!}
    {!! Form::file('company[logo]') !!}
    {!! $errors->first('company.logo', '<div class="text-danger">:message</div>') !!}
    <a href="{{ map_storage_path_to_link($model->logo) }}" target="_blank"><img
                src="{{ map_storage_path_to_link($model->logo) }}" height="50"> </a>
</div>

<div class="form-group">
    {!! Form::label('cover_photo', 'Cover Photo:') !!}
    {!! Form::file("images[{$model->cover_photo->id}]") !!}
    {!! $errors->first("images.{$model->cover_photo->id}", '<div class="text-danger">:message</div>') !!}
    @if($model->cover_photo->image)
        <a href="{{ map_storage_path_to_link($model->cover_photo->image) }}" target="_blank"><img
                    src="{{ resize_image_url($model->cover_photo->image, '50X50') }}" height="50"> </a>
    @else
        No Image
    @endif
</div>

@foreach($model->company_photos as $photo)
    <div class="form-group">
        {!! Form::label('cover_photo', "Company Photo ".($loop->index + 1) .":") !!}
        {!! Form::file("images[{$photo->id}]") !!}
        {!! $errors->first("images.{$photo->id}", '<div class="text-danger">:message</div>') !!}
        @if($photo->image)
            <a href="{{ map_storage_path_to_link($photo->image) }}" target="_blank"><img
                        src="{{ resize_image_url($photo->image, '50X50') }}" height="50"> </a>
        @else
            No Image
        @endif
    </div>
@endforeach


<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
    {!! $errors->first('description', '<div class="text-danger">:message</div>') !!}
</div>


<div class="form-group">
    {!! Form::submit(isset($model) ? 'Update' : 'Save', ['class' => 'btn btn-primary']) !!}
</div>
{!! Form::close() !!}
