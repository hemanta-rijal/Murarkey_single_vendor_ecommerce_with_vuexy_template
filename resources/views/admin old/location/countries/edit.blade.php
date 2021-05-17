@extends('admin.layouts.app')


@section('content-header')
	<h1>
		Edit
		&middot;
		<small>{!! link_to_route('admin.location.countries.index', 'Back') !!}</small>
	</h1>
@stop

@section('content')
	<div>
		@include('admin.location.countries.form', array('model' => $country))
	</div>
@stop
