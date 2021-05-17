@extends('admin.layouts.app')

@section('content-header')

	<h1>
		Add New
		&middot;
		<small>{!! link_to_route('admin.theme.index', 'Back') !!}</small>
	</h1>

@stop

@section('content')
	<div>
		@include('admin.themes.form')
	</div>
@stop
