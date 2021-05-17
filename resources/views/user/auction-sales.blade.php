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
                                <th>User</th>
                                <th>Bid Amount</th>
                                <th>Others</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($auctionSales as $order)
                                <tr>
                                    <td>{{ $order->created_at->toFormattedDateString() }}</td>
                                    <td>
                                        @if ($order->product)
                                        <a href="{{ route('products.show', $order->product->slug) }}"><img
                                                    src="{{ resize_image_url($order->product->images[0]->image, '200X200') }}"
                                                    alt="Product"
                                                    style="width:70px;height:70px;">
                                        </a>
                                        @else
                                            <a>Product Deleted</a>
                                        @endif
                                    </td>

                                    @if ($order->product)

                                    <td><p class="product-name"><a
                                                    href="{{ route('products.show', $order->product->slug) }}">{{ $order->product->name }}</a>
                                        </p>
                                    </td>

                                    @else
                                        <td></td>
                                    @endif

                                    @if ($order->user)

                                    <td><a class=" popover1 " data-toggle="popover" data-placement="left"
                                           title="{{ $order->user->phone_number }}, {{ $order->user->email }}, {{ $order->user->name }}">{{ $order->user->name }} {{ $order->user->phone_number }}</a>
                                    </td>

                                    @else
                                        <td></td>
                                    @endif
                                    <td>{{ $order->price }}</td>
                                    <td><a onclick="openAuctionSalesModal({{ $order->product_id }})">View All Bids</a></td>
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


    <div id="our-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="border-bottom: 0px;padding:0px;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body">
                    <div class="row">


                        <div class="col-md-12 m-t-20">
                            <div id="modal-content-for-auction" class="responsive-table" style="overflow-x: auto;">


                            </div>
                        </div>
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

        $('.popover1').tooltip()


        function openAuctionSalesModal(productId) {
            $.get('/user/auction-sales/' + productId)
                .done(function (html) {
                    // console.log(html)
                    $('#modal-content-for-auction').html(html)
                    $('#our-modal').modal()
                })
        }
    </script>
@stop
