@extends('admin.layouts.app')

@section('content-header')

	<h1>
		Add New
		&middot;
		<small>{!! link_to_route('admin.flash-sales.index', 'Back') !!}</small>
	</h1>

@stop

@section('content')
	<div>
		@include('admin.flash-sales.create-form')
	</div>
@stop


@section('sub-scripts')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"
			type="text/javascript"></script>

	<script>
        $('#datetimepicker6').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#datetimepicker7').datetimepicker({
            useCurrent: false,
            format: 'YYYY-MM-DD'
        });
        $("#datetimepicker6").on("dp.change", function (e) {
            $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
        });
        $("#datetimepicker7").on("dp.change", function (e) {
            $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
        });
	</script>
@stop
