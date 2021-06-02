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
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/css/pages/app-user.css')}}"> 
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/css/plugins/forms/validation/form-validation.css') }}">
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


  <script src="{{ asset('backend/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js') }}"></script>
  <script src="{{ asset('backend/app-assets/js/scripts/forms/validation/form-validation.js') }}"></script>

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
                <!-- users edit start -->
                <section class="users-edit">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <ul class="nav nav-tabs mb-3" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link d-flex align-items-center active" id="account-tab" data-toggle="tab" href="#account" aria-controls="account" role="tab" aria-selected="true">
                                            <i class="feather icon-user mr-25"></i><span class="d-none d-sm-block">Account</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="account" aria-labelledby="account-tab" role="tabpanel">
                                        <!-- users edit media object start -->
                                        <div class="media mb-2">
                                            <a class="mr-2 my-25" href="#">
                                                <img src="{!! auth()->guard('admin')->user()->profile_pic_url !!}" alt="users avatar" class="users-avatar-shadow rounded" height="90" width="90">
                                            </a>
                                            <div class="media-body mt-50">
                                                <h4 class="media-heading">Angelo Sashington</h4>
                                                <div class="col-12 d-flex mt-1 px-0">
                                                    <a href="profile/image-upload" class="btn btn-primary d-none d-sm-block mr-75">Change</a>
                                                    <a href="profile/image-upload" class="btn btn-primary d-block d-sm-none mr-75"><i class="feather icon-edit-1"></i></a>
                                                    <a href="{{route('admin.remove-profile-pic')}}" class="btn btn-outline-danger d-none d-sm-block">Remove</a>
                                                    <a href="{{route('admin.remove-profile-pic')}}"  class="btn btn-outline-danger d-block d-sm-none"><i class="feather icon-trash-2"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- users edit media object ends -->
                                        <!-- users edit account form start -->
                                       <form action="{{route('admin.post.profile')}}" method="POST" novalidate>
                                            @csrf
                                            @method('put')
                                            <div class="row">
                                                    <div class="col-6 form-group">
                                                        <div class="controls">
                                                            <label>Name</label>
                                                            <input type="text" class="form-control" required placeholder="Name" name="name" value="{!! auth()->guard('admin')->user()->name!!}" required data-validation-required-message="This name field is required">
                                                        </div>
                                                    </div>
                                                    <div class="col-6 form-group">
                                                        <div class="controls">
                                                            <label>E-mail</label>
                                                            <input type="email" class="form-control" required placeholder="Email" name="email" value="{!! auth()->guard('admin')->user()->email!!}" required data-validation-required-message="This email field is required" readonly>
                                                        </div>
                                                    </div>
                                                    {{-- <div class="col-sm-6 form-group ">
                                                        <label>Old Password</label>
                                                        <div class="controls">
                                                            <input type="password" class="form-control" placeholder="Your Password" name="old_password"  required data-validation-required-message="This password field is required" minlength="4" maxlength="15"  />
                                                        </div>
                                                    </div> --}}
                                                    <div class="col-sm-6 form-group ">
                                                        <label>New Password</label>
                                                        <div class="controls">
                                                            <input type="password" class="form-control" placeholder="Your Password" name="new_password"  required data-validation-required-message="This password field is required" minlength="4" maxlength="15"  />
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 form-group ">
                                                        <label>Confirm Password</label>
                                                        <div class="controls">
                                                            <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password"  required data-validation-required-message="Confirm password field must match password strings of new password field" data-validation-match-match="new_password" minlength="4" max="15"  />
                                                        </div>
                                                </div>

                                                    <div class="col-6 form-group">
                                                        <label>Status</label>
                                                        <select class="form-control" >
                                                            <option value="activate" disabled>Active</option>
                                                            <option value="blocked" disabled>Blocked</option>
                                                            <option value="deactivated" disabled>deactivated</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-6 form-group">
                                                        <label>Role</label>
                                                        <select class="form-control">
                                                            <option value="admin" disabled>Admin</option>
                                                            <option value="user" disabled>User</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                                    <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">Save
                                                        Changes</button>
                                                    <button type="reset" class="btn btn-outline-warning">Reset</button>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- users edit account form ends -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- users edit ends -->

            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
