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
                            <h2 class="content-header-title float-left mb-0">Shipping Method Settings</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a>
                                    </li>
                                    {{-- <li class="breadcrumb-item"><a href="#">Pages</a>
                                    </li> --}}
                                    <li class="breadcrumb-item active"> Shipping Method Settings
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrum-right">
                        <div class="dropdown">
                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-settings"></i></button>
                            <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Chat</a><a class="dropdown-item" href="#">Email</a><a class="dropdown-item" href="#">Calendar</a></div>
                        </div>
                    </div>
                </div> --}}
            </div>
            <div class="content-body">
            <section id="page-general-settings">
                <div class="row">
                    <!-- left menu section -->
                    <div class="col-md-3 mb-2 mb-md-0">
                        <ul class="nav nav-pills flex-column mt-md-0 mt-1">
                            <li class="nav-item">
                                <a class="nav-link d-flex py-75 active" id="general-pill-freeshipping" data-toggle="pill" href="#general-vertical-freeshipping" aria-expanded="true">
                                    <i class="feather icon-globe mr-50 font-medium-3"></i>
                                    Free Shipping
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex py-75" id="general-pill-localpickup" data-toggle="pill" href="#general-vertical-localpickup" aria-expanded="false">
                                    <i class="feather icon-settings mr-50 font-medium-3"></i>
                                    Local Pick-Up
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex py-75" id="general-pill-flatrate" data-toggle="pill" href="#general-vertical-flatrate" aria-expanded="false">
                                    <i class="feather icon-at-sign mr-50 font-medium-3"></i>
                                    Flat Rate
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex py-75" id="general-pill-insideringroad" data-toggle="pill" href="#general-vertical-insideringroad" aria-expanded="false">
                                    <i class="feather icon-sunset mr-50 font-medium-3"></i>
                                    Shipping Inside Ring Road
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex py-75" id="general-pill-outsideringroad" data-toggle="pill" href="#general-vertical-outsideringroad" aria-expanded="false">
                                    <i class="feather icon-sunrise mr-50 font-medium-3"></i>
                                    Shipping Outside Ring Road
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
                                        <div role="tabpanel" class="tab-pane active" id="general-vertical-freeshipping" aria-labelledby="general-pill-freeshipping" aria-expanded="true">
                                            <h3>Free Shipping</h3>
                                                 {!! Form::open(['route' => 'admin.system-settings.update','files' => true,'class' => 'dashboardForm']) !!}
                                                    {{csrf_field()}}
                                                    <div class="row">
                                                    <div class="col-12">
                                                            <div class="form-group">
                                                                <label class="free_shipping_status">Status</label>
                                                                 
                                                                     <div class="form-control custom-switch custom-control-inline">
                                                                        <input  name="free_shipping_status" type="hidden"  value="off">
                                                                        <input class="custom-control-input" name="free_shipping_status" type="checkbox" id="customSwitch1" value="on" {{get_meta_by_key('free_shipping_status')==="on" ? 'checked' : ''}}>
                                                                        <label class="custom-control-label" for="customSwitch1">
                                                                        </label>
                                                                        <span class="switch-label"> Enable Free Shipping</span>
                                                                    </div>
                                                                    @error($errors)
                                                                    <span class="err-msg" style="color:red">{{$errors->first('free_shipping_status')}}</span>               
                                                                    @enderror

                                                            </div>
                                                            <div class="form-group">
                                                                <label class="free_shipping_label">Label</label>
                                                                <input type="text" class="form-control" name="free_shipping_label" id="free_shipping_label" placeholder="Free Shipping" value="{{ get_meta_by_key('free_shipping_label')}}">
                                                                @error($errors)
                                                                <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
                                                                @enderror
                                                            </div> 
                                                            <div class="form-group">
                                                                <label class="free_shipping_minimum_amount">Minimum Amount<span style="color:red">*</span></label>
                                                                <input type="number" class="form-control" name="free_shipping_minimum_amount" id="free_shipping_minimum_amount" placeholder="20" value="{{ get_meta_by_key('free_shipping_minimum_amount')}}">
                                                                @error($errors)
                                                                <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
                                                                @enderror
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="submit">
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </div>
                                                </form>
                                        </div>
                                        <div class="tab-pane fade " id="general-vertical-localpickup" role="tabpanel" aria-labelledby="general-pill-localpickup" aria-expanded="false">
                                            <h3>Local Pickup</h3>
                                            <div class=" box-primary">
                                                 {!! Form::open(['route' => 'admin.system-settings.update','files' => true,'class' => 'dashboardForm']) !!}
                                                    {{csrf_field()}}
                                                    <div class="row">
                                                    <div class="col-12">
                                                            <div class="form-group">
                                                                <label class="local_pick_up_status">Status</label>
                                                               
                                                                     <div class="form-control custom-switch custom-control-inline">
                                                                        <input  name="local_pick_up_status" type="hidden"  value="off">
                                                                        <input class="custom-control-input" name="local_pick_up_status" type="checkbox" id="customSwitch2" value="on" {{get_meta_by_key('local_pick_up_status')==="on" ? 'checked' : ''}}>
                                                                        <label class="custom-control-label" for="customSwitch2">
                                                                        </label>
                                                                        <span class="switch-label"> Enable Local Pick Up</span>
                                                                    </div>
                                                                    @error($errors)
                                                                    <span class="err-msg" style="color:red">{{$errors->first('local_pick_up_status')}}</span>               
                                                                    @enderror

                                                            </div>
                                                            <div class="form-group">
                                                                <label class="local_pickup_label">Label</label>
                                                                <input type="text" class="form-control" name="local_pickup_label" id="local_pickup_label" placeholder="Local Pickup" value="{{ get_meta_by_key('local_pickup_label')}}">
                                                                @error($errors)
                                                                <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
                                                                @enderror
                                                            </div> 
                                                            <div class="form-group">
                                                                <label class="local_pickup_cost">Cost<span style="color:red">*</span></label>
                                                                <input type="number" class="form-control" name="local_pickup_cost" id="local_pickup_cost" placeholder="20" value="{{ get_meta_by_key('local_pickup_cost')}}">
                                                                @error($errors)
                                                                <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
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
                                        <div class="tab-pane fade " id="general-vertical-flatrate" role="tabpanel" aria-labelledby="general-pill-flatrate" aria-expanded="false">
                                           <h3>Flat Rate</h3>
                                            <div class=" box-primary">
                                                 {!! Form::open(['route' => 'admin.system-settings.update','files' => true,'class' => 'dashboardForm']) !!}
                                                    {{csrf_field()}}
                                                    <div class="row">
                                                    <div class="col-12">
                                                            <div class="form-group">
                                                                <label class="flat_rate_status">Status</label>
                                                                
                                                                     <div class="form-control custom-switch custom-control-inline">
                                                                        <input  name="flat_rate_status" type="hidden"  value="off">
                                                                        <input class="custom-control-input" name="flat_rate_status" type="checkbox" id="customSwitch3" value="on" {{get_meta_by_key('flat_rate_status')==="on" ? 'checked' : ''}}>
                                                                        <label class="custom-control-label" for="customSwitch3">
                                                                        </label>
                                                                        <span class="switch-label"> Enable Flat Rate</span>
                                                                    </div>
                                                                    @error($errors)
                                                                    <span class="err-msg" style="color:red">{{$errors->first('flat_rate_status')}}</span>               
                                                                    @enderror

                                                            </div>
                                                            <div class="form-group">
                                                                <label class="flat_rate_label">Label</label>
                                                                <input type="text" class="form-control" name="flat_rate_label" id="flat_rate_label" placeholder="Flat Rate" value="{{ get_meta_by_key('flat_rate_label')}}">
                                                                @error($errors)
                                                                <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
                                                                @enderror
                                                            </div> 
                                                            <div class="form-group">
                                                                <label class="flat_rate_cost">Cost<span style="color:red">*</span></label>
                                                                <input type="number" class="form-control" name="flat_rate_cost" id="flat_rate_cost" placeholder="20" value="{{ get_meta_by_key('flat_rate_cost')}}">
                                                                @error($errors)
                                                                <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
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
                                        <div class="tab-pane fade " id="general-vertical-insideringroad" role="tabpanel" aria-labelledby="general-pill-insideringroad" aria-expanded="false">
                                           <h3>Shipping Inside Ring Road</h3>
                                            <div class=" box-primary">
                                                 {!! Form::open(['route' => 'admin.system-settings.update','files' => true,'class' => 'dashboardForm']) !!}
                                                    {{csrf_field()}}
                                                    <div class="row">
                                                    <div class="col-12">
                                                            <div class="form-group">
                                                                <label class="shipping_inside_ringroad_status">Status</label>
                                                                
                                                                     <div class="form-control custom-switch custom-control-inline">
                                                                        <input  name="shipping_inside_ringroad_status" type="hidden"  value="off">
                                                                        <input class="custom-control-input" name="shipping_inside_ringroad_status" type="checkbox" id="customSwitch4" value="on" {{get_meta_by_key('shipping_inside_ringroad_status')==="on" ? 'checked' : ''}}>
                                                                        <label class="custom-control-label" for="customSwitch4">
                                                                        </label>
                                                                        <span class="switch-label">Shipping Inside Ringroad Status</span>
                                                                    </div>
                                                                    @error($errors)
                                                                    <span class="err-msg" style="color:red">{{$errors->first('shipping_inside_ringroad_status')}}</span>               
                                                                    @enderror

                                                            </div>
                                                            <div class="form-group">
                                                                <label class="shipping_inside_ringroad_label">Label</label>
                                                                <input type="text" class="form-control" name="shipping_inside_ringroad_label" id="shipping_inside_ringroad_label" placeholder="Shipping Inside Ringroad Label" value="{{ get_meta_by_key('shipping_inside_ringroad_label')}}">
                                                                @error($errors)
                                                                <span class="err-msg" style="color:red">{{$errors->first('shipping_inside_ringroad_label')}}</span>               
                                                                @enderror
                                                            </div> 
                                                            <div class="form-group">
                                                                <label class="shipping_inside_ringroad_cost">Cost<span style="color:red">*</span></label>
                                                                <input type="number" class="form-control" name="shipping_inside_ringroad_cost" id="shipping_inside_ringroad_cost" placeholder="20" value="{{ get_meta_by_key('shipping_inside_ringroad_cost')}}">
                                                                @error($errors)
                                                                <span class="err-msg" style="color:red">{{$errors->first('shipping_inside_ringroad_cost')}}</span>               
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
                                        <div class="tab-pane fade " id="general-vertical-outsideringroad" role="tabpanel" aria-labelledby="general-pill-outsideringroad" aria-expanded="false">
                                           <h3>Shipping Outside Ring Road</h3>
                                            <div class=" box-primary">
                                                 {!! Form::open(['route' => 'admin.system-settings.update','files' => true,'class' => 'dashboardForm']) !!}
                                                    {{csrf_field()}}
                                                    <div class="row">
                                                    <div class="col-12">
                                                            <div class="form-group">
                                                                <label class="shipping_outside_ringroad_status">Status</label>
                                                                
                                                                     <div class="form-control custom-switch custom-control-inline">
                                                                        <input  name="shipping_outside_ringroad_status" type="hidden"  value="off">
                                                                        <input class="custom-control-input" name="shipping_outside_ringroad_status" type="checkbox" id="customSwitch5" value="on" {{get_meta_by_key('shipping_outside_ringroad_status')==="on" ? 'checked' : ''}}>
                                                                        <label class="custom-control-label" for="customSwitch5">
                                                                        </label>
                                                                        <span class="switch-label">Shipping Outside Ringroad Status</span>
                                                                    </div>
                                                                    @error($errors)
                                                                    <span class="err-msg" style="color:red">{{$errors->first('shipping_outside_ringroad_status')}}</span>               
                                                                    @enderror

                                                            </div>
                                                            <div class="form-group">
                                                                <label class="shipping_outside_ringroad_label">Label</label>
                                                                <input type="text" class="form-control" name="shipping_outside_ringroad_label" id="shipping_outside_ringroad_label" placeholder="Shipping Outside Ringroad Label" value="{{ get_meta_by_key('shipping_outside_ringroad_label')}}">
                                                                @error($errors)
                                                                <span class="err-msg" style="color:red">{{$errors->first('shipping_outside_ringroad_label')}}</span>               
                                                                @enderror
                                                            </div> 
                                                            <div class="form-group">
                                                                <label class="shipping_outside_ringroad_cost">Cost<span style="color:red">*</span></label>
                                                                <input type="number" class="form-control" name="shipping_outside_ringroad_cost" id="shipping_outside_ringroad_cost" placeholder="20" value="{{ get_meta_by_key('shipping_outside_ringroad_cost')}}">
                                                                @error($errors)
                                                                <span class="err-msg" style="color:red">{{$errors->first('shipping_outside_ringroad_cost')}}</span>               
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
                 
                </div>
            </section>

            </div>
        </div>
    </div>
    <!-- END: Content-->

@endsection
