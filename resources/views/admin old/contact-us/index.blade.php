@extends('admin.layouts.app')


@section('content-header')
    <h1>
        {!! $title ?? 'Contact Us Data' !!} ({!! $data->total() !!})
    </h1>
@stop

@section('content')
    <div class="box col-lg-6">
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <thead>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Status</th>
                <th class="text-center">Action</th>
                </thead>
                <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{!! $item->id !!}</td>
                        <td>{!! $item->name !!}</td>
                        <th>{!! $item->email !!}</th>
                        <th>{!! $item->subject !!}</th>
                        <td>{!! strlen($item->message) > 100 ? substr($item->message,0,97).'...' : $item->message  !!}</td>
                        <td>{!! $item->status !!}</td>
                        <td class="text-center">
                            @if($item->status == 'unread')
                                <a href="/admin/contact-us/update-status/{{ $item->id }}?status=read">Mark as
                                    Read</a>
                            @else
                                -
                            @endif
                            &nbsp;
                            <a href="/admin/contact-us/{{ $item->id }}">Show</a>
                            &nbsp;
                            <a href="/admin/contact-us/{{ $item->id }}/delete" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="text-center">
        {!! $data->appends('status', request()->status)->links() !!}
    </div>
@stop
