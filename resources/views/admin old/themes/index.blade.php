@extends('admin.layouts.app')


@section('content-header')
	<h1>
		{!! $title ?? 'All themes' !!} ({!! $themes->count() !!})
		&middot;
		<small>{!! link_to_route('admin.theme.create', 'Add New') !!}</small>
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
				@foreach ($themes as $theme)
				<tr>
					<td>{!! $theme->id !!}</td>
					<td>{!! $theme->key !!}</td>
					<td>{{  strlen($theme->value) > 100 ? substr($theme->value,0,97).'...' : $theme->value  }}</td>
					<td>{!! $theme->description !!}</td>
					<td class="text-center">
						<a href="{!! route('admin.theme.edit', $theme->id) !!}">Edit</a>
						&middot;
						{{-- @include('admin.partials.modal', ['data' => $meta, 'name' => 'admin.themes.destroy']) --}}
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

<div class="text-center">
	{!! $themes->links() !!}
</div>
@stop
