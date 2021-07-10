@extends('frontend.layouts.app')
@section('meta')
@endsection
@section('body')
 <!-- services explorer -->
    <section class="services-explorer spad">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3 first-col">
            <ul class="nav nav-tabs" id="serviceExplorer" role="tablist">
              <li class="nav-item">
                <a
                  class="nav-link active"
                  id="serExplorerTab1"
                  data-toggle="tab"
                  href="#serExplorerTab_content1"
                  role="tab"
                  aria-controls="home"
                  aria-selected="true"
                >
                  Hair Salon
                </a>
              </li>
              <li class="nav-item">
                <a
                  class="nav-link"
                  id="serExplorerTab2"
                  data-toggle="tab"
                  href="#serExplorerTab_content2"
                  role="tab"
                  aria-controls="profile"
                  aria-selected="false"
                >
                  Hands feet and nail
                </a>
              </li>
              <li class="nav-item">
                <a
                  class="nav-link"
                  id="serExplorerTab3"
                  data-toggle="tab"
                  href="#serExplorerTab_content3"
                  role="tab"
                  aria-controls="profile"
                  aria-selected="false"
                >
                  Spa Services
                </a>
              </li>
            </ul>
          </div>
          <div class="col-md-5 second-col">
            <div class="tab-content" id="serviceExplorerContent">
              <div
                class="tab-pane fade show active"
                id="serExplorerTab_content1"
                role="tabpanel"
              >
                <div class="service-explore-card">
                  <div class="intro">
                    <h2>HAIR CUT</h2>
                    <p>
                      Wide Range Of Stylish Haircuts That Suits Your Face And
                      Enhances Your Hair Colour
                    </p>
                  </div>

                  <ul class="details">
                    <li>Duration: <strong>30-45 mins</strong></li>
                    <li>
                      Hygiene kit includes disposable towel, disposable gown,
                      facial band, napkins & cotton pads. Customized single
                      usage of Products.
                    </li>
                    <li>
                      Don’t worry, we clean up after the service & leave your
                      place spic & span.
                    </li>
                    <li>Beauty Professional : Female only.</li>
                  </ul>

                  <div class="price">रू. 700</div>

                  <div class="quantity">
                    <div class="pro-qty">
                      <input type="text" value="1" />
                    </div>
                    <a href="#" class="primary-btn pd-cart">Add To Cart</a>
                  </div>
                </div>

                <div class="service-explore-card">
                  <div class="intro">
                    <h2>Wash and dry</h2>
                    <p>
                      Wide Range Of Stylish Haircuts That Suits Your Face And
                      Enhances Your Hair Colour
                    </p>
                  </div>

                  <ul class="details">
                    <li>Duration: <strong>30-45 mins</strong></li>
                    <li>
                      Hygiene kit includes disposable towel, disposable gown,
                      facial band, napkins & cotton pads. Customized single
                      usage of Products.
                    </li>
                    <li>
                      Don’t worry, we clean up after the service & leave your
                      place spic & span.
                    </li>
                    <li>Beauty Professional : Female only.</li>
                  </ul>

                  <div class="price">रू. 1200</div>

                  <div class="quantity">
                    <div class="pro-qty">
                      <input type="text" value="1" />
                    </div>
                    <a href="#" class="primary-btn pd-cart">Add To Cart</a>
                  </div>
                </div>

                <div class="service-explore-card">
                  <div class="intro">
                    <h2>HAIR COLOR</h2>
                    <p>
                      Wide Range Of Stylish Haircuts That Suits Your Face And
                      Enhances Your Hair Colour
                    </p>
                  </div>

                  <ul class="details">
                    <li>Duration: <strong>30-45 mins</strong></li>
                    <li>
                      Hygiene kit includes disposable towel, disposable gown,
                      facial band, napkins & cotton pads. Customized single
                      usage of Products.
                    </li>
                    <li>
                      Don’t worry, we clean up after the service & leave your
                      place spic & span.
                    </li>
                    <li>Beauty Professional : Female only.</li>
                  </ul>

                  <div class="price">रू. 525</div>

                  <div class="quantity">
                    <div class="pro-qty">
                      <input type="text" value="1" />
                    </div>
                    <a href="#" class="primary-btn pd-cart">Add To Cart</a>
                  </div>
                </div>

                <div class="service-explore-card">
                  <div class="intro">
                    <h2>Oil Massage</h2>
                    <p>
                      Wide Range Of Stylish Haircuts That Suits Your Face And
                      Enhances Your Hair Colour
                    </p>
                  </div>

                  <ul class="details">
                    <li>Duration: <strong>30-45 mins</strong></li>
                    <li>
                      Hygiene kit includes disposable towel, disposable gown,
                      facial band, napkins & cotton pads. Customized single
                      usage of Products.
                    </li>
                    <li>
                      Don’t worry, we clean up after the service & leave your
                      place spic & span.
                    </li>
                    <li>Beauty Professional : Female only.</li>
                  </ul>

                  <div class="price">रू. 1300</div>

                  <div class="quantity">
                    <div class="pro-qty">
                      <input type="text" value="1" />
                    </div>
                    <a href="#" class="primary-btn pd-cart">Add To Cart</a>
                  </div>
                </div>

                <div class="service-explore-card">
                  <div class="intro">
                    <h2>Ironing</h2>
                    <p>
                      Wide Range Of Stylish Haircuts That Suits Your Face And
                      Enhances Your Hair Colour
                    </p>
                  </div>

                  <ul class="details">
                    <li>Duration: <strong>30-45 mins</strong></li>
                    <li>
                      Hygiene kit includes disposable towel, disposable gown,
                      facial band, napkins & cotton pads. Customized single
                      usage of Products.
                    </li>
                    <li>
                      Don’t worry, we clean up after the service & leave your
                      place spic & span.
                    </li>
                    <li>Beauty Professional : Female only.</li>
                  </ul>

                  <div class="price">रू. 2500</div>

                  <div class="quantity">
                    <div class="pro-qty">
                      <input type="text" value="1" />
                    </div>
                    <a href="#" class="primary-btn pd-cart">Add To Cart</a>
                  </div>
                </div>
              </div>

              <div
                class="tab-pane fade"
                id="serExplorerTab_content2"
                role="tabpanel"
              >

              <div class="service-explore-card">
                <div class="intro">
                  <h2>HAIR COLOR</h2>
                  <p>
                    Wide Range Of Stylish Haircuts That Suits Your Face And
                    Enhances Your Hair Colour
                  </p>
                </div>

                <ul class="details">
                  <li>Duration: <strong>30-45 mins</strong></li>
                  <li>
                    Hygiene kit includes disposable towel, disposable gown,
                    facial band, napkins & cotton pads. Customized single
                    usage of Products.
                  </li>
                  <li>
                    Don’t worry, we clean up after the service & leave your
                    place spic & span.
                  </li>
                  <li>Beauty Professional : Female only.</li>
                </ul>

                <div class="price">रू. 525</div>

                <div class="quantity">
                  <div class="pro-qty">
                    <input type="text" value="1" />
                  </div>
                  <a href="#" class="primary-btn pd-cart">Add To Cart</a>
                </div>
              </div>

                <div class="service-explore-card">
                  <div class="intro">
                    <h2>Oil Massage</h2>
                    <p>
                      Wide Range Of Stylish Haircuts That Suits Your Face And
                      Enhances Your Hair Colour
                    </p>
                  </div>

                  <ul class="details">
                    <li>Duration: <strong>30-45 mins</strong></li>
                    <li>
                      Hygiene kit includes disposable towel, disposable gown,
                      facial band, napkins & cotton pads. Customized single
                      usage of Products.
                    </li>
                    <li>
                      Don’t worry, we clean up after the service & leave your
                      place spic & span.
                    </li>
                    <li>Beauty Professional : Female only.</li>
                  </ul>

                  <div class="price">रू. 1300</div>

                  <div class="quantity">
                    <div class="pro-qty">
                      <input type="text" value="1" />
                    </div>
                    <a href="#" class="primary-btn pd-cart">Add To Cart</a>
                  </div>
                </div>

                <div class="service-explore-card">
                  <div class="intro">
                    <h2>Ironing</h2>
                    <p>
                      Wide Range Of Stylish Haircuts That Suits Your Face And
                      Enhances Your Hair Colour
                    </p>
                  </div>

                  <ul class="details">
                    <li>Duration: <strong>30-45 mins</strong></li>
                    <li>
                      Hygiene kit includes disposable towel, disposable gown,
                      facial band, napkins & cotton pads. Customized single
                      usage of Products.
                    </li>
                    <li>
                      Don’t worry, we clean up after the service & leave your
                      place spic & span.
                    </li>
                    <li>Beauty Professional : Female only.</li>
                  </ul>

                  <div class="price">रू. 2500</div>

                  <div class="quantity">
                    <div class="pro-qty">
                      <input type="text" value="1" />
                    </div>
                    <a href="#" class="primary-btn pd-cart">Add To Cart</a>
                  </div>
                </div>



              </div>

              <div
                class="tab-pane fade"
                id="serExplorerTab_content3"
                role="tabpanel"
              >
              <div class="service-explore-card">
                <div class="intro">
                  <h2>Oil Massage</h2>
                  <p>
                    Wide Range Of Stylish Haircuts That Suits Your Face And
                    Enhances Your Hair Colour
                  </p>
                </div>

                <ul class="details">
                  <li>Duration: <strong>30-45 mins</strong></li>
                  <li>
                    Hygiene kit includes disposable towel, disposable gown,
                    facial band, napkins & cotton pads. Customized single
                    usage of Products.
                  </li>
                  <li>
                    Don’t worry, we clean up after the service & leave your
                    place spic & span.
                  </li>
                  <li>Beauty Professional : Female only.</li>
                </ul>

                <div class="price">
                  रू. 1300
                </div>

                <div class="quantity">
                  <div class="pro-qty">
                    <input type="text" value="1" />
                  </div>
                  <a href="#" class="primary-btn pd-cart">Add To Cart</a>
                </div>


              </div>

              <div class="service-explore-card">
                <div class="intro">
                  <h2>Ironing</h2>
                  <p>
                    Wide Range Of Stylish Haircuts That Suits Your Face And
                    Enhances Your Hair Colour
                  </p>
                </div>

                <ul class="details">
                  <li>Duration: <strong>30-45 mins</strong></li>
                  <li>
                    Hygiene kit includes disposable towel, disposable gown,
                    facial band, napkins & cotton pads. Customized single
                    usage of Products.
                  </li>
                  <li>
                    Don’t worry, we clean up after the service & leave your
                    place spic & span.
                  </li>
                  <li>Beauty Professional : Female only.</li>
                </ul>

                <div class="price">
                  रू. 2500
                </div>

                <div class="quantity">
                  <div class="pro-qty">
                    <input type="text" value="1" />
                  </div>
                  <a href="#" class="primary-btn pd-cart">Add To Cart</a>
                </div>


              </div>
              </div>

              <div
                class="tab-pane fade"
                id="serExplorerTab_content4"
                role="tabpanel"
              >
                four
              </div>

              <div
                class="tab-pane fade"
                id="serExplorerTab_content5"
                role="tabpanel"
              >
                fiver
              </div>
            </div>
          </div>
          <div class="col-md-4"></div>
        </div>
      </div>
    </section>
    <!-- services explorer -->
@endsection
