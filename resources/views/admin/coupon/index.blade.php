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
							<h2 class="content-header-title float-left mb-0">Coupon</h2>
							<div class="breadcrumb-wrapper col-12">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a>
									</li>
									<li class="breadcrumb-item"><a href="#">Coupon</a>
									</li>
									<li class="breadcrumb-item active">Coupon List
									</li>
								</ol>
							</div>
						</div>
					</div>
				</div>
				<div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
					<div class="form-group breadcrum-right">
						<a href="{{ route('admin.coupons.create') }}" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle"><i class="feather icon-plus"></i> Add New</a>
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
													<th>Coupon</th>
													<th>Coupon For</th>
													<th>Start Date</th>
													<th>End Date</th>
													<th>Status</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
												@foreach ($coupons as $coupon)
													<tr data-id="{{ $coupon->id }}">
														<td></td>
														<td class="product-name">{!! $coupon->coupon !!}</td>
														<td>{!! $coupon->couponAppliedList !!}</td>
														<td>
															<h5 class="mt-0">{{ $coupon->start_time }}</h5>
														</td>
														<td>
															<h5 class="mt-0">{{ $coupon->end_time }}</h5>
														</td>
														<td>
															<span class="btn-sm btn-{{ $coupon->isActive ? 'primary' : 'warning' }}">
																{{ $coupon->isActive ? 'Active' : 'In-Active' }}
															</span>
														</td>
														<td class="product-action">
															<a href="{!! route('admin.coupons.edit', $coupon->id) !!}">
																<i class="feather icon-edit"></i>
															</a>
															<a href="#" onclick="confirm_modal('{{ route('admin.coupons.destroy', $coupon->id) }}')">
																<i class="feather icon-trash"></i>
															</a>
														</td>
													</tr>
												@endforeach
											</tbody>

										</table>
										<div class="d-flex">
											<div class="mx-auto">
												{{ $coupons->links('pagination::bootstrap-4') }}
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
