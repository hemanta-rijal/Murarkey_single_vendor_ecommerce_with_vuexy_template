@extends('admin.layouts.app')
@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/css/plugins/forms/validation/form-validation.css') }}">
@endsection

@section('js')
	<script src="{{ asset('backend/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js') }}"></script>
	<script src="{{ asset('backend/app-assets/js/scripts/forms/validation/form-validation.js') }}"></script>
	<script src="https://cdn.ckeditor.com/ckeditor5/29.0.0/classic/ckeditor.js"></script>
	<script src="{{ asset('backend/custom/customfuncitons.js') }}"></script>
	<script>
	 ClassicEditor.create(document.querySelector('#ck-editor1'))
	  .catch(error => {
	   console.error(error);
	  });
	</script>
@endsection

@section('content')
	<!-- BEGIN: Content-->
	<div class="app-content content">
		<div class="content-overlay"></div>
		<div class="header-navbar-shadow"></div>
		<div class="content-wrapper">
			<div class="content-header row">
				<div class="content-header-left col-md-9 col-12 mb-2">
					<div class="row breadcrumbs-top">
						<div class="col-12">
							<h2 class="content-header-title float-left mb-0">Category</h2>
							<div class="breadcrumb-wrapper col-12">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Dashboard</a>
									</li>
									<li class="breadcrumb-item"><a href="#">Categories</a>
									</li>
									<li class="breadcrumb-item active"><a href="#">Add New Category</a>
									</li>
								</ol>
							</div>
						</div>
					</div>
				</div>
				@include('admin.partials.view-all-include',['route' =>'admin.categories.index'])
			</div>
			<div class="content-body">
				<!-- Basic Vertical form layout section start -->
				<section id="basic-vertical-layouts">
					<div class="row match-height justify-content-md-center">
						{{-- <div class="col-md-2 col-6"></div> --}}
						<div class="col-md-8 col-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Create New Category</h4>
								</div>
								<div class="card-content">
									<div class="card-body">
										<form action="{{ route('admin.categories.update', $category->id) }}" class="form form-vertical" method="POST" enctype="multipart/form-data">
											{{ method_field('put') }}
											{{ csrf_field() }}
											<div class="form-body">
												<div class="row">
													<div class="col-6">
														<div class="form-group">
															<label for="name-vertical">Category Title</label>
															<input type="text" id="name-vertical" class="form-control" name="name" placeholder="Category Title" onkeyup="setSlug(this.value)" value="{{ $category->name }}" required>
														</div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<label for="Slug-vertical">Slug</label>
															<input type="text" id="slug" class="form-control" name="slug" placeholder="Slug" value="{{ $category->slug }}" required>
														</div>
													</div>
													<div class="col-12">
														<div class="form-group">
															<label for="Description-id-vertical">Description</label>
															<textarea type="text" id="ck-editor1" class="form-control ck-editor__editable_inline" name="description" placeholder="Description" rows="5">{!! $category->description !!}</textarea>
														</div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<label for="icon-info-vertical">Icon</label>
															<input type="file" id="icon-info-vertical" class="form-control" name="icon" placeholder="Icon Image" />
														</div>
													</div>
													<div class="col-6">
														<div class="form-group">
															<label for="icon-info-vertical">Image</label>
															<input type="file" id="icon-info-vertical" class="form-control" name="image" placeholder="Image" />
														</div>
													</div>
													<div class="col-4">
														<div class="form-group">
															<label for="wend_timet-vertical">Featured</label>
															<div class=" custom-control custom-switch switch-lg custom-switch-success mr-2 mb-1">
																<input type="hidden" name="featured" class="custom-control-input form-control" value="0">
																<input type="checkbox" name="featured" class="custom-control-input form-control" id="customSwitch100" value="1" {{ $category->featured == true ? 'checked' : '' }}>
																<label class="custom-control-label" for="customSwitch100">
																	<span class="switch-text-left">Featured</span>
																	<span class="switch-text-right">Un-Featured</span>
																</label>
															</div>
														</div>
													</div>
													<div class="col-8 form-group">
														<label>Parent Category </label>
														<div class="controls">
															<select name="parent_id" id="parent_category" class="form-control">
																@foreach (get_categories_for_form() as $id => $name)
																	<option value="{{ $id }}" {{ $id == $category->parent_id ? 'selected' : '' }}>{{ $name }}</option>
																@endforeach
															</select>
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
