<!-- Women Banner Section Begin -->
@if($categories!=null)
<section class="women-banner spad">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title pb-2">
                    <h2>Shop by categories</h2>
                </div>
                <div class="product-slider owl-carousel">
                    @foreach($categories as $category)
                    <div class="product-item">
                        <a href=" " class="pi-pic">
                            <img src="{{map_storage_path_to_link($category->image_url)}}" alt="{{$category->name}}" />
                        </a>
                        <div class="pi-text">
{{--                            <div class="catagory-name">Starting from Rs 300</div>--}}
                            <a href="#">
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