@extends('admin.layouts.app')


@section('styles')
    <link href="/assets/css/mixins.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/styles.css" rel="stylesheet" type="text/css">
@endsection


@section('content-header')
    <h1>
        {!! $title ??  (request()->type? ucfirst(request()->type) : 'All') .' Compaines' !!} ({!! $companies->count() !!}
        )
    </h1>
@stop

@section('content')
    <div class="box col-lg-6">
        <div class="row">
            <div class="col-lg-6">
                <ul class="p-t-10 prod_links display_inline p-l-0">
                    <li><a href="">All ({{ $companies->total() }})</a></li>
                    <li><a href="?type=approved">Approved ({{ @$counts['approved'] }})</a></li>
                    <li><a href="?type=editing_required">Editing Required ({{ @$counts['editing_required'] }})</a></li>
                    <li><a href="?type=pending">Approval Pending ({{ @$counts['pending'] }})</a></li>
                </ul>
            </div>
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
                <th>Logo</th>
                <th>Slug</th>
                <th>Owner</th>
                <th>Status</th>
                <th class="text-center">Action</th>
                </thead>
                <tbody>
                @foreach ($companies as $company)
                    <tr>
                        <td>{!! $company->id !!}</td>
                        <td>{!! $company->name !!}</td>
                        <td><img src="{!! map_storage_path_to_link($company->logo) !!}" height="50"></td>
                        <td>{!! $company->slug  !!}</td>
                        <td>{!! $company->owner->name !!}</td>
                        <td>{!! $company->formated_status !!}</td>
                        <td class="text-center">
{{--                            <a href="{!! route('companies.show', $company->slug) !!}">View Page</a>--}}
                            &middot;
                            <a href="{!! route('admin.companies.show', $company->id) !!}">Details</a>
                            &middot;
                            <a href="{!! route('admin.companies.edit', $company->id) !!}">Edit</a>
                            &middot;
                            @include('admin.partials.modal', ['data' => $company, 'name' => 'admin.companies.destroy'])
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="text-center">
        {!! $companies->appends(['search' => request()->search])->links() !!}
    </div>
@stop
