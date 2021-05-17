@extends('user.layout')

@section('title')
    My Products -Kabmart
@endsection

@section('sub-styles')

    <style type="text/css">

        .fa-sort {
            cursor: pointer;
        }

        .go_btn {
            height: 25px;
            border: 1px solid #cecece;
            padding: 2px 8px;
            background: #eeeeee;
            border-radius: 0;
            margin-left: 9px;
        }
    </style>
@endsection

@section('sub-content')

    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/v/dt/jq-2.2.4/dt-1.10.13/datatables.min.css"/>
    <div class="tab_filter_box p-0 bg_white">
        <div class="row m-0">
            <div class="col-md-2 p-r-0">
                <h3 class="col_title p-l-0 p-t-10 f-s-18 m-b-15">My Products</h3>
                <div class="categories_list">
                    <ul class="list_of_categ no_list_style color_inherit p-l-0">
                        <li class="active"><a href="/user/products">All Product</a></li>
                        <li class=""><a href="/user/products/create">Post New Product</a></li>
                        <li class=""><a href="/user/products/trash">Trash</a></li>
                    </ul>
                </div>
            </div>


            <div class="col-md-10 bg_white bl_dim p-0">
                <div class="prod_side_box_top p-l-15 p-t-15">
                    <div class="row">
                        <div class="col-md-7">
                            <ul class="p-t-10 prod_links display_inline p-l-0">
                                <li><a href="">All ({{ $products->total() }})</a></li>
                                <li><a href="?type=approved">Approved ({{ $count['approved'] }})</a></li>
                                <li><a href="?type=editing_required">Editing Required ({{ $count['editing_required'] }}
                                        )</a></li>
                                <li><a href="?type=pending">Approval Pending ({{ $count['pending'] }})</a></li>
                            </ul>
                        </div>
                        <div class="col-md-5">
                            <div class="searchbox">
                                <form method="GET">
                                    <div class="input-group input-group-sm">
                                        <input type="text" class="form-control no_border_radius"
                                               placeholder="Please Enter a Product Name" name="search">
                                        <span class="input-group-btn">
