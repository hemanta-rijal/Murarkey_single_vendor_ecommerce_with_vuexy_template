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
                            </li>
                            <?php $serviceCategoryCount++ ?>
                        @endforeach
                    </ul>
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
                                            <div class="intro">
                                                <h2 onclick="openServiceDeatilSection('{{$allCategoryServices->id}}')">{{$allCategoryServices->title}}</h2>
                                                <p>
                                                    {!!$allCategoryServices->short_description!!}
                                                </p>
                                            </div>

                                            <ul class="details">
                                                <li>Duration: <strong>{{$allCategoryServices->min_duration .' to ' .$allCategoryServices->max_duration}} {{$allCategoryServices->max_duration_unit}} </strong></li>
                                                <li>
                                                    {!! $allCategoryServices->description !!}
                                                </li>

                                            </ul>

                                            <div class="price">रू. {{$allCategoryServices->service_charge}}</div>

                                            <div class="quantity">
                                                <div class="pro-qty">
                                                    <input type="text" value="1" />
                                                </div>
                                                <a href="#" class="primary-btn pd-cart">Add To Cart</a>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                            </div>
                            <?php $serviceCategoryServicesCount++; ?>
                        @endforeach

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="service-sub-details" style="">


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
            openServiceDeatilSection('{{$service->id}}')
        // });
        function openServiceDeatilSection(serviceId) {
            $('.service-sub-details').html('');
            $.post('{{ route('service.detail.click') }}',{_token:'{{ @csrf_token() }}', serviceId:serviceId}, function(data){
                $('.service-sub-details').html(data);
            });
        }
    </script>
@endsection
