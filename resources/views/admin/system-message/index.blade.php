@extends('admin.layouts.app')
@section('css')

    <!-- Begin: Vendor CSS-->
    
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/vendors/css/file-uploaders/dropzone.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css')}}">
    <!-- END: Vendor CSS-->
    
    {{-- page css --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/css/plugins/file-uploaders/dropzone.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/css/pages/data-list-view.css')}}">
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
<script src="{{ asset('backend/app-assets/js/scripts/modal/components-modal.js') }}"></script>
<!-- END: Page JS-->
    
@endsection

@section('content')
   <!-- BEGIN: Content-->
   <div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Subscribers</h2>
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Subrcibers</a>
                                </li>
                                <li class="breadcrumb-item active">Subcribers List
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                <div class="form-group breadcrum-right">
                    <div class="dropdown">
                        <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-settings"></i></button>
                        <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Chat</a><a class="dropdown-item" href="#">Email</a><a class="dropdown-item" href="#">Calendar</a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Data list view starts -->
            <section id="data-list-view" class="data-list-view-header">
                <div class="action-btns d-none">
                    <div class="btn-dropdown mr-1 mb-1">
                        <div class="btn-group dropdown actions-dropodown">
                            <button type="button" class="btn btn-white px-1 py-1 dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Actions
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#"><i class="feather icon-trash"></i>Delete</a>
                                <a class="dropdown-item" href="#"><i class="feather icon-archive"></i>Archive</a>
                                <a class="dropdown-item" href="#"><i class="feather icon-file"></i>Print</a>
                                <a class="dropdown-item" href="#"><i class="feather icon-save"></i>Another Action</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- DataTable starts -->
                <div class="table-responsive">
                    <table class="table data-list-view">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Caption</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                          
                            @foreach ($brands  as $brand)
                            {{-- {{resize_image_url($brand->image,'50x50')}} --}}
                                <tr>
                                    <td></td>
                                    <td class="product-name">{!! $brand->name !!}</td>
                                    <td>{!! strlen($brand->caption) > 100 ? substr($brand->caption,0,97).'...' : $brand->caption  !!}</td>
                                    <td><img class="media-object" src="{!! resize_image_url($brand->image, '50X50') !!}" alt="Image" height="50"></td>
                                    <td class="product-action">
                                        <a href="{!! route('admin.brands.edit', $brand->id) !!}" class=" mr-1 mb-1 waves-effect waves-light">
                                            <i class="feather icon-edit"></i>
                                        </a>
                                        {{-- @include('admin.partials.modal', ['data' => $brand, 'name' => 'admin.users.destroy']) --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- DataTable ends -->

            </section>
            <!-- Data list view end -->

        </div>
    </div>
</div>
<!-- END: Content-->

@endsection
