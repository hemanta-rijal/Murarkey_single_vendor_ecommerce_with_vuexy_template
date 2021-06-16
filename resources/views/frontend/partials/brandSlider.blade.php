@if($brands!=null)
<!-- Instagram Section Begin -->
<section class="brands-section mt-5">
    <div class="section-title pb-2">
        <h2>Shop by Brands</h2>
    </div>
    <div class="instagram-photo brands-carousel owl-carousel">
        @foreach($brands as $brand)
        <div class="insta-item set-bg" data-setbg="{{map_storage_path_to_link($brand->image)}}">
            <div class="inside-text">
                <h5><a href="{{route('products.search',$brand->slug)}}" target="_blank">{{$brand->name}}</a></h5>
            </div>
        </div>

        @endforeach

    </div>
</section>
<!-- Instagram Section End -->
@endif