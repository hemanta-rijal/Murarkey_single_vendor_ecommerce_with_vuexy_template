@extends('admin.layouts.app')

@section('content-header')
	<h1>
		{!! $title ?? 'All Slides' !!} ({!! $slides->count() !!})
		&middot;
		<small>{!! link_to_route('admin.sliders.create', 'Add New') !!}</small>
	</h1>
@stop

@section('content')
<div class="box col-lg-6">
	<div class="box-body table-responsive no-padding">
		<table class="table table-hover">
			<thead>
				<th>#</th>
				<th>Image</th>
				<th>Weight</th>
				<th>Link</th>
				<th>Caption</th>
				<th class="text-center">Action</th>
			</thead>
			<tbody>
				@foreach ($slides as $slide)
				<tr>
					<td>{!! $slide->id !!}</td>
					<td><a href="{!! map_storage_path_to_link($slide->image) !!}"><img src="{!! map_storage_path_to_link($slide->image) !!}" width="75" height="75"></a></td>
					<td>{!! $slide->weight !!}</td>
					<td>{!! $slide->link !!}</td>
					<td>{!! $slide->caption !!}</td>
					<td class="text-center">
						<a href="{!! route('admin.sliders.edit', $slide->id) !!}">Edit</a>
						&middot;
						@include('admin.partials.modal', ['data' => $slide, 'name' => 'admin.sliders.destroy'])
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

<div class="text-center">
	{!! $slides->links() !!}
</div>
@stop
