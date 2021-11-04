@extends('layouts.app')


@section('title')
    {{ $page->name }} On Kabmart
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

        /*
        .category-nav {
        display: block !important;
        opacity: 1 !important;
        }
        */

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

        .nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
            border-bottom: inherit;
        }
    </style>

    @yield('sub-styles')
@endsection
@section('content')
    <!-- logo, search, myaccount -->
    @include('partials.header')
    <!-- logo, search, myaccount -->

    @include('partials.categories', ['showBreadCrumb' => true])


    @if($page->is_there_php)
        {{--And is a hack--}}
        {!! eval("?>".$page->content) !!}
    @else
        <div class="container">
            <div class="col-md-12 card">
                {!! $page->content !!}
            </div>
        </div>
    @endif

    @if(auth()->check())
        <div id="app">
            <chat-app :chat_data="chatAppData"></chat-app>
        </div>
        <audio id="message-notification" src="/assets/sounds/message-beep.mp3" autostart="false"></audio>
    @endif

@endsection

@section('scripts')
    @include('partials.chat-box-scripts')
@endsection