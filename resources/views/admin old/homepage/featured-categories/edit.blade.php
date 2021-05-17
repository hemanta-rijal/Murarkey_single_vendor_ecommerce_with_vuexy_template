@extends('admin.layouts.app')


@section('content-header')
	<h1>
		Edit
		&middot;
		<small>{!! link_to_route('admin.featured-categories.index', 'Back') !!}</small>
	</h1>
@stop

@section('content')
	<div>
		@include('admin.homepage.featured-categories.edit-form', array('model' => $category))
	</div>

@stop
