@extends('admin.layouts.app')


@section('content-header')
	<h1>
		{!! $title ?? 'All System Messages' !!} ({!! $messages->count() !!})
		&middot;
		<small>{!! link_to_route('admin.system-messages.create', 'Add New') !!}</small>
	</h1>
@stop

@section('content')
<div class="box col-lg-6">
	<div class="box-body table-responsive no-padding">
		<table class="table table-hover">
			<thead>
				<th>#</th>
				<th>From</th>
				<th>For Role</th>
				<th>Text</th>
				<th>Subject</th>
				<th class="text-center">Action</th>
			</thead>
			<tbody>
				@foreach ($messages as $message)
				<tr>
					<td>{!! $message->id !!}</td>
					<td>{!! $message->sender->name !!}</td>
					<td>{!! $message->for_role !!}</td>
					<td>{!! strlen($message->text) > 100 ? substr($message->text,0,97).'...' : $message->text  !!}</td>
					<td>{!! $message->subject !!}</td>
					<td class="text-center">
						<a href="{!! route('admin.system-messages.edit', $message->id) !!}">Edit</a>
						&middot;
						@include('admin.partials.modal', ['data' => $message, 'name' => 'admin.system-messages.destroy'])
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

<div class="text-center">
	{!! $messages->links() !!}
</div>
@stop
