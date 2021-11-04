@extends('user.layout')

@section('title')
    Kabmart
@endsection

@section('sub-content')
    <div class="tab_filter_box p-t-25 bg_white">
        <div class="row m-b-15">
            <div class="col-md-12">
                <p class="pull-left">Welcome back <span class="pcolor">{{ auth()->user()->first_name }}
                        , </span> Here
                    is you To Do List.</p>
                <p class="pull-right">User Type: {{ get_user_type() }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <a href="/user/message-center/conversations" class="color_inherit">
                    <div class="box_pum_stat dim_border m-b-15">
                        <h1 class="text-center f-s-75 f-w-300">{{ getUnreadMessagesCount() }}</h1>
                        <p class="f-s-18 text-center">Unread Messages</p>
                    </div>
                </a>
            </div>
            @role('ordinary-user|associate-seller')
            <div class="col-md-3 col-sm-6">
                <a href="/user/message-center/invite-requests" class="color_inherit">
                    <div class="box_pum_stat dim_border m-b-15">
                        <h1 class="text-center f-s-75 f-w-300">{{ get_unread_invitation_count() }}</h1>
                        <p class="f-s-18 text-center">Unread Invite Requests</p>
                    </div>
                </a>
            </div>
            @endrole

            <div class="col-md-3 col-sm-6">
                <a href="" class="color_inherit">
                    <div class="box_pum_stat dim_border m-b-15">
                        <h1 class="text-center f-s-75 f-w-300">0</h1>
                        <p class="f-s-18 text-center">Pending Order</p>
                    </div>
                </a>
            </div>

            @role('main-seller|associate-seller')
            <div class="col-md-3 col-sm-6">
                <a href="/user/products?type=editing_required" class="color_inherit">
                    <div class="box_pum_stat dim_border m-b-15">
                        <h1 class="text-center f-s-75 f-w-300">{{ get_product_editing_required_count() }}</h1>
                        <p class="f-s-18 text-center">Product Require Editing</p>
                    </div>
                </a>
            </div>
            @endrole

        </div>
        <div class="row">
            <div class="col-md-12">
                @if(get_banner_by_slug('user-dashboard'))
                    <a href="{{ get_banner_by_slug('user-dashboard')->link }}">
                        <img src="{{ get_banner_by_slug('user-dashboard')->image_url }}"
                             class="img-responsive"
                             alt="Image">
                    </a>
                @endif
            </div>
        </div>
    </div>
@endsection