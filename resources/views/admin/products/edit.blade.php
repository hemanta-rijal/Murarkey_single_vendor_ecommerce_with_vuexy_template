@extends('admin.layouts.app')
@section('css')

    <link rel="stylesheet" type="text/css"
          href="{{ asset('backend/app-assets/css/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('backend/app-assets/vendors/css/forms/select/select2.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('backend/tagin-master/dist/css/tagin.css') }}">
@endsection

@section('js')

    <script src="{{ asset('backend/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js') }}"></script>
    <script src="{{ asset('backend/app-assets/js/scripts/forms/validation/form-validation.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/29.0.0/classic/ckeditor.js"></script>
    <script src="{{ asset('backend/custom/customfuncitons.js')}}"></script>

    <script type="text/javascript">

        $(document).ready(function () {
            $('.js-example-basic-multiple').select2({
                tags: "true",
                placeholder: "Select an option",
                allowClear: true
            });

            $('.js-example-basic-multiple').on('change', function () {
                var selected = [];
                $(".js-example-basic-multiple option:selected").each(function (key, item) {
                    selected.push(item.text);
                });
                console.log(selected)
                $.post('{{ route('admin.get.products-attribute-fields') }}', {
                    _token: '{{ @csrf_token() }}',
                    attrs: selected,
                    product_id: '{{ $product->id }}'
                }, function (data) {
                    $('#product-attribute-fields').html(data);
                });
            });
        });
    </script>
    <script type="text/javascript">

        window.addEventListener("load", function () {
            var selected = [];
            $(".js-example-basic-multiple option:selected").each(function (key, item) {
                selected.push(item.text);
            });
            $.post('{{ route('admin.get.products-attribute-fields') }}', {
                _token: '{{ @csrf_token() }}',
                attrs: selected,
                product_id: '{{$product->id}}'
            }, function (data) {
                $('#product-attribute-fields').html(data);
            });
        }, false);
    </script>
    <script>
        ClassicEditor.create(document.querySelector('#ck-editor1'))
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        ClassicEditor.create(document.querySelector('#ck-editor2'))
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        ClassicEditor.create(document.querySelector('#ck-editor3'))
            .catch(error => {
                console.error(error);
            });
    </script>

    <script src="{{ asset('backend/tagin-master/dist/js/tagin.js')}}"></script>
    <script>
        for (const el of document.querySelectorAll('.tagin')) {
            tagin(el)
        }

        var discountOptoion = $('#discount-vertical').val()
        disableDiscountValueField(discountOptoion)

        function discountOption(option) {
            disableDiscountValueField(option.value)
        }

        function disableDiscountValueField(optionVal) {
            if (optionVal == 'no discount') {
                // $('.discountOptionValue').prop("disabled", true);
                $('.discountOptionValue').prop("type", 'hidden');
            } else {
                // $('.discountOptionValue').prop("disabled", false);
                $('.discountOptionValue').prop("type", 'text');
            }
        }
    </script>


    <script src="{{ asset('backend/new/bootstrap-tagsinput.js')}}"></script>
    {{-- <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script> --}}

    <script>
        function browseSubCategory(category, selectId = null) {
            var root_cat_id = category.value;
            $(document).ready(function (e) {
                $.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': '{{ Session::token() }}'}
                });

                $.ajax({
                    url: '{{ url('/admin/products/browsecategory') }}' + '/' + root_cat_id,
                    type: 'POST',
                    data: {
                        "id": root_cat_id,
                        "_method": 'POST',
                    },
                    success: function (result) {
                        console.log(result)
                        if (selectId) {
                            $('.' + selectId).html(result)
                        } else {
                            $('.sub-category').html(result)
                        }
                    },
                    error: function (result) {
                        console.log(result)
                    }
                });
            });

            console.log(category);
        }
    </script>
@endsection

