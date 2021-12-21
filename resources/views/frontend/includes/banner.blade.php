
@php
    $mobile_responsive_banner = get_banner_by_position('mobile_responsive');
@endphp

<!-- Hero Section Begin -->
<section class="hero-section">
    <div class="hero-items owl-carousel">
        @foreach(get_banner_by_position('desktop') as $index => $slide)
            <a target="_blank" href="{{$slide->link}}">
                <picture>
                    <source media="(min-width: 460px)" srcset="{{map_storage_path_to_link($slide->image)}}">
                    {{--check mobile responsive--}}
                    @if(!$mobile_responsive_banner->isEmpty())
                        @if(isset($mobile_responsive_banner[$index]))
                            <img src="{{map_storage_path_to_link($mobile_responsive_banner[$index]->image)}}?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940">
                        @else
                            <img src="{{map_storage_path_to_link($slide->image)}}?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940">
                        @endif
                    @else
                        <img src="{{map_storage_path_to_link($slide->image)}}">
                    @endif
                </picture>
            </a>
        @endforeach
    </div>
</section>
<!-- Hero Section End -->