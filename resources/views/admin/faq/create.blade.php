@extends('admin.layouts.app')
@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/css/plugins/forms/validation/form-validation.css') }}">
@endsection

@section('js')
	<script src="{{ asset('backend/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js') }}"></script>
	<script src="{{ asset('backend/app-assets/js/scripts/forms/validation/form-validation.js') }}"></script>

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
							<h2 class="content-header-title float-left mb-0">FAQs</h2>
							<div class="breadcrumb-wrapper col-12">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Dashboard</a>
									</li>
									<li class="breadcrumb-item"><a href="#">FAQs</a>
									</li>
									<li class="breadcrumb-item active"><a href="#">Add New FAQ</a>
									</li>
								</ol>
							</div>
						</div>
					</div>
				</div>
				@include('admin.partials.view-all-include',['route' =>'admin.faqs.index'])
			</div>
			<div class="content-body">
				<!-- Basic Vertical form layout section start -->
				<section id="basic-vertical-layouts">
					<div class="row match-height justify-content-md-center">
						{{-- <div class="col-md-2 col-6"></div> --}}
						<div class="col-md-8 col-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Create New FAQ</h4>
								</div>
								<div class="card-content">
									<div class="card-body">
										<form action="{{ route('admin.faqs.store') }}" class="form form-vertical" method="POST" enctype="multipart/form-data">
											{{ csrf_field() }}
											<div class="form-body">
												<div class="row">
													<div class="col-12">
														<div class="form-group">
															<label for="name-vertical">Question<span class="text-danger">*</span></label>
															<textarea type="text" id="name-vertical" class="form-control" name="question" rows="2" placeholder="FAQ" required></textarea>
														</div>
													</div>
													<div class="col-12">
														<div class="form-group">
															<label for="name-vertical">Answer<span class="text-danger">*</span></label>
															<textarea type="text" id="name-vertical" class="form-control" name="answer" rows="5" placeholder="Answer" required></textarea>
														</div>
													</div>


													<div class="col-12">
														<button type="submit" value="submit" class="btn btn-primary mr-1 mb-1">Submit
														</button>
														<button type="reset" class="btn btn-outline-warning mr-1 mb-1">
															Reset
														</button>
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
