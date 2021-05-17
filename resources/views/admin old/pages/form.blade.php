@if(isset($model))
    {!! Form::model($model, ['method' => 'PUT', 'files' => true, 'route' => ['admin.pages.update', $model->id]]) !!}
@else
    {!! Form::open(['files' => true, 'route' => 'admin.pages.store']) !!}
@endif

<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'onkeyup' => 'setSlug(this.value)']) !!}
    {!! $errors->first('name', '<div class="text-danger">:message</div>') !!}
</div>


<div class="form-group">
    {!! Form::label('slug', 'Slug:') !!}
    {!! Form::text('slug', null, ['class' => 'form-control']) !!}
    {!! $errors->first('slug', '<div class="text-danger">:message</div>') !!}
</div>


<div class="form-group">
    {!! Form::label('template', 'Template:') !!}
    {!! Form::select("template", get_page_templates(), null, ['class' => "form-control"]) !!}
    {!! $errors->first('template', '<div class="text-danger">:message</div>') !!}
</div>

{{-- <div class="form-group">
    {!! Form::label('Laraberg', 'Laraberg:') !!}
    {!! Form::text("laraberg-editor", null, ['class' => "form-control", 'id'=>"laraberg-editor", 'hidden'] ) !!}
    {!! $errors->first('laraberg', '<div class="text-danger">:message</div>') !!}
</div> --}}

{!! Form::textarea('content', null, ['class' => 'form-control hidden']) !!}
{!! $errors->first('content', '<div class="text-danger">:message</div>') !!}

<div id="editor">

</div>


<div class="form-group">
    {!! Form::label('published', 'Published:') !!}
    {!! Form::checkbox('published', 1, 1) !!}
</div>

<div class="form-group">
    {!! Form::label('is_there_php', 'Is there PHP:') !!}
    {!! Form::checkbox('is_there_php', 1, 0) !!}
</div>


<div class="form-group">
    {!! Form::submit(isset($model) ? 'Update' : 'Save', ['class' => 'btn btn-primary']) !!}
</div>
{!! Form::close() !!}



@section('scripts')
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

    </script>

    <script src="/assets/ace-builds/src-min-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
    <script>
        var editor = ace.edit("editor");
        editor.setTheme("ace/theme/monokai");
        editor.getSession().setMode("ace/mode/php");

        var textarea = $('[name=content]');


        editor.getSession().setValue(textarea.val());
        editor.getSession().on('change', function(){
            textarea.val(editor.getSession().getValue());
        });

    </script>
    {{-- //for laraberg --}}
    <script src="https://unpkg.com/react@16.8.6/umd/react.production.min.js"></script>
    <script src="https://unpkg.com/react-dom@16.8.6/umd/react-dom.production.min.js"></script>
    <script src="{{ asset('vendor/laraberg/js/laraberg.js') }}"></script>
    <script>
        // Laraberg.init('laraberg-editor'){
        //     laravelFilemanager : true
        // }
        Laraberg.init('laraberg-editor');
    </script>
@endsection

@section('styles')
    <style>
        #editor {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;

        }

        .ace_editor {
            position: relative !important;
            border: 1px solid lightgray;
            margin: auto;
            height: 600px;
            width: 100%;
            font-size: 20px !important;
        }

    </style>
    <link rel="stylesheet" href="{{asset('vendor/laraberg/css/laraberg.css')}}">
@endsection


