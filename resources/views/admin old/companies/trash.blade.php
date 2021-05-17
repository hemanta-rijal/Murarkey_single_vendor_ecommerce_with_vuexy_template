@extends('admin.layouts.app')


@section('content-header')
    <h1>
        Deleted Items({!! $companies->count() !!})
    </h1>
@stop

@section('content')
    <div class="box col-lg-6">
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <thead>
                <th>#</th>
                <th>Name</th>
                <th>Logo</th>
                <th>Reason</th>
                <th>Slug</th>
                <th>Status</th>
                <th class="text-center">Action</th>
                </thead>
                <tbody>
                @foreach ($companies as $company)
                    <tr>
                        <td>{!! $company->id !!}</td>
                        <td>{!! $company->name !!}</td>
                        <td><img src="{!! map_storage_path_to_link($company->logo) !!}" height="50"></td>
                        <td><button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="{{ $company->delete_reason }}">{{ str_limit($company->delete_reason, 30) }}</button></td>
                        <td>{!! $company->slug  !!}</td>
                        <td>{!! $company->formated_status !!}</td>
                        <td class="text-center">
                            <a href="{!! route('admin.companies.recover', $company->id) !!}">Recover</a>
                            &middot;
                            @include('admin.partials.modal', ['data' => $company, 'force' => true, 'name' => 'admin.companies.destroy'])
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="text-center">
        {!! $companies->links() !!}
    </div>
@stop
