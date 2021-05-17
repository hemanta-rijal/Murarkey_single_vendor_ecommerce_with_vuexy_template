{!! Form::open(['files' => true, 'route' => 'admin.featured-companies.store']) !!}

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
    {!! Form::label('company_id', 'Company:') !!}
    {!! Form::select('company_id', get_companies() ,null, ['class' => 'form-control']) !!}
    {!! $errors->first('company_id', '<div class="text-danger">:message</div>') !!}
</div>

<div class="form-group">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
</div>
