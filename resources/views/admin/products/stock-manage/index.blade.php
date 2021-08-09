@extends('admin.layouts.app')
@include('admin.partials.indexpage-includes')


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
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Products</a>
                                    </li>
                                    <li class="breadcrumb-item active">Products {{ $type ?? ''}} List
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrum-right">
                        <button onclick="editproductstocks()" class="btn-icon btn btn-primary "> Edit Stocs</button>
                      
                    </div>
                </div>
            </div>
            <section id="basic-datatable">
                <div class="row">
                    <div class="col-10">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body card-dashboard">
                                    {{-- <p class="card-text">DataTables has most features enabled by default, so all you need to do to use it with your own ables is to call the construction function: $().DataTable();.</p> --}}
                                    <div class="box-inline mar-btm pull-right">
                                        {{-- <form action="{{route('admin.product.manage-stock.index','filterby=name')}}"></form> --}}
                                        Sort by:
                                        <div class="select">
                                            <input type="text" name="search_by" id="filterby" />
                                            {{-- <select id="filterby" class="demo-select2 select2-hidden-accessible" name="category_id" required="" tabindex="-1" aria-hidden="true">
                                                <option value="name">Name</option>
                                                <option value="sku">SKU</option>
                                            </select> --}}
                                            <button class="btn-icon btn btn-primary btn-sm" onclick="filterTable()"> Filter</button>
                                        </div>
                                        </div>
                                    <div class="table-responsive">
                                        <table class="table zero-configuration">
                                            <thead>
                                                <tr>
                                                        <th>Name</th>
                                                        <th>SKU</th>
                                                        <th>Stock</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <form action="{{route('admin.product.manage-stock.update')}}" method="POST">
                                                    @csrf
                                                    @foreach ($products as $product)
                                                    <tr data-id="{{$product->id}}">
                                                            <td>{{$product->name}}</td>
                                                            <td> {{ $product->sku }}</td>
                                                            <td>
                                                                <input class="form-control sku" type="number"  name="stock_units[{{$product->id}}]" value="{{$product->total_product_units}}" disabled  style="width: 80px;"/>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                                
                                            </table>
                                            <div class="pull-right">
                                                <button type="submit" class="btn-icon btn btn-primary "> Update All</button>
                                            </div>
                                        </form>
                                        <div class="d-flex">
                                            <div class="mx-auto">
                                                {{$products->links("pagination::bootstrap-4")}}
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
<!-- END: Content-->

<script>
    function editStocks(){
        alert('here')
    }
</script>
@endsection


