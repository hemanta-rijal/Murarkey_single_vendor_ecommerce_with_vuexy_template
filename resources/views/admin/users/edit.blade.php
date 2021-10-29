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
							<h2 class="content-header-title float-left mb-0">User Form</h2>
							<div class="breadcrumb-wrapper col-12">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Dashboard</a>
									</li>
									<li class="breadcrumb-item"><a href="#">User</a>
									</li>
									<li class="breadcrumb-item active"><a href="#">Edit</a>
									</li>
								</ol>
							</div>
						</div>
					</div>
				</div>
				@include('admin.partials.view-all-include',['route' =>'admin.users.index'])
			</div>
			<div class="content-body">
				<!-- Basic Vertical form layout section start -->
				<section id="basic-vertical-layouts">
					<div class="row match-height justify-content-md-center">
						{{-- <div class="col-md-2 col-6"></div> --}}
						<div class="col-md-8 col-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Vertical Form</h4>
								</div>
								<div class="card-content">
									<div class="card-body">
										<form action="{{ route('admin.users.update', $user->id) }}" class="form form-vertical" method="POST">
											@csrf
											{{ method_field('PUT') }}
											<div class="form-body">
												<div class="row">
													<div class="col-6">
														<div class="form-group">
															<label for="first-name-vertical">First Name<span class="text-danger">*</span></label>
															<input type="text" id="first-name-vertical" class="form-control" name="first_name" placeholder="First Name" value="{{ $user->first_name }}" required>
														</div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<label for="Last-name-vertical">Last Name<span class="text-danger">*</span></label>
															<input type="text" id="Last-name-vertical" class="form-control" name="last_name" placeholder="Last Name" value="{{ $user->last_name }}" required>
														</div>
													</div>
													<div class="col-12">
														<div class="form-group">
															<label for="email-id-vertical">Email<span class="text-danger">*</span></label>
															<input type="email" id="email-id-vertical" class="form-control" name="email" placeholder="Email" value="{{ $user->email }}" required>
														</div>
													</div>
													<div class="col-12">
														<div class="form-group">
															<label for="contact-info-vertical">Phone Number</label>
															<input type="tel" id="contact-info-vertical" class="form-control" name="phone_number" placeholder="Phone Number" value="{{ $user->phone_number }}">
														</div>
													</div>
													<div class="col-12 form-group">
														<label>Password </label>
														<div class="controls">
															<input type="password" name="password" class="form-control" placeholder="Password (Keep blank if you don't want to change)" value="">
														</div>
													</div>
													<div class="col-12 form-group">
														<label>Repeat password must match</label>
														<div class="controls">
															<input type="password" name="password_confirmation" data-validation-match-match="password" class="form-control" placeholder="Repeat Password (Keep blank if you don't want to change)"
																value="">
														</div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<label for="email-id-vertical">Role<span class="text-danger">*</span></label>
															<select name="role" id="roles" class="form-control" required>
																<option value="user">User</option>
																{{-- <option value="admin">Admin</option> --}}
															</select>
														</div>
													</div>
													<div class="form-group col-6 ">
														<label>User Verification</label>
														<fieldset class="checkbox">
															<div class="vs-checkbox-con vs-checkbox-primary">
																<input type="checkbox" name="verified" value="1">
																<span class="vs-checkbox">
																	<span class="vs-checkbox--check">
																		<i class="vs-icon feather icon-check"></i>
																	</span>
																</span>
																<span class="text">Verified</span>
															</div>
														</fieldset>
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
