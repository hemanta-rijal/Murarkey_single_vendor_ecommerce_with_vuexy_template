@extends('companies.show.layout')
@section('sub-content')
    <div class="tab_filter_box p-t-25 bg_white">
        <div class="row">
            <div class="col-md-12">
                <div class="company_cover_photo">
                    <img src="{!! $company->cover_photo->cropped_image_url  !!}"
                         alt=""
                         class="img img-responsive">
                </div>
            </div>
        </div>
    </div>
    <div class="tab_filter_box p-t-25 m-t-20 dim_border bg_white" style="border-top:1px solid #cecece;">
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
        <div class="viewe_more my_flex">
            <a href="{{ route('companies.info', $company->slug) }}" class="btn pcolor_bg">View More Info</a>
        </div>
    </div>
    <div class="tab_filter_box bg_white m-t-20" style="border-top:1px solid #cecece;">
        <div class="feat_compo newly_added m-b-30">
            <h3 class="compo_section_title" style="">Products Showcase</h3>

            <div class="product-carousel">
                @foreach($company->featured_products as $product)
                    <div class="product-item">

                        <div class="feat_compo_a">
                            <div class="feat_item" style="">

                                <div class="dreamz-team">
                                    <div class="pic">
                                        <a href="{{ route('products.show', $product->slug) }}"><img
                                                    src="{{ resize_image_url($product->images->first()->image, '200X200') }}"
                                                    alt="{{ $product->name }}"></a>
                                        <div class="social_media_team">
                                            <ul class="team_social">
                                                <a href="{{ route('products.show', $product->slug) }}"
                                                   class="btn btn-danger pcolor_bg">View detail</a>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="feat_item_det">
                                    <a href=""><h4 class="text-center">{{ $product->name }}</h4></a>
                                    <p class="text-center">Rs. {{ $product->price }} / {{ $product->unit_type }}
                                        {{ $product->unit_type }}</p>
                                </div>

                            </div>
                        </div>


                    </div>
                @endforeach
            </div>
            <div class="viewe_more my_flex">
                <a href="{{ route('companies.products', $company->slug) }}" class="btn pcolor_bg m-t-15 m-b-0">View All
                    Products</a>
            </div>
        </div>
        <!--newly Added products-->

    </div>
@endsection