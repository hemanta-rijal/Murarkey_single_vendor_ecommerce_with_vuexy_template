@extends('layouts.app')

@section('content')
    @include('partials.header')
    <!-- logo, search, myaccount -->

    {{--  @include('partials.categories', ['showBreadCrumb' => true])  --}}

    {{-- new sidebar filter section --}}
    <section id="filter">
        <div class="container">
            <div class="row">


                <div class="col-3">
                    <div class="filter-option my-5">
                        <div class="related-categories filter-col p-3">
                            <div class="filter-title">
                                <h6>Related Categories</h6>
                            </div>

                            @foreach ($categories->take(1) as $category)
                                <div class="list">
                                    <ul>
                                        <a {!! $category->active ? 'style="color:blue"' : ''  !!} href="">
                                            <li>
                                                {{$category->name}}
                                            </li>
                                        </a>
                                    </ul>
                                    <ul>
                                        @foreach ($category->children as $subCategory)
                                            <li>
                                                <a {!! $subCategory->active ? 'style="color:blue"' : ''  !!}
                                                   href="?{!! http_build_query(array_merge(request()->except('page', 'category'), ['category' => $subCategory->slug])) !!}">
                                                    {{ $subCategory->name }}
                                                    @if(request()->is('products/*'))
                                                        ({{ $subCategory->_product_count }} )
                                                    @endif
                                                </a>
                                                </a>
                                            </li>

                                            @foreach ($subCategory->children as $subSubCategory)
                                                <li>
                                                    <a {!! $subSubCategory->active ? 'style="color:blue"' : ''  !!}
                                                       href="?{!! http_build_query(array_merge(request()->except('page', 'category'), ['category' => $subSubCategory->slug])) !!}">
                                                        {{ $subSubCategory->name }}
                                                        @if(request()->is('products/*'))
                                                            ({{ $subSubCategory->_product_count }} )
                                                        @endif
                                                    </a>
                                                    </a>
                                                </li>
                                            @endforeach

                                        @endforeach
                                    </ul>

                                </div>

                            @endforeach
                            <a class="expand-button mt-2"> View More </a>
                        </div>
                        {{--  Brand Filter  --}}
                        {{--  <div class="brand filter-col p-3">
                          <div class="filter-title">
                            <h6>Brand</h6>
                          </div>
                          <div class="brand-form">
                            <form>
                              <div class="form-check">
                                <input
                                  class="form-check-input"
                                  type="checkbox"
                                  id="inlineCheckbox1"
                                  value="option1"
                                  checked
                                />
                                <label class="form-check-label" for="inlineCheckbox1"
                                  >Samsung</label
                                >
                              </div>
                              <div class="form-check">
                                <input
                                  class="form-check-input"
                                  type="checkbox"
                                  id="inlineCheckbox2"
                                  value="option2"
                                />
                                <label class="form-check-label" for="inlineCheckbox2"
                                  >Nokia</label
                                >
                              </div>

                              <div class="form-check">
                                <input
                                  class="form-check-input"
                                  type="checkbox"
                                  id="inlineCheckbox3"
                                  value="option3"
                                />
                                <label class="form-check-label" for="inlineCheckbox3"
                                  >Huawei</label
                                >
                              </div>

                              <div class="form-check">
                                <input
                                  class="form-check-input"
                                  type="checkbox"
                                  id="inlineCheckbox4"
                                  value="option4"
                                />
                                <label class="form-check-label" for="inlineCheckbox4"
                                  >xiaomi</label
                                >
                              </div>

                              <div class="form-check">
                                <input
                                  class="form-check-input"
                                  type="checkbox"
                                  id="inlineCheckbox5"
                                  value="option5"
                                />
                                <label class="form-check-label" for="inlineCheckbox5"
                                  >Colors</label
                                >
                              </div>

                              <div class="form-check">
                                <input
                                  class="form-check-input"
                                  type="checkbox"
                                  id="inlineCheckbox6"
                                  value="option6"
                                />
                                <label class="form-check-label" for="inlineCheckbox6"
                                  >recci</label
                                >
                              </div>

                              <div class="form-check">
                                <input
                                  class="form-check-input"
                                  type="checkbox"
                                  id="inlineCheckbox7"
                                  value="option7"
                                />
                                <label class="form-check-label" for="inlineCheckbox7"
                                  >Hoco</label
                                >
                              </div>

                              <div class="form-check">
                                <input
                                  class="form-check-input"
                                  type="checkbox"
                                  id="inlineCheckbox8"
                                  value="option8"
                                />
                                <label class="form-check-label" for="inlineCheckbox8"
                                  >Vivo</label
                                >
                              </div>
                              <div class="form-check">
                                <input
                                  class="form-check-input"
                                  type="checkbox"
                                  id="inlineCheckbox9"
                                  value="option9"
                                />
                                <label class="form-check-label" for="inlineCheckbox9"
                                  >Oppo</label
                                >
                              </div>
                            </form>
                          </div>
                          <a class="brand-expand mt-3"> View More </a>
                        </div>  --}}

                        {{--  Lower Upper price Filter  --}}
                        <div class="price filter-col p-3">
                            <div class="filter-title">
                                <h6>price</h6>
                            </div>
                            <div class="price-form">
                                <form class="form-inline">
                                    @foreach(request()->except('page') as $key => $value)
                                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                    @endforeach
                                    <input
                                            id="input"
                                            type="number"
                                            class="form-control"
                                            name="lower_price"
                                            value="{{ request('lower_price') }}"
                                            placeholder="min"
                                    />
                                    <span><i class="fas fa-minus"></i></span>
                                    <input
                                            id="input"
                                            type="number"
                                            class="form-control"
                                            name="upper_price"
                                            value="{{ request('upper_price') }}"
                                            placeholder="max"
                                    />
                                    <button type="submit" style="border:transparent; background:transparent;">
                                        <a href="">
                                            <i class="fas fa-caret-square-right mt-2">
                                            </i>
                                        </a>
                                    </button>
                                </form>
                            </div>
                        </div>

                        {{--  <div class="service filter-col p-3">
                          <div class="filter-title">
                            <h6>Services</h6>
                          </div>
                          <div class="service-form">
                            <form>
                              <div class="form-check">
                                <input
                                  class="form-check-input"
                                  type="checkbox"
                                  id="cash"
                                  value="option10"
                                />
                                <label class="form-check-label" for="cash"
                                  >cash on delivery</label
                                >
                              </div>
                              <div class="form-check">
                                <input
                                  class="form-check-input"
                                  type="checkbox"
                                  id="free"
                                  value="option11"
                                />
                                <label class="form-check-label" for="free"
                                  >Free shipping</label
                                >
                              </div>
                            </form>
                          </div>
                        </div>  --}}

                        <div class="rating filter-col p-3">
                            <div class="filter-title">
                                <h6>rating</h6>
                            </div>
                            <div class="rating">
                                <div class="rate-5">
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                </div>

                                <div class="rate-4">
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star"></i>
                                </div>

                                <div class="rate-3">
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>

                                <div class="rate-2">
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>

                                <div class="rate-5">
                                    <i class="fa fa-star checked"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                            </div>
                        </div>

                        {{--  <div class="warranty filter-col p-3">
                          <div class="filter-title">
                            <h6>warranty type</h6>
                          </div>
                          <div class="warranty-form">
                            <form>
                              <div class="form-check">
                                <input
                                  class="form-check-input"
                                  type="checkbox"
                                  id="nowarranty"
                                  value="option12"
                                />
                                <label class="form-check-label" for="nowarranty"
                                  >No warranty</label
                                >
                              </div>
                              <div class="form-check">
                                <input
                                  class="form-check-input"
                                  type="checkbox"
                                  id="brandwarranty"
                                  value="option13"
                                />
                                <label class="form-check-label" for="brandwarranty"
                                  >Brand Warranty</label
                                >
                              </div>

                              <div class="form-check">
                                <input
                                  class="form-check-input"
                                  type="checkbox"
                                  id="local"
                                  value="option14"
                                />
                                <label class="form-check-label" for="local"
                                  >Local Seller Warranty</label
                                >
                              </div>

                              <div class="form-check">
                                <input
                                  class="form-check-input"
                                  type="checkbox"
                                  id="original"
                                  value="option15"
                                />
                                <label class="form-check-label" for="original"
                                  >100% Original Product</label
                                >
                              </div>

                              <div class="form-check">
                                <input
                                  class="form-check-input"
                                  type="checkbox"
                                  id="nonlocal"
                                  value="option16"
                                />
                                <label class="form-check-label" for="nonlocal"
                                  >Non-Local Warranty</label
                                >
                              </div>
                            </form>
                          </div>
                        </div>  --}}

                        {{--  <div class="color filter-col p-3">
                          <div class="filter-title">
                            <h6>color &amp; family</h6>
                          </div>
                          <div class="color-form">
                            <form>
                              <div class="form-check">
                                <input
                                  class="form-check-input"
                                  type="checkbox"
                                  id="black"
                                  value="option35"
                                />
                                <label class="form-check-label" for="black">Black</label>
                              </div>
                              <div class="form-check">
                                <input
                                  class="form-check-input"
                                  type="checkbox"
                                  id="silver"
                                  value="option36"
                                />
                                <label class="form-check-label" for="silver"
                                  >silver</label
                                >
                              </div>

                              <div class="form-check">
                                <input
                                  class="form-check-input"
                                  type="checkbox"
                                  id="blue"
                                  value="option37"
                                />
                                <label class="form-check-label" for="blue">blue</label>
                              </div>

                              <div class="form-check">
                                <input
                                  class="form-check-input"
                                  type="checkbox"
                                  id="gold"
                                  value="option38"
                                />
                                <label class="form-check-label" for="gold">gold</label>
                              </div>

                              <div class="form-check">
                                <input
                                  class="form-check-input"
                                  type="checkbox"
                                  id="multi"
                                  value="option39"
                                />
                                <label class="form-check-label" for="multi"
                                  >multicolor</label
                                >
                              </div>

                              <div class="form-check">
                                <input
                                  class="form-check-input"
                                  type="checkbox"
                                  id="brown"
                                  value="option40"
                                />
                                <label class="form-check-label" for="brown">brown</label>
                              </div>

                              <div class="form-check">
                                <input
                                  class="form-check-input"
                                  type="checkbox"
                                  id="pink"
                                  value="option41"
                                />
                                <label class="form-check-label" for="pink">pink</label>
                              </div>

                              <div class="form-check">
                                <input
                                  class="form-check-input"
                                  type="checkbox"
                                  id="red"
                                  value="option42"
                                />
                                <label class="form-check-label" for="red">red</label>
                              </div>
                              <div class="form-check">
                                <input
                                  class="form-check-input"
                                  type="checkbox"
                                  id="white"
                                  value="option43"
                                />
                                <label class="form-check-label" for="white">white</label>
                              </div>
                            </form>
                          </div>
                          <a class="color-expand mt-3"> View More </a>
                        </div>  --}}

                        {{--  <div class="body filter-col p-3">
                          <div class="filter-title">
                            <h6>body type</h6>
                          </div>
                          <div class="body-form">
                            <form>
                              <div class="form-check">
                                <input
                                  class="form-check-input"
                                  type="checkbox"
                                  id="plastic"
                                  value="option16"
                                />
                                <label class="form-check-label" for="plastic"
                                  >Plastic</label
                                >
                              </div>
                              <div class="form-check">
                                <input
                                  class="form-check-input"
                                  type="checkbox"
                                  id="glass"
                                  value="option17"
                                />
                                <label class="form-check-label" for="glass">Glass</label>
                              </div>

                              <div class="form-check">
                                <input
                                  class="form-check-input"
                                  type="checkbox"
                                  id="metal"
                                  value="option18"
                                />
                                <label class="form-check-label" for="metal">Metal</label>
                              </div>

                              <div class="form-check">
                                <input
                                  class="form-check-input"
                                  type="checkbox"
                                  id="ceramic"
                                  value="option19"
                                />
                                <label class="form-check-label" for="ceramic"
                                  >Ceramic</label
                                >
                              </div>
                            </form>
                          </div>
                        </div>  --}}

                        {{--  <div class="charge filter-col p-3">
                          <div class="filter-title">
                            <h6>fast charging</h6>
                          </div>
                          <div class="charge-form">
                            <form>
                              <div class="form-check">
                                <input
                                  class="form-check-input"
                                  type="checkbox"
                                  id="yes"
                                  value="option20"
                                />
                                <label class="form-check-label" for="yes">yes</label>
                              </div>
                              <div class="form-check">
                                <input
                                  class="form-check-input"
                                  type="checkbox"
                                  id="no"
                                  value="option21"
                                />
                                <label class="form-check-label" for="no">no</label>
                              </div>
                            </form>
                          </div>
                        </div>  --}}

                        {{--  <div class="display filter-col p-3">
                          <div class="filter-title">
                            <h6>display size</h6>
                          </div>
                          <div class="display-form">
                            <form>
                              <div class="form-check">
                                <input
                                  class="form-check-input"
                                  type="checkbox"
                                  id="ten"
                                  value="option22"
                                />
                                <label class="form-check-label" for="ten">10 inch</label>
                              </div>
                              <div class="form-check">
                                <input
                                  class="form-check-input"
                                  type="checkbox"
                                  id="seven"
                                  value="option23"
                                />
                                <label class="form-check-label" for="seven">7 inch</label>
                              </div>

                              <div class="form-check">
                                <input
                                  class="form-check-input"
                                  type="checkbox"
                                  id="eight"
                                  value="option24"
                                />
                                <label class="form-check-label" for="eight">8 inch</label>
                              </div>

                              <div class="form-check">
                                <input
                                  class="form-check-input"
                                  type="checkbox"
                                  id="ten.1"
                                  value="option25"
                                />
                                <label class="form-check-label" for="ten.1"
                                  >10.1 inch</label
                                >
                              </div>
                            </form>
                          </div>
                        </div>  --}}

                        {{--  <div class="storage filter-col p-3">
                          <div class="filter-title">
                            <h6>storage capcity</h6>
                          </div>
                          <div class="storage-form">
                            <form>
                              <div class="form-check">
                                <input
                                  class="form-check-input"
                                  type="checkbox"
                                  id="16"
                                  value="option26"
                                />
                                <label class="form-check-label" for="16">16 GB</label>
                              </div>
                              <div class="form-check">
                                <input
                                  class="form-check-input"
                                  type="checkbox"
                                  id="32"
                                  value="option27"
                                />
                                <label class="form-check-label" for="32">32 GB</label>
                              </div>

                              <div class="form-check">
                                <input
                                  class="form-check-input"
                                  type="checkbox"
                                  id="64"
                                  value="option28"
                                />
                                <label class="form-check-label" for="64">64 GB</label>
                              </div>

                              <div class="form-check">
                                <input
                                  class="form-check-input"
                                  type="checkbox"
                                  id="128"
                                  value="option29"
                                />
                                <label class="form-check-label" for="128">128 GB</label>
                              </div>
                            </form>
                          </div>
                        </div>  --}}

                        {{--  <div class="processor filter-col p-3">
                          <div class="filter-title">
                            <h6>Processor core</h6>
                          </div>
                          <div class="processor-form">
                            <form>
                              <div class="form-check">
                                <input
                                  class="form-check-input"
                                  type="checkbox"
                                  id="quad"
                                  value="option30"
                                />
                                <label class="form-check-label" for="quad"
                                  >Quad core</label
                                >
                              </div>
                              <div class="form-check">
                                <input
                                  class="form-check-input"
                                  type="checkbox"
                                  id="octa"
                                  value="option31"
                                />
                                <label class="form-check-label" for="octa"
                                  >Octa core</label
                                >
                              </div>

                              <div class="form-check">
                                <input
                                  class="form-check-input"
                                  type="checkbox"
                                  id="tencore"
                                  value="option32"
                                />
                                <label class="form-check-label" for="tencore"
                                  >10 core</label
                                >
                              </div>
                            </form>
                          </div>
                        </div>  --}}

                        {{--  <div class="resolution p-3">
                          <div class="filter-title">
                            <h6>Display resolution</h6>
                          </div>
                          <div class="resolution-form">
                            <form>
                              <div class="form-check">
                                <input
                                  class="form-check-input"
                                  type="checkbox"
                                  id="reso1"
                                  value="option33"
                                />
                                <label class="form-check-label" for="reso1"
                                  >1920 * 1200</label
                                >
                              </div>
                              <div class="form-check">
                                <input
                                  class="form-check-input"
                                  type="checkbox"
                                  id="reso2"
                                  value="option34"
                                />
                                <label class="form-check-label" for="reso2"
                                  >1280 * 800</label
                                >
                              </div>
                            </form>
                          </div>
                        </div>  --}}

                    </div>
                </div>

                {{-- middle section products part --}}
                <div class="col-9">
                    <div class="filter-product bg-white my-5">
                        @yield('sub-content')
                    </div>
                </div>

            </div>
        </div>
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
