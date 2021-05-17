@extends('user.layout')

@section('title')
    My Associate Seller - Kabmart
@endsection

@section('sub-content')
    <div class="tab_filter_box p-t-12 bg_white min_height_300">
        <div class="row m-b-15">
            <div class="col-md-6">
                <h3 class="col_title p-t-0 m-b-10">Associate Sellers</h3>
                <a href="/user/associate-sellers">My Associates</a> |
                <a href="/user/associate-sellers/invited-associates" class="color_inherit">View Invited Associates</a>
            </div>
            <div class="col-md-6">
                <a href="/user/associate-sellers/invite-new" class="btn btn-info pull-right pcolor_bg m-t-15">Invite New
                    Associates</a>
            </div>
        </div>
        <div class="row" style="padding:0 30px;">

            @foreach($sellers as $seller)
                <div class="col-md-3">
                    <div class="company_contacts has_overlay">
                        <div class="media text-center">
                            <a class="" href="#">
                                <img class="media-object" src="{{ $seller->profile_pic_url }}" alt="Image"
                                     style="margin: 0 auto;" height="100">
                            </a>
                            <div class="media-body oh_media_con">
                                <h4 class="media-heading">{{ $seller->name }}</h4>
                                <p>{{ $seller->seller->position }}</p>
                            </div>
                        </div>
                        <div class="">
                            @if(!empty($seller->seller->mobile_number))
                                <div class="flex-start p-l-15 ">
                                    <p class="p-r-25" style="width:75px;">Mobile</p>
                                    <div class="det_all l-h-9 p-t-7">
                                        @foreach($seller->seller->presentable_mobile_number_a as $number)
                                            <p>{{ $number }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            @if(!empty($seller->seller->landline_number))
                                <div class="flex-start p-l-15 ">
                                    <p class="p-r-25" style="width:75px;">Landline</p>
                                    <div class="det_all l-h-9 p-t-7">
                                        @foreach($seller->seller->presentable_landline_number_a as $number)
                                            <p>{{ $number }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            @if(!empty($seller->seller->fax))
                                <div class="flex-start p-l-15 p-b-23">
                                    <p class="p-r-25" style="width:75px;">Fax</p>
                                    <div class="det_all l-h-9 p-t-7">
                                        @foreach($seller->seller->presentable_fax_a as $number)
                                            <p>{{ $number }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="p-l-15">

                            @if($seller->seller->skype)
                                <div class="other_media flex-start">
                                    <img src="/assets/img/skype.png" class="img-responsive height_20 m-r-12"
                                         alt="Image">
                                    <p class="m-b-0">{{ $seller->seller->skype }}</p>
                                </div>
                            @endif
                            @if($seller->seller->viber)
                                <div class="other_media flex-start">
                                    <img src="/assets/img/viber.png" class="img-responsive height_20 m-r-12"
                                         alt="Image">
                                    <p class="m-b-0">{{ $seller->seller->viber }}</p>
                                </div>
                            @endif

                            @if($seller->seller->whatsapp)
                                <div class="other_media flex-start">
                                    <img src="/assets/img/whatsapp.png" class="img-responsive height_20 m-r-12"
                                         alt="Image">
                                    <p class="m-b-0">{{ $seller->seller->whatsapp }}</p>
                                </div>
                            @endif
                            @if($seller->seller->wechat)
                                <div class="other_media flex-start m-b-12">
                                    <img src="/assets/img/wechat.png" class="img-responsive height_20 m-r-12"
                                         alt="Image">
                                    <p class="m-b-0">{{ $seller->seller->wechat }}</p>
                                </div>
                            @endif
                        </div>

                        <div class="overlay_wrapper flex">
                            <div class="">
                                <div class="text-center">
                                    <button type="button" class="btn btn-default no_border clickme"
                                            style="background:#556072;color: #fff;">Delete Associate
                                    </button>
                                    <div class="sure_box text-center m-t-12" style="background: #fff;">
                                        {{ Form::open(['url' => '/user/associate-sellers/remove-associate/'. $seller->id, 'method' => 'DELETE']) }}
                                        <p class="black text-center f-s-16">Are You Sure?</p>
                                        Deleting an associate Seller will not remove his/her product added.
                                        <div class="text-center">
                                            <button type="submit" class="btn cs_btn m-t-10">Yes</button>
                                            <button type="button" class="btn cs_btn m-t-10 no_bttn">No</button>
                                        </div>
                                        <i class="fa fa-sort-up" style="color: #fff;"></i>
                                        {{ Form::close() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="company_contacts p-t-0" style="margin-top: -1px;">
                        <div class="btn_box my_flex">
                            <a href="javascript:void(0);" class="btn pcolor_bg" onclick="createConversation({{ $seller->id }})">Send Message </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

