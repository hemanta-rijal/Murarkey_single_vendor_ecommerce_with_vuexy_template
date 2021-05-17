<div class="company_contacts">
    <div class="media text-center">
        <a class="" href="#">
            <img class="media-object" src="{{ $seller->user->profile_pic_url }}"
                 alt="Image"
                 style="margin: 0 auto;" height="100">
        </a>
        <div class="media-body oh_media_con">
            <h4 class="media-heading">{{ $seller->user->name }}</h4>
            <p>{{ $seller->position }}</p>
        </div>
    </div>
    <div class="">
        @if(!empty($seller->mobile_number))
            <div class="flex-start p-l-15 p-b-10">
                <p class="p-r-25" style="width:75px;">Mobile</p>
                <div class="det_all">
                    @foreach($seller->presentable_mobile_number_a as $number)
                        <p>{{ $number }}</p>
                    @endforeach
                </div>
            </div>
        @endif

        @if(!empty($seller->landline_number))
            <div class="flex-start p-l-15 p-b-10">
                <p class="p-r-25" style="width:75px;">Landline</p>
                <div class="det_all">
                    @foreach($seller->presentable_landline_number_a as $number)
                        <p>{{ $number }}</p>
                    @endforeach
                </div>
            </div>
        @endif

        @if(!empty($seller->fax))
            <div class="flex-start p-l-15 p-b-23">
                <p class="p-r-25" style="width:75px;">Fax</p>
                <div class="det_all">
                    @foreach($seller->presentable_fax_a as $number)
                        <p>{{ $number }}</p>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
    <div class="p-l-15 m-b-15">

        @if($seller->skype)
            <div class="other_media flex-start">
                <img src="/assets/img/skype.png" class="img-responsive height_20 m-r-12"
                     alt="Image">
                <p class="m-b-0">{{ $seller->skype }}</p>
            </div>
        @endif
        @if($seller->viber)
            <div class="other_media flex-start">
                <img src="/assets/img/viber.png" class="img-responsive height_20 m-r-12"
                     alt="Image">
                <p class="m-b-0">{{ $seller->viber }}</p>
            </div>
        @endif

        @if($seller->whatsapp)
            <div class="other_media flex-start">
                <img src="/assets/img/whatsapp.png" class="img-responsive height_20 m-r-12"
                     alt="Image">
                <p class="m-b-0">{{ $seller->whatsapp }}</p>
            </div>
        @endif
        @if($seller->wechat)
            <div class="other_media flex-start">
                <img src="/assets/img/wechat.png" class="img-responsive height_20 m-r-12"
                     alt="Image">
                <p class="m-b-0">{{ $seller->wechat }}</p>
            </div>
        @endif
    </div>
    <div class="btn_box my_flex">

        <a href="javascript:void(0)" class="btn pcolor_bg"
           onclick="{!! auth()->check() ? 'createConversation('.$seller->user_id.')': 'showLoginForm()' !!}">Send
            Message </a>

    </div>
</div>
