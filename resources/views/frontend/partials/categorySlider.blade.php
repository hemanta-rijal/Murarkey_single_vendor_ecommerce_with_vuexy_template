<!-- Women Banner Section Begin -->
@if($categories!=null)
    <section class="women-banner shopby-cat spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <div class="section-title pb-2">
                        <h2>Shop by categories</h2>
                    </div>
                    <div class="row">
                        @foreach($categories->take(8) as $category)
                            <div class="col-md-3 col-sm-6">
                                <div class="card product-item">
                                    <a href="{{route('products.search','category='.$category->slug)}}"
                                       class="img-box pi-pic">
                                        <img src="{{resize_image_url($category->image_url, '600X600')}}"
                                             alt="{{$category->name}}"/>
                                    </a>
                                    <div class="card-body">
                                        <div class="pi-text">
                                            <div class="catagory-name">{!! strip_tags( str_limit($category->description, 30)) !!}</div>
                                            <a href="{{route('products.search','category='.$category->slug)}}">
                                                <h5>{{$category->name}}</h5>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Women Banner Section End -->
@endif