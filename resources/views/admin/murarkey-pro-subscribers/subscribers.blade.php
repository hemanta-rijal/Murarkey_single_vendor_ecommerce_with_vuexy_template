@extends('admin.layouts.app')
@include('admin.partials.indexpage-includes');

@section('js')
<script type="text/javascript">
    $(document).ready(function () {

        $('.delete_all').on('click', function(e) {

            var allVals = [];
            $(".selected").each(function() {
                allVals.push($(this).attr('data-id'));
            });
            
            console.log(allVals)

            if(allVals.length <=0)
            {
                alert("Please select row.");
            }  else {
                var check = confirm("Are you sure you want to delete bulk data?");
                if(check == true){

                    var join_selected_values = allVals.join(",");
                    console.log(allVals)
                     $.ajaxSetup({
                        headers: {'X-CSRF-TOKEN': '{{ Session::token() }}'}
                    });

                    $.ajax({
                        url: '{{ url('/admin/users/bulk-delete') }}',
                        type: 'POST',
                        data: {
                            "ids":join_selected_values,
                            "_method": 'POST',
                        },
                        success: function (data) {
                            if (data['success']) {
                                window.location= '{{route('admin.users.index')}}'
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
                }
            }
        });
        
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
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrum-right">
                        <a href="#" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle"><i class="feather icon-envalope"></i> Send Mails</a>
                        <div class="dropdown">   
                        </div>
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
                                        <table class="table zero-configuration">
                                            <thead>
                                                <tr>
                                                    <th>Full Name</th>
                                                    <th>Email</th>
                                                    <th>Phone Number</th>
                                                    <th>Viber Number</th>
                                                    <th>ACTION</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                        @foreach ($subscribers  as $subscriber)
                                                            <tr data-id="{{$subscriber->id}}">
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

