@extends('frontend.layouts.app')
@section('meta')

@endsection
@section('body')

    @if($parlours!=null)
        <!-- --------- Shop Listing---------- -->
        <section class="shop-listing">
            <div class="container">
                <div class="row">
                    <div class="section-title pb-2">
                        <h2>Popular Parlours</h2>
                    </div>
                    <div class="d-flex justify-content-end h-100">
                        <!-- Search form -->
                        <form method="get" class="form-inline my-2 my-lg-0">
                            <input class="form-control mr-sm-2" name="name" type="search" placeholder="Name"
                                   aria-label="Search" value="{{request()->name}}">
                            <input class="form-control mr-sm-2" name="address" type="search" placeholder="Address"
                                   aria-label="Search" value="{{request()->address}}">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        </form>
                    </div>
                </div>


                <div class="row">
                    @foreach($parlours as $parlor)
                        <div class="col-md-3 col-sm-6">
                            <div class="card">
                                <a href="{{route('parlourInfo',$parlor->slug)}}" class="img-box">
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


