@extends('user.layout')

@section('sub-content')
    <div class="tab_filter_box p-0 bg_white">
        <div class="row m-0">
            <div class="col-md-12">
                <h3 class="col_title p-t-20 m-b-15">Edit Product

                    <a href="/user/products" class="f-s-14 m-l-20">< Back</a>
                </h3>
                <p class="black">{{ $product->name }}
                    <materials></materials>
                </p>
            </div>


            @include('user.products.form', ['model' => $product,'userType' => 'user'])

        </div>
@endsection

