<!-- Hero Section Begin -->
<section class="hero-section">
    <div class="hero-items owl-carousel">
        @foreach(get_banner_by_position('desktop') as $index => $slide)
            <div class="single-hero-items set-bg" data-setbg="{{map_storage_path_to_link($slide->image)}}"></div>
        @endforeach
    </div>
</section>
<!-- Hero Section End -->