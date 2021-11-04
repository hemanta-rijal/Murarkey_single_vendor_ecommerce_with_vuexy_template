@extends('user.message-center.layout')


@section('sub-sub-content')
    <div class="col-md-10 bg_white bl_dim p-0" id="app">
        <div class="prod_side_box_top p-l-15 p-t-20">
            <div class="row">
                <div class="col-md-9">
                    <div class="media p-t-30">
                        <a class="pull-left sender_pic" href="#">
                            <img class="media-object img-circle"
                                 src="{{ $conversation->users->first()->profile_pic_url }}" alt="Image"
                                 style="max-width:80px;">
                            <div class="is_online" v-show="conversation.users[0].is_online"></div>
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">{{ $conversation->users->first()->name }}</h4>

                            @if($conversation->users->first()->isSeller())
                                <p class="black">{{ $conversation->users->first()->seller->position }}</p>
                            @endif
                            @if($conversation->users->first()->isSeller())
                                <a href="#" class="color_inherit clickme"><p class="">View Contact Details <i
                                                class="fa fa-angle-down m-l-4"></i></p></a>
                            @endif

                        </div>

                    </div>

                </div>

                @if($conversation->users->first()->isSeller())
                    <div class="col-md-3 flex_end no_flex_mobile">
                        <div class="just_right p-r-15">
                            <a href="{{ route('companies.show', $conversation->users->first()->seller->company->slug) }}">

                                <img class="img-responsive"
                                     src="{{ $conversation->users->first()->seller->company->cropped_logo }}"
                                     alt="Chania" style="height: 150px; width:150px;  -o-object-fit:cover;
     object-fit:cover">

                                <p class="black p-t-12">{{ $conversation->users->first()->seller->company->name }}</p>
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        @if($conversation->users->first()->isSeller())
            <div class="toggle_box">
                <div class="row">
                    <div class="col-md-3">
                        <div class="flex-start ">
                            <p class="p-r-12" style="width: 65px;">Mobile</p>
                            <div class="det_all">
                                @foreach($conversation->users->first()->seller->presentable_mobile_number_a as $number)
                                    <p class="m-b-0">{{ $number }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="flex-start ">
                            <p class="p-r-12" style="width: 65px;">Landline</p>
                            <div class="det_all">
                                @foreach($conversation->users->first()->seller->presentable_landline_number_a as $number)
                                    <p class="m-b-0">{{ $number }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="flex-start p-b-23">
                            <p class="p-r-12" style="width: 65px;">Fax</p>
                            <div class="det_all">
                                @foreach($conversation->users->first()->seller->presentable_fax_a as $number)
                                    <p class="m-b-0">{{ $number }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="">
                            @if($conversation->users->first()->seller->skype)
                                <div class="other_media flex-start">
                                    <img src="/assets/img/skype.png" class="img-responsive height_20 m-r-12"
                                         alt="Image">
                                    <p class="m-b-0">{{ $conversation->users->first()->seller->skype }}</p>
                                </div>
                            @endif
                            @if($conversation->users->first()->seller->viber)
                                <div class="other_media flex-start">
                                    <img src="/assets/img/viber.png" class="img-responsive height_20 m-r-12"
                                         alt="Image">
                                    <p class="m-b-0">{{ $conversation->users->first()->seller->viber }}</p>
                                </div>
                            @endif

                            @if($conversation->users->first()->seller->whatsapp)
                                <div class="other_media flex-start">
                                    <img src="/assets/img/whatsapp.png" class="img-responsive height_20 m-r-12"
                                         alt="Image">
                                    <p class="m-b-0">{{ $conversation->users->first()->seller->whatsapp }}</p>
                                </div>
                            @endif
                            @if($conversation->users->first()->seller->wechat)
                                <div class="other_media flex-start">
                                    <img src="/assets/img/wechat.png" class="img-responsive height_20 m-r-12"
                                         alt="Image">
                                    <p class="m-b-0">{{ $conversation->users->first()->seller->wechat }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
    @endif
    <!--                toggle box-->
        <!--                inbox box-->
        <div class="control_box" style="background-color: #e7eef8;padding: 15px 30px;">
            {{ Form::open(['method' => 'delete', 'onsubmit' => 'return confirm("Are you  sure? You can\'t restore back.")']) }}
            <button class="btn cs_btn pull-left m-t-0" type="submit">Delete</button>
            {{ Form::close() }}
            {{ Form::open(['method' => 'PUT']) }}
            <button type="submit" class="btn cs_btn pull-left m-t-0">Mark As Unread</button>
            {{ Form::close() }}
            <div class="clearfix"></div>
        </div>

        <div class="conversation_box" v-infinite-scroll="loadMore"
             infinite-scroll-disabled="loadMoreDisabled"
             infinite-scroll-distance="10" style="max-height: 500px; overflow-y: scroll">


            <div class="load-more-message" v-show="loadMoreBusy">
                <center>loading...</center>
            </div>

            <div v-for="message in orderedMessages" :class=" isCurrentUser(message)? 'me_box' : 'sender_box'">
                <div class="media">
                    <a class="media-left" href="#">
                        <img :src="isCurrentUser(message) ? profile_pic_url :
                                conversation.users[0].profile_pic_url" class="img-circle"
                             style="width: 64px; height: 64px;">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">@{{ isCurrentUser(message) ? 'Me' :
                            conversation.users[0].name }}</h4>
                        <p v-html="message.body" style="word-break: break-all;"></p>

                        <div class="pull-right p-t-20">
                            <button type="button" class="close" aria-label="Close" v-show="isCurrentUser(message)"><span
                                        aria-hidden="true" @click=deleteMessage(message)>&times;</span></button>
                            <p>@{{ message.formated_created_at }}</p>
                        </div>

                    </div>
                </div>

            </div>


        </div>
        <!--                inbox box-->
        <div class="custom_div">

            <div class="message_type_box"
                 style="padding: 12px;background-color: #fff;padding-bottom: 0;border: 1px solid #e3e3e3;">
                        <textarea class="form-control" v-model="message"
                                  placeholder="Type in your message" rows="5"
                                  style="margin-bottom:10px;"
                                  @change="message.length > 5000? message.slice(0, -1): ''"
                                  @keypress.enter="sendMessage()"></textarea>
                <h6 class="pull-left" id="counter">@{{ message.length }} / 5000</h6>
                <div id="pum_uploadinput" class="pull-right">
                    <div class="form-group m-b-0" style="margin-top: -8px;margin-right: 5px;"><input
                                type="file" name="attachment" :id="'file-'+ conversation.id"
                                class="input-file" style="display: none;" @change="uploadAttachment()"><label
                                for="file"
                                class="btn btn-tertiary js-labelFile"
                                style="width: auto;background: #fff;padding: 0;"
                                @click="openSelectFileDialog()"><i
                                    class="fa fa-paperclip"></i></label>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <button class="btn btn-success pull-right m-r-12 m-t-12" @click="sendMessage()">Send</button>
            <div class="clearfix"></div>
        </div>


    </div>

    <audio id="message-notification" src="/assets/sounds/message-beep.mp3" autostart="false"></audio>
@endsection

@section('sub-sub-scripts')
    <script>
        var conversation =
                {!! $conversation !!}
        var user_id =
                {{ auth()->user()->id }}
        var profile_pic_url = "{{ auth()->user()->profile_pic_url }}";
    </script>
    <script src="/js/conversation.js"></script>
    <script type="text/javascript" src="{{ asset('assets/ajax-upload/js/vendor/jquery.ui.widget.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/ajax-upload/js/jquery.iframe-transport.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/ajax-upload/js/jquery.fileupload.js') }}"></script>
    <script>
        function initUploadAttachment(conservation_id) {
            var c_id = conservation_id;

            $('#file-' + c_id).fileupload({
                url: '/user/store-message',
                formData: {
                    'conversation_id': c_id,
                    'type': 'attachment',
                    '_token': '{{ csrf_token() }}'
                },
                submit: function (e, data) {
                    if (data.files[0].size > 10485760) {
                        alert('File is too big(More than 10 MB).');
                        return false;
                    }

                    return true;
                },
                done: function (e, data) {
                    console.log('done');
                },
                error: function (e, data) {
                    alert('Something went wrong');
                }
            });
        }


        $('.toggle_box').hide();

        // Make sure all the elements with a class of "clickme" are visible and bound
        // with a click event to toggle the "box" state
        $('.clickme').each(function () {
            $(this).show(0).on('click', function (e) {
                // This is only needed if your using an anchor to target the "box" elements
                e.preventDefault();

                // Find the next "box" element in the DOM
                $('.toggle_box').slideToggle('fast');
//            $(this).next('.box').slideToggle('fast');
            });
        });
    </script>
@endsection

