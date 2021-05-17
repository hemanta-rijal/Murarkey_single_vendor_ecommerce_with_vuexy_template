@extends('admin.layouts.app')

@section('content-header')

	<h1>
		Add New
		&middot;
		<small>{!! link_to_route('admin.featured-categories.index', 'Back') !!}</small>
	</h1>

@stop

@section('content')
	<div>
		@include('admin.homepage.featured-categories.create-form')
	</div>
@stop
