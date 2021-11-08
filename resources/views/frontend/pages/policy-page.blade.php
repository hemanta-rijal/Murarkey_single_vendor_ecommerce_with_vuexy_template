@extends('frontend.layouts.app')
@section('body')
	{{ dd($policy) }}
	@include('flash::message')
	<div class="container py-5 sitemap">
		{!! $policy !!}
	</div>

@endsection
