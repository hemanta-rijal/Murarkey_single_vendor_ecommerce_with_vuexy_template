@extends('admin.layouts.app')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/css/plugins/forms/validation/form-validation.css') }}">
 <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

 @endsection
 
 @section('js')
 <script src="{{ asset('backend/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js') }}"></script>
 <script src="{{ asset('backend/app-assets/js/scripts/forms/validation/form-validation.js')}}"></script>
 <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
 <script src="https://cdn.ckeditor.com/ckeditor5/29.0.0/classic/ckeditor.js"></script>
 <script src="{{ asset('backend/custom/customfuncitons.js')}}"></script>
  <script>
     ClassicEditor.create( document.querySelector( '#ck-editor1' ) )
        .catch( error => {
            console.error( error );
        });
</script>
  <script>
     ClassicEditor.create( document.querySelector( '#ck-editor2' ) )
        .catch( error => {
            console.error( error );
        });
</script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2({
            tags: "true",
            placeholder: "Select an option",
            allowClear: true
        });
    });

    $('.js-example-basic-multiple').on('change', function() {
        var selected =[];
    $(".js-example-basic-multiple option:selected").each(function(key,item){
          selected.push(item.text);
      });
      console.log(selected);
         $.post('{{ route('admin.get.service-label-field') }}',{_token:'{{ @csrf_token() }}', labels:selected}, function(data){
                $('#service-label-field').html(data);
            });

    })
    
</script>


    {{-- <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script> --}}
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
                        <h2 class="content-header-title float-left mb-0">Services</h2>
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Services</a>
                                </li>
                                <li class="breadcrumb-item active"><a href="#">Add New Service</a>
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
                    <div class="col-md-8 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Create New Service</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <form action="{{route('admin.services.store')}}" class="form form-vertical" method="POST" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="name-vertical">Service Title</label>
                                                        <input type="text" id="name-vertical" class="form-control" name="title" placeholder="Service Title" onkeyup="setSlug(this.value)" required />
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="name-vertical">Slug</label>
                                                        <input type="text" id="slug" class="form-control" name="slug" placeholder="Slug" required />
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="name-vertical">Service Duration</label>
                                                        <div class="row">
                                                            &nbsp;
                                                            &nbsp;
                                                            <input type="number" id="name-vertical" class="form-control col-3" name="min_duration" placeholder="Minimum Duration" required>
                                                            &nbsp;
                                                            <select name="min_duration_unit" id="min" class="form-control col-2">
                                                                <option value="min">Min</option>
                                                                <option value="hr">Hrs</option>
                                                            </select>
                                                          <div class="col-1"></div>
                                                            <input type="number" id="name-vertical" class="form-control col-3" name="max_duration" placeholder="Maximum Duration" required>
                                                            &nbsp;
                                                            &nbsp;
                                                            &nbsp;
                                                            <select name="max_duration_unit" id="max" class="form-control col-2">
                                                                <option value="min">Min</option>
                                                                <option value="hr">Hrs</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="Image-vertical">Icon Image</label>
                                                        <input type="file" id="Icon-Image" class="form-control" name="icon_image" placeholder="Icon Image" required />
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="Image-vertical">Feature Image</label>
                                                        <input type="file" id="Feature-Image" class="form-control" name="featured_image" placeholder="Feature Image" required/>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label for="Image-vertical">Service Charge</label>
                                                        <input type="number" id="image" class="form-control" name="service_charge" placeholder="Service Charge" required/>
                                                    </div>
                                                </div>
                                                 <div class="col-3">
                                                    <div class="form-group">
                                                        <label for="price-vertical">Popular</label>
                                                        <div class="form-control custom-switch custom-control-inline">
                                                            <input class="form-check-input" name="popular" type="hidden" id="popular" value="0">
                                                            <input class="custom-control-input" name="popular" type="checkbox" id="customSwitch1" value="1">
                                                            <label class="custom-control-label" for="customSwitch1">
                                                            </label>
                                                            <span class="switch-label"> popular? </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="Image-vertical">Service Category</label>
                                                         <select class="form-control " name=" category_id" id="category" required>
                                                                @foreach($service_categories as $category)
                                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                                @endforeach
                                                            </select>
                                                    </div>
                                                </div>
                                                
                                                 <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="unit-vertical">Service Labels</label>
                                                            <select class="form-control js-example-basic-multiple" name=" service_labels[]" id="serviceLabel" multiple="multiple" style="width: 100%">
                                                                @foreach(get_service_labels() as $label)
                                                                    <option value="{{Str::slug($label->value)}}" >{{$label->value}}</option>
                                                                @endforeach
                                                            </select>
                                                    </div>
                                                </div>

                                                <div id="service-label-field" class="col-12">

                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="Description-id-vertical">Short Description</label>
                                                        <textarea type="text" id="ck-editor1" class="form-control" name="short_description" placeholder="Short Description" rows="5"></textarea>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="Description-id-vertical">Full Description</label>
                                                        <textarea rows="8" type="text" id="ck-editor2" class="form-control" name="description" placeholder="Full Description" required></textarea>
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
