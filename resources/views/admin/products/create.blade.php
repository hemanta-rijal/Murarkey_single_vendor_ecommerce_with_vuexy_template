@extends('admin.layouts.app')
@section('css')

<link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/css/plugins/forms/validation/form-validation.css') }}">

    <link rel="stylesheet" href="{{ asset('backend/tagin-master/dist/css/tagin.css') }}">
    @endsection

    @section('js')

    <script src="{{ asset('backend/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js') }}"></script>
    <script src="{{ asset('backend/app-assets/js/scripts/forms/validation/form-validation.js')}}"></script>


    <script src="{{ asset('backend/tagin-master/dist/js/tagin.js')}}"></script>
    <script>
        for (const el of document.querySelectorAll('.tagin')) {
        tagin(el)
        }
    </script>
    
    <script src="{{ asset('backend/new/bootstrap-tagsinput.js')}}"></script>
    {{-- <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script> --}}
    <script>
        function slugify(text) {
            return text.toString().toLowerCase()
                .replace(/\s+/g, '-') // Replace spaces with -
                .replace(/[^\w\-]+/g, '') // Remove all non-word chars
                .replace(/\-\-+/g, '-') // Replace multiple - with single -
                .replace(/^-+/, '') // Trim - from start of text
                .replace(/-+$/, ''); // Trim - from end of text
        }

        function setSlug(value) {
            $('#slug').val(slugify(value));
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
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="name-vertical">Select Ctegory</label>
                                                            <select class="select2 js-example-programmatic form-control" id="programmatic-single">
                                                              @foreach(get_root_categories() as $category_id=>$category)
                                                                    @if($category->child_category->count())
                                                                        <optgroup label="{{$category->name}}">
                                                                            @foreach ($category->child_category as $sub_category)
                                                                                <option value="{{$sub_category->id}}" data-icon="fa fa-wordpress" selected>{{$sub_category->name}}</option>
                                                                            @endforeach
                                                                        </optgroup>
                                                                    @else
                                                                        <option value="{{$category->id}}" data-icon="fa fa-wordpress" selected>{{$category->name}}</option>
                                                                    @endif
                                                              @endforeach
                                                            </select>
                                                   
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="name-vertical">Product Name</label>
                                                        <input type="text" id="name-vertical" class="form-control" name="name" placeholder="Product Name" required>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="Keyword-vertical">Keyword</label>
                                                            {{-- <input type="text" name="tags" class="form-control tagin" value="red,green,blue" data-placeholder="Add new keyword... (then press comma)" data-duplicate="true"> --}}
                                                            <input type="text" name="keywords" class="form-control tagin" value="new product,branded" data-placeholder="Add new keyword... (then press comma)" data-duplicate="true">
                                                        </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="icon-info-vertical">Image</label>
                                                        <input type="file" id="icon-info-vertical" class="form-control" name="image" placeholder="Image" required/>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        </div>
                                        <hr>
                                        <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Product Detailst</h4>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="row m-0">
                                                    <p class="m-b-33 slight_black" style="font-size:17px;">
                                                        <span class="f-s-14" style="color:dimgray;">Complete product details help your listing gain more exposure and visibility to potential buyers.</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>

                                        <div class="form-body">
                                            <div class="row">
                                                @isset($brands)
                                                <div class="col-12 form-group">
                                                    <label>Brand Name</label>
                                                    <div class="controls">
                                                        <select name="brand" id="brand" class="form-control">
                                                            @foreach ($brands() as $brand)
                                                            <option value="{{$brand->id}}">{{$brand->title}}</option>
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
                                                        <label for="price-vertical">Discount</label>
                                                        <select type="text" id="discount-vertical" class="form-control" name="discount" placeholder="Discount type" required>
                                                            <option value="no discount">No Discount</option>
                                                            <option value="flat_rate">Flat Rate</option>
                                                            <option value="percentage">Percentage</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="price-vertical">Discount</label>
                                                        <input type="text" id="price-vertical" class="form-control" name="discount" placeholder="Discount" required>
                                                    </div>
                                                </div>
                                                {{-- {{dd(get_general_status())}} --}}
                                                 <div class="col-6">
                                                        <label for="price-vertical">Made In</label>
                                                        <select id="discount-vertical" class="form-control" name="made_in" required>
                                                            @foreach (get_countries() as $id=>$country)
                                                                <option value="{{$id}}">{{$country}}</option>
                                                            @endforeach
                                                        </select>
                                                </div>
                                                 <div class="col-6">
                                                        <label for="price-vertical">Made In</label>
                                                        <select id="discount-vertical" class="form-control" name="made_in" required>
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
                                                        <textarea type="text" id="Description-id-vertical" class="form-control" name="description" placeholder="Description" rows="5"></textarea>
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
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-md-2 col-6"></div> --}}
                </div>
            </section>
            <!-- // Basic Vertical form layout section end -->


        </div>
    </div>
</div>
<!-- END: Content-->
@endsection
