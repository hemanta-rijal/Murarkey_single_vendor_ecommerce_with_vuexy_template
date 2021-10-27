@extends('admin.layouts.app')
@section('css')

<link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/css/plugins/forms/validation/form-validation.css') }}">
    @endsection

    @section('js')

    <script src="{{ asset('backend/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js') }}"></script>
    <script src="{{ asset('backend/app-assets/js/scripts/forms/validation/form-validation.js')}}"></script>

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
                        <h2 class="content-header-title float-left mb-0">Import/Export Services</h2>
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Service Categories</a>
                                </li>
                                <li class="breadcrumb-item active"><a href="#">Improt/Export Service Categories From Excel</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            @include('admin.partials.view-all-include',['route' =>'admin.service-categories.index'])
        </div>
        <div class="content-body">
            <section id="basic-vertical-layouts">
                <div class="row match-height justify-content-md-center">
                    {{-- <div class="col-md-2 col-6"></div> --}}
                    <div class="col-md-8  col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Import/Export services</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <form action="{{ route('admin.service-categories.import') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="file" name="file" class="form-control" required />
                                        <br>
                                        <button class="btn btn-success" >Import Service Categories</button>
                                        <a class="btn btn-warning" href="{{ route('admin.service-categories.export') }}">Export Service Categories</a>
                                    </form>
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
