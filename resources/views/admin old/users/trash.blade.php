@extends('admin.layouts.app')


@section('content-header')
    <h1>
        Deleted Items({!! $users->total() !!})
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
                <th>Reason</th>
                <th>Email</th>
                <th class="text-center">Action</th>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{!! $user->id !!}</td>
                        <td><img src="{{ $user->profile_pic_url }}" height="50"></td>
                        <td>{!! $user->name !!}</td>
                        <td><button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="{{ $user->delete_reason }}">{{ str_limit($user->delete_reason, 30) }}</button></td>
                        <td>{{ $user->email }} {{ $user->phone_number }}</td>
                        <td class="text-center">
                            <a href="{!! route('admin.users.recover', $user->id) !!}">Recover</a>
                            &middot;
                            @include('admin.partials.modal', ['data' => $user, 'force' => true, 'name' => 'admin.users.destroy'])
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="text-center">
        {!! $users->links() !!}
    </div>
@stop
