@extends('admin.layouts.app')


@section('content-header')
	<h1>
		Edit
		&middot;
		<small>{!! link_to_route('admin.flash-sales.index', 'Back') !!}</small>
	</h1>
@stop

@section('content')
	<div>
		@include('admin.flash-sales.edit-form', array('model' => $flashSale))
	</div>

@stop
