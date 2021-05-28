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
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Payment Settings</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a>
                                    </li>
                                    {{-- <li class="breadcrumb-item"><a href="#">Pages</a>
                                    </li> --}}
                                    <li class="breadcrumb-item active"> Payment Settings
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
                                <a class="nav-link d-flex py-75 active" id="general-pill-paypal" data-toggle="pill" href="#general-vertical-paypal" aria-expanded="true">
                                    <i class="feather icon-globe mr-50 font-medium-3"></i>
                                    Paypal
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex py-75" id="general-pill-stripe" data-toggle="pill" href="#general-vertical-stripe" aria-expanded="false">
                                    <i class="feather icon-settings mr-50 font-medium-3"></i>
                                    Stripe
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex py-75" id="general-pill-cashondelivery" data-toggle="pill" href="#general-vertical-cashondelivery" aria-expanded="false">
                                    <i class="feather icon-at-sign mr-50 font-medium-3"></i>
                                    Cash On Delivery
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex py-75" id="general-pill-bank" data-toggle="pill" href="#general-vertical-bank" aria-expanded="false">
                                    <i class="feather icon-mail mr-50 font-medium-3"></i>
                                    Bank Transfer
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
                                        <div role="tabpanel" class="tab-pane active" id="general-vertical-paypal" aria-labelledby="general-pill-paypal" aria-expanded="true">
                                             <h3>PayPal</h3>
                                                    <form role="form" class="dashboardForm"  method="post" action=" ">
                                                        {{csrf_field()}}
                                                            <div class="row">
                                                                <div class="col-12">
                                                                <div class="form-group">
                                                                    <label class="paypal_status">Status</label>
                                                                    <div class="form-check">
                                                                        {{-- {{dd(get_meta_by_key('paypal_status')=='on' )}} --}}
                                                                        <input class="form-check-input" name="paypal_status" type="hidden" id="gridCheck1" value="off">
                                                                        <input class="form-check-input" name="paypal_status" type="checkbox" id="gridCheck1" {{ get_meta_by_key('paypal_status')=="on" ? 'checked' : ''}}>
                                                                        <label class="form-check-label" for="gridCheck1">
                                                                        Enable PayPal
                                                                        </label>
                                                                    </div>
                                                                    @error($errors)
                                                                    <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="paypal_label">Label<span style="color:red">*</span></label>
                                                                    <input type="text" class="form-control" name="paypal_label" id="paypal_label" placeholder="Pay Pal" value="{{get_meta_by_key('paypal_label')}}">
                                                                    @error($errors)
                                                                    <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
                                                                    @enderror
                                                                </div> 
                                                                <div class="form-group">
                                                                    <label class="paypal_description">Description<span style="color:red">*</span></label>
                                                                    <textarea type="text" class="form-control" name="paypal_description" id="Description" rows="5" aria-expanded="true">{{ get_meta_by_key('paypal_description')}}</textarea>
                                                                    @error($errors)
                                                                    <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="paypal_sandbox">Sandbox</label>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" name="paypal_sandbox" type="hidden" id="gridCheck1" value="off">
                                                                        <input class="form-check-input" name="paypal_sandbox" type="checkbox" id="gridCheck1" value="on" {{ get_meta_by_key('paypal_sandbox')==="on" ? 'checked' : ''}}>
                                                                        <label class="form-check-label" for="gridCheck1">
                                                                        Use sandbox for test payments
                                                                        </label>
                                                                    </div>
                                                                    @error($errors)
                                                                    <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="paypal_client_id">Cliend ID<span style="color:red">*</span></label>
                                                                    <input type="text" class="form-control" name="paypal_client_id" id="paypal_client_id" placeholder="AYQ20ue1-_QonQDJxFW6z0jvLHAOjZTo-Zlc_ubVYMLLNADxN67K6RyDx-U37FP_TW8XTEcPTbRz4fK8" value="{{ get_meta_by_key('paypal_client_id')}}">
                                                                    @error($errors)
                                                                    <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
                                                                    @enderror
                                                                </div> 
                                                                <div class="form-group">
                                                                    <label class="paypal_secreate_key">Secrete Key<span style="color:red">*</span></label>
                                                                    <input type="password" class="form-control" name="paypal_secreate_key" id="paypal_secreate_key" value="{{ get_meta_by_key('paypal_secreate_key')}}">
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
                                        <div class="tab-pane fade " id="general-vertical-stripe" role="tabpanel" aria-labelledby="general-pill-stripe" aria-expanded="false">
                                            <h3>stripe</h3>
                                                <form role="form" class="dashboardForm"  method="post" action=" ">
                                                    {{csrf_field()}}
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label class="stripe_status">Status</label>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" name="stripe_status" type="hidden" id="gridCheck1"  value="off">
                                                                    <input class="form-check-input" name="stripe_status" type="checkbox" id="gridCheck1" value="on" {{ get_meta_by_key('stripe_status')==="on" ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="gridCheck1">
                                                                    Enable stripe
                                                                    </label>
                                                                </div>
                                                                @error($errors)
                                                                <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="stripe_label">Label<span style="color:red">*</span></label>
                                                                <input type="text" class="form-control" name="stripe_label" id="stripe_label" placeholder="Stripe" value="{{ get_meta_by_key('stripe_label')}}">
                                                                @error($errors)
                                                                <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
                                                                @enderror
                                                            </div> 
                                                            <div class="form-group">
                                                                <label class="stripe_description">Description<span style="color:red">*</span></label>
                                                                <textarea type="text" class="form-control" name="stripe_description" id="Description" rows="5" aria-expanded="true">{{ get_meta_by_key('stripe_description')}}</textarea>
                                                                @error($errors)
                                                                <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="stripe_publishable_key">Publishable Key<span style="color:red">*</span></label>
                                                                <input type="text" class="form-control" name="stripe_publishable_key" id="stripe_publishable_key" placeholder="pk_test_VCIxKTRnJJR52Wctja8JwUKp00epVb2jTv" value="{{ get_meta_by_key('stripe_publishable_key')}}">
                                                                @error($errors)
                                                                <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
                                                                @enderror
                                                            </div> 
                                                            <div class="form-group">
                                                                <label class="stripe_secreate_key">Secrete Key<span style="color:red">*</span></label>
                                                                <input type="password" class="form-control" name="stripe_secreate_key" id="stripe_secreate_key" value="{{ get_meta_by_key('stripe_secreate_key')}}">
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
                                        <div class="tab-pane fade" id="general-vertical-cashondelivery" role="tabpanel" aria-labelledby="general-pill-cashondelivery" aria-expanded="false">
                                            <h3>Cash On Delivery</h3>
                                                <form role="form" class="dashboardForm"  method="post" action=" ">
                                                    {{csrf_field()}}
                                                    <div class="row">
                                                    <div class="col-12">
                                                            <div class="form-group">
                                                                <label class="cash_on_delivery_status">Status</label>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" name="cash_on_delivery_status" type="hidden" id="gridCheck1" value="off" >
                                                                    <input class="form-check-input" name="cash_on_delivery_status" type="checkbox" id="gridCheck1" value="on" {{ get_meta_by_key('cash_on_delivery_status')==true ??  'checked'}}>
                                                                    <label class="form-check-label" for="gridCheck1">
                                                                    Enable Cash On Delivery
                                                                    </label>
                                                                </div>
                                                                @error($errors)
                                                                <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="cash_on_delivery_label">Label<span style="color:red">*</span></label>
                                                                <input type="text" class="form-control" name="cash_on_delivery_label" id="cash_on_delivery_label" placeholder="Cash On Delivery" value="{{ get_meta_by_key('cash_on_delivery_label')}}">
                                                                @error($errors)
                                                                <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
                                                                @enderror
                                                            </div> 
                                                            <div class="form-group">
                                                                <label class="cash_on_delivery_description">Description<span style="color:red">*</span></label>
                                                                <textarea type="text" class="form-control" name="cash_on_delivery_description" id="Description" rows="5" aria-expanded="true">{{ get_meta_by_key('cash_on_delivery_description')}}</textarea>
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
                                        <div class="tab-pane fade " id="general-vertical-bank" role="tabpanel" aria-labelledby="general-pill-bank" aria-expanded="false">
                                           <h3>Bank Transfer</h3>
                                                <form role="form" class="dashboardForm"  method="post" action=" ">
                                                    {{csrf_field()}}
                                                    <div class="row">
                                                    <div class="col-12">
                                                            <div class="form-group">
                                                                <label class="bank_transfer_status">Status</label>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" name="bank_transfer_status" type="hidden" id="gridCheck1" value="off">
                                                                    <input class="form-check-input" name="bank_transfer_status" type="checkbox" id="gridCheck1" value="on" {{ get_meta_by_key('bank_transfer_status')==true ?  'checked' :true}}>
                                                                    <label class="form-check-label" for="gridCheck1">
                                                                    Enable Bank Transfer
                                                                    </label>
                                                                </div>
                                                                @error($errors)
                                                                <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="bank_transfer_label">Label<span style="color:red">*</span></label>
                                                                <input type="text" class="form-control" name="bank_transfer_label" id="bank_transfer_label" placeholder="Bank Transfer" value="{{ get_meta_by_key('bank_transfer_label')}}">
                                                                @error($errors)
                                                                <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
                                                                @enderror
                                                            </div> 
                                                            <div class="form-group">
                                                                <label class="bank_transfer_description">Description<span style="color:red">*</span></label>
                                                                <textarea type="text" class="form-control" name="bank_transfer_description" id="bank_transfer_description" rows="5" aria-expanded="true">{{ get_meta_by_key('bank_transfer_description')}}</textarea>
                                                                @error($errors)
                                                                <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="cash_on_delivery_instruction">Instruction<span style="color:red">*</span></label>
                                                                <textarea type="text" class="form-control" name="cash_on_delivery_instruction" id="Description" rows="5" aria-expanded="true" >
                                                                {{ get_meta_by_key('cash_on_delivery_instruction')}}
                                                                </textarea>
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
