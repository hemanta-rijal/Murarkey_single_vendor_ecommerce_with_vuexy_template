@extends('admin.layouts.app')

@section('styles')

    {{--<link href="/assets/css/kabmart.css" rel="stylesheet" type="text/css">--}}
    <link href="/assets/css/mixins.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/styles.css" rel="stylesheet" type="text/css">
@endsection

@section('content-header')
    <h1>
        Post new Product
        &middot;
        <small>{!! link_to_route('admin.products.index', 'Back') !!}</small>
    </h1>
@stop

@section('content')
    <div>
        @include('user.products.form', ['userType' => 'admin'])
    </div>
@stop



@section('scripts')
    <script src="/assets/js/location.js"></script>
@endsection

