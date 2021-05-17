@extends('user.layout')
@section('sub-styles')

@endsection

@section('sub-content')
    <div class="tab_filter_box p-0 bg_white">
        <div class="row m-0">
            <div class="col-md-2 p-r-0">
                <h3 class="col_title p-l-0 p-t-10 f-s-18 m-b-15">My Products</h3>
                <div class="categories_list">
                    <ul class="list_of_categ no_list_style color_inherit p-l-0">
                        <li class=""><a href="/user/products">All Product</a></li>
                        <li class=""><a href="/user/products/create">Post New Product</a></li>
                        <li class="active"><a href="/user/products/trash">Trash</a></li>
                    </ul>
                </div>
            </div>


            <div class="col-md-10 bg_white bl_dim p-0">
                <div class="prod_side_box_bottom p-12 m-t-15">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="" class="btn cs_btn m-0 bg_white" onclick="event.preventDefault();
                                    if (confirm('Are you sure? You can\'t recover product after it')) { document.getElementById('empty-trash-form').submit(); }">Empty
                                Trash</a>
                            {!! Form::open(['route' => ['user.products.empty-trash'], 'style' => 'display: none;', 'id' => "empty-trash-form", 'method'=> 'DELETE' ]) !!}
                            {!! Form::close() !!}
                        </div>
                        <div class="col-md-6">
                            <div class="flex_end">
                                <a href="" class="color_inherit m-r-10"><i class="fa fa-angle-left "></i></a>
                                <a href="" class="color_inherit coral"> 1</a>
                                <p class="m-b-0 m-l-10 m-r-10">/</p>
                                <a href="" class="color_inherit">1 </a>
                                <a href="" class="color_inherit m-l-10"><i class="fa fa-angle-right"></i></a>
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
                                        <th>Status <i class="fa fa-sort m-l-12"></i></th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($products as $product)
                                        <tr>
                                            <td>

                                            </td>
                                            <td>
                                                <div class="media">
                                                    <a class="pull-left" href="#">
                                                        <img class="media-object"
                                                             src="{!! resize_image_url($product->images->first()->image, '50X50') !!}"
                                                             alt="Image" height="50">
                                                    </a>
                                                    <div class="media-body">
                                                        <h5 class="media-heading"><a href="">{{ $product->name }}</a>
                                                        </h5>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>Rs. {{ $product->price }}
                                                <br> /piece
                                            </td>
                                            <td>{{ $product->seller? $product->seller->name: '-' }}</td>
                                            <td>{{ formatDateString($product->updated_at, 'd/m/Y') }}</td>
                                            <td>{{ $product->formated_status }}</td>
                                            <td>
                                                <div class="input-group-btn">
                                                    <a href="{{ route('user.products.recover', $product->id) }}"
                                                       class="btn btn-default" tabindex="-1">Recover
                                                    </a>
                                                </div>
                                           
                                                <div class="input-group-btn">
                                                    <a href="#" class="btn btn-default" tabindex="-1"
                                                       onclick="event.preventDefault();
                                                               document.getElementById('delete-form-{{ $product->id }}').submit();">Delete</a>
                                                    {!! Form::open(['route' => ['user.products.destroy', $product->id], 'style' => 'display: none;', 'id' => "delete-form-{$product->id}", 'method'=> 'DELETE' ]) !!}
                                                    {!! Form::hidden('force',1) !!}
                                                    {!! Form::close() !!}
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
                                                    <li class="active"><a href="#" style="">1</a></li>

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

                                                        <button type="submit" class="btn">Go</button>
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
@endsection

