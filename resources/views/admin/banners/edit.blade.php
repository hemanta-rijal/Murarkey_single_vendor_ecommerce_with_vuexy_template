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
                            <h2 class="content-header-title float-left mb-0">Banner</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Banners</a>
                                    </li>
                                    <li class="breadcrumb-item active"><a href="#">Update Banner</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                @include('admin.partials.view-all-include',['route' =>'admin.banners.index'])
            </div>
            <div class="content-body">
                <!-- Basic Vertical form layout section start -->
                <section id="basic-vertical-layouts">
                    <div class="row match-height justify-content-md-center">
                        {{-- <div class="col-md-2 col-6"></div> --}}
                        <div class="col-md-8 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Update Banner</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form action="{{route('admin.banners.update',$banner->id)}}"
                                              class="form form-vertical" method="POST" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            @method('put')
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="name-vertical">Banner Title</label>
                                                            <input type="text" id="name-vertical" class="form-control"
                                                                   name="name" placeholder="Banner Title"
                                                                   value="{{$banner->name}}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="name-vertical">Banner Type</label>
                                                            <select class="form-control" name="position" id="slug"
                                                                    required>
                                                                @foreach (get_banner_type() as $type)
                                                                    <option value="{{$type}}" {{$banner->position==$type ? 'selected' : ''}}>{{$type}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="Image-vertical">Banner Image</label>
                                                            <input type="file" id="image" class="form-control"
                                                                   name="image" placeholder="image"/>
                                                            <img class="form-group"
                                                                 src="{!! map_storage_path_to_link($banner->image) !!}"
                                                                 style="zoom: 0.5;width:300px;height:auto;object-fit:contain">
                                                            {{-- <img  class="form-group" src="{!! map_storage_path_to_link($banner->image) !!}" style="zoom: 0.5;"> --}}
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="name-vertical">Weight</label>
                                                            <input type="number" id="Weight-vertical"
                                                                   class="form-control" name="weight"
                                                                   placeholder="Banner Weight"
                                                                   value="{{$banner->weight}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="name-vertical">Banner Link</label>
                                                            <input type="text" id="link-vertical" class="form-control"
                                                                   name="link" placeholder="Banner Link"
                                                                   value="{{$banner->link}}">
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
