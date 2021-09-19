<!-- Women Banner Section Begin -->
@if($categories!=null)
<section class="women-banner spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title pb-2">
                    <h2>Shop by categories</h2>
                </div>
                <div class="product-slider owl-carousel">
                    @foreach($categories as $category)
                    <div class="product-item">
                        <a href="{{route('products.search','category='.$category->slug)}}" class="pi-pic">
                            <img src="{{resize_image_url($category->image_url, '200X200')}}" alt="{{$category->name}}" />
                        </a>
                        <div class="pi-text">
                            <a href="{{route('products.search','category='.$category->slug)}}">
                                <h5>{{$category->name}}</h5>
                            </a>
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