@extends('admin.layouts.app')

@section('content')

    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            {!! Menu::render() !!}
        </div>
    </div>



@endsection

@section('js')
    {!! Menu::scripts() !!}
@endsection