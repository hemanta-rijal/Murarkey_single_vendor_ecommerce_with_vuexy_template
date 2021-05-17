@extends('admin.layouts.app')


@section('content-header')
	<h1>
		Edit
		&middot;
		<small>{!! link_to_route('admin.location.states.index', 'Back') !!}</small>
	</h1>
@stop

@section('content')
	<div>
		@include('admin.location.states.form', array('model' => $state))
	</div>
@stop
