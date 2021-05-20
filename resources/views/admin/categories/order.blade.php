@extends('admin.layouts.app')
@section('css')

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/backend/app-assets/vendors/css/extensions/dragula.min.css')}}">
    <!-- END: Vendor CSS-->


    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/backend/app-assets/css/plugins/extensions/drag-and-drop.css')}}">
    <!-- END: Page CSS-->

@endsection

@section('js')


    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('/backend/app-assets/vendors/js/extensions/dragula.min.js')}}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('/backend/app-assets/js/scripts/extensions/drag-drop.js')}}"></script>
    <!-- END: Page JS-->

    
@endsection



@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            {{-- //alert previous code --}}
            <div id="error-div" class="alert alert-success" role="alert" style="display:none;">Oops! Something went wrong</div>

            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Drag &amp; Drop</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Extensions</a>
                                    </li>
                                    <li class="breadcrumb-item active">Drag &amp; Drop
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
                <!-- Sortable lists section start -->
                    <section id="sortable-lists">
                        <div class="row">
                            <!-- Basic List Group -->
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Basic List Group Sortable</h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body">
                                            <p> The most basic list group is simply an unordered list with list items, and the proper
                                                classes.</p>

                                            <ol class="list-group class="sortable"" id="basic-list-group">
                                                {{-- <li class="list-group-item">
                                                    <div class="media">
                                                        <img src="{{ asset('/backend/app-assets/images/portrait/small/avatar-s-12.jpg')}}" class="rounded-circle mr-2" alt="img-placeholder" height="50" width="50">
                                                        <div class="media-body">
                                                            <h5 class="mt-0">Mary S. Navarre</h5>
                                                            Chupa chups tiramisu apple pie biscuit sweet roll bonbon macaroon toffee icing.
                                                        </div>
                                                    </div>
                                                </li> --}}
                                                @php
                                                     generateNestedTree($tree)
                                                @endphp
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </section>
                <!-- // Sortable lists section end -->
                                
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
