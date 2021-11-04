@extends('admin.layouts.app')
@section('css')

    <!-- Begin: Vendor CSS-->

    <link rel="stylesheet" type="text/css"
          href="{{ asset('backend/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('backend/app-assets/vendors/css/file-uploaders/dropzone.min.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('backend/app-assets/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css')}}">
    <!-- END: Vendor CSS-->

    {{-- page css --}}
    <link rel="stylesheet" type="text/css"
          href="{{ asset('backend/app-assets/css/plugins/file-uploaders/dropzone.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/css/pages/data-list-view.css')}}">
@endsection

@section('js')

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('backend/app-assets/vendors/js/extensions/dropzone.min.js')}}"></script>
    <script src="{{ asset('backend/app-assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
    <script src="{{ asset('backend/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js')}}"></script>
    <script src="{{ asset('backend/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('backend/app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js')}}"></script>
    <script src="{{ asset('backend/app-assets/vendors/js/tables/datatable/dataTables.select.min.js')}}"></script>
    <script src="{{ asset('backend/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js')}}"></script>
    <!-- END: Page Vendor JS-->


    <!-- BEGIN: Page JS-->
    <script src="{{ asset('backend/app-assets/js/scripts/ui/custom-data-list-view.js') }}"></script>
    <script src="{{ asset('backend/app-assets/js/scripts/modal/components-modal.js') }}"></script>
    <!-- END: Page JS-->

    <script src="https://cdn.ckeditor.com/ckeditor5/29.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor.create(document.querySelector('#ck-editor1'))
            .catch(error => {
                console.error(error);
            });

        ClassicEditor.create(document.querySelector('#ck-editor2'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor.create(document.querySelector('#ck-editor3'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor.create(document.querySelector('#ck-editor4'))
            .catch(error => {
                console.error(error);
            });
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
                            <h2 class="content-header-title float-left mb-0">Policy Page</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a>
                                    </li>
                                    {{-- <li class="breadcrumb-item"><a href="#">Pages</a>
                                    </li> --}}
                                    <li class="breadcrumb-item active"> Policy Page Settings
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrum-right">
                        <div class="dropdown">
                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-settings"></i></button>
                            <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Chat</a><a class="dropdown-item" href="#">Email</a><a class="dropdown-item" href="#">Calendar</a></div>
                        </div>
                    </div>
                </div> --}}
            </div>
            <div class="content-body">
                <section id="page-general-settings">
                    <div class="row">
                        <!-- left menu section -->
                        <div class="col-md-3 mb-2 mb-md-0">
                            <ul class="nav nav-pills flex-column mt-md-0 mt-1">
                                <li class="nav-item">
                                    <a class="nav-link d-flex py-75 active" id="general-pill-return-policy"
                                       data-toggle="pill" href="#general-vertical-return-policy" aria-expanded="true">
                                        <i class="feather icon-globe mr-50 font-medium-3"></i>
                                        Return Policy
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex py-75 " id="general-pill-support-policy"
                                       data-toggle="pill" href="#general-vertical-support-policy" aria-expanded="true">
                                        <i class="feather icon-globe mr-50 font-medium-3"></i>
                                        support-policy
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex py-75" id="general-pill-privacy-policy" data-toggle="pill"
                                       href="#general-vertical-privacy-policy" aria-expanded="false">
                                        <i class="feather icon-globe mr-50 font-medium-3"></i>
                                        privacy-policy
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex py-75" id="general-pill-terms-condition"
                                       data-toggle="pill" href="#general-vertical-terms-condition"
                                       aria-expanded="false">
                                        <i class="feather icon-globe mr-50 font-medium-3"></i>
                                        Terms & Conditions
                                    </a>
                                </li>

                            </ul>
                        </div>
                        <!-- right content section -->
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active"
                                                 id="general-vertical-return-policy"
                                                 aria-labelledby="general-pill-return-policy" aria-expanded="true">
                                                <h3>Return Policy</h3>
                                                {!! Form::open(['route' => 'admin.system-settings.update','files' => true,'class' => 'dashboardForm']) !!}
                                                {{csrf_field()}}
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label class="return_policy">Return Policy <span
                                                                        style="color:red">*</span></label>
                                                            <textarea type="text" class="form-control"
                                                                      name="return_policy" id="ck-editor1"
                                                                      placeholder="write policy content for return order"
                                                                      value="{!!get_meta_by_key('return_policy')!!}">{!!get_meta_by_key('return_policy')!!}</textarea>
                                                            @error($errors)
                                                            <span class="err-msg"
                                                                  style="color:red">{{$errors->first('return_policy')}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="submit">
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                                </form>
                                            </div>
                                            <div role="tabpanel" class="tab-pane " id="general-vertical-support-policy"
                                                 aria-labelledby="general-pill-support-policy" aria-expanded="true">
                                                <h3>Support Policy</h3>
                                                {!! Form::open(['route' => 'admin.system-settings.update','files' => true,'class' => 'dashboardForm']) !!}
                                                {{csrf_field()}}
                                                <div class="row">
                                                    <div class="col-12">

                                                        <div class="form-group">
                                                            <label class="support_policy">Support Policy<span
                                                                        style="color:red">*</span></label>
                                                            <textarea type="text" class="form-control"
                                                                      name="support_policy" id="ck-editor2" rows="5"
                                                                      placeholder="write some content for support policy"
                                                                      aria-expanded="true">{!! get_meta_by_key('support_policy')!!}</textarea>
                                                            @error($errors)
                                                            <span class="err-msg"
                                                                  style="color:red">{{$errors->first('support_policy')}}</span>
                                                            @enderror
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="submit">
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                                </form>
                                            </div>
                                            <div class="tab-pane fade " id="general-vertical-privacy-policy"
                                                 role="tabpanel" aria-labelledby="general-pill-privacy-policy"
                                                 aria-expanded="false">
                                                <h3>Privacy Policy</h3>
                                                {!! Form::open(['route' => 'admin.system-settings.update','files' => true,'class' => 'dashboardForm']) !!}
                                                {{csrf_field()}}
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label class="privacy_policy">Privacy Poilicy<span
                                                                        style="color:red">*</span></label>
                                                            <textarea type="text" class="form-control"
                                                                      name="privacy_policy" id="ck-editor3"
                                                                      placeholder="write policy content for Privacy"
                                                                      value="{!!get_meta_by_key('privacy_policy')!!}">{!!get_meta_by_key('privacy_policy')!!}</textarea>
                                                            @error($errors)
                                                            <span class="err-msg"
                                                                  style="color:red">{{$errors->first('privacy_policy')}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="submit">
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                                </form>
                                            </div>
                                            <div class="tab-pane fade" id="general-vertical-terms-condition"
                                                 role="tabpanel" aria-labelledby="general-pill-terms-condition"
                                                 aria-expanded="false">
                                                <h3>Terms & Conditions</h3>
                                                {!! Form::open(['route' => 'admin.system-settings.update','files' => true,'class' => 'dashboardForm']) !!}
                                                {{csrf_field()}}
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label class="terms_and_condition">Terms & Conditions<span
                                                                        style="color:red">*</span></label>
                                                            <textarea type="text" class="form-control"
                                                                      name="terms_and_condition" id="ck-editor4"
                                                                      placeholder="write policy content for Terms & condition"
                                                                      value="{!!get_meta_by_key('terms_and_condition')!!}">{!!get_meta_by_key('terms_and_condition')!!}</textarea>
                                                            @error($errors)
                                                            <span class="err-msg"
                                                                  style="color:red">{{$errors->first('terms_and_condition')}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="submit">
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </section>

            </div>
        </div>
    </div>
    <!-- END: Content-->

@endsection
