      <!--==============================
              HERO SECTION
      ==============================-->
     <section id="hero">
        <div class="container-fluid hero-info mt-3">
          <div class="row">
               <div class="col-lg-2">
                    <div class="categories">
                         <div class="categories-title">
                              <span class="categories-head"><i class="fas fa-bars"></i>All Categories</span>
                         </div>
                         
                         <ul class="list-group categories-list">
                           @if(get_root_categories())
                              @foreach(get_root_categories()->take(12) as  $category)
                              <li class="list-group-item categories-item">
                                   <a href="/products/search?category={{ $category->slug }}" class="categories link">
                                        <img src="{{resize_image_url($category->image_path, '50X50')}}" alt="{{$category->name}}" style="max-width: 20px; height:auto; object-fit:cover">
                                       {{str_limit($category->name, 20)}}
                                   </a>
                                   @if($category->children->count() > 0)
                                     <ul class="sideMega">
                                        @foreach($category->children as $subCategory)     
                                          <li>
                                               <a href="/products/search?category={{ $subCategory->slug }}">
                                                  <h6>
                                                  {{ $subCategory->name }}
                                                  </h6>
                                             </a>
                                             @if($category->children->count() > 0)
                                                  <ul>
                                                    @foreach($subCategory->children as $subSubCategory)     
                                                       <li><a href="/products/search?category={{ $subSubCategory->slug }}"> {{ $subSubCategory->name }}</a></li>
                                                    @endforeach
                                                  </ul>
                                             @endif
                                                
                                          </li>
                                        @endforeach
                                     </ul>
                                   @endif
                              </li>
                              @endforeach
                              @endif
                         </ul>
                    </div>
               </div>

               <div class="col-lg-8 col-md-12 col-sm-12">
               <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
               <div class="carousel-inner">
                    {{--  {{dd(get_banner_by_slug('homepage-slidder'))}}  --}}
                 @foreach(get_banners_by_slug('homepage-slider') as $index => $slide)
                    <div class="carousel-item  {{  $index == 0 ? 'active' : ''}}">
                    <div class="image">
                      <a href="{{ $slide->link ? $slide->link : '' }}">
                                    <img src="{{ map_storage_path_to_link($slide->image) }}" alt="{{ $slide->caption }}" style="height: auto; object-fit: cover;" />
                        </a>
                    </div>
                    <div class="carousel-caption">
                         {{-- <h1>{{ $slide->caption }}</h1>
                         <p>Best Cloth Collection By 2020!</p>
                         <a href="#"><button type="button" class="btn btn-danger">Get Offer</button></a> --}}
                    </div>
                    </div>
                  @endforeach

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