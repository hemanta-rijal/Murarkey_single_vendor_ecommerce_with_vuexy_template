{!! Form::open(['files' => true, 'route' => 'admin.flash-sales.store']) !!}

<div class="form-group">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
    {!! $errors->first('title', '<div class="text-danger">:message</div>') !!}
</div>


<div class="form-group">
    {!! Form::label('weight', 'Weight:') !!}
    {!! Form::text('weight', null, ['class' => 'form-control']) !!}
    {!! $errors->first('weight', '<div class="text-danger">:message</div>') !!}
</div>

<div class="form-group">
    {!! Form::label('start_time', 'Start Time:') !!}
    {!! Form::text('start_time', null, ['class' => 'form-control', 'id' => 'datetimepicker6']) !!}
    {!! $errors->first('start_time', '<div class="text-danger">:message</div>') !!}
</div>


<div class="form-group">
    {!! Form::label('end_time', 'End Time:') !!}
    {!! Form::text('end_time', null, ['class' => 'form-control', 'id' => 'datetimepicker7']) !!}
    {!! $errors->first('end_time', '<div class="text-danger">:message</div>') !!}
</div>

<div class="form-group">
    {!! Form::label('published', 'Published:') !!}
    {!! Form::checkbox('published', true) !!}
    {!! $errors->first('published', '<div class="text-danger">:message</div>') !!}
</div>

<div class="form-group">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
</div>

{{ Form::close() }}
