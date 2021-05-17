@extends('admin.layouts.app')


@section('content-header')
	<h1>
		Edit
		&middot;
		<small>{!! link_to_route('admin.location.cities.index', 'Back') !!}</small>
	</h1>
@stop

@section('content')
	<div>
		@include('admin.location.cities.form', array('model' => $city))
	</div>
@stop
