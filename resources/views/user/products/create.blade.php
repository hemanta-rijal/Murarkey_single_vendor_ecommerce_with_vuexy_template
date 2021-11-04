@extends('user.layout')


@section('sub-content')
    <div class="tab_filter_box p-0 bg_white">
        <div class="row m-0">
            <div class="col-md-12">
                <h3 class="col_title p-t-20 m-b-15">Post New Product</h3>
            </div>
        </div>
        @include('user.products.form', ['userType' => 'user'])
    </div>
@endsection