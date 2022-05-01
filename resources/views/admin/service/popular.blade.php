@extends('admin.layouts.app')
@section('css')
    <link rel="stylesheet" type="text/css"
          href="{{URL::asset('backend/app-assets/vendors/css/extensions/dragula.min.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{URL::asset('backend/app-assets/css/plugins/extensions/drag-and-drop.css')}}">
@endsection
@section('js')
    <!-- BEGIN: Page Vendor JS-->
    <script src="{{URL::asset('backend/app-assets/vendors/js/extensions/dragula.min.js')}}"></script>
    <!-- END: Page Vendor JS-->
    <!-- BEGIN: Page JS-->
    <script>
        $(document).ready(function () {
            // Sortable Lists
            var drake = dragula([document.getElementById('basic-list-group')]);
            drake.on('dragend', function (el) {
                console.log(this.containers[0])
            })
        });

        function updateOrder() {
            let order = document.getElementsByClassName('list-group-item');
            console.log(order)
        }

    </script>
    <!-- END: Page JS-->
@endsection
@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <!-- Sortable lists section start -->
            <section id="sortable-lists">
                <div class="row">
                    <!-- Basic List Group -->
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Popular Services</h4>
                            </div>
                            <div class="card-content">
                                <form action="{{route('admin.services.popular.update')}}" method="post">
                                    @csrf
                                    <div class="card-body">
                                        <p> Please Drag and Drop the services and click on update for ordering.</p>
                                        <ul class="list-group" id="basic-list-group">
                                            @foreach($services as $service)
                                                <li class="list-group-item" data-id="{{$service->id}}">
                                                    <input type="hidden" name="service_id[]" value="{{$service->id}}">
                                                    <div class="media">
                                                        <img src="{{resize_image_url($service->featured_image, '50X50')}}"
                                                             class="rounded-circle mr-2" alt="img-placeholder"
                                                             height="50"
                                                             width="50">
                                                        <div class="media-body">
                                                            <h5 class="mt-0">{{$service->title}}</h5>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <br>
{{--                                        <a href="#" onclick="updateOrder()">Update Order</a>--}}
                                                                                <input type="submit" class="btn btn-success" value="Update">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </section>
            <!-- // Sortable lists section end -->
        </div>
    </div>
@endsection