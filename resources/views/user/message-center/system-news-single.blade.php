@extends('user.message-center.layout')


@section('sub-sub-content')
    <div class="col-md-10 bg_white bl_dim p-0" id="app">
        <div class="prod_side_box_top p-l-15 p-t-20">
            <div class="row">
                <div class="col-md-9">
                    <div class="media p-t-30">
                        <a class="pull-left sender_pic" href="#">
                            <img class="media-object img-circle" src="{{ $messages->first()->sender->profile_pic_url }}"
                                 alt="Image"
                                 style="max-width:80px;">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">{{ $messages->first()->sender->name }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="conversation_box">
            <div class="control_box">
                {{ Form::open(['method' => 'PUT']) }}
                <button type="submit" class="btn cs_btn pull-left">Mark
                    As {{ $messages->first()->notification && $messages->first()->notification->status == 'read' ? 'Unread' : 'Read' }}</button>
                <input type="hidden" name="status"
                       value="{{ $messages->first()->notification && $messages->first()->notification->status == 'read' ? 'unread' : 'read' }}">
                {{ Form::close() }}

                <div class="clearfix"></div>
            </div>
            @foreach($messages as $message)
                <div class="sender_box">
                    <div class="media">
                        <a class="media-left" href="#">
                            <img src="{{ $messages->first()->sender->profile_pic_url }}" class="img-circle"
                                 style="width: 64px; height: 64px;">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">{{ $messages->first()->sender->name }}</h4>
                            <p> {{ $message->text }}</p>
                            <div class="pull-right p-t-20">
                                <p>{{ $message->formated_created_at }}</p>
                            </div>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
        <!--                inbox box-->
    </div>
@endsection

@section('sub-sub-scripts')

@endsection

