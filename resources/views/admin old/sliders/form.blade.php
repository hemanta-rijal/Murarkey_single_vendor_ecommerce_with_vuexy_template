@if(isset($model))
    {!! Form::model($model, ['method' => 'PUT', 'files' => true, 'route' => ['admin.sliders.update', $model->id]]) !!}
@else
    {!! Form::open(['files' => true, 'route' => 'admin.sliders.store']) !!}
@endif

<div class="form-group">
    {!! Form::label('caption', 'Caption:') !!}
    {!! Form::text('caption', null, ['class' => 'form-control']) !!}
    {!! $errors->first('caption', '<div class="text-danger">:message</div>') !!}
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
