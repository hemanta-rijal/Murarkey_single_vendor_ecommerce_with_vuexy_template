<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!--Google Fonts-->
    <link
      href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Lobster+Two:wght@400;700&family=PT+Sans&family=PT+Serif:wght@400;700&family=Roboto:wght@400;500;700&display=swap"
      rel="stylesheet"
    />

    <!-- Bootstrap CSS -->
    <link
      rel="stylesheet"
      type="text/css"
      href="{{URL::asset('frontend/vendors/bootstrap/css/bootstrap.min.css')}}"
    />

    <!--Fontawesome CSS-->
    <link
      rel="stylesheet"
      type="text/css"
      href="{{URL::asset('frontend/vendors/fontawesome/all.css')}}"
    />

    <!--Flaticon CSS-->
    <link rel="stylesheet" type="text/css" href="{{URL::asset('frontend/vendors/font/flaticon.css')}}">

  <!--Slick Slider Link-->
  <link rel="stylesheet" href="{{URL::asset('frontend/vendors/slick/slick-theme.css')}}">
  <link rel="stylesheet" href="{{URL::asset('frontend/vendors/slick/slick.css')}}">

    <!--Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{URL::asset('frontend/assets/css/style.css')}}" />

    <title>Ecommerce Website</title>
  </head>
  <body>

    <!--==============================
            TOPBAR
     ==============================-->
    <section id="topbar">
      <div class="container-fluid mx-auto">
        <div class="row">
          <div class="col-4">
            <p class="topbar-title font-weight-bold">
              Fastest Online Shopping destination
            </p>
          </div>

          <div class="col-8">
            <div class="top-item d-flex">
              <a href="#" class="top-links">Start Selling</a>
              <a href="#" class="top-links">Browse Brands</a>
              <a href="#" class="top-links">Buyer's Guide</a>
              <a href="#" class="top-links">Gift Cards</a>
              <a href="#" class="top-links">Help Center</a>

              <div class="social-icons">
                <a href="#"> <i class="fab fa-facebook-f"></i></a>
                <a href="#"> <i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
              </div>
              <!--END OF SOCIAL ICON-->
            </div>
            <!--END OF TOP-ITEM-->
          </div>
        </div>
        <!--END OF ROW-->
      </div>
    </section>
    <!--=====END OF TOPBAR=====-->


    <!--==============================
            HEADER SECTION
     ==============================-->
    <header class="header-section">
        <div class="container-fluid mx-auto">
            <div class="header-top">
                <div class="row pb-2">
                    <!--LOGO-->
                    <div class="col-lg-2">
                        <a href="{{URL::asset('frontend/index.html" class="logo text-center')}}">
                            <h2>Logo</h2>
                        </a>
                    </div><!--End of col-2-->
    
                    <!--SEARCH-->
                    <div class="col-xl-7 col-lg- d-flex mt-4">
                      <select class="custom-select">
                        <option selected>All</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                      </select>
                      <form class="header-search-form">
                        <input type="text" placeholder="Explore products & brands....">
                        <button><i class="fas fa-search"></i></button>
                      </form>
                    </div><!--End of col-7-->
    
                    <!--USER PANEL-->
                    <div class="col-lg-3">
                        <div class="user-panel float-right">
                            <a href=""><i class="fas fa-shopping-cart"></i>Cart<span>0</span></a>
                            <a href=""><i class="far fa-heart"></i>Wishlist</a>
                            <a href=""><i class="fas fa-user"></i>My Account</a>
    
                        </div>
                    </div>
                </div>
            </div>
        </div>
            
         <!--===============
                NAVIGATION
        =======================-->
        <div class="container-fluid">
                <nav id="navigation" class="navbar navbar-expand-lg navbar-light">
                      <ul class="navbar-nav mx-auto pt-2 pl-5">
                        <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            Mobiles & Electronics
                          </a>
                          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="#">Dropdown 1</a>
                            <a class="dropdown-item" href="#">Dropdown 2</a>
                            <a class="dropdown-item" href="#">Dropdown 3</a>
                          </div>
                        </li>
              
                        <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            Men's Fashion
                          </a>
                          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="#"> Dropdown1</a>
                            <a class="dropdown-item" href="#">Dropdown2</a>
                          </div>
                        </li>
      
                        <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            Women's Fashion
                          </a>
                          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="#">Dropdown 1</a>
                            <a class="dropdown-item" href="#">Dropdown 2</a>
                            <a class="dropdown-item" href="#">Dropdown 3</a>
                          </div>
                        </li>
      
                        <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            Home & Kitchen
                          </a>
                          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="#">Dropdown 1</a>
                            <a class="dropdown-item" href="#">Dropdown 2</a>
                            <a class="dropdown-item" href="#">Dropdown 3</a>
                          </div>
                        </li>
      
                        <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            Daily Essential
                          </a>
                          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="#">Dropdown 1</a>
                            <a class="dropdown-item" href="#">Dropdown 2</a>
                            <a class="dropdown-item" href="#">Dropdown 3</a>
                          </div>
                        </li>
              
                        <li class="nav-item">
                          <a class="nav-link" href="#">Offers</a>
                        </li>
              
                      </ul>
                      <div class="support float-right">
                        <span><i class="far fa-question-circle"></i>Support</span>
                    </div>
                    </nav>


             </div>
    </header>

    <!--==============================
            HERO SECTION
     ==============================-->
  <section id="hero">
    <div class="container-fluid hero-info mt-3">
      <div class="row">
        <div class="col-lg-2 d-none d-lg-block d-md-block">
          <div class="categories">
            <div class="categories-title">
              <span class="categories-head"><i class="fas fa-bars"></i>All Categories</span>
            </div>

            <ul class="list-group categories-list pt-3 bg-light">

              <li class="list-group-item categories-item">
                <a href="" class="categories link">
                    <i class="flaticon-shopping"></i>Grocies & Daily Essential</a>

              </li>

              <li class="list-group-item categories-item">
                <a href="" class="categories link">
                    <i class="flaticon-rechargeable"></i>Consumer Electronics</a>
              </li>

              <li class="list-group-item categories-item">
                <a href="" class="categories link">
                    <i class="flaticon-man-t-shirt"></i>Men’s Fashion</a>
              </li>

              <li class="list-group-item categories-item">
                <a href="" class="categories link">
                  <i class="flaticon-black-female-dress"></i>Women's Fashion</a>
              </li>

              <li class="list-group-item categories-item">
                <a href="" class="categories link">
                  <i class="flaticon-smartphone"></i>Mobile & Tablets</a>
              </li>

              <li class="list-group-item categories-item">
                <a href="" class="categories link">
                  <i class="flaticon-running"></i>Sports & Fitness</a>
              </li>

              <li class="list-group-item categories-item">
                <a href="" class="categories link">
                  <i class="flaticon-restaurant"></i>Home & Kitchen</a>
              </li>

              <li class="list-group-item categories-item">
                <a href="" class="categories link">
                  <i class="flaticon-baby-bottle"></i> Toy’s, Kids & Babies</a>
              </li>

              <li class="list-group-item categories-item">
                <a href="" class="categories link">
                  <i class="flaticon-bag"></i> Bags & Shoes</a>
              </li>

              <li class="list-group-item categories-item">
                <a href="" class="categories link">
                  <i class="flaticon-discount"></i> All Offers</a>
              </li>
            </ul>
          </div>
        </div>

          <div class="col-lg-8 col-md-12 col-sm-12">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <div class="image"></div>
                  <div class="carousel-caption">
                    <h1>Winter Collection</h1>
                    <p>Best Cloth Collection By 2020!</p>
                    <a href="#"><button type="button" class="btn btn-danger">Get Offer</button></a>
                  </div>
                </div>
                <div class="carousel-item">
                 <div class="image"></div>
                  <div class="carousel-caption">
                    <h1>Winter Collection</h1>
                    <p>Best Cloth Collection By 2020!</p>
                    <a href="#"><button type="button" class="btn btn-danger">Get Offer</button></a>
                  </div>
                </div>
                <div class="carousel-item">
                 <div class="image"></div>
                  <div class="carousel-caption">
                    <h1>Winter Collection</h1>
                    <p>Best Cloth Collection By 2020!</p>
                    <a href="#"><button type="button" class="btn btn-danger">Get Offer</button></a>
                  </div>
                </div>
              </div>
              <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
          </div>

          <div class="col-lg-2">
            <div class="pincode-form">
              <div class="image mt-5">
                <img src="{{URL::asset('frontend/assets/img/location.png')}}" alt="">
                <div class="pincode-item text-center">
                  <h6>Your Delivery Pincode</h6>
                  <p>Enter your pincode to check aviabability & faster deliver option</p>
                  <form class="mt-4">
                    <div class="form-group">
                      <input type="text" pattern="[0-9]{4}" maxlength="4" class="form-control" id="pin" name="pin" placeholder="Enter your pincode....">
                    </div>
                    <div class="form-group">
                      <input type="button" class="form-control" name="submit" value="Submit" >
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
  <!--=====END OF HERO SECTION=====-->


    <!--==============================
            ADVERTISE
     ==============================-->
     <section class="advertise">
         <div class="advertise-item mt-4">
           <a href="#">
             <img src="{{URL::asset('frontend/assets/img/advertise.png')}}" alt="">
           </a>
       </div>
     </section>
  <!--=====END OF ADVERTISE=====-->


    <!--==============================
            TODAY'S DEAL
     ==============================-->
     <section id="deal" class="py-5">
       <div class="container-fluid bg-light py-4">
        <div class="row">
          <div class="col-auto mr-auto  deal-title">
            <span class="font-weight-bold mt-2 deal-head">Today's Deal</span>
            <a href="#"> See all deals</a>
          </div>
          <div class="col-auto">
            <div class="countdown">
              <i class="far fa-clock mr-2"></i><span>Ends in:11:55:05</span>
            </div>
          </div>
        </div>

        <div class="slider py-4">
          <!--Item-1-->
          <div class="slider-item">
            <a href="{{URL::asset('frontend/product.html')}}" target="_blank">
            <img src="{{URL::asset('frontend/assets/img/deal1.png')}}" alt="Prodcuts1">
            <h6 class="info-title text-dark pl-4 mt-3">Green Cool Hoodies</h6>
            <div class=" row">
              <div class="col-auto mr-auto">
                <span class="product-price pl-4 mt-2">Rs. 1500</span>
                <span class="discount">Rs 29000</span>
              </div>
              <div class="col-auto pl-3">
                <a href=""><i class="flaticon-shopping-cart"></i></a>
              </div>
            </div>
            </a>  
          </div>
          <!--Item-2-->
          <div class="slider-item">
            <a href="{{URL::asset('frontend/product.html')}}" target="_blank">
            <img src="{{URL::asset('frontend/assets/img/deal2.png')}}" alt="Prodcuts2">
            <h6 class="info-title text-dark pl-4 mt-3">Yellow Women's Sweater</h6>
            <div class=" row">
              <div class="col-auto mr-auto">
                <span class="product-price pl-4 mt-2">Rs. 1800</span>
                <span class="discount">Rs 29000</span>
              </div>
              <div class="col-auto">
                <a href=""><i class="flaticon-shopping-cart"></i></a>
              </div>
            </div>
            </a>
          </div>
  
          <!--Item-3-->
          <div class="slider-item">
            <a href="{{URL::asset('frontend/product.html')}}" target="_blank">
            <img src="{{URL::asset('frontend/assets/img/deal1.png')}}" alt="Prodcuts3">
            <h6 class="info-title text-dark pl-4 mt-3">Green Cool Hoodies</h6>
            <div class=" row">
              <div class="col-auto mr-auto">
                <span class="product-price pl-4 mt-2">Rs. 1500</span>
                <span class="discount">Rs 29000</span>
              </div>
              <div class="col-auto">
                <a href=""><i class="flaticon-shopping-cart"></i></a>
              </div>
            </div>
            </a>
          </div>
  
          <!--Item-4-->
          <div class="slider-item">
            <a href="{{URL::asset('frontend/product.html')}}" target="_blank">
            <img src="{{URL::asset('frontend/assets/img/deal2.png')}}" alt="Prodcuts4">
            <h6 class="info-title text-dark pl-4 mt-3">Yellow Women's Sweater</h6>
            <div class=" row">
              <div class="col-auto mr-auto">
                <span class="product-price pl-4 mt-2">Rs. 1800</span>
                <span class="discount">Rs 29000</span>
              </div>
              <div class="col-auto">
                <a href=""><i class="flaticon-shopping-cart"></i></a>
              </div>
            </div>
            </a>
          </div>
  
          <!--Item-5-->
          <div class="slider-item">
            <a href="{{URL::asset('frontend/product.html')}}" target="_blank">
            <img src="{{URL::asset('frontend/assets/img/deal1.png')}}" alt="Prodcuts5">
            <h6 class="info-title text-dark pl-4 mt-3">Green Cool Hoodies</h6>
            <div class=" row">
              <div class="col-auto mr-auto">
                <span class="product-price pl-4 mt-2">Rs. 1500</span>
                <span class="discount">Rs 29000</span>
              </div>
              <div class="col-auto">
                <a href=""><i class="flaticon-shopping-cart"></i></a>
              </div>
            </div>
            </a>
          </div>
  
          <!--Item-6-->
          <div class="slider-item">
            <a href="{{URL::asset('frontend/product.html')}}" target="_blank">
            <img src="{{URL::asset('frontend/assets/img/deal2.png')}}" alt="Prodcuts3">
            <h6 class="info-title text-dark pl-4 mt-3">Yellow Women's Sweater</h6>
            <div class=" row">
              <div class="col-auto mr-auto">
                <span class="product-price pl-4 mt-2">Rs. 1800</span>
                <span class="discount">Rs 29000</span>
              </div>
              <div class="col-auto">
                <a href=""><i class="flaticon-shopping-cart"></i></a>
              </div>
            </div>
            </a>
          </div>

          <!--Item 7-->
          <div class="slider-item">
            <a href="{{URL::asset('frontend/product.html')}}" target="_blank">
            <img src="{{URL::asset('frontend/assets/img/deal1.png')}}" alt="Prodcuts7">
            <h6 class="info-title text-dark pl-4 mt-3">Green Cool Hoodies</h6>
            <div class=" row">
              <div class="col-auto mr-auto">
                <span class="product-price pl-4 mt-2">Rs. 1500</span>
                <span class="discount">Rs 29000</span>
              </div>
              <div class="col-auto">
                <a href=""><i class="flaticon-shopping-cart"></i></a>
              </div>
            </div>
            </a>
          </div>

          <!--Item-8-->
          <div class="slider-item">
            <a href="{{URL::asset('frontend/product.html')}}" target="_blank">
            <img src="{{URL::asset('frontend/assets/img/deal2.png')}}" alt="Prodcuts3">
            <h6 class="info-title text-dark pl-4 mt-3">Yellow Women's Sweater</h6>
            <div class=" row">
              <div class="col-auto mr-auto">
                <span class="product-price pl-4 mt-2">Rs. 1800</span>
                <span class="discount">Rs 29000</span>
              </div>
              <div class="col-auto">
                <a href=""><i class="flaticon-shopping-cart"></i></a>
              </div>
            </div>
            </a>
          </div>
        </div>
       </div>
     </section>
       <!--=====END OF TODAY'S DEAL=====-->

  
      <!--==============================
            TRENDING PRODUCTS
     ==============================-->
      <section id="trending" class="py-5">
        <div class="container-fluid">
          <div class="row">
            <div class="col-auto mr-auto">
              <span class="font-weight-bold mt-2 head">Trending Products</span>
            </div>
            <div class="col-auto">
               <a href="#" class="link">View More</a>
              </div>
            </div>
            <div class="trending-item pt-4">
              <div class="row">
                <!--Item 1-->
                <div class="col-lg-2 col-md-4 col-sm-12">
                  <div class="product-item">
                    <a href="{{URL::asset('frontend/product.html')}}" target="_blank">
                      <img src="{{URL::asset('frontend/assets/img/deal2.png')}}" alt="Prodcuts3">
                      <div class="discount-streak">
                        <i class="fas fa-certificate"></i>
                        <span>-20%</span>
                      </div>
                      <h6 class="info-title text-dark mt-3">Yellow Women's Sweater</h6>
                      <span class="product-price">Rs. 1200</span>
                      <span class="discount">Rs 1800</span>
  
                      <div class="product-rating">
                        <i class="fa fa-star checked "></i>
                        <i class="fa fa-star checked"></i>
                        <i class="fa fa-star checked"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      </div>
                      </a>
                  </div>
                </div>

                <!--Item 2-->
                <div class="col-lg-2 col-md-4 col-sm-12">
                  <div class="product-item">
                    <a href="{{URL::asset('frontend/product.html')}}" target="_blank">
                      <img src="{{URL::asset('frontend/assets/img/deal2.png')}}" alt="Prodcuts2">
                      <div class="discount-streak">
                        <i class="fas fa-certificate"></i>
                        <span>-20%</span>
                      </div>
                      <h6 class="info-title text-dark mt-3">Yellow Women's Sweater</h6>
                      <span class="product-price">Rs. 1200</span>
                      <span class="discount">Rs 1800</span>
  
                      <div class="product-rating">
                        <i class="fa fa-star checked "></i>
                        <i class="fa fa-star checked"></i>
                        <i class="fa fa-star checked"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      </div>
                      </a>
                  </div>
                </div>
  
                <!--Item 3-->
                <div class="col-lg-2 col-md-4 col-sm-12">
                  <div class="product-item">
                    <a href="{{URL::asset('frontend/product.html')}}" target="_blank">
                      <img src="{{URL::asset('frontend/assets/img/deal2.png')}}" alt="Prodcuts3">
                      <div class="discount-streak">
                        <i class="fas fa-certificate"></i>
                        <span>-20%</span>
                      </div>
                      <h6 class="info-title text-dark mt-3">Yellow Women's Sweater</h6>
                      <span class="product-price">Rs. 1200</span>
                      <span class="discount">Rs 1800</span>
  
                      <div class="product-rating">
                        <i class="fa fa-star checked "></i>
                        <i class="fa fa-star checked"></i>
                        <i class="fa fa-star checked"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      </div>
                      </a>
                  </div>
                </div>


                <!--Item 4-->
                <div class="col-lg-2 col-md-4 col-sm-12">
                  <div class="product-item">
                    <a href="{{URL::asset('frontend/product.html')}}" target="_blank">
                      <img src="{{URL::asset('frontend/assets/img/deal2.png')}}" alt="Prodcuts4">
                      <div class="discount-streak">
                        <i class="fas fa-certificate"></i>
                        <span>-20%</span>
                      </div>
                      <h6 class="info-title text-dark mt-3">Yellow Women's Sweater</h6>
                      <span class="product-price">Rs. 1200</span>
                      <span class="discount">Rs 1800</span>
  
                      <div class="product-rating">
                        <i class="fa fa-star checked "></i>
                        <i class="fa fa-star checked"></i>
                        <i class="fa fa-star checked"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      </div>
                      </a>
                  </div>
                </div>

                <!--Item 5-->
                <div class="col-lg-2 col-md-4 col-sm-12">
                  <div class="product-item">
                    <a href="{{URL::asset('frontend/product.html')}}" target="_blank">
                      <img src="{{URL::asset('frontend/assets/img/deal2.png')}}" alt="Prodcuts5">
                      <div class="discount-streak">
                        <i class="fas fa-certificate"></i>
                        <span>-20%</span>
                      </div>
                      <h6 class="info-title text-dark mt-3">Yellow Women's Sweater</h6>
                      <span class="product-price">Rs. 1200</span>
                      <span class="discount">Rs 1800</span>
  
                      <div class="product-rating">
                        <i class="fa fa-star checked "></i>
                        <i class="fa fa-star checked"></i>
                        <i class="fa fa-star checked"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      </div>
                      </a>
                  </div>
                </div>


                <!--Item 6-->
                <div class="col-lg-2 col-md-4 col-sm-12">
                  <div class="product-item">
                    <a href="{{URL::asset('frontend/product.html')}}" target="_blank">
                      <img src="{{URL::asset('frontend/assets/img/deal2.png')}}" alt="Prodcuts6">
                      <div class="discount-streak">
                        <i class="fas fa-certificate"></i>
                        <span>-20%</span>
                      </div>
                      <h6 class="info-title text-dark mt-3">Yellow Women's Sweater</h6>
                      <span class="product-price">Rs. 1200</span>
                      <span class="discount">Rs 1800</span>
  
                      <div class="product-rating">
                        <i class="fa fa-star checked "></i>
                        <i class="fa fa-star checked"></i>
                        <i class="fa fa-star checked"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      </div>
                      </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
       <!--=====END OF TRENDING PRODUCTS=====-->   

    <!--==============================
            ADVERTISE
     ==============================-->
     <section class="advertise">
      <div class="advertise-item mt-4 mx-auto">
        <a href="#">
          <img src="{{URL::asset('frontend/assets/img/advertise2.png')}}" alt="">
        </a>
    </div>
  </section>
<!--=====END OF ADVERTISE=====-->
  

    <!--==============================
            FEATURED PRODUCTS
     ==============================-->
      <section id="featured" class="py-5">
        <div class="container-fluid bg-light py-4 mx-auto">
          <div class="row">
            <div class="col-auto mr-auto">
              <span class="font-weight-bold mt-2 head">Featured Products</span>
            </div>
            <div class="col-auto">
               <a href="#" class="link">View More</a>
              </div>
            </div>

            <div class="featured-item">
              <div class="row">
                <div class="col-lg-4 col-md-12 col-sm-12 py-5">
                  <a href=""><img src="{{URL::asset('frontend/assets/img/featured-head1.png')}}" alt="Featured Head"></a>
                </div>

                <div class="col-lg-8 col-md-12 col-sm-12 py-5">
                  <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12">
                       <div class="items bg-white">
                      <h6>Women's Jwellery</h6>
                        <div class="row">
                          <a href=""><img src="{{URL::asset('frontend/assets/img/jewel-1.png')}}" alt=""></a>
                          <a href=""><img src="{{URL::asset('frontend/assets/img/jewel-2.png')}}" alt=""></a>
                          <a href=""><img src="{{URL::asset('frontend/assets/img/jewel-3.png')}}" alt=""></a>
                          <a href=""><img src="{{URL::asset('frontend/assets/img/jewel-4.png')}}" alt=""></a>
                        </div>
                      </div>
                    </div>
    
                    <div class="col-lg-6 col-md-12 col-sm-12">
                       <div class="items bg-white">
                      <h6>Women's Fashion</h6>
                        <div class="row">
                          <a href=""><img src="{{URL::asset('frontend/assets/img/bag.png')}}" alt=""></a>
                          <a href=""><img src="{{URL::asset('frontend/assets/img/dress.png')}}" alt=""></a>
                          <a href=""><img src="{{URL::asset('frontend/assets/img/dress2.png')}}" alt=""></a>
                          <a href=""><img src="{{URL::asset('frontend/assets/img/cltuch.png')}}" alt=""></a>
                        </div>
                      </div>
                    </div>

    
                    <div class="col-lg-6 col-md-12 col-sm-12">
                       <div class="items bg-white">
                      <h6>Women's Fashion</h6>
                        <div class="row">
                          <a href=""><img src="{{URL::asset('frontend/assets/img/bag.png')}}" alt=""></a>
                          <a href=""><img src="{{URL::asset('frontend/assets/img/dress.png')}}" alt=""></a>
                          <a href=""><img src="{{URL::asset('frontend/assets/img/dress2.png')}}" alt=""></a>
                          <a href=""><img src="{{URL::asset('frontend/assets/img/cltuch.png')}}" alt=""></a>
                        </div>
                      </div>
                    </div>  

                    <div class="col-lg-6 col-md-12 col-sm-12">
                       <div class="items bg-white">
                      <h6>Women's Jwellery</h6>
                        <div class="row">
                          <a href=""><img src="{{URL::asset('frontend/assets/img/jewel-1.png')}}" alt=""></a>
                          <a href=""><img src="{{URL::asset('frontend/assets/img/jewel-2.png')}}" alt=""></a>
                          <a href=""><img src="{{URL::asset('frontend/assets/img/jewel-3.png')}}" alt=""></a>
                          <a href=""><img src="{{URL::asset('frontend/assets/img/jewel-4.png')}}" alt=""></a>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>


                
              </div>
            </div>
        </div>
      </section>

      <!--=====END OF FEATURED PRODUCTS=====-->
    <!--==============================
            GROCERY
     ==============================-->
     <section id="deal" class="py-5">
      <div class="container-fluid py-4">
        <div class="row">
          <div class="col-auto mr-auto">
            <span class="font-weight-bold mt-2 head">groceries</span>
          </div>
          <div class="col-auto">
             <a href="#" class="link">View More</a>
            </div>
          </div>

       <div class="grocery py-4">
         <!--Item-1-->
         <div class="slider-item">
           <a href="{{URL::asset('frontend/product.html')}}" target="_blank">
           <img src="{{URL::asset('frontend/assets/img/good-day.png')}}" alt="Prodcuts1">
           <h6 class="info-title text-dark mt-3">Good Day Biscuit</h6>
           <div class=" row">
             <div class="col-auto mr-auto">
               <span class="product-price mt-2">Rs. 50</span>
               <span class="discount">Rs 80</span>
             </div>
             <div class="col-auto pl-3">
               <a href=""><i class="flaticon-shopping-cart"></i></a>
             </div>
           </div>
          <div class="product-rating">
            <span class="fa fa-star checked "></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
          </div>
           </a>  
         </div>

         <!--Item-2-->
         <div class="slider-item">
           <a href="{{URL::asset('frontend/product.html')}}" target="_blank">
           <img src="{{URL::asset('frontend/assets/img/combo.png')}}" alt="Prodcuts2">
           <h6 class="info-title text-dark mt-3">3 Combo Biscuit</h6>
           <div class=" row">
             <div class="col-auto mr-auto">
               <span class="product-price mt-2">Rs. 100</span>
               <span class="discount">Rs 300</span>
             </div>
             <div class="col-auto">
               <a href=""><i class="flaticon-shopping-cart"></i></a>
             </div>
           </div>
          <div class="product-rating">
            <span class="fa fa-star checked "></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
          </div>
           </a>
         </div>
 
         <!--Item-3-->
         <div class="slider-item">
           <a href="{{URL::asset('frontend/product.html')}}" target="_blank">
           <img src="{{URL::asset('frontend/assets/img/chocopie.png')}}" alt="Prodcuts3">
           <h6 class="info-title text-dark mt-3">Choco Pie</h6>
           <div class=" row">
             <div class="col-auto mr-auto">
               <span class="product-price mt-2">Rs. 50</span>
               <span class="discount">Rs 80</span>
             </div>
             <div class="col-auto">
               <a href=""><i class="flaticon-shopping-cart"></i></a>
             </div>
           </div>
          <div class="product-rating">
            <span class="fa fa-star checked "></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
          </div>
           </a>
         </div>


         <!--Item-4-->
         <div class="slider-item">
          <a href="{{URL::asset('frontend/product.html')}}" target="_blank">
          <img src="{{URL::asset('frontend/assets/img/good-day.png')}}" alt="Prodcuts1">
          <h6 class="info-title text-dark mt-3">Good Day Biscuit</h6>
          <div class=" row">
            <div class="col-auto mr-auto">
              <span class="product-price mt-2">Rs. 50</span>
              <span class="discount">Rs 80</span>
            </div>
            <div class="col-auto pl-3">
              <a href=""><i class="flaticon-shopping-cart"></i></a>
            </div>
          </div>          <div class="product-rating">
            <span class="fa fa-star checked "></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
          </div>
          </a>  
        </div>

         <!--Item-5-->
         <div class="slider-item">
          <a href="{{URL::asset('frontend/product.html')}}" target="_blank">
          <img src="{{URL::asset('frontend/assets/img/combo.png')}}" alt="Prodcuts2">
          <h6 class="info-title text-dark mt-3">3 Combo Biscuit</h6>
          <div class=" row">
            <div class="col-auto mr-auto">
              <span class="product-price mt-2">Rs. 100</span>
              <span class="discount">Rs 300</span>
            </div>
            <div class="col-auto">
              <a href=""><i class="flaticon-shopping-cart"></i></a>
            </div>
          <div class="product-rating pl-4">
            <span class="fa fa-star checked "></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
          </div>
          </div>
          </a>
        </div>
         
          <!--Item-6-->
          <div class="slider-item">
            <a href="{{URL::asset('frontend/product.html')}}" target="_blank">
            <img src="{{URL::asset('frontend/assets/img/chocopie.png')}}" alt="Prodcuts3">
            <h6 class="info-title text-dark mt-3">Choco Pie</h6>
            <div class=" row">
              <div class="col-auto mr-auto">
                <span class="product-price mt-2">Rs. 50</span>
                <span class="discount">Rs 80</span>
              </div>
              <div class="col-auto">
                <a href=""><i class="flaticon-shopping-cart"></i></a>
              </div>
          <div class="product-rating pl-4">
            <span class="fa fa-star checked "></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
          </div>
            </div>
            </a>
          </div>
 
      
       </div>
      </div>
    </section>
      <!--=====END OF GROCERY=====-->


    <!--==============================
            SERVICES
     ==============================-->
     <section id="service" class="mb-5">
       <div class="container-fluid mx-auto">
         <div class="row">
           <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="p-4 service-item text-center secure">
              <img src="{{URL::asset('frontend/assets/img/secure.png')}}" alt="Secure Payments" class="mx-auto">
              <h6>100% Secure Payments</h6>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Id, veroconsec  </p>
            </div>
           </div>

           <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="p-4 service-item text-center delivery">
              <img src="{{URL::asset('frontend/assets/img/delivery.png')}}" alt="Delivery" class="mx-auto">
              <h6>On Time Delivery</h6>
              <p>Lorem ipsum dolor sit amet consectetur adipis  consec  </p>
            </div>
           </div>

           <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="p-4 service-item text-center cus-service">
              <img src="{{URL::asset('frontend/assets/img/customer-service.png')}}" alt="Customer Service" class="mx-auto">
              <h6>Excellent Customer Service</h6>
              <p>Lorem ipsum dolor sit amet consectetur adipis  consec  </p>
            </div>
           </div>

           <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="p-4 service-item text-center trust-pay">
              <img src="{{URL::asset('frontend/assets/img/trust- pay.png')}}" alt="Trust Pay" class="mx-auto">
              <h6>Trust Pay</h6>
              <p>Lorem ipsum dolor sit amet consectetur adipis  consec  </p>
            </div>
           </div>
         </div>
       </div>
     </section>
     
      <!--=====END OF SERVICES=====-->



    <!--==============================
            MEGAFOOTER
     ==============================-->
     <section id="mega-footer">
       <div class="container-fluid mx-auto">
         <div class="offers text-center py-5">
            <h6>Keep Updated  & get unlimited offfers</h6>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quibusdam beatae quae alias ullam error tempora quo, molestiae consectetur illo culpa.</p>
            <div class="col-lg-12">
              <form class="footer-form">
                <div class="form-group mt-4">
                  <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Your email address......">
                  <input type="submit" name="submit" id="subscribe" value="Subscribe">
                </div>            
              </form>
            </div>
         </div>

         <div class="row pb-5">
           <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="footer-item">
              <h6>Company Name</h6>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus dolores libero impedit, iusto aspernatur facilis sunt, consequatur ipsum itaque id repellendus nam praesentium, repellat rem</p>
            </div>
           </div>

           <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="footer-item">
              <h6>Your Order</h6>
              <ul class="footer-list">
                <li><a href="">Login to yout Account</a></li>
                <li><a href="">Your Wishlist</a></li>
                <li><a href="">Comparison List</a></li>
              </ul>
            </div>
           </div>

           <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="footer-item">
              <h6>Quick Links</h6>
              <ul class="footer-list">
                <li><a href="">About Us</a></li>
                <li><a href="">Careers</a></li>
                <li><a href="">Gift Cards</a></li>
                <li><a href="">Our Stories</a></li>
                <li><a href="">Site Map</a></li>
              </ul>
            </div>
           </div>

           <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="footer-item">
              <h6>Connect With Us</h6>
              <ul class="footer-list">
                <li><a href="">
                  <i class="fas fa-phone-volume"></i>+977 98372829
                </a></li>
                <li><a href="">
                  <i class="fas fa-envelope"></i>example@gmail.com
                </a></li>
                <li><a href=""><i class="fas fa-map-marker-alt"></i>
                  location</a></li>
              </ul>
              <div class="social-icons">
                <a href="#"> <i class="fab fa-facebook-f"></i></a>
                <a href="#"> <i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
              </div>
            </div>
           </div>

           <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="footer-item">
              <h6>Need Help?</h6>
              <ul class="footer-list">
                <li><a href="">Track Order</a></li>
                <li><a href="">Return Policy</a></li>
                <li><a href="">Shipping Information</a></li>
                <li><a href="">FAQs</a></li>
                <li><a href="">Terms & Conditions</a></li>
                <li><a href="">Privacy Policy</a></li>
              </ul>
            </div>
           </div>

           <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="footer-item">
              <h6>Online Payment Options</h6>
              <ul class="footer-list">
                <li><a href=""><img src="{{URL::asset('frontend/assets/img/esewa logo.png')}}" alt="E-sewa"></a></li>
                <li><a href=""><img src="{{URL::asset('frontend/assets/img/khalti.png')}}" alt="Khalti"></a></li>
                <li><a href=""><img src="{{URL::asset('frontend/assets/img/ime_pay.png')}}" alt="IME Pay"></a></li>
              </ul>
            </div>
           </div>
         </div>
       </div>
     </section>
      <!--=====END OF MEGAFOOTER=====-->

    <!--==============================
              FOOTER
     ==============================-->
      <section id="footer">
        <div class="container-fluid">
          <p>Copyright &copy; 2020. All Right Reserved</p>
        </div>
      </section>
      <!--=====END OF FOOTER=====-->


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js')}}, then Bootstrap JS -->
    <script
      type="text/javascript"
      src="{{URL::asset('frontend/vendors/bootstrap/js/jquery.min.js')}}"
    ></script>
    <script
      type="text/javascript"
      src="{{URL::asset('frontend/vendors/bootstrap/js/popper.min.js')}}"
    ></script>
    <script
      type="text/javascript"
      src="{{URL::asset('frontend/vendors/bootstrap/js/bootstrap.min.js')}}"
    ></script>

      <!--slick Js Link-->
      <script type="text/javascript" src="{{URL::asset('frontend/vendors/slick/slick.min.js')}}"></script>

      <!--Cutom Js-->
      <script type="text/javascript" src="{{URL::asset('frontend/assets/js/main.js')}}"></script>

  </body>
</html>
