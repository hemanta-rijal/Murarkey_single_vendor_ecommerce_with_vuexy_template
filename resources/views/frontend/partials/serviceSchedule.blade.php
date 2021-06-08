
<!-- schedule form -->
<section class="schedule-section bg-light">
    <div class="row mx-0">
        <div class="col-md-6 p-0">
            <div class="schedule-right">
                <div class="overlay">
                    <h2>Schedule Premium Services at Home</h2>

                    <p class="mt-3">
                        Pick a date that suits you and get your favourite service at
                        your place of comfort.
                    </p>
                </div>
                <div id="schedule-carousel" class="owl-carousel owl-theme">
                    @foreach(get_banner_by_position('service-schedule') as $banner)
                        <img src="{{map_storage_path_to_link($banner->image)}}" alt="{{$banner->name}}" />
                    @endforeach

                </div>
            </div>
        </div>
        <div class="col-md-6 p-0">
            <div class="schedule-form register-form">
                <form action="#">
                    <div class="group-input">
                        <label for="username">Select a Service</label>
                        <div class="service-selector">
                            <select class="language_drop" name="countries" id="countries" style="width: 300px">
                                <option value="murar-mh" data-title="Makeup at Home">
                                    Makeup at Home
                                </option>
                                <option value="murar-bm" data-title="Bridal Makeup">
                                    Bridal Makeup
                                </option>
                                <option value="murar-mh" data-title="Haircut at Home">
                                    Haircut at Home
                                </option>
                                <option value="murar-bm" data-title="Parlour at home">
                                    Parlour at home
                                </option>
                                <option value="murar-mh" data-title="Salon at Home">
                                    Salon at Home
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="group-input">
                        <label for="pass">Pick a Date</label>
                        <input type="text" id="datepicker" />
                    </div>
                    <div class="group-input">
                        <label for="con-pass">Phone number</label>
                        <input type="number" id="con-pass" />
                    </div>
                    <button type="submit" class="site-btn register-btn">
                        Schedule
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- schedule form -->