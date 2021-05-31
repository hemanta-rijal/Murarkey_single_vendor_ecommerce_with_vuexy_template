@extends('admin.layouts.app')

@section('css')

    <!-- Begin: Vendor CSS-->
    
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/vendors/css/file-uploaders/dropzone.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/backend/app-assets/vendors/css/extensions/dragula.min.css')}}">
    <!-- END: Vendor CSS-->
    
    {{-- page css --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('/backend/app-assets/css/plugins/extensions/drag-and-drop.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/css/plugins/file-uploaders/dropzone.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/css/pages/data-list-view.css')}}">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
<script src="{{ asset('/backend/app-assets/vendors/js/extensions/dragula.min.js')}}"></script>
<!-- END: Page Vendor JS-->


<!-- BEGIN: Page JS-->

    <script src="{{ asset('/backend/app-assets/js/scripts/extensions/drag-drop.js')}}"></script>
<script src="{{ asset('backend/app-assets/js/scripts/ui/data-list-view.js') }}"></script>
<script src="{{ asset('backend/app-assets/js/scripts/modal/components-modal.js') }}"></script>
<!-- END: Page JS-->

{{-- <script type="text/javascript">
    $(document).ready(function () {
        $('.sortable').on('click', function(e){
            alert('here');
            let orders={};
            $('.list-group-item').each(function(){
                orders[$('sortable').data('id')]=$(this).index();
            });
            alert(orders);
        });
    });
</script> --}}

  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript">
  $(document).ready(function () {
    //    alert('herer')
       $('#sortUpdate').on('click', function(e){
        var orders = [];

        $(".list-group-item").each(function( index ) {
            orders[$(this).data('id')] = $(this).index();
        });

           $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': '{{ Session::token() }}'}
            });
            $.ajax({
                url: '{{ url('/admin/flash-sales/update-order') }}',
                type: 'POST',
                data: {
                    "order":orders,
                    "_method": 'POST',
                },
                success: function (data) {
                    console.log(data);
                    if (data['success']) {
                        alert(data['success']);
                        // window.location= '{{route('admin.flash-sales.index')}}'
                    } else if (data['error']) {
                        alert(data['error']);
                    } else {
                        alert('Whoops Something went wrong!!');
                    }
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });
          
    // });
       })
    $('.sortable-list').sortable({
      connectWith: ".connectedSortable",
    //   opacity: 0.5,
    });
    // $( ".connectedSortable" ).on( "sortupdate", function( event, ui ) {
    //     var orders = [];

    //     $(".sortable").each(function( index ) {
    //       orders[index] = $(this).attr('data-id');
    //     });
    //     console.log(orders)
    //     //    $.ajaxSetup({
    //     //         headers: {'X-CSRF-TOKEN': '{{ Session::token() }}'}
    //     //     });
    //     //     $.ajax({
    //     //         url: '{{ url('/admin/categories/bulk-delete') }}',
    //     //         type: 'POST',
    //     //         data: {
    //     //             "ids":join_selected_values,
    //     //             "_method": 'POST',
    //     //         },
    //     //         success: function (data) {
    //     //             if (data['success']) {
    //     //                 window.location= '{{route('admin.categories.index')}}'
    //     //             } else if (data['error']) {
    //     //                 alert(data['error']);
    //     //             } else {
    //     //                 alert('Whoops Something went wrong!!');
    //     //             }
    //     //         },
    //     //         error: function (data) {
    //     //             alert(data.responseText);
    //     //         }
    //     //     });
          
    // });
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
                        <h2 class="content-header-title float-left mb-0">Flash Sale View</h2>
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dahboard</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Index</a>
                                </li>
                                <li class="breadcrumb-item active">Flash Sale
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
                                    <h4 class="card-title">Flash-Sale Sortable List</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <p>Every entry of flash-sales can be drag and drop to sort their order at this page. You can simply drag and drop to the list and ger sorted order of list according to the priority.</p>
                                        <ul class="list-group sortable-list" id="basic-list-group">
                                            @foreach ($flashSales as $flashSale)
                                            <li class="list-group-item sortable" data-id="{{$flashSale->id}}">
                                                <div class="media">
                                                     <div class="media-body">
                                                         <div class="row " >
                                                             <div class="col-4">
                                                                   <h5 class="mt-0">{!! $flashSale->title !!}</h5>
                                                             </div>
                                                             <div class="col-2">
                                                                   <h5 class="mt-0">{{ $flashSale->start_time->format('Y-M, d') }}</h5>
                                                             </div>
                                                             <div class="col-2">
                                                                   <h5 class="mt-0">{{ $flashSale->end_time->format('Y-M, d') }}</h5>
                                                             </div>
                                                             <div class="col-2">
                                                                 <h5 class="mt-0">
                                                                     <span class="btn-sm btn-{{ $flashSale->published ? 'primary' :  'warning'  }}">
                                                                        {{$flashSale->published ? 'Published' :  'Un-Published'  }} 
                                                                    </span>
                                                                </h5>
                                                            </div>
                                                            <div class="col-2">
                                                                <h5 class="mt-0">
                                                                    <a href="{!! route('admin.flash-sales.edit', $flashSale->id) !!}" >
                                                                        <i class="feather icon-edit"></i>
                                                                    </a>
                                                                        <a href="#" class="">
                                                                            <i class="feather icon-trash"></i>
                                                                        </a>
                                                                </h5>
                                                            </div>
                                                         </div>
                                                     </div>
                                                </div>
                                            </li>
                                            @endforeach

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                    

                    <div class="col-12">
                        <button id="sortUpdate" type="button" class="btn btn-warning mr-1 mb-1 waves-effect waves-light float-right">Update Order</button>
                    </div>
</div>
                </section>
                <!-- // Sortable lists section end -->

        </div>
    </div>
</div>
<!-- END: Content-->

@endsection
