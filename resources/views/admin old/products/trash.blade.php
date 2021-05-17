@extends('admin.layouts.app')


@section('content-header')
    <h1>
        Deleted Items({!! $products->count() !!})
    </h1>
@stop

@section('content')
    <div class="box col-lg-6">
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <thead>
                <th>#</th>
                <th>Name</th>
                <th>Image</th>
                <th>Company</th>
                <th class="text-center">Action</th>
                </thead>
                <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{!! $product->id !!}</td>
                        <td>{!! $product->name !!}</td>
                        <td><img src="{!! resize_image_url($product->images->first()->images, '50X50') !!}" height="50"></td>
                        <td>{!! $product->company->name  !!}</td>
                        <td class="text-center">
                            <a href="{!! route('admin.products.recover', $product->id) !!}">Recover</a>
                            &middot;
                            @include('admin.partials.modal', ['data' => $product, 'force' => true, 'name' => 'admin.products.destroy'])
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="text-center">
        {!! $products->links() !!}
    </div>
@stop
