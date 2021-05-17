@extends('admin.layouts.app')


@section('content-header')
	<h1>
		{!! $title ?? 'All Metas' !!} ({!! $metas->count() !!})
		&middot;
		<small>{!! link_to_route('admin.metas.create', 'Add New') !!}</small>
	</h1>
@stop

@section('content')
<div class="box col-lg-6">
	<div class="box-body table-responsive no-padding">
		<table class="table table-hover">
			<thead>
				<th>#</th>
				<th>Key</th>
				<th>Value</th>
				<th>Description</th>
				<th class="text-center">Action</th>
			</thead>
			<tbody>
				@foreach ($metas as $meta)
				<tr>
					<td>{!! $meta->id !!}</td>
					<td>{!! $meta->key !!}</td>
					<td>{{  strlen($meta->value) > 100 ? substr($meta->value,0,97).'...' : $meta->value  }}</td>
					<td>{!! $meta->description !!}</td>
					<td class="text-center">
						<a href="{!! route('admin.metas.edit', $meta->id) !!}">Edit</a>
						&middot;
						{{-- @include('admin.partials.modal', ['data' => $meta, 'name' => 'admin.metas.destroy']) --}}
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

<div class="text-center">
	{!! $metas->links() !!}
</div>
@stop
