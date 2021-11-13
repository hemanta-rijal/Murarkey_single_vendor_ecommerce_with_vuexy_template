@extends('admin.layouts.app')
@include('admin.partials.indexpage-includes')
@section('js')
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
							<h2 class="content-header-title float-left mb-0">Categories</h2>
							<div class="breadcrumb-wrapper col-12">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Dashboard</a>
									</li>
									<li class="breadcrumb-item"><a href="#">Categories</a>
									</li>
									<li class="breadcrumb-item active">Categories List
									</li>
								</ol>
							</div>
						</div>
					</div>
				</div>
				<div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
					<div class="form-group breadcrum-right">
						<a href="{{ route('admin.categories.create') }}" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle"><i class="feather icon-plus"></i> Add New</a>
						<a href="{{ route('admin.categories.import-export') }}" class="btn-icon btn btn-warning btn-round btn-sm dropdown-toggle"><i class="feather icon-upload-cloud"></i>Import & Export</a>
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
													<th>Slug</th>
													<th>Description</th>
													<th>Product Count</th>
													<th>Parent</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												@foreach ($categories as $category)
													<tr data-id="{{ $category->id }}">
														<td></td>
														<td class="product-name">{!! $category->name !!}</td>
														<td>{!! $category->slug !!}</td>
														<td>{!! strlen($category->description) > 100 ? substr($category->description, 0, 97) . '...' : $category->description !!}</td>
														<td>{!! $category->product_count !!}</td>
														<td>{!! $category->parent ? $category->parent->name : '-' !!}</td>
														<td class="product-action">
															<a href="{!! route('admin.categories.edit', $category->id) !!}">
																<i class="feather icon-edit"></i>
															</a>
															<a href="#" onclick="confirm_modal('{{ route('admin.categories.destroy', $category->id) }}')">
																<i class="feather icon-trash"></i>
															</a>
														</td>
													</tr>
												@endforeach
											</tbody>

										</table>
										<div class="d-flex">
											<div class="mx-auto">
												{{ $categories->links('pagination::bootstrap-4') }}
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
	@include('admin.partials.modal')
	<!-- END: Content-->

@endsection
