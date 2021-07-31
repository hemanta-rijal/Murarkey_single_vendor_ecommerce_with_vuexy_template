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
                            <h2 class="content-header-title float-left mb-0">Social Login Settings</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a>
                                    </li>
                                    {{-- <li class="breadcrumb-item"><a href="#">Pages</a>
                                    </li> --}}
                                    <li class="breadcrumb-item active"> Social Login Settings
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
            <section id="page-general-settings">
                <div class="row">
                    <!-- left menu section -->
                    <div class="col-md-3 mb-2 mb-md-0">
                        <ul class="nav nav-pills flex-column mt-md-0 mt-1">
                            <li class="nav-item">
                                <a class="nav-link d-flex py-75 active" id="general-pill-facebook" data-toggle="pill" href="#general-vertical-facebook" aria-expanded="true">
                                    <i class="feather icon-facebook mr-50 font-medium-3"></i>
                                    facebook
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex py-75 " id="general-pill-google" data-toggle="pill" href="#general-vertical-google" aria-expanded="true">
                                    <i class="feather icon-globe mr-50 font-medium-3"></i>
                                    Google
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex py-75 " id="general-pill-twitter" data-toggle="pill" href="#general-vertical-twitter" aria-expanded="true">
                                    <i class="feather icon-twitter mr-50 font-medium-3"></i>
                                    Twitter
                                </a>
                            </li>
                            
                           
                        </ul>
                    </div>
                    <!-- right content section -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="general-vertical-facebook" aria-labelledby="general-pill-facebook" aria-expanded="true">
                                                <h3>Facebook Login</h3>
                                                {!! Form::open(['route' => 'admin.system-settings.update','files' => true,'class' => 'dashboardForm']) !!}
                                                    {{csrf_field()}}
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label class="facebook_login_status">Status</label>
                                                                    <div class="form-control custom-switch custom-control-inline">
                                                                        <input  name="facebook_login_status" type="hidden"  value="off">
                                                                        <input class="custom-control-input" name="facebook_login_status" type="checkbox" id="customSwitch1" value="on" {{get_meta_by_key('facebook_login_status')==="on" ? 'checked' : ''}}>
                                                                        <label class="custom-control-label" for="customSwitch1">
                                                                        </label>
                                                                        <span class="switch-label"> Enable Facebook Login</span>
                                                                    </div>
                                                                        @error($errors)
                                                                        <span class="err-msg" style="color:red">{{$errors->first('facebook_login_status')}}</span>               
                                                                        @enderror
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="facebook_app_id">App ID<span style="color:red">*</span></label>
                                                                        <input type="text" class="form-control" name="facebook_app_id" id="facebook_app_id" placeholder="Client ID" value="{{get_meta_by_key('facebook_app_id')}}">
                                                                        @error($errors)
                                                                        <span class="err-msg" style="color:red">{{$errors->first('facebook_app_id')}}</span>               
                                                                        @enderror
                                                                    </div> 
                                                                
                                                                    <div class="form-group">
                                                                        <label class="facebook_client_secrete">Client Secrete Key<span style="color:red">*</span></label>
                                                                        <input type="text" class="form-control" name="facebook_client_secrete" id="facebook_client_secrete" placeholder="Client Secrete Key" value="{{get_meta_by_key('facebook_client_secrete')}}">
                                                                        @error($errors)
                                                                        <span class="err-msg" style="color:red">{{$errors->first('facebook_client_secrete')}}</span>               
                                                                        @enderror
                                                                    </div> 

                                                                    <div class="form-group">
                                                                        <label class="facebook_call_back">Call Back <span style="color:red">*</span></label>
                                                                        <input type="text" class="form-control" name="facebook_call_back" id="facebook_call_back" placeholder="Call Back Link" value="{{get_meta_by_key('facebook_call_back')}}">
                                                                        @error($errors)
                                                                        <span class="err-msg" style="color:red">{{$errors->first('facebook_call_back')}}</span>               
                                                                        @enderror
                                                                    </div> 
                                                                    

                                                                </div>
                                                            </div>
                                                            <div class="submit">
                                                                <button type="submit" class="btn btn-primary">Save</button>
                                                            </div>
                                                    </form>
                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="general-vertical-google" aria-labelledby="general-pill-google" aria-expanded="true">
                                                <h3>Google Login</h3>
                                                {!! Form::open(['route' => 'admin.system-settings.update','files' => true,'class' => 'dashboardForm']) !!}
                                                    {{csrf_field()}}
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label class="google_login_status">Status</label>
                                                                    <div class="form-control custom-switch custom-control-inline">
                                                                        <input  name="google_login_status" type="hidden"  value="off">
                                                                        <input class="custom-control-input" name="google_login_status" type="checkbox" id="customSwitch2" value="on" {{get_meta_by_key('google_login_status')==="on" ? 'checked' : ''}}>
                                                                        <label class="custom-control-label" for="customSwitch2">
                                                                        </label>
                                                                        <span class="switch-label"> Enable Google Login</span>
                                                                    </div>
                                                                        @error($errors)
                                                                        <span class="err-msg" style="color:red">{{$errors->first('google_login_status')}}</span>               
                                                                        @enderror
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="google_client_id">Client ID<span style="color:red">*</span></label>
                                                                        <input type="text" class="form-control" name="google_client_id" id="google_client_id" placeholder="Client ID" value="{{get_meta_by_key('google_client_id')}}">
                                                                        @error($errors)
                                                                        <span class="err-msg" style="color:red">{{$errors->first('google_client_id')}}</span>               
                                                                        @enderror
                                                                    </div> 
                                                                    <div class="form-group">
                                                                        <label class="google_client_secrete">Client Secrete Key<span style="color:red">*</span></label>
                                                                        <input type="text" class="form-control" name="google_client_secrete" id="google_client_secrete" placeholder="Client Secrete Key" value="{{get_meta_by_key('google_client_secrete')}}">
                                                                        @error($errors)
                                                                        <span class="err-msg" style="color:red">{{$errors->first('google_client_secrete')}}</span>               
                                                                        @enderror
                                                                    </div> 
                                                                    <div class="form-group">
                                                                        <label class="google_call_back">Call Back <span style="color:red">*</span></label>
                                                                        <input type="text" class="form-control" name="google_call_back" id="google_call_back" placeholder="Call Back Link" value="{{get_meta_by_key('google_call_back')}}">
                                                                        @error($errors)
                                                                        <span class="err-msg" style="color:red">{{$errors->first('google_call_back')}}</span>               
                                                                        @enderror
                                                                    </div> 
                                                                   

                                                                </div>
                                                            </div>
                                                        <div class="submit">
                                                            <button type="submit" class="btn btn-primary">Save</button>
                                                        </div>
                                                </form>
                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="general-vertical-twitter" aria-labelledby="general-pill-twitter" aria-expanded="true">
                                                <h3>Twitter Login</h3>
                                                {!! Form::open(['route' => 'admin.system-settings.update','files' => true,'class' => 'dashboardForm']) !!}
                                                    {{csrf_field()}}
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label class="twitter_login_status">Status</label>
                                                                    <div class="form-control custom-switch custom-control-inline">
                                                                        <input  name="twitter_login_status" type="hidden"  value="off">
                                                                        <input class="custom-control-input" name="twitter_login_status" type="checkbox" id="customSwitch3" value="on" {{get_meta_by_key('twitter_login_status')==="on" ? 'checked' : ''}}>
                                                                        <label class="custom-control-label" for="customSwitch3">
                                                                        </label>
                                                                        <span class="switch-label"> Enable Twitter Login</span>
                                                                    </div>
                                                                        @error($errors)
                                                                        <span class="err-msg" style="color:red">{{$errors->first('twitter_login_status')}}</span>               
                                                                        @enderror
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="twitter_client_id">Client ID<span style="color:red">*</span></label>
                                                                        <input type="text" class="form-control" name="twitter_client_id" id="twitter_client_id" placeholder="Client ID" value="{{get_meta_by_key('twitter_client_id')}}">
                                                                        @error($errors)
                                                                        <span class="err-msg" style="color:red">{{$errors->first('twitter_client_id')}}</span>               
                                                                        @enderror
                                                                    </div> 
                                                                    <div class="form-group">
                                                                        <label class="twitter_client_secrete">Client Secrete Key<span style="color:red">*</span></label>
                                                                        <input type="text" class="form-control" name="twitter_client_secrete" id="twitter_client_secrete" placeholder="Client Secrete Key" value="{{get_meta_by_key('twitter_client_secrete')}}">
                                                                        @error($errors)
                                                                        <span class="err-msg" style="color:red">{{$errors->first('twitter_client_secrete')}}</span>               
                                                                        @enderror
                                                                    </div> 

                                                                    <div class="form-group">
                                                                        <label class="twitter_call_back">Call Back <span style="color:red">*</span></label>
                                                                        <input type="text" class="form-control" name="twitter_call_back" id="twitter_call_back" placeholder="Call Back Link" value="{{get_meta_by_key('twitter_call_back')}}">
                                                                        @error($errors)
                                                                        <span class="err-msg" style="color:red">{{$errors->first('twitter_call_back')}}</span>               
                                                                        @enderror
                                                                    </div> 
                                                            
                                                                </div>
                                                            </div>
                                                        <div class="submit">
                                                            <button type="submit" class="btn btn-primary">Save</button>
                                                        </div>
                                                </form>
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
    </div>
    <!-- END: Content-->

@endsection
