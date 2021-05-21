@extends('admin.layouts.app')
@section('css')
         <style>
                    /* .modal{
                        display: block !important; /* I added this to see the modal, you don't need this */
                    } */

                    /* Important part */
                    /* .modal-dialog{
                        overflow-y: initial !important
                    } */
                    .modal-body{
                        height: 80vh;
                        overflow-y: auto;
                    }
        </style>
        <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/css/plugins/forms/validation/form-validation.css') }}">
        {{-- <link rel="stylesheet" href="{{ asset('backend/tagin-master/dist/css/tagin.css') }}"> --}}

        <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/vendors/css/forms/select/select2.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('backend/app-assets/vendors/css/pickers/pickadate/pickadate.css') }}">
   
    @endsection

    @section('js')

    <script src="{{ asset('backend/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js') }}"></script>
    <script src="{{ asset('backend/app-assets/js/scripts/forms/validation/form-validation.js')}}"></script>

    <script src=" {{ asset('backend/app-assets/vendors/js/pickers/pickadate/picker.js')}}"></script>
    <script src=" {{ asset('backend/app-assets/vendors/js/pickers/pickadate/picker.date.js')}}"></script>
    <script src=" {{ asset('backend/app-assets/vendors/js/pickers/pickadate/picker.time.js')}}"></script>
    <script src=" {{ asset('backend/app-assets/vendors/js/pickers/pickadate/legacy.js')}}"></script>
    <script src="{{ asset('backend/app-assets/js/scripts/pickers/dateTime/pick-a-datetime.js') }}"></script>

    {{-- <script src="{{ asset('backend/tagin-master/dist/js/tagin.js')}}"></script> --}}
    
    <script src="{{ asset('backend/app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
    
    <script src="{{ asset('backend/app-assets/js/scripts/forms/select/form-select2.js')}}"></script>
    
    {{-- <script>
        for (const el of document.querySelectorAll('.tagin')) {
        tagin(el)
        }
    </script> --}}
    
    <script src="{{ asset('backend/new/bootstrap-tagsinput.js')}}"></script>
    {{-- <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script> --}}
    <script>
        function slugify(text) {
            return text.toString().toLowerCase()
                .replace(/\s+/g, '-') // Replace spaces with -
                .replace(/[^\w\-]+/g, '') // Remove all non-word chars
                .replace(/\-\-+/g, '-') // Replace multiple - with single -
                .replace(/^-+/, '') // Trim - from start of text
                .replace(/-+$/, ''); // Trim - from end of text
        }

        function setSlug(value) {
            $('#slug').val(slugify(value));
        }
        </script>

        <script>
        var searchResult = [];
        var product_ids = {!! json_encode(get_product_ids_from_featured_products($flashSale->items)) !!};

        function removeProduct(id, product_id) {
            var index = product_ids.indexOf(product_id);
            product_ids.splice(index, 1);
            $('#edit-form').append('<input type="hidden" name="remove_item[]" value="' + id + '">');
            $('#old-item-' + id).remove();
        }

        function removeNewlyAdded(id) {
            var index = product_ids.indexOf(id);
            product_ids.splice(index, 1);

            $('#product-' + id).remove();
        }

        function getSearchResult() {
            $.post('/admin/products/ajax-search', {
                _token: "{{ csrf_token() }}",
                search: $('#search-input-field').val()
            })
                    .fail(function (error) {
                        alert('Something went wrong');
                    })
                    .done(function (data) {
                        console.log(data);
                        searchResult = data;
                        var tableBody = $('#search-result-table-body');
                        var noResultDiv = $('#no-result-found');
                        noResultDiv.hide();
                        tableBody.empty();
                        data.forEach(function (product) {
                            tableBody.append(searchResultProductTemplate(product));
                        });

                        if (data.length == 0)
                            noResultDiv.show();
                    })
        }
        function addProduct(index) {
            var product = searchResult[index];
            var tbody = $('#featured-products-tbody');
            if (inArray(product.id, product_ids))
                alert('Already added!')
            else {
                tbody.append(generateAddProductTemplate(product, tbody.length));
                product_ids.push(product.id);
            }


        }

        function generateAddProductTemplate(product, index) {
            index = $('#featured-products-tbody tr').length;
            return '<tr id="product-' + product.id + '">' +
                    '<td>' + product.name + '</td>' +

                '<td><input type="number" name="products[' + index + '][discount]" class="form-control"></td>' +

                '<td><input type="number" name="products[' + index + '][weight]" class="form-control"></td>' +
                    '<td><button class="btn btn-danger" onclick="removeNewlyAdded(' + product.id + ')">Remove</button>' +
                    '<input type="hidden" name="products[' + index + '][product_id]" value="' + product.id + '">' +
                    '</tr>';
        }

        function searchResultProductTemplate(product) {
            return '<tr id="search-product-' + product.id + '">' +
                    '<td><a href="/products/' + product.id + '" target="_blank">' + product.name + '</a></td>' +
                    '<td><button class="btn btn-success" onclick="addProduct(' + searchResult.indexOf(product) + ')">Add</button>' +
                    '</tr>';
        }

        function inArray(needle, haystack) {
            var length = haystack.length;
            for (var i = 0; i < length; i++) {
                if (haystack[i] == needle) return true;
            }
            return false;
        }
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
                        <h2 class="content-header-title float-left mb-0">Flash Sale</h2>
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Flash Sale</a>
                                </li>
                                <li class="breadcrumb-item active"><a href="#">Add New Sale</a>
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
            <!-- Basic Vertical form layout section start -->
            <section id="basic-vertical-layouts">
                <div class="row match-height justify-content-md-center">
                    {{-- <div class="col-md-2 col-6"></div> --}}
                    <div class="col-md-8  col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Create New Sale</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row m-0">
                                                <form action="{{route('admin.flash-sales.update',$flashSale->id)}}" class="form form-vertical" method="POST" enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    <div class="card">
                                                        <div class="form-body">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label for="name-vertical">Flash Sale Title</label>
                                                                        <input type="text" class="form-control" name="flash-sale" placeholder="Flash Sale Title" value="{{$flashSale->title}}" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label for="start_time-vertical">Start Time</label>
                                                                        <input type="text" id="start_time-vertical" class="form-control pickadate" name="start_time" placeholder="Flash Sale Start Time" value="{{$flashSale->start_time->format('d M, Y')}}" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label for="wend_timet-vertical">End Time</label>
                                                                        <input type="text" id="end_time-vertical" class="form-control pickadate" name="end_time" placeholder="Flash Sale End Time" value="{{$flashSale->end_time->format('d M, Y')}}" required>
                                                                    </div>
                                                                </div>
                                                                {{-- <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label for="Keyword-vertical">Keyword</label>
                                                                            <input type="text" name="keywords" class="form-control tagin"  value="" data-placeholder="Add new Featured Products... (then press comma)" data-duplicate="true">
                                                                        </div>
                                                                </div> --}}
                                                                @isset($products)  
                                                                    <div class="col-12">
                                                                        <div class="text-bold-600 font-medium-2">
                                                                            Add Feature Products
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <select class="select2 form-control" multiple="multiple" id="default-select-multi">
                                                                                @foreach ($products as $product)
                                                                                <option value="$product->id">{{$product->name}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                @endisset

                                                                <div class="col-12">
                                                                 <button type="button" class="btn btn-outline-warning " data-toggle="modal" data-target="#large">
                                                                    Add Feature Products
                                                                </button>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <button type="submit" value="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
                                                        <button type="reset" class="btn btn-outline-warning mr-1 mb-1">Reset</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>



            <!-- Modal -->
            
                <div class="modal fade text-left" id="large" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel17">Large Modal</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                
                                <!-- Add rows table -->
                                        <section id="add-row">
                                            <div class="row">
                                                
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                           
                                                            <h4 class="card-title">Add Products To Rows</h4>
                                                        </div>
                                                        <div class="card-content">
                                                            <div class="card-body">
                                                                 <div class="input-group input-group form-group">
                                                                <input id="search-input-field " type="text" name="search" class="form-control no_border_radius"
                                                                    placeholder="Keyword"
                                                                    value="{{ request()->search }}" onkeypress="if(event.keyCode == 13) {getSearchResult()}">
                                                                                    <span class="input-group-btn">
                                                                                        <button class="btn btn-default" onclick="getSearchResult()"><i
                                                                                                    class="fa fa-search"></i></button>
                                                                                    </span>
                                                                    </div>
                                                                <p class="card-text">
                                                                    New rows can be added to a DataTable very easily using the ( row.add() ) API method. Simply call the API function with the data that is to be used for the new row (be it an array or object). Multiple rows can be added using the ( rows.add() ) method (note the plural). Data can be likewise be updated with the ( row().data() and row().remove() methods. )
                                                                </p>

                                                                <button id="addRow" class="btn btn-primary mb-2"><i class="feather icon-plus"></i>&nbsp; Add new row</button>

                                                                <div class="table-responsive ">
                                                                    <table class="table add-rows">
                                                                            <thead>
                                                                            <th>Product Name</th>
                                                                            <th>Action</th>
                                                                            </thead>

                                                                            <tbody id="search-result-table-body">
                                                                               
                                                                             
                                                                            </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                <!--/ Add rows table -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Accept</button>
                            </div>
                        </div>
                    </div>
                </div>

            <!-- // Basic Vertical form layout section end -->
        </div>
    </div>
</div>
<!-- END: Content-->
@endsection
