@extends('operator.layouts.app')

@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Not Found AWB</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                    DATE RANGE <a href="?{{ request('status') ? 'status='.request('status') : '' }}"
                                  class="btn btn-default" style="margin: 5px">Clear Range</a>
                    <div id="reportrange"
                         style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">
                        <i class="fa fa-calendar"></i>&nbsp;
                        <span></span> <i class="fa fa-caret-down"></i>
                    </div>
                </div>
            </div>
            {!! $dataTable->table()  !!}
        </div>
    </div>
@endsection


@section('sub-scripts')

    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>


    <script type="text/javascript">
        $(function () {

            var start = @if(request('startDate')) moment('{{ request('startDate') }}')
            @else undefined @endif;
            var end = @if(request('endDate')) moment('{{ request('endDate') }}')
            @else undefined @endif;


            function cb(selector, start, end) {
                $(selector).html(start && end ? start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY') : (end ? '4 days ago' : 'ALL'));
            }

            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Before 4 days': [moment('1970-1-1'), moment().subtract(4, 'days')],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, cb);

            cb('#reportrange span', start, end);


            $('#reportrange').on('apply.daterangepicker', function (ev, picker) {
                console.log(picker.startDate.format('YYYY-MM-DD'));
                console.log(picker.endDate.format('YYYY-MM-DD'));

                window.location.href = `?{!!  request('status') ? 'status='.request('status').'&' : '' !!}{!!  request('order_type') ? 'order_type='.request('order_type').'&' : '' !!}startDate=${picker.startDate.format('YYYY-MM-DD')}&endDate=${picker.endDate.format('YYYY-MM-DD')}`;
            });
        });
    </script>


    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap.min.css">
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.bootstrap.min.css">
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.bootstrap.min.js"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>

    <script>
        $.extend(true, $.fn.dataTable.defaults, {
            dom: '<"row buttons-container"<"col-sm-12"B>>' + $.fn.dataTable.defaults.dom,
            buttons: []
        });
    </script>

    {!! $dataTable->scripts() !!}

    <style>
        .dt-buttons {
            float: right;
            margin-bottom: 5px;
        }
    </style>
@endsection