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

                  <ul class="details">
                    <li>Duration: <strong>{{$service->min_duration .' to ' .$service->max_duration}} {{$service->max_duration_unit}} </strong></li>
                    <li>
                      {!!$service->description!!}
                    </li>
                  </ul>

                  <div class="price">{{convert($service->service_charge)}}</div>
                  <div class="quantity">
                    <div class="pro-qty">
                      <input type="text" value="1" />
                    </div>
                    <a href="#" class="primary-btn pd-cart">Add To Cart</a>
                  </div>
                </div>
                @endforeach
              </div>
              @php
                  $thirdChildTabForServicesDetailCount++;
              @endphp
              @endforeach
            </div>
          </div>
          <div class="col-md-4">
              <div class="service-sub-details"  style="display: contents !important">

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
        openServiceDeatilSection('{{ $thirdChild ? $thirdChild->services->first()->id : null}}')
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
    
     {{-- <script>
        $( document ).ready(function() {
            openServiceDeatilSection('{{$service->id}}')
        });
        function openServiceDeatilSection(serviceId) {
            console.log('test')
            // alert(serviceId);

            $.post('{{ route('service.detail.click') }}',{_token:'{{ @csrf_token() }}', serviceId:serviceId}, function(data){
                $('.service-sub-details').html('');
                $('.service-sub-details').html(data);
                // sub-details
                $('.service-sub-details').attr('style','display:block');
            });

        }

    </script> --}}
@endsection
