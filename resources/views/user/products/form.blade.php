@section('sub-styles')
    <style>
        .ui-loading-medium {
            display: inline-block;
            padding-left: 42px;
            line-height: 32px;
            background: url({!! asset('assets/img/loading-middle.gif') !!}) 0 50% no-repeat;
        }

        .browse-category-loading {
            width: 180px;
            height: 260px;
            line-height: 260px;
            text-align: center;
            margin: 0;
            padding: 0;
            border: 0;
            vertical-align: baseline;
        }

        .ui-uploader-img-wrap {
            width: 125px !important;
            border: 3px solid white !important;
        }

        .ui-uploader-img-wrap img {
            height: 100%;
            width: 100%;
            object-fit: cover;
        }

        li.ui-uploader-img-item {
            display: inline-block !important;
            overflow-x: hidden;
            width: 86px !important;
        }

        section#seller_registration label.control-label {
            text-align: right;
            padding-left: 60px;
            font-weight: 400;
            color: #454545
        }

        @media only screen and (max-width: 992px) {
            section#seller_registration label.control-label {
                padding-left: 18px
            }
        }

        section#seller_registration .form-control {
            padding: 20px 12px;
            border-radius: 2px;
            max-width: 530px
        }

        .plz_fill {
            background: transparent;
            color: #cc1414;
        }

        .custom-error-message {
            background-color: #9d0b0e;
            color: #fff;
        }
    </style>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/eonasdan-bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css"
          rel="stylesheet">
@endsection

@if(isset($model))
    {!! Form::model($model, ['route' => [$userType.'.products.update', $model->id],'method'=> 'PUT', 'files' => true, 'id' => 'product-form','onkeypress'=>"return event.keyCode != 13;"]) !!}
@else
    {!! Form::open(['route' => $userType.'.products.store', 'files' => true, 'id' => 'product-form','onkeypress'=>"return event.keyCode != 13;"]) !!}
@endif

@role('main-seller')
<div class="col-md-3">
    <div class="company_contacts m-b-35">
        <div class="media text-center">
            <a class="" href="#">
                <img id="seller-image" class="media-object"
                     src="@if(isset($model) && $model->seller_id)
                     {{ $model->seller->profile_pic_url }}
                     @elseif(!isset($model))
                     {{ auth()->user()->profile_pic_url }}
                     @endif"
                     alt="Seller Image"
                     style="margin: 0 auto;" height="100">
            </a>
            <div class="media-body oh_media_con">
                <h4 class="media-heading" id="seller-name">
                    @if(isset($model) && $model->seller_id)
                        {{ $model->seller->name }}
                    @elseif(!isset($model) && auth()->check())
                        {{ auth()->user()->name }}
                    @endif
                </h4>
            </div>
        </div>
        <div class="btn_box text-center">
            <div class="dropdown">
                <button class="btn pcolor_bg white dropdown-toggle" type="button" id="dropdownMenu1"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"
                        style="padding: 8px 35px;">
                    {{ (isset($model) && $model->seller_id) ? 'Change Seller' : 'Add/Change Seller'  }}
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1"
                    style="width: 100%;max-height: 160px;overflow-y: scroll;">

                    @foreach(auth()->user()->company->sellers as $seller)
                        <li>
                            <a onclick="setSeller({{ $seller->user_id }},'{{ $seller->user->name }}', '{{ $seller->user->profile_pic_url }}')">{{ $seller->user->name }}</a>
                        </li>
                    @endforeach

                </ul>
            </div>
        </div>

    </div>
</div>

{!! Form::hidden('seller_id', isset($model)? $model->seller_id : auth()->user()->id, ['id' => 'seller-id']) !!}
@endrole

@role('associate-seller')
{!! Form::hidden('seller_id', auth()->user()->id, ['id' => 'seller-id']) !!}
@endrole

