@if(isset($model))
    {!! Form::model($model, ['method' => 'PUT', 'files' => true, 'route' => ['admin.system-messages.update', $model->id]]) !!}
@else
    {!! Form::open(['files' => true, 'route' => 'admin.system-messages.store']) !!}
@endif

<div class="form-group">
    {!! Form::label('For Role', 'For Role:') !!}
    {!! Form::select('for_role', array_merge(array_combine(config('auth.roles'),config('auth.roles')), ['all' => 'All'] ) ,null, ['class' => 'form-control']) !!}
    {!! $errors->first('for_role', '<div class="text-danger">:message</div>') !!}
</div>


<div class="form-group">
    {!! Form::label('subject', 'Subject:') !!}
    {!! Form::text('subject', null, ['class' => 'form-control']) !!}
    {!! $errors->first('subject', '<div class="text-danger">:message</div>') !!}
</div>

<div class="form-group">
    {!! Form::label('text', 'Text:') !!}
    {!! Form::textarea('text', null, ['class' => 'form-control']) !!}
    {!! $errors->first('text', '<div class="text-danger">:message</div>') !!}
</div>


<div class="form-group">
    {!! Form::submit(isset($model) ? 'Update' : 'Save', ['class' => 'btn btn-primary']) !!}
</div>
{!! Form::close() !!}
