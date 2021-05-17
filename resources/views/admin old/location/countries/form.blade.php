@if(isset($model))
    {!! Form::model($model, ['method' => 'PUT', 'files' => true, 'route' => ['admin.location.countries.update', $model->id]]) !!}
@else
    {!! Form::open(['files' => true, 'route' => 'admin.location.countries.store']) !!}
@endif



<div class="form-group">
    {!! Form::label('Name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
    {!! $errors->first('name', '<div class="text-danger">:message</div>') !!}
</div>


<div class="form-group">
    {!! Form::label('Short Name', 'Short Name:') !!}
    {!! Form::text('sortname', null, ['class' => 'form-control', 'required']) !!}
    {!! $errors->first('sortname', '<div class="text-danger">:message</div>') !!}
</div>

<div class="form-group">
    {!! Form::label('Phone Code', 'Phone Code:') !!}
    {!! Form::text('phonecode', null, ['class' => 'form-control', 'required']) !!}
    {!! $errors->first('phonecode', '<div class="text-danger">:message</div>') !!}
</div>


<div class="form-group">
    {!! Form::submit(isset($model) ? 'Update' : 'Save', ['class' => 'btn btn-primary']) !!}
</div>
{!! Form::close() !!}


@section('sub-scripts')
    <script src="/assets/js/location.js"></script>
@endsection
