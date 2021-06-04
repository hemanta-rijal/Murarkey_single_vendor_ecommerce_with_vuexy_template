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
                            <h2 class="content-header-title float-left mb-0">System Settings</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a>
                                    </li>
                                    {{-- <li class="breadcrumb-item"><a href="#">Pages</a>
                                    </li> --}}
                                    <li class="breadcrumb-item active"> System Settings
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
                                <a class="nav-link d-flex py-75 active" id="general-pill-generalsettings" data-toggle="pill" href="#general-vertical-generalsettings" aria-expanded="true">
                                    <i class="feather icon-globe mr-50 font-medium-3"></i>
                                    General
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex py-75" id="general-pill-maintenance" data-toggle="pill" href="#general-vertical-maintenance" aria-expanded="false">
                                    <i class="feather icon-settings mr-50 font-medium-3"></i>
                                    Maintenance
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex py-75" id="general-pill-currency" data-toggle="pill" href="#general-vertical-currency" aria-expanded="false">
                                    <i class="feather icon-at-sign mr-50 font-medium-3"></i>
                                    Currency
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex py-75" id="general-pill-mail" data-toggle="pill" href="#general-vertical-mail" aria-expanded="false">
                                    <i class="feather icon-mail mr-50 font-medium-3"></i>
                                    Mail
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex py-75" id="general-pill-newsletter" data-toggle="pill" href="#general-vertical-newsletter" aria-expanded="false">
                                    <i class="feather icon-file-text mr-50 font-medium-3"></i>
                                    Newsletter
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex py-75" id="general-pill-seoanalytics" data-toggle="pill" href="#general-vertical-seoanalytics" aria-expanded="false">
                                    <i class="feather icon-slack mr-50 font-medium-3"></i>
                                    SEO Analytics
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex py-75" id="general-pill-socialLinks" data-toggle="pill" href="#general-vertical-socialLinks" aria-expanded="false">
                                    <i class="feather icon-tablet mr-50 font-medium-3"></i>
                                    Social Links
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex py-75" id="general-pill-custom" data-toggle="pill" href="#general-vertical-custom" aria-expanded="false">
                                    <i class="feather icon-message-circle mr-50 font-medium-3"></i>
                                    Custom CSS/JS
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
                                        <div role="tabpanel" class="tab-pane active" id="general-vertical-generalsettings" aria-labelledby="general-pill-generalsettings" aria-expanded="true">

                                                <h3>General</h3>
                                                 {!! Form::open(['route' => 'admin.system-settings.update','files' => true,'class' => 'dashboardForm']) !!}
                                                <div class="form-group">
                                                    {!! Form::label('site_name', 'Site Name:') !!}
                                                    {!! Form::text('site_name', get_meta_by_key('site_name'), ['class' => 'form-control']) !!}
                                                    {!! $errors->first('site_name', '<div class="text-danger">:message</div>') !!}
                                                </div>
                                                <div class="form-group">
                                                    {!! Form::label('contact_email', 'Contact Email:') !!}
                                                    {!! Form::text('contact_email', get_meta_by_key('contact_email'), ['class' => 'form-control']) !!}
                                                    {!! $errors->first('contact_email', '<div class="text-danger">:message</div>') !!}
                                                </div>
                                                <div class="form-group">
                                                    {!! Form::label('logo', 'Site Logo:') !!}
                                                    {!! Form::file('logo') !!}
                                                    {!! $errors->first('logo', '<div class="text-danger">:message</div>') !!}
                                                    <img src="{!! map_storage_path_to_link(get_meta_by_key('logo')) !!}" style="zoom: 0.5;">
                                                </div>
                                                <div class="form-group">
                                                    {!! Form::label('site_description', 'Description:') !!}
                                                    {!! Form::textarea('site_description', get_meta_by_key('site_description'), ['class' => 'form-control']) !!}
                                                    {!! $errors->first('site_description', '<div class="text-danger">:message</div>') !!}
                                                </div>
                                                <div class="form-group">
                                                    <label class="supported_countries">Supported Countries<span style="color:red">*</span></label>
                                                    <input type="text" class="form-control" name="supported_countries" id="supported_countries" value="{{get_meta_by_key('supported_countries')}}">
                                                    @error($errors)
                                                    <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label class="default_country">Default Country<span style="color:red">*</span></label>
                                                    <input type="text" class="form-control" name="default_country" id="default_country" value="{{get_meta_by_key('default_country')}}">
                                                    @error($errors)
                                                    <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label class="supported_locales">Supported Locales<span style="color:red">*</span></label>
                                                    <input type="text" class="form-control" name="supported_locales" id="supported_locales"  value="{{get_meta_by_key('supported_locales')}}">
                                                    @error($errors)
                                                    <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label class="default_locale">Default Locale<span style="color:red">*</span></label>
                                                    <input type="text" class="form-control" name="default_locale" id="default_locale"  value="{{get_meta_by_key('default_locale')}}">
                                                    @error($errors)
                                                    <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label class="default_timezone">Default Timezone<span style="color:red">*</span></label>
                                                    <input type="text" class="form-control" name="default_timezone" id="default_timezone" value="{{get_meta_by_key('default_timezone')}}">
                                                    @error($errors)
                                                    <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                                                </div>
                                                {!! Form::close() !!}

                                        </div>
                                        <div class="tab-pane fade " id="general-vertical-maintenance" role="tabpanel" aria-labelledby="general-pill-maintenance" aria-expanded="false">
                                            <h3>Maintenance</h3>
                                                <form role="form" class="dashboardForm"  method="post" action=" ">
                                                    {{csrf_field()}}
                                                        <div class="row">
                                                            <div class="col-12">
                                                            <div class="form-group">
                                                                <label class="maintenance_mode">Maintenance Mode<span style="color:red">*</span></label>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" name="maintenance_mode" type="hidden" id="maintenance_mode" value="off">
                                                                    <input class="form-check-input form-control" name="maintenance_mode" type="checkbox" id="maintenance_mode" value="on" {{get_meta_by_key('maintenance_mode')==="on" ? 'checked' : ''}}>
                                                                    <label class="form-check-label" for="gridCheck1">
                                                                        Put the application into maintenance mode
                                                                    </label>
                                                                </div>
                                                                @error($errors)
                                                                <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
                                                                @enderror
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="allowed_IPs">Allowed IPs<span style="color:red">*</span></label>
                                                                <textarea type="text" class="form-control" name="allowed_IPs" id="allowed_IPs" rows="5" aria-expanded="true">{{get_meta_by_key('allowed_IPs')}}</textarea>
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
                                        <div class="tab-pane fade" id="general-vertical-currency" role="tabpanel" aria-labelledby="general-pill-currency" aria-expanded="false">
                                            <h3>Currencies</h3>
                                            <form role="form" class="dashboardForm"  method="post" action=" ">
                                                {{csrf_field()}}
                                                <div class="row">
                                                    <div class="col-12">
                                                            <div class="form-group">
                                                                    <label class="supported_currencies">Supported Currencies<span style="color:red">*</span></label>
                                                                    <input type="text" class="form-control" name="supported_currencies" id="supported_currencies" value="{{ get_meta_by_key('supported_currencies')}}">
                                                                    @error($errors)
                                                                    <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="default_currency">Default Currency<span style="color:red">*</span></label>
                                                                    <input type="text" class="form-control" name="default_currency" id="default_currency" value="{{ get_meta_by_key('default_currency')}}">
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
                                        <div class="tab-pane fade " id="general-vertical-mail" role="tabpanel" aria-labelledby="general-pill-mail" aria-expanded="false">
                                           <h3>Mail</h3>
                                                <form role="form" class="dashboardForm"  method="post" action=" ">
                                                    {{csrf_field()}}
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label class="mail_from_address">Mail From Address<span style="color:red">*</span></label>
                                                                <input type="text" class="form-control" name="mail_from_address" id="mail_from_address" placeholder="https://webcart.envaysoft.com/#maintenance" value="{{ get_meta_by_key('mail_from_address')}}">
                                                                @error($errors)
                                                                <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="mail_from_name">Mail From Name<span style="color:red">*</span></label>
                                                                <input type="text" class="form-control" name="mail_from_name" id="mail_from_name" placeholder="Customer Service" value="{{ get_meta_by_key('mail_from_name')}}">
                                                                @error($errors)
                                                                <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
                                                                @enderror
                                                            </div> 
                                                            <div class="form-group">
                                                                <label class="mail_host">Mail Host<span style="color:red">*</span></label>
                                                                <input type="text" class="form-control" name="mail_host" id="mail_host" placeholder="smtp.mailtrap.io" value="{{ get_meta_by_key('mail_host')}}">
                                                                @error($errors)
                                                                <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
                                                                @enderror
                                                            </div> 
                                                            <div class="form-group">
                                                                <label class="mail_port">Mail Port<span style="color:red">*</span></label>
                                                                <input type="text" class="form-control" name="mail_port" id="mail_port" placeholder="2525" value="{{ get_meta_by_key('mail_port')}}">
                                                                @error($errors)
                                                                <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
                                                                @enderror
                                                            </div> 
                                                            <div class="form-group">
                                                                <label class="mail_username">Mail Username<span style="color:red">*</span></label>
                                                                <input type="text" class="form-control" name="mail_username" id="mail_username" placeholder="ec71012ace256e" value="{{ get_meta_by_key('mail_username')}}">
                                                                @error($errors)
                                                                <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
                                                                @enderror
                                                            </div> 
                                                            <div class="form-group">
                                                                <label class="mail_password">Mail Password<span style="color:red">*</span></label>
                                                                <input type="password" class="form-control" name="mail_password" id="mail_password" placeholder="password" value="{{ get_meta_by_key('mail_password')}}">
                                                                @error($errors)
                                                                <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
                                                                @enderror
                                                            </div> 
                                                            <div class="form-group">
                                                                <label class="mail_encryption">Mail Encryption<span style="color:red">*</span></label>
                                                                <select name="mail_encryption" id="mail_encryption" class="form-control">
                                                                    <option value="ssl" {{get_meta_by_key('mail_encryption')== 'ssl' ? 'selected' : '' }}>SSL</option>
                                                                    <option value="tls" {{get_meta_by_key('mail_encryption')== 'tls' ? 'selected' : '' }}>Tls</option>
                                                                </select>
                                                                @error($errors)
                                                                <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
                                                                @enderror
                                                            </div> 
                                                        </div>
                                                        <div class="submit">
                                                            <button type="submit" class="btn btn-primary">Save</button>
                                                        </div>
                                                    </div>
                                                </form>
                                        </div>
                                        <div class="tab-pane fade" id="general-vertical-newsletter" role="tabpanel" aria-labelledby="general-pill-newsletter" aria-expanded="false">
                                            <h3>Newsletter</h3>
                                                <form role="form" class="dashboardForm"  method="post" action=" ">
                                                    {{csrf_field()}}
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                {{-- {{dd(get_meta_by_key('newsletter_mode'))}} --}}
                                                                <label class="newsletter_mode">Newsletter Mode<span style="color:red">*</span></label>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" name="newsletter_mode" type="hidden" id="gridCheck1" value="off">
                                                                    <input class="form-check-input" name="newsletter_mode" type="checkbox" id="gridCheck1" value="on" {{ get_meta_by_key('newsletter_mode')==="on" ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="gridCheck1" >
                                                                        Allow customers to subscribe to your newsletter.
                                                                    </label>
                                                                </div>
                                                                @error($errors)
                                                                <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="mailchimp_api_key">Mailchimp API Secrete Key<span style="color:red">*</span></label>
                                                                <input type="password" class="form-control" name="mailchimp_api_key" id="mailchimp_api_key" value="{{ get_meta_by_key('mailchimp_api_key')}}">
                                                                @error($errors)
                                                                <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="mailchimp_list_id">Mailchimp List ID<span style="color:red">*</span></label>
                                                                <input type="text" class="form-control" name="mailchimp_list_id" id="mailchimp_list_id" placeholder="ec71012ace256e" value="{{ get_meta_by_key('mailchimp_list_id')}}">
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
                                        <div class="tab-pane fade" id="general-vertical-seoanalytics" role="tabpanel" aria-labelledby="general-pill-seoanalytics" aria-expanded="false">
                                            <h3>SEO & Analytics Setting</h3>
                                                <form role="form" class="dashboardForm"  method="post" action=" ">
                                                      <h5>SEO Settings</h5>
                                                            <div class="form-group">
                                                                {!! Form::label('site_keywords', 'Keyword:') !!}
                                                                {!! Form::text('site_keywords', get_meta_by_key('site_keywords'), ['class' => 'form-control']) !!}
                                                                {!! $errors->first('site_keywords', '<div class="text-danger">:message</div>') !!}
                                                            </div>

                                                    <h5>Analytics<h5>
                                                        <div class="form-group">
                                                            {!! Form::label('tracking', 'Tracking Script:') !!}
                                                            {!! Form::textarea('tracking', get_meta_by_key('tracking'), ['class' => 'form-control']) !!}
                                                            {!! $errors->first('tracking', '<div class="text-danger">:message</div>') !!}
                                                            <p class="help-block">
                                                                To append this script just add : <span class="muted">@{!! get_meta_by_key('tacking') !!}</span> on your view.
                                                            </p>
                                                        </div>
                                                        <div class="form-group">
                                                            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                                                        </div>

                                                </form>
                                        </div>
                                        <div class="tab-pane fade" id="general-vertical-socialLinks" role="tabpanel" aria-labelledby="general-pill-socialLinks" aria-expanded="false">
                                            <h3>Social Links</h3>
                                                <form role="form" class="dashboardForm"  method="post" action=" ">
                                                    <div class="form-group">
                                                        {!! Form::label('facebook_link', 'Facebook Link:') !!}
                                                        {!! Form::text('facebook_link', get_meta_by_key('facebook_link'), ['class' => 'form-control']) !!}
                                                        {!! $errors->first('facebook_link', '<div class="text-danger">:message</div>') !!}
                                                    </div>
                                                    <div class="form-group">
                                                        {!! Form::label('twitter_link', 'Twitter Link:') !!}
                                                        {!! Form::text('twitter_link', get_meta_by_key('twitter_link'), ['class' => 'form-control']) !!}
                                                        {!! $errors->first('twitter_link', '<div class="text-danger">:message</div>') !!}
                                                    </div>
                                                    <div class="form-group">
                                                        {!! Form::label('instagram_link', 'Instagram Link:') !!}
                                                        {!! Form::text('instagram_link', get_meta_by_key('instagram_link'), ['class' => 'form-control']) !!}
                                                        {!! $errors->first('instagram_link', '<div class="text-danger">:message</div>') !!}
                                                    </div>

                                                    <div class="form-group">
                                                        {!! Form::label('google-plus_link', 'Google Plus Link:') !!}
                                                        {!! Form::text('google-plus_link', get_meta_by_key('google-plus_link'), ['class' => 'form-control']) !!}
                                                        {!! $errors->first('google-plus_link', '<div class="text-danger">:message</div>') !!}
                                                    </div>


                                                    <div class="form-group">
                                                        {!! Form::label('youtube_link', 'Youtube Link:') !!}
                                                        {!! Form::text('youtube_link', get_meta_by_key('youtube_link'), ['class' => 'form-control']) !!}
                                                        {!! $errors->first('youtube_link', '<div class="text-danger">:message</div>') !!}
                                                    </div>


                                                    <div class="form-group">
                                                        {!! Form::label('linkedin_link', 'Linkedin Link:') !!}
                                                        {!! Form::text('linkedin_link', get_meta_by_key('linkedin_link'), ['class' => 'form-control']) !!}
                                                        {!! $errors->first('linkedin_link', '<div class="text-danger">:message</div>') !!}
                                                    </div>

                                                    <div class="form-group">
                                                        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                                                    </div>
                                                </form>
                                        </div>
                                        <div class="tab-pane fade" id="general-vertical-custom" role="tabpanel" aria-labelledby="general-pill-custom" aria-expanded="false">
                                            <h3>Custom CSS/JS</h3>
                                                <form role="form" class="dashboardForm"  method="post" action=" ">
                                                    {{csrf_field()}}
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label class="custom_header">Header<span style="color:red">*</span></label>
                                                                <textarea type="text" class="form-control" name="custom_header" id="custom_header" rows="10" aria-expanded="true">{{ get_meta_by_key('custom_header')}}</textarea>
                                                                @error($errors)
                                                                <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
                                                                @enderror
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="custom_footer">Footer<span style="color:red">*</span></label>
                                                                <textarea type="text" class="form-control" name="custom_footer" id="custom_footer" rows="10" aria-expanded="true">{{ get_meta_by_key('custom_footer')}}</textarea>
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
