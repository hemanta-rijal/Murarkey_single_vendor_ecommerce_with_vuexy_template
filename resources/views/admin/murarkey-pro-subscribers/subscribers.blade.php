@extends('admin.layouts.app')
@section('css')

<!-- Begin: Vendor CSS-->
    
<link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/vendors/css/file-uploaders/dropzone.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css')}}">
<!-- END: Vendor CSS-->
    
    {{-- page css --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/css/plugins/file-uploaders/dropzone.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/css/pages/data-list-view.css')}}">

    <style>
        .paging_simple_numbers{
            display: none;
        }
        .dataTables_length{
            display: none;
        }
        </style>

<link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/vendors/css/editors/quill/katex.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/vendors/css/editors/quill/monokai-sublime.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/vendors/css/editors/quill/quill.snow.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/css/pages/app-email.css')}}">
<link rel="stylesheet" href="{{ asset('backend/tagin-master/dist/css/tagin.css') }}">
        
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
<script src="{{ asset('backend/app-assets/js/scripts/ui/data-list-view.js') }}"></script>
{{-- <script src="{{ asset('backend/app-assets/js/scripts/modal/components-modal.js') }}"></script> --}}
{{-- <script src="{{asset('backend/app-assets/js/scripts/datatables/datatable.js')}}"></script> --}}

    <script src="{{ asset('backend/app-assets/js/scripts/pages/app-email.js')}}"></script>
        <script src="{{ asset('backend/app-assets/vendors/js/editors/quill/katex.min.js')}}"></script>
    <script src="{{ asset('backend/app-assets/vendors/js/editors/quill/highlight.min.js')}}"></script>
    <script src="{{ asset('backend/app-assets/vendors/js/editors/quill/quill.min.js')}}"></script>
        <script src="{{ asset('backend/tagin-master/dist/js/tagin.js')}}"></script>
    <script>
        for (const el of document.querySelectorAll('.tagin')) {
        tagin(el)
        }
    </script>

    <script src="https://cdn.ckeditor.com/ckeditor5/29.0.0/classic/ckeditor.js"></script>
 <script src="{{ asset('backend/custom/customfuncitons.js')}}"></script>
 <script>
     ClassicEditor.create( document.querySelector( '#ck-editor1' ) )
        .catch( error => {
            console.error( error );
        });
</script>

    <script type="text/javascript">
        function sendMails(){
            var allVals = [];
            $(".selected").each(function() {
                allVals.push($(this).attr('data-id'));
            });
            
            console.log(allVals)
            var join_selected_values = allVals.join(",");
            if(allVals.length <=0)
            {
                alert("Please select row.");
            }  else {
                $('#composeForm').modal('toggle');

                $.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': '{{ Session::token() }}'}
                });

                $.ajax({
                type:"POST",
                data: {
                        "ids":allVals,
                        "_method": 'POST',
                    },
                url:'<?php echo e(route("admin.mail-all.modal")) ?>',
                success:function (data) {
                    // console.log()
                    console.log('data');
                    // var append = '<input type="text" id="user_names"  name="to[]" class="form-control tagin" value="'+data+'"  data-duplicate="false" disabled>'
                    // $('#to').html(append)
                    $('#details').val(data)
                }
                })
                
                // var check = confirm("Are you sure you want to delete bulk data?");
                // if(check == true){

                    
                //     console.log(allVals)
                //      $.ajaxSetup({
                //         headers: {'X-CSRF-TOKEN': '{{ Session::token() }}'}
                //     });

                //     $.ajax({
                //         url: '{{ url('/admin/users/bulk-delete') }}',
                //         type: 'POST',
                //         data: {
                //             "ids":join_selected_values,
                //             "_method": 'POST',
                //         },
                //         success: function (data) {
                //             if (data['success']) {
                //                 window.location= '{{route('admin.users.index')}}'
                //             } else if (data['error']) {
                //                 alert(data['error']);
                //             } else {
                //                 alert('Whoops Something went wrong!!');
                //             }
                //         },
                //         error: function (data) {
                //             alert(data.responseText);
                //         }
                //     });
                // }
            }
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
        @include('flash::message')
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Subscribers</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Murarkey Professional</a>
                                    </li>
                                    <li class="breadcrumb-item active">Subscription List
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block ">
                    <div class="form-group ">
                        <button  class=" btn-icon btn btn-primary btn-round btn-sm" onclick="sendMails()"
                         {{-- data-toggle="modal" data-target="#composeForm" --}}
                         ><i class="feather icon-envalope" ></i> Send Mails</button>
                        {{-- <a id="mail_all" href="#" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle"><i class="feather icon-envalope"></i> Send Mails</a> --}}
                        
                    </div>
                </div>
            </div>
            <section id="basic-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body card-dashboard">
                                    {{-- <p class="card-text">DataTables has most features enabled by default, so all you need to do to use it with your own ables is to call the construction function: $().DataTable();.</p> --}}
                                    <div class="table-responsive">
                                        <table class="table data-list-view ">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Full Name</th>
                                                    <th>Email</th>
                                                    <th>Phone Number</th>
                                                    <th>Viber Number</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                        @foreach ($subscribers  as $subscriber)
                                                            <tr data-id="{{$subscriber->id}}">
                                                                <td></td>
                                                                    {{-- <td class="dt-checkboxes-cell">
                                                                        <input type="checkbox" class="dt-checkboxes" id="select_{{$subscriber->id}}">
                                                                    </td> --}}
                                                                    <td class="product-name">{!! $subscriber->full_name !!}</td>
                                                                    <td class="product-name">{!! $subscriber->email !!}</td>
                                                                    <td class="product-name">{!! $subscriber->phone_number !!}</td>
                                                                    <td class="product-name">{!! $subscriber->viber_number !!}</td>
                                                                    {{-- <td><span class="btn-sm btn-{{ $subscriber->status=='subscribed' ? 'primary' :  'warning'  }}"> {{$subscriber->status=='subscribed' ? 'Subscribed' :  'Un-Subscribed'  }} </span></td> --}}
                                                                    <td class="product-action">
                                                                        <a href="{!! route('admin.join-murarkey.show', $subscriber->id) !!}" class=" mr-1 mb-1 waves-effect waves-light" >
                                                                            <i class="feather icon-eye"></i>
                                                                        </a>
                                                                    
                                                                        <a href="" class=" mr-1 mb-1 waves-effect waves-light">
                                                                            <i class="feather icon-mail"></i>
                                                                        </a>
                                                                        {{-- @include('admin.partials.modal', ['data' => $subscriber, 'name' => 'admin.subscribers.destroy']) --}}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                            </tbody>

                                        </table>
                                        <div class="d-flex">
                                            <div class="mx-auto">
                                                {{$subscribers->links("pagination::bootstrap-4")}}
                                            </div>
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

<!-- Modal -->
<div class="modal fade text-left" id="composeForm" tabindex="-1" role="dialog" aria-labelledby="emailCompose" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title text-text-bold-600" id="emailCompose">Compose Mail</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('admin.mail-all')}}" method="POST">
                @csrf
            <div class="modal-body pt-1">
                <div class="form-label-group mt-1" id="to">
                    <label for="emailTo">To</label>
                    <input type="text" id="user_names"  name="to[]" class="form-control tagin" value="duzakavud@mailinator.com"  data-duplicate="false" multiple>
                </div>

                <input type="hidden" id="details"  name="details"  value="this"  >
                <div class="form-label-group">
                    <input type="text" id="emailSubject" class="form-control" placeholder="Subject" name="subject" required>
                    <label for="emailSubject">Subject</label>
                </div>
                <div class="form-label-group">
                    <textarea type="text" id="ck-editor1" class="form-control ck-editor__editable_inline" name="message" placeholder="Message" rows="5" require="required">
                    </textarea>
                    <label for="emailMessage">Message</label>
                </div>
                {{-- <div class="form-label-group">
                    <input type="text" id="emailCC" class="form-control" placeholder="CC" name="fname-floating">
                    <label for="emailCC">CC</label>
                </div>
                <div class="form-label-group">
                    <input type="text" id="emailBCC" class="form-control" placeholder="BCC" name="fname-floating">
                    <label for="emailBCC">BCC</label>
                </div> --}}
                {{-- <div id="email-container">
                    <div class="editor" data-placeholder="Message">
                        
                    </div>
                </div> --}}
                {{-- <div class="form-group mt-2">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="emailAttach">
                        <label class="custom-file-label" for="emailAttach">Attach file</label>
                    </div>
                </div> --}}
            </div>
            <div class="modal-footer">
                <input type="submit" value="Send" class="btn btn-primary">
                <input type="Reset" value="Cancel" class="btn btn-white" data-dismiss="modal">
            </div>
            </form>
        </div>
    </div>
    
</div>

@endsection

