@extends('frontend.layouts.app')
@section('meta')
@endsection
@section('body')
    <!-- services explorer -->
    <section class="services-explorer">
      <div class="container-fluid">
        <div class="section-title">
          <h1>Parlour at Home</h1>
        </div>
        <div class="row">
          <div class="col-md-3 first-col">
            <div class="sticky-wrapper">
              <ul class="nav nav-tabs" id="serviceExplorer" role="tablist">
                <?php $serviceCategoryCount=0;
                        $serviceCategoryServicesCount=0;
                        ?>
                        @foreach($serviceCategories as $category)
                            <li class="nav-item">
                            <a
                                class="nav-link {{$category->id==$service->category_id?'active':''}}"
                              id="{{$category->slug}}"
                                data-toggle="tab"
                                  href="{{'#'.$category->slug.'content'}}"
                                role="tab"
                                aria-controls="home"
                                aria-selected="true"
                            >
                                {{$category->name}}
                            </a>
                            <?php $serviceCategoryCount++ ?>
                            </li>
                        @endforeach
              </ul>

              <!-- other services -->
              <div class="other-services">
                <h2>You may also like</h2>
                <div class="other-services-container">
                  <a href="" class="card">
                    <img src="https://images.pexels.com/photos/310278/pexels-photo-310278.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" alt="">
                    <h3>Hands Feet and Nail <span>(7 services)</span> </h3>

                  </a>

                  <a href="" class="card">
                    <img src="https://images.pexels.com/photos/3757942/pexels-photo-3757942.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" alt="">
                    <h3>Spa Services <span>(16 services)</span></h3>

                  </a>

                </div>

              </div>
              <!-- other services -->
            </div>
          </div>
          <div class="col-md-5 second-col">
            <div class="tab-content" id="serviceExplorerContent">
            @foreach($serviceCategories as $category)
              <div
                    class="tab-pane fade show {{$category->id==$service->category_id?'active':''}}"
                    id="{{$category->slug.'content'}}"
                    role="tabpanel"
                 >
                       @if(!$category->services->isEmpty())
                                    @foreach($category->services as $allCategoryServices)
                                        <div class="service-explore-card">
                                            {{-- <div class="rating"><i class="fa fa-star"></i> 4.5</div> --}}
                                            <div class="intro">
                                                <h2 onclick="openServiceDeatilSection('{{$allCategoryServices->id}}')">{{$allCategoryServices->title}}</h2>
                                                <p>
                                                    {!!$allCategoryServices->short_description!!}
                                                </p>
                                            </div>

                                            <div class="thumbnail">
                                                @foreach ($allCategoryServices->images as $image)
                                                <img
                                                src="{{resize_image_url($image->image,'200X200')}}"
                                                alt="{{$allCategoryServices->title}}"
                                                id="options_{{$allCategoryServices->id}}"
                                                />
                                                @endforeach
                                            </div>

                                            <ul class="details">
                                                <li>Duration: <strong>{{$allCategoryServices->min_duration .' to ' .$allCategoryServices->max_duration}} {{$allCategoryServices->max_duration_unit}} </strong></li>
                                                <li>
                                                <span>Price</span>
                                                <span>रू. {{$allCategoryServices->service_charge}}</span>
                                                </li>

                                                <li>
                                                <span>Beauty Professional</span> <span>Female only</span>
                                                </li>
                                            </ul>

                                            <div class="quantity">
                                                <div class="pro-qty">
                                                <input type="text" id="qty_{{$allCategoryServices->id}}" value="1" />
                                                </div>
                                                <a onclick="addServiceToCart({{$allCategoryServices->id}})" href="#" class="primary-btn pd-cart">Add To Cart</a>
                                            </div>

                                            <a href="" class="view-btn"
                                                >View Details <i class="fa fa-chevron-right"></i>
                                            </a>
                                        </div>
                                @endforeach
                        @endif
                    </div>
              <?php $serviceCategoryServicesCount++; ?>
            @endforeach
            </div>
          </div>

          <div class="col-md-4">
            <div class="service-sub-details">
            
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- services explorer -->
@endsection

@section('js')
    <script>
        $( document ).ready(function() {
            openServiceDeatilSection('{{$service->id}}')
        });
        function openServiceDeatilSection(serviceId) {
            // alert(serviceId);
            $('.service-sub-details').html('');
            $.post('{{ route('service.detail.click') }}',{_token:'{{ @csrf_token() }}', serviceId:serviceId}, function(data){
                console.log(data);
                $('.service-sub-details').html(data);
            });
        }
        // sub-details
        $('.sub-details').attr('style','display:block');

    </script>
<script>
        function addServiceToCart(serviceId) {
            var auth = {{auth('web')->check() ? 'true' :'false'}}
            if(auth==true){
                var auth = {{ auth()->check() ? 'true' : 'false' }};
                var optionsId ='options_'+serviceId; 
                var qtyId = 'qty_'+serviceId;
                var photo = document.getElementById(optionsId).src;
                var qty = document.getElementById(qtyId).value;
                $.ajaxSetup({
                                headers: {'X-CSRF-TOKEN': '{{ Session::token() }}'}
                            });
                $.ajax({
                    type:"POST",
                    url:'<?php echo e(route("user.cart.store")) ?>',
                    data:{
                    qty:qty,
                    service: true,
                    options: {'photo':photo,'product_type':'service'},
                    product_id:serviceId,
                    },
                    success:function (data) {
                        updateCartDropDown();
                        new swal({
                            buttons: false,
                            icon: "success",
                            timer: 3000,
                            text: "Service  added in Cart"
                        });
                    }

                })
                }else{
                        new swal({
                            buttons: false,
                            icon: "error",
                            timer: 2000,
                            text: "Please Login First"
                        });
                        location.href = ('{{route('auth.login')}}')
                }
        }
      
        function addServiceToCartFromDetail(serviceId) {
          var auth = {{auth('web')->check() ? 'true' :'false'}}
          if(auth==true){
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': '{{ Session::token() }}'}
                });
            $.ajax({
                type:"POST",
                url:'<?php echo e(route("user.cart.store")) ?>',
                data:$('#service-detail-form').serializeArray(),
                // data:{'product_id':serviceId },
                success:function (data) {
                    updateCartDropDown();
                    new swal({
                        buttons: false,
                        icon: "success",
                        timer: 2000,
                        text: "Item added in Cart"
                    });
                }
            });
          }else{
            new swal({
                        buttons: false,
                        icon: "error",
                        timer: 2000,
                        text: "Please Login First"
                    });
                    location.href = ('{{route('auth.login')}}')
          }

        }
    </script>
@endsection
