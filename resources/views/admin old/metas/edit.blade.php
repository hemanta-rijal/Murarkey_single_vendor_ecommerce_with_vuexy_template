@extends('admin.layouts.app')


@section('content-header')
	<h1>
		Edit
		&middot;
		<small>{!! link_to_route('admin.metas.index', 'Back') !!}</small>
	</h1>
@stop

@section('content')
	<div>
		@include('admin.metas.form', array('model' => $meta))
	</div>

@stop
