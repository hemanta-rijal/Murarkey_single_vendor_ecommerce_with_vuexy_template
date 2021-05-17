@extends('admin.layouts.app')


@section('content-header')
	<h1>
		{!! $title ?? 'All Featured Categories' !!} ({!! $categories->count() !!})
		&middot;
		<small>{!! link_to_route('admin.featured-categories.create', 'Add New') !!}</small>
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
				@foreach ($categories as $category)
				<tr>
					<td>{!! $category->id !!}</td>
					<td>{!! $category->name !!}</td>
					<td>{!! $category->weight !!}</td>
					<td class="text-center">
						<a href="{!! route('admin.featured-categories.edit', $category->id) !!}">Edit</a>
						&middot;
						@include('admin.partials.modal', ['data' => $category, 'name' => 'admin.featured-categories.destroy'])
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

<div class="text-center">
	{!! $categories->links() !!}
</div>
@stop
