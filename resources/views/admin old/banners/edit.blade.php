@extends('admin.layouts.app')


@section('content-header')
	<h1>
		Edit
		&middot;
		<small>{!! link_to_route('admin.banners.index', 'Back') !!}</small>
	</h1>
@stop

@section('content')
	<div>
		@include('admin.banners.form', array('model' => $banner))
	</div>

@stop
