@extends('layouts.app')
@section('styles')

@endsection


@section('title')
    All Categories - Kabmart
@endsection

@section('content')
    @include('partials.header')
    <section id="pum_all_categories">
        <div class="container">
            <div class="box_all_cat">
                <div class="row m-0">
                    <div class="col-md-3">
                        <h3 class="col_title p-l-19">All Categories</h3>
                        <div class="categories_list">
                            <ul class="list_of_categ">
                                @foreach($tree as $mainCategory)
                                    <li class="{!! ($loop->first && !request('category')) || request('category') == $mainCategory->slug? 'active' : '' !!}">
                                        <a
                                                href="#category-{!! $mainCategory->id !!}" class="main-category"
                                                role="tab"
                                                data-toggle="tab">{!! $mainCategory->name !!}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="tab-content col-md-9 bg_white bl_dim p-b-70">
                        @foreach($tree as $mainCategory)
                            <div role="tabpanel"
                                 class="tab-pane {!! ($loop->first && !request('category')) || request('category') == $mainCategory->slug? 'active' : '' !!}"
                                 id="category-{!! $mainCategory->id !!}">
                                <a href="/products/search?category={{ $mainCategory->slug }}">
                                    <h3 class="col_title p-l-19 pcolor">{!! $mainCategory->name !!}</h3>
                                </a>

                                @foreach($mainCategory->children->chunk(2) as $subCategoryItems)
                                    <div class="row">
                                        @foreach($subCategoryItems as $subCategory)
                                            <div class="col-md-6">
                                                <div class="sub_box">
                                                    <a href="{{ products_search_route($subCategory->slug) }}"><h4
                                                                class="small_title">{!! $subCategory->name !!}</h4></a>
                                                    <div class="row">
                                                        @foreach($subCategory->children->chunk(get_dividing_number($subCategory->children->count())) as $items)
                                                            <ul class="col-md-6 no_list_style color_inherit">
                                                                @foreach($items as $subSubCategory)
                                                                    <li>
                                                                        <a href="{{ products_search_route($subSubCategory->slug) }}">{!! $subSubCategory->name !!}</a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $('.main-category').click(function () {
            $(this).clooset('li').addClass('active');
        });
    </script>

@endsection