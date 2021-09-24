@extends('frontend.layouts.app')
@section('meta')
@endsection
@section('body')
 <!-- services explorer -->
    <section class="services-explorer spad">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3 first-col">
            <ul class="nav nav-tabs" id="serviceExplorer" role="tablist">
              <?php $thirdChildTabCount=0;
                    $thirdChildTabForServicesDetailCount=0;
              ?>
              @foreach($serviceCategoryChild as $thirdChild)
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
                @foreach($thirdChild->services as $servies)
                  <div class="service-explore-card">
                  <div class="intro">
                    <h2 onclick="openServiceDeatilSection('{{$servies->id}}')">{{$servies->title}}</h2>
                    <p>
                      {!!$servies->short_description!!}
                    </p>
                  </div>

                  <ul class="details">
                    <li>Duration: <strong>{{$servies->min_duration .' to ' .$servies->max_duration}} {{$servies->max_duration_unit}} </strong></li>
                    <li>
                      {!!$servies->description!!}
                    </li>
                  </ul>

                  <div class="price">{{convert($servies->service_charge)}}</div>
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
        // $( document ).ready(function() {
        {{--openServiceDeatilSection('{{$service->id}}')--}}
        // });
        function openServiceDeatilSection(serviceId) {
            $('.service-sub-details').html('');
            $.post('{{ route('service.detail.click') }}',{_token:'{{ @csrf_token() }}', serviceId:serviceId}, function(data){
                $('.service-sub-details').html(data);
            });
        }
    </script>
@endsection
