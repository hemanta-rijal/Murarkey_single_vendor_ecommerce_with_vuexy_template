@extends('admin.layouts.app')

@section('content')
    <div>
        {!! BootForm::open()->action('/admin/profile')->put() !!}
        {!! BootForm::bind(auth('admin')->user()) !!}
        <div class="row">
            <div class="col-lg-9">
                {!! BootForm::text('Name', 'name') !!}
                {!! BootForm::text('Email', 'email')->readonly() !!}

                <div class="form-group">
                    {!! Form::label('password', 'Password:') !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                    {!! $errors->first('password', '<div class="text-danger">:message</div>') !!}
                </div>
                <div class="form-group">
                    {!! Form::label('password_confirmation', 'Repeat Password:') !!}
                    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                    {!! $errors->first('password_confirmation', '<div class="text-danger">:message</div>') !!}
                </div>
            </div>
        </div>
        <div class="form-group">
            {!! Form::submit(isset($model) ? 'Update' : 'Save', ['class' => 'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>

@stop

