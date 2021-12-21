@extends('admin.layouts.app')
@section('css')

    <link rel="stylesheet" type="text/css"
          href="{{ asset('backend/app-assets/css/plugins/forms/validation/form-validation.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('backend/tagin-master/dist/css/tagin.css') }}">
@endsection

@section('js')

    <script src="{{ asset('backend/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js') }}"></script>
    <script src="{{ asset('backend/app-assets/js/scripts/forms/validation/form-validation.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/29.0.0/classic/ckeditor.js"></script>
    <script src="{{ asset('backend/custom/customfuncitons.js') }}"></script>
    <script>
        ClassicEditor.create(document.querySelector('#ck-editor1'))
            .catch(error => {
                console.error(error);
            });

        $(document).ready(function () {
            $('.js-example-basic-multiple').select2({
                tags: false,
                newTag: false,
                placeholder: "Select an option",
                allowClear: true
            });
        });

        $('.js-example-basic-multiple').on('change', function () {
            var selected = [];
            $(".js-example-basic-multiple option:selected").each(function (key, item) {
                selected.push(item.text);
            });
            $.post('{{ route('admin.get.products-attribute-fields') }}', {
                _token: '{{ @csrf_token() }}',
                attrs: selected
            }, function (data) {
                $('#product-attribute-fields').html(data);
            });

        })
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


    <script src="{{ asset('backend/tagin-master/dist/js/tagin.js') }}"></script>

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
                $('.discountOptionValue').prop("type", 'text');
                // $('.discountOptionValue').prop("disabled", false);
            }
        }
    </script>

    {{-- <script src="{{ asset('backend/new/bootstrap-tagsinput.js')}}"></script> --}}


    <script>
        function browseSubCategory(category, selectId = null) {
            var root_cat_id = category.value;
            $(document).ready(function (e) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{ Session::token() }}'
                    }
                });

                $.ajax({
                    url: '{{ url('/admin/products/browsecategory') }}' + '/' + root_cat_id,
                    type: 'POST',
                    data: {
                        "id": root_cat_id,
                        "_method": 'POST',
                    },
                    success: function (result) {
                        $('.sub-category').attr('display', 'block')
                        if (selectId) {
                            $('.' + selectId).html(result)
                        } else {
                            $('.sub-category').html(result)
                        }
                    },
                    error: function (result) {
                        $('.sub-category').attr('display', 'block')
                        console.log(result)
                    }
                });
            });
        }
    </script>

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
                            <h2 class="content-header-title float-left mb-0">New Product</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">products</a>
                                    </li>
                                    <li class="breadcrumb-item active"><a href="#">Add New Product</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                @include('admin.partials.view-all-include',['route' =>'admin.products.index'])
            </div>
            <div class="content-body">
                <form action="{{ route('admin.products.store') }}"
                      class="form form-vertical" method="POST"
                      enctype="multipart/form-data">
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
                                                               class="form-control" name="name"
                                                               placeholder="Product Name" required
                                                               onkeyup="setSlug(this.value)">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="Slug-vertical">Slug</label>
                                                        <input type="text" id="slug"
                                                               class="form-control"
                                                               name="slug" placeholder="Slug" readonly
                                                               required>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="Keyword-vertical">Keyword</label>
                                                        <input type="text" name="keyword[]"
                                                               class="form-control tagin"
                                                               value="new product,branded"
                                                               data-placeholder="Add new keyword... (then press comma)"
                                                               data-duplicate="true">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="icon-info-vertical">Image <span
                                                                    class="text-danger">*</span></label>
                                                        <input type="file" id="icon-info-vertical"
                                                               class="form-control" name="images[]"
                                                               placeholder="Image" multiple required/>
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
                                                               class="form-control" name="price"
                                                               placeholder="Product Price" required>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="price-vertical">Skin
                                                            Tone <span class="text-danger">*</span> </label>
                                                        <select name="skin_tone" id="fair"
                                                                class="form-control" required>
                                                            <option value="normal-skin">Normal Skin</option>
                                                            <option value="dry-skin">Dry Skin</option>
                                                            <option value="oily-skin">Oily Skin</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="price-vertical">Skin
                                                            Concerns <span class="text-danger">*</span> </label>
                                                        <select name="skin_concern" id="fair"
                                                                class="form-control" required>
                                                            @foreach(skin_concerns() as $skin_concern)
                                                                <option value="{{$skin_concern}}"> {{$skin_concern}} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="price-vertical">
                                                            Product TYpe <span class="text-danger">*</span> </label>
                                                        <select name="product_type" id="fair"
                                                                class="form-control" required>
                                                            @foreach(product_types() as $product_type)
                                                                <option value="{{$product_type}}">{{$product_type}}</option>
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
                                                            <option value="no discount">No Discount</option>
                                                            <option value="flat_rate">Flat Rate</option>
                                                            <option value="percentage">Percentage</option>
                                                            <option value="cash_back">Cash Back(%)</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="price-vertical">Discount</label>
                                                        <input type="text" id="price-vertical"
                                                               class="form-control  discountOptionValue"
                                                               name="discount_rates"
                                                               placeholder="Discount">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label for="price-vertical">Made In</label>
                                                    <select id="discount-vertical" class="form-control"
                                                            name="made_in">
                                                        @foreach (get_countries() as $id => $country)
                                                            <option value="{{ $id }}">{{ $country }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-6">
                                                    <label for="price-vertical">Status</label>
                                                    <select id="discount-vertical" class="form-control"
                                                            name="status" required>
                                                        @foreach (get_general_status() as $value => $key)
                                                            <option value="{{ $value }}">{{ $key }}</option>
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
                                                        <select class="form-control js-example-basic-multiple"
                                                                name="attributes[]" id="attributes"
                                                                multiple="multiple" style="width: 100%">
                                                            <option value="">Select Attribute</option>
                                                            @foreach ($attributes as $attribute)
                                                                <option value="{{ Str::slug($attribute->value) }}">{{ $attribute->value }}</option>
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
                                                                  rows="5"></textarea>
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
                                                                  rows="5"></textarea>
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
                                                                  rows="5">
                                                        </textarea>
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
                                                            @foreach (get_root_categories() as $category_id => $category)
                                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 sub-category" style="display: none">
                                                    <label for="users-list-status">Sub
                                                        Category</label>
                                                    <div class="form-group">
                                                        <select class="sub-category select2-theme form-control"
                                                                onchange="browseSubCategory(this,'sub-sub-category')"
                                                                name="sub_category_id">
                                                            {{-- <option value="">Choose Sub Category</option> --}}
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <label for="users-list-verified">Sub-Sub
                                                        Category</label>
                                                    <div class="form-group">
                                                        <select class="form-control sub-sub-category select2-theme"
                                                                name="sub_sub_category_id">

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
                                                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
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
                                                                        selected>{{ $unit }}</option>
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
                                                               placeholder="stock-keeping unit (sku)" required/>
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

    <!-- // Basic Vertical form layout section end -->

    <!-- END: Content-->
@endsection
