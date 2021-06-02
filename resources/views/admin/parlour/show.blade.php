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
<script src="{{ asset('backend/app-assets/js/scripts/ui/custom-data-list-view.js') }}"></script>
<script src="{{ asset('backend/app-assets/js/scripts/modal/components-modal.js') }}"></script>
<!-- END: Page JS-->

 <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/css/pages/app-user.css')}}">

@endsection

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            @include('flash::message')
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- page users view start -->
                <section class="page-users-view">
                    <div class="row">
                        <!-- account start -->
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Account</div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="users-view-image">
                                            <img src="{{resize_image_url($parlourListing->feature_image,'200X200')}}" class="users-avatar-shadow w-100 rounded mb-2 pr-2 ml-1" alt="avatar">
                                        </div>
                                        <div class="col-12 col-sm-9 col-md-6 col-lg-5">
                                            <table>
                                                <tr>
                                                    <td class="font-weight-bold">Name</td>
                                                    <td>{{ $parlourListing->name }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Addres</td>
                                                    <td>{{$parlourListing->address }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Email</td>
                                                    <td>{{ $parlourListing->email }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-12 col-md-12 col-lg-5">
                                            <table class="ml-0 ml-sm-0 ml-lg-0">
                                                <tr>
                                                    <td class="font-weight-bold">Status</td>
                                                    <td><span class="btn-sm btn-{{$parlourListing->status==true ? 'primary' :  'danger'  }}"> {{$parlourListing->status ? 'Active' : 'De-active' }}</span></td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Featured</td>
                                                    <td><span class="btn-sm btn-{{$parlourListing->featured==true ? 'primary' :  'danger'  }}"> {{$parlourListing->featured ? 'Active' : 'De-active' }}</span></td>
                                                </tr>
                                                
                                            </table>
                                        </div>
                                        {{-- <div class="col-12">
                                            <a href="/admin/edit-profile" class="btn btn-primary mr-1"><i class="feather icon-edit-1"></i> Edit Profile</a>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- account end -->
                                                <!-- information start -->
                        <div class="col-md-12 col-12 ">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title mb-2">Information</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12 ">
                            <div class="card">
                                {{-- <div class="card-header">
                                    <div class="card-title mb-2">Information</div>
                                </div> --}}
                                <div class="card-body">
                                    <table>
                                         <tr>
                                            <td class="font-weight-bold">Email</td>
                                            <td>{{ $parlourListing->email }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Phone Number</td>
                                            <td>{{ $parlourListing->phone }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Mobile Number</td>
                                            <td>{{ $parlourListing->mobile }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Website</td>
                                            <td>{{ $parlourListing->website }}
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- information start -->
                        <!-- social links end -->
                        <div class="col-md-6 col-12 ">
                            <div class="card">
                                {{-- <div class="card-header">
                                    <div class="card-title mb-2">Social Links</div>
                                </div> --}}
                                <div class="card-body">
                                    <table>
                                       <tr>
                                            <td class="font-weight-bold">Facebook</td>
                                            <td>{{ $parlourListing->facebook }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Instagram</td>
                                            <td>{{ $parlourListing->Instagram }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Twitter</td>
                                            <td>{{ $parlourListing->twitter }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Youtube</td>
                                            <td>{{ $parlourListing->youtube }}
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- social links end -->
                        <!-- permissions start -->
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header border-bottom mx-2 px-0">
                                    <h6 class="border-bottom py-1 mb-0 font-medium-2"><i class="feather icon-lock mr-50 "></i>Full Description
                                    </h6>
                                </div>
                                <div class="card-body px-75">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="font-weight-bold">
                                                {!!$parlourListing->about !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- permissions end -->
                       
                    </div>
                </section>
                <!-- page users view end -->

            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
