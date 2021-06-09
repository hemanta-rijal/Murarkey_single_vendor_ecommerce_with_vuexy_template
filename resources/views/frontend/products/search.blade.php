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
            @isset($brands)
               {{-- {{dd(request()->except('page'))}} --}}
            <div id="brands-filter" class="filter-widget">
              <h4 class="fw-title">Fiter by Brands</h4>
              <div class="fw-brand-check viewParent">
                @foreach ($brands->take(5) as $brand)
                <div class="bc-item">
                  <label for="bc-diesel">
                    {{$brand->name}}
                    <a href="?{!! http_build_query(array_merge(request()->except('page', 'brand'), ['brand' => $brand->slug])) !!}">
                    <input type="checkbox" id="bc-diesel" {{in_array($brand->slug,request()->except('page')) ? 'checked' : ''}} />
                    <span class="checkmark">
                    </span>
                  </a>
                  </label>
                </div>
                @endforeach
              </div>
            </div>
            @endisset
             
        </span>
            <div id="categories-filter" class="filter-widget">
              <h4 class="fw-title">Fiter by Categories</h4>
              <div class="fw-cat-check viewParent">
                {{-- {{dd(request()->except('page'))}} --}}
                @foreach ($categories as $category)
                    <div class="bc-item">
                      <label for="bc-{{$category->slug}}">
                        {{$category->name}}
                        <a href="?{!! http_build_query(array_merge(request()->except('page', 'category'), ['category' => $category->slug])) !!}">
                          <input type="checkbox" {{in_array($category->slug,request()->except('page')) ? 'checked' : ''}} id="bc-{{$category->slug}}" />
                          <span class="checkmark"></span>
                        </a>
                      </label>
                    </div>
                    
                @endforeach
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
              <button class="filter-btn" onclick="priceFilter()">Filter</button>
              {{-- <a  class="filter-btn"  href="">Filter</a> --}}
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
           @if($products->count() > 0)
            <div class="product-list">
              <div class="row">
                @foreach ($products->take(6) as $product)
                <div class="col-lg-4 col-sm-6">
                  <div class="product-item">
                    {{-- {{dd($product->slug)}} --}}
                     <a href="{{ route('products.show', $product->slug) }}">
                      <div class="pi-pic">
                        <img src="{{resize_image_url($product->images->first()->image, '200X200')}}" alt="{{$product->name}}" />
                        <div class="icon">
                          <i class="icon_heart_alt"></i>
                        </div>
                        <ul>
                          <li class="addtocart"><a href="">Add to Cart</a></li>
                        </ul>
                      </div>
                      </a>
                      <div class="pi-text">
                        <div class="catagory-name">{{str_limit($product->name, 30)}}</div>
                        <a href="#">
                          <h5>
                            Rustic Art Juniper Lavender Shampoo For Men 175gms
                          </h5>
                        </a>
                        <div class="product-price">
                          Rs. {{$product->price}}
                          <span>$ {{$product->price}}</span>
                        </div>
                      </div>
                    </div>
                  </div>
                    @endforeach
              </div>
            </div>
             @else
            <div class="no_results">
                No results found. Please try your search again
            </div>
          @endif
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

