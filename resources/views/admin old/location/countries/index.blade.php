@extends('admin.layouts.app')


@section('content-header')
	<h1>
		{!! $title ?? 'All Countries' !!} ({!! $countries->total() !!})
		&middot;
		<small>{!! link_to_route('admin.location.countries.create', 'Add New') !!}</small>
	</h1>
@stop

@section('content')
<div class="box col-lg-6">
	<div class="box-body table-responsive no-padding">
		<form id="search-form">
			<div class="col-lg-4">
				<div class="input-group">
					<input id="search-input-field" type="text" name="search" class="form-control"
						   placeholder="Search for..."
						   value="{{ request()->search }}"
						   onkeypress="if(event.keyCode == 13) { document.getElementById('search-form').submit() }">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button"><i
					class="fa fa-search"></i></button>
      </span>
				</div><!-- /input-group -->
			</div><!-- /.col-lg-6 -->
		</form>
		<table class="table table-hover">
			<thead>
				<th>#</th>
				<th>Name</th>
				<th>Short Name</th>
				<th>Phone Code</th>
				<th class="text-center">Action</th>
			</thead>
			<tbody>
				@foreach ($countries as $country)
				<tr>
					<td>{!! $country->id !!}</td>
					<td>{!! $country->name !!}</td>
					<td>{{  $country->sortname }}</td>
					<td>{{ $country->phonecode }}</td>
					<td class="text-center">
						<a href="{!! route('admin.location.countries.edit', $country->id) !!}">Edit</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

<div class="text-center">
	{!! $countries->links() !!}
</div>
@stop
