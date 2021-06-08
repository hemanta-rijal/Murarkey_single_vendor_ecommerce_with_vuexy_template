@extends('frontend.layouts.app')
@section('meta')
    {{-- @include('frontend.partials.ogForIndexPage') --}}
@endsection
@section('body')
       <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="breadcrumb-text">
              <a href="#"><i class="fa fa-home"></i> Home</a>
              <span>Shop</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Breadcrumb Section Begin -->
    <!-- Product Shop Section Begin -->
    <section class="product-shop spad">
      <div class="container">
        <div class="row">
          <div
            class="
              col-lg-3 col-md-6 col-sm-8
              order-2 order-lg-1
              produts-sidebar-filter
            "
          >
            <div class="filter-widget">
              <h4 class="fw-title">Currency Selector</h4>

              <div id="currency-selector">
                <select>
                  <option
                    value="yt"
                    data-image="{{asset('frontend/img/flag-1.jpg')}}"
                    data-title="Nepalese"
                  >
                    Nepalese
                  </option>
                  <option
                    value="yu"
                    data-image="{{asset('frontend/img/flag-2.jpg')}}"
                    data-title="Australian"
                  >
                    Australian
                  </option>
                </select>
              </div>
            </div>

            <div id="brands-filter" class="filter-widget">
              <h4 class="fw-title">Fiter by Brands</h4>
              <div class="fw-brand-check viewParent">
                <div class="bc-item">
                  <label for="bc-diesel">
                    Biotique
                    <input type="checkbox" id="bc-diesel" />
                    <span class="checkmark"></span>
                  </label>
                </div>
                <div class="bc-item">
                  <label for="bc-polo">
                    Polo
                    <input type="checkbox" id="bc-polo" />
                    <span class="checkmark"></span>
                  </label>
                </div>
                <div class="bc-item">
                  <label for="bc-tommy">
                    Tommy Hilfiger
                    <input type="checkbox" id="bc-tommy" />
                    <span class="checkmark"></span>
                  </label>
                </div>
              </div>
            </div>

            <div id="categories-filter" class="filter-widget">
              <h4 class="fw-title">Fiter by Categories</h4>
              <div class="fw-cat-check viewParent">
                <div class="bc-item">
                  <label for="bc-hair">
                    Hair
                    <input type="checkbox" id="bc-hair" />
                    <span class="checkmark"></span>
                  </label>
                </div>

                <div class="bc-item">
                  <label for="bc-hands">
                    Hands
                    <input type="checkbox" id="bc-hands" />
                    <span class="checkmark"></span>
                  </label>
                </div>

                <div class="bc-item">
                  <label for="bc-himalaya">
                    Himalaya
                    <input type="checkbox" id="bc-himalaya" />
                    <span class="checkmark"></span>
                  </label>
                </div>

                <div class="bc-item">
                  <label for="bc-lips">
                    Lips
                    <input type="checkbox" id="bc-lips" />
                    <span class="checkmark"></span>
                  </label>
                </div>

                <div class="bc-item">
                  <label for="bc-shampoo">
                    shampoo
                    <input type="checkbox" id="bc-shampoo" />
                    <span class="checkmark"></span>
                  </label>
                </div>
              </div>
            </div>

            <div class="filter-widget">
              <h4 class="fw-title">Price</h4>
              <div class="filter-range-wrap">
                <div class="range-slider">
                  <div class="price-input">
                    <input type="text" id="minamount" />
                    <input type="text" id="maxamount" />
                  </div>
                </div>
                <div
                  class="
                    price-range
                    ui-slider
                    ui-corner-all
                    ui-slider-horizontal
                    ui-widget
                    ui-widget-content
                  "
                  data-min="33"
                  data-max="98"
                >
                  <div
                    class="ui-slider-range ui-corner-all ui-widget-header"
                  ></div>
                  <span
                    tabindex="0"
                    class="ui-slider-handle ui-corner-all ui-state-default"
                  ></span>
                  <span
                    tabindex="0"
                    class="ui-slider-handle ui-corner-all ui-state-default"
                  ></span>
                </div>
              </div>
              <a href="#" class="filter-btn">Filter</a>
            </div>

            <div class="filter-widget">
              <h4 class="fw-title">Tags</h4>
              <div class="fw-tags">
                <a href="#">Hair</a>
                <a href="#">Lips</a>
                <a href="#">Skin Care</a>
                <a href="#">Women</a>
                <a href="#">Men</a>
                <a href="#">Nails</a>
                <a href="#">grooming</a>
                <a href="#">Bridal</a>
                <a href="#">Healthy</a>
              </div>
            </div>
          </div>
          <div class="col-lg-9 order-1 order-lg-2">
            <div class="product-show-option">
              <div class="row">
                <div class="col-lg-5 col-md-5 text-left">
                  <p>Showing 12/200 Products</p>
                </div>
                <div class="col-lg-7 col-md-7">
                  <div class="select-option float-right">
                    <select class="sorting">
                      <option value="">Sort by latest</option>
                      <option value="">Sort by Price: high to low</option>
                      <option value="">Sort by Price: low to high</option>
                      <option value="">Sort by popularity</option>
                      <option value="">Sort by average rating</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="product-list">
              <div class="row">
                <div class="col-lg-4 col-sm-6">
                  <div class="product-item">

                    <div class="pi-pic">
                      <img src="{{asset('frontend/img/products/rustic5.jpg')}}" alt="" />
                      <div class="icon">
                        <i class="icon_heart_alt"></i>
                      </div>
                      <ul>
                        <li class="addtocart"><a href="">Add to Cart</a></li>
                      </ul>
                    </div>
                    <div class="pi-text">
                      <div class="catagory-name">Towel</div>
                      <a href="#">
                        <h5>
                          Rustic Art Juniper Lavender Shampoo For Men 175gms
                        </h5>
                      </a>
                      <div class="product-price">
                        Rs. 1200
                        <span>$35.00</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="loading-more">
              <i class="icon_loading"></i>
              <a href="#"> Loading More </a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Product Shop Section End -->
@endsection
