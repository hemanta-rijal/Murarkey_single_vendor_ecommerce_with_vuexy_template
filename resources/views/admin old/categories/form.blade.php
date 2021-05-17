@if(isset($model))
    {!! Form::model($model, ['method' => 'PUT', 'files' => true, 'route' => ['admin.categories.update', $model->id]]) !!}
@else
    {!! Form::open(['files' => true, 'route' => 'admin.categories.store']) !!}
@endif

<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'onkeyup' => 'setSlug(this.value)']) !!}
    {!! $errors->first('name', '<div class="text-danger">:message</div>') !!}
</div>

<div class="form-group">
    {!! Form::label('slug', 'Slug:') !!}
    {!! Form::text('slug', null, ['class' => 'form-control', 'required']) !!}
    {!! $errors->first('slug', '<div class="text-danger">:message</div>') !!}
</div>

<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control', 'required']) !!}
    {!! $errors->first('description', '<div class="text-danger">:message</div>') !!}
</div>


<div class="form-group">
    {!! Form::label('size_chart', 'Size Chart:') !!}
    {!! Form::textarea('size_chart', null, ['class' => 'form-control', 'required']) !!}
    {!! $errors->first('size_chart', '<div class="text-danger">:message</div>') !!}
</div>


@if(isset($model))
    <div class="form-group">
        <img src="{!! map_storage_path_to_link($model->icon_path) !!}" width="100" height="100">
    </div>
@endif

<div class="form-group">
    {!! Form::label('icon_path', 'Icon:') !!}
    {!! Form::file('icon_path', null, ['class' => 'form-control']) !!}
    {!! $errors->first('icon_path', '<div class="text-danger">:message</div>') !!}
</div>



@if(isset($model))
    <div class="form-group">
        <img src="{!! map_storage_path_to_link($model->image_path) !!}" width="100" height="100">
    </div>
@endif

<div class="form-group">
    {!! Form::label('image_path', 'Image:') !!}
    {!! Form::file('image_path', null, ['class' => 'form-control']) !!}
    {!! $errors->first('image_path', '<div class="text-danger">:message</div>') !!}
</div>



@if(!isset($model))
    <div class="form-group">

        {!! Form::label('parent_id', 'Parent:') !!}
        {!! Form::select("parent_id", get_categories_for_form(), null, ['class' => "form-control"]) !!}
        {!! $errors->first('parent_id', '<div class="text-danger">:message</div>') !!}

    </div>
@endif

<div class="form-group">
    {!! Form::submit(isset($model) ? 'Update' : 'Save', ['class' => 'btn btn-primary']) !!}
</div>
{!! Form::close() !!}


@section('scripts')
    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
    <script>
        function slugify(text) {
            return text.toString().toLowerCase()
                .replace(/\s+/g, '-') // Replace spaces with -
                .replace(/[^\w\-]+/g, '') // Remove all non-word chars
                .replace(/\-\-+/g, '-') // Replace multiple - with single -
                .replace(/^-+/, '') // Trim - from start of text
                .replace(/-+$/, ''); // Trim - from end of text
        }

        function setSlug(value) {
            $('#slug').val(slugify(value));
        }


        CKEDITOR.replace('size_chart');

    </script>
@endsection
