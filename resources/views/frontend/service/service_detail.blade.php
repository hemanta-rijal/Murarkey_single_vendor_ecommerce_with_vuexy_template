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
                                @foreach($category->rel_services as $servies)
                                    <div class="service-explore-card">
                                        <div class="intro">
                                            <h2>{{$servies->title}}</h2>
                                            <p>
                                                {{$servies->short_description}}
                                            </p>
                                        </div>

                                        <ul class="details">
                                            <li>Duration: <strong>{{$servies->min_duration .' to ' .$servies->max_duration}} {{$servies->max_duration_unit}} </strong></li>
                                            <li>
                                                {{$servies->description}}
                                            </li>

                                        </ul>

                                        <div class="price">रू. {{$servies->service_charge}}</div>

                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="text" value="1" />
                                            </div>
                                            <a href="#" class="primary-btn pd-cart">Add To Cart</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <?php $serviceCategoryServicesCount++; ?>
                        @endforeach

                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
    </section>
    <!-- services explorer -->
@endsection
