@extends('admin.layouts.app')


@section('content-header')
    <h1>
        {!! $product->name !!}
        &middot;
        <small>{!! link_to_route('admin.products.index', 'Back') !!}</small>
    </h1>
@stop

@section('content')
    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <i class="fa fa-globe"></i> {!! $product->name !!} ({{ $product->formated_status }})
                    <small class="pull-right">
                        {{--<a href="{!! route('products.show', $product->slug) !!}">Visit Product Details Page</a> |--}}
                        @if($product->is_pending)
                            <a href="{!! route('admin.products.update-status', [$product->id, 'approved']) !!}">Approved</a>
                            |
                            <a href="{!! route('admin.products.update-status', [$product->id, 'editing_required']) !!}">Edit
                                Required</a> |
                        @endif
                        <a href="{!! route('admin.products.edit', $product->id) !!}">Edit</a>
                        | @include('admin.partials.modal', ['data' => $product, 'name' => 'admin.products.destroy'])
                    </small>
                </h2>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                <b>Category: </b> {!! $product->category->name !!}<br>
                <b>Model Number: </b> {!! $product->model_number !!}<br>
                <b>Brand Name: </b> {!! $product->brand_name !!}<br>
                <b>Origin: </b> {!! $product->origin ?$product->origin->name: '-' !!}<br>
                <b>Unit type: </b> {!! $product->unit_type !!}<br>
                <b>Company: </b><a
                        href="{{ route('admin.companies.show', $product->company->slug) }}">{{ $product->company->name }}</a>
            </div>

            <div class="col-sm-4 invoice-col">
                <h4>Attribute:</h4>
                @foreach($product->attributes as $attribute)
                    <b>{{ $attribute->key }}: </b>{{ $attribute->value }}<br>
                @endforeach
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                <h4>Keywords:</h4>
                @foreach($product->keywords as $keyword)
                    {{ $keyword->name }}<br>
                @endforeach

                @if($product->seller_id)
                    <b>Seller :</b>  <a
                            href="{{ route('admin.users.show', $product->seller_id) }}">{!! $product->seller->name !!}</a>
                    <br>
                @endif
            </div>
            <!-- /.col -->
        </div>
        <br>
        <!-- /.row -->
        <div class="row">
            <h4>Product Details</h4>
            <p>{!! $product->details !!}</p>
        </div>

        <div class="row">
            <h4>Shipping Details</h4>
            <p>{!! $product->shipping_details !!}</p>
        </div>


        <div class="row">
            <h4>Packing Details</h4>
            <p>{!! $product->packing_details !!}</p>
        </div>

        <div class="row">

            <h4>Products Images</h4>
            @foreach($product->images as $image)
                <div class="col-lg-4">
                    <img src="{{ resize_image_url($image->image, '50X50') }}" height="100">
                </div>
            @endforeach
        </div>
    </section>
@endsection
