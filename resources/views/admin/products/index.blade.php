@extends('admin.layouts.app')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
@endsection
{{--@include('admin.partials.indexpage-includes')--}}
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.categories').select2();
            $('.brands').select2();
            $('.delete_all').on('click', function (e) {

                var allVals = [];
                $(".selected").each(function () {
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
                            success: function (data) {
                                if (data['success']) {
                                    window.location = '{{ route('admin.users.index') }}'
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

        function loadProduct(cb, searchBy) {
            let url_string = window.location.href;
            const urlObj = new URL(url_string);
            let searchParams = new URLSearchParams(urlObj.search);

            if (cb.type=='text' || cb.type.includes('select')) {
                searchParams.set(searchBy, cb.value)
                const new_url = searchParams.toString();
                window.location.href = url_string.split('?')[0] + '?' + new_url;
            }
            else {
                searchParams.delete(searchBy)
                const new_url = searchParams.toString();
                // window.location.href = url_string.split('?')[0] + '?' + new_url;
            }
        }
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
                            <h2 class="content-header-title float-left mb-0">Products</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ URL::to('/admin') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Products</a>
                                    </li>
                                    <li class="breadcrumb-item active">Products {{ $type ?? '' }} List
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrum-right">
                        <a href="{{ route('admin.products.create') }}"
                           class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle"><i
                                    class="feather icon-plus"></i> Add New</a>
                        <a href="{{ route('admin.products.import-export') }}"
                           class="btn-icon btn btn-warning btn-round btn-sm dropdown-toggle"><i
                                    class="feather icon-upload-cloud"></i> Import & Export</a>
                        <div class="dropdown">
                        </div>
                    </div>
                </div>
            </div>
            <section id="filter">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-2">
                                            <input type="text" class="form-control form-control" id="label-small"
                                                   placeholder="Product Name" name="search" value="{{request()->get('search')}}" onchange="loadProduct(this,'search')">
                                        </div>
                                        <div class="col-2">
                                            <select class="select2-size-sm categories form-control" onchange="loadProduct(this,'category')" id="small-select-category">
                                                <option value="">Select Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->slug}}" {{request()->get('category')==$category->slug ?'selected':''}}>{{strip_tags($category->name) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-2">
                                            <select class="select2-size-sm brands form-control" id="small-select-brands" onchange="loadProduct(this,'brand')">
                                                <option value="">Select Brand</option>
                                                @foreach($brands as $brand)
                                                    <option value="{{$brand->slug}}" {{request()->get('brand')==$brand->slug ?'selected':''}}>{{$brand->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-2">
                                            <select class="select2-size-sm form-control" id="small-select" onchange="loadProduct(this,'skin_tone')">
                                                <option value="">Skin Tone</option>
                                                @foreach(skin_type() as $skin_type)
                                                    <option value="{{Str::slug($skin_type)}}">{{$skin_type}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                         <div class="col-2">
                                            <select class="select2-size-sm form-control" id="small-select" onchange="loadProduct(this,'{{\App\Models\Product::SKIN_CONCERN}}')">
                                                <option value="">Skin Concern</option>
                                                @foreach(skin_concerns() as $skin_concern)
                                                    <option value="{{Str::slug($skin_concern)}}">{{$skin_concern}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-2">
                                            <select class="select2-size-sm form-control" id="small-select" onchange="loadProduct(this,'{{\App\Models\Product::PRODUCT_TYPE}}')">
                                                <option value="">Product Type</option>
                                                @foreach(product_types() as $product_type)
                                                    <option value="{{Str::slug($product_type)}}">{{$product_type}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section id="basic-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body card-dashboard">
                                    <div class="table-responsive">
                                        <table class="table zero-configuration">
                                            <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Price</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($products as $product)
                                                <tr data-id="{{ $product->id }}">
                                                    <td>
                                                        @if ($product->images->count())
                                                            <img class="media-object"
                                                                 src="{!! resize_image_url($product->images->first()->image, '50X50') !!}"
                                                                 alt="Image" height="50">
                                                    </td>
                                                    @endif
                                                    <td class="product-name">{!! $product->name !!} <a target="_blank"
                                                                                                       href="{!! route('products.show', $product->slug) !!}"><i
                                                                    class="fa fa-link"></i></a></td>
                                                    <td>Rs. {{ $product->price }}</td>
                                                    <td>
                                                        <span class="btn-sm btn-{{ $product->status == 'approved' ? 'primary' : ($product->status == 'pending' ? 'warning' : 'danger') }}"> {{ $product->status }}</span>
                                                    </td>
                                                    <td class="product-action">
                                                        <a href="{!! route('admin.products.show', $product->id) !!}">
                                                            <i class="feather icon-eye"></i>
                                                        </a>
                                                        <a href="{!! route('admin.products.edit', $product->id) !!}">
                                                            <i class="feather icon-edit"></i>
                                                        </a>
                                                        <a href="#"
                                                           onclick="confirm_modal('{{ route('admin.products.destroy', $product->id) }}')">
                                                            <i class="feather icon-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>

                                        </table>

                                        <div class="d-flex">
                                            <div class="mx-auto">
                                                {{ $products->links('pagination::bootstrap-4') }}
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
