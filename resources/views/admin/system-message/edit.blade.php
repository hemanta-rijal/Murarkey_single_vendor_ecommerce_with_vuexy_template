@extends('admin.layouts.app')
@section('css')
    <link rel="stylesheet" type="text/css"
          href="{{ asset('backend/app-assets/css/plugins/forms/validation/form-validation.css') }}">
@endsection

@section('js')
    <script src="{{ asset('backend/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js') }}"></script>
    <script src="{{ asset('backend/app-assets/js/scripts/forms/validation/form-validation.js')}}"></script>

@section('scripts')
    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
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


        CKEDITOR.replace('size_chart');

    </script>
@endsection
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
                            <h2 class="content-header-title float-left mb-0">Brands</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Brands</a>
                                    </li>
                                    <li class="breadcrumb-item active"><a href="#">Update Brand</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrum-right">
                        <div class="dropdown">
                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                        class="feather icon-settings"></i></button>
                            <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Chat</a><a
                                        class="dropdown-item" href="#">Email</a><a class="dropdown-item" href="#">Calendar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic Vertical form layout section start -->
                <section id="basic-vertical-layouts">
                    <div class="row match-height justify-content-md-center">
                        {{-- <div class="col-md-2 col-6"></div> --}}
                        <div class="col-md-8 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Update Brand</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form action="{{route('admin.brands.update',$brand->id)}}"
                                              class="form form-vertical" method="POST" enctype="multipart/form-data">
                                            @method('put')
                                            {{ csrf_field() }}
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="name-vertical">Brand Name</label>
                                                            <input type="text" id="name-vertical" class="form-control"
                                                                   name="name" placeholder="Brand Name"
                                                                   value="{{$brand->name}}"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="Image-vertical">Image</label>
                                                            <input type="file" id="image" class="form-control"
                                                                   name="image" placeholder="image"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="caption-vertical">Caption</label>
                                                            <textarea type="file" id="caption" class="form-control"
                                                                      name="caption"
                                                                      placeholder="caption">{{$brand->caption}}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="Description-id-vertical">Description</label>
                                                            <textarea type="text" id="Description-id-vertical"
                                                                      class="form-control" name="description"
                                                                      placeholder="Description"
                                                                      rows="5">{!! $brand->description !!}</textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <button type="submit" value="submit"
                                                                class="btn btn-primary mr-1 mb-1">Submit
                                                        </button>
                                                        <button type="reset" class="btn btn-outline-warning mr-1 mb-1">
                                                            Reset
                                                        </button>
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
