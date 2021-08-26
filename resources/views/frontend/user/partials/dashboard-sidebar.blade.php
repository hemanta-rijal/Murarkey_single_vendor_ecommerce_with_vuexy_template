 <div class="
          col-lg-3 col-md-6 col-sm-8
           order-lg-first">
            <div class="db-sidebar">
              <div class="user">
                <div class="user-img-box">
                  <img id="profilePicture" src="{{Auth::guard('web')->user()->profile_pic_url}}" alt=" {{Auth::guard('web')->user()->name}}">
                  <a href="#" class="overlay">
                    <i class="fa fa-pencil"></i>
                    Change picture
                  </a>
                  <form id="updateUserProfilePicture" action="{{route('user.upload-profile-pic')}}" method="post" enctype="multipart/form-data">
                    @csrf
                      <input type="file" name="profile_pic" id="changePic" onchange="updateProfile(this.files[0])" class="form-control d-none" accept="image/*">
                  </form>
                </div>
                
                <div class="name">
                  {{Auth::guard('web')->user()->name}}
                </div>

              </div>

              <ul class="side-nav">
                <li>
                  <a href="{{route('user.dashboard')}}">Dashboard</a>
                </li>
                <li>
                  <a href="{{route('user.my-orders.index')}}">My Orders</a>
                </li>
                <li>
                  <a href="{{route('user.wishlist.index')}}">Wishlists</a>
                </li>
                <li>
                  <a href="{{route('user.my-account')}}">Manage Profile</a>
                </li>
                <li>
                  <a href="{{route('user.update-password')}}">Update Password</a>
                </li>
                <li>
                  <a href="{{route('user.my-account.wallet')}}">My Wallets</a>
                </li>
                <li >
                  <a href="{{route('logout')}}">Logout</a>
                </li>
              </ul>
            </div>
          </div>