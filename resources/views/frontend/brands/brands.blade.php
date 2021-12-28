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
                    <input class="form-control mr-sm-2" name="name" type="search" placeholder="Search" aria-label="Search" value="{{request()->name}}" >
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>


            <div class="brands-grid">
                @foreach($brands as $brand)
                    <div><a href="{{route('products.search','brand='.$brand->slug)}}"> <img
                                    src="{{resize_image_url($brand->image,'500X394')}}" alt="">
                            <p>{!! $brand->name !!} <span>({{$brand->products->count()}})</span></p>
                        </a></div>
                @endforeach

            </div>
            <div class="d-flex">
                <div class="mx-auto">
                    {!! $brands->links('vendor.pagination.bootstrap-4') !!}
                </div>
            </div>
        </div>
    </section>

    <!--  -->

@endsection
