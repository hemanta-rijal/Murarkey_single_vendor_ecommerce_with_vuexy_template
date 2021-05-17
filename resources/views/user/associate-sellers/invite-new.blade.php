@extends('user.layout')

@section('title')
    My Associate Seller - Kabmart
@endsection

@section('sub-content')
    <div class="tab_filter_box p-t-12 bg_white min_height_300">
        <div class="row m-b-15">
            <div class="col-md-3">
                <h3 class="col_title p-t-0 m-b-10 f-s-18">Invite New Associates
                    <a href="/user/associate-sellers" class="p-l-7"><i class="fa fa-angle-left f-s-14"></i> Back</a>
                </h3>
            </div>
            <div class="col-md-7">
                <div class="searchbox" style="width: auto;">
                    <form method="GET">
                        <div class="input-group input-group-sm">
                            <input type="text" name="search" class="form-control no_border_radius"
                                   placeholder="Search New Associates, type in associates email address, separated with a comma."
                                   style="background: #f6f7fb;">
                            <span class="input-group-btn">
                                                <button class="btn btn-default" type="submit"
                                                        style="background: #f6f7fb;border-left: 1px solid #c0c0c0;"><i
                                                            class="fa fa-search"></i></button>
                                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row" style="padding:0 30px;">

            @if(!$message)
                @foreach($users as $user)
                    <div class="col-md-3">
                        <div class="company_contacts">
                            <div class="media text-center">
                                <a class="" href="#">
                                    <img class="media-object" src="{{ $user->profile_pic_url }}" alt="Image"
                                         style="margin: 0 auto;" height="100">
                                </a>
                                <div class="media-body oh_media_con">
                                    <h4 class="media-heading">{{ $user->name }}</h4>
                                </div>
                            </div>
                            <div class="btn_box my_flex">
                                @if($user->is_your_associate)
                                    <a href="" class="btn no_border" style="background:#fff;color: inherit;">Your
                                        Associate</a>
                                @elseif($user->invitation)
                                    {{ Form::open(['url' => '/user/associate-sellers/cancel-invitation']) }}
                                    {{ Form::hidden('id', $user->invitation->id) }}
                                    <button type="submit" class="btn" style="background:#b4c3c8;">Cancel Invite</button>
                                    {{ Form::close() }}
                                @else
                                    {{ Form::open(['url' => '/user/associate-sellers/invite-new']) }}
                                    {{ Form::hidden('user_id', $user->id) }}
                                    <button type="submit" class="btn pcolor_bg white">Send Invite</button>
                                    {{ Form::close() }}
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div>{{ $message }}</div>
            @endif
        </div>


    </div>
@endsection