@extends('user.layout')

@section('sub-styles')
    <style type="text/css">

        .fa-sort {
            cursor: pointer;
        }

        .go_btn {
            height: 25px;
            border: 1px solid #cecece;
            padding: 2px 8px;
            background: #eeeeee;
            border-radius: 0;
            margin-left: 9px;
        }

        .active-li-link {
            color: coral;
            font-weight: bold;
        }

        .modal-header {
            border-bottom: 0px;
        }

        .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
            border: 0px;
        }

        thead {
            background: #e3eaf2;
        }


    </style>

@endsection

@section('sub-content')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css"
          rel='stylesheet' type='text/css'>


    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/v/dt/jq-2.2.4/dt-1.10.13/datatables.min.css"/>

    <div class="tab_filter_box p-0 bg_white">
        <div class="prod_side_box_top p-l-15 p-t-15">
            <div class="row">
                <div class="col-md-7">
                    <ul class="p-t-10 prod_links display_inline p-l-0">
                        <b>Order Status</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        <li class="{{ ! request('status') ? 'active-li-link' : '' }}"><a
                                    href="?{{ http_build_query(request()->except('page', 'status')) }}">All</a></li>

                        @foreach(\App\Models\OrderItem::ALL_ORDERS as $status)
                            <li class="{{ request('status') == $status ? 'active-li-link' : '' }}"><a
                                        href="?{{ http_build_query(array_merge(request()->except('page'), ['status' => $status])) }}">{{ ucfirst($status) }} </a>
                            </li>
                        @endforeach
                    </ul>

                    <ul class="p-t-10 prod_links display_inline p-l-0">
                        <b>Payment Method</b>&nbsp;&nbsp;
                        <li class="{{ ! request('pm') ? 'active-li-link' : '' }}"><a
                                    href="?{{ http_build_query(request()->except('page', 'pm')) }}">All</a></li>

                        @foreach(\App\Models\Order::PAYMENT_METHOD as $pm)
                            <li class="{{ request('pm') == $pm ? 'active-li-link' : '' }}"><a
                                        href="?{{ http_build_query(array_merge(request()->except('page'), ['pm' => $pm])) }}">{{ strtoupper($pm) }} </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-5">
                    <div class="searchbox">
                        <form method="GET">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control no_border_radius" value="{{ request()->search }}"
                                       placeholder="Please Enter a Product Name" name="search">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                            </span>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-12 m-t-10">
                        <button type="button" class="btn btn-warning pull-right" data-toggle="modal" data-target="#csv">
                            CSV
                        </button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                </div>
            </div>
        </div>
        <div class="prod_side_box_bottom p-12 m-t-15">
            <div class="row">
                <div class="col-md-6">
                </div>
                <div class="col-md-6">
                    <div class="flex_end">
                        <a href="{{ $orders->appends(request()->all())->previousPageUrl() }}"
                           class="color_inherit m-r-10"><i class="fa fa-angle-left "></i></a>
                        <a href="#" class="color_inherit coral">{{ $orders->currentPage() }}</a>
                        <p class="m-b-0 m-l-10 m-r-10">/</p>
                        <a href="#" class="color_inherit">{{ $orders->lastPage() }}</a>
                        <a href="{{ $orders->appends(request()->all())->nextPageUrl() }}"
                           class="color_inherit m-l-10"><i class="fa fa-angle-right"></i></a>
                    </div>
                </div>
            </div>


            <div class="pum_table_wrapper">
                <div class="table-responsive">
                    <table class="table  table-responsive" id="company-orders-table" style="width:100%;">
                        <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Date</th>
                            <th>User</th>
                            <th>...</th>
                            <th>S-OID</th>
                            <th>S-AWB</th>
                            <th>Product</th>
                            <th>Attributes</th>
                            <th>Qty</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>PM</th>
                            <th>Voucher</th>
                            <th>Actions</th>
                            <th>Master Status</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($orders as $order)

                            @php
                                $items = $order->items->filter(function ($item) { return $item->product instanceof \App\Models\Product; });
                            @endphp

                            @if ($items->count() > 0)

                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->created_at->toFormattedDateString() }}</td>
                                    <td>{{ $order->user? $order->user->phone_number : 'DELETED ACCOUNT' }}</td>



                                @foreach($order->items as $item)


                                    @if(!$loop->first)
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            @endif
                                            <td class="smcolumn">
                                                @if($item->product_link)
                                                    <a href="{{ $item->product_link }}" target="_blank"><b>www</b></a>
                                                @else
                                                    -
                                                @endif
                                            </td>

                                            <td class="smcolumn">
                                                {{ $item->seller_order_no }}

                                            </td>
                                            <td class="smcolumn">{{ $item->seller_awb_no }}</td>

                                            <td>
                                                <a href="{{ route('products.show', $item->product->slug) }}"><img
                                                            src="{{ resize_image_url($item->product->images[0]->image, '200X200') }}"
                                                            alt="Product" style="width:30px;height:30px;">
                                                </a>
                                            </td>

                                            <td>
                                                @foreach($item->options as $key => $value)
                                                    <small><a href="#">{{ $key }} : {{ $value }}</a></small>
                                                    <br>
                                                @endforeach
                                            </td>
                                            <td>{{ $item->qty }}</td>
                                            <td><span>Rs. {{ $item->qty * $item->price }}</span></td>
                                            <td>{{ $item->status }}</td>
                                            @if(!$loop->first)
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                        </tr>
                                    @else
                                        <td>{{ strtoupper($order->payment_method) }}</td>
                                        <td>@if($order->voucher_path) <a target="_blank"
                                                                         href="{{ $order->voucher_url }}">Voucher</a> @else
                                                - @endif</td>
                                        <td><a data-toggle="modal" data-target="#order-{{ $order->id }}"><i
                                                        class="fa fa-edit"></i></a>
                                            <a data-toggle="modal" data-target="#seller-{{ $order->id }}"
                                               class="m-l-10"><i
                                                        class="fa fa-user"></i></a>
                                        </td>
                                        <td>{{ $order->status }}</td>
                                        </tr>
                                    @endif


                                @endforeach
                            @endif
                        @endforeach
                        </tbody>

                    </table>
                </div>
            </div>

            <div>
                {{ $orders->appends(request()->all())->links() }}
            </div>


            <div id="csv" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <form method="POST" action="{{ route('user.reports.store') }}">
                                    {{ csrf_field() }}
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>To :</label>
                                            <div class="input-group date datetimepicker" id="datetimepicker6">
                                                <input name="from" type="text" class="form-control" required/>
                                                <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>From:</label>
                                            <div class="input-group date datetimepicker" id="datetimepicker7">
                                                <input name="to" type="text" class="form-control" required/>
                                                <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="status" class="form-control" id="status">
                                                <option value="">All</option>

                                                @foreach(\App\Models\OrderItem::ALL_ORDERS as $status)
                                                    <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Payment</label>
                                            <select name="payment_method" class="form-control" id="payment">
                                                <option value="">All</option>

                                                @foreach(\App\Models\Order::PAYMENT_METHOD as $pm)
                                                    <option value="{{ $pm }}">{{ strtoupper($pm) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12" align="center">
                                        <div class="form-group">

                                            <button type="submit" class="btn btn-warning">Create CSV</button>

                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>

                    </div>

                </div>
            </div>

            @foreach($orders as $order)
                <div id="seller-{{ $order->id }}" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('user.orders.seller-info', $order) }}">
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}


                                    @php
                                        $items = $order->items->filter(function ($item) { return $item->product instanceof \App\Models\Product; });
                                    @endphp


                                @foreach($items as $item)
                                        <div class="form-group">
                                            <div class="col-md-1">{{ $item->id }}</div>
                                            <div class="col-md-2">
                                                <a target="_blank"
                                                   href="{{ route('products.show', $item->product->slug) }}"><img
                                                            src="{{ resize_image_url($item->product->images[0]->image, '200X200') }}"
                                                            alt="Product" style="width:50px;height:50px;">
                                                </a>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="usr">Seller Order No:</label>
                                                <input type="text" name="item[{{ $item->id }}][seller_order_no]"
                                                       class="form-control"
                                                       id="sellerid"
                                                       value="{{ $item->seller_order_no }}">
                                            </div>

                                        <!--                   <div class="col-md-4 hide">
                                                <label for="usr">Product Link:</label>
                                                <input type="text" name="item[{{ $item->id }}][product_link]"
                                                       class="form-control"
                                                       id="selleraub"
                                                       value="{{ $item->product_link }}">
                                            </div> -->

                                            <div class="col-md-3">
                                                <label for="usr">Seller AWB No:</label>
                                                <input type="text" name="item[{{ $item->id }}][seller_awb_no]"
                                                       class="form-control"
                                                       id="selleraub"
                                                       value="{{ $item->seller_awb_no }}">
                                            </div>

                                            <div class="col-md-3">
                                                  <label >Status</label>
                                                    {!! Form::select("item[{$item->id}][status]", array_combine(\App\Models\OrderItem::ALL_ORDERS, \App\Models\OrderItem::ALL_ORDERS), $item->status, ['class' => "form-control", 'id' => 'item-status']) !!}

                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    @endforeach
                                    <div class="form-group">
                                        <div class="clearfix"></div>
                                        <div class="col-md-6" style="margin-top: 15px">
                                            <button type="submit" class="btn btn-default">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>

                    </div>
                </div>

            @endforeach

            @foreach($orders as $order)
            <!-- Modal -->
                <div id="order-{{ $order->id }}" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header" style="border-bottom: 0px;padding:0px;">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>

                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12 m-t-20">
                                        <div class="responsive-table" style="overflow-x: auto;">

                                            <table class="table table-striped table-responsive">
                                                <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Product</th>
                                                    <th style="width:30%;">Description</th>

                                                    <th>Price</th>
                                                    <th>Quantity</th>
                                                    <th>Total</th>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                    $items = $order->items->filter(function ($item) { return $item->product instanceof \App\Models\Product; });
                                                @endphp

                                                @foreach($items as $item)
                                                    <tr id="tr-{{ $item->id }}">
                                                        <td><input type="checkbox"
                                                                   name="print_check[{{ $order->id }}][]"
                                                                   value="{{ $item->id }}"></td>
                                                        <td>
                                                            <a href="{{ route('products.show', $item->product->slug) }}"><img
                                                                        src="{{ resize_image_url($item->product->images[0]->image, '200X200') }}"
                                                                        alt="Product" style="width:70px;height:70px;">
                                                            </a>
                                                        </td>

                                                        <td><p class="product-name"><a
                                                                        href="{{ route('products.show', $item->product->slug) }}">{{ $item->product->name }}</a>
                                                            </p>

                                                            @foreach($item->options as $key => $value)
                                                                <small><a href="#">{{ $key }} : {{ $value }}</a></small>
                                                                <br>
                                                            @endforeach
                                                        </td>

                                                        <td>
                                                     <span>Rs. {{ $item->price }} @if($item->remarks)
                                                             ({{ $item->remarks }}) @endif </span>
                                                        </td>
                                                        <td>

                                                            {{ $item->qty }}
                                                        </td>
                                                        <td><span>Rs. {{ $item->qty * $item->price }}</span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>

                                    <form method="POST" action="{{ route('user.orders.update', $order) }}">
                                        <div class="col-md-12">
                                            <label>Remarks</label>
                                            <textarea class="form-control" type="text"
                                                      name="remarks">{!! $order->remarks !!}</textarea>
                                        </div>

                                        <div class="col-md-6 ">
                                            <div><strong>Shipping Address:</strong></div>
                                            <strong>Name:</strong> {{ $order->shipment_details['name']  }}<br>
                                            <strong>Address:</strong> {{ $order->shipment_details['address']  }}<br>
                                            <strong>Phone
                                                Number:</strong> {{ $order->shipment_details['phone_number']  }}
                                            <br>
                                            <strong>City:</strong> {{ $order->shipment_details['city']  }}
                                            <br>
                                            <button type="button" class="btn btn-primary"
                                                    onclick="printOrder('{{ $order->id }}')">Print
                                            </button>
                                        </div>

                                        {{ csrf_field() }}
                                        {{ method_field('put') }}
                                        <div class="col-md-6 ">
                                            <strong>Total Amount : </strong>Rs. {{ $order->total }}
                                            <div class="form-group">
                                                <label for="sel1">Select Status</label>
                                                <select class="form-control" id="sel1" name="status">
                                                    @foreach(\App\Models\Order::STATUS as $status)
                                                        <option value="{{ $status }}" {{ $order->status == $status ? 'selected' : '' }}>{{ strtoupper($status) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-warning">Submit</button>
                                        </div>

                                    </form>

                                </div>
                            </div>

                        </div>

                    </div>
                </div>

            @endforeach
        </div>

        @stop

        @section('sub-scripts')
            <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"
                    type="text/javascript"></script>

            <script>

                $(function () {
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
                });


            </script>

            <script>

                function printElem(content) {
                    var mywindow = window.open('', 'PRINT', 'height=400,width=600');

                    mywindow.document.write('<html><head><title>' + document.title + '</title>');
                    mywindow.document.write('</head><body >');
                    mywindow.document.write('<h1>' + document.title + '</h1>');
                    mywindow.document.write(content);
                    mywindow.document.write('</body></html>');

                    mywindow.document.close(); // necessary for IE >= 10
                    mywindow.focus(); // necessary for IE >= 10*/

                    mywindow.print();
                    mywindow.close();

                    return true;
                }

                function printOrder(orderId) {
                    var data = [];
                    $('input[name="print_check[' + orderId + '][]"]:checked').each((index, item) = > {
                        data.push(item.value)
                })

                    var content = '<table  border="1">';

                    data.forEach((item) = > {
                        content += document.getElementById('tr-' + item).outerHTML
                })

                    content += '</table>'

                    console.log(content)
                    printElem(content)
                }


            </script>

@endsection