@extends('admin.layouts.app')


@section('content-header')
	<h1>
		{!! $title ?? 'All Area Code' !!} ({!! $areaCodes->total() !!})
		&middot;
		<small>{!! link_to_route('admin.location.area-code.create', 'Add New') !!}</small>
	</h1>
	<p class="help-block">Currently this feature is only available for Philippines</p>
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
				<th>Area Code</th>
				<th class="text-center">Action</th>
			</thead>
			<tbody>
				@foreach ($areaCodes as $areaCode)
				<tr>
					<td>{!! $areaCode->id !!}</td>
					<td>{!! $areaCode->area_code !!}</td>
					<td class="text-center">
						<a href="{!! route('admin.location.area-code.edit', $areaCode->id) !!}">Edit</a>
						&middot;
						@include('admin.partials.modal', ['data' => $areaCode, 'name' => 'admin.location.area-code.destroy'])
					</td>

				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

<div class="text-center">
	{!! $areaCodes->links() !!}
</div>
@stop
