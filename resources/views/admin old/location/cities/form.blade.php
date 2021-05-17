@if(isset($model))
    {!! Form::model($model, ['method' => 'PUT', 'files' => true, 'route' => ['admin.location.cities.update', $model->id]]) !!}
@else
    {!! Form::open(['files' => true, 'route' => 'admin.location.cities.store']) !!}
@endif



<div class="form-group row">
    {!! Form::label('Name', 'Name:', ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-9">
        {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
    </div>
    {!! $errors->first('name', '<div class="text-danger">:message</div>') !!}
</div>

<div class="form-group row">
    {!! Form::label('cod', 'COD available:', ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-9">
        {!! Form::checkbox('cod_available', 1) !!}
    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 control-label"><span class="red">*</span>Country</label>
    <div class="col-md-9">
        {!! Form::select('country_id', ['' => 'Select Country'], null, ['id' => 'countryId', 'class'=> 'form-control countries selecto']) !!}

        @if(isset($model))
            {!! Form::hidden('hidden_country_id', $model->state->country_id) !!}
        @endif
    </div>
</div>

@if(isset($model))
    {!! Form::hidden('hidden_state_id', $model->state->id) !!}
@endif

<div class="form-group row">
    <label class="col-md-3 control-label"><span class="red">*</span>Province</label>
    <div class="col-md-9">
        {!! Form::select('state_id', isset($model) ? [$model->state_id => $model->state->name] : [], null, ['id' => 'stateId', 'class'=> 'form-control selecto states', 'required']) !!}
    </div>
</div>



<div class="form-group">
    {!! Form::submit(isset($model) ? 'Update' : 'Save', ['class' => 'btn btn-primary']) !!}
</div>
{!! Form::close() !!}


@section('sub-scripts')
    <script src="/assets/js/location.js"></script>
@endsection
