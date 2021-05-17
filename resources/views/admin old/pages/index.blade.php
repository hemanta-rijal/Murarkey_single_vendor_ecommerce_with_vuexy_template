@extends('admin.layouts.app')


@section('content-header')
    <h1>
        {!! $title ?? 'All Pages' !!} ({!! $pages->count() !!})
        &middot;
        <small>{!! link_to_route('admin.pages.create', 'Add New') !!}</small>
    </h1>
@stop

@section('content')
    <div class="box col-lg-6">
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <thead>
                <th>#</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Published</th>
                <th class="text-center">Action</th>
                </thead>
                <tbody>
                @foreach ($pages as $page)
                    <tr>
                        <td>{!! $page->id !!}</td>
                        <td>{!! $page->name !!}</td>
                        <td>{!! $page->slug !!}</td>
                        <td><i class="fa fa-{{ $page->published ? 'check' : 'close' }}"></i></td>
                        <td class="text-center">
                            <a href="{!! route('pages.show', $page->slug) !!}" target="_blank">View Page</a>
                            &middot;
                            <a href="{!! route('admin.pages.edit', $page->id) !!}">Edit</a>
                            &middot;
                            @include('admin.partials.modal', ['data' => $page, 'name' => 'admin.pages.destroy'])
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="text-center">
        {!! $pages->links() !!}
    </div>
@stop
