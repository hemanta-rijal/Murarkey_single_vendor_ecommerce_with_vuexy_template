@extends('frontend.layouts.app')
@section('meta')
    @include('frontend.partials.ogForIndexPage')
@endsection
@section('body')
    @include('flash::message')
    <!--  -->
    <section class="brands-page">
        <div class="container">
            <div class="section-title mt-3">
                <h2>Our Brands</h2>
            </div>
            <div class="d-flex justify-content-end h-100">
                <!-- Search form -->
                <form method="get" class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" name="name" type="search" placeholder="Search"
                           aria-label="Search" value="{{request()->name}}">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>

            @if($brands->count()>0)
                <div class="brands-grid">
                    @foreach($brands as $brand)
                        <div><a href="{{route('products.search','brand='.$brand->slug)}}"> <img
                                        src="{{resize_image_url($brand->image,'500X394')}}" alt="">
                                <p>{!! $brand->name !!} <span>({{$brand->products->count()}})</span></p>
                            </a></div>
                    @endforeach
                </div>
            @else

                <div class="container d-flex justify-content-center">
                    <div class="card shaodw-lg card-1">
                        <div class="card-body d-flex pt-0">
                            <div class="row no-gutters mx-auto justify-content-start flex-sm-row flex-column">
                                <div class="col-md-3 text-center"><img class="irc_mi img-fluid mr-0" src="{{URL::asset('frontend/img/sad.png')}}" width="150" height="150"></div>
                                <div class="col-md-9 ">
                                    <div class="card border-0 ">
                                        <div class="card-body">
                                            <h5 class="card-title "><b> Sorry! Brands not available.</b></h5>
                                            <p class="card-text ">
                                            <p>No brand found with this request</p>
                                            </p>
                                            <a href="{{route('products.search')}}" class="btn btn-primary btn-round-lg btn-lg"> Continue Shopping </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            @endif
            <div class="d-flex">
                <div class="mx-auto">
                    {!! $brands->links('vendor.pagination.bootstrap-4') !!}
                </div>
            </div>
        </div>
    </section>

    <!--  -->

@endsection
