@extends('admin.layouts.app')

@section('content-header')
	<h1>
		{!! $title ?? 'All Banners' !!} ({!! $banners->count() !!})
		&middot;
		<small>{!! link_to_route('admin.banners.create', 'Add New') !!}</small>
	</h1>
@stop

@section('content')
<div class="box col-lg-6">
	<div class="box-body table-responsive no-padding">
		<table class="table table-hover">
			<thead>
				<th>#</th>
				<th>Name</th>
				<th>Type</th>
				<th>Link</th>
				<th>Image</th>
				<th>Weight</th>
				<th class="text-center">Action</th>
			</thead>
			<tbody>
				@foreach ($banners as $banner)
				<tr>
					<td>{!! $banner->id !!}</td>
					<td>{!! $banner->name !!}</td>
					<td>{!! $banner->slug !!}</td>
					<td>{!! $banner->link !!}</td>
					<td><a href="{!! map_storage_path_to_link($banner->image) !!}"><img src="{!! map_storage_path_to_link($banner->image) !!}" width="75" height="75"></a></td>
					<td>{!! $banner->weight !!}</td>
					<td class="text-center">
						<a href="{!! route('admin.banners.edit', $banner->id) !!}">Edit</a>
						&middot;
						@include('admin.partials.modal', ['data' => $banner, 'name' => 'admin.banners.destroy'])
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

<div class="text-center">
	{!! $banners->links() !!}
</div>
@stop
