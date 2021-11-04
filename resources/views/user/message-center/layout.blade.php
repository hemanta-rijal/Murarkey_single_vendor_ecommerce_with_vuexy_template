@extends('user.layout')

@section('title')
    Message Center - Kabmart
@endsection

@section('sub-content')
    <div class="tab_filter_box p-0 bg_white">
        <div class="row m-0">
            <div class="col-md-2">
                <h3 class="col_title p-l-19 p-t-10 f-s-18 m-b-15">Message Center</h3>
                <div class="categories_list">
                    <ul class="list_of_categ no_list_style color_inherit p-l-20">
                        <li {!! request()->is('user/message-center/conversations') ? 'class="active"' : '' !!}><a
                                    href="/user/message-center/conversations">Conversations
                                ({{ getUnreadMessagesCount() }})</a></li>
                        {{--<li {!! request()->is('user/message-center/sent-messages') ? 'class="active"' : '' !!}><a--}}
                        {{--href="/user/message-center/sent-messages">Sent Messages</a></li>--}}

                        <li {!! request()->is('user/message-center/system-news') ? 'class="active"' : '' !!}><a
                                    href="/user/message-center/system-news">System News
                                ({{ get_unread_system_message_count() }})</a></li>

                        @role('associate-seller|ordinary-user')
                        <li {!! request()->is('user/message-center/invite-requests') ? 'class="active"' : '' !!}><a
                                    href="/user/message-center/invite-requests">Invite
                                Requests @if( $invitation_count = get_invitation_count())
                                    ({{ $invitation_count }})
                                @endif</a>
                        </li>
                        @endrole
                    </ul>
                </div>
            </div>

            @yield('sub-sub-content')

        </div> <!-- row -->
    </div> <!-- tab-filter-box -->
@endsection

@section('sub-scripts')
    @yield('sub-sub-scripts')
@endsection