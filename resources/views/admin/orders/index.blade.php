@extends('admin.layouts.app')


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
                            headers: {
                                'X-CSRF-TOKEN': '{{ Session::token() }}'
                            }
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
                                    window.location = '{{ route('admin.users.index') }}'
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
                                    <li class="breadcrumb-item"><a href="#">Orders</a>
                                    </li>
                                    <li class="breadcrumb-item active">Orders List
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
            <section id="basic-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body card-dashboard">
                                    <div class="table-responsive">
                                        <table class="table data-list-view">
                                            <thead>
                                            <tr>
                                                <th></th>
                                                <th>Order Code</th>
                                                <th>Order Date</th>
                                                <th>Status</th>
                                                <th>Customer</th>
                                                <th>Total Amount</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($orders as $order)
                                                <tr data-id="{{ $order->id }}">
                                                    <td></td>
                                                    <td class="product-name">{!! $order->code !!}</td>
                                                    <td class="product-name">{{ $order->created_at->format('d-m-Y  h:i A') }}</td>
                                                    <td class="product-name">{{ $order->status }}</td>
                                                    <td class="product-name">{{ $order->users ? $order->user->name : 'do not exist' }}</td>
                                                    <td class="product-name"> Rs. {{ $order->total }}</td>
                                                    {{-- <td><img class="media-object" src="{!! resize_image_url($order->image, '50X50') !!}" alt="Image" height="50"></td> --}}
                                                    <td class="product-action">
                                                        @if ($order->status != 'cancelled')
                                                            <a href="{{ route('admin.orders.change-status', $order->id) }}">
                                                                <i class="feather icon-slash text-danger"></i>
                                                            </a>
                                                        @endif
                                                        <a href="{{ route('admin.orders.detail', $order->id) }}">
                                                            <i class="feather icon-eye "></i>
                                                        </a>
                                                        <a href="#"
                                                           onclick="confirm_modal('{{ route('admin.orders.destroy', $order->id) }}')">
                                                            <i class="feather icon-trash"></i>
                                                        </a>
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
            </section>
        </div>
    </div>
    </div>
    <!-- END: Content-->

    @include('admin.partials.modal')

@endsection
