@extends('admin.layouts.app')
@include('admin.partials.indexpage-includes')
@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.delete_all').on('click', function (e) {
                var allVals = [];
                $(".selected").each(function () {
                    allVals.push($(this).attr('data-id'));
                });
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
                            url: '{{ url('/admin/services/bulk-delete') }}',
                            type: 'POST',
                            data: {
                                "ids": join_selected_values,
                                "_method": 'POST',
                            },
                            success: function (data) {
                                if (data['success']) {
                                    window.location = '{{route('admin.services.index')}}'
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
                            <h2 class="content-header-title float-left mb-0">Services</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Services</a>
                                    </li>
                                    <li class="breadcrumb-item active">Services List
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrum-right">
                        <a href="{{route('admin.services.create')}}"
                           class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle"><i
                                    class="feather icon-plus"></i> Add New</a>
                        <a href="{{route('admin.services.import-export')}}"
                           class="btn-icon btn btn-warning btn-round btn-sm dropdown-toggle"><i
                                    class="feather icon-upload-cloud"></i> Import & Export</a>
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
                                    {{-- <p class="card-text">DataTables has most features enabled by default, so all you need to do to use it with your own ables is to call the construction function: $().DataTable();.</p> --}}
                                    <div class="table-responsive">
                                        <table class="table data-list-view">
                                            <thead>
                                            <tr>
                                                <th></th>
                                                <th>Title</th>
                                                <th>Image</th>
                                                <th>Service Charge</th>
                                                <th>Service For</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($services  as $service)
                                                <tr data-id="{{$service->id}}">
                                                    <td></td>
                                                    <td>{!! $service->title !!}</td>
                                                    <td><img class="media-object"
                                                             src="{!! resize_image_url($service->featured_image, '50X50') !!}"
                                                             alt="Image" height="50"></td>
                                                    <td> <strong>Rs. {!! $service->service_charge !!}</strong></td>
                                                    <td>{!! $service->serviceTo == 1 ? "Murarkey": "Parlours" !!}</td>
                                                    <td class="product-action">
                                                        <div class="row">

                                                            <a href="{!! route('admin.services.edit', $service->id) !!}"
                                                               class=" mr-1 mb-1 waves-effect waves-light">
                                                                <i class="feather icon-edit"></i>
                                                            </a>
                                                            <a href="#" onclick="confirm_modal('{{route('admin.services.destroy',$service->id)}}')">
                                                                <i class="feather icon-trash"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>

                                            @endforeach
                                            </tbody>
                                        </table>
                                        <div class="d-flex">
                                            <div class="mx-auto">
                                                {!! $services->links('vendor.pagination.bootstrap-4') !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- END: Content-->
    @include('admin.partials.modal')
@endsection
