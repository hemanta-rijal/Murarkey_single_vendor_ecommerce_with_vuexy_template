@extends('layouts.app')


@section('title')
    {{ $product->name }} On yeecomart.com
@endsection

@section('metas')
    <meta property="og:title" content="{{ $product->name }}">
    <meta name="og:description" content="{{ $product->description }}">
    <meta property="og:type" content="product"/>
    <meta property="og:image" content="{{ resize_image_url($product->featured_image,'600X600')  }}"/>
    <meta property="og:image:width" content="600"/>
    <meta property="og:image:height" content="600"/>
    <meta property="og:site_name" content="{{ $product->name. ' | '. get_meta_by_key('site_name') }}"/>
    <meta property="og:url" content="{{ route('products.show', $product->slug)}}"/>
    <meta property="amount" content="{{ $product->price }}"/>
    <meta property="og:price:standard_amount" content="{{ $product->price }}"/>
    <meta property="fb:app_id" content="{{ config('services.facebook.client_id') }}">
@endsection

@section('styles')

    @if(auth()->guest())
        <link rel="stylesheet" href="/assets/css/remodal.css">
        <link rel="stylesheet" href="/assets/css/remodal-default-theme.css">
    @endif

@endsection
@section('content')
    <!-- logo, search, myaccount -->
    @include('partials.header')
    <!-- logo, search, myaccount -->

    {{--  @include('partials.categories', ['showBreadCrumb' => true])  --}}
    <!--==============================
           BREADCUMB
     ==============================-->
     <section class="breadcumb-nav">
         <div class="container">
            <nav aria-label="breadcrumb" class="pt-3">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/">Home</a></li>
                  <li class="breadcrumb-item"><a href="{{products_search_route($product->category->slug)}}">{{$product->category->name}}</a></li>
                  {{--  <li class="breadcrumb-item"><a href="#">Tablets</a></li>  --}}
                  <li class="breadcrumb-item active" aria-current="page">{{str_limit($product->name,40)}}</li>
                </ol>
              </nav>
         </div>
     </section>
       <!--=====END OF BREADCUMB=====-->
   <!--==============================
           PRODUCT
     ==============================-->
     <section id="product" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 bg-white pb5">
                    <div class="row bg-white">
                        <div class="col-6">
                                <div id="slideshow" class="fullscreen">
                                    <!-- Below are the images in the gallery -->
                                    @foreach($product->images as $image)
                                        <div id="img-{{++$loop->index}}" data-img-id="{{$loop->index}}" class="img-wrapper {{$loop->first ? 'active' : ''}}" style="background-image:  '{{resize_image_url( str_replace('public','storage' , $image->image),'600X600')}} ">
                                        </div>
                                    @endforeach
                        
                                  <!-- Below are the thumbnails of above images -->
                                  <div class="thumbs-container bottom">
                                    <div id="prev-btn" class="prev">
                                      <i class="fa fa-chevron-left fa-2x ml-3"></i>
                                    </div>
                        
                                  <ul class="thumbs">
                                    @foreach($product->images as $image)  
                                        <li data-thumb-id="{{++$loop->index}}" class="thumb {{$loop->first ? 'active' : '' }}" style="background-image: url('/{{str_replace('public','storage' , $image->image)}} ')">
                                        </li>
                                    @endforeach
                                  </ul>
                        
                                    <div id="next-btn" class="next">
                                      <i class="fa fa-chevron-right fa-2x"></i>
                                    </div>
                                  </div>
                              </div>
                        </div>

                        <div class="col-6">
                            <div class="item-details mt-3">
                                <span id="heart">
                                    <a href="#" id="addToWishListAjax"  data-value="{{$product->id}}">
                                        <i id="heart-liked" class="far fa-heart"></i>
                                    </a>
                                    {{--  <a id="addToWishList" class="addToWishList" href="" onclick="document.getElementById('addToWishList').submit();"><i id="heart-liked" class="far fa-heart"></i></a>  --}}
                                </span>
                                <div class="product-title pt-5 pb-3">
                                    <h6 class="head">{{str_limit($product->name, 160)}}</h6>
                                    <div class="item-info">
                                        <p>Brand:<a href=""> {{$product->brand_name}}</a></p>
                                         <span>product id: {{$product->id}}</span>
                                    </div>

                                    <div class="row pt-1">
                                        <div class="col-auto mr-auto product-rating">
                                             @for($i = 0; $i < ceil($avgRating); $i++)
                                               <i class="fa fa-star checked "></i>
                                            @endfor

                                            @for($i = 0; $i < 5 - ceil($avgRating); $i++)
                                                <i class="fa fa-star"></i>
                                            @endfor
                                            <span>({{ $reviewInfo->sum('review_count') }})</span>
                                            
                                            <span class="item-info text-dark pl-3">(15 orders) |</span>
                                            <a href="" class="item-info"> {{ $reviewInfo->sum('review_count') }} Reviews</a>
                                        </div>
                                        <div class="col-auto">
                                           <a href="#" class="text-dark"><i class="fas fa-share-alt"></i></a>
                                          </div>
                                    </div>
                                </div>
                                <div class="price py-3 ">
                                    <h4 class="display-total">Rs. {{$product->price_after_discount}}</h4>
                                    <div class="row">
                                        @if($product->has_discount)
                                        <div class="col-auto mr-auto font-weight-bold">
                                            <span >Flash Sale Discount</span>
                                            <span class="discount">Rs. {{$product->price }}</span>
                                                <span class="discount-per">{{ $product->discount_price_percentage }}% Off</span>
                                            </div>
                                            @else
                                            <div class="col-auto mr-auto font-weight-bold">
                                                <span class="discount">Rs. {{$product->price}}</span>
                                                <span class="discount-per">{{ $product->discount_price_percentage }}% Off</span>
                                            </div>
                                        @endif
                                        <div class="col-auto font-weight-bold">
                                           <span>Availability :</span>
                                           <a href="">{{$product->out_of_stock ? 'Out Of Stock' : 'In Stock'}}</a>
                                        </div>
                                    </div>
                                </div>
                                
                                @if(count($product->available_colors))
                                    <div class="color pt-3">
                                        <span class="font-weight-bold">Color:</span>
                                         @foreach ($product->available_colors as $color)
                                            <span class="color-list">{{$color}}</span>
                                        @endforeach
                                    </div>
                                @endif
                                 <div class="quantity pt-3" onkeypress="return event.keyCode != 13;">
                                    <span class="font-weight-bold">Quantity</span>

                                     <input type='button' value='-' class='fas fa-minus ml-3 qtyminus' field='qty'/>
                                     <input type='number' name='qty' value='1' class='qty' id="qty-input-1"/>
                                     <input type='button' value='+' class='fas fa-plus ml-3 qtyplus' field='qty'/>



                                    {{-- <span class="minus-btn"><i class="fas fa-minus ml-3 qtyminus" field='qty' data-value="-"></i></span>
                                    <input type="number" name="qty" value="1" class="qty display-quantity" id="qty-input-1">
                                    <span class="plus-btn"><i class="fas fa-plus ml-3 qtyplus" field='qty' data-value="+"></i></span> --}}
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="product_image" value="{{$product->featured_image}}" id="product_image">
                                    <span class="availability">50 Pieces Available</span>
                                </div>

                                <div class="button pt-4">
                                    <a href="#" id="addToCartListAjax" class="addToCartList" data-value="{{$product->id}}">
                                        <button type="button" class="btn cart" id="addToCartList addToCartList"  data-value="{{$product->id}}" >Add to Cart</button>
                                    </a>
                                    <a href="#">
                                        <button type="button" class="btn buy">Buy Now</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class="shipping bg-white py-3">
                    <div class="delivery  px-3">
                        <div class="row pb-2">
                            <div class="col-auto mr-auto">
                              <span class="title">Delivery Option</span>
                            </div>
                            <div class="col-auto">
                                <i class="flaticon-information"></i>
                              </div>
                            </div>

                            <div class="row pb-2">
                                <div class="col-auto mr-auto">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span class="location">Sukhanagar-Butwal, Rupandehi</span>
                                </div>
                                <div class="col-auto">
                                    <a href="" class="change">Change</a>
                                  </div>
                                </div>

                                <div class="home-delivery pb-2">
                                    <i class="flaticon-gift pl-0"></i>
                                    <span class="title">Home Delivery</h6>
                                        <div class="row">
                                            <div class="col-auto mr-auto">
                                                <span class="days">With in {{ \Carbon\Carbon::now()->addDays(20)->format('jS F') }}</span>
                                            </div>
                                            <div class="col-auto">
                                                <h6>Rs.80</h6>
                                              </div>
                                            </div>
                                </div>
                                <div class="cash pb-2">
                                    <i class="fas fa-money-bill-wave"></i>
                                    <span class="title">Cash on delivery Available</span>
                                </div>
                    </div>

                    <div class="return-warranty px-3 py-4">
                        <div class="row pb-2">
                            <div class="col-auto mr-auto">
                              <span class="title">Return & warranty</span>
                            </div>
                            <div class="col-auto">
                                <i class="flaticon-information"></i>
                              </div>
                            </div>

                            <div class="warranty-details">
                                <p><i class="fas fa-check-square"></i>100% Authentic</p>
                                <p class="mt-1"><i class="fas fa-check-square"></i>14 days easy return</p>
                                <small class="text-muted">Change of mind is not applicable</small>
                                <p ><i class="flaticon-verified"></i>1 year warranty</p>
                            </div>
                    </div>

                    <div class="sold px-3 py-4">
                        <span class="title">Sold by:</span>
                        <a href="{{products_search_by_company($product->company->slug )}}" class="company">{{$product->company->name}}</a>
                        <p><a href="">View other products by this seller</a></p>
                    </div>

                </div>
            </div>
        </div>
     </section>
       <!--=====END OF PRODUCT=====-->


    <!--==============================
           PRODUCT DETAILS
     ==============================-->
     <section id="tabs" class="py-4">
        <div class="container">
            <div class="row bg-white px-3 pt-4">
                <div class="col-xs-12 ">
                    <nav>
                        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-details-tab" data-toggle="tab" href="#nav-details" role="tab" aria-controls="nav-details" aria-selected="true">Product Details</a>
                            <a class="nav-item nav-link" id="nav-specification-tab" data-toggle="tab" href="#nav-specification" role="tab" aria-controls="nav-specification" aria-selected="false">Specification</a>
                            <a class="nav-item nav-link" id="nav-delivery-tab" data-toggle="tab" href="#nav-delivery" role="tab" aria-controls="nav-delivery" aria-selected="false">Packing & Delivery</a>
                            <a class="nav-item nav-link" id="nav-review-tab" data-toggle="tab" href="#nav-review" role="tab" aria-controls="nav-review" aria-selected="false">Ratings & Reviews</a>
                            <a class="nav-item nav-link" id="nav-question-tab" data-toggle="tab" href="#nav-question" role="tab" aria-controls="nav-question" aria-selected="false">Question & Answer</a>
                        </div>
                    </nav>  
                        <div class="tab-content py-3 px-3 px-sm-0" id="nav-tab">
                            <div class="tab-pane fade show active" id="nav-details" role="tabpanel" aria-labelledby="nav-details-tab">            
                                <div class="item-intro mt-2">
                                    <h6>{{str_limit($product->name,160)}}</h6>
                                    <p>{!! $product->details !!}</p>
                                </div>
                            </div>

                            <div class="tab-pane fade show" id="nav-specification" role="tabpanel" aria-labelledby="nav-specification-tab">            
                                <div class="item-intro mt-2">
                                    <h6>{{str_limit($product->name,160)}}</h6>
                                </div>
                                    <div class="item-feature mt-4">
                                    <h6>Key Features</h6>
                                    <p>
                                        @if($product->brand_name)
                                                • Brand: {{$product->brand_name}} <br>
                                        @endif
                                        @if($product->model_number)
                                                • Model: {{$product->model_number}} <br>
                                        @endif
                                        @if($product->packing_details)
                                                • Packing: {{$product->packing_details}} <br>
                                        @endif
                                        @if($product->made_in)
                                                • Made In: {{$product->made_in_obj->name}} <br>
                                        @endif
                                        @if($product->assembled_in)
                                                • Assembled In: {{$product->assembled_in_obj->name}} <br>
                                        @endif
                                        @if($product->origin)
                                                • Place Of Origin: {{$product->origin->name}} <br>
                                        @endif
                                                {{--  {{dd($product->attributes)}}   --}}
                                        @if($product->attributes->count() > 0)
                                        @foreach ($product->attributes as $attribute)
                                            • {{ucfirst($attribute->key)}}: {{$attribute->value}} <br>
                                        @endforeach
                                        @endif

                                    </p>
                                </div>
                            </div>

                            <div class="tab-pane fade show" id="nav-delivery" role="tabpanel" aria-labelledby="nav-delivery-tab">            
                                <div class="item-intro mt-2">
                                    <p>Shipping/Delivery charge of Rs.80 will be levied at the time of delivery of
                                    the product to the customer.</p>
                                    <hr>
                                    <hr>
                                    <br>
                                    <p class="down_title black m-b-15">Delivery Time</p>
                                    <span>Your expected delivery will be within {{ \Carbon\Carbon::now()->addDays(20)->format('jS F') }}</span>
                                    <br>
                                    <hr>
                                    <div style=" padding:unset;!important">
                                    <p><strong>Disclaimer</strong></p>
                                    <ul>
                                        <li ><p> above mentioned time may be slightly different than prescribed.
                                            (Can be either earlier or late)</p>
                                        </li>
                                        <li><p>We ensure confirm delivery of the product once the order is
                                            confirmed.</p>
                                        </li>
                                    </ul>
                                    </div>
                                </div>
                            </div>
                            <!--==============================
                                RATINGS AND REVIEWS
                            ==============================-->
                            <div class="tab-pane fade show" id="nav-review" role="tabpanel" aria-labelledby="nav-review-tab">            
                                <div class="item-intro mt-2">
                                    <section id="reviews" class="py-5">
                                        <div class="container bg-white py-5">
                                            <div class="ratings pb-5">
                                                <h6  class="pl-5">Ratings & reviews</h6>
                                                <div class="row">
                                                    {{--  {{dd($avgRating,$reviewInfo)}}  --}}
                                                    <div class="col-lg-3 col-md-4 col-sm-4 mt-4">
                                                        <div class="circle-wrap">
                                                            <div class="circle mt-4">
                                                                {{--  <div class="mask full">
                                                                    <div class="fill"></div>
                                                                </div>
                                                                <div class="mask half">
                                                                    <div class="fill"></div>
                                                                </div>  --}}
                                                               
                                                            <div class="inside-circle"> {{ceil($avgRating)}}</div>
                                                            </div>
                                                        </div>
                                                        <div class="product-rating mt-4 text-center">
                                                            @for($i = 0; $i < ceil($avgRating); $i++)
                                                                <span class="fa fa-star checked"></span>
                                                            @endfor

                                                            @for($i = 0; $i < 5 - ceil($avgRating); $i++)
                                                                <span class="fa fa-star"></span>
                                                            @endfor
                                                            <span>({{ $reviewInfo->sum('review_count') }})</span>
                                                            
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6 col-md-6 col-sm-6 mx-auto mt-5">
                                                    @foreach ($reviewInfo as $review) 
                                                    <div class="progress">
                                                        <span class="rate">{{$review->rating}}<i class="fa fa-star "></i> </span>
                                                        <div class="progress-bar {{$review->rating==5 ? 'bg-green' : ( $review->rating==4 ? 'bg-yellow' : ( $review->rating==3 ? 'bg-blue' : ($review->rating==2 ? 'bg-pink' : ($review->rating==1 ? 'bg-red' : '') ) ) ) }}" role="progressbar" style="width: {{$review->rating*20}}%" aria-valuenow="{{$review->rating*20}}" aria-valuemin="0" aria-valuemax="100"></div>
                                                        <span class="number">{{$review->review_count}}</span>
                                                    </div>
                                                    @endforeach
                                                </div>

                                            </div>

                                            <div class="review-detail py-5">
                                                @foreach ($product->reviews->take(5) as $review)
                                                <div class="review-item pb-5">
                                                    <div class="row">
                                                        <div class="col-3">
                                                        <div class="user pl-5">
                                                            <div class="product-rating mb-2">
                                                                <span class="text-dark">{{$review->rating}}</span>
                                                                @for($i = 0; $i < ceil($review->rating); $i++)
                                                                    <span class="fa fa-star checked"></span>
                                                                @endfor

                                                                @for($i = 0; $i < 5 - ceil($review->rating); $i++)
                                                                    <span class="fa fa-star"></span>
                                                                @endfor
                                                                </div>
                                                                <h6>{{$review->user->name}}</h6>
                                                                <p>{{$review->created_at ? $review->created_at->diffForHumans('y-m-d') : ''}}</p>
                                                                <span class="mt-2"><i class="flaticon-verified"></i>Verified Buyer</span>
                                                            </div>
                                                        </div>
                                
                                                        <div class="col-3">
                                                            <p class="text-center">{{$review->comment}}</p>
                                                        </div>
                                
                                                        <div class="col-3">
                                                            <p class="text-center">Was this helpful?</p>
                                                        </div>
                                
                                                        <div class="col-3 text-center">
                                                            <span class="mr-3"><i class="far fa-thumbs-up mr-2"></i>Yes</span>
                                                            <span><i class="far fa-thumbs-down mr-2"></i>No</span>
                                                            </div>
                                
                                                        </div>
                                                </div>
                                                
                                                @endforeach

                                            </div>

                                        </div>
                                    </section> 
                                </div>
                            </div>
                            <!--=====END OF RATINGS AND REVIEWS=====-->

                            <div class="tab-pane fade show" id="nav-question" role="tabpanel" aria-labelledby="nav-question-tab">            
                                <div class="item-intro mt-2">
                                    <p class="down_title black m-b-15">Question and anser section</p>
                                    <span>Your expected delivery will be within {{ \Carbon\Carbon::now()->addDays(20)->format('jS F') }}</span>
                                    <br>
                                    <hr>
                                </div>
                            </div>
                        </div>                
                </div>
            </div>
        </div>
    </section>

