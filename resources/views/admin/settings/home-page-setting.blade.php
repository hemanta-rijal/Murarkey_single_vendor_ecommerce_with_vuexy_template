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
                            <h2 class="content-header-title float-left mb-0">Home Page Settings</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a>
                                    </li>
                                    {{-- <li class="breadcrumb-item"><a href="#">Pages</a>
                                    </li> --}}
                                    <li class="breadcrumb-item active"> Home Page Settings
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
                                <a class="nav-link d-flex py-75 active" id="general-pill-adsetting" data-toggle="pill" href="#general-vertical-adsetting" aria-expanded="true">
                                    <i class="feather icon-globe mr-50 font-medium-3"></i>
                                    Ad Settings
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex py-75" id="general-pill-showcase" data-toggle="pill" href="#general-vertical-showcase" aria-expanded="false">
                                    <i class="feather icon-settings mr-50 font-medium-3"></i>
                                    Show Case Settings
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex py-75" id="general-pill-menu" data-toggle="pill" href="#general-vertical-menu" aria-expanded="false">
                                    <i class="feather icon-list mr-50 font-medium-3"></i>
                                    Menu Settings
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
                                        <div role="tabpanel" class="tab-pane active" id="general-vertical-adsetting" aria-labelledby="general-pill-adsetting" aria-expanded="true">
                                            <h3>Home Page Ads Settings</h3>
                                            {!! Form::open(['route' => 'admin.site-settings.update','files' => true]) !!}
                                            
                                            <div class="form-group">
                                                    <label class="firstAdStatus">First Ad Status<span style="color:red">*</span></label>
                                                    <div class="form-control custom-switch custom-control-inline">
                                                        <input  name="first_ad_status" type="hidden"  value="off">
                                                        <input class="custom-control-input" name="first_ad_status" type="checkbox" id="customSwitch1" value="on" {{get_theme_setting_by_key('first_ad_status')==="on" ? 'checked' : ''}}>
                                                        <label class="custom-control-label" for="customSwitch1">
                                                        </label>
                                                        <span class="switch-label">Publish First Ad Home Page.</span>
                                                </div>
                                                @error($errors)
                                                <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
                                                @enderror
                                            </div>

                                             
                                            <div class="form-group">
                                                <label class="first_ad_link">First Ad Link<span style="color:red">*</span></label>
                                                <input type="text" class="form-control" name="first_ad_link" id="first_ad_link" placeholder="First Ad Link" value="{{ get_theme_setting_by_key('first_ad_link')}}">
                                                @error($errors)
                                                <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="firstAd">Upload Image for First Ad<span style="color:red">*</span></label>
                                                <input type="file" class="form-control" placeholder="choose image for first ad" name="first_ad_image">
                                                <img  class="form-group" src="{!! map_storage_path_to_link(get_theme_setting_by_key('first_ad_image')) !!}" style="zoom: 0.5;">
                                                @error($errors)
                                                <span class="err-msg" style="color:red">{{$errors->first('first_ad_image')}}</span>               
                                                @enderror
                                            </div>
                                            
                                            <hr>
                                            <div class="form-group">
                                                <label class="secondAdStatus">Second Ad Status<span style="color:red">*</span></label>
                                                <div class="form-control custom-switch custom-control-inline">
                                                        <input  name="second_ad_status" type="hidden"  value="off">
                                                        <input class="custom-control-input" name="second_ad_status" type="checkbox" id="customSwitch2" value="on" {{get_theme_setting_by_key('second_ad_status')==="on" ? 'checked' : ''}}>
                                                        <label class="custom-control-label" for="customSwitch2">
                                                        </label>
                                                        <span class="switch-label">Publish Second Ad On Home Page</span>
                                                </div>
                                                @error($errors)
                                                <span class="err-msg" style="color:red">{{$errors->first('second_ad_status')}}</span>               
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="second_ad_link">Second Ad Link<span style="color:red">*</span></label>
                                                <input type="text" class="form-control" name="second_ad_link" id="second_ad_link" placeholder="Second Ad Link" value="{{ get_theme_setting_by_key('second_ad_link')}}">
                                                @error($errors)
                                                <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="secondAd">Upload Image for Second Ad<span style="color:red">*</span></label>
                                                <input type="file" class="form-control" placeholder="choose image for first ad" name="second_ad_image">
                                                <img  class="form-group" src="{!! map_storage_path_to_link(get_theme_setting_by_key('second_ad_image')) !!}" style="zoom: 0.5;">
                                                @error($errors)
                                                <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
                                                @enderror
                                            </div>

                                            <hr>
                                            <div class="form-group">
                                                <label class="thirdAdStatus">Third Ad Status<span style="color:red">*</span></label>
                                               <div class="form-control custom-switch custom-control-inline">
                                                        <input  name="third_ad_status" type="hidden"  value="off">
                                                        <input class="custom-control-input" name="third_ad_status" type="checkbox" id="customSwitch3" value="on" {{get_theme_setting_by_key('third_ad_status')==="on" ? 'checked' : ''}}>
                                                        <label class="custom-control-label" for="customSwitch3">
                                                        </label>
                                                        <span class="switch-label">Publish Third Ad On Home Page</span>
                                                </div>
                                                @error($errors)
                                                <span class="err-msg" style="color:red">{{$errors->first('third_ad_status')}}</span>               
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="third_ad_link">Third Ad Link<span style="color:red">*</span></label>
                                                <input type="text" class="form-control" name="third_ad_link" id="third_ad_link" placeholder="Third Ad Link" value="{{ get_theme_setting_by_key('third_ad_link')}}">
                                                @error($errors)
                                                <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="thirdAd">Upload Image for Third Ad<span style="color:red">*</span></label>
                                                <input type="file" class="form-control" placeholder="choose image for first ad" name="third_ad_image">
                                                <img  class="form-group" src="{!! map_storage_path_to_link(get_theme_setting_by_key('third_ad_image')) !!}" style="zoom: 0.5;">
                                                @error($errors)
                                                <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
                                                @enderror
                                            </div>

                                            <hr>
                                            <div class="form-group">
                                                <label class="fourthAdStatus">Fourth Ad Status<span style="color:red">*</span></label>
                                              
                                                 <div class="form-control custom-switch custom-control-inline">
                                                        <input  name="fourth_ad_status" type="hidden"  value="off">
                                                        <input class="custom-control-input" name="fourth_ad_status" type="checkbox" id="customSwitch4" value="on" {{get_theme_setting_by_key('fourth_ad_status')==="on" ? 'checked' : ''}}>
                                                        <label class="custom-control-label" for="customSwitch4">
                                                        </label>
                                                        <span class="switch-label">Publish Fourth Ad On Home Page</span>
                                                </div>
                                                @error($errors)
                                                <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="fourth_ad_link">Frourth Ad Link<span style="color:red">*</span></label>
                                                <input type="text" class="form-control" name="fourth_ad_link" id="fourth_ad_link" placeholder="Frourth Ad Link" value="{{ get_theme_setting_by_key('fourth_ad_link')}}">
                                                @error($errors)
                                                <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="fourthAd">Upload Image for Fourth Ad<span style="color:red">*</span></label>
                                                <input type="file" class="form-control" placeholder="choose image for first ad" name="fourth_ad_image">
                                                <img  class="form-group" src="{!! map_storage_path_to_link(get_theme_setting_by_key('fourth_ad_image')) !!}" style="zoom: 0.5;">
                                                @error($errors)
                                                <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
                                                @enderror
                                            </div>
                                            <hr>
                                            <div class="form-group">
                                                <label class="fifthAdStatus">Fifth Ad Status<span style="color:red">*</span></label>

                                                <div class="form-control custom-switch custom-control-inline">
                                                        <input  name="fifth_ad_status" type="hidden"  value="off">
                                                        <input class="custom-control-input" name="fifth_ad_status" type="checkbox" id="customSwitch5" value="on" {{get_theme_setting_by_key('fifth_ad_status')==="on" ? 'checked' : ''}}>
                                                        <label class="custom-control-label" for="customSwitch5">
                                                        </label>
                                                        <span class="switch-label">Publish Fifth Ad On Home Page</span>
                                                </div>
                                                @error($errors)
                                                <span class="err-msg" style="color:red">{{$errors->first('fifth_ad_status')}}</span>               
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="fifth_ad_link">Fifth Ad Link<span style="color:red">*</span></label>
                                                <input type="text" class="form-control" name="fifth_ad_link" id="fifth_ad_link" placeholder="Fifth Ad Link" value="{{ get_theme_setting_by_key('fifth_ad_link')}}">
                                                @error($errors)
                                                <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="fifthAd">Upload Image for Fifth Ad<span style="color:red">*</span></label>
                                                <input type="file" class="form-control" placeholder="choose image for first ad" name="fifth_ad_image">
                                                <img  class="form-group" src="{!! map_storage_path_to_link(get_theme_setting_by_key('fifth_ad_image')) !!}" style="zoom: 0.5;">
                                                @error($errors)
                                                <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                        <div class="tab-pane fade " id="general-vertical-showcase" role="tabpanel" aria-labelledby="general-pill-showcase" aria-expanded="false">
                                           <h3>Home Page Product Showcase Settings</h3>
                                             {!! Form::open(['route' => 'admin.site-settings.update','files' => true]) !!}

                                            <div class="form-group">
                                                <label class="flash_sale_status">"Flash Sale" Status<span style="color:red">*</span></label>
                                              
                                                  <div class="form-control custom-switch custom-control-inline">
                                                        <input  name="flash_sale_status" type="hidden"  value="off">
                                                        <input class="custom-control-input" name="flash_sale_status" type="checkbox" id="customSwitch6" value="on" {{get_theme_setting_by_key('flash_sale_status')==="on" ? 'checked' : ''}}>
                                                        <label class="custom-control-label" for="customSwitch6">
                                                        </label>
                                                        <span class="switch-label">Flash Sale Status</span>
                                                </div>
                                                @error($errors)
                                                <span class="err-msg" style="color:red">{{$errors->first('flash_sale_status')}}</span>               
                                                @enderror

                                            </div>
                                            <div class="form-group">
                                                <label class="max_number_of_flash_sale_item">Maximum Number of Product Item On "Flash Sale Item"<span style="color:red">*</span></label>
                                                <input type="text" class="form-control" name="max_number_of_flash_sale_item" id="max_number_of_flash_sale_item" placeholder="Maximum Number of Flash Sale Product Item" value="{{ get_theme_setting_by_key('max_number_of_flash_sale_item')}}">
                                                @error($errors)
                                                <span class="err-msg" style="color:red">{{$errors->first('max_number_of_flash_sale_item')}}</span>
                                                @enderror
                                            </div>

                                            <hr>
                                            <div class="form-group">
                                                <label class="new_arrivals_status">"New Arrivals" Showcase Status<span style="color:red">*</span></label>
                                          
                                                  <div class="form-control custom-switch custom-control-inline">
                                                        <input  name="new_arrivals_status" type="hidden"  value="off">
                                                        <input class="custom-control-input" name="new_arrivals_status" type="checkbox" id="customSwitch7" value="on" {{get_theme_setting_by_key('new_arrivals_status')==="on" ? 'checked' : ''}}>
                                                        <label class="custom-control-label" for="customSwitch7">
                                                        </label>
                                                        <span class="switch-label">New Arrivals Showcase Status</span>
                                                </div>
                                                @error($errors)
                                                <span class="err-msg" style="color:red">{{$errors->first('new_arrivals_status')}}</span>               
                                                @enderror

                                            </div>
                                            <div class="form-group">
                                                <label class="max_number_of_items_on_new_arrivals">Maximum Number of Product Item On "New Arrivals"<span style="color:red">*</span></label>
                                                <input type="text" class="form-control" name="max_number_of_items_on_new_arrivals" id="max_number_of_items_on_new_arrivals" placeholder="Maximum Number of New Arrivals Product Item" value="{{ get_theme_setting_by_key('max_number_of_items_on_new_arrivals')}}">
                                                @error($errors)
                                                <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
                                                @enderror
                                            </div>

                                            <hr>
                                            <div class="form-group">
                                                <label class="featuredProduct">"Featured Category" Showcase Status<span style="color:red">*</span></label>
                                                
                                                  <div class="form-control custom-switch custom-control-inline">
                                                        <input  name="featured_category_status" type="hidden"  value="off">
                                                        <input class="custom-control-input" name="featured_category_status" type="checkbox" id="customSwitch8" value="on" {{get_theme_setting_by_key('featured_category_status')==="on" ? 'checked' : ''}}>
                                                        <label class="custom-control-label" for="customSwitch8">
                                                        </label>
                                                        <span class="switch-label"> Featured Category Status</span>
                                                </div>
                                                @error($errors)
                                                <span class="err-msg" style="color:red">{{$errors->first('featured_category_status')}}</span>               
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="max_number_of_item_on_products_below_1500">Maximum Number of Product Item On "Product below 1500"<span style="color:red">*</span></label>
                                                <input type="text" class="form-control" name="max_number_of_item_on_products_below_1500" id="max_number_of_item_on_products_below_1500" placeholder="Maximum Number of New Arrivals Product Item" value="{{ get_theme_setting_by_key('max_number_of_item_on_products_below_1500')}}">
                                                @error($errors)
                                                <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
                                                @enderror
                                            </div>
                                            
                                            <hr>
                                            <div class="form-group">
                                                <label class="you_may_like_products_status">"You May Like" Showcase Status<span style="color:red">*</span></label>
                                                 
                                                  <div class="form-control custom-switch custom-control-inline">
                                                        <input  name="you_may_like_products_status" type="hidden"  value="off">
                                                        <input class="custom-control-input" name="you_may_like_products_status" type="checkbox" id="customSwitch9" value="on" {{get_theme_setting_by_key('you_may_like_products_status')==="on" ? 'checked' : ''}}>
                                                        <label class="custom-control-label" for="customSwitch9">
                                                        </label>
                                                        <span class="switch-label"> You May Like Status</span>
                                                </div>
                                                @error($errors)
                                                <span class="err-msg" style="color:red">{{$errors->first('you_may_like_products_status')}}</span>               
                                                @enderror

                                            </div>

                                            <div class="form-group">
                                                <label class="max_number_of_you_may_like_items">Maximum Number of Product Item On "You May Like"<span style="color:red">*</span></label>
                                                <input type="text" class="form-control" name="max_number_of_you_may_like_items" id="max_number_of_you_may_like_items" placeholder="Maximum Number of New Arrivals Product Item" value="{{ get_theme_setting_by_key('max_number_of_items_on_new_arrivals')}}">
                                                @error($errors)
                                                <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
                                                @enderror
                                            </div>
                                            
                                            <hr>
                                            <div class="form-group">
                                                <label class="productBelow1500">"Product Below 1500" Showcase Status<span style="color:red">*</span></label>
                                               
                                                  <div class="form-control custom-switch custom-control-inline">
                                                        <input  name="products_below_1500_status" type="hidden"  value="off">
                                                        <input class="custom-control-input" name="products_below_1500_status" type="checkbox" id="customSwitch10" value="on" {{get_theme_setting_by_key('products_below_1500_status')==="on" ? 'checked' : ''}}>
                                                        <label class="custom-control-label" for="customSwitch10">
                                                        </label>
                                                        <span class="switch-label">Product Below 1500 Status</span>
                                                </div>
                                                @error($errors)
                                                <span class="err-msg" style="color:red">{{$errors->first('products_below_1500_status')}}</span>               
                                                @enderror
                                            </div>
                                            <hr>
                                

                                            <div class="form-group">
                                              <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                        <div class="tab-pane fade " id="general-vertical-menu" role="tabpanel" aria-labelledby="general-pill-menu" aria-expanded="false">
                                           <h3>Choose Menus For Different Positions</h3>
                                             {!! Form::open(['route' => 'admin.site-settings.update','files' => true]) !!}

                                             <div class="form-group">
                                                 <label class="primary_menu">Choose Primary Menu <span style="color: blue">(Header menu at top side)</span></label>  
                                                 <select name="primary_menu" id="primary_menu" class="form-control">
                                                          @foreach (get_menu_types() as $menu)
                                                          <option {{get_theme_setting_by_key('primary_menu')==$menu->id ? 'selected' : ''}} value="{{$menu->id}}">{{$menu->name}}</option>
                                                          @endforeach
                                                      </select>
                                                @error($errors)
                                                <span class="err-msg" style="color:red">{{$errors->first('primary_menu')}}</span>               
                                                @enderror
                                            </div>
                                             <div class="form-group">
                                                 <label class="quick_links_menu">Choose Quick Links Menu <span style="color: blue">(Footer menu at second column)</span></label>  
                                                 <select name="quick_links_menu" id="quick_links_menu" class="form-control">
                                                          @foreach (get_menu_types() as $menu)
                                                          <option {{get_theme_setting_by_key('quick_links_menu')==$menu->id ? 'selected' : ''}} value="{{$menu->id}}">{{$menu->name}}</option>
                                                          @endforeach
                                                      </select>
                                                @error($errors)
                                                <span class="err-msg" style="color:red">{{$errors->first('quick_links_menu')}}</span>               
                                                @enderror
                                            </div>
                                             <div class="form-group">
                                                 <label class="site_links_menu">Choose Site Links Menu <span style="color: blue">(Footer Menu at third column)</span></label>  
                                                 <select name="site_links_menu" id="site_links_menu" class="form-control">
                                                          @foreach (get_menu_types() as $menu)
                                                          <option {{get_theme_setting_by_key('site_links_menu')==$menu->id ? 'selected' : ''}} value="{{$menu->id}}">{{$menu->name}}</option>
                                                          @endforeach
                                                      </select>
                                                @error($errors)
                                                <span class="err-msg" style="color:red">{{$errors->first('site_links_menu')}}</span>               
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                              <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                            {!! Form::close() !!}
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
