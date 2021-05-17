@extends('admin.layouts.app')

@section('content-header')
    <h1>
        Settings
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
                                <a class="collapsed" data-toggle="collapse" data-parent="#SettingTabs" href="#AdSettings" aria-expanded="false">
                                    Home Page Settings
                                </a>
                            </h4>
                        </div>

                        <div id="AdSettings" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                            <div class="panel-body">
                                <ul class="accordion-tab nav nav-tabs">
                                    <li class="in-active">
                                        <a href="#homepageAdSettings" data-toggle="tab">Home Page Ads Settings</a>
                                    </li>
                                     <li class=" ">
                                        <a href="#homePage" data-toggle="tab">Home Page Showcase Settings</a>
                                    </li>
                                    {{--  <li class=" ">
                                        <a href="#otherPageAdSettings" data-toggle="tab">OtherPageAds Settings for test</a>
                                    </li>  --}}
                                </ul>
                            </div>
                        </div>
                    </div>

                    {{--  <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" data-parent="#SettingTabs" href="#homePageSettings" aria-expanded="false">
                                    Home Page Settings
                                </a>
                            </h4>
                        </div>

                        <div id="homePageSettings" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                            <div class="panel-body">
                                <ul class="accordion-tab nav nav-tabs">
                                    <li class=" ">
                                        <a href="#homePage" data-toggle="tab">Home Page Settings</a>
                                    </li>
                                    <li class=" ">
                                        <a href="#OtherPage" data-toggle="tab">Other Page Settings</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>  --}}
                   
            </div>
        </div>
    </div>

    <div class="col-lg-9 col-md-8">
        <div class="accordion-box-content">
            <div class="tab-content clearfix">

                {{-- ---------------------Home Page Ads Settings-------------------------- --}}
                        <div class="tab-pane" id="homepageAdSettings">
                           
                            <h3>Home Page Ads Settings</h3>
                            {!! Form::open(['files' => true]) !!}

                            <div class="form-group">
                                <label class="firstAdStatus">First Ad Status<span style="color:red">*</span></label>
                                <div class="form-check">
                                    <input class="form-check-input" name="first_ad_status" type="hidden" id="firstAdStatus" value="off">
                                    <input class="form-check-input" name="first_ad_status" type="checkbox" id="firstAdStatus" value="on" {{get_theme_setting_by_key('first_ad_status')==="on" ? 'checked' : ''}}>
                                    <label class="form-check-label" for="gridCheck1">
                                        Publish First Ad Home Page
                                    </label>
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
                                <input type="file" placeholder="choose image for first ad" name="first_ad_image">
                                <img src="{!! map_storage_path_to_link(get_theme_setting_by_key('first_ad_image')) !!}" style="zoom: 0.5;">
                                @error($errors)
                                <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
                                @enderror
                            </div>
                            
                            <hr>
                            <div class="form-group">
                                <label class="secondAdStatus">Second Ad Status<span style="color:red">*</span></label>
                                <div class="form-check">
                                    <input class="form-check-input" name="second_ad_status" type="hidden" id="secondAdStatus" value="off">
                                    <input class="form-check-input" name="second_ad_status" type="checkbox" id="secondAdStatus" value="on" {{get_theme_setting_by_key('second_ad_status')==="on" ? 'checked' : ''}}>
                                    <label class="form-check-label" for="gridCheck1">
                                        Publish Second Ad On Home Page
                                    </label>
                                </div>
                                @error($errors)
                                <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
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
                                <input type="file" placeholder="choose image for first ad" name="second_ad_image">
                                <img src="{!! map_storage_path_to_link(get_theme_setting_by_key('second_ad_image')) !!}" style="zoom: 0.5;">
                                @error($errors)
                                <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
                                @enderror
                            </div>

                            <hr>
                            <div class="form-group">
                                <label class="thirdAdStatus">Third Ad Status<span style="color:red">*</span></label>
                                <div class="form-check">
                                    <input class="form-check-input" name="third_ad_status" type="hidden" id="thirdAdStatus" value="off">
                                    <input class="form-check-input" name="third_ad_status" type="checkbox" id="thirdAdStatus" value="on" {{get_theme_setting_by_key('third_ad_status')==="on" ? 'checked' : ''}}>
                                    <label class="form-check-label" for="gridCheck1">
                                        Publish Third Ad On Home Page
                                    </label>
                                </div>
                                @error($errors)
                                <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
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
                                <input type="file" placeholder="choose image for first ad" name="third_ad_image">
                                <img src="{!! map_storage_path_to_link(get_theme_setting_by_key('third_ad_image')) !!}" style="zoom: 0.5;">
                                @error($errors)
                                <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
                                @enderror
                            </div>

                            <hr>
                            <div class="form-group">
                                <label class="fourthAdStatus">Fourth Ad Status<span style="color:red">*</span></label>
                                <div class="form-check">
                                    <input class="form-check-input" name="foruth_ad_status" type="hidden" id="fourthAdStatus" value="off">
                                    <input class="form-check-input" name="foruth_ad_status" type="checkbox" id="fourthAdStatus" value="on" {{get_theme_setting_by_key('fourth_ad_status')==="on" ? 'checked' : ''}}>
                                    <label class="form-check-label" for="gridCheck1">
                                        Publish Fourth Ad On Home Page
                                    </label>
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
                                <input type="file" placeholder="choose image for first ad" name="fourth_ad_image">
                                <img src="{!! map_storage_path_to_link(get_theme_setting_by_key('fourth_ad_image')) !!}" style="zoom: 0.5;">
                                @error($errors)
                                <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
                                @enderror
                            </div>
                            <hr>
                            <div class="form-group">
                                <label class="fifthAdStatus">Fifth Ad Status<span style="color:red">*</span></label>
                                <div class="form-check">
                                    <input class="form-check-input" name="fifth_ad_status" type="hidden" id="fifthAdStatus" value="off">
                                    <input class="form-check-input" name="fifth_ad_status" type="checkbox" id="fifthAdStatus" value="on" {{get_theme_setting_by_key('fifth_ad_status')==="on" ? 'checked' : ''}}>
                                    <label class="form-check-label" for="gridCheck1">
                                        Publish Fifth Ad On Home Page
                                    </label>
                                </div>
                                @error($errors)
                                <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
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
                                <input type="file" placeholder="choose image for first ad" name="fifth_ad_image">
                                <img src="{!! map_storage_path_to_link(get_theme_setting_by_key('fifth_ad_image')) !!}" style="zoom: 0.5;">
                                @error($errors)
                                <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
                                @enderror
                            </div>

                            <div class="form-group">
                                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                            </div>
                            {!! Form::close() !!}
                        </div>


                        <div class="tab-pane " id="otherPageAdSettings">
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

                        <div class="tab-pane" id="homePage">
                            <h3>Home Page Product Showcase Settings</h3>
                            {!! Form::open(['files' => true]) !!}

                            <div class="form-group">
                                <label class="flash_sale_status">"Flash Sale" Status<span style="color:red">*</span></label>
                                <div class="form-check">
                                    <input class="form-check-input" name="flash_sale_status" type="hidden" id="flash_sale_status" value="off">
                                    <input class="form-check-input" name="flash_sale_status" type="checkbox" id="flash_sale_status" value="on" {{get_theme_setting_by_key('flash_sale_status')==="on" ? 'checked' : ''}}>
                                    <label class="form-check-label" for="gridCheck1">
                                       Flash Sale Status 
                                    </label>
                                </div>
                                @error($errors)
                                <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="max_number_of_flash_sale_item">Maximum Number of Product Item On "Flash Sale Item"<span style="color:red">*</span></label>
                                <input type="text" class="form-control" name="max_number_of_flash_sale_item" id="max_number_of_flash_sale_item" placeholder="Maximum Number of Flash Sale Product Item" value="{{ get_theme_setting_by_key('max_number_of_flash_sale_item')}}">
                                @error($errors)
                                <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>
                                @enderror
                            </div>

                            <hr>
                            <div class="form-group">
                                <label class="new_arrivals_status">"New Arrivals" Showcase Status<span style="color:red">*</span></label>
                                <div class="form-check">
                                    <input class="form-check-input" name="new_arrivals_status" type="hidden" id="new_arrivals_status" value="off">
                                    <input class="form-check-input" name="new_arrivals_status" type="checkbox" id="new_arrivals_status" value="on" {{get_theme_setting_by_key('new_arrivals_status')==="on" ? 'checked' : ''}}>
                                    <label class="form-check-label" for="gridCheck1">
                                        New Arrivals Showcase Status
                                    </label>
                                </div>
                                @error($errors)
                                <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
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
                                <div class="form-check">
                                    <input class="form-check-input" name="featured_category_status" type="hidden" id="featuredProduct" value="off">
                                    <input class="form-check-input" name="featured_category_status" type="checkbox" id="featuredProduct" value="on" {{get_theme_setting_by_key('featured_category_status')==="on" ? 'checked' : ''}}>
                                    <label class="form-check-label" for="gridCheck1">
                                        Featured Category Status
                                    </label>
                                </div>
                                @error($errors)
                                <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
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
                                <div class="form-check">
                                    <input class="form-check-input" name="you_may_like_products_status" type="hidden" id="you_may_like_products_status" value="off">
                                    <input class="form-check-input" name="you_may_like_products_status" type="checkbox" id="you_may_like_products_status" value="on" {{get_theme_setting_by_key('you_may_like_products_status')==="on" ? 'checked' : ''}}>
                                    <label class="form-check-label" for="gridCheck1">
                                       You May Like Status
                                    </label>
                                </div>
                                @error($errors)
                                <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
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
                                <div class="form-check">
                                    <input class="form-check-input" name="products_below_1500_status" type="hidden" id="productBelow1500" value="off">
                                    <input class="form-check-input" name="products_below_1500_status" type="checkbox" id="productBelow1500" value="on" {{get_theme_setting_by_key('products_below_1500_status')==="on" ? 'checked' : ''}}>
                                    <label class="form-check-label" for="gridCheck1">
                                        Product Below 1500 Status
                                    </label>
                                </div>
                                @error($errors)
                                <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
                                @enderror
                            </div>
                            <hr>
                

                            <div class="form-group">
                                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                            </div>
                            {!! Form::close() !!}
                        </div>

                </div>
                    {{-- </div> --}}
                {{-- ----------------------------------------------- --}}

            </div>
        </div>
    </div>
</div>
@stop
