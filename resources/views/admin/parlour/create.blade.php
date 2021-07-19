@extends('admin.layouts.app')
@section('css')

<link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/css/plugins/forms/validation/form-validation.css') }}">
    @endsection

    @section('js')

    <script src="{{ asset('backend/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js') }}"></script>
    <script src="{{ asset('backend/app-assets/js/scripts/forms/validation/form-validation.js')}}"></script>
     <script src="https://cdn.ckeditor.com/ckeditor5/29.0.0/classic/ckeditor.js"></script>
    <script src="{{ asset('backend/custom/customfuncitons.js') }}"></script>
     <script>
     ClassicEditor.create( document.querySelector( '#ck-editor1' ) )
        .catch( error => {
            console.error( error );
        });
        document.getElementById('ck-editor1').removeAttribute('required');
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
                        <h2 class="content-header-title float-left mb-0">List A New Parlour</h2>
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Parlour Listing</a>
                                </li>
                                <li class="breadcrumb-item active"><a href="#">Add A New Parlour</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
           @include('admin.partials.view-all-include',['route' =>'admin.parlour-listing.index'])
        </div>
        <div class="content-body">
            <!-- Basic Vertical form layout section start -->
            <section id="basic-vertical-layouts">
                <div class="row match-height justify-content-md-center">
                    {{-- <div class="col-md-2 col-6"></div> --}}
                    <div class="col-md-8  col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Create New Parlour</h4>
                            </div>
                            <hr>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row m-0">
                                        <form action="{{route('admin.parlour-listing.store')}}" class="form form-vertical" method="POST" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                                <div class="card">
                                                    <div class="form-body">
                                                        <div class="row">
                                                            
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="name-vertical">Name</label>
                                                                    <input type="text" id="name-vertical" class="form-control" name="name" placeholder="Parlour Name" required onkeyup="setSlug(this.value)">
                                                                </div>
                                                                {{-- @error($errors)
                                                                    <span class="err-msg" style="color:red">{{$errors->first('name')}}</span>               
                                                                @enderror --}}
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="address-vertical">Slug</label>
                                                                    <input type="text" id="slug" class="form-control" name="slug" placeholder="Slug" required readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="address-vertical">Address</label>
                                                                    <input type="text" id="address-vertical" class="form-control" name="address" placeholder="Parlour Address" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="icon-info-vertical">Feature Image</label>
                                                                    <input type="file" id="icon-info-vertical" class="form-control" name="feature_image" placeholder="Feature Image" required/>
                                                                </div>
                                                            </div>
                                                       
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="price-vertical">Featured Status</label>
                                                                    <div class="form-control custom-switch custom-control-inline">
                                                                        <input class="form-check-input" name="featured" type="hidden" id="featured" value="0">
                                                                        <input class="custom-control-input" name="featured" type="checkbox" id="customSwitch1" value="1">
                                                                        <label class="custom-control-label" for="customSwitch1">
                                                                        </label>
                                                                        <span class="switch-label">Put this parlour as featured </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="price-vertical">Parlour Status</label>
                                                                    <div class="form-control custom-switch custom-control-inline">
                                                                        <input class="form-check-input" name="status" type="hidden" id="status" value="0">
                                                                        <input class="custom-control-input" name="status" type="checkbox" id="customSwitch2" value="1">
                                                                        <label class="custom-control-label" for="customSwitch2">
                                                                        </label>
                                                                        <span class="switch-label">Put this parlour as active</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                            <hr>
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <h4 class="card-title">Other Info About Parlour</h4>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="name-vertical">Phone Contact</label>
                                                                    <input type="tel" id="phone-vertical" class="form-control" name="phone" placeholder="Phone Number" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="mobile-vertical">Mobile Contact</label>
                                                                    <input type="tel" id="mobile-vertical" class="form-control" name="mobile" placeholder="Mobile Number" >
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="email-vertical">Email</label>
                                                                    <input type="email" id="email-vertical" class="form-control" name="email" placeholder="Email Address" >
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="website-vertical">Website</label>
                                                                    <input type="text" id="website-vertical" class="form-control" name="website" placeholder="Website Link" >
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="Facebook-vertical">Facebook</label>
                                                                    <input type="text" id="Facebook-vertical" class="form-control" name="facebook" placeholder="Facebook Link" >
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="Twitter-vertical">Twitter</label>
                                                                    <input type="text" id="Twitter-vertical" class="form-control" name="twitter" placeholder="Twitter Link" >
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="Instagram-vertical">Instagram</label>
                                                                    <input type="text" id="Instagram-vertical" class="form-control" name="instagram" placeholder="Instagram Link" >
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="youtube-vertical">Youtube</label>
                                                                    <input type="text" id="youtube-vertical" class="form-control" name="youtube" placeholder="Youtube Link" >
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                            <hr>
                                                                <div class="card">
                                                                    <div class="card-header">
                                                                        <h4 class="card-title">Description About Parlour</h4>
                                                                    </div>
                                                                </div>
                                                            <hr>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="Description-id-vertical">Description</label>
                                                                    <textarea type="text"  id="ck-editor1" class="form-control ck-editor__editable_inline" name="about" placeholder="Description about parlour" rows="5" ></textarea>
                                                                </div>
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
