@if(isset($model))
    {!! Form::model($model, ['method' => 'PUT', 'files' => true, 'route' => ['admin.location.area-code.update', $model->id]]) !!}
@else
    {!! Form::open(['files' => true, 'route' => 'admin.location.area-code.store']) !!}
@endif



<div class="form-group">
    {!! Form::label('area_code', 'Area Code:') !!}
    {!! Form::text('area_code', null, ['class' => 'form-control', 'required']) !!}
    {!! $errors->first('area_code', '<div class="text-danger">:message</div>') !!}
</div>

<div class="form-group">
    {!! Form::submit(isset($model) ? 'Update' : 'Save', ['class' => 'btn btn-primary']) !!}
</div>
{!! Form::close() !!}


@section('sub-scripts')
    <script src="/assets/js/location.js"></script>
@endsection
