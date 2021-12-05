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
            <div class="brands-grid">
                @foreach($brands as $brand)
                <div><a href="{{route('products.search','brand='.$brand->slug)}}"> <img src="{{resize_image_url($brand->image,'500X394')}}" alt="">
                        <p>{!! $brand->name !!} <span>({{$brand->products->count()}})</span></p>
                    </a></div>
                @endforeach
            </div>
        </div>
    </section>

    <!--  -->

@endsection
