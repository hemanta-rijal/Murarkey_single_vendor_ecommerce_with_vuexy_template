@extends('admin.layouts.app')

@section('content-header')

	<h1>
		Add New
		&middot;
		<small>{!! link_to_route('admin.featured-companies.index', 'Back') !!}</small>
	</h1>

@stop

@section('content')
	<div>
		@include('admin.homepage.featured-companies.create-form')
	</div>
@stop
