@extends('layouts.app')

@section('content')
    @include('partials.header')
    <!-- logo, search, myaccount -->

    @include('partials.categories', ['showBreadCrumb' => true])
    <style type="text/css">
        .panel {
            box-shadow: none;
        }

        ul.nav-tabs li.active a {

            border: 1px solid #d4d0d0 !important;
            border-bottom: 1px solid #fff !important;
        }

        .collapse_panel {
            box-shadow: none;
        }

        .collapse_panel .panel-body {
            padding: 0;
            padding-left: 12px;
        }

        .panel-group .panel {
            box-shadow: none;
        }

        .filter-item a:hover {
            text-decoration: none;
            color: #1f72f0;
        }

        .remove_category_filter {
            background: transparent;
            border: 1px solid #DDDDDD;
        }

        .remove_category_filter:hover {
            background: transparent;
            border: 1px solid #dddddd;
        }

        .remove_category_filter:active {
            background: transparent;

            border: 1px solid #dddddd;
        }

        .hactive {
            color: #1f72f0 !important;
        }
    </style>

    <section id="product_search" class="m-b-0 p-b-60" style="background: #fff">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <!--revised search filter-->


                    <section class="filters">
                        <div class="filter-item">
                            <!--        Related category title-->
                            <h2 class="f-s-18">Related Category</h2>

                            @if(request()->search)
                                <p class="include-overflow-css">Search result for: <br>
                                    <span style="color: black;max">"{{ request()->search }}"</span></p>
                            @endif


                        <!--        remove category filter-->
                            @if(request()->get('category') && request()->get('search'))
                                <a href="?{!! http_build_query(request()->except('category')) !!}"
                                   class="btn btn-primary remove_category_filter m-b-20"><i
                                            class="fa fa-times m-r-5 m-l-5"></i>Remove category filter</a>
                            @endif

                            @foreach($categories->chunk(2) as $categoryList)

                                @foreach($categoryList as $category)
                                    <div class="categories-filter-list" {!! !$loop->parent->first? 'style="display:none;"': '' !!} >
                                        <h3>{{ $category->name }}</h3>
                                        <ul class="list-unstyled p-l-0">
                                            @foreach($category->children as $subCategory)
                                                <li>
                                                    <div class="panel-group m-b-4">
                                                        <div class="panel">
                                                            <div class="panel-heading"
                                                                 style="padding: 0;padding-left: 12px;">
                                                                <h4 class="panel-title f-s-14">
                                                                    <a data-toggle="collapse" data-parent="#accordion"
                                                                       aria-expanded="false"
                                                                       href="#parentOne-{{ $subCategory->id }}"
                                                                       class="collapsed"> {{ $subCategory->name }}
                                                                        <span>@if(request()->is('products/*'))
                                                                                ({{ $subCategory->_product_count }})
                                                                            @endif
                                                                        </span></a>
                                                                </h4>
                                                            </div>

                                                            <div id="parentOne-{{ $subCategory->id }}"
                                                                 class="panel-collapse {{ in_array(true, $subCategory->children->pluck('active')->toArray())? '' : 'collapse'  }}"
                                                                 aria-expanded="false"
                                                                 style="{{ (request('category'))? '': 'height: 0px' }}">
                                                                <div class="panel-body"
                                                                     style="padding: 0;padding-left: 21px;">
                                                                    <!--sub divisions here-->
                                                                    @foreach($subCategory->children as $subSubCategory)
                                                                        <div class="panel-group m-b-4 m-t-4" id="">
                                                                            <div class="panel collapse_panel">
                                                                                <div class="panel-heading"
                                                                                     style="padding:0;">
                                                                                    <h4 class="panel-title f-s-14">
                                                                                        <a {!! $subSubCategory->active ? 'style="color:blue"' : ''  !!}
                                                                                           href="?{!! http_build_query(array_merge(request()->except('page', 'category'), ['category' => $subSubCategory->slug])) !!}">-{{ $subSubCategory->name }} 
                                                                                           @if(request()->is('products/*'))
                                                                                                ({{ $subSubCategory->_product_count }} ) 
                                                                                            @endif
                                                                                        </a>
                                                                                    </h4>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                @endforeach


                                                                <!--sub divisions here-->


                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endforeach

                            @endforeach

                        </div>

                        @if($categories->count() > 2)
                            <button id="see-more-btn" class="btn cs_btn m-0 p-0 see_more_cat"
                                    style="background: transparent; border: 0;color: #1f73f0;"
                                    onclick="showAllCategories()"><i class="fa fa-plus m-r-5"></i>see more categories
                            </button>
                        @endif

                    </section>


                </div>
                <div class="col-md-10">
                    <!-- BASIC TAB -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="{{ request()->is('products*')? 'active' : ''}}"><a
                                    href="/products/search?{{ http_build_query(request()->all()) }}">Products</a></li>
                   <!--      <li class="{{ request()->is('companies*')? 'active' : ''}}"><a
                                    href="/companies/search?{{ http_build_query(request()->all()) }}">Suppliers</a></li> -->
                    </ul>
                    <div class="tab-content">
                        @yield('sub-content')
                    </div>
                    <!-- END BASIC TAB -->
                </div>
            </div>
        </div>
        @if(auth()->check())
            <div id="app">
                <chat-app :chat_data="chatAppData"></chat-app>
            </div>
            <audio id="message-notification" src="/assets/sounds/message-beep.mp3" autostart="false"></audio>
        @endif
    </section>
@endsection


@section('scripts')
    <script src="/assets/js/clipboard.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#pum_list').click(function (event) {
                event.preventDefault();
                setViewTypeInUrl('list');

                $('#listwala').removeClass('no_display');
                $('#gridwala').addClass('no_display');
            });
            $('#pum_grid').click(function (event) {
                event.preventDefault();
                setViewTypeInUrl('grid');

                $('#gridwala').removeClass('no_display');
                $('#listwala').addClass('no_display');
            });
        });

        function setViewTypeInUrl(type) {
            $('.pagination a').each(function (index, item) {
                var jItem = $(item);
                var url = jItem.attr('href');
                var anti_type = type == 'grid' ? 'list' : 'grid';
                if (url !== '#') {
                    if (url.search('view_type=') == -1) {
                        url = url + '&view_type=' + type;
                    } else if (url.search('view_type=' + type) == -1) {
                        url = url.replace('view_type=' + anti_type, 'view_type=' + type);
                    }
                    jItem.attr('href', url);
                }
            });
        }
    </script>
    <script>

        $('.see_more_cat').on('click', function () {
            $('.toggleblock').toggle();
        })

        function clickLink(url) {
            window.location.replace(url);
        }

        function showAllCategories() {
            $('.categories-filter-list').show();
            $('#see-more-btn').hide();
        }

        function copy_it(text) {
            clipboard.copy({
                "text/plain": text
            });
        }

    </script>
    @include('partials.chat-box-scripts')
@endsection
