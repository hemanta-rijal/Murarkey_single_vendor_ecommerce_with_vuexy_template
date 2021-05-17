@extends('admin.layouts.app')


@section('content-header')
    <h1>
        {!! $title ?? 'All Categories' !!} ({!! $categories->total() !!})
        &middot;
        <small>{!! link_to_route('admin.categories.create', 'Add New') !!}</small>
    </h1>
@stop

@section('content')
    <div class="box col-lg-6">
        <div class="row">
            <form id="search-form">
                <div class="col-lg-4">
                    <div class="input-group">
                        <input id="search-input-field" type="text" name="search" class="form-control"
                               placeholder="Search for..."
                               value="{{ request()->search }}"
                               onkeypress="if(event.keyCode == 13) { document.getElementById('search-form').submit() }">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button"><i
                    class="fa fa-search"></i></button>
      </span>
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
            </form>
        </div>
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <thead>
                <th>#</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Description</th>
                <th>Product Count</th>
                <th>Parent</th>
                <th class="text-center">Action</th>
                </thead>
                <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{!! $category->id !!}</td>
                        <td>{!! $category->name !!}</td>
                        <th>{!! $category->slug !!}</th>
                        <td>{!! strlen($category->description) > 100 ? substr($category->description,0,97).'...' : $category->description  !!}</td>
                        <td>{!! $category->product_count !!}</td>
                        <td>{!! $category->isRoot()? '-' : $category->parent->name !!}</td>
                        <td class="text-center">
                            <a href="{!! route('admin.categories.edit', $category->id) !!}">Edit</a>
                            &middot;
                            @include('admin.partials.modal', ['data' => $category, 'name' => 'admin.categories.destroy'])
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="text-center">
        {!! $categories->appends(['search' => request()->search])->links() !!}
    </div>
@stop
