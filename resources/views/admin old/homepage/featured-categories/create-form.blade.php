{!! Form::open(['files' => true, 'route' => 'admin.featured-categories.store']) !!}

<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
    {!! $errors->first('name', '<div class="text-danger">:message</div>') !!}
</div>


<div class="form-group">
    {!! Form::label('weight', 'Weight:') !!}
    {!! Form::text('weight', null, ['class' => 'form-control']) !!}
    {!! $errors->first('weight', '<div class="text-danger">:message</div>') !!}
</div>

<div>
    {!! Form::label('category_id', 'Category:') !!}
    {!! Form::select('category_id', get_root_categories()->pluck('name','id') ,null, ['class' => 'form-control']) !!}
    {!! $errors->first('category_id', '<div class="text-danger">:message</div>') !!}
</div>

<div class="form-group">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
</div>
