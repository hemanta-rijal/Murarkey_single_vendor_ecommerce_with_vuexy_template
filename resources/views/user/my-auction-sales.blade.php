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
    </style>

@endsection

@section('sub-content')
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/v/dt/jq-2.2.4/dt-1.10.13/datatables.min.css"/>


    <div class="tab_filter_box p-0 bg_white">
        <div class="pum_table_wrapper">
            <div class="table-responsive">


                <div class="p-12">

                    <div class="table-responsive orderlist">
                        <table class="table table-striped table-responsive">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th></th>
                                <th>Product Name</th>
                                <th>Your Bid Amount</th>
                                <th>Current Max Bid Amount</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($auctionSales as $order)
                                <tr>
                                    <td>{{ $order->created_at->toFormattedDateString() }}</td>

                                    @if ($order->product)
                                        <td>

                                            <a href="{{ route('products.show', $order->product->slug) }}"><img
                                                        src="{{ resize_image_url($order->product->images[0]->image, '200X200') }}"
                                                        alt="Product"
                                                        style="width:70px;height:70px;">
                                            </a>
                                        </td>

                                        <td><p class="product-name"><a
                                                        href="{{ route('products.show', $order->product->slug) }}">{{ $order->product->name }}</a>
                                            </p>
                                        </td>
                                    @else
                                        <td colspan="2">DELETED PRODUCT</td>
                                    @endif


                                    <td>{{ $order->price }}</td>
                                    <td>{{ $mappedData[$order->product_id] }}</td>
                                    <td>
                                        <a class="btn btn-default"
                                           href="{{ route('user.my-auction-sales-single', $order) }}"> {{ $order->cancelled ? 'Re Bid' : 'Cancel' }}</a>
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>

                        </table>
                    </div>

                    <div>
                        {{ $auctionSales->appends(request()->all())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop


@section('sub-scripts')
    <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
    <script>
        $('.popover1').tooltip()
    </script>
@stop
