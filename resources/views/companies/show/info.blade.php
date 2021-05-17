@extends('companies.show.layout')
@section('sub-content')

    <div class="tab_filter_box p-t-25 bg_white">
        <div class="row">
            <div class="col-md-12">
                <h4 class="m-b-25">Company Information</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="left_box">

                    <div id="product-images" class="carousel slide product-images" data-ride="carousel"
                         data-interval="false">
                        <div class="carousel-inner">
                            @foreach($company->formated_company_photos as $photo)
                                <div class="item {{ $loop->first ? 'active' : '' }}">
                                    <a href="{!! $photo->cropped_image_url !!}"
                                       rel="gallery[pp_gal]"><img
                                                src="{!! $photo->cropped_image_url !!}"
                                                class="img-responsive" alt="Product Image"></a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div id="product-image-thumbnails" class="carousel slide product-image-thumbnails"
                         data-interval="false">
                        <div class="carousel-inner">

                            @foreach($company->formated_company_photos->chunk(4) as $photoList)
                                <div class="item {{ $loop->first ? 'active' : '' }}">
                                    @foreach($photoList as $photo)
                                        <div data-target="#product-images"
                                             data-slide-to="{{ $loop->parent->index * 4 + $loop->index   }}"
                                             class="thumb">
                                            <img src="{{ resize_image_url($photo->raw_cropped_path, '100X100') }}"
                                                 alt="Product Image"></div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                        <a href="#product-image-thumbnails" class="left carousel-control" data-role="button"
                           data-slide="prev">
                            <i class="fa fa-chevron-left"></i>
                        </a>
                        <a href="#product-image-thumbnails" class="right carousel-control" data-role="button"
                           data-slide="next">
                            <i class="fa fa-chevron-right"></i>
                        </a>
                    </div>


                </div>

            </div>
            <div class="col-md-7">
                <h4 class="m-b-20">{{ $company->name }}</h4>
                @if($company->description)
                    {!! $company->description !!}
                @else
                    <div class="blank-company-description">
                        This Company has not yet written a description
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="tab_filter_box p-t-25 bg_white">
        <div class="row">
            <div class="col-md-12">
                <h4 class="m-b-25 m-t-15">More Information</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-responsive table-bordered">
                    <tbody>
                    <tr>
                        <td>Company Name</td>
                        <td><span class="black"> {{ $company->name }}</span></td>
                    </tr>
                    <tr>
                        <td>Year Established</td>
                        <td><span class="black"> {{ $company->established_year }}</span></td>
                    </tr>
                    <tr>
                        <td>Business Type</td>
                        <td><span class="black"> {{ $company->formated_business_type }}</span></td>
                    </tr>
                    <tr>
                        <td>Main Products</td>
                        <td><span class="black"> {{ $company->products }}</span></td>
                    </tr>
                    <tr>
                        <td>Main Operation Address</td>
                        <td><span class="black"> {{ $company->operational_address }}</span></td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td><span class="black"> {{ $company->city_obj->name }}</span></td>
                    </tr>
                    <tr>
                        <td>Province</td>
                        <td><span class="black"> {{ $company->province_obj->name }}</span></td>
                    </tr>
                    <tr>
                        <td>Country</td>
                        <td><span class="black"> {{ $company->country->name }}</span></td>
                    </tr>

                    @if($company->website)
                        <tr>
                            <td>Company Address Website</td>
                            <td><span class="black"> {{ $company->website }}</span></td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection