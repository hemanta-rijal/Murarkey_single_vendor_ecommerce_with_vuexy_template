@extends('admin.layouts.app')
@include('admin.partials.indexpage-includes')

@section('css')

@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function () {

            $('.delete_all').on('click', function (e) {

                var allVals = [];
                $(".selected").each(function () {
                    allVals.push($(this).attr('data-id'));
                });

                console.log(allVals)

                if (allVals.length <= 0) {
                    alert("Please select row.");
                } else {
                    var check = confirm("Are you sure you want to delete bulk data?");
                    if (check == true) {

                        var join_selected_values = allVals.join(",");
                        console.log(allVals)
                        $.ajaxSetup({
                            headers: {'X-CSRF-TOKEN': '{{ Session::token() }}'}
                        });

                        $.ajax({
                            url: '{{ url('/admin/users/bulk-delete') }}',
                            type: 'POST',
                            data: {
                                "ids": join_selected_values,
                                "_method": 'POST',
                            },
                            success: function (data) {
                                if (data['success']) {
                                    window.location = '{{route('admin.users.index')}}'
                                } else if (data['error']) {
                                    alert(data['error']);
                                } else {
                                    alert('Whoops Something went wrong!!');
                                }
                            },
                            error: function (data) {
                                alert(data.responseText);
                            }
                        });
                    }
                }
            });

        });
    </script>
@endsection

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            @include('flash::message')
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Orders</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Order</a>
                                    </li>
                                    <li class="breadcrumb-item active">Order's Summary
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrum-right">
                        <a href="#" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle"><i
                                    class="feather icon-plus"></i> Add New</a>
                        <div class="dropdown">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Shopping Cart Section Begin -->
            <section class="ordersummary-section spad">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card" style="padding: 0px;">
                            <div class="card-header" style="padding: 25px;">
                                <h2 class="card-title">Order Summary</h2>
                                {{-- <div style="padding-top: 50px;"></div> --}}
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-content">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="ordersummary-left">
                                            <div class="order-summary">
                                                <table class="table">
                                                    <tbody>
                                                    <tr>
                                                        <td>Order Code</td>
                                                        <td>{{$order->code}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Order date</td>
                                                        <td>{{$order->created_at->format('d-m-Y  h:i A')}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Customer</td>
                                                        <td>{{$order->user->name}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Order Status</td>
                                                        <td> <span class="badge badge-{{\App\Models\Order::ORDER_CONFIRMED==$order->status?'success':'danger'}}"> {{$order->status}}</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Email</td>
                                                        <td>{{$order->user->email}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Total order amount</td>
                                                        <td>NRS. {{$order->total}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Shipping Address</td>
                                                        <td>{{ $order->user->shipment_details ? $order->user->shipment_details->specific_address : ''}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Contact</td>
                                                        <td>{{$order->user->phone_number ?? '-'}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Payment Method</td>
                                                        <td>{{$order->payment_method}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Appointment/Delivery Date</td>
                                                        <td>{{$order->date}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Appointment/Delivery Time</td>
                                                        <td>{{$order->time}}</td>
                                                    </tr>

                                                    </tbody>
                                                </table>


                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="ordersummary-right" style="padding-top: 25px;">
                                            <div class="order-summary">
                                                <h2>Order Amount</h2>
                                                <table>
                                                    <tbody>
                                                    <tr>
                                                        <td>Subtotal</td>
                                                        <td>NRS. {{$order->sub_total}}</td>
                                                    </tr>
                                                    @if($order->coupon_discount_price)
                                                        <tr>
                                                            <td>Coupon</td>
                                                            <td>{{$order->coupon_discount_price}}</td>
                                                        </tr>
                                                    @endif
                                                    <tr>
                                                        <td>Shipping</td>
                                                        <td>NRS. {{getOrderSummary($order)['shipping_charge']}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>TAX</td>
                                                        <td>{{convert($order['tax'])}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><Strong>Total</Strong></td>
                                                        <td><strong>{{convert($order['total_price'])}}</strong></td>
                                                    </tr>
                                                    </tbody>
                                                </table>

                                            </div>
                                            <a href="{{route('admin.orders.download-summary',$order->id)}}"
                                               class="btn btn-primary mt-3">
                                                Download pdf
                                            </a>
                                            <a href="{{route('admin.orders.change-status',$order->id)}}"
                                               class="btn btn-outline-danger mt-3">
                                                Cancell Order
                                            </a>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="ordersummary-left">
                                            <div class="order-summary">

                                                <div class="card-header">
                                                    <h2>Product Order details</h2>
                                                </div>

                                                <div class="order-detail">
                                                    <table class="table">
                                                        <thead>
                                                        <th>#</th>
                                                        <th>
                                                            item
                                                        </th>
                                                        <th>
                                                            name
                                                        </th>
                                                        <th>Quantity</th>
                                                        <th>Price</th>
                                                        </thead>
                                                        <tbody>
                                                        @foreach ($productOrderItems as $item)
                                                            <tr>
                                                                <td>{{++$loop->index}}</td>
                                                                <td>
                                                                    <div class="item">
                                                                        <img src="{{$item->options['photo']}}"
                                                                             alt="product-img"
                                                                             style="max-height: 100px; widht:auto; object-fit:center">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{$item->product->name  }}
                                                                </td>
                                                                <td>
                                                                    {{$item->qty}}
                                                                </td>
                                                                <td>
                                                                    NRS. {{$item->price}}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>


                                            </div>
                                            <div class="order-summary">

                                                <div class="card-header pull-center">
                                                    <h2>Service Order details</h2>
                                                </div>

                                                <div class="order-detail">
                                                    <table class="table">
                                                        <thead>
                                                        <th>#</th>
                                                        <th>
                                                            item
                                                        </th>
                                                        <th>
                                                            name
                                                        </th>
                                                        <th>Quantity</th>
                                                        {{-- <th>Delivery type</th> --}}
                                                        <th>Price</th>
                                                        </thead>
                                                        <tbody>
                                                        @foreach ($serviceOrderItems as $item)
                                                            <tr>
                                                                <td>{{++$loop->index}}</td>
                                                                <td>
                                                                    <div class="item">
                                                                        <img src="{{$item->options['photo']}}"
                                                                             alt="product-img"
                                                                             style="max-height: 100px; widht:auto; object-fit:center">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    {{$item->service->title  }}
                                                                </td>
                                                                <td>
                                                                    {{$item->qty}}
                                                                </td>
                                                                {{-- <td>
                                                                    {{$item->}}
                                                                </td> --}}
                                                                <td>
                                                                    NRS. {{$item->price}}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>


                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
            <!-- Shopping Cart Section End -->

        </div>
    </div>
    </div>
    <!-- END: Content-->

@endsection

