@extends('admin.layouts.app')
{{-- @include('admin.partials.indexpage-includes') --}}
@section('css')

    <!-- Begin: Vendor CSS-->

    <link rel="stylesheet" type="text/css"
          href="{{ asset('backend/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('backend/app-assets/vendors/css/file-uploaders/dropzone.min.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('backend/app-assets/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css')}}">
    <!-- END: Vendor CSS-->

    {{-- page css --}}
    <link rel="stylesheet" type="text/css"
          href="{{ asset('backend/app-assets/css/plugins/file-uploaders/dropzone.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/css/pages/data-list-view.css')}}">

    <style>
        .paging_simple_numbers {
            display: none;
        }

        .dataTables_length {
            display: none;
        }

        .actions {
            display: none;
        }
    </style>

    <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/css/pages/app-email.css')}}">
    <link rel="stylesheet" href="{{ asset('backend/tagin-master/dist/css/tagin.css') }}">


@endsection

@section('js')

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('backend/app-assets/vendors/js/extensions/dropzone.min.js')}}"></script>
    <script src="{{ asset('backend/app-assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
    <script src="{{ asset('backend/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js')}}"></script>
    <script src="{{ asset('backend/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('backend/app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js')}}"></script>
    <script src="{{ asset('backend/app-assets/vendors/js/tables/datatable/dataTables.select.min.js')}}"></script>
    <script src="{{ asset('backend/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js')}}"></script>

    <!-- END: Page Vendor JS-->


    <!-- BEGIN: Page JS-->
    <script src="{{ asset('backend/app-assets/js/scripts/ui/data-list-view.js') }}"></script>
    <script src="{{ asset('backend/custom/customfuncitons.js')}}"></script>
    <script src="{{ asset('backend/tagin-master/dist/js/tagin.js')}}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/29.0.0/classic/ckeditor.js"></script>
    <script>
        for (const el of document.querySelectorAll('.tagin')) {
            tagin(el)
        }
    </script>

    <!-- END: Page JS-->

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

        function sendMails() {
            var allVals = [];
            $(".selected").each(function () {
                allVals.push($(this).attr('data-id'));
            });

            console.log(allVals)
            var join_selected_values = allVals.join(",");
            if (allVals.length <= 0) {
                alert("Please select row.");
            } else {
                $.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': '{{ Session::token() }}'}
                });

                $.ajax({
                    type: "POST",
                    data: {
                        "ids": allVals,
                        "_method": 'POST',
                    },
                    url: '<?php echo e(route("admin.newsletter.mail-all.modal")) ?>',
                    success: function (data) {
                        console.log('data');
                        $('.email-modal').html(data);
                        $('#composeForm').modal('toggle');
                    }
                })
            }
        }
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
                            <h2 class="content-header-title float-left mb-0">Subscribers</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">NewsLetter</a>
                                    </li>
                                    <li class="breadcrumb-item active">Subscription List
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrum-right">
                        <button class=" btn-icon btn btn-primary btn-round btn-sm" onclick="sendMails()"><i
                                    class="feather icon-envalope"></i> Send Bulk Mails
                        </button>
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
                                                <th>Full Name</th>
                                                <th>Email</th>
                                                {{-- <th>Phone Number</th> --}}
                                                {{-- <th>Viber Number</th> --}}
                                                <th>ACTION</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($subscribers  as $subscriber)
                                                <tr data-id="{{$subscriber->id}}">
                                                    <td></td>
                                                    <td class="product-name">{!! $subscriber->full_name ?? 'null' !!}</td>
                                                    <td class="product-name">{!! $subscriber->email !!}</td>
                                                    {{-- <td class="product-name">{!! $subscriber->phone_number !!}</td>
                                                    <td class="product-name">{!! $subscriber->viber_number !!}</td> --}}
                                                    {{-- <td><span class="btn-sm btn-{{ $subscriber->status=='subscribed' ? 'primary' :  'warning'  }}"> {{$subscriber->status=='subscribed' ? 'Subscribed' :  'Un-Subscribed'  }} </span></td> --}}
                                                    <td class="product-action">
                                                        <a href="{!! route('admin.join-murarkey.show', $subscriber->id) !!}"
                                                           class=" mr-1 mb-1 waves-effect waves-light">
                                                            <i class="feather icon-eye"></i>
                                                        </a>

                                                        {{-- <a href="" class=" mr-1 mb-1 waves-effect waves-light">
                                                            <i class="feather icon-mail"></i>
                                                        </a> --}}
                                                        {{-- @include('admin.partials.modal', ['data' => $subscriber, 'name' => 'admin.subscribers.destroy']) --}}
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
    <div class="email-modal">

    </div>

@endsection

