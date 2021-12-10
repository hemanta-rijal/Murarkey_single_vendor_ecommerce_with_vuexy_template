@extends('admin.layouts.app')
@section('css')
    <link rel="stylesheet" type="text/css"
          href="{{ asset('backend/app-assets/css/plugins/forms/validation/form-validation.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <style>
        li.selected{
            background: #8b8b8b;
            color: #fff;
        }
    </style>

@endsection

@section('js')
    <script src="{{ asset('backend/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js') }}"></script>
    <script src="{{ asset('backend/app-assets/js/scripts/forms/validation/form-validation.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/29.0.0/classic/ckeditor.js"></script>
    <script src="{{ asset('backend/custom/customfuncitons.js') }}"></script>
    <script>
        ClassicEditor.create(document.querySelector('#ck-editor1'))
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        ClassicEditor.create(document.querySelector('#ck-editor2'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor.create(document.querySelector('#ck-editor3'))
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        var category_name = "";
        var subcategory_name = "";
        var subsubcategory_name = "";

        var category_id = null;
        var subcategory_id = null;
        var subsubcategory_id = null;
        $(document).ready(function () {
            $('#subcategory_list').hide();
            $('#subsubcategory_list').hide();
            $('.js-example-basic-multiple').select2({
                tags: "true",
                placeholder: "Select an option",
                allowClear: true
            });
        });

        function list_item_highlight(el) {
            $(el).parent().children().each(function () {
                $(this).removeClass('selected');
            });
            $(el).addClass('selected');
        }

        function get_subcategories_by_category(el, cat_id) {
            list_item_highlight(el);
            category_id = cat_id;
            subcategory_id = null;
            subsubcategory_id = null;
            category_name = $(el).html();
            $('#subcategories').html(null);
            $.post('{{ route('admin.services.getChildren') }}', {
                _token: '{{ csrf_token() }}',
                category_id: category_id
            }, function (data) {
                for (var i = 0; i < data.length; i++) {
                    $('#subcategories').append('<li onclick="get_subsubcategories_by_subcategory(this, ' + data[i].id + ')">' + data[i].name + '</li>');
                }
                $('#subcategory_list').show();
            });


        }

        function get_subsubcategories_by_subcategory(el, cat_id) {

            list_item_highlight(el);
            subcategory_id = cat_id;
            subsubcategory_id = null;
            subcategory_name = $(el).html();
            $('#subsubcategories').html(null);
            $.post('{{ route('admin.services.getChildren') }}', {
                _token: '{{ csrf_token() }}',
                category_id: subcategory_id
            }, function (data) {
                for (var i = 0; i < data.length; i++) {
                    $('#subsubcategories').append('<li onclick="confirm_subsubcategory(this, ' + data[i].id + ')">' + data[i].name + '</li>');
                }
                $('#subsubcategory_list').show();
            });

        }

        function confirm_subsubcategory(el, subsubcat_id) {
            list_item_highlight(el);
            subsubcategory_id = subsubcat_id;
            subsubcategory_name = $(el).html();
        }

        function closeModal() {
            if (category_id > 0 && subcategory_id > 0) {
                $('#category_id').val(category_id);
                $('#subcategory_id').val(subcategory_id);
                $('#subsubcategory_id').val(subsubcategory_id);
                $('#product_category').val(subsubcategory_name);
                $('#categorySelectModal').modal('hide');
            } else {
                alert('Please choose categories...');
            }
        }

        function filterListItems(el, list) {
            filter = el.value.toUpperCase();
            li = $('#' + list).children();
            for (i = 0; i < li.length; i++) {
                if ($(li[i]).html().toUpperCase().indexOf(filter) > -1) {
                    $(li[i]).show();
                } else {
                    $(li[i]).hide();
                }
            }
        }

        $('.js-example-basic-multiple').on('change', function () {
            var selected = [];
            $(".js-example-basic-multiple option:selected").each(function (key, item) {
                selected.push(item.text);
            });
            console.log(selected);
            $.post('{{ route('admin.get.service-label-field') }}', {
                _token: '{{ @csrf_token() }}',
                labels: selected
            }, function (data) {
                $('#service-label-field').html(data);
            });
        })
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
                            <h2 class="content-header-title float-left mb-0">Services</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{URL::to('/admin')}}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{URL::to('admin/services')}}">Services</a>
                                    </li>
                                    <li class="breadcrumb-item active"><a href="#">Add New Service</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                @include('admin.partials.view-all-include',['route' =>'admin.services.index'])
            </div>
            <div class="content-body">
                <form action="{{ route('admin.services.store') }}" class="form form-vertical" method="POST"
                      enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Create New Service</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">

                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="name-vertical">Service Title <span
                                                                    class="text-danger">*</span></label>
                                                        <input type="text" id="name-vertical"
                                                               class="form-control" name="title"
                                                               placeholder="Service Title" required
                                                               onkeyup="setSlug(this.value)">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="Slug-vertical">Slug</label>
                                                        <input type="text" id="slug"
                                                               class="form-control"
                                                               name="slug" placeholder="Slug" readonly
                                                               required>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <label for="name-vertical">Service Duration</label>
                                                    <div class="form-group">
                                                        <div class="row form-group">
                                                            &nbsp;
                                                            &nbsp;
                                                            <input type="text" id="name-vertical"
                                                                   class="form-control col-3" name="min_duration"
                                                                   placeholder="Minimum Duration">
                                                            &nbsp;
                                                            <select name="min_duration_unit" id="min"
                                                                    class="form-control col-2">
                                                                <option value="min">Min</option>
                                                                <option value="hr">Hrs</option>
                                                            </select>
                                                            <div class="col-1"></div>
                                                            <input type="text" id="name-vertical"
                                                                   class="form-control col-3" name="max_duration"
                                                                   placeholder="Maximum Duration">
                                                            <select name="max_duration_unit" id="max"
                                                                    class="form-control col-2">
                                                                <option value="min">Min</option>
                                                                <option value="hr">Hrs</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="Image-vertical">Icon Image</label>
                                                        <input type="file" id="Icon-Image" class="form-control"
                                                               name="icon_image" placeholder="Icon Image"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="Image-vertical">Feature Images &nbsp; <span
                                                                    style="color: blue"> (Choose Multipe Image)</span></label>
                                                        <input type="file" id="Feature-Image" class="form-control"
                                                               name="featured_images[]" multiple
                                                               placeholder="Feature Images" required/>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>


                                        <h4 class="card-title">Service Labels</h4>
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="unit-vertical">Service Labels &nbsp;<span
                                                                    style="color: blue">Note: Changes on service labels will change initial to labels description contents </span></label>
                                                        <select class="form-control js-example-basic-multiple"
                                                                name=" service_labels[]" id="serviceLabel"
                                                                multiple="multiple" style="width: 100%">
                                                            @foreach (get_service_labels() as $label)
                                                                <option value="{{ Str::slug($label->value) }}">{{ $label->value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div id="service-label-field" class="col-12">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>


                                        <hr>
                                        <h4 class="card-title">Service Details</h4>
                                        <hr>
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="Description-id-vertical">Quote Caption</label>
                                                        <textarea type="text" class="form-control" name="service_quote"
                                                                  placeholder="Service Qutoes " rows="3"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="Description-id-vertical">Short
                                                            Description</label>
                                                        <textarea type="text" id="ck-editor2"
                                                                  class="form-control ck-editor__editable_inline"
                                                                  name="short_description"
                                                                  placeholder="Short Description" rows="5"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="Description-id-vertical">Full
                                                            Description</label>
                                                        <textarea rows="8" type="text" id="ck-editor3"
                                                                  class="form-control ck-editor__editable_inline"
                                                                  name="description"
                                                                  placeholder="Full Description"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">

                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="Image-vertical">Service Category</label>
                                                        <input class="form-control " name=" category_id"
                                                               data-toggle="modal" data-target="#categorySelectModal"
                                                               id="product_category">
                                                        <input type="hidden" name="category_id" id="subsubcategory_id"
                                                               value="" required>
                                                    </div>
                                                </div>

                                                <hr>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="Image-vertical">Service For</label>
                                                        <select class="form-control " name="serviceTo" id="category">
                                                            <option value="1">Murarkey</option>
                                                            <option value="0">Others</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="price-vertical">Popular</label>
                                                        <div class="form-control custom-switch custom-control-inline">
                                                            <input class="form-check-input" name="popular" type="hidden"
                                                                   id="popular" value="0">
                                                            <input class="custom-control-input" name="popular"
                                                                   type="checkbox" id="customSwitch1" value="1">
                                                            <label class="custom-control-label" for="customSwitch1">
                                                            </label>
                                                            <span class="switch-label"> popular? </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="Image-vertical">Service Charge</label>
                                                        <input type="number" id="image" class="form-control"
                                                               name="service_charge" placeholder="Service Charge"/>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="price-vertical">Discount Type</label>
                                                        <select type="text" id="discount-vertical" class="form-control"
                                                                name="discount_type" placeholder="Discount type"
                                                                required>
                                                            <option value="no discount">No Discount</option>
                                                            {{-- <option value="flat_rate">Flat Rate</option>
                                                            <option value="percentage">Percentage</option> --}}
                                                            <option value="cash_back">Cash Back(%)</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="price-vertical">Discount</label>
                                                        <input type="text" id="price-vertical" class="form-control"
                                                               name="a_discount_price" placeholder="Discount">
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-12">
                                                    <button type="submit" value="submit"
                                                            class="btn btn-primary mr-1 mb-1">Submit
                                                    </button>
                                                    <button type="reset"
                                                            class="btn btn-outline-warning mr-1 mb-1">Reset
                                                    </button>
                                                </div>

                                            </div>
                                        </div>


                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- END: Content-->
    <!-- Modal -->
    <div class="modal fade" id="categorySelectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Select Category</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="target-category heading-6">
                        <span class="mr-3">Target Category:</span>
                        <span>category > subcategory > subsubcategory</span>
                    </div>
                    <div class="row no-gutters modal-categories mt-4 mb-2">
                        <div class="col-4">
                            <div class="modal-category-box c-scrollbar">
                                <div class="sort-by-box">
                                    <form role="form" class="search-widget">
                                        <input class="form-control input-lg" type="text" placeholder="Search Category"
                                               onkeyup="filterListItems(this, 'categories')">
                                    </form>
                                </div>
                                <div class="modal-category-list has-right-arrow">
                                    <ul id="categories" style="list-style-type: none">
                                        @foreach ($service_categories as $key => $category)
                                            <li onclick="get_subcategories_by_category(this, {{ $category->id }})">{{ $category->name }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="modal-category-box c-scrollbar" id="subcategory_list">
                                <div class="sort-by-box">
                                    <form role="form" class="search-widget">
                                        <input class="form-control input-lg" type="text"
                                               placeholder="Search SubCategory"
                                               onkeyup="filterListItems(this, 'subcategories')">
                                    </form>
                                </div>
                                <div class="modal-category-list has-right-arrow">
                                    <ul id="subcategories" style="list-style-type: none">

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="modal-category-box c-scrollbar" id="subsubcategory_list">
                                <div class="sort-by-box">
                                    <form role="form" class="search-widget">
                                        <input class="form-control input-lg" type="text"
                                               placeholder="Search SubSubCategory"
                                               onkeyup="filterListItems(this, 'subsubcategories')">
                                    </form>
                                </div>
                                <div class="modal-category-list">
                                    <ul id="subsubcategories" style="list-style-type: none">

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">cancel</button>
                    <button type="button" class="btn btn-primary" onclick="closeModal()">Confirm</button>
                </div>
            </div>
        </div>
    </div>

@endsection
