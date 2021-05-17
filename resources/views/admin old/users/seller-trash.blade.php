@extends('admin.layouts.app')


@section('content-header')
    <h1>
        Deleted Associate Seller Account({!! $sellers->total() !!})
    </h1>
@stop

@section('content')
    <div class="box col-lg-6">
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <thead>
                <th>#</th>
                <th>Image</th>
                <th>Name</th>
                <th>Company Name</th>
                <th>Reason</th>
                <th>Email</th>
                <th class="text-center">Action</th>
                </thead>
                <tbody>
                @foreach ($sellers as $seller)
                    <tr>
                        <td>{!! $seller->id !!}</td>
                        <td><img src="{{ $seller->user->profile_pic_url }}" height="50"></td>
                        <td>{!! $seller->user->name !!}</td>
                        <td>{{ $seller->company?$seller->company->name : '-'  }}</td>
                        <td><button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="{{ $seller->delete_reason }}">{{ str_limit($seller->delete_reason, 30) }}</button></td>
                        <td>{{ $seller->user->email }}</td>
                        <td>@include('admin.partials.modal', ['data' => $seller->user, 'force' => true, 'name' => 'admin.users.seller-destroy'])</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="text-center">
        {!! $sellers->links() !!}
    </div>
@stop
