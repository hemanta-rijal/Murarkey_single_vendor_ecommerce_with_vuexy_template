@extends('admin.layouts.app')


@section('content-header')
	<h1>
		Edit
		&middot;
		<small>{!! link_to_route('admin.sliders.index', 'Back') !!}</small>
	</h1>
@stop

@section('content')
	<div>
		@include('admin.sliders.form', array('model' => $slide))
	</div>

@stop
