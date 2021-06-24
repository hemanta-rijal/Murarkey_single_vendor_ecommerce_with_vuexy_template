 <div class="
          col-lg-3 col-md-6 col-sm-8
           order-lg-first">
            <div class="db-sidebar">
              <div class="user">
                <img src="{{Auth::guard('web')->user()->profile_pic_url}}" alt="">
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
                  <a href="{{route('wishlist.index')}}">Wishlists</a>
                </li>
                <li>
                  <a href="{{route('user.edit-profile')}}">Manage Profile</a>
                </li>
                <li>
                  <a href="{{route('user.my-account.wallet')}}">My Wallets</a>
                </li>
                <li>
                  <a href="{{route('logout')}}">Logout</a>
                </li>
              </ul>
            </div>
          </div>