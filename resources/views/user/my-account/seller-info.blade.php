@extends('user.my-account.layout')

@section('sub-styles')

@endsection

@section('sub-sub-content')
    <h3 class="col_title p-t-0">Seller Contact Information <span class="f-w-400 f-s-14" style="color:grey;">This information will be seen by buyers on the website</span>
    </h3>
    <section id="seller_registration">
        <form action="">
            <div class="form-horizontal">
                <div class="form-group">
                    <label class="col-md-3 control-label f-w-400 p-l-0"><span class="red"></span> Your Position in the
                        company</label>
                    <div class="col-md-9">
                        <p class="black m-0 p-t-7">{{ $seller->position }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label f-w-400"><span class="red"></span> Mobile Number</label>
                    <div class="col-md-9">
                        @foreach($seller->presentable_mobile_number as $number)
                            <p class="black m-0 p-t-7 p-b-12">{{ $number }}</p>
                        @endforeach
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label f-w-400"><span class="red"></span> Landline Number</label>
                    <div class="col-md-9">
                        @foreach($seller->presentable_landline_number as $number)
                            <p class="black m-0 p-t-7 p-b-12">{{ $number }}</p>
                        @endforeach
                    </div>
                </div>
                @if($seller->fax)
                    <div class="form-group">
                        <label class="col-md-3 control-label f-w-400"><span class="red"></span> Fax Number</label>
                        <div class="col-md-9">
                            @foreach($seller->presentable_fax as $number)
                                <p class="black m-0 p-t-7 p-b-12">{{ $number }}</p>
                            @endforeach
                        </div>
                    </div>
                @endif
                <div class="form-group">
                    <label class="col-md-3 control-label f-w-400 p-l-0"><span class="red"></span> Skype ID</label>
                    <div class="col-md-9">
                        <p class="black m-0 p-t-7">{{ $seller->skype ?? '-'}}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label f-w-400 p-l-0"><span class="red"></span> Viber ID</label>
                    <div class="col-md-9">
                        <p class="black m-0 p-t-7">{{ $seller->viber ?? '-' }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label f-w-400 p-l-0"><span class="red"></span> Whatsapp ID</label>
                    <div class="col-md-9">
                        <p class="black m-0 p-t-7">{{ $seller->whatsapp ?? '-' }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label f-w-400 p-l-0"><span class="red"></span> WeChat ID</label>
                    <div class="col-md-9">
                        <p class="black m-0 p-t-7">{{ $seller->wechat ?? '-' }}</p>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-md-3 control-label f-w-400"><span class="red"></span></label>
                    <div class="col-md-8">
                        <a href="/user/my-account/seller-info/edit"
                           class="btn cs_btn pull-right black" style="padding:3px 15px;">Edit</a>
                    </div>
                </div>


            </div>

        </form>
    </section>
@endsection
