@extends('user.message-center.layout')

@section('sub-sub-content')
    <div class="col-md-10 bg_white bl_dim p-0">
        <div class="prod_side_box_bottom p-12 m-t-0 p-t-0" style="background:#fff;">
            <div class="row m-t-20">
                <div class="col-md-12">
                    <div class="pum_table_wrapper" id="inbox_table_wrapper">

                        <table class="table table-responsive">
                            <thead>
                            <tr style="background:#f0f0f0">
                                <th><i class="fa fa-envelope-o m-r-12"></i>Contact</th>
                                <th>Message</th>
                                <th>Time</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($conversations as $conversation)
                                <tr>
                                    <td>
                                        <a href="/user/message-center/conversation/{{ $conversation->id }}">{{ $conversation->users->first() ? $conversation->users->first()->name : 'Deleted User' }}</a>
                                    </td>
                                    <td>
                                        <a href="/user/message-center/conversation/{{ $conversation->id }}">{{ str_limit($conversation->last_message, 150) }}</a>
                                    </td>
                                    <td>
                                        <a href="/user/message-center/conversation/{{ $conversation->id }}">{{ formatDateString($conversation->updated_at) }}</a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection


