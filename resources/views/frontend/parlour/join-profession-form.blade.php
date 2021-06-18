@extends('frontend.layouts.app')
@section('meta')
    
@endsection
@section('body')
        <!-- Register Section Begin -->
    <div
      class="register-login-section spad"
      style="background:linear-gradient(
        183deg,
        rgba(77, 17, 139, 1) 0%,
        rgba(103, 32, 132, 0.5) 48%
      ), url(/img/colorful-background.jpg)"
    >
      <div class="container">
        <div class="row">
          <div class="col">
            <div class="join-intro text-center text-white">
              <div class="overline">INTRODUCING</div>
              <h1>Murarkey Pro</h1>
              <div class="subtitle">Own Your Career With Murarkey</div>

              <p>
                <b>Submit the form</b> below to own your career, do what you
                love, and make money while doing it. After you submit the form,
                <b>Murarkey team member will contact you!</b> We’ll ask you to
                tell us a little about you and your work experience, and will
                stay in touch with you!
              </p>
            </div>

            <div class="join-form-wrapper bg-white p-5">
              <div class="join-form">
                <form action="{{route('post.join-profession')}}" method="POST">
                  @csrf()
                  <div class="form-row">
                    <div class="col">
                      <div class="group-input">
                        <label for="Fullname">Full name</label>
                        <input type="text" id="Fullname" name="full_name"/>
                      </div>
                    </div>

                    <div class="col">
                      <div class="group-input">
                        <label for="phonenum">Phone number * </label>
                        <input type="numebr" id="phonenum" name="phone_number" />
                        <small class="text-muted"
                          >We will contact you in this number.</small
                        >
                      </div>
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="col">
                      <div class="group-input">
                        <label for="vibernum">Viber Phone number </label>
                        <input type="numebr" id="vibernum" name="viber_number"/>

                        <small class="text-muted">
                          We will send you important notice on this.
                        </small>
                      </div>
                    </div>

                    <div class="col">
                      <div class="group-input">
                        <label for="email">Email </label>
                        <input type="email" id="email" name="email" />
                      </div>
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="col">
                      <div class="form-group">
                        <label for="">
                          Preferred Work <span class="text-danger">*</span>
                        </label>

                        <div class="custom-control custom-checkbox">
                          <input
                            type="checkbox"
                            class="custom-control-input" value="Parlour Service For Name" name="preferred_work[]"
                            id="prefer1"
                          />
                          <label class="custom-control-label" for="prefer1">
                            Parlour Services for Women</label
                          >
                        </div>

                        <div class="custom-control custom-checkbox">
                          <input
                            type="checkbox"
                            class="custom-control-input" value="Makeup" name="preferred_work[]"
                            id="prefer2"
                          />
                          <label class="custom-control-label" for="prefer2"
                            >Makeup</label
                          >
                        </div>

                        <div class="custom-control custom-checkbox">
                          <input
                            type="checkbox"
                            class="custom-control-input" value="Hairstyling" name="preferred_work[]"
                            id="prefer3"
                          />
                          <label class="custom-control-label" for="prefer3" name="preferred_work[]"
                            >Hairstyling</label
                          >
                        </div>

                        <div class="custom-control custom-checkbox">
                          <input
                            type="checkbox"
                            class="custom-control-input" value="Nail Extension/ Nail Art" name="preferred_work[]"
                            id="prefer4"
                          />
                          <label class="custom-control-label" for="prefer4" name="preferred_work[]"
                            >Nail Extension/ Nail Art</label
                          >
                        </div>

                        <div class="custom-control custom-checkbox">
                          <input
                            type="checkbox"
                            class="custom-control-input" value="Bridal Service" name="preferred_work[]"
                            id="prefer5"
                          />
                          <label class="custom-control-label" for="prefer5">
                            Bridal Services</label
                          >
                        </div>

                        <div class="custom-control custom-checkbox">
                          <input
                            type="checkbox"
                            class="custom-control-input" value="Mehendi" name="preferred_work[]"
                            id="prefer6"
                          />
                          <label class="custom-control-label" for="prefer6"
                            >Mehendi</label
                          >
                        </div>

                        <div class="custom-control custom-checkbox">
                          <input
                            type="checkbox"
                            class="custom-control-input" value="Salon Service For Men" name="preferred_work[]"
                            id="prefer7"
                          />
                          <label class="custom-control-label" for="prefer7"
                            >Salon Services for Men</label
                          >
                        </div>
                        <small class="text-muted">
                          You can select multiple options too.
                        </small>
                      </div>
                    </div>

                    <div class="col">
                      <div class="form-group">
                        <label for="">
                          Preferred Location
                          <span class="text-danger">*</span>
                        </label>

                        <div class="custom-control custom-checkbox">
                          <input
                            type="checkbox"
                            class="custom-control-input" value="Bhaktapur" name="preferred_location[]"
                            id="preferloc1"
                          />
                          <label class="custom-control-label" for="preferloc1">
                            Bhaktapur
                          </label>
                        </div>

                        <div class="custom-control custom-checkbox">
                          <input
                            type="checkbox"
                            class="custom-control-input" value="Kathmandu" name="preferred_location[]"
                            id="preferloc2"
                          />
                          <label class="custom-control-label" for="preferloc2">
                            Kathmandu
                          </label>
                        </div>

                        <div class="custom-control custom-checkbox">
                          <input
                            type="checkbox"
                            class="custom-control-input" value="Patan/Lalitpur" name="preferred_location[]"
                            id="preferloc3"
                          />
                          <label class="custom-control-label" for="preferloc3">
                            Patan/Lalitpur
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for=""
                      >Write something about you and special services that you
                      provide. (For eg. About Education, Training and
                      others)</label
                    >
                    <textarea
                      name="about"

                      class="form-control"
                      id=""
                      cols="30"
                      rows="5"
                    ></textarea>
                  </div>

                  <button type="submit" class="site-btn login-btn">
                    Submit
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Register Form Section End -->
@endsection


