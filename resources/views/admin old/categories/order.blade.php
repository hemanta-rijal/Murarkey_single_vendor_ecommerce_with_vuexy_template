@extends('admin.layouts.app')

@section('styles')
    <link rel="stylesheet" href="/assets/css/jquery-ui.css"/>
    <style>
        #tree {
            width: 550px;
            margin: 0;
        }

        ol {
            max-width: 450px;
            padding-left: 25px;
        }

        ol.sortable, ol.sortable ol {
            list-style-type: none;
        }

        .sortable li div {
            border: 1px solid #d4d4d4;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
            cursor: move;
            border-color: #D4D4D4 #D4D4D4 #BCBCBC;
            margin: 0;
            padding: 3px;
        }

        li.mjs-nestedSortable-collapsed.mjs-nestedSortable-hovering div {
            border-color: #999;
        }

        .disclose, .expandEditor {
            cursor: pointer;
        }

        .sortable li.mjs-nestedSortable-collapsed > ol {
            display: none;
        }

        .sortable li.mjs-nestedSortable-branch > div > .disclose {
            display: inline-block;
        }

        .sortable span.ui-icon {
            display: inline-block;
            margin: 0;
            padding: 0;
        }

        .menuDiv {
            background: #EBEBEB;
        }

        .menuEdit {
            background: #FFF;
        }

        .itemTitle {
            vertical-align: middle;
            cursor: pointer;
        }

        .deleteMenu {
            float: right;
            cursor: pointer;
        }

        h1 {
            font-size: 2em;
            margin-bottom: 0;
        }

        h2 {
            font-size: 1.2em;
            font-weight: 400;
            font-style: italic;
            margin-top: .2em;
            margin-bottom: 1.5em;
        }

        h3 {
            font-size: 1em;
            margin: 1em 0 .3em;
        }

        p, ol, ul, pre, form {
            margin-top: 0;
            margin-bottom: 1em;
        }

        dl {
            margin: 0;
        }

        dd {
            margin: 0;
            padding: 0 0 0 1.5em;
        }

        code {
            background: #e5e5e5;
        }

        input {
            vertical-align: text-bottom;
        }

        .notice {
            color: #c33;
        }
    </style>
@endsection

@section('content-header')

    <h1>
        Order Categories
        &middot;
        <small>{!! link_to_route('admin.categories.index', 'Back') !!}</small>
    </h1>

@stop


@section('content')
    <div class="box col-lg-6">
        <div class="box-body table-responsive no-padding">
            <div class="panel panel-default">
                <div class="panel-body">

                    <div id="error-div" class="alert alert-success" role="alert" style="display:none;">Oops! Something went wrong</div>
                    <ol class="sortable">
                        @php
                            generateTree($tree)
                        @endphp
                    </ol>
                </div>
            </div>

            <button onclick="save()" class="btn btn-primary">Save</button>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="/assets/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/assets/js/jquery.mjs.nestedSortable.js"></script>
    <script>
        $().ready(function () {
            var ns = $('.sortable').nestedSortable({
                forcePlaceholderSize: true,
                handle: 'div',
                helper: 'clone',
                items: 'li',
                opacity: .6,
                revert: 250,
                tabSize: 45,
                tolerance: 'pointer',
                toleranceElement: '> div',
                maxLevels: 4,
                isTree: false,
                rtl: false,
                excludeRoot: true
            });
        });

        $('.disclose').on('click', function () {
            $(this).closest('li').toggleClass('mjs-nestedSortable-collapsed').toggleClass('mjs-nestedSortable-expanded');
            $(this).toggleClass('fa fa-plus').toggleClass('fa fa-minus');
        });

        function save() {
            var data = $('ol.sortable').nestedSortable('toArray');

            $.post('{{ route('admin.categories.order') }}', {data: data, _token: '{!! csrf_token() !!}'})
                    .done(function (data) {
                        location.reload();
                    })
                    .fail(function (data) {
                        $('#error-div').show();
                        console.log(data);
                    });
        }

    </script>
@endsection