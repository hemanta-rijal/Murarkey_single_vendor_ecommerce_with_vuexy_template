@extends('user.company.layout')

@section('sub-sub-content')
    <div class="prod_side_box_top p-l-15 p-t-15">
        <div class="row">
            <div class="col-md-12">
                <h3 class="col_title p-t-50">Product Showcase</h3>
                <p class="black">Please Select 5 Products to be featured and shown in your Company's Homepage</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7">
            </div>
            <div class="col-md-5">
                <div class="searchbox">
                    <form method="GET">
                        <div class="input-group input-group-sm">
                            <input name="search" type="text" class="form-control no_border_radius"
                                   placeholder="Please Enter a Product Name">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button"><i
                                                        class="fa fa-search"></i></button>
                                        </span>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <div class="prod_side_box_bottom p-12 m-t-15">
        <div class="row">
            <div class="col-md-6">

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

                    <table class="table table-responsive">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Seller <i class="fa fa-sort m-l-12"></i></th>
                            <th>Last Updated <i class="fa fa-sort m-l-12"></i></th>
                            <th>Status</th>
                            <th>Featured?</th>
                        </tr>
                        </thead>

                        <tbody>

                        @foreach($products as $product)
                            <tr>
                                <td>

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
                                <td>Rs.{{ $product->price }}
                                    <br>/{{ $product->unit_type }}
                                </td>
                                <td>{{ $product->seller_id ? $product->seller->name : '-' }}</td>

                                <td>{{ formatDateString($product->updated_at, 'd/m/Y') }}</td>
                                <td>{{ $product->formated_status }}</td>

                                <td>
                                    <div class="yes_no space_around">
                                        <button onclick="updateFeaturedItem(1, {{ $product->id }})" class="btn {{ $product->featured ? 'btn-info' : 'cs_btn' }}">Yes</button>
                                        <button onclick="updateFeaturedItem(0, {{ $product->id }})" class="btn {{ !$product->featured ? 'btn-info' : 'cs_btn' }}">No</button>
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
                                        <li class="active"><a href="#" style="">{!! $products->currentPage() !!}</a></li>

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

                                            <button type="submit" class="btn go_btn fix_this_go">Go</button>
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

    {{ Form::open(['method' => 'put' , 'id' => 'update-form']) }}
    {{ Form::hidden('product_id', null, ['id' => 'input-product-id']) }}
    {{ Form::hidden('featured', null, ['id' => 'input-featured']) }}
    {{ Form::close() }}
@endsection

@section('sub-scripts')
    <script>
        var can_add_featured_item = {{ get_featured_product_count() < 5 ? 1: 0 }};

        function updateFeaturedItem(value, product_id) {
            $('#input-product-id').val(product_id);
            $('#input-featured').val(value);
            if (can_add_featured_item || !value)
                $('#update-form').submit();
            else
                alert('You have already selected 5 products to be shown in your company\'s page');
        }
    </script>
@endsection

