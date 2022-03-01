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

	<style>
		.paging_simple_numbers {
			display: none;
		}

		.dataTables_length {
			display: none;
		}

		.actions {
			display: none;
			/* search : true; */
		}
	</style>

	<link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/css/pages/app-email.css')}}">
	<link rel="stylesheet" href="{{ asset('backend/tagin-master/dist/css/tagin.css') }}">
@endsection

@section('js')
	<script>
		var brandData = {!! json_encode($brands) !!}
	</script>
	<!-- BEGIN: Page Vendor JS-->
	<script src="{{ asset('backend/app-assets/vendors/js/extensions/dropzone.min.js')}}"></script>
	<script src="{{ asset('backend/app-assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
	<script src="{{ asset('backend/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js')}}"></script>
	<script src="{{ asset('backend/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js')}}"></script>
	<script src="{{ asset('backend/app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js')}}"></script>
	<script src="{{ asset('backend/app-assets/vendors/js/tables/datatable/dataTables.select.min.js')}}"></script>
	<script src="{{ asset('backend/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js')}}"></script>

	<!-- END: Page Vendor JS-->
	<script>
		function editproductstocks() {
			$(".sku").prop('disabled', false);
		}

		function filterTable() {
			var filterby = $('#filterby').val();
			// alert(filterby)
			$.post('{{ route('admin.product.manage-stock.filterby') }}', {
				_token: '{{ @csrf_token() }}',
				filter: filterby
			}, function (data) {
				$('#product-attribute-fields').html(data);
			});
		}
	</script>

	<script>
		var dataListView = $(".data-list-view").DataTable({
			responsive: false,
			searching: true,
			data:data,
			columnDefs: [
				{
					orderable: true,
					targets: 0,
					checkboxes: { selectRow: true }
				}
			],
			dom:
					'<"top"<"actions action-btns"B><"action-filters"lf>><"clear">rt<"bottom"<"actions">p>',
			oLanguage: {
				sLengthMenu: "_MENU_",
				sSearch: ""
			},
			aLengthMenu: [[ 10, 15, 20], [ 10, 15, 20]],
			select: {
				style: "multi"
			},
			order: [[1, "asc"]],
			bInfo: false,
			pageLength: 10,
			buttons: [
				{
					text: "<i class='feather icon-plus'></i> Add New",
					action: function() {
						$(this).removeClass("btn-secondary")
						$(".add-new-data").addClass("show")
						$(".overlay-bg").addClass("show")
						$("#data-name, #data-price").val("")
						$("#data-category, #data-status").prop("selectedIndex", 0)
					},
					className: "btn-outline-primary"
				}
			],
			initComplete: function(settings, json) {
				$(".dt-buttons .btn").removeClass("btn-secondary")
			}
		});

		dataListView.on('draw.dt', function(){
			setTimeout(function(){
				if (navigator.userAgent.indexOf("Mac OS X") != -1) {
					$(".dt-checkboxes-cell input, .dt-checkboxes").addClass("mac-checkbox")
				}
			}, 50);
		});
	</script>


	<!-- BEGIN: Page JS-->
	{{--    <script src="{{ asset('backend/app-assets/js/scripts/ui/data-list-view.js') }}"></script>--}}
	<script src="{{ asset('backend/custom/customfuncitons.js')}}"></script>
	<script src="{{ asset('backend/tagin-master/dist/js/tagin.js')}}"></script>
	<script src="https://cdn.ckeditor.com/ckeditor5/29.0.0/classic/ckeditor.js"></script>
	<script>
		for (const el of document.querySelectorAll('.tagin')) {
			tagin(el)
		}

	</script>

	<script type="text/javascript">
	 $(document).ready(function() {

	  $('.delete_all').on('click', function(e) {

	   var allVals = [];
	   $(".selected").each(function() {
	    allVals.push($(this).attr('data-id'));
	   });

	   console.log(allVals)

	   if (allVals.length <= 0) {
	    alert("Please select row.");
	   } else {
	    var check = confirm("Are you sure you want to delete bulk data?");
	    if (check == true) {

	     var join_selected_values = allVals.join(",");
	     console.log(allVals)
	     $.ajaxSetup({
	      headers: {
	       'X-CSRF-TOKEN': '{{ Session::token() }}'
	      }
	     });

	     $.ajax({
	      url: '{{ url('/admin/users/bulk-delete') }}',
	      type: 'POST',
	      data: {
	       "ids": join_selected_values,
	       "_method": 'POST',
	      },
	      success: function(data) {
	       if (data['success']) {
	        window.location = '{{ route('admin.users.index') }}'
	       } else if (data['error']) {
	        alert(data['error']);
	       } else {
	        alert('Whoops Something went wrong!!');
	       }
	      },
	      error: function(data) {
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
							<h2 class="content-header-title float-left mb-0">Brands</h2>
							<div class="breadcrumb-wrapper col-12">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Dashboard</a>
									</li>
									<li class="breadcrumb-item"><a href="#">Brands</a>
									</li>
									<li class="breadcrumb-item active">Brands List
									</li>
								</ol>
							</div>
						</div>
					</div>
				</div>
				<div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
					<div class="form-group breadcrum-right">
						<a href="{{ route('admin.brands.create') }}" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle"><i class="feather icon-plus"></i> Add New</a>
						<a href="{{ route('admin.brands.import-export') }}" class="btn-icon btn btn-warning btn-round btn-sm dropdown-toggle"><i class="feather icon-upload-cloud"></i> Import & Export</a>
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
										<table class="table data-list-view">
											<thead>
												<tr>
													<th></th>
													<th>Name</th>
													<th>Caption</th>
													<th>Image</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												@foreach ($brands as $brand)
													<tr data-id="{{ $brand->id }}">
														<td></td>
														<td class="product-name">{!! $brand->name !!}</td>
														<td>{!! strlen($brand->caption) > 100 ? substr($brand->caption, 0, 97) . '...' : $brand->caption !!}</td>
														<td><img class="media-object" src="{!! resize_image_url($brand->image, '50X50') !!}" alt="Image" height="50"></td>
														<td class="product-action">
															<a href="{!! route('admin.brands.edit', $brand->id) !!}">
																<i class="feather icon-edit"></i>
															</a>
															<a href="#" onclick="confirm_modal('{{ route('admin.brands.destroy', $brand->id) }}')">
																<i class="feather icon-trash"></i>
															</a>
														</td>
													</tr>
												@endforeach
											</tbody>

										</table>

										<div class="d-flex">
											<div class="mx-auto">
												{{ $brands->links('pagination::bootstrap-4') }}
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
	@include('admin.partials.modal')
	<!-- END: Content-->

@endsection
