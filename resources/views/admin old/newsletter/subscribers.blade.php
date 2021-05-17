@extends('admin.layouts.app')


@section('content-header')
    <h1>
        {!! $title ?? 'All Subscribers' !!} ({!! $subscribers->count() !!})
    </h1>
@stop

@section('content')
    <div class="box col-lg-6">
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <thead>
                <th>#</th>
                <th>Email</th>
                <th>Status</th>
                <th>Action</th>
                </thead>
                <tbody>
                @foreach ($subscribers as $subscriber)
                    <tr>
                        <td>{!! $subscriber->id !!}</td>
                        <td>{!! $subscriber->email !!}</td>
                        <td>{!! $subscriber->status !!}</td>
                        <td><a href="/admin/newsletter/subscribers/{{ $subscriber->id }}/delete" onclick="return confirm('Are you sure?')">Delete</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="text-center">
        {!! $subscribers->links() !!}
    </div>
@stop

