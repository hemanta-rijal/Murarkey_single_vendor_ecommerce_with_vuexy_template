@extends('admin.layouts.app')


@section('content-header')
	<h1>
		{!! $title ?? 'All Featured Companies' !!} ({!! $companies->count() !!})
		&middot;
		<small>{!! link_to_route('admin.featured-companies.create', 'Add New') !!}</small>
	</h1>
@stop

@section('content')
<div class="box col-lg-6">
	<div class="box-body table-responsive no-padding">
		<table class="table table-hover">
			<thead>
				<th>#</th>
				<th>Name</th>
				<th>Weight</th>
				<th class="text-center">Action</th>
			</thead>
			<tbody>
				@foreach ($companies as $company)
				<tr>
					<td>{!! $company->id !!}</td>
					<td>{!! $company->name !!}</td>
					<td>{!! $company->weight !!}</td>
					<td class="text-center">
						<a href="{!! route('admin.featured-companies.edit', $company->id) !!}">Edit</a>
						&middot;
						@include('admin.partials.modal', ['data' => $company, 'name' => 'admin.featured-companies.destroy'])
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

<div class="text-center">
	{!! $companies->links() !!}
</div>
@stop
