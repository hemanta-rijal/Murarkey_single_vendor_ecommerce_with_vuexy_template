@extends('admin.layouts.app')


@section('content-header')
    <h1>
        {!! $title ?? 'All Flash Sales' !!} ({!! $flashSales->total() !!})
        &middot;
        <small>{!! link_to_route('admin.flash-sales.create', 'Add New') !!}</small>
    </h1>
@stop

@section('content')
    <div class="box col-lg-6">
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <thead>
                <th>#</th>
                <th>Name</th>
                <th>Weight</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Published</th>
                <th class="text-center">Action</th>
                </thead>
                <tbody>
                @foreach ($flashSales as $flashSale)
                    <tr>
                        <td>{!! $flashSale->id !!}</td>
                        <td>{!! $flashSale->title !!}</td>
                        <td>{!! $flashSale->weight !!}</td>
                        <td> {{ $flashSale->start_time }}</td>
                        <td> {{ $flashSale->end_time }}</td>

                        <td><i class="fa fa-{{ $flashSale->published ? 'check' : 'close' }}"></i></td>
                        <td class="text-center">
                            <a href="{!! route('admin.flash-sales.edit', $flashSale->id) !!}">Edit</a>
                            &middot;
                            @include('admin.partials.modal', ['data' => $flashSale, 'name' => 'admin.flash-sales.destroy'])
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="text-center">
        {!! $flashSales->links() !!}
    </div>
@stop
