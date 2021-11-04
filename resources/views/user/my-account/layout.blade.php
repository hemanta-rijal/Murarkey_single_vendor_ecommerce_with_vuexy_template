@extends('user.layout')

@section('title')
    My Account - Kabmart
@endsection

@section('sub-content')
    <div class="tab_filter_box p-0 bg_white">
        <div class="row m-0">
            <div class="col-md-2 p-r-0">
                <h3 class="col_title p-l-0 p-t-10 f-s-18 m-b-15">My Account</h3>
                <div class="categories_list">
                    <ul class="list_of_categ no_list_style color_inherit p-l-0">
                        <li {!! request()->is('user/my-account/user-info*') ? 'class="active"' : '' !!}><a
                                    href="/user/my-account/user-info">User Account Information</a></li>

                        <li {!! request()->is('user/my-account/shipment-info*') ? 'class="active"' : '' !!}><a
                                    href="/user/my-account/shipment-info">Shipment Information</a></li>
                        @role('main-seller|associate-seller')
                        <li {!! request()->is('user/my-account/seller-info*') ? 'class="active"' : '' !!}><a
                                    href="/user/my-account/seller-info">Seller Account Information</a></li>
                        @endrole
                        @if(auth()->user()->role == 'main-seller')
                            <li {!! request()->is('user/my-account/company-info*') ? 'class="active"' : '' !!}><a
                                        href="/user/my-account/company-info">Company Information</a></li>
                        @endif
                        <li {!! request()->is('user/my-account/settings') ? 'class="active"' : '' !!}><a
                                    href="/user/my-account/settings">Account
                                Settings</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-10 bg_white bl_dim p-b-70 p-t-59">
                @yield('sub-sub-content')
            </div> <!-- col -->
        </div> <!-- row -->
    </div> <!-- tab-filter-box -->
@endsection


@section('sub-scripts')

    <script>
        function submitClosetForm(element) {
            $(element).closest('form').submit();
        }
    </script>
    @yield('sub-sub-scripts')
@endsection

