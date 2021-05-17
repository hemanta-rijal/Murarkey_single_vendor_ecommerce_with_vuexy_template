@extends('layouts.app')

@section('title')
    {{ $company->name }} - Kabmart
@endsection

@section('styles')
    <style>
        /* shop by category */

        .category-toggle {
            -moz-border-radius-bottomleft: 0;
            -webkit-border-bottom-left-radius: 0;
            border-bottom-left-radius: 0;
            -moz-border-radius-bottomright: 0;
            -webkit-border-bottom-right-radius: 0;
            border-bottom-right-radius: 0;
            border: 1px solid transparent;
            font-size: 13px;
            font-weight: 800;
            background-color: #fff;
        }

        .category-toggle:hover + .category-nav {
            display: block;
        }

        .navbar-nav > li > .category-toggle {
            padding: 7px 10px 7px 0px;
        }

        .shop-by-category.open {
            border-bottom: 1px solid #DDD;
        }

        .shop-by-category.open .category-toggle {
            border-top: 1px solid #DDD;
            border-left: 1px solid #DDD;
            border-right: 1px solid #DDD;
        }
    </style>

    @yield('sub-styles')
@endsection

@section('content')
    <!-- logo, search, myaccount -->
    @include('partials.header')
    <!-- logo, search, myaccount -->

    @include('partials.categories', ['showBreadCrumb' => true])

    <section id="short_intro" class="m-b-0 m-t-20">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row side_fix dim_border">
                        <div class="col-md-2">
                            <img src="{!! $company->cropped_logo !!}" class="img-responsive"
                                 alt="Image" width="150">
                        </div>
                        <div class="col-md-10">
                            <h4 class="m-b-21">{!! $company->name !!}</h4>
                            <p class="black">Main Products: {!! $company->products !!}</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="product_search" class="p-t-20">
        <div class="container" id="company_page">
            <div class="row">
                <div class="col-md-12">
                    <!-- BASIC TAB -->
                    <ul class="nav nav-tabs" role="tablist" style="border: 1px solid #cecece;">
                        <li {!!   request()->is('companies/'.$company->slug) ? 'class="active"' : '' !!}><a
                                    href="{{ route('companies.show', $company->slug) }}">Home</a></li>
                        <li {!! request()->is('companies/'. $company->slug.'/products') ? 'class="active"' : '' !!}><a
                                    href="{{ route('companies.products', $company->slug) }}">All Products</a></li>
                        <li {!! request()->is('companies/'. $company->slug.'/info') ? 'class="active"' : '' !!}><a
                                    href="{{ route('companies.info', $company->slug) }}">Company Information</a></li>
                        <li {!! request()->is('companies/'. $company->slug.'/contact') ? 'class="active"' : '' !!}><a
                                    href="{{ route('companies.contact', $company->slug) }}">Contacts</a></li>

                        <div class="searchbox">
                            <form method="GET" action="{{ route('companies.products', $company->slug) }}">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control no_border_radius" placeholder="search ..."
                                           name="search" value="{{ request('search') }}">
                                        <span class="input-group-btn">
                                                <button class="btn btn-default" type="submit"><i
                                                            class="fa fa-search"></i></button>
                                            </span>
                                </div>
                            </form>
                        </div>


                    </ul>
                    <div class="tab-content">
                        <!--home tab-->
                        <div class="tab-pane fade in active">
                            @yield('sub-content')
                        </div>


                    </div>

                </div>


            </div>
            <!-- END BASIC TAB -->
        </div>

        @if(auth()->check() && !request()->is('companies/'.$company->slug.'/contact'))
            <div id="app">
                <chat-app :chat_data="chatAppData"></chat-app>
            </div>
            <audio id="message-notification" src="/assets/sounds/message-beep.mp3" autostart="false"></audio>
        @endif
    </section>
@endsection

@section('scripts')
    <script src="/assets/js/plugins/prettyphoto/jquery.prettyPhoto.min.js"></script>
    @yield('sub-scripts')
    @if(auth()->check() && !request()->is('companies/'.$company->slug.'/contact'))
        @include('partials.chat-box-scripts')
    @endif
@endsection