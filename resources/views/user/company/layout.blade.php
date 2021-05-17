@extends('user.layout')
@section('title')
  Kabmart
@endsection

@section('sub-content')
    <div class="tab_filter_box p-0 bg_white">
        <div class="row m-0">
            <div class="col-md-2 p-r-0">
                <h3 class="col_title p-l-0 p-t-10 f-s-18 m-b-15">Company</h3>
                <div class="categories_list">
                    <ul class="list_of_categ no_list_style color_inherit p-l-0">
                        <li {!! request()->is('user/company/logo-photos*') ? 'class="active"' : '' !!}><a href="/user/company/logo-photos">Logo, Photos, & Description</a></li>
                        <li {!! request()->is('user/company/product-showcase*') ? 'class="active"' : '' !!}><a href="/user/company/product-showcase">Product Showcase</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-10 bg_white bl_dim p-0">
                @yield('sub-sub-content')
            </div>
            <!-- col -->
        </div>
        <!-- row -->
    </div>
@endsection


@section('sub-scripts')
    @yield('sub-sub-scripts')
@endsection