<!--=====END OF PRODUCT DETAILS=====-->



    <!--==============================
           SIMILAR PRODUCTS
     ==============================-->
     <section id="similar" class="py-5">
        <div class="container bg-white py-4">
          <div class="row">
            <div class="col-auto mr-auto">
              <span class="font-weight-bold mt-2 head">Similar Products</span>
            </div>
            <div class="col-auto">
               <a href="#" class="link">View More</a>
              </div>
            </div>
            <div class="similar-item pt-4">
              <div class="row">
                @foreach (get_similar_products_for_product_page($product) as $sim_product)
                    <div class="col-lg-2 col-md-4 col-sm-12">
                    <div class="product-item">
                        <a href="{{route('products.show', $sim_product->slug)}}" target="_blank">
                        <img src="{{resize_image_url($sim_product->featured_image, '200X200')}}" alt="{{$sim_product->name}}">
                        <h6 class="info-title text-dark mt-3">{{str_limit($sim_product->name, 21)}}</h6>
                        <span class="product-price">Rs. {{$sim_product->minimum_price ?? $sim_product->price}}</span>
                        <span class="discount">Rs.{{$sim_product->price}}</span>
                        @if($sim_product->averageRating())
                        <div class="product-rating">
                            @for($i = 0; $i < ceil($sim_product->averageRating()); $i++)
                                <i class="fa fa-star checked"></i>
                            @endfor
                            @for($j = 0; $j < 5 - ceil($sim_product->averageRating()); $j++)
                                <i class="fa fa-star"></i>
                            @endfor
                            <span>({{$sim_product->reviewCount}})</span>
                        </div>
                        @endif
                            </a>
                        </div>
                    </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </section> 
    <!--=====END OF IMILAR PRODUCTS=====-->

    @if(auth()->check())
        <div id="app">
            <chat-app :chat_data="chatAppData"></chat-app>
        </div>
        <audio id="message-notification" src="/assets/sounds/message-beep.mp3" autostart="false"></audio>
    @else
        @include('partials.login')
    @endif
