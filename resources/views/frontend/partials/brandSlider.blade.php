@if($brands!=null)
<!-- Instagram Section Begin -->
<section class="brands-section mt-5">
    <div class="section-title pb-2">
        <h2>Shop by Brands</h2>
    </div>
    <div class="instagram-photo brands-carousel owl-carousel">
        @foreach($brands as $brand)
        <div class="insta-item set-bg" data-setbg="{{resize_image_url($brand->image,'200X200')}}">
            <div class="inside-text">
                <h5><a href="{{route('products.search','brand='.$brand->slug)}}" >{{$brand->name}}</a></h5>
            </div>
        </div>

        @endforeach

    </div>
</section>
<!-- Instagram Section End -->
@endif