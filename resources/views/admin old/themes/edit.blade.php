@extends('admin.layouts.app')


@section('content-header')
	<h1>
		Edit
		&middot;
		<small>{!! link_to_route('admin.theme.index', 'Back') !!}</small>
	</h1>
@stop

@section('content')
	<div>
		@include('admin.themes.form', array('model' => $themeSetting))
	</div>

@stop