@endsection

@section('scripts')
    @if(auth()->check())
        {{-- <script type="text/javascript" src="{{ asset('js/app.js') }}"></script> --}}
        {{-- <script type="text/javascript" src="{{ asset('assets/ajax-upload/js/vendor/jquery.ui.widget.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/ajax-upload/js/jquery.iframe-transport.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/ajax-upload/js/jquery.fileupload.js') }}"></script> --}}
    @endif
    <script src="/assets/js/plugins/prettyphoto/jquery.prettyPhoto.min.js"></script>
    
    <script>
        var price = {{ $product->price_after_discount }};
        function submitCartForm() {
            document.getElementById('heart-liked').click()
        }

        function openModal(title, name) {
            $('#btn-modal-mbl').attr('name', name);
            $('#btn-modal-mbl').text(title)
            $('#myModal').modal('show')
        }

            // This button will increment the value
            $('.qtyplus').click(function (e) {
                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                fieldName = $(this).attr('field');

                // Get its current value
                var currentVal = parseInt($('input[name=' + fieldName + ']').val());
                // If is not undefined
                if (!isNaN(currentVal)) {
                    // Increment
                      $('input[name=' + fieldName + ']').val(currentVal + 1);
                } else {
                    // Otherwise put a 0 there
                    $('input[name=' + fieldName + ']').val(0);
                }
                console.log(fieldName,currentVal);
                calculate_and_display_qty_amount();
            });
            // This button will decrement the value till 0
            $(".qtyminus").click(function (e) {
                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                fieldName = $(this).attr('field');
                // Get its current value
                var currentVal = parseInt($('input[name=' + fieldName + ']').val());
                // If it isn't undefined or its greater than 0

                if (currentVal > 1) {
                    if (!isNaN(currentVal) && currentVal > 0) {
                        // Decrement one

                        $('input[name=' + fieldName + ']').val(currentVal - 1);
                    } else {
                        // Otherwise put a 0 there
                        $('input[name=' + fieldName + ']').val(0);
                    }
                    calculate_and_display_qty_amount();
                }
            });
            
        //to add product on wish list
         
        function calculate_and_display_qty_amount() {
            var qty = parseInt($('[name=qty]').val());
            var total = price * qty;

            $('.display-quantity').text(qty);
            $('.display-total').text('Rs. ' + total);
        }

        $('[name=quantity]').change(calculate_and_display_qty_amount);
        calculate_and_display_qty_amount();

        $('#qty-input-1').keyup(function (event) {
            var field = $('#qty-input-1');

            if (event.which < 48 || event.which > 57) {
                field.val(field.val().slice(0, -1));
                return false;
            }

            return true;
        });

        function locationChangeHandler() {
            var cod = $('.selectpicker').find(':selected').data('cod');

            if (cod == 1) {
                $('.cod-message').text('Available')
            } else {
                $('.cod-message').text('Not Available')
            }
        }

        $('.selectpicker').change(locationChangeHandler)

        locationChangeHandler()
    </script>
    
 
    @if(auth()->guest())
        <script src="https://cdnjs.cloudflare.com/ajax/libs/remodal/1.0.6/remodal.min.js"></script>
        <script>
            function showLoginForm() {
                var inst = $('[data-remodal-id=login-modal]').remodal();
                inst.open();
            }

            @if($errors->has('email') || $errors->has('password'))
            showLoginForm();
            @endif
        </script>
    @else
    <script>
        function createConversation(userId) {
            app.createConversation(userId);
        }

        function initUploadAttachment(conservation_id) {
            var c_id = conservation_id;

            $('#file-' + c_id).fileupload({
                url: '/user/store-message',
                formData: {
                    'conversation_id': c_id,
                    'type': 'attachment',
                    '_token': '{{ csrf_token() }}'
                },
                submit: function (e, data) {
                    if (data.files[0].size > 10485760) {
                        alert('File is too big(More than 10 MB).');
                        return false;
                    }

                    return true;
                },
                done: function (e, data) {
                    console.log('done');
                },
                error: function (e, data) {
                    alert('Something went wrong');
                }
            });
        }
    </script>
    @endif
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
    @if(session()->has('product_page_flash_message'))
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
        <script>
            swal({
                buttons: false,
                icon: "success",
                timer: 2500,
                text: '{{ session()->get('product_page_flash_message') }}'
            });
        </script>
    @endif
@endsection