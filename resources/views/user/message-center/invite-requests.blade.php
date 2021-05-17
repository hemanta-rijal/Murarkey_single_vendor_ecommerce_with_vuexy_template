@extends('user.message-center.layout')

@section('sub-sub-content')
    <div class="col-md-10 bg_white bl_dim p-b-70 p-t-59">
        <p class="black">Do you wish to be an associate for this company?</p>
        <div class="request_box">
            @if(session()->has('accepted_invitation') &&  $invitations->count() == 0 && session('accepted_invitation') == 0 )
                <div class="request_item">
                    <div class="row">
                        <div class="col-md-2">
                                <img class="img-responsive"
                                     src="{{ session('accepted_invitation_logo') }}" alt="">
                        </div>
                        <div class="col-md-6">
                            <div class="congrates_box">
                                <h4 class="text-center"><i
                                            class="fa fa-check-circle"></i>
                                    Congratulations !</h4>
                                <p class="text-center m-0">You are now an associate
                                    seller for this company.</p>
                                <i class="fa fa-caret-right" style="color:#65c027;"></i>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="req_btns p-t-15">
                                {{--<a href=""--}}
                                   {{--class="btn btn-info pull-left pcolor_bg">Confirm</a>--}}
                                {{--<a href="" class="btn cs_btn m-t-0 pull-right">Delete--}}
                                    {{--Request</a>--}}
                            </div>
                        </div>
                    </div> <!-- row -->
                </div> <!-- Request item-->
            @endif
            @foreach($invitations as $invitation)
                @if(session()->has('accepted_invitation') && session('accepted_invitation') == $loop->index)
                    <div class="request_item">
                        <div class="row">
                            <div class="col-md-2">

                                <img class="img-responsive"
                                     src="{{ session('accepted_invitation_logo') }}" alt="">
                            </div>
                            <div class="col-md-6">
                                <div class="congrates_box">
                                    <h4 class="text-center"><i
                                                class="fa fa-check-circle"></i>
                                        Congratulations !</h4>
                                    <p class="text-center m-0">You are now an associate
                                        seller for this company.</p>
                                    <i class="fa fa-caret-right" style="color:#65c027;"></i>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="req_btns p-t-15" style="min-width: 255px;">
                                    {{--<a href=""--}}
                                       {{--class="btn btn-info pull-left pcolor_bg">Confirm</a>--}}
                                    {{--<a href="" class="btn cs_btn m-t-0 pull-right">Delete--}}
                                        {{--Request</a>--}}
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div> <!-- row -->
                    </div> <!-- Request item-->
                @endif
                
                <div class="request_item">
                    <div class="row">
                        <div class="col-md-2">

                            <img class="img-responsive"
                                 src="{{ $invitation->company->cropped_logo }}" alt="Company Logo">

                        </div>
                        <div class="col-md-6" id="invitation-{{ $invitation->id }}-message-div">
                            <a href="{{ route('companies.show', $invitation->company->slug) }}"
                               class="f-s-16"
                               id="invitation-{{ $invitation->id }}-link">{{ $invitation->company->name }}</a>
                        </div>
                        <div class="col-md-4">
                            <div class="req_btns p-t-15" style="min-width: 255px;">
                                @if(auth()->user()->isSeller())
                                    <button onclick="showSorryMessage({{ $invitation->id }})"
                                            class="btn btn-info pull-left pcolor_bg">Confirm
                                    </button>
                                @else
                                    {{ Form::open(['url' => '/user/message-center/accept-invitation']) }}
                                    {{ Form::hidden('id', $invitation->id) }}
                                    {{ Form::hidden('index', $loop->index) }}
                                    {{ Form::hidden('logo', $invitation->company->cropped_logo) }}
                                    <button type="submit" class="btn btn-info pull-left pcolor_bg">Confirm</button>
                                    {{ Form::close() }}
                                @endif
                                {{ Form::open(['url' => '/user/message-center/delete-invitation']) }}
                                {{ Form::hidden('id', $invitation->id) }}
                                <button type="submit" class="btn cs_btn m-t-0 pull-right">Delete
                                    Request
                                </button>
                                {{ Form::close() }}

                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div> <!-- row -->
                </div> <!-- Request item-->
            @endforeach

        </div> <!-- request box -->
    </div>
@endsection


@section('sub-sub-scripts')
    <script>

        function showSorryMessage(id) {
            var sorryMessage = '<div class="sorry_box" id="invitation-' + id + '-sorry-message">' +
                    '<p class="text-center m-0">Sorry you already have a seller account. <br>' +
                    'You will not be able to confirm this request.</p>' +
                    '<i class="fa fa-caret-right"></i>' +
                    '</div>';

            var messageDiv = $('#invitation-' + id + '-sorry-message');

            if (messageDiv.length == 0) {
                $('#invitation-' + id + '-link').hide();
                $('#invitation-' + id + '-message-div').append(sorryMessage);
            } else {
                $('#invitation-' + id + '-link').show();
                messageDiv.remove();
            }
        }

        $(document).ready(function () {
            $.post('/user/message-center/mark-all-invitation-as-read', {_token: "{{ csrf_token() }}"})
                    .fail(function (error) {
                        alert('something went wrong');
                    })
        });
    </script>
@endsection




