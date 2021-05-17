@if(isset($model))
    {!! Form::model($model, ['method' => 'PUT', 'files' => true, 'route' => ['admin.banners.update', $model->id]]) !!}
@else
    {!! Form::open(['files' => true, 'route' => 'admin.banners.store']) !!}
@endif

<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
    {!! $errors->first('name', '<div class="text-danger">:message</div>') !!}
</div>

<div class="form-group">
    {!! Form::label('slug', 'Type:') !!}
    {!! Form::select('slug', array_combine(get_banner_type(), get_banner_type()), null, ['class' => 'form-control']) !!}
    {!! $errors->first('slug', '<div class="text-danger">:message</div>') !!}
</div>


<div class="form-group">
    {!! Form::label('weight', 'Weight:') !!}
    {!! Form::text('weight', null, ['class' => 'form-control']) !!}
    {!! $errors->first('weight', '<div class="text-danger">:message</div>') !!}
</div>


<div class="form-group">
    {!! Form::label('link', 'Link:') !!}
    {!! Form::text('link', null, ['class' => 'form-control']) !!}
    {!! $errors->first('link', '<div class="text-danger">:message</div>') !!}
</div>

@if(isset($model))
    <div class="form-group">

        <img src="{!! map_storage_path_to_link($model->image) !!}" width="100" height="100">
    </div>
@endif

<div class="form-group">
    {!! Form::label('image', 'Image:') !!}
    {!! Form::file('image', null, ['class' => 'form-control']) !!}
    {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
</div>

<div class="form-group">
    {!! Form::submit(isset($model) ? 'Update' : 'Save', ['class' => 'btn btn-primary']) !!}
</div>
{!! Form::close() !!}
