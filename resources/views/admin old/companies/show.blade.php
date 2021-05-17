@extends('admin.layouts.app')


@section('content-header')
    <h1>
        {!! $company->name !!}
        &middot;
        <small>{!! link_to_route('admin.companies.index', 'Back') !!}</small>
    </h1>
@stop

@section('content')
    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <i class="fa fa-globe"></i> {!! $company->name !!} ({{ $company->formated_status }})
                    <small class="pull-right">
                        {{--<a href="{!! route('companies.show', $company->slug) !!}">Visit Company Page</a> |--}}
                        @if($company->is_pending)
                            <a href="{!! route('admin.companies.update-status', [$company->id, 'approved']) !!}">Approved</a> | <a href="{!! route('admin.companies.update-status', [$company->id, 'editing_required']) !!}">Edit Required</a> |
                        @endif
                        <a href="{!! route('admin.companies.edit', $company->id) !!}">Edit</a> | @include('admin.partials.modal', ['data' => $company, 'name' => 'admin.companies.destroy'])
                    </small>
                </h2>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                <b>Country:</b> {!! $company->country->name !!}<br>
                <b>Province:</b> {!! $company->province_obj->name !!}<br>
                <b>City:</b> {!! $company->city_obj->name !!}<br>
                <b>Operational Address:</b> {!! $company->operational_address !!}<br>
                <b>Established Year:</b> {!! $company->established_year !!}
            </div>

            <div class="col-sm-4 invoice-col">
                <b>Business type:</b>
                <br>
                @foreach($company->business_type as $type)
                    {!! $type !!}<br>
                @endforeach
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                <b>Owner Info:</b> <a
                        href="{{ route('admin.users.show', $company->owner_id) }}">{!! $company->owner->name !!}</a><br>
                <b>Main Products:</b> {!! $company->products !!}<br>
                <b>Website:</b> <a href="{!! $company->website !!}">{!! $company->website !!}</a><br>
                <b>Permit File:</b><a href="{!! map_storage_path_to_link($company->government_business_permit) !!}">Download</a>
            </div>
            <!-- /.col -->
        </div>
        <br>
        <!-- /.row -->
        <div class="row">
            <h4>Company Info</h4>
            <p>{!! $company->description !!}</p>
        </div>

        <div class="row">
            <div class="col-xs-12 table-responsive">
                <h4>Products</h4>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{!! $product->id !!}</td>
                            <td>{!! $product->name !!}</td>
                            <td>{!! $product->category->name !!}</td>
                            <td>PHP {!! $product->price !!}/Piece</td>
                            <td>{!! $product->formated_status !!}</td>
                            <td class="text-center" width="250px;">
                                <a href="{!! route('admin.products.edit', $product->id) !!}"
                                   class="btn btn-sm btn-default">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="{!! route('admin.products.show', $product->id) !!}">Details</a>
                                @include('admin.partials.modal', ['data' => $product, 'name' => 'admin.products.destroy'])
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            {!! $products->links() !!}
        </div>
    </section>
@endsection
