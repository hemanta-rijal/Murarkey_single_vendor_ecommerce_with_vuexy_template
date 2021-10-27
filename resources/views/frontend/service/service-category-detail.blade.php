@extends('frontend.layouts.app')
@section('meta')
@endsection
@section('body')
 <!-- services explorer -->
    <section class="services-explorer">
      <div class="container-fluid">
        <div class="section-title">
          <h1>{{$serviceCategory->name}}</h1>
        </div>

        <div class="row">
          <div class="col-md-3 first-col">
            <ul class="nav nav-tabs" id="serviceExplorer" role="tablist">
              <?php $thirdChildTabCount=0;
                    $thirdChildTabForServicesDetailCount=0;
              ?>
              @foreach($serviceCategoryChild as $thirdChild)
              {{-- {{dd($thirdChild)}} --}}
                <li class="nav-item">
                  <a
                          class="nav-link {{$thirdChildTabCount==0?'active':''}}"
                          id="{{$thirdChild->slug}}"
                          data-toggle="tab"
                          href="{{'#'.$thirdChild->slug.'content'}}"
                          role="tab"
                          aria-controls="home"
                          aria-selected="true"
                  >
                    {{$thirdChild->name}}
                  </a>
                </li>
                <?php $thirdChildTabCount++ ?>
              @endforeach
            </ul>
          </div>
          <div class="col-md-5 second-col">
            <div class="tab-content" id="serviceExplorerContent">
              @foreach($serviceCategoryChild as $thirdChild)
              <div
                class="tab-pane fade {{$thirdChildTabForServicesDetailCount==0?'show active':''}}"
                id="{{$thirdChild->slug.'content'}}"
                role="tabpanel"
              >
                @foreach($thirdChild->services as $service)
                  <div class="service-explore-card">
                  <div class="intro">
                    <h2 onclick="openServiceDeatilSection('{{$service->id}}')">{{$service->title}}</h2>
                    <p>
                      {!!$service->short_description!!}
                    </p>
                  </div>
                  <div class="thumbnail">
                                                @foreach ($service->images as $image)
                                                <img
                                                src="{{resize_image_url($image->image,'200X200')}}"
                                                alt="{{$service->title}}"
                                                id="options_{{$service->id}}"
                                                />
                                                @endforeach
                                            </div>
                  <ul class="details">
                    <li>Duration: <strong>{{$service->min_duration .' to ' .$service->max_duration}} {{$service->max_duration_unit}} </strong></li>
                   
                  </ul>
                  <div class="price">{{convert($service->service_charge)}}</div>
                  <div class="quantity">
                    <div class="pro-qty">
                      <input type="text" value="1" />
                    </div>
                    <a onclick="addServiceToCart({{$service->id}})" href="#" class="primary-btn pd-cart">Add To Cart</a>
                  </div>
                  <a onclick="openServiceDeatilSection('{{$service->id}}')" href="" class="view-btn"
                        >View Details <i class="fa fa-chevron-right"></i>
                    </a>
                </div>
                @endforeach
              </div>
              @php
                  $thirdChildTabForServicesDetailCount++;
              @endphp
              @endforeach
            </div>
          </div>
          <div class="col-md-4 ">
              
            <div class="service-sub-details" >

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
          openServiceDeatilSection('{{ $serviceCategoryChild->first()->services->count() ? $serviceCategoryChild->first()->services->first()->id : null}}')
        });
        function openServiceDeatilSection(serviceId) {
            $.post('{{ route('service.detail.click') }}',{_token:'{{ @csrf_token() }}', serviceId:serviceId}, function(data){
              console.log(data);
                $('.service-sub-details').html('');
                $('.service-sub-details').html(data);
                $('.service-sub-details').attr('style','display:contents');
            });
        }
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
                    type: 'service',
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
        $(".user-rating").click(function (e) {
              e.preventDefault();
              var rating = $(this).attr('data-value');
              $("#rating").val(rating);
        });
    </script>
@endsection
