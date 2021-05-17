@extends('user.my-account.layout')

@section('sub-sub-content')
    <h3 class="col_title p-t-0">Seller Contact Information <span class="f-w-400 f-s-14" style="color:grey;">This information will be seen by buyers on the website</span>
    </h3>
    <section id="seller_registration">
        <form action="">
            <div class="form-horizontal">
                <div class="form-group">
                    <label class="col-md-3 control-label f-w-400 p-l-0"><span class="red">*</span> Company Name</label>
                    <div class="col-md-9">
                        <p class="black m-0 p-t-7">{{ $company->name }}</p>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label f-w-400 p-l-0"><span class="red"></span> Year
                        Established</label>
                    <div class="col-md-9">
                        <p class="black m-0 p-t-7">{{ $company->established_year }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label f-w-400 p-l-0">*<span class="red"></span> Business Type</label>
                    <div class="col-md-9">
                        @foreach($company->business_type as $type)
                            <p class="black m-0 p-t-7">{{ $type }}</p>
                        @endforeach
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label f-w-400 p-l-0"><span class="red"></span> Main Products</label>
                    <div class="col-md-9">
                        <p class="black m-0 p-t-7">{{ $company->products }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label f-w-400 p-l-0"><span class="red"></span> Main Operational
                        Status</label>
                    <div class="col-md-9">
                        <p class="black m-0 p-t-7">{{ $company->operational_address }}</p>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label f-w-400 p-l-0"><span class="red">*</span> Country</label>
                    <div class="col-md-9">
                        <p class="black m-0 p-t-7">{{ $company->country->name }}</p>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label f-w-400 p-l-0"><span class="red">*</span> Province</label>
                    <div class="col-md-9">
                        <p class="black m-0 p-t-7">{{ $company->province_obj->name }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label f-w-400 p-l-0"><span class="red">*</span> City</label>
                    <div class="col-md-9">
                        <p class="black m-0 p-t-7">{{ $company->city_obj->name }}</p>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label f-w-400 p-l-0"><span class="red"></span>Website Address</label>
                    <div class="col-md-9">
                        <p class="black m-0 p-t-7">{{ $company->website ?? '-' }}</p>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-md-3 control-label f-w-400"><span class="red"></span></label>
                    <div class="col-md-8">
                        <a href="/user/my-account/company-info/edit" class="btn cs_btn pull-right black"
                           style="padding:3px 15px;">Edit</a>
                    </div>
                </div>


            </div>

        </form>
    </section>
@endsection