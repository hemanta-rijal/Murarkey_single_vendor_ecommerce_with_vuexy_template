@if(isset($model))
    {!! Form::model($model, ['method' => 'PUT', 'files' => true, 'route' => ['admin.location.states.update', $model->id]]) !!}
@else
    {!! Form::open(['files' => true, 'route' => 'admin.location.states.store']) !!}
@endif



<div class="form-group">
    {!! Form::label('Name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
    {!! $errors->first('name', '<div class="text-danger">:message</div>') !!}
</div>

<div class="form-group">
    <label class="col-md-3 control-label"><span class="red">*</span>Country</label>
    <div class="col-md-9">
        {!! Form::select('country_id', ['' => 'Select Country'], null, ['id' => 'countryId', 'class'=> 'form-control countries selecto']) !!}

        @if(isset($model))
            {!! Form::hidden('hidden_country_id', $model->country_id) !!}
        @endif
    </div>
</div>

<div class="form-group">
    {!! Form::submit(isset($model) ? 'Update' : 'Save', ['class' => 'btn btn-primary']) !!}
</div>
{!! Form::close() !!}


@section('sub-scripts')
    <script src="/assets/js/location.js"></script>
@endsection
