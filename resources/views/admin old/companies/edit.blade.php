@extends('admin.layouts.app')


@section('content-header')
	<h1>
		Edit
		&middot;
		<small>{!! link_to_route('admin.companies.index', 'Back') !!}</small>
	</h1>
@stop

@section('content')
	<div>
		@include('admin.companies.form', array('model' => $company))
	</div>

@stop

@section('scripts')
	<script src="/assets/js/location.js"></script>
@endsection