<div class="row m-0">
    <div class="col-md-12">
        <p class="f-s-16 m-b-20">Select Category</p>
        <div class="selection_box">
            <div id="category-selection-div" style="{!! isset($model) ? 'display:none' :'' !!}">
                <div class="col-md-3 div-level-0">
                    <ul class="selection_list">

                        @foreach(get_root_categories() as $category)
                            <li><a href="javascript:void(0)" class="category-item"
                                   data-id="{!! $category->id !!}" data-level="0"
                                   onclick="browseCategory(this)">{!! $category->name !!}</a></li>
                        @endforeach
                    </ul>

                </div>

                <div class="col-md-3 div-level-1" style="display: none;">
                    <ul class="selection_list">

                    </ul>

                </div>


                <div class="col-md-3 div-level-2" style="display: none;">
                    <ul class="selection_list">


                    </ul>

                </div>
                <div class="col-md-3 div-level-3" style="display: none;">
                    <ul class="selection_list">

                    </ul>
                </div>

                <div class="col-md-3 browse-category-loading ui-loading" style="display: none;">
                    <span class="ui-loading-medium">&nbsp;</span>
                </div>
            </div>

            <div class="col-md-12">
                @if(isset($model))
                    <button type="button" class="btn btn-primary m-b-12" id="select-category-button" style="width: 100%"
                            onclick="selectCategoryButton()">Select New Category
                    </button>
                @endif
                <ol class="breadcrumb separator-arrow no-margin"
                    style="background: #f6f6f6; padding-left: 17px;">
                    Categories Selected:
                    @if(isset($model))
                        @php
                            $ancestors = $model->category->getAncestors();
                        @endphp
                        @foreach($ancestors as $category)
                            <li id="category-level-{{ $loop->index }}">{{ $category->name }}</li>
                        @endforeach
                        <li id="category-level-{{ $ancestors->count() }}">{{ $model->category->name }}</li>
                    @else
                        <li id="category-level-0"></li>
                        <li id="category-level-1"></li>
                        <li id="category-level-2"></li>
                    @endif
                    <li class="i fa fa-check-circle" style="color: green;"></li>
                </ol>
            </div>

            <div class="clearfix"></div>
        </div>
    </div>
</div>
{!! Form::hidden('category_id', null, ['class' => 'required', 'title' => '!Please select a category']) !!}
<!-- row -->
<div class="row m-0">
    <div class="col-md-12">
        <section id="seller_registration">
            <div class="seller_box">
                <p class="m-b-33 slight_black f-s-17">Basic Information</p>
                <div class="form-horizontal input_responsive">
                    <div class="form-group">
                        <label class="col-md-3 control-label"><span class="red">*</span>Product Name</label>
                        <div class="col-md-9">
                            {!! Form::text('name', null, ['class' => 'form-control required', 'title' => '!Product name is required field', 'maxlength' => "120"] ) !!}
                        </div>
                    </div>
                    <div class="keyword-list">
                        <div class="form-group keyword-item">
                            <label class="col-md-3 control-label"><span class="red">*</span>
                                Product Keyword</label>
                            <div class="col-md-9">
                                @if(isset($model))
                                    {!! Form::text("old_keyword[{ $model->keywords->first() ? $model->keywords->first()->id : ' ' }][value]",$model->keywords->first() ? $model->keywords->first()->name : ' ', ['class' => 'form-control wid_plus required','placeholder'=>"Enter one keyword only eg: road bike", 'title' => '! Keyword is required field', 'onchange' => "setDirtyField('old_keyword[{ $model->keywords->first() ? $model->keywords->first()->id : ' '}]')"] ) !!}
                                @else
                                    {!! Form::text('keyword[]', null, ['class' => 'form-control wid_plus required','placeholder'=>"Enter one keyword only eg: road bike", 'title' => '! Keyword is required field'] ) !!}
                                @endif
                                <button type="button" class="btn btn-success btn-sm btn-add-keyword">
                                    <span class="glyphicon glyphicon-plus"></span>
                                </button>
                            </div>
                        </div>

                        @if(isset($model))
                            @foreach($model->keywords->splice(1)->all() as $keyword)
                                <div class="form-group keyword-item">
                                    <label class="col-md-3 control-label"><span class="red"></span>
                                        Keyword {{ $loop->index + 2 }}</label>
                                    <div class="col-md-9">
                                        {!! Form::text("old_keyword[{$keyword->id}][value]", $keyword->name, ['class' => 'form-control wid_plus', 'onchange' => "setDirtyField('old_keyword[{$keyword->id}]')"] ) !!}
                                        <button type="button" class="btn btn-danger btn-sm btn-remove-keyword"
                                                onclick="removeFormItem('keyword', {{ $keyword->id }})">
                                            <span class="glyphicon glyphicon-minus"></span>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        @endif


                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"><span class="red">*</span>Product
                            Photo:</label>
                        <div class="col-md-9">
                            <div class="multi_upload">
                                <article>
                                    <input id="files" class="{{ isset($model) ?: 'required' }} btn"
                                           name="raw_images" type="file" multiple
                                           accept="image/png,image/jpg,image/jpeg"
                                           title="At least one product image is required!"/>

                                    <p class="p-t-15">The maximum size for a single image is 4MB. The
                                        following formats are
                                        supported: jpeg,jpg,png. Use as many pictures from as many angles as
                                        necessary to properly display your product.</p>
                                    <p class="" style="color: #f17001;">We suggest your images be less than
                                        1000px1000px with a clear subject to improve buyer
                                        satisfaction.</p>

                                    <div class="ui-uploader-content col-md-12 p-l-0"
                                         style="position: relative;overflow-x: auto">
                                        <ul id="image-list"
                                            style="width:717px; height:auto; min-height:80px; background: url(/assets/img/uploader-bg.png) repeat-x;">
                                            @if(isset($model))
                                                @foreach($model->images as $image)
                                                    <li class="ui-uploader-img-item ui-uploader-complete"
                                                        style="width:80px;" id="image-{{ $loop->index }}-li"
                                                        data-class="image-{{ $loop->index }}">
                                                        <div class="ui-uploader-img-wrap"
                                                             style="position: relative;margin: 0;width: 80px;height: 80px;line-height: 78px;border: 1px solid #ddd;background: #f9f9f9;">
                                                            <img data-role="uploader-preview"
                                                                 data-switch-status="complete"
                                                                 width="78"
                                                                 src="{{ resize_image_url($image->image, '50X50') }}"
                                                                 height="53">
                                                        </div>

                                                        <div class="ui-uploader-action">
                                                            <span data-switch-status="fileSelect start"
                                                                  style="display: none;">pending</span>
                                                            <a href="javascript:void(0);"
                                                               onclick="removeImage(this, {{ $image->id }})">remove</a>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            @endif
                                        </ul>
                                        <div style="position:absolute;top:0;left:0; width:40px; height:40px; background: url(/assets/img/photo-cover.png) 0 0 no-repeat;"></div>

                                        <p class="product-image-uploading">Keep calm. Uploading in progress...</p>
                                    </div>

                                </article>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <!--  seller box-->
            <div class="seller_box">
                <p class="m-b-33 slight_black" style="font-size:17px;">Product Details
                    <span class="f-s-14" style="color:dimgray;">Complete product details help your listing gain more exposure and visibility to potential buyers.</span>
                </p>
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-md-3 control-label"><span class="red"></span>Model
                            Number</label>
                        <div class="col-md-9">
                            {!! Form::text('model_number', null, ['class' => 'form-control', 'title' => '!Model Number is required field']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"><span class="red"></span>Brand Name</label>
                        <div class="col-md-9">
                            {!! Form::text('brand_name', null, ['class' => 'form-control', 'title' => '! Brand Name is required']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label"><span class="red">*</span>Price</label>
                        <div class="col-md-9">
                            {!! Form::number('price', null, ['class' => 'form-control required', 'title' => '! Price is required']) !!}
                        </div>
                    </div>
                    {{-- <div class="form-group">
                        <label class="col-md-3 form-check-label">Apply FlatRate Discount</label>
                        <div class="col-md-6 form-check" >
                             <input id="flatRate" type="checkbox" name="flat_rate_status" {{ !isset($product) ? '' : ($product->flat_rate_status? 'checked' : '')  }} class="form-control form-check-input" />
                        </div> 
                    </div> --}}

                    <div class="form-group">
                        <label class="control-label col-md-3">Flat Rate </label>
                        <div class="form-check col-md-6">
                            <input class=" form-check-input" name="flat_rate_status" type="hidden"
                                   id="flat_rate_status_off" value="off" onclick="flatRate(this.id)">
                            <input class="form-check-input" name="flat_rate_status" type="checkbox"
                                   id="flat_rate_status_on" value="on"
                                   {{ !isset($product) ? '' : ($product->flat_rate_status? 'checked' : '')  }} onclick="flatRate(this.id)">
                            <label class=" control-label" for="gridCheck1">
                                Apply FlatRate Discount
                            </label>
                        </div>
                        @error($errors)
                        <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>
                        @enderror
                    </div>

                    <div class="form-group un-hidden" id="discount">
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-9">
                            <label class="control-label"
                                   style="padding-left: 0%"> {{!isset($product) ? 'Do Not Have Discount ? Leave field As It is.' : ''}}</label>
                        </div>
                    </div>

                    <div class="form-group un-hidden" id="discount">
                        <label class="col-md-3 control-label">Discount Price</label>
                        <div class="col-md-3">
                            <select class="form-control" id="discount_type" name="discount_type">
                                <option value="discount_price" {{ !isset($product) ? '' : ($product->discount_type=='discount_price'? 'selected' : '')}}>
                                    A Discount Price
                                </option>
                                {{--  <option value="flat_rate" {{ !isset($product) ? '' :($product->discount_type=='flat_rate'? 'selected' : '')}}>Flat Rate </option>  --}}
                                <option value="discount_percentage" {{ !isset($product) ? '': ($product->discount_type=='discount_percentage'? 'selected' : '')}}>
                                    A Discount Percentage
                                </option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input id="discount_price" type="number" name="a_discount_price"
                                   value="{{$product->a_discount_price ?? ''}}" class="form-control"
                                   placeholder="No Discount ? Leave as it is..">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label"><span class="red"></span>Made In</label>
                        <div class="col-md-9">
                            {!! Form::select('made_in', get_countries(), null,['class' => 'form-control my_select p-l-12', 'style' => 'padding: 0; height: 41px;', 'title' => '! Made In is required field']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label"><span class="red"></span>Assembled In</label>
                        <div class="col-md-9">
                            {!! Form::select('assembled_in', get_countries(), null,['class' => 'form-control my_select p-l-12', 'style' => 'padding: 0; height: 41px;', 'title' => '! Assembled In is required field']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label"><span class="red"></span>Place of
                            Origin</label>
                        <div class="col-md-9">
                            {!! Form::select('place_of_origin', get_countries(), null,['class' => 'form-control my_select p-l-12', 'style' => 'padding: 0; height: 41px;', 'title' => '! Origin is required field']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label"><span class="red"></span>More Details</label>
                        <div class="col-md-9">
                            <div class="attribute-list">
                                @if(isset($model))
                                    @foreach($model->attributes as $attribute)
                                        <div class="attribute-item">
                                            {!! Form::text("old_attribute[{$attribute->id}][key]", $attribute->key, ['class' => 'attribute-title form-control', 'placeholder' => 'Attribute - e.g Color', 'title' => '! Attribute is required field','onchange' => "setDirtyField('old_attribute[{$attribute->id}]')"]) !!}
                                            {!! Form::text("old_attribute[{$attribute->id}][value]", $attribute->value, ['class' => 'attribute-title form-control', 'placeholder' => 'Attribute - e.g Color', 'title' => '! Attribute is required field','onchange' => "setDirtyField('old_attribute[{$attribute->id}]')"]) !!}
                                            <div class="btn_set">
                                                <button type="button" class="btn-remove-attribute"
                                                        onclick="removeFormItem('attribute', {{ $attribute->id }})"><i
                                                            class="fa fa-close" style="color:#000;"></i></button>

                                                <button type="button"
                                                        onclick="copyAttributeItem('old_attribute[{{$attribute->id}}][key]')">
                                                    <i class="fa fa-clipboard"></i></button>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="attribute-item">
                                        {!! Form::text('attribute[1][key]', null, ['class' => 'attribute-title form-control', 'placeholder' => 'Attribute - e.g Color', 'title' => '! Attribute is required field']) !!}
                                        {!! Form::text('attribute[1][value]', null, ['class' => 'attribute-title form-control', 'placeholder' => 'Attribute - e.g Red', 'title' => '! Attribute is required field']) !!}
                                        <div class="btn_set">
                                            <button type="button" onclick="copyAttributeItem('attribute[1][key]')"><i
                                                        class="fa fa-clipboard"></i></button>
                                        </div>
                                    </div>
                                @endif


                            </div>
                            <div class="clearfix"></div>
                            <div class="add_more_box">
                                <p>Please fill in both attribute name and value(e.g.,Color: Red)</p>
                                <button type="button" class="btn cs_btn m-t-20 btn-add-attribute">Add More
                                </button>
                            </div>

                        </div>
                    </div>


                    {{-- <div class="form-group">
                        <label class="col-md-3 control-label"><span class="red">*</span>Auction</label>
                        <div class="col-md-9">
                            {!! Form::checkbox('auction', 1, isset($model) && $model->auction) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label"><span class="red">*</span>Auction End Date</label>
                        <div class="col-md-3">
                            {!! Form::text('auction_end_date', null, ['class' => 'form-control', 'id' => 'datepicker1'] ) !!}
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-3 control-label"><span class="red"></span>Auction Minimum Price</label>
                        <div class="col-md-3">
                            {!! Form::number('minimum_price', null, ['class' => 'form-control'] ) !!}
                        </div>
                    </div> --}}
                </div>
            </div>

        <!--
            <div class="seller_box">
                <p class="m-b-33 slight_black" style="font-size:17px;">Trade Information
                    <span class="f-s-14" style="color:dimgray;">Complete trade information helps buyers make better sourcing decisions</span>
                </p>
                <div class="form-group">
                    <label class="col-md-3 control-label"><span class="red">*</span>Unit Type</label>
                    <div class="col-md-6">
                        {!! Form::select('unit_type', get_unit_type(), 'Piece', ['class' => 'form-control p-0 required', 'id' => 'inputID', 'style' => "max-width: 160px;", 'title' => '! Unit type is required field']) !!}
                <br>
                <div class="moq_table_wrapper">
                    <table class="table table-responsive">
                        <thead>
                        <tr>
                            <th>MOQ (<span class="unit-name">Selec...</span>)</th>
                            <th>Price (<span class="unit-name">Selec...</span>)</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody class="moq_list">
                        <tr style="display: none" id="moq-moq-error">
                            <td><p></p></td>
                        </tr>
@if(isset($model))
            @foreach($model->trade_infos as $moq)
                <tr class="moq_item">
                    <td><p class="some_txt">≥</p>
{!! Form::number("old_moq[{$moq->id}][moq]", $moq->moq, ['class' => 'form-control moq moq-moq required','onchange' => "setDirtyField('old_moq[{$moq->id}]')"]) !!}
                        </td>
                        <td><p class="some_txt">NRs</p>
{!! Form::number("old_moq[{$moq->id}][price]", $moq->price, ['class' => 'form-control moq moq-price required', 'onchange' => "setDirtyField('old_moq[{$moq->id}]')"]) !!}
                        </td>
                        <td>
                            <button type="button" class="btn-remove-moq"
                                    onclick="removeFormItem('trade_info', {{ $moq->id }})"><i
                                                            class="fa fa-close"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
        @else
            <tr class="moq_item">
                <td><p class="some_txt">≥</p>
{!! Form::number('moq[1][moq]', 1, ['class' => 'form-control moq moq-moq required']) !!}
                    </td>
                    <td><p class="some_txt">NRs</p>
{!! Form::number('moq[1][price]', null, ['class' => 'form-control moq-price required']) !!}
                    </td>
                    <td>
{{--<button type="button" class="btn-remove-moq"><i class="fa fa-close"></i>--}}
            {{--</button>--}}
                    </td>
                </tr>
@endif


                </tbody>
                <tfoot>
                <tr>
                    <td>
                        <button type="button" class="btn-add-moq"><i
                                    class="fa fa-plus-square m-r-5"></i>Add More
                        </button>
                        Max: 4
                    </td>
                    <td></td>
                    <td></td>
                </tr>
                </tfoot>
            </table>

        </div>
    </div>
    <div class="col-md-3">
        <div class="preview_box">
            <p class="topo"><span class="black">Preview:</span>(Unit: <span
                        class="unit-name">(Selec...)</span>)</p>
            <p class="black" id="moq-blank-message">You can set different prices based on different
                quantities.</p>
            <table id="moq-table" class="table" style="display: none;">
                <tbody id="moq-table-body">

                </tbody>
            </table>
            <i class="fa fa-angle-left"></i>
        </div>
    </div>
    <div class="clearfix"></div>
</div>

<div class="clearfix"></div>
</div>

-->

            <div class="col-md-8">
                <p class="m-b-33 slight_black" style="font-size:17px;">Product Detail Information
                </p>
                {!! Form::textarea('details', null,['class' => 'product-details' ]) !!}

                <div id="details-error-div">

                </div>
            </div>

            <div class="col-md-8">

                <p class="m-b-33 slight_black p-t-33" style="font-size:17px;">Shipping and Delivery Details
                </p>
                {!! Form::textarea('shipping_details', null,['class' => '','title'=> "! Shipping details is required field" ]) !!}
            </div>


            <div class="col-md-8">

                <p class="m-b-33 slight_black p-t-33" style="font-size:17px;">Size Chart
                </p>
                {!! Form::textarea('size_chart', isset($model) && $model['size_chart'] ? $model['size_chart'] :  view('partials.size-chart') ,['class' => '','title'=> "! Size Chart is required field" ]) !!}
            </div>

            <div class="col-md-8 m-b-50">

                <p class="m-b-33 slight_black p-t-33" style="font-size:17px;">Packaging Details
                </p>
                {!! Form::textarea('packing_details', null,['class' => '','title'=> "! Packing details is required field" ]) !!}
                @if($userType == 'admin')
                    @include('admin.products.partial-form', ['model' => isset($model) ? $model : null])
                @endif

                <div class="form-group m-t-33">
                    <div class="flex_end">
                        <button type="button" class="btn btn-info no_border" style="background:#556678;"
                                onclick="previewProduct()">Preview
                        </button>
                        <input class="btn btn-info m-l-13 no_border" type="submit" style="background:#1f73f0"
                               value="Submit">
                    </div>
                </div>
            </div>


        </section>
    </div>
</div>

@if(isset($model))
    @foreach($model->images as $image)
        {{ Form::hidden('temp_images[]', $image->image, ['id' => 'temp-images-'.$image->id]) }}
    @endforeach
@endif
{!! Form::close() !!}

@section('sub-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
    <script src="{{ asset('assets/ajax-upload/js/vendor/jquery.ui.widget.js') }}"></script>
    <script src="{{ asset('assets/ajax-upload/js/jquery.iframe-transport.js') }}"></script>
    <script src="{{ asset('assets/ajax-upload/js/jquery.fileupload.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/eonasdan-bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script src="/assets/validation/jquery.validate.min.js"></script>

    <script>
        function flatRate(id) {
            if (id == 'flat_rate_status_on') {
                document.getElementById('discount').classList.replace('un-hidden', 'hidden');
            } else {
                document.getElementById('discount').classList.replace('hidden', 'un-hidden');
            }
        }

        $(function () {

            $(document.body).on('click', '.changeType', function () {
                $(this).closest('.keyword-item').find('.type-text').text($(this).text());
                $(this).closest('.keyword-item').find('.type-input').val($(this).data('type-value'));
            });

            $(document.body).on('click', '.btn-remove-keyword', function () {
                $(this).closest('.keyword-item').remove();
            });

            $('.btn-add-keyword').click(function () {
                if ($('.keyword-item').length < 4) {

                    var index = $('.keyword-item').length + 1;

                    $('.keyword-list').append('' +
                        '<div class="form-group keyword-item">' +
                        '<label class="col-md-3 control-label"><span class="red"></span>Keyword ' + index + '</label>' +
                        '<div class="col-md-9"><input type="text" name="keyword[]" class="form-control wid_plus" placeholder="" />' +
                        '<button type="button" class="btn btn-danger btn-sm btn-remove-keyword"><span class="glyphicon glyphicon-minus"></span></button>' +
                        '</div></div>'
                    );
                } else {
                    alert('You can add only 4 keyword');
                }
            });
        });


        //sad sad sad

        function addNewAttributeItem(key) {

            if (key.constructor !== String) {
                key = ''
            }
            var index = $('.attribute-item').length + 1;

            if (index < 19)
                $('.attribute-list').append('' +
                    '<div class="attribute-item">' +
                    '<input type="text" name="attribute[' + index + '][key]" class="attribute-title form-control" placeholder="Attribute - e.g Color" value="' + key + '">' +
                    '<input type="text" name="attribute[' + index + '][value]" class="attribute-value form-control" placeholder="Value - e.g Red">' +
                    '<div class="btn_set">' +
                    '<button type="button" class="btn-remove-attribute"><i class="fa fa-close" style="color:#000;"></i></button>' +
                    '<button type="button" onclick="copyAttributeItem(\'attribute[' + index + '][key]\')"><i class="fa fa-clipboard"></i></button>' +
                    '</div></div>'
                );
            else
                alert('You can only add 18 more details items');
        }

        $(function () {

            $(document.body).on('click', '.changeType', function () {
                $(this).closest('.attribute-item').find('.type-text').text($(this).text());
                $(this).closest('.attribute-item').find('.type-input').val($(this).data('type-value'));
            });

            $(document.body).on('click', '.btn-remove-attribute', function () {
                $(this).closest('.attribute-item').remove();
                // alert('hello');
            });

            $('.btn-add-attribute').click(addNewAttributeItem);


        });


        $(function () {

            $(document.body).on('click', '.changeType', function () {
                $(this).closest('.moq_item').find('.type-text').text($(this).text());
                $(this).closest('.moq_item').find('.type-input').val($(this).data('type-value'));
            });

            $(document.body).on('click', '.btn-remove-moq', function () {
                $(this).closest('.moq_item').remove();
                // alert('hello');
            });

            $('.btn-add-moq').click(function () {

                // alert('ehlloo');
                var index = $('.moq_item').length + 1;
                if ($('.moq_item').length < 4)
                    $('.moq_list').append('' +
                        '<tr class="moq_item">' +
                        '<td><p class="some_txt">≥</p>' +
                        '<input type="number" name="moq[' + index + '][moq]" class="moq moq-moq form-control" placeholder=""></td>' +
                        '<td><p class="some_txt">PHP</p>' +
                        '<input type="number" name="moq[' + index + '][price]" class="moq moq-price form-control" placeholder=""></td>' +
                        '<td><button type="button" class="btn-remove-moq"><i class="fa fa-close"></i></button></td>' +
                        '</tr>'
                    );
                else
                    alert("You can add only 4 MOQ");
            });
        });
    </script>

    <script>
        CKEDITOR.replace('details');
        CKEDITOR.replace('shipping_details');
        CKEDITOR.replace('packing_details');
        CKEDITOR.replace('size_chart');
    </script>

    <script>
        var imageIndex = 0;
        var number_of_images = {{ isset($model) ? $model->images->count() : 0 }};


        function browseCategory(element) {
            var category = $(element);
            var loading = $('.browse-category-loading');
            var level = category.data('level');
            category.closest('ul').find('li').removeClass('active');
            unsetCategoryId();

            category.closest('li').addClass('active');
            hideDiv(level);
            $('#category-level-' + level).text(category.text());
            if (category.data('level') < 3) {
                loading.show();

                $.post('/categories/get-children', {_token: '{!! csrf_token() !!}', category_id: category.data('id')})
                    .done(function (data) {
                        loading.hide();
                        if (data.length == 0) {
                            setCategoryId(category.data('id'));
                        } else {

                            var div = $('.div-level-' + (level + 1).toString());
                            var ul = div.find('ul');
                            ul.empty();
                            data.forEach(function (item) {
                                createLiElement(item, level + 1).appendTo(ul);
                            });

                            div.show();
                        }
                    })
                    .fail(function (error) {

                    });
            } else {
                setCategoryId(category.data('id'));
            }

        }

        function unsetCategoryId() {
            $('[name="category_id"]').val('');
        }

        function setCategoryId(id) {
            $('[name="category_id"]').val(id);
            $('.category-id-error').remove();
        }


        function hideDiv(level) {
            for (var i = level + 1; i < 4; i++) {
                $('.div-level-' + i.toString()).hide();
                $('#category-level-' + i).text('');
            }
        }

        function createLiElement(item, level) {
            var a = $(document.createElement('a'));
            var li = $(document.createElement('li'));
            a.attr('href', 'javascript:void(0)');
            a.attr('onclick', "browseCategory(this)");
            a.attr('data-id', item.id);
            a.attr('data-level', level);
            a.text(item.name);
            a.addClass('category-item');
            a.appendTo(li);

            return li;
        }

        $(function () {
            $("input[type='file']").click(function () {
                var $fileUpload = $("input[type='file']");
                if (number_of_images === 8) {
                    alert("You can upload maximum 8 files only!");
                    return false;
                }
                return true;
            });
        });


        $('#files').fileupload({
            url: '/user/products/image-upload/raw_images',
            limitMultiFileUploadSize: 4096,
            submit: function (e, data) {
                if (data.files[0].size > 4194304) {
                    alert('Image is too big(More than 4 MB). Please upload small sized images');
                    return false;
                }

                if (number_of_images < 8) {
                    number_of_images++;
                    return true;
                }
                return false;
            },
            done: function (e, data) {
                console.log(data.result);
                var form = $('form');
                var inputField = $(document.createElement('input'));

                inputField.attr('type', 'hidden');
                inputField.attr('name', 'images[]');
                inputField.attr('class', 'image-' + imageIndex++);
                inputField.attr('data-link', data.result.link);
                inputField.val(data.result.path);
                inputField.appendTo(form);
                $('#files').removeClass('required');
                insertImageLi(inputField.attr('class'), data.result.link);
                $(".product-image-uploading").hide();

//                $('#' + id + '_path').val(data.result);
//                $('#' + id + '_progress').parent().removeClass('progress-striped');
//                alert('uploading is done');

            },
            error: function (e, data) {
                if (e.status == 422)
                    alert(e.responseJSON.raw_images);
                else
                    alert('Something went wrong');

            },
            progress: function (e, data) {
                $(".product-image-uploading").show();
//                var progress = parseInt(data.loaded / data.total * 100, 10);
                //$('#' + id + '_progress').css('width', progress + '%');
            }
        });

        function insertImageLi(id, link) {
            var inputField = $('#'.id);
            var ul = $('#image-list');
            var template = `
                <li class="ui-uploader-img-item ui-uploader-complete" style="width:80px;" id="` + id + `-li" data-class="` + id + `">
                    <div class="ui-uploader-img-wrap"
            style="position: relative;margin: 0;width: 80px;height: 80px;line-height: 78px;border: 1px solid #ddd;background: #f9f9f9;">
                    <img data-role="uploader-preview" data-switch-status="complete"
                width="78"
                    src="` + link + `"
                    height="53">


                                </div>

                                <div class="ui-uploader-action">
                            <span data-switch-status="fileSelect start" style="display: none;">pending</span>
                            <a href="javascript:void(0);" onclick="removeImage(this)">remove</a>
                            </div>
                            </li>`;
            ul.append(template);
        }

        $('[name=unit_type]').change(function () {
            $('.unit-name').text(this.value);
        });


        function removeImage(element, actual_id) {
            var li = element.closest('li');
            var inputFieldId = $(li).data('class');
            var input = $('.' + inputFieldId);

            input.remove();
            li.remove();

            $('#temp-images-' + actual_id).remove();

            if (typeof actual_id !== 'undefined') {
                removeFormItem('image', actual_id);
            }

            number_of_images--;


            if (number_of_images == 0) {
                $('#files').addClass('required');
            }
        }

        //form validation
        var Validator;
        $(document).ready(function () {
            if ($('[name=unit_type]').val())
                $('.unit-name').text();

            $.validator.addMethod("moq-moq", validateMOQ, "MOQ must be in ascending order");
            $.validator.addMethod("product-details", validateProductDetails, "Please enter Product Detail Information");

            Validator = $("#product-form").validate({
                ignore: [],
                errorClass: 'has_input_error',
                errorElement: "p",
                errorPlacement: function (error, element) {
                    error.addClass('warning_box plz_fill product-error-message');
                    if (element.hasClass('attribute-title')) {
                        error.addClass('attribute-error');
                        $('.attribute-error').remove();
//                        $('.add_more_box').prepend(error);
                    } else if (element.hasClass('moq-moq')) {
                        error.addClass('moq-error');
                        $('#moq-moq-error').empty().show().append(error);
                    } else {
                        switch (element.attr("name")) {
                            case 'images':
                                error.insertAfter(element);
                                break;
                            case 'keyword[]':
//                                 element.parent().append(error);
                                break;
                            case 'category_id':
                                error.addClass('category-id-error');
                                window.scrollTo(0, 500);
                                error.insertAfter(element);
                                break;
                            case 'details':
                                error.addClass('warning_box custom-error-message m-t-5');
                                $('#details-error-div').append(error);
                                break;
                            default:

//                                error.insertAfter(element);
                                break;
                        }
                    }
                }
            });
        });

        function validateProductDetails() {
            var data = CKEDITOR.instances.details.getData();

            console.log(data);

            return data ? true : false;
        }

        function removeFormItem(type, id) {
            addHiddenInputField('remove_' + type + '[]', id);
        }


        function addHiddenInputField(name, value) {
            var form = $('form');
            var inputField = $(document.createElement('input'));
            inputField.attr('type', 'hidden');
            inputField.attr('name', name);
            inputField.val(value);
            inputField.appendTo(form);
        }

        function setDirtyField(name) {
            var refinedName = name + '[is_dirty]';
            if ($('[name="' + refinedName + '"').length == 0) {
                addHiddenInputField(refinedName, 1);
            }
        }

        function validateMOQ() {
            var moqs = [];
            var moqElementArray = $('.moq-moq').toArray();
            for (index in moqElementArray) {
                moq = moqElementArray[index];
                moqs.push(parseInt(moq.value));
            }
            if (is_sorted(moqs)) {
                $('#moq-moq-error').hide();

                return true;
            }


            return false;
        }

        function is_sorted(arr) {
            var len = arr.length - 1;
            for (var i = 0; i < len; ++i) {
                if (arr[i] > arr[i + 1]) {
                    return false;
                }
            }
            return true;
        }

        $('.moq_table_wrapper').on('change', '.moq', generate_moq_preview_table);

        generate_moq_preview_table();

        function generate_moq_preview_table() {
            var moq_prices = get_moq_and_price();
            var table = $('#moq-table');
            var table_body = $('#moq-table-body');
            var html = '';

            if (is_any_element(moq_prices)) {
                $('#moq-blank-message').hide();
                table.show();
                table_body.empty();
                for (var index = 0; index < moq_prices.length; index++) {
                    html += "<tr><td>";
                    if (moq_prices[(index + 1)] !== undefined) {
                        html += moq_prices[index].moq + '-' + (moq_prices[(index + 1)].moq - 1)
                    } else {
                        html += '≥' + moq_prices[index].moq;
                    }
                    html += '</td><td>NRS ' + moq_prices[index].price + '</td></tr>';
                }
                table_body.html(html);
            } else {
                $('#moq-blank-message').show();
                table.hide();
            }
        }

        function get_moq_and_price() {
            var moq_prices = [];
            var moqElementArray = $('.moq-moq').toArray();
            for (index in moqElementArray) {
                moq = $(moqElementArray[index]);
                moq_prices.push({moq: moq.val(), price: moq.closest('tr').find('.moq-price').val()});
            }

            return moq_prices;
        }

        function is_any_element(moq_prices) {
            for (index in moq_prices)
                if (moq_prices[index].moq.length == 0 || moq_prices[index].price.length == 0)
                    return false;

            return true;
        }


        function setSeller(seller_id, name, image_url) {
            $('#seller-id').val(seller_id);
            $('#seller-name').text(name);
            $('#seller-image').attr('src', image_url);
        }

        function selectCategoryButton() {
            $('#category-selection-div').show();
            $('#select-category-button').hide();
        }

        function previewProduct() {
            var formStatus = Validator.form();
            if (formStatus) {
                ['details', 'shipping_details', 'packing_details'].forEach(function (item, index) {
                    $('textarea[name=' + item + ']').val(CKEDITOR.instances[item].getData());
                });

                var formData = $('#product-form').serialize();
                $.post('/user/temp-products', formData)
                    .done(function (data) {
                        window.open(data, '_blank');
                    })
                    .fail(function (err) {
                        alert('Something went wrong');
                    });
            }
        }


        function copyAttributeItem(name) {
            var value = $('input[name="' + name + '"]').val()
            addNewAttributeItem(value)
        }

        $('#datepicker1').datetimepicker({format: 'YYYY-MM-DD HH:mm'});


    </script>
@endsection