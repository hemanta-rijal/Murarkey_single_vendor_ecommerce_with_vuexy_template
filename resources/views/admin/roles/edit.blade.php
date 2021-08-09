@extends('admin.layouts.app')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/css/plugins/forms/validation/form-validation.css') }}">
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
                        <h2 class="content-header-title float-left mb-0">Role</h2>
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Roles</a>
                                </li>
                                <li class="breadcrumb-item active"><a href="#">Update Role</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            @include('admin.partials.view-all-include',['route' =>'admin.roles.index'])
        </div>
        <div class="content-body">
            <!-- Basic Vertical form layout section start -->
            <section id="basic-vertical-layouts">
                <div class="row match-height justify-content-md-center">
                    {{-- <div class="col-md-2 col-6"></div> --}}
                    <div class="col-md-10 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Update Role</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <form action="{{route('admin.roles.update',$role->id)}}" class="form form-vertical" method="POST" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        @method('put')
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="name-vertical">Role Title</label>
                                                        <input type="text" id="name-vertical" class="form-control" name="name" placeholder="Role Title" value="{{$role->name}}" required>
                                                    </div>
                                                </div>

                                                 <div class="col-12">
                                                    <div class="table-responsive border rounded px-1 ">
                                                        <h6 class="border-bottom py-1 mx-1 mb-0 font-medium-2"><i class="feather icon-lock mr-50 "></i>Assign Permissions</h6>
                                                            <div class="row">
                                                                @php
                                                                    $switch_count =0;
                                                                @endphp
                                                                @foreach ($permission_groups as $group_name=>$groups)
                                                                <div class="col-md-6 col-sm-6">
                                                                    <div class="card"><a data-action="collapse">
                                                                        <div class="card-header">
                                                                            <h4 class="card-title">{{$group_name}} Permissions</h4>
                                                                            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                                                            <div class="heading-elements">
                                                                                <ul class="list-inline mb-0">
                                                                                    <li><a data-action="collapse"><i class="feather icon-chevron-down"></i></a></li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                    <div class="card-content collapse show">
                                                                        <div class="card-body">
                                                                            {{-- body --}}
                                                                            <table class="table table-borderless">
                                                                                {{-- <thead>
                                                                                    <tr>
                                                                                        <th>Module</th>
                                                                                        <th>Read</th>
                                                                                    </tr>
                                                                                </thead> --}}
                                                                                <tbody>
                                                                                            @foreach ($groups as $group)
                                                                                                <tr>
                                                                                                    <td>
                                                                                                        <div class="form-control custom-switch custom-control-inline">
                                                                                                            {{-- <input  name="{{$group->name}}" type="hidden"  value="{{false}}"> --}}
                                                                                                            {{-- {{ dd( Auth::guard('admin')->user()->can($group->slug) ) }} --}}
                                                                                                            {{-- @can($group->slug)
                                                                                                            {{dd("here we came")}}
                                                                                                            @endcan --}}
                                                                                                            <input class="custom-control-input" name="permissions[{{$group->slug}}]" type="checkbox" id="customSwitch{{$switch_count}}" value="{{true}}" {{ check_permission($group->slug) ? 'checked' : ''}} > 
                                                                                                            {{-- //{{get_theme_setting_by_key('first_ad_status')==="on" ? 'checked' : ''}} --}}
                                                                                                            <label class="custom-control-label" for="customSwitch{{$switch_count}}">
                                                                                                            </label>
                                                                                                            <span class="switch-label">{{$group->name}}</span>
                                                                                                        </div>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                @php
                                                                                                     $switch_count++;
                                                                                                @endphp
                                                                                            @endforeach
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                               
                                                              
                                                            </div>
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
