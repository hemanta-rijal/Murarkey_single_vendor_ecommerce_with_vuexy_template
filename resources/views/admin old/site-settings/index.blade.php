@extends('admin.layouts.app')

@section('content-header')
    <h1>
        &nbsp;&nbsp; System Settings
    </h1>
@stop

@section('content')
<div class="accordion-content clearfix">
    <div class="col-lg-3 col-md-4">
        <div class="accordion-box">
            <div class="panel-group" id="SettingTabs">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" data-parent="#SettingTabs" href="#general_settings" aria-expanded="false">
                                    General Settings
                                </a>
                            </h4>
                        </div>

                        <div id="general_settings" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                            <div class="panel-body">
                                <ul class="accordion-tab nav nav-tabs">
                                    <li class="active ">
                                        <a href="#general" data-toggle="tab">General</a>
                                    </li><li class=" ">
                                        <a href="#maintenance" data-toggle="tab">Maintenance</a>
                                    </li><li class=" ">
                                        <a href="#currency" data-toggle="tab">Currency</a>
                                    </li><li class=" ">
                                        <a href="#mail" data-toggle="tab">Mail</a>
                                    </li><li class=" ">
                                        <a href="#newsletter" data-toggle="tab">Newsletter</a>
                                    </li><li class=" ">
                                        <a href="#custom_css_js" data-toggle="tab">Custom CSS/JS</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" data-parent="#SettingTabs" href="#seoSettings" aria-expanded="false">
                                    SEO Settings & Social Logins
                                </a>
                            </h4>
                        </div>

                        <div id="seoSettings" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                            <div class="panel-body">
                                <ul class="accordion-tab nav nav-tabs">
                                    <li class=" ">
                                        <a href="#seo" data-toggle="tab">SEO</a>
                                    </li>
                                    <li class=" ">
                                        <a href="#socialLogins" data-toggle="tab">Social Login</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" data-parent="#SettingTabs" href="#analyticsSetting" aria-expanded="false">
                                    Analytics
                                </a>
                            </h4>
                        </div>

                        <div id="analyticsSetting" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                            <div class="panel-body">
                                <ul class="accordion-tab nav nav-tabs">
                                    <li class=" ">
                                        <a href="#analytics" data-toggle="tab">Analytics</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" data-parent="#SettingTabs" href="#paymentMethod" aria-expanded="false">
                                    Payment Methods
                                </a>
                            </h4>
                        </div>

                        <div id="paymentMethod" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                            <div class="panel-body">
                                <ul class="accordion-tab nav nav-tabs">
                                    <li class=" ">
                                        <a href="#paypal" data-toggle="tab">Paypal</a>
                                    </li>
                                    <li class=" ">
                                        <a href="#stripe" data-toggle="tab">Stripe</a>
                                    </li>
                                    <li class=" ">
                                        <a href="#cashOnDelivery" data-toggle="tab">Cash On Delivery</a>
                                    </li>
                                    <li class=" ">
                                        <a href="#bankTransfer" data-toggle="tab">Bank Transfer</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" data-parent="#SettingTabs" href="#shippingMethod" aria-expanded="false">
                                    Shipping Methods
                                </a>
                            </h4>
                        </div>

                        <div id="shippingMethod" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                            <div class="panel-body">
                                <ul class="accordion-tab nav nav-tabs">
                                    <li class=" ">
                                        <a href="#freeShipping" data-toggle="tab">Free shipping</a>
                                    </li>
                                    <li class=" ">
                                        <a href="#localPickUp" data-toggle="tab">Local Pick Up</a>
                                    </li>
                                    <li class=" ">
                                        <a href="#flatRate" data-toggle="tab">Flat Rate</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                  
            </div>
        </div>
    </div>

    <div class="col-lg-9 col-md-8">
        <div class="accordion-box-content">
            <div class="tab-content clearfix">

                {{-- ---------------------General Settings-------------------------- --}}
                    {{-- <div class="tab-content"> --}}
                        <div class="tab-pane active" id="general">
                            {{--general --}}
                            <h3>General</h3>
                            {!! Form::open(['files' => true]) !!}
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

                        <div class="tab-pane " id="maintenance">
                            <h3>Maintenance</h3>
                            <div class=" box-primary">
                                <form role="form" class="dashboardForm"  method="post" action=" ">
                                    {{csrf_field()}}
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="maintenance_mode">Maintenance Mode<span style="color:red">*</span></label>
                                                <div class="form-check">
                                                    <input class="form-check-input" name="maintenance_mode" type="hidden" id="maintenance_mode" value="off">
                                                    <input class="form-check-input" name="maintenance_mode" type="checkbox" id="maintenance_mode" value="on" {{get_meta_by_key('maintenance_mode')==="on" ? 'checked' : ''}}>
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
                        </div>

                        <div class="tab-pane " id="currency">
                            <h3>Currencies</h3>
                            <div class=" box-primary">
                                <form role="form" class="dashboardForm"  method="post" action=" ">
                                    {{csrf_field()}}
                                    <div class="box-body">
                                        <div class="row">
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
                        </div>

                        <div class="tab-pane " id="mail">
                            <h3>Mail</h3>
                            <div class=" box-primary">
                                <form role="form" class="dashboardForm"  method="post" action=" ">
                                    {{csrf_field()}}
                                    <div class="box-body">
                                        <div class="row">
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
                                    </div>
                                    <div class="submit">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                        <div class="tab-pane " id="newsletter">
                            <h3>Newsletter</h3>
                            <div class=" box-primary">
                                <form role="form" class="dashboardForm"  method="post" action=" ">
                                    {{csrf_field()}}
                                    <div class="box-body">
                                        <div class="row">
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
                        </div>
                        <div class="tab-pane " id="custom_css_js">
                            <h3>Custom CSS/JS</h3>
                            <div class=" box-primary">
                                <form role="form" class="dashboardForm"  method="post" action=" ">
                                    {{csrf_field()}}
                                    <div class="box-body">
                                        <div class="row">
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

   {{-- -------------------------SEO & Social settings---------------------- --}}
                        <div class="tab-pane" id="seo">
                            <h3>SEO Settings</h3>
                            {!! Form::open() !!}
                            <div class="form-group">
                                {!! Form::label('site_keywords', 'Keyword:') !!}
                                {!! Form::text('site_keywords', get_meta_by_key('site_keywords'), ['class' => 'form-control']) !!}
                                {!! $errors->first('site_keywords', '<div class="text-danger">:message</div>') !!}
                            </div>

                            <div class="form-group">
                                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                            </div>
                            {!! Form::close() !!}
                        </div>
                    
                        <div class="tab-pane" id="socialLogins">
                            <h3>Social Logins</h3>
                            {!! Form::open() !!}
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
                            {!! Form::close() !!}
                        </div>
                         {{-- -------------------------analytics settings---------------------- --}}
                        <div class="tab-pane" id="analytics">
                            <h3>Analytics<h3>
                            {!! Form::open() !!}
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
                            {!! Form::close() !!}
                        </div>
                        {{-- -------------------------Payment Method settings---------------------- --}}
                        <div class="tab-pane" id="paypal">
                            <h3>PayPal</h3>
                            <div class=" box-primary">
                                <form role="form" class="dashboardForm"  method="post" action=" ">
                                    {{csrf_field()}}
                                    <div class="box-body">
                                        <div class="row">
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
                        </div>
                        <div class="tab-pane " id="stripe">
                            <h3>stripe</h3>
                            <div class=" box-primary">
                                <form role="form" class="dashboardForm"  method="post" action=" ">
                                    {{csrf_field()}}
                                    <div class="box-body">
                                        <div class="row">
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
                        </div>
                        <div class="tab-pane " id="cashOnDelivery">
                            <h3>Cash On Delivery</h3>
                            <div class=" box-primary">
                                <form role="form" class="dashboardForm"  method="post" action=" ">
                                    {{csrf_field()}}
                                    <div class="box-body">
                                        <div class="row">
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
                        </div>
                        <div class="tab-pane " id="bankTransfer">
                            <h3>Bank Transfer</h3>
                            <div class=" box-primary">
                                <form role="form" class="dashboardForm"  method="post" action=" ">
                                    {{csrf_field()}}
                                    <div class="box-body">
                                        <div class="row">
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

                        {{-- -------------------------Shipping MEthods---------------------- --}}
                        <div class="tab-pane" id="freeShipping">
                            <h3>Free Shipping</h3>
                            <div class=" box-primary">
                                <form role="form" class="dashboardForm"  method="post" action=" ">
                                    {{csrf_field()}}
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="free_shipping_status">Status</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" name="free_shipping_status" type="hidden" value="off" id="gridCheck1" >
                                                    <input class="form-check-input" name="free_shipping_status" type="checkbox" id="gridCheck1" value="on" {{ get_meta_by_key('free_shipping_status')=='on' ?  'checked' : ' '}} >
                                                    <label class="form-check-label" for="gridCheck1">
                                                    Enable Free Shipping
                                                    </label>
                                                </div>
                                                @error($errors)
                                                <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
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
                        </div>
                        <div class="tab-pane" id="localPickUp">
                            <h3>Local Pickup</h3>
                            <div class=" box-primary">
                                <form role="form" class="dashboardForm"  method="post" action=" ">
                                    {{csrf_field()}}
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="local_pick_up_status">Status</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" name="local_pick_up_status" type="hidden" id="gridCheck1" value="off" >
                                                    <input class="form-check-input" name="local_pick_up_status" type="checkbox" id="gridCheck1" value="on" {{ get_meta_by_key('local_pick_up_status')=='on' ? 'checked' : ''}}>
                                                    <label class="form-check-label" for="gridCheck1">
                                                    Enable Local Pickup
                                                    </label>
                                                </div>
                                                @error($errors)
                                                <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
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
                        <div class="tab-pane" id="flatRate">
                            <h3>Flat Rate</h3>
                            <div class=" box-primary">
                                <form role="form" class="dashboardForm"  method="post" action=" ">
                                    {{csrf_field()}}
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="flat_rate_status">Status</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" name="flat_rate_status" type="hidden" id="gridCheck1" value="off">
                                                    <input class="form-check-input" name="flat_rate_status" type="checkbox" id="gridCheck1" value="on" {{ get_meta_by_key('flat_rate_status')=='on' ?  'checked' : '' }}>
                                                    <label class="form-check-label" for="gridCheck1">
                                                    Enable Flat Rate
                                                    </label>
                                                </div>
                                                @error($errors)
                                                <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
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
                      
                        </div>
                    {{-- </div> --}}
                {{-- ----------------------------------------------- --}}

            </div>
        </div>
    </div>
</div>
@stop
