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

    <script src=" {{ asset('backend/app-assets/vendors/js/pickers/pickadate/picker.js') }}"></script>
    <script src=" {{ asset('backend/app-assets/vendors/js/pickers/pickadate/picker.date.js') }}"></script>
    <script src=" {{ asset('backend/app-assets/vendors/js/pickers/pickadate/picker.time.js') }}"></script>
    <script src=" {{ asset('backend/app-assets/vendors/js/pickers/pickadate/legacy.js') }}"></script>
    <script src="{{ asset('backend/app-assets/js/scripts/pickers/dateTime/pick-a-datetime.js') }}"></script>

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
                            <h2 class="content-header-title float-left mb-0">Flash Sale</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Flash Sale</a>
                                    </li>
                                    <li class="breadcrumb-item active"><a href="#">Add New Sale</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                @include('admin.partials.view-all-include',['route' =>'admin.flash-sales.index'])
            </div>
            <div class="content-body">
                <!-- Basic Vertical form layout section start -->
                <section id="basic-vertical-layouts">
                    <div class="row match-height justify-content-md-center">
                        {{-- <div class="col-md-2 col-6"></div> --}}
                        <div class="col-md-8  col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Create New Sale</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="row m-0">
                                            <form action="{{ route('admin.flash-sales.store') }}"
                                                  class="form form-vertical" method="POST"
                                                  enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                <div class="card">
                                                    <div class="form-body">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="name-vertical">Flash Sale Title <span
                                                                                class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control" name="title"
                                                                           placeholder="Flash Sale Title" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="start_time-vertical">Start Time<span
                                                                                class="text-danger">*</span></label>
                                                                    <input type="text" id="start_time-vertical"
                                                                           class="form-control pickadate"
                                                                           name="start_time"
                                                                           placeholder="Flash Sale Start Time" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="wend_timet-vertical">End Time<span
                                                                                class="text-danger">*</span></label>
                                                                    <input type="text" id="end_time-vertical"
                                                                           class="form-control pickadate"
                                                                           name="end_time"
                                                                           placeholder="Flash Sale End Time" required>
                                                                </div>
                                                            </div>
                                                            {{-- <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label for="wend_timet-vertical">Publish Flash Sale</label>
                                                                         <div class=" custom-control custom-switch switch-lg custom-switch-success mr-2 mb-1">
                                                                            <input type="checkbox" name="published" class="custom-control-input" id="customSwitch100" >
                                                                            <label class="custom-control-label" for="customSwitch100">
                                                                                <span class="switch-text-left">Publish</span>
                                                                                <span class="switch-text-right">Un-Publish</span>
                                                                            </label>
                                                                         </div>
                                                                    </div>
                                                                </div> --}}


                                                        </div>
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
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            {{-- <!-- Add rows table -->
            <section id="add-row">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add rows</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <p class="card-text">New rows can be added to a DataTable very easily using the ( row.add() ) API method. Simply call the API function with the data that is to be used for the new row (be it an array or object). Multiple rows can be added using the ( rows.add() ) method (note the plural). Data can be likewise be updated with the ( row().data() and row().remove() methods. )
                                    </p>
                                    <button id="addRow" class="btn btn-primary mb-2"><i class="feather icon-plus"></i>&nbsp; Add new row</button>
                                    <div class="table-responsive">
                                        <table class="table add-rows">
                                            <thead>
                                                <tr>
                                                    <th>Column 1</th>
                                                    <th>Column 2</th>
                                                    <th>Column 3</th>
                                                    <th>Column 4</th>
                                                    <th>Column 5</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th>1.1</th>
                                                    <th>1.2</th>
                                                    <th>1.3</th>
                                                    <th>1.4</th>
                                                    <th>1.5</th>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Column 1</th>
                                                    <th>Column 2</th>
                                                    <th>Column 3</th>
                                                    <th>Column 4</th>
                                                    <th>Column 5</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <!--/ Add rows table --> --}}

            <!-- Modal -->
                <div class="modal fade text-left" id="large" tabindex="-1" role="dialog"
                     aria-labelledby="myModalLabel17" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel17">Large Modal</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Add rows table -->
                                {{-- <section id="add-row"> --}}
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Add rows</h4>
                                            </div>
                                            <div class="card-content">
                                                <div class="card-body">
                                                    <p class="card-text">
                                                        card txt here
                                                    </p>
                                                    <button id="addRow" class="btn btn-primary mb-2"><i
                                                                class="feather icon-plus"></i>&nbsp; Add new row
                                                    </button>
                                                    <div class="col-12">
                                                        <div class="card">

                                                            <div class="form-group col-2"><label for="name-vertical">Product
                                                                    Name</label></div>
                                                            <div class="form-group col-2"><label for="name-vertical">Actual
                                                                    Price</label></div>
                                                            <div class="form-group col-2"><label for="name-vertical">Discount
                                                                    type</label></div>
                                                            <div class="form-group col-2"><label for="name-vertical">Discount</label>
                                                            </div>
                                                            <div class="form-group col-2"><label for="name-vertical">Discounted
                                                                    Price</label></div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-2">
                                                                <input type="text" class="form-control"
                                                                       name="flash-sale" placeholder="Flash Sale Title"
                                                                       required>
                                                            </div>
                                                            <div class="form-group col-2">
                                                                <input type="text" class="form-control"
                                                                       name="flash-sale" placeholder="Flash Sale Title"
                                                                       required>
                                                            </div>
                                                            <div class="form-group col-2">
                                                                <input type="text" class="form-control"
                                                                       name="flash-sale" placeholder="Flash Sale Title"
                                                                       required>
                                                            </div>
                                                            <div class="form-group col-2">
                                                                <input type="text" class="form-control"
                                                                       name="flash-sale" placeholder="Flash Sale Title"
                                                                       required>
                                                            </div>
                                                            <div class="form-group col-2">
                                                                <input type="text" class="form-control"
                                                                       name="flash-sale" placeholder="Flash Sale Title"
                                                                       required>
                                                            </div>

                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            {{-- </section> --}}
                            <!--/ Add rows table -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Accept</button>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Search and Add Product</h4>
                            </div>
                            <div class="modal-body">
                                <div class="input-group input-group-sm">
                                    <input id="search-input-field" type="text" name="search"
                                           class="form-control no_border_radius" placeholder="Keyword"
                                           value="{{ request()->search }}"
                                           onkeypress="if(event.keyCode == 13) {getSearchResult()}">
                                    <span class="input-group-btn">
										<button class="btn btn-default" onclick="getSearchResult()"><i
                                                    class="fa fa-search"></i></button>
									</span>
                                </div>
                                <div id="no-result-found" style="display:none;">
                                    <div class="alert alert-info">
                                        Please try other keywords, No search result found!
                                    </div>
                                </div>
                                <table class="table table-stripped">
                                    <thead>
                                    <th>Product Name</th>
                                    <th>Action</th>
                                    </thead>
                                    <tbody id="search-result-table-body">

                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- // Basic Vertical form layout section end -->
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
