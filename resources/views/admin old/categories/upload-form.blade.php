@extends('admin.layouts.app')

@section('content-header')

    <h1>
        Upload
        &middot;
        <small>{!! link_to_route('admin.categories.index', 'Back') !!}</small>
    </h1>

@stop

@section('content')
    <div>

        {!! Form::open(['files' => true, 'route' => 'admin.categories.import']) !!}

        <div class="form-group">
            {!! Form::label('File', 'File:') !!}
            {!! Form::file('excel_file', null, ['class' => 'form-control']) !!}

            {!! $errors->first('excel_file', '<div class="text-danger">:message</div>') !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Upload', ['class' => 'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>
@stop