<button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
</span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                        </div>
                    </div>
                </div>
                <div class="prod_side_box_bottom p-12 m-t-15">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="label_box">
                                <label class="">
                                    <input type="checkbox" value="item1" onclick="checkAllDeleteCheckbox()">
                                </label>
                            </div>

                            <button type="button" onclick="deleteMultipleItem()" class="btn cs_btn m-0 bg_white">
                                Delete
                            </button>
                        </div>
                        <div class="col-md-6">
                            <div class="flex_end">
                                <a href="{!! $products->previousPageUrl() !!}" class="color_inherit m-r-10"><i class="fa fa-angle-left "></i></a>
                                <a href="#" class="color_inherit coral">{{ $products->currentPage() }}</a>
                                <p class="m-b-0 m-l-10 m-r-10">/</p>
                                <a href="#" class="color_inherit">{{ $products->lastPage()  }}</a>
                                <a href="{!! $products->nextPageUrl() !!}" class="color_inherit m-l-10"><i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="row m-t-20">
                        <div class="col-md-12">
                            <div class="pum_table_wrapper">

                                <table class="table table-responsive" id="products-table">
                                    <thead>
                                    <tr>
                                        <th style="max-width:30px;">

                                        </th>
                                        <th>#</th>
                                        <th>Products</th>
                                        <th style="min-width: 107px;">Price</th>
                                        <th>Seller</th>
                                        <th>Last Updated</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        <th>Out of Stock</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($products as $product)
                                        <tr>
                                            <td class="sorting_1">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" class="delete-checkbox"
                                                               value="{{ $product->id }}">
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                {{ $product->id }}
                                            </td>
                                            <td>
                                                <div class="media">
                                                    <a class="pull-left"
                                                       href="{{ route('products.show', $product->slug) }}">
                                                        <img class="media-object"
                                                             src="{!! resize_image_url($product->images->first()->image, '50X50') !!}"
                                                             alt="Image" height="50">
                                                    </a>
                                                    <div class="media-body">
                                                        <h5 class="media-heading"><a
                                                                    href="{{ route('products.show', $product->slug) }}">{{ $product->name }}</a>
                                                        </h5>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>Rs. {{ $product->price }}
                                                <br> / {{ $product->unit_type }}
                                            </td>
                                            <td>{{ $product->seller_id ? $product->seller->name : '-' }}</td>
                                            <td>{{ formatDateString($product->updated_at, 'd/m/Y') }}</td>
                                            <td>{{ $product->formated_status }}</td>
                                            <td>
                                                <div class="input-group-btn">
                                                    <a href="{{ route('user.products.edit', $product->id) }}"
                                                       class="btn btn-default" tabindex="-1" style="height: 33px">Edit
                                                    </a>
                                                    <button type="button" class="btn btn-default dropdown-toggle"
                                                            data-toggle="dropdown" tabindex="-1" aria-expanded="false">
                                                        <span class="caret"></span>
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li><a href="#" onclick="event.preventDefault();
                                                                    document.getElementById('copy-form-{{ $product->id }}').submit();">Copy
                                                                to new
                                                                product</a></li>
                                                        <form id="copy-form-{{ $product->id }}"
                                                              action="{{ route('user.products.copy', $product->id) }}"
                                                              method="POST"
                                                              style="display: none;">
                                                            {{ csrf_field() }}
                                                        </form>
                                                        <li><a href="#" onclick="event.preventDefault();
                                                                    document.getElementById('delete-form-{{ $product->id }}').submit();">Delete</a>
                                                        </li>
                                                        {!! Form::open(['route' => ['user.products.destroy', $product->id], 'style' => 'display: none;', 'id' => "delete-form-{$product->id}", 'method'=> 'DELETE' ]) !!}
                                                        {!! Form::close() !!}
                                                    </ul>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="yes_no space_around">
                                                    <a onclick="updateOutOfStock(1, {{ $product->id }})"
                                                       class="btn {{ $product->out_of_stock ? 'btn-info' : 'cs_btn' }}">Yes</a>
                                                    <a onclick="updateOutOfStock(0, {{ $product->id }})"
                                                       class="btn {{ !$product->out_of_stock ? 'btn-info' : 'cs_btn' }}">No</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <section id="product_search" class="p-0">
                                <div class="tab-content">
                                    <div class="tab_filter_box no_border bottom_bar">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p>
                                                    <span {!! $perPage == 10 ? 'class="active"' : '' !!}><a
                                                                href="?per_page=10">10</a></span>
                                                    | <span {!! $perPage == 30 ? 'class="active"' : '' !!}><a
                                                                href="?per_page=30">30</a></span> |
                                                    <span {!! $perPage == 50 ? 'class="active"' : '' !!}><a
                                                                href="?per_page=50">50</a></span>
                                                </p>
                                            </div>
                                            <div class="col-md-8 flex_end">
                                                <ul class="pagination pagination-sm m-0">
                                                    <li class="{!! $products->currentPage() == 1?'disabled' :'' !!}">
                                                        <a href="{!! $products->previousPageUrl() !!}" class="p-t-2"><i
                                                                    class="fa fa-angle-left"></i><span
                                                                    class="sr-only">Previous</span></a></li>
                                                    <li class="active"><a href="#" style="">{{ $products->currentPage() }}</a></li>

                                                    <li class="{!! $products->hasMorePages() ?: 'disabled' !!}"><a
                                                                href="{!! $products->nextPageUrl() !!}"
                                                                class="p-t-2"
                                                                style="height:25px;">Next<span
                                                                    class="sr-only">Next</span></a></li>
                                                </ul>
                                                <div class="min_order pull-right">
                                                    <p class="m-r-10">Goto Page</p>
                                                    <form class="flex-start">
                                                        <input type="text" name="page" id="input"
                                                               class="form-control small_height_width" value=""
                                                               required="required" title="">
                                                        <input type="hidden" name="per_page" value="{!! $perPage !!}">
                                                        <input type="hidden" name="search"
                                                               value="{!! request()->search !!}">

                                                        <button type="submit" class="btn go_btn">Go</button>
                                                    </form>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
            <!-- col -->
        </div>
        <!-- row -->
    </div>

    <!--my products tab-->
    {{ Form::open(['method' => 'DELETE', 'url' => '/user/products', 'id' => 'multiple-delete-form']) }}
    {{ Form::hidden('id', null, ['id' => 'place-delete-item-id']) }}
    {{ Form::close() }}

    {{ Form::open(['method' => 'put' ,'url' => '/user/products/update-out-of-stock', 'id' => 'update-form']) }}
    {{ Form::hidden('product_id', null, ['id' => 'input-product-id']) }}
    {{ Form::hidden('out_of_stock', null, ['id' => 'input-out-of-stock']) }}
    {{ Form::close() }}
@endsection


@section('sub-scripts')
    <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#products-table').DataTable({
                "paging": false,
                "info": false,
                "searching": false,
                "columns": [
                    {"orderable": false},
                    {"orderable": false},
                    {"orderable": false},
                    null,
                    null,
                    null,
                    {"orderable": false},
                    null
                ]
            });
        });

        function deleteMultipleItem() {
            var id = [];
            $('.delete-checkbox:checked').each(function () {
                id.push($(this).val());
            });

            $('#place-delete-item-id').val(id);

            $('#multiple-delete-form').submit();

            console.log(id);
        }

        function checkAllDeleteCheckbox() {
            $('.delete-checkbox').click();
        }

        function updateOutOfStock(value, product_id) {
            $('#input-product-id').val(product_id);
            $('#input-out-of-stock').val(value);

            $('#update-form').submit();
        }
    </script>
@endsection
