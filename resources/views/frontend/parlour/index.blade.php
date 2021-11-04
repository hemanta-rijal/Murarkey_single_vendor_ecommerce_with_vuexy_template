@extends('frontend.layouts.app')
@section('meta')

@endsection
@section('body')

    @if($parlours!=null)
        <!-- --------- Shop Listing---------- -->
        <section class="shop-listing">
            <div class="container">
                <div class="section-title pb-2">
                    <h2>Popular Parlours</h2>
                </div>

                <div class="row">
                    @foreach($parlours as $parlor)
                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <a href="{{route('parlourInfo',$parlor->slug)}}" class="img-box">
                                    {{-- <img src="{{map_storage_path_to_link($parlor->feature_image)}}" alt="{{$parlor->name}}"> --}}
                                    <img src="{{resize_image_url($parlor->feature_image,'200X200')}}"
                                         alt="{{$parlor->name}}">
                                </a>
                                <div class="card-body">
                                    <h3><a href="{{route('parlourInfo',$parlor->slug)}}">
                                            {{$parlor->name}}
                                        </a></h3>
                                    <p>{{$parlor->address}}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>
        <!-- --------- Shop Listing---------- -->

    @endif
@endsection