@section('js')
      <script>

       function priceFilter() {
           var min=$('#minamount').val();
           var min=min.substring(1);
           
           var max = $('#maxamount').val();
           var max=max.substring(1);

          let url_string = window.location.href;
          let url = new URL(url_string);
          let params = new URLSearchParams(url.search);
          // alert(params);
          // console.log(url_string.includes('?'))
          if(url_string.includes("lower_price")==false && url_string.includes("upper_price")==false){
              params.set('lower_price',min);
              params.set('upper_price',max);
              // window.location.href= window.location.href+'?'+params.toString();
              var new_url = params.toString();
               window.location.href= url_string.split('?')[0]+'?'+new_url;
           }else{
            if(params.has('lower_price') && params.has('upper_price')){
                  params.set('lower_price',min);
                  params.set('upper_price',max);
                  //  params = params.toString();
                    var new_url = params.toString();
                  window.location.href= url_string.split('?')[0]+'?'+new_url;
            }
           }
         

          // if(url_string.includes("upper_price")==false){
          //     params.set('upper_price',max);
          //     window.location.href= window.location.href+'?'+params.toString();
          
          // }else{
          //     console.log(params.has('lower_price'))
          //     if(params.has('lower_price')){
          //         params.set('lower_price',min)
          //         var new_url = params.toString();
          //         console.log(new_url);
          //         // window.location.href=
          //         window.location.href= url_string.split('?')[0]+'?'+new_url;
          //     }
          // }
        }

          // function priceFilter(){
        //   var min=$('#minamount').val();
        //   var max = $('#maxamount').val();
        //   alert(min);
        //     window.location.href = window.location.href + '?'+ http_build_query(array_merge(request()->except('page', 'upper_price','lower_price'), ['lower_price' =>33 'lower_price' => 500));
        // }

      // $("#useHeader").load("index.html .header-section");
      // $("#useFooter").load("index.html .footer-section");

      // const brands = [
      //   "Agaro",
      //   "Biotique",
      //   "Brylcreem",
      //   "Garnier",
      //   "Head & Shoulder",
      //   "Herbal Essence",
      //   "Himalaya",
      //   "Indulekha",
      //   "Innisfree",
      //   "L'oreal",
      //   "Lotus Herbals",
      //   "ORIFLAME",
      //   "Pantene",
      //   "Rustic Art",
      //   "Streax",
      //   "Tresemme",
      //   "Unilever",
      //   "Vaseline",
      //   "Wella",
      // ];

      // brands.map((brand) => {
      //   let id = `bc-${brand}`;
      //   const template = `
      //               <div class="bc-item">
      //               <label for=${id}>
      //               ${brand}
      //               <input type="checkbox" id="${id}" />
      //               <span class="checkmark"></span>
      //             </label>
      //           </div>`;
      //   const brandList = document.getElementById("brands-filter");
      //  brandList.querySelector("div.fw-brand-check").innerHTML += template;
      // });

      // const Products = [
      //   {
      //     id: 012,
      //     title: "Rustic Art Coconut Nectar Baby Shampoo 175gms",
      //     price: 750,
      //     img: "img/products/rustic1.jpg",
      //   },
      //   {
      //     id: 012,
      //     title: "Rustic Art Charcoal Shampoo 175gms",
      //     price: 1200,
      //     img: "img/products/rustic2.jpg",
      //   },
      //   {
      //     id: 012,
      //     title: "Rustic Art Cinnamon Rosemary Shampoo Butter 100gms",
      //     price: 1050,
      //     img: "img/products/rustic3.jpg",
      //   },
      //   {
      //     id: 012,
      //     title: "Rustic Art Yarrow Moringa Shampoo Butter 100gms",
      //     price: 550,
      //     img: "img/products/rustic4.jpg",
      //   },
      //   {
      //     id: 012,
      //     title:
      //       "Rustic Art Neem Leaf Hair Cleansing Bar (Shampoo Bar) For Babies & Kids 75gms",
      //     price: 750,
      //     img: "img/products/rustic5.jpg",
      //   },
      //   {
      //     id: 012,
      //     title: "Rustic Art Juniper Lavender Shampoo For Men 175gms",
      //     price: 1200,
      //     img: "img/products/rustic6.jpg",
      //   },
      //   {
      //     id: 017,
      //     title: "Rustic Art Rose Geranium Shampoo",
      //     price: 1050,
      //     img: "img/products/rustic7.jpg",
      //   },
      //   {
      //     id: 017,
      //     title: "Rustic Art Aloe Clary Sage Shampoo",
      //     price: 1050,
      //     img: "img/products/rustic8.jpg",
      //   },
      // ];

      // Products.map(({ title, price, img }) => {
      //   const template = `
      //           <div class="col-lg-4 col-sm-6">
      //             <div class="product-item">
      //               <div class="pi-pic">
      //                 <img src=${img} alt="" />
      //                 <div class="sale pp-sale">Sale</div>
      //                 <div class="icon">
      //                   <i class="icon_heart_alt"></i>
      //                 </div>
      //                 <ul>

      //                   <li class="addtocart"><a href="#">Add to Cart</a></li>

      //                 </ul>
      //               </div>
      //               <div class="pi-text">
      //                 <div class="catagory-name">Shampoo</div>
      //                 <a href="#">
      //                   <h5>${title}</h5>
      //                 </a>
      //                 <div class="product-price">
      //                  ${"Rs. " + price}
      //                   <span>Rs 35.00</span>
      //                 </div>
      //               </div>
      //             </div>
      //           </div>
      //   `;
      //   const productList = document.querySelector("div.product-list .row");
      //   productList.innerHTML += template;
      // });



      // only for dev purpose
      window.setTimeout(() => {
        $(".search-type-selector:visible").niceSelect();
      }, 600);

      $('.addtocart').click(function(e){
        e.preventDefault()
        //alert("hii");
        Swal.fire({
        position: "center",
        icon: "success",
        title: "Item added to cart",
        showConfirmButton: false,
        timer: 1500,
      });
      })
    </script>
@endsection