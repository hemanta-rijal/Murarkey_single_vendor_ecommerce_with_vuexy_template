@extends('layouts.app')
@section('styles')

@endsection
@section('title')
    Sales
@endsection
<style>
    .product-item {
        padding: 0px 2px !important;
    }
</style>

@section('content')
    <!-- logo, search, myaccount -->
    @include('partials.header')


    <section id="pum_categ_drop" class="m-b-0">

        <div class="shop-header">
            <div class="bottom-header">
                <div class="container">
                    <div class="row">

                        <div class="col-md-2 hidden-xs">
                            @include('partials.new-categories-layout')

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if ($flashSales)
        @foreach($flashSales as $flashSale)
            <div class="container">
                <div class="section m-t-20">
                    <div class="clearfix"></div>
                    <h3 class="compo_section_title" style="display: inline-block;">{{ $flashSale->title }}</h3>
                    <span class="pull-right"></span>
                    <div class="col-md-12 salescounter m-t-5">
                        <div class="clockdiv" id="clockdiv-{{ $flashSale->id }}">
                            <div>
                                <span class="days"></span>
                                <div class="smalltext">Days</div>
                            </div>
                            <div>
                                <span class="hours"></span>
                                <div class="smalltext">Hours</div>
                            </div>
                            <div>
                                <span class="minutes"></span>
                                <div class="smalltext">Minutes</div>
                            </div>
                            <div>
                                <span class="seconds"></span>
                                <div class="smalltext">Seconds</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 m-b-20" style="background-color: white;">

                        @foreach($flashSale->items  as $item)
                            <div class="product-item col-md-2 col-xs-6 ">
                                <div class="product">
                                    <div class="product-img">
                                        <a href="{{ route('products.show', $item->product->slug) }}"> <img
                                                    src="{{ resize_image_url($item->product->images->first()->image, '200X200') }}"
                                                    class="img img-responsive"
                                            ></a>
                                    </div>

                                    <div class="product-info" style="background: white;width:180px;height:48px;">
                                        <a href="{{ route('products.show', $item->product->slug) }}">
                                            <p style="margin-left:5px;padding:5px;line-height: 16px;">{{ str_limit($item->product->name , 44) }}</p>
                                        </a>
                                    </div>
                                    <p class="m-l-5 m-b-0 productprice">Rs. {{ $item->product->discount_price }} </p>
                                    <p class="m-l-5"><span
                                                class="m-r-10 productdiscountprice"><strike>Rs. {{ $item->product->price }}</strike></span>- {{ $item->product->discount_percentage }}
                                        %
                                    </p>
                                </div>
                            </div>
                        @endforeach


                    </div>
                </div>
            </div>
        @endforeach
    @endif


@endsection

@section('scripts')
    @include('partials.chat-box-scripts')
    <script src="/assets/js/deadline.js"></script>

    @if ($flashSales)
        @foreach($flashSales as $flashSale)
            <script>
                $(document).ready(function () {
                    var deadline = new Date({{ $flashSale->end_time->timestamp * 1000 }});
                    initializeClock('clockdiv-{{ $flashSale->id }}', deadline);
                })
            </script>
        @endforeach
    @endif
@endsection
