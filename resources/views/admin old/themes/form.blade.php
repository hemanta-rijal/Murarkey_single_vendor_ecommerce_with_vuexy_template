@if(isset($model))
    {!! Form::model($model, ['method' => 'PUT', 'files' => true, 'route' => ['admin.theme.update', $model->id]]) !!}
@else
    {!! Form::open(['files' => true, 'route' => 'admin.theme.store']) !!}
@endif

<div class="form-group">
    {!! Form::label('key', 'Key:') !!}
    {!! Form::text('key', null, ['class' => 'form-control']) !!}
    {!! $errors->first('key', '<div class="text-danger">:message</div>') !!}
</div>


<div class="form-group">
    {!! Form::label('value', 'Value:') !!}
    {!! Form::text('value', null, ['class' => 'form-control']) !!}
    {!! $errors->first('value', '<div class="text-danger">:message</div>') !!}
</div>

<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
    {!! $errors->first('description', '<div class="text-danger">:message</div>') !!}
</div>


<div class="form-group">
    {!! Form::submit(isset($model) ? 'Update' : 'Save', ['class' => 'btn btn-primary']) !!}
</div>
{!! Form::close() !!}
