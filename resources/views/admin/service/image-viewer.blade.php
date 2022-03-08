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

    <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/css/pages/app-user.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        function deleteImage(image) {
            if(confirm('are you sure you want to delete this image?')){
                var token = $("meta[name='csrf-token']").attr("content");
                $.ajax(
                    {
                        url: '{{URL::to("admin/services/image-manager/delete")}}',
                        type: 'DELETE',
                        data: {
                            "image": image,
                            "_method": 'DELETE',
                            "_token": token,
                        },
                        success: function (data){
                            if(data.status){
                                alert('image deleted successfully');
                                window.location.reload();
                            }else{
                                alert('image cannot be deleted');
                            }
                        }
                    });
            }
        }
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
            </div>
            <div class="content-body">
                <!-- page users view start -->
                <section class="page-users-view">
                    <div class="row">
                        <!-- account start -->
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Images of <span style="font-weight: 900"> {!! $service->name !!}</span>
                                        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addImage">Add Image</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card-deck-wrapper">
                                                <div class="card-deck">
                                                    @isset($service->images)
                                                        @foreach($service->images as $image)
                                                            <div class="card mb-3" style="max-width: 300px;">
                                                                <div class="row no-gutters">
                                                                    <div class="col-md-9">
                                                                        <img data-value="{{$image->image}}" src="{{ resize_image_url($image->image, '200X200') }}" class="card-img" alt="...">
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="card-body">
                                                                            <button class="btn btn-sm btn-danger" onclick="deleteImage('{{$image->image}}')">Delete</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endisset
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- account end -->


                    </div>
                </section>
                <!-- page users view end -->

            </div>
        </div>
    </div>
    <!-- END: Content-->

    <!-- Modal -->
    <div class="modal fade text-left" id="addImage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Upload Image </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('admin.services.image.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="product_id" value="{{$service->id}}">
                    <div class="modal-body">
                        <label>Image: </label>
                        <div class="form-group">
                            <input type="file" placeholder="Password" name="images[]" multiple class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

