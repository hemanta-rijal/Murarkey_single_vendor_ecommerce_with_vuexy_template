@extends('admin.layouts.app')
@section('css')

    <link rel="stylesheet" type="text/css"
          href="{{ asset('backend/app-assets/css/plugins/forms/validation/form-validation.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('backend/tagin-master/dist/css/tagin.css') }}"> --}}

    <link rel="stylesheet" type="text/css"
          href="{{ asset('backend/app-assets/vendors/css/forms/select/select2.min.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('backend/app-assets/vendors/css/pickers/pickadate/pickadate.css') }}">

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

        function generateCouponCode() {
            var randomString = function (length) {
                var text = "";
                var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
                for (var i = 0; i < length; i++) {
                    text += possible.charAt(Math.floor(Math.random() * possible.length));
                }
                return text;
            }
            // random string length
            var random = randomString(10);
            // insert random string to the field
            $('#couponField').val(random);

        }
    </script>
    <script>
        var searchResult = [];
        var product_ids = {!! json_encode(get_product_ids_from_coupons($coupon->items)) !!};

        // alert(product_ids);

        function removeProduct(id, product_id) {
            var index = product_ids.indexOf(product_id);
            product_ids.splice(index, 1);
            $('#old-item-' + id).remove();
            $('#edit-form').append('<input type="hidden" name="remove_item[]" value="' + id + '">');
        }

        function updateDiscountedPrice(id, price) {

            var discount_type = document.getElementById('discount_type_' + id);
            console.log(discount_type.value);
            var discount_id = 'discount_' + id;

            var discount = document.getElementById(discount_id).value;
            var discount = parseInt(discount);
            var discounted_price_id = '#discounted_price_' + id;
            if (discount_type.value == 'percentage') {
                var discounted_price = (price - (price * discount / 100)).toFixed(2);
                $(discounted_price_id).val(discounted_price);
            }
            if (discount_type.value == 'price') {
                var discounted_price = (price - discount).toFixed(2);
                $(discounted_price_id).val(discounted_price);
            }

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
                '<input type="hidden" name="products[' + index + '][product_id]" value="' + product.id + '">' +
                '<td>' + product.name + '</td>' +
                '<td><button class="btn btn-danger" onclick="removeNewlyAdded(' + product.id + ')">Remove</button>' +
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
    {{-- {{dd($coupon)}} --}}
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Coupon</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Coupon</a>
                                    </li>
                                    <li class="breadcrumb-item active"><a href="#">Update Coupon</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                @include('admin.partials.view-all-include',['route' =>'admin.coupons.index'])
            </div>
            <div class="content-body">
                <!-- Basic Vertical form layout section start -->
                <section id="basic-vertical-layouts">
                    <div class="row match-height justify-content-md-center">
                        {{-- <div class="col-md-2 col-6"></div> --}}
                        <div class="col-md-8  col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Update Coupon</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="row m-0">
                                            <form id="edit-form" action="{{route('admin.coupons.update',$coupon->id)}}"
                                                  class="form form-vertical" method="POST"
                                                  enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                @method('put')
                                                <div class="card">
                                                    <div class="form-body">
                                                        <div class="row">
                                                            <div class="col-8">
                                                                <div class="form-group">
                                                                    <label for="name-vertical">Coupon Code</label>
                                                                    <input type="text" class="form-control"
                                                                           name="coupon" placeholder="Coupon Code"
                                                                           id="couponField" value="{{$coupon->coupon}}"
                                                                           required>
                                                                </div>
                                                            </div>
                                                            <div class="col-4 ">
                                                                <div class="form-group">
                                                                    <label for="name-vertical"></label>
                                                                    <button type="button"
                                                                            class="form-control btn btn-info"
                                                                            onclick="generateCouponCode()">Generate
                                                                        Cupon
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="price-vertical">Discount Type</label>
                                                                    <select type="text" id="discount-vertical"
                                                                            class="form-control" name="discount_type"
                                                                            placeholder="Discount type" required>
                                                                        <option value="price"{{$coupon->discount_type=='price' ? 'selected': ''}}>
                                                                            Price
                                                                        </option>
                                                                        <option value="percentage" {{$coupon->discount_type=='percentage' ? 'percentage': ''}}>
                                                                            Percentage
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="price-vertical">Discount</label>
                                                                    <input type="text" id="price-vertical"
                                                                           class="form-control" name="discount"
                                                                           placeholder="Discount"
                                                                           value="{{$coupon->discount}}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="start_time-vertical">Start Time</label>
                                                                    <input type="text" id="start_time-vertical"
                                                                           class="form-control pickadate"
                                                                           name="start_time"
                                                                           placeholder="Coupon Validation Start Time"
                                                                           value="{{$coupon->start_time}}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="wend_timet-vertical">End Time</label>
                                                                    <input type="text" id="end_time-vertical"
                                                                           class="form-control pickadate"
                                                                           name="end_time"
                                                                           placeholder="Coupon Validation End Time"
                                                                           value="{{$coupon->end_time}}" required>
                                                                </div>
                                                            </div>

                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="wend_timet-vertical">Active</label>
                                                                    <div class=" custom-control custom-switch switch-lg custom-switch-success mr-2 mb-1">
                                                                        <input type="hidden" name="status"
                                                                               class="custom-control-input form-control"
                                                                               value="0">
                                                                        <input type="checkbox" name="status"
                                                                               class="custom-control-input form-control"
                                                                               id="customSwitch100"
                                                                               value="1" {{$coupon->status==true? 'checked' : ''}} >
                                                                        <label class="custom-control-label"
                                                                               for="customSwitch100">
                                                                            <span class="switch-text-left">Active</span>
                                                                            <span class="switch-text-right">In-Active</span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-12">
                                                            <button type="button" class="btn btn-outline-warning "
                                                                    data-toggle="modal" data-target="#large">
                                                                Add Feature Products
                                                            </button>
                                                        </div>

                                                        <br>

                                                        <div>
                                                            <table class="table table-stripped">
                                                                <thead>
                                                                <th>Product Name</th>
                                                                <th>Action</th>
                                                                </thead>
                                                                <tbody id="featured-products-tbody">
                                                                {{-- {{dd($coupon->items)}} --}}
                                                                @foreach($coupon->items as $item)
                                                                    <tr id="old-item-{{ $item->id }}">
                                                                        <td>
                                                                            <a href="{{ route('products.show', $item->product->slug) }}"
                                                                               target="_blank">{{ $item->product->name }}</a>
                                                                        </td>
                                                                        <input type="hidden"
                                                                               name="products[{{ $loop->index }}][id]"
                                                                               value="{{ $item->id }}"
                                                                               class="form-control">
                                                                        <td>
                                                                            <button class="btn btn-danger"
                                                                                    onclick="removeProduct({{ $item->id }},{{ $item->product->id }})">
                                                                                Remove
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach

                                                                </tbody>
                                                            </table>
                                                        </div>

                                                    </div>
                                                </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" value="submit" class="btn btn-primary mr-1 mb-1">
                                                Submit
                                            </button>
                                            <button type="reset" class="btn btn-outline-warning mr-1 mb-1">Reset
                                            </button>
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

            <div class="modal fade text-left" id="large" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel17">Add Feature Products</h4>
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
                                                {{-- <h4 class="card-title">Add Feature Products On The Table</h4> --}}
                                                <p>Search here product by name and add them for further update. After
                                                    adding <b>close</b> this modal or click <b>Done</b>Button at last
                                                    corner. </p>
                                            </div>
                                            <div class="card-content">
                                                <div class="card-body">
                                                    <div class="input-group input-group form-group">
                                                        <input id="search-input-field " type="text" name="search"
                                                               class="form-control no_border_radius"
                                                               placeholder="Keyword"
                                                               value="{{ request()->search }}"
                                                               onkeypress="if(event.keyCode == 13) {getSearchResult()}">
                                                        <span class="input-group-btn">
                                                                                        <button class="btn btn-default"
                                                                                                onclick="getSearchResult()"><i
                                                                                                    class="fa fa-search"></i></button>
                                                                                    </span>
                                                    </div>

                                                    <div class="table-responsive" style="height:350px;overflow: scroll">
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
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Done</button>
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
