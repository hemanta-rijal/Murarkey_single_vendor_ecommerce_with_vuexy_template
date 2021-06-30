@extends('user.layout')

@section('sub-styles')
    <style>
        thead {
            background-color: #f1f1f1;
        }

        .orderlist {
            background: white;
        }

        .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
            border: 0px;
        }

        .cardxs {
            margin-bottom: 20px;
            padding: 10px;
        }

        .orgtxt {
            color: #f9671a;
        }

        .status {
            display: inline;
            float: right;
            color: #f9671a;
            font-weight: bold;
        }

        .mb10 {
            margin-bottom: 10px;
        }
    </style>

@endsection

@section('sub-content')
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/v/dt/jq-2.2.4/dt-1.10.13/datatables.min.css"/>



    @foreach($orders as $order)
        <!-- Modal -->
        {{dd($order)}}
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

                                    <table class="table table-responsive">
                                        <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th style="width:28%;">Description</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Status</th>
                                            <th>Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @php
                                            $items = $order->items->filter(function ($item) { return $item->product; });
                                        @endphp

                                        @foreach($items as $item)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('products.show', $item->product->slug) }}"><img
                                                                src="{{ resize_image_url($item->product->images[0]->image, '200X200') }}"
                                                                alt="Product"
                                                                style="width:70px;height:70px;">
                                                    </a>
                                                </td>

                                                <td><p class="product-name"><a
                                                                href="{{ route('products.show', $item->product->slug) }}">{{ $item->product->name }}</a>
                                                    </p>

                                                    @foreach($item->options as $key => $value)
                                                        <small><a href="#">{{ $key }} : {{ $value }}</a>
                                                        </small>
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

                                                <td>{{ $item->status ? strtoupper($item->status) : '-' }}</td>

                                                <td><span>Rs. {{ $item->qty * $item->price }}</span>
                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>

                                    </table>
                                </div>
                            </div>

                            <div class="col-md-6 ">
                                <div><strong>Shipping Address:</strong></div>
                                <strong>Name:</strong> {{ $order->shipment_details['name']  }}<br>
                                <strong>Address:</strong> {{ $order->shipment_details['address']  }}<br>
                                <strong>Phone
                                    Number:</strong> {{ $order->shipment_details['phone_number']  }}<br>
                                <strong>City:</strong> {{ $order->shipment_details['city']  }}
                            </div>
                            <div class="col-md-6 ">
                                <strong> Total:</strong> Rs. {{ $order->total }}
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    @endforeach

    <div class="tab_filter_box p-0 bg_white">
        <div class="pum_table_wrapper">
            <div class="table-responsive">


                <div class="p-12">

                @if (session()->has('order_placed'))

                    <!-- yo chai order confirm bhaye pachi modal khulnu paryo hai ani mathi ko alert message hataunay -->

                        <div class="modal fade" id="confirmorder" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Well done! You have successfully placed order</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>Please have the cash ready on time of delivery.</p>
                                        <hr>
                                        You can go through your order at <strong><a
                                                    href="{{ route('user.my-orders.index') }}">My account >My orders
                                            </a></strong>
                                        <button class="btn btn-warning "><a href="/" class="white">Continue
                                                Shopping</a></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="table-responsive orderlist hidden-xs ">
                        <table class="table table-striped table-responsive">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Order ID</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Delivery Date</th>
                                <th>Payment</th>
                                <th>Voucher</th>
                                <th>Action</th>
                                <th>Cancel</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->created_at->toFormattedDateString() }}</td>
                                    <td>{{ $order->id }}</td>
                                    <td>Rs. {{ $order->total }}</td>
                                    <td>{{ strtoupper($order->status) }} @if($order->remarks)
                                            <button type="button" class="btn-sm popover1 btn-danger"
                                                    data-toggle="popover" data-placement="left"
                                                    data-content="{{ $order->remarks }}"><i class="fa fa-info"></i>
                                            </button>@endif</td>
                                    <td>{{ !$order->is_cancel ? (new \Carbon\Carbon($order->created_at))->add(new \DateInterval('P20D'))->format('jS F') : '-' }}</td>
                                    <td>{{ strtoupper($order->payment_method) }}</td>
                                    <td>
                                        @if ($order->is_prepaid)
                                            @if ($order->voucher_path)
                                                <a href="{{ $order->voucher_url }}" target="_blank"><img
                                                            src="{{ $order->voucher_url }}" height="50"></a>
                                            @else

                                                <form action="{{ route('user.my-orders.update', $order) }}"
                                                      method="POST"
                                                      enctype="multipart/form-data">
                                                    {{ method_field('PUT') }}
                                                    {{ csrf_field() }}
                                                    <input class="voucher-upload" type="file" name="voucher_path">
                                                </form>

                                            @endif
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td><a data-toggle="modal" data-target="#order-{{ $order->id }}">
                                            <button class="btn btn-warning"><i
                                                        class="fa fa-eye m-r-10"></i>Orders
                                            </button>
                                        </a>
                                    </td>

                                    <td>
                                        @if ($order->can_cancel)
                                            <form action="{{ route('user.my-orders.change-status', $order) }}"
                                                  method="POST">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="status"
                                                       value="{{ \App\Models\Order::ORDER_CANCEL }}">
                                                <button type="submit" class=" btn btn-danger">Cancel</button>
                                            </form>
                                        @else

                                        @endif
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>

                        </table>
                    </div>

                    <!-- myorder mobile view -->
                    @foreach($orders as $order)
                        <div class="hidden-lg hidden-md">
                            <div class=" cardxs dim_border">
                                <a data-toggle="modal" data-target="#orderxs-{{ $order->id }}">
                                    <h4><strong>Order # {{ $order->id }}</strong>
                                        <span class="status">
                                           <!--  {{ strtoupper($order->status) }} -->
                                           See More
                                            @if($order->remarks)
                                                <button type="button" class="btn-sm popover1 btn-danger"
                                                        data-toggle="popover" data-placement="left"
                                                        data-content="{{ $order->remarks }}">
                            <i class="fa fa-info"></i>
                            </button>
                                            @endif
                            </span>
                                    </h4>
                                    <span>
                            {{ $order->created_at->toFormattedDateString() }}
                            </span>
                                </a>
                            </div>
                            <div id="orderxs-{{ $order->id }}" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header" style="border-bottom: 0px;padding:0px;">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="row">
                                                <div>

                                                    @if ($order->is_prepaid)
                                                        @if ($order->voucher_path)

                                                            <a href="{{ $order->voucher_url }}" target="_blank">
                                                                <img src="{{ $order->voucher_url }}" height="50">
                                                            </a>
                                                        @else

                                                            <form action="{{ route('user.my-orders.update', $order) }}"
                                                                  method="POST" enctype="multipart/form-data">
                                                                {{ method_field('PUT') }}
                                                                {{ csrf_field() }}
                                                                <h4><strong>Upload Voucher</strong></h4>
                                                                <input class="voucher-upload mb10" type="file"
                                                                       name="voucher_path">
                                                            </form>


                                                        @endif
                                                    @else

                                                    @endif

                                                    <div class="cardxs dim_border">
                                                        <h4><strong>Order# {{ $order->id }}</strong>
                                                            <span class="status"> {{ strtoupper($order->status) }} </span>
                                                        </h4>
                                                        {{ $order->created_at->toFormattedDateString() }}
                                                        @if($order->remarks)
                                                            <button type="button" class="btn-sm popover1 btn-danger"
                                                                    data-toggle="popover" data-placement="left"
                                                                    data-content="{{ $order->remarks }}">
                                                                <i class="fa fa-info"></i>
                                                            </button>
                                                        @endif
                                                        <p class="orgtxt">* Will be delivered within
                                                            {{ !$order->is_cancel ? (new \Carbon\Carbon($order->created_at))->add(new \DateInterval('P20D'))->format('jS F') : '-' }}
                                                        </p>
                                                    </div>

                                                    @php
                                                        $items = $order->items->filter(function ($item) { return $item->product; });
                                                    @endphp

                                                    <div class="dim_border cardxs">
                                                        <h4><strong>Products:</strong></h4>

                                                        @foreach($items as $item)

                                                            <div class="dim_border cardxs">
                                                                <div class="row"></div>
                                                                <div class="col-xs-3">
                                                                    <a href="{{ route('products.show', $item->product->slug) }}">
                                                                        <img src="{{ resize_image_url($item->product->images[0]->image, '200X200') }}"
                                                                             alt="{{ $item->product->name }}"
                                                                             style="width:50px;height:50px;">
                                                                    </a>
                                                                </div>
                                                                <div class="col-xs-9">

                                                                    <p class="text-danger pull-right" style="color: #ff510a; border: grey 1px;" >{{ ucfirst($item->status) }}</p> <br>

                                                                    <p class="product-name">
                                                                        <a href="{{ route('products.show', $item->product->slug) }}">{{ str_limit($item->product->name, 30) }}</a>
                                                                    </p>

                                                                    @foreach($item->options as $key => $value)
                                                                        <a href="#">{{ $key }} : {{ $value }}</a>

                                                                        <br>
                                                                    @endforeach

                                                                    <strong>Qty :</strong> {{ $item->qty }}<br>

                                                                    <strong>Total :</strong>
                                                                    Rs. {{ $item->qty * $item->price }}

                                                                </div>
                                                                <div class="clearfix"></div>
                                                            </div>
                                                        @endforeach
                                                    </div>



                                                </div>

                                                <div class="cardxs dim_border">
                                                    <h4><strong>Shipping Address:</strong></h4>
                                                    <strong>Name:</strong> {{ $order->shipment_details['name']  }}
                                                    <br>
                                                    <strong>Address:</strong> {{ $order->shipment_details['address']  }}
                                                    <br>
                                                    <strong>Phone
                                                        Number:</strong> {{ $order->shipment_details['phone_number']  }}
                                                    <br>
                                                    <strong>City:</strong> {{ $order->shipment_details['city']  }}

                                                </div>

                                                @if ($order->can_cancel)
                                                    <form action="{{ route('user.my-orders.change-status', $order) }}"
                                                          method="POST">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="status"
                                                               value="{{ \App\Models\Order::ORDER_CANCEL }}">
                                                        <button type="submit" class=" btn btn-danger">Cancel Order
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                @endforeach


                <div>
                    {{ $orders->appends(request()->all())->links() }}
                </div>

            </div>
        </div>
    </div>
    </div>

@stop


@section('sub-scripts')
    <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.voucher-upload').change(function () {
                this.parentElement.submit()
            })
        })

        $('.popover1').popover()


        @if (session()->has('order_placed'))
        $('#confirmorder').modal('show')
        @endif

    </script>
@stop
