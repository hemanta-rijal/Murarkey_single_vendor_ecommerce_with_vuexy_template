@extends('user.company.layout')

@section('sub-styles')
    <style>
        #logo_photo {
            width: 100%;
            /*height: 120px;*/
            display: inline-block;
            border: 1px solid #aaa;
        }

        #cover_photo {
            width: 100%;
            /*height: 300px;*/
            display: inline-block;
            border: 1px solid #aaa;
        }

        .company_photo {
            width: 100%;
            /*height: 300px;*/
            display: inline-block;
            border: 1px solid #aaa;
        }
    </style>
@endsection
@section('sub-sub-content')

    <div class="prod_side_box_top p-l-15 p-t-15">
        <div class="row m-r-0">
            <div class="col-md-3">
                <h3 class="col_title p-t-50 f-s-17">Logo</h3>
                <div class="can_drag headerimage" id="logo_photo">
                    <img src="{!! $company->cropped_logo !!}">
                </div>
            </div>
        </div>

        <div class="row m-r-0">
            <div class="col-md-12">
                <h3 class="col_title p-t-50 f-s-17">Cover Photo</h3>
                <div class="headerimage no_photo_fix" id="cover_photo">
                    <img class="img img-responsive" src="{{ $company->cover_photo->cropped_image_url }}" width="">
                </div>
            </div>
        </div>
        <div class="row m-r-0">
            <h3 class="col_title p-t-50 f-s-17 p-l-15">Company Photos</h3>
        </div>

        @foreach($company->company_photos->chunk(3) as $photoList)
            <div class="row m-r-0 m-b-20">

                @foreach($photoList as $photo)
                    <div class="col-md-4 col-sm-6 {!! $loop->index > 2 ? 'm-r-0 m-t-10' : ''!!}">
                        <div class="company_photo headerimage" id="company_photo1">
                            <img class="img img-responsive" src="{{ $photo->cropped_image_url }}" style="width:100%">
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach


        <div class="row m-r-0 m-b-40">
            <div class="col-md-12">
                <h3 class="col_title p-t-50 f-s-17">Company Description</h3>
                <p class="black">

                    {!! $company->description !!}

                </p>
                <a href="/user/company/logo-photos/edit" class="btn cs_btn pull-right m-0"
                   style="padding: 6px 18px;">Edit</a>
                <div class="clearfix"></div>
            </div>
        </div>

    </div>
@endsection