@extends('operator.layouts.app')

@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Orders</h3>
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


                <div class=" col-lg-offset-1 col-md-1">
                    New Filter
                    <div class="dropdown" style="margin-right: 20px">
                        <a class="dropdown-toggle btn btn-default" data-toggle="dropdown" href="?">
                            {{ request('new_filter') ? strtoupper( request('new_filter') ): 'ALL' }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                       href="?{{ http_build_query(request()->except('new_filter')) }}">ALL</a>
                            </li>

                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                       href="?{{ http_build_query(array_merge(request()->except('new_filter'), ['new_filter' => 'empty']) ) }}">Empty AWB</a>
                            </li>

                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                       href="?{{ http_build_query(array_merge(request()->except('new_filter'), ['new_filter' => 'having']) ) }}">Having AWB</a>
                            </li>
                        </ul>
                    </div>
                </div>



                <div class=" col-lg-offset-1 col-md-1">
                    STATUS
                    <div class="dropdown" style="margin-right: 20px">
                        <a class="dropdown-toggle btn btn-default" data-toggle="dropdown" href="?">
                            {{ request('status') ? strtoupper( request('status') ): 'ALL' }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                       href="?{{ http_build_query(request()->except('status')) }}">ALL</a>
                            </li>
                            @foreach(\App\Models\OrderItem::ALL_ORDERS as $ORDER)
                                <li role="presentation"><a role="menuitem" tabindex="-1"
                                                           href="?{{ http_build_query(array_merge(request()->except('status'), ['status' => $ORDER])) }}">{{ strtoupper($ORDER) }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class=" col-lg-offset-1 col-md-1">
                    ORDER TYPE
                    <div class="dropdown" style="margin-right: 20px">
                        <a class="dropdown-toggle btn btn-default" data-toggle="dropdown" href="?">
                            {{ request('order_type') ? strtoupper( str_replace('_', ' ', request('order_type')) ): 'ALL' }}
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="?">ALL</a></li>

                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                       href="?{{ http_build_query(array_merge(request()->except('order_type'), ['order_type' => 'not_reconcile'])) }}">Not
                                    Reconcile</a></li>

                        </ul>
                    </div>
                </div>

                <div class="col-md-1">
                    <a class="btn btn-danger" href="?order_type=not_reconcile&endDate={{ \Carbon\Carbon::parse('4 days ago')->format('Y-m-d') }}">DANGER ORDERS</a>
                </div>

            </div>

            <div class="row">

                <div class="col-md-4">
                   SHIPPED DATE<a href="?{{ http_build_query(request()->except(['sStartDate', 'sEndDate'])) }}"
                                  class="btn btn-default" style="margin: 5px">Clear Range</a>
                    <div id="reportrange1"
                         style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;">
                        <i class="fa fa-calendar"></i>&nbsp;
                        <span></span> <i class="fa fa-caret-down"></i>
                    </div>
                </div>


            </div>
            {!! $dataTable->table()  !!}
        </div>
    </div>


    <div id="order-edit" class="modal text-left fade">
        <div class="modal-dialog">
            <div class="modal-content">

                {!! Form::open(['method' => 'POST', 'route' => 'operator.orders.store' ])!!}

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h1 class="modal-title">Edit Item <span id="span-order-id"></span></h1>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" value="" id="item-id">
                    <div class="form-group">
                        {!! Form::label('seller_order_no', 'Seller Order No:') !!}
                        {!! Form::text('seller_order_no', null, ['class' => 'form-control', 'required' => true, 'id' => 'item-oid']) !!}
                        {!! $errors->first('seller_order_no', '<div class="text-danger">:message</div>') !!}
                    </div>


                    <div class="form-group">
                        {!! Form::label('seller_awb_no', 'Seller Awb No:') !!}
                        {!! Form::text('seller_awb_no', null, ['class' => 'form-control', 'id' => 'item-sawb']) !!}
                        {!! $errors->first('seller_awb_no', '<div class="text-danger">:message</div>') !!}
                    </div>


                    <div class="form-group">
                        {!! Form::label('status', 'Status:') !!}
                        {!! Form::select("status", array_combine(\App\Models\OrderItem::ALL_ORDERS, \App\Models\OrderItem::ALL_ORDERS), null, ['class' => "form-control", 'id' => 'item-status']) !!}
                        {!! $errors->first('status', '<div class="text-danger">:message</div>') !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
                {!! Form::close() !!}
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

@endsection


@section('sub-scripts')

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>


    <script type="text/javascript">
        $(function () {

            var start = @if(request('startDate')) moment('{{ request('startDate') }}') @else undefined @endif;
            var end = @if(request('endDate')) moment('{{ request('endDate') }}') @else undefined @endif;


            var sStart = @if(request('sStartDate')) moment('{{ request('sStartDate') }}') @else undefined @endif;
            var sEnd = @if(request('sEndDate')) moment('{{ request('sEndDate') }}') @else undefined @endif;

            function cb(selector, start, end) {
                start = moment(start)
                end = moment(end)
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


            $('#reportrange1').daterangepicker({
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


            cb('#reportrange1 span', sStart, sEnd);


            $('#reportrange').on('apply.daterangepicker', function (ev, picker) {
                console.log(picker.startDate.format('YYYY-MM-DD'));
                console.log(picker.endDate.format('YYYY-MM-DD'));

                window.location.href = `?{!!  request('status') ? 'status='.request('status').'&' : '' !!}{!!  request('order_type') ? 'order_type='.request('order_type').'&' : '' !!}startDate=${picker.startDate.format('YYYY-MM-DD')}&endDate=${picker.endDate.format('YYYY-MM-DD')}`;
            });


            $('#reportrange1').on('apply.daterangepicker', function (ev, picker) {
                console.log(picker.startDate.format('YYYY-MM-DD'));
                console.log(picker.endDate.format('YYYY-MM-DD'));

                window.location.href = `?{{ http_build_query(request()->except(['sStartDate', 'sEndDate'])) }}&sStartDate=${picker.startDate.format('YYYY-MM-DD')}&sEndDate=${picker.endDate.format('YYYY-MM-DD')}`;
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

    <script>
        function openEditModal(id, soid, sawb, status) {
            $('#item-id').val(id)
            $('#item-oid').val(soid)
            $('#item-sawb').val(sawb)
            $('#item-status').val(status)

            $('#order-edit').modal('show')
            $('#span-order-id').html(id)
        }
    </script>
@endsection