 @extends('frontend.user.partials.dashboard-layout')
 @section('dashboard-body')
               <div class="db-cards">
                <div class="db-card green">
                 <div class="left">
                  <h2>12</h2>
                  <p>Product In cart
                  </p>
                 </div>
                 <div class="icon">
                  <i class="fa fa-shopping-bag"></i>
                 </div>
                </div>

                <div class="db-card blue">
                  <div class="left">
                   <h2>3</h2>
                   <p>Products In Wishlist
                   </p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-heart"></i>
                  </div>
                 </div>


                 <div class="db-card orange">
                  <div class="left">
                   <h2><span>Rs</span> 2560</h2>
                   <p>
                    Total Amount in Wallet

                   </p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-money"></i>

                  </div>
                 </div>


                 <div class="db-card pink">
                  <div class="left">
                   <h2>7</h2>
                   <p>Total Product Orders
                   </p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-truck" aria-hidden="true"></i>

                  </div>
                 </div>
              </div>

              
          <div class="db-content">
                <div class="row">
                  <div class="col">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title">Billing Address</h5>
                        <p class="card-text">
                          <ul class="list-group list-group-flush">
                            <li class="list-group-item">Nirannjan Adhikari</li>
                            <li class="list-group-item">Kathmandu</li>
                            <li class="list-group-item">Pokhara</li>
                            <li class="list-group-item">32007</li>
                            <li class="list-group-item">Afghanistan</li>
                          </ul>
                        </p>
                        <a href="#" class="btn btn-primary mt-4 justify-content-center">Edit Details</a>

                      </div>
                    </div>
                  </div>

                  <div class="col">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title">Shipping Address</h5>
                        <p class="card-text">
                          <ul class="list-group list-group-flush">
                            <li class="list-group-item">Jiwan Adhikari</li>
                            <li class="list-group-item">Kathmandu</li>
                            <li class="list-group-item">Pokhara</li>
                            <li class="list-group-item">32007</li>
                            <li class="list-group-item">Afghanistan</li>
                          </ul>
                        </p>
                        <a href="#" class="btn btn-primary mt-4 justify-content-center">Edit Details</a>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
 @endsection