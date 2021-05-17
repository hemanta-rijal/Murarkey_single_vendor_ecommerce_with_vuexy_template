@extends('admin.layouts.app')


@section('content-header')
	<h1>
		Edit
		&middot;
		<small>{!! link_to_route('admin.featured-companies.index', 'Back') !!}</small>
	</h1>
@stop

@section('content')
	<div>
		@include('admin.homepage.featured-companies.edit-form', array('model' => $company))
	</div>

@stop