@section('content')
    <?php
        $selectedSkinType = $product->skin_tone!=null ? explode(',', slugifyCommaSeparateValue($product->skin_tone)):null;
        $selectedSkinConcerns = $product->skin_concern!=null ? explode(',',slugifyCommaSeparateValue($product->skin_concern)):null;
        $selectedProductType = $product->product_type!=null ? explode(',',slugifyCommaSeparateValue($product->product_type)):null;

    ?>


    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            @include('flash::message')
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">New Product</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="#">products</a></li>
                                    <li class="breadcrumb-item active"><a href="#">Add New Product</a></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                @include('admin.partials.view-all-include',['route' =>'admin.products.index'])
            </div>
            <div class="content-body">
                <form action="{{route('admin.products.update',$product->id)}}"
                      class="form form-vertical" method="POST"
                      enctype="multipart/form-data">
                    @method('put')
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Basic Details</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="name-vertical">Product Name <span
                                                                    class="text-danger">*</span></label>
                                                        <input type="text" id="name-vertical"
                                                               class="form-control" name="name"  value="{{$product->name}}"
                                                               placeholder="Product Name" required
                                                               onkeyup="setSlug(this.value)">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="Slug-vertical">Slug</label>
                                                        <input type="text" id="slug"
                                                               class="form-control" value="{{$product->slug}}"
                                                               name="slug" placeholder="Slug" readonly
                                                               required >
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="Keyword-vertical">Keyword</label>
                                                        <input type="text" name="keyword[]"
                                                               class="form-control tagin"
                                                               value="{{$keywords?? '' }}"
                                                               data-placeholder="Add new keyword... (then press comma)"
                                                               data-duplicate="true">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="icon-info-vertical">Image </label>
                                                        <input type="file" id="icon-info-vertical"
                                                               class="form-control" name="images[]"
                                                               placeholder="Image" multiple />
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                        <h4 class="card-title">Product Details</h4>
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="price-vertical">Product Price in NRs. <span
                                                                    class="text-danger">*</span></label>
                                                        <input type="text" id="price-vertical"
                                                               class="form-control" name="price" value="{{$product->price}}"
                                                               placeholder="Product Price" required>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <div class="form-group">
                                                            <label for="">Skin
                                                                Tone &nbsp;</label>
                                                            <select class="form-control js-example-basic-multiple"
                                                                    name="skin_tone[]" id="skin_tone"
                                                                    multiple="multiple" style="width: 100%">
                                                                <option value="">Select Attribute</option>
                                                                @foreach (skin_type() as $skin_type)
                                                                    <option value="{{ Str::slug($skin_type)}}" {{ $selectedSkinType!=null ? in_array(Str::slug($skin_type),$selectedSkinType) ? 'selected':'':''}}>{{ $skin_type }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="price-vertical">Skin
                                                            Concerns <span class="text-danger">*</span> </label>
                                                        <select name="skin_concern[]" id="skin_concern"
                                                                class="form-control  js-example-basic-multiple"
                                                                multiple="multiple" required>
                                                            @foreach(skin_concerns() as $skin_concern)
                                                                <option value="{{Str::slug($skin_concern)}}" {{ $selectedSkinConcerns!=null ?  in_array(Str::slug($skin_concern),$selectedSkinConcerns) ? 'selected':'':''}}> {{$skin_concern}} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="price-vertical">
                                                            Product TYpe <span class="text-danger">*</span> </label>
                                                        <select name="product_type[]" id="product_type"
                                                                class="form-control js-example-basic-multiple"
                                                                multiple="multiple" required>
                                                            @foreach(product_types() as $product_type)
                                                                <option value="{{Str::slug($product_type)}}" {{ $selectedProductType!=null ? in_array(Str::slug($product_type),$selectedProductType) ? 'selected':'':''}}>{{$product_type}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="price-vertical">Discount Type</label>
                                                        <select type="text" id="discount-vertical"
                                                                class="form-control" name="discount_type"
                                                                placeholder="Discount type"
                                                                onchange="discountOption(this)" required>
                                                            <option {{'no discount' == $product->discount_type ? 'selected' : ''}} value="no discount">No Discount</option>
                                                            <option {{'flat_rate' == $product->discount_type ? 'selected' : ''}} value="flat_rate">
                                                                Flat Rate
                                                            </option>
                                                            <option {{'percentage' == $product->discount_type ? 'selected' : ''}} value="percentage">
                                                                Percentage
                                                            </option>
                                                            <option {{'cash_back' == $product->discount_type ? 'selected' : ''}} value="cash_back">
                                                                Cash Back
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="price-vertical">Discount</label>
                                                        <input type="text" id="price-vertical"
                                                               class="form-control  discountOptionValue"
                                                               name="discount_rates"
                                                               placeholder="Discount" value={{$product->discount_rates}} >
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label for="price-vertical">Made In</label>
                                                    <select id="discount-vertical" class="form-control"
                                                            name="made_in">
                                                        @foreach (get_countries() as $id=>$country)
                                                            <option {{$product->made_in==$id ? 'selected' : ''}} value="{{$id}}">{{$country}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-6">
                                                    <label for="price-vertical">Status</label>
                                                    <select id="discount-vertical" class="form-control"
                                                            name="status" required>
                                                        @foreach (get_general_status() as $value=>$key)
                                                            <option {{$value==$product->status ? 'selected' : ''}} value="{{$value}}">{{$key}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>


                                        <h4 class="card-title">Product Attributes</h4>
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="">Attributes &nbsp;</label>
                                                        <select class="form-control js-example-basic-multiple attributes"
                                                                name="attributes[]" id="attributes"
                                                                multiple="multiple" style="width: 100%">
                                                            <option value="">Select Attribute</option>
                                                            @foreach($all_attributes as $attribute)
                                                                @if(in_array($attribute->id,$selected_attributes))
                                                                    <option value="{{Str::slug($attribute->value)}}"
                                                                            selected>{{$attribute->value}}</option>
                                                                @else
                                                                    <option value="{{Str::slug($attribute->value)}}">{{$attribute->value}}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12" id="product-attribute-fields">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <h4 class="card-title">Product Detail Information</h4>
                                        <hr>
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="Description-id-vertical">Description <span
                                                                    class="text-danger">*</span> </label>
                                                        <textarea type="text" id="ck-editor1"
                                                                  class="form-control ck-editor__editable_inline"
                                                                  name="details" placeholder="Description"
                                                                  rows="5">{!! $product->details !!}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <hr>
                                                    <h4 class="card-title">Shipping and Delivery
                                                        Details</h4>
                                                    <hr>
                                                    <div class="form-group">
                                                        <label for="Description-id-vertical">Shipping and
                                                            Delivery Details</label>
                                                        <textarea type="text" id="ck-editor2"
                                                                  class="form-control ck-editor__editable_inline"
                                                                  name="shipping_details"
                                                                  placeholder="Shipping And Deliveary Details"
                                                                  rows="5">{!! $product->shipping_details !!}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <h4 class="card-title">Packaging Details</h4>

                                                    <hr>
                                                    <div class="form-group">
                                                        <label for="Description-id-vertical">Packaging
                                                            Details</label>
                                                        <textarea type="text" id="ck-editor3"
                                                                  class="form-control ck-editor__editable_inline"
                                                                  name="packing_details"
                                                                  placeholder="Packaging Details"
                                                                  rows="5">{!! $product->packing_details !!}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">

                                        <div class="form-body">
                                            <div class="row">
                                                <div class=" col-12">
                                                    <div class="form-group">
                                                        <label for="name-vertical">Select
                                                            Ctegory</label>
                                                        <select class="select2-theme form-control"
                                                                onchange="browseSubCategory(this, 'sub-category')"
                                                                name="category_id" required>
                                                            <option value="">Select Category</option>
                                                            @foreach(get_root_categories() as $category_id=>$category)
                                                                <option {{$category->id == $product->category_id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <hr>
                                                @isset($brands)
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label>Brand Name</label>
                                                            <div class="controls">
                                                                <select name="brand_id" id="brand"
                                                                        class="form-control" required>
                                                                    <option value="">Select Brand</option>
                                                                    @foreach ($brands as $brand)
                                                                        <option {{$brand->id == $product->brand_id ? 'selected' : ''}} value="{{$brand->id}}" {{$brand->id== $product->brand_id ? 'selected' : ''}}>{{$brand->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endisset
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="unit-vertical">Product Unit</label>
                                                        <select name="unit_type"
                                                                class="select2 js-example-programmatic form-control"
                                                                id="programmatic-single" required>
                                                            @foreach (get_unit_types() as $unit)
                                                                <option value="{{ $unit }}"
                                                                        data-icon="fa fa-wordpress"
                                                                        {{$unit==$product->unit_type ? 'selected':''}}>{{ $unit }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="price-vertical">SKU <span
                                                                    class="text-danger">*</span></label>
                                                        <input type="text" id="sku"
                                                               class="form-control" name="sku"
                                                               placeholder="stock-keeping unit (sku)" value="{{$product->sku}}" required/>
                                                    </div>
                                                </div>
                                                <div class=" col-6">
                                                    <div class="form-group">
                                                        <label for="price-vertical">Item in Stock <span
                                                                    class="text-danger">*</span></label>
                                                        <input type="text" id="sku"
                                                               class="form-control"
                                                               name="total_product_units"
                                                               placeholder="Total avalilabel units of products"
                                                               value="{{$product->total_product_units}}"
                                                               required/>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-12">
                                                    <button type="submit" value="submit"
                                                            class="btn btn-primary mr-1 mb-1">Submit
                                                    </button>
                                                    <button type="reset"
                                                            class="btn btn-outline-warning mr-1 mb-1">Reset
                                                    </button>
                                                </div>

                                            </div>
                                        </div>


                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
