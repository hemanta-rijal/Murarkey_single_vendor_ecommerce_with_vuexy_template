<!-- schedule form -->
<section class="schedule-section bg-light">
    <div class="row mx-0">
        <div class="col-md-4 p-0">
            <div class="schedule-right">
                <div class="overlay">
                    <!-- <h2>Schedule Premium Services at Home</h2> -->
                    <ul class="nav nav-tabs" id="popService" role="tablist">
                        <?php
                            $parentCategories = app(\Modules\ServiceCategories\Contracts\ServiceCategoryService::class)->getParentCategoryOnly();
                            $tabCount =0;
                            $tabContentCount=0;
                        ?>
                        @foreach($parentCategories as $category)
                        <li class="nav-item">
                            <a
                                    class="nav-link {{$tabCount == 0 ? 'active':''}}"
                                    id="{{$category->slug}}"
                                    data-toggle="tab"
                                    href="{{'#'.$category->slug.'_content'}}"
                                    role="tab"
                                    aria-controls="home"
                                    aria-selected="true"
                            >
                                Parlour at Home
                            </a>
                        </li>
                            <?php $tabCount++ ?>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-8 p-0">
            <div class="tab-content" id="popServiceContent">
                @foreach($parentCategories as $categoryContent)
                <div
                        class="tab-pane fade show {{$tabContentCount==0?'active':''}}"
                        id="{{$category->slug.'_content'}}"
                        role="tabpanel"
                >
                    <div class="services-section d-nne">
                        <div class="container">
                            <div class="row">
                                <?php
                                $firstLevelCategories = app(\Modules\ServiceCategories\Contracts\ServiceCategoryService::class)->getChildren($categoryContent->id);
                                ?>
                                @foreach($firstLevelCategories as $firstLevelCategory)
                                        <a href="{{route('service_category.detail',$firstLevelCategory->slug)}}" class="col">
                                            <div class="img-box">
                                                <img src="{{ URL::asset('frontend/img/icons/bride.svg')}}" alt="" />
                                            </div>
                                            <h3 style="text-transform: capitalize">{{$firstLevelCategory->name}}</h3>
                                        </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                @endforeach

            </div>
        </div>
    </div>
</section>
<!-- schedule form -->