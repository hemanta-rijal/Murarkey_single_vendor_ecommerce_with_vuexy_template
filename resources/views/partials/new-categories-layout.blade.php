<div class="navbar newnavbar">

        <div class="dropdown p-10">
            <a id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="#" class="newcat">
               <i class="fa fa-list-ul pull-left m-r-11 respon_top_fix white" ></i> Categories <span class="caret"></span>
            </a>
            <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                @foreach(get_categories_tree() as $category)
                    <li class=" {{ $category->children->count() > 0 ? 'dropdown-submenu' : '' }}">
                        <a tabindex="-1" href="{{ products_search_route($category->slug) }}">{{ $category->name }}</a>

                        @if($category->children->count() > 0)
                            <ul class="dropdown-menu">
                                @foreach($category->children as $subCategory)
                                    <li class="{{ $subCategory->children->count() > 0 ? 'dropdown-submenu' : '' }}">
                                        <a href="{{ products_search_route($subCategory->slug) }}">{{ $subCategory->name }}</a>
                                        @if($subCategory->children->count() > 0)
                                            <ul class="dropdown-menu">
                                                @foreach($subCategory->children as $subSubCategory)
                                                    <li>
                                                        <a href="{{ products_search_route($subSubCategory->slug) }}">{{ $subSubCategory->name }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
                <li class="all_categ p-t-9 p-b-9"><a href="/categories" class="pcolor f-s-14">All Categories</a></li>
            </ul>
        </div>
</div>