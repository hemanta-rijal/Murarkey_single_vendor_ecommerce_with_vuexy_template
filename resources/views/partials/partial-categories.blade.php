@foreach(get_categories_tree() as $mainCategory)
    <li class="dropdown">
        <a href="#" data-toggle="dropdown"><p class="overflow_fix">{!! $mainCategory->name !!}</p>
            @if($mainCategory->children->count() > 0)
                <i
                        class="fa fa-angle-right show_icon pull-right f-s-20"></i>
            @endif
            <span class="clearfix"></span>
        </a>
    @if($mainCategory->children->count() > 0)
        <!-- mega menu container -->
            <ul class="dropdown-menu mega-menu-container">
                <li>
                    <div class="mega-menu-content">

                        @foreach($mainCategory->children->take(6)->chunk(3) as $subCategoryItems)
                            <div class="row">
                                @foreach($subCategoryItems as $subCategory)
                                    <div class="col-md-4 col-sm-6">
                                        <a href="{{ products_search_route($subCategory->slug) }}"><h5 class="menu-heading">{!! $subCategory->name !!}</h5></a>
                                        <ul class="list-unstyled list-menu">
                                            @foreach($subCategory->children->take(6) as $subSubCategory)
                                                <li>
                                                    <a href="{{ products_search_route($subSubCategory->slug) }}">{!! $subSubCategory->name !!}</a>
                                                </li>
                                            @endforeach
                                            @if($subCategory->children->count() > 6)
                                                <li><a href="/categories?category={{ $mainCategory->slug }}" class="pcolor">View More</a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </li>
            </ul>

    @endif
    <!-- end mega menu container -->
    </li>
@endforeach
<li class="all_categ p-t-9 p-b-9"><a href="/categories"
                                     class="pcolor f-s-14">All
        Categories <i class="fa fa-angle-right"></i></a></li>