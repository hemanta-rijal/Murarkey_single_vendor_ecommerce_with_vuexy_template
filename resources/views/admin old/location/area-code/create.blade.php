@extends('admin.layouts.app')

@section('content-header')

	<h1>
		Add New
		&middot;
		<small>{!! link_to_route('admin.location.area-code.index', 'Back') !!}</small>
	</h1>

@stop

@section('content')
	<div>
		@include('admin.location.area-code.form')
	</div>
@stop
