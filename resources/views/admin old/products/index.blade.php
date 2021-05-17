@extends('admin.layouts.app')


@section('styles')
    <link href="/assets/css/mixins.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/styles.css" rel="stylesheet" type="text/css">
@endsection


@section('content-header')
    <h1>
        {!! $title ?? (request()->type? ucfirst(request()->type) : 'All') .' Products' !!} ({!! $products->total() !!})
        &middot;
        <small>{!! link_to_route('admin.products.create', 'Add New') !!}</small>
    </h1>

@stop

@section('content')
    <div class="box col-lg-6">
        <div class="row">
            <div class="col-lg-6">
                <ul class="p-t-10 prod_links display_inline p-l-0">
                    <li><a href="">All ({{ $products->total() }})</a></li>
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
                <th>Image</th>
                <th>Name</th>
                <th>Company</th>
                <th>Price</th>
                {{-- <th>Seller</th> --}}
                <th>Status</th>
                <th class="text-center">Action</th>
                </thead>
                <tbody>
                @foreach ($products as $product)
                {{-- {{dd($product->DB::update('formated_status',1 );)}} --}}
                    <tr>
                        <td>{!! $product->id !!}</td>
                        <td>
                            <img class="media-object"
                                 src="{!! resize_image_url($product->images->first()->image, '50X50') !!}"
                                 alt="Image" height="50"></td>
                        <td>{!! $product->name !!}</td>
                        <td>{{ $product->company->name }}</td>
                        <td>Rs. {{ $product->price }}</td>
                        {{-- <td>{{ $product->seller_id ? $product->seller->name : '-' }}</td> --}}
                        {{-- {{dd($product->formated_status)}} --}}
                        <td>{{ $product->status }}</td>
                        <td class="text-center">
                            {{--<a href="{!! route('products.show', $product->slug) !!}">View Page</a>--}}
                            &middot;
                            <a href="{!! route('admin.products.show', $product->id) !!}">Details</a>
                            &middot;
                            <a href="{!! route('admin.products.edit', $product->id) !!}">Edit</a>
                            &middot;
                            @include('admin.partials.modal', ['data' => $product, 'name' => 'admin.products.destroy'])
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="text-center">
        {!! $products->appends(['search' => request()->search])->links() !!}
    </div>
@stop
