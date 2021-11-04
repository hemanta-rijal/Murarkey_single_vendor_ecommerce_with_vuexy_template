<!-- Women Banner Section Begin -->
<section class="women-banner shopby-skintone spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title pb-2">
                    <h2>Shop by Skin Tone</h2>
                </div>


                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="card product-item">
                            <a href="{{route('products.search','tone=normal-skin')}}" class="img-box pi-pic">
                                <img src=" {{resize_image_url(get_theme_setting_by_key('normal_skin_image'), '600X600')}}"
                                     alt="normal skin"/>
                            </a>
                            <div class="card-body">
                                <div class="pi-text">

                                    <a href="{{route('products.search','tone=normal-skin')}}">
                                        <h3>Normal Skin</h3>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                        <div class="card product-item">
                            <a href="{{route('products.search','tone=dry-skin')}}" class="img-box pi-pic">
                                <img src=" {{resize_image_url(get_theme_setting_by_key('dry_skin_image'), '600X600')}}"
                                     alt="dry skin"/>
                            </a>
                            <div class="card-body">
                                <div class="pi-text">
                                    <a href="{{route('products.search','category=dry-skin')}}">
                                        <h3>Dry Skin</h3>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-4 col-sm-6">
                        <div class="card product-item">
                            <a href="{{route('products.search','tone=oily-skin')}}" class="img-box pi-pic">
                                <img src=" {{resize_image_url(get_theme_setting_by_key('oily_skin_image'), '600X600')}}"
                                     alt="oily skin"/>
                            </a>
                            <div class="card-body">
                                <div class="pi-text">
                                    <a href="{{route('products.search','tone=oily-skin')}}">
                                        <h3>Oily Skin</h3>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>
</section>
<!-- Women Banner Section End -->