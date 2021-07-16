@extends('frontend.layouts.app')
@section('body')

@include('flash::message')
 <div class="container py-5 sitemap">
        {!! $policy !!}
    </div>

@endsection
