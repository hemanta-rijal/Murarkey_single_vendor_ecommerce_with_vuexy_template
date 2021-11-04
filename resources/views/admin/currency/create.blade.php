@extends('admin.layouts.app')
@section('css')

    <link rel="stylesheet" type="text/css"
          href="{{ asset('backend/app-assets/css/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/tagin-master/dist/css/tagin.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('backend/app-assets/vendors/css/pickers/pickadate/pickadate.css') }}">
@endsection

@section('js')

    <script src="{{ asset('backend/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js') }}"></script>
    <script src="{{ asset('backend/app-assets/js/scripts/forms/validation/form-validation.js') }}"></script>

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
                            <h2 class="content-header-title float-left mb-0">Currency</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Currency</a>
                                    </li>
                                    <li class="breadcrumb-item active"><a href="#">Add New currency</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                @include('admin.partials.view-all-include',['route' =>'admin.currencies.index'])
            </div>
            <div class="content-body">
                <!-- Basic Vertical form layout section start -->
                <section id="basic-vertical-layouts">
                    <div class="row match-height justify-content-md-center">
                        <div class="col-md-10  col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Create New Currency</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form action="{{ route('admin.currencies.store') }}" class="form form-vertical"
                                              method="POST" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <div class="card">
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <label for="name-vertical">Currency Name<span
                                                                            class="text-danger">*</span></label>
                                                                <input type="text" class="form-control"
                                                                       name="currency_name" placeholder="currency Name"
                                                                       id="currencyField" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <label for="name-vertical">Short Name<span
                                                                            class="text-danger">*</span></label>
                                                                <input type="text" class="form-control"
                                                                       name="short_name"
                                                                       placeholder="currency short name(usd, nrs, aud ...etc)"
                                                                       id="currencyField" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <label for="name-vertical">Currency Icon<span
                                                                            class="text-danger">*</span></label>
                                                                <input type="file" class="form-control" name="icon"
                                                                       placeholder="currency icon or flag signs"
                                                                       id="currencyField" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <label for="name-vertical">Currency Rate<span
                                                                            class="text-danger">*</span><span
                                                                            style="color: royalblue"> * reference on NRS base *</span></label>
                                                                <div class="row">
                                                                    <div class="col-1">
                                                                    </div>
                                                                    <input type="text" class="form-control col-5"
                                                                           placeholder="currency rate"
                                                                           id="currencyField" readonly value="1 NRS =">
                                                                    <input type="text" class="form-control col-5"
                                                                           name="rate" placeholder="currency rate"
                                                                           id="currencyField" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <label for="name-vertical">Symbol<span
                                                                            class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" name="symbol"
                                                                       placeholder="currency symbol" id="currencyField"
                                                                       required>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <label for="name-vertical">Symbol Placement<span
                                                                            class="text-danger">*</span></label>
                                                                <select name="symbol_placement" class="form-control"
                                                                        id="symbol_placement"
                                                                        placeholder="currency symbol placement"
                                                                        required>
                                                                    <option value="front">Front Of Amount</option>
                                                                    <option value="back">Back Of Amount</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" value="submit" class="btn btn-primary mr-1 mb-1">
                                                    Submit
                                                </button>
                                                <button type="reset" class="btn btn-outline-warning mr-1 mb-1">Reset
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>


                <!-- // Basic Vertical form layout section end -->
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
