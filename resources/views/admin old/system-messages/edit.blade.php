@extends('admin.layouts.app')


@section('content-header')
	<h1>
		Edit
		&middot;
		<small>{!! link_to_route('admin.system-messages.index', 'Back') !!}</small>
	</h1>
@stop

@section('content')
	<div>
		@include('admin.system-messages.form', ['model' => $message])
	</div>

@stop
