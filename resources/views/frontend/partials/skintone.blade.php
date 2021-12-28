<!-- Man Banner Section Begin -->
<section class="women-banner spad premium-services-banner shoppbyskin">
    <div class="container-fluid">
        <div class="section-title pb-2">
            <h2>Find the Best Product for you, According to your skin type</h2>
        </div>
        <div class="row">
            <div id="selectedValues">

            </div>
        </div>
        <div class="row">
            <div class="col">
                <form action="{{URL::to('products/search')}}" class="shopbyskin-form">
                    <ul class="nav nav-tabs" id="sbsformTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                               aria-controls="home"
                               aria-selected="true">
                                Skin Tone
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                               aria-controls="profile" aria-selected="false">Skin Concerns</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                               aria-controls="contact" aria-selected="false"> Product Type</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="sbsformTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            @foreach(skin_type() as $skin_type)
                                <label for="">
                                    <input name="skin_tone" type="radio"
                                           aria-label="Radio button for following text input"
                                           value="{{Str::slug($skin_type)}}">
                                    <span> {{$skin_type}}</span>
                                </label>
                            @endforeach
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            @foreach(skin_concerns() as $skin_concern)
                            <label for=""> <input name="skin_concern" type="radio"
                                                  aria-label="Radio button for following text input" value="{{$skin_concern}}">
                                <span> {{$skin_concern}}</span>
                            </label>
                            @endforeach
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            @foreach(product_types() as $type)
                            <label for=""> <input name="product_type" type="radio"
                                                  aria-label="Radio button for following text input" value="{{$type}}">
                                <span>{{$type}} </span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- buttons area -->
                    <div class="shoskin-controls">
                        <button type="button" id="form-prev">Previous</button>
                        <button type="button" id="form-next">Next</button>
                        <button type="submit" id="form-search">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Man Banner Section End -->