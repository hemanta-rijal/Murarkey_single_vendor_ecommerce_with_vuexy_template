@extends('admin.layouts.app')
@section('css')

<link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/css/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/vendors/css/forms/select/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/tagin-master/dist/css/tagin.css') }}">
    @endsection

    @section('js')

    <script src="{{ asset('backend/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js') }}"></script>
    <script src="{{ asset('backend/app-assets/js/scripts/forms/validation/form-validation.js')}}"></script>
    <script src="{{ asset('backend/custom/customfuncitons.js')}}"></script>
    
    <script src="{{ asset('backend/app-assets/vendors/js/forms/select/select2.full.js') }}"></script>
    <script src="{{ asset('backend/app-assets/js/scripts/forms/select/form-select2.js') }}"></script>


    <script src="{{ asset('backend/tagin-master/dist/js/tagin.js')}}"></script>
    <script>
        for (const el of document.querySelectorAll('.tagin')) {
        tagin(el)
        }
    </script>

    <script src="{{ asset('backend/new/bootstrap-tagsinput.js')}}"></script>
    {{-- <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script> --}}

    <script>
        function browseSubCategory(category,selectId=null){
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
                            if(selectId){
                                $('.'+selectId).html(result)
                            }else{
                                $('.sub-category').html(result)
                            }
                        },
                        error: function (result) {
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
            <!-- Basic Vertical form layout section start -->
            {{-- @include('admin.products.category-partial') --}}
            <section id="basic-vertical-layouts">
                <div class="row match-height justify-content-md-center">
                    {{-- <div class="col-md-2 col-6"></div> --}}
                    <div class="col-md-8  col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Create New Product</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row m-0">
                                        <form action="{{route('admin.products.store')}}" class="form form-vertical" method="POST" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                                <div class="card">
                                                    <div class="form-body">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="name-vertical">Product Name</label>
                                                                    <input type="text" id="name-vertical" class="form-control" name="name" placeholder="Product Name" required onkeyup="setSlug(this.value)">
                                                                </div>
                                                            </div>
                                                             <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="Slug-vertical">Slug</label>
                                                                    <input type="text" id="slug" class="form-control" name="slug" placeholder="Slug" readonly required>
                                                                </div>
                                                            </div>
                                                            <div class=" col-12">
                                                                <label for="name-vertical">Select Ctegory</label>
                                                                <div class="card-header">
                                                                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                                                    {{-- <div class="heading-elements">
                                                                        <ul class="list-inline mb-0">
                                                                            <li><a data-action=""><i class="feather icon-rotate-cw users-data-filter"></i></a></li>
                                                                        </ul>
                                                                    </div> --}}
                                                                </div>

                                                                <div class="row" >
                                                                    <div class="col-12 col-sm-6 col-lg-12">
                                                                        <div class="form-group">
                                                                            <select class="select2-theme form-control" onchange="browseSubCategory(this, 'sub-category')" name="category_id" required>
                                                                                @foreach(get_root_categories() as $category_id=>$category)
                                                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-sm-6 col-lg-12">
                                                                        <label for="users-list-status">Sub Category</label>
                                                                        <div class="form-group">
                                                                            <select class="sub-category select2-theme form-control"onchange="browseSubCategory(this,'sub-sub-category')" name="sub_category_id">
                                                                                {{-- <option value="">Choose Sub Category</option> --}}
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-sm-6 col-lg-12">
                                                                        <label for="users-list-verified">Sub-Sub Category</label>
                                                                        <div class="form-group">
                                                                            <select class="form-control sub-sub-category select2-theme" name="sub_sub_category_id">
                                                                            
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="unit-vertical">Product Unit</label>
                                                                        <select name="unit_type" class="select2 js-example-programmatic form-control" id="programmatic-single">
                                                                            @foreach(get_unit_types() as $unit)
                                                                                <option value="{{$unit }}" data-icon="fa fa-wordpress" selected>{{$unit}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label for="Keyword-vertical">Keyword</label>
                                                                        {{-- <input type="text" name="tags" class="form-control tagin" value="red,green,blue" data-placeholder="Add new keyword... (then press comma)" data-duplicate="true"> --}}
                                                                        <input type="text" name="keywords[]" class="form-control tagin" value="new product,branded" data-placeholder="Add new keyword... (then press comma)" data-duplicate="true">
                                                                    </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="icon-info-vertical">Image</label>
                                                                    <input type="file" id="icon-info-vertical" class="form-control" name="images[]" placeholder="Image"  multiple required/>
                                                                </div>
                                                            </div>

                                                            <hr>
                                                                <div class="card">
                                                                    <div class="card-header">
                                                                        <h4 class="card-title">Product Details</h4>
                                                                    </div>
                                                                </div>
                                                            <hr>

                                                            @isset($brands)
                                                            <div class="col-12 form-group">
                                                                <label>Brand Name</label>
                                                                <div class="controls">
                                                                    <select name="brand_name" id="brand" class="form-control">
                                                                        @foreach ($brands as $brand)
                                                                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            @endisset
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="price-vertical">Product Price</label>
                                                                    <input type="text" id="price-vertical" class="form-control" name="price" placeholder="Product Price" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="price-vertical">Discount Type</label>
                                                                    <select type="text" id="discount-vertical" class="form-control" name="discount_type" placeholder="Discount type" required>
                                                                        <option value="no discount">No Discount</option>
                                                                        <option value="flat_rate">Flat Rate</option>
                                                                        <option value="percentage">Percentage</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="price-vertical">Discount</label>
                                                                    <input type="text" id="price-vertical" class="form-control" name="a_discount_price" placeholder="Discount" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                    <label for="price-vertical">Made In</label>
                                                                    <select id="discount-vertical" class="form-control" name="made_in" required>
                                                                        @foreach (get_countries() as $id=>$country)
                                                                            <option value="{{$id}}">{{$country}}</option>
                                                                        @endforeach
                                                                    </select>
                                                            </div>
                                                            <div class="col-6">
                                                                    <label for="price-vertical">Status</label>
                                                                    <select id="discount-vertical" class="form-control" name="status" required>
                                                                        @foreach (get_general_status() as $value=>$key)
                                                                            <option value="{{$value}}">{{$key}}</option>
                                                                        @endforeach
                                                                    </select>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                <label for="price-vertical">Attributes</label>
                                                                
                                                                <div class="row">
                                                                        <div class="col-6">
                                                                            <input type="text" id="price-vertical" class="form-control" name="attributes[]" placeholder="attribute:- eg: color" required>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <input type="text" id="price-vertical" class="form-control" name="values[]" placeholder="Red" required>
                                                                        </div>
                                                                </div>
                                                                </div>
                                                            </div>

                                                            <hr>
                                                                    <div class="card">
                                                                    <div class="card-header">
                                                                        <h4 class="card-title">Product Detail Information</h4>
                                                                    </div>
                                                                
                                                                </div>
                                                            <hr>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="Description-id-vertical">Description</label>
                                                                    <textarea type="text" id="Description-id-vertical" class="form-control" name="details" placeholder="Description" rows="5"></textarea>
                                                                </div>
                                                            </div>

                                                            <hr>
                                                                <div class="card">
                                                                    <div class="card-header">
                                                                        <h4 class="card-title">Shipping and Delivery Details</h4>
                                                                    </div>
                                                                </div>
                                                            <hr>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="Description-id-vertical">Shipping and Delivery Details</label>
                                                                    <textarea type="text" id="Description-id-vertical" class="form-control" name="shipping_details" placeholder="Shipping And Deliveary Details" rows="5"></textarea>
                                                                </div>
                                                            </div>

                                                            <hr>
                                                                <div class="card">
                                                                    <div class="card-header">
                                                                        <h4 class="card-title">Packaging Details</h4>
                                                                    </div>
                                                                </div>
                                                            <hr>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="Description-id-vertical">Packaging Details</label>
                                                                    <textarea type="text" id="Description-id-vertical" class="form-control" name="packing_details" placeholder="Packaging Details" rows="5"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <button type="submit" value="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
                                                                <button type="reset" class="btn btn-outline-warning mr-1 mb-1">Reset</button>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-md-2 col-6"></div> --}}
                    </div>
                </div>
            </section>
            <!-- // Basic Vertical form layout section end -->

        </div>
    </div>
</div>
<!-- END: Content-->
@endsection
