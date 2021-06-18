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
                        <h5 class="card-title">Billing Information</h5>
                        <p class="card-text">
                          <ul class="list-group list-group-flush">
                            @if($user->billing_details)
                            <li class="list-group-item">{{$user->billing_details->state}}</li>
                            <li class="list-group-item">{{$user->billing_details->city}}</li>
                            <li class="list-group-item">{{$user->billing_details->specific_address}}</li>
                            <li class="list-group-item">{{$user->billing_details->zip}}</li>
                            <li class="list-group-item">{{$user->billing_details->country}}</li>
                            @else
                            <li class="list-group-item" style="color: red">Billing details not updated yet</li>
                            @endif
                          </ul>
                        </p>
                        {{-- <a href="#" class="btn btn-primary mt-4 justify-content-center">Edit Details</a> --}}
                        <button type="button" class="btn btn-primary mt-4 justify-content-center" onclick="showBillingAddressPopup()">
                          Edit Details
                        </button>
                      </div>
                    </div>  
                  </div>

                  <div class="col">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title">Shipping Address</h5>
                        <p class="card-text">
                          <ul class="list-group list-group-flush">
                            @if($user->shipment_details)
                             <li class="list-group-item">{{$user->shipment_details->state}}</li>
                            <li class="list-group-item">{{$user->shipment_details->city}}</li>
                            <li class="list-group-item">{{$user->shipment_details->specific_address}}</li>
                            <li class="list-group-item">{{$user->shipment_details->zip}}</li>
                            <li class="list-group-item">{{$user->shipment_details->country}}</li>
                            @else
                            <li class="list-group-item" style="color: red">Shipment details not updated yet</li>
                            @endif
                          </ul>
                        </p>
                       <button type="button" class="btn btn-primary mt-4 justify-content-center" onclick="showShippingAddressPopup()">
                          Edit Details
                        </button>
                      </div>
                    </div>
                  </div>

                </div>
            </div>

            <div class="modal fade bd-example-modal-lg" id="billingModal" tabindex="-1" role="dialog" aria-labelledby="billingModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="billingModalLabel">Billing Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                      <form  action="{{route('update.billing-detail')}}" method="POST">
                        @method('put')
                        @csrf
                        <div class="modal-body">
                            <p class="card-text">
                                <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="name">State</label>
                                            <input type="text" name="state" class="form-control" placeholder="State"  value="{{$user->billing_details ? $user->billing_details->state : null }}"  required/>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="name">City</label>
                                            <input type="text" name="city" class="form-control" placeholder="City"  value="{{$user->billing_details ? $user->billing_details->city : null }}"  required/>
                                        </div>
                                        <div class="col-md-6 form-group">
                                          <label for="address">Specific Address</label>
                                          <input type="text" name="specific_address" class="form-control" placeholder="Specific Address"  value="{{$user->billing_details ? $user->billing_details->specific_address : null }}" required/>
                                        </div>
                                        <div class="col-md-6 form-group">
                                          <label for="zip">Zip</label>
                                          <input type="text" name="zip" class="form-control" placeholder="zip" value="{{$user->billing_details ? $user->billing_details->zip : null}}"  required />
                                        </div>
                                        <div class="col-md-6 form-group">
                                          <label for="zip">Country</label>
                                          <input type="text" name="country" class="form-control" placeholder="Country" value="{{$user->billing_details ? $user->billing_details->country : null  }}"  required />
                                        </div>
                                </div>
                            </p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" value="submit" class="btn btn-primary">Save changes</button>
                        </div>
                      </form>
                </div>
              </div>
            </div>

            <div class="modal fade bd-example-modal-lg" id="shippingModal" tabindex="-1" role="dialog" aria-labelledby="shippingModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="shippingModalLabel">Shipping Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
{{--                    <form action="{{route('update.shipment-detail')}}" method="POST">--}}
{{--                          @csrf--}}
{{--                        @method('put')--}}
{{--                       <div class="modal-body">--}}
{{--                            <p class="card-text">--}}
{{--                                <div class="row">--}}
{{--                                 <div class="col-md-6 form-group">--}}
{{--                                      <label for="name">State</label>--}}
{{--                                      <input type="text" name="state" class="form-control" placeholder="State"   value="{{ $user->billing_details ? $user->shipment_details->state : null }}"  required/>--}}
{{--                                  </div>--}}
{{--                                  <div class="col-md-6 form-group">--}}
{{--                                      <label for="name">City</label>--}}
{{--                                      <input type="text" name="city" class="form-control" placeholder="City"  value="{{$user->billing_details ? $user->shipment_details->city : null }}"  required/>--}}
{{--                                  </div>--}}
{{--                                  <div class="col-md-6 form-group">--}}
{{--                                    <label for="address">Specific Address</label>--}}
{{--                                    <input type="text" name="specific_address" class="form-control" placeholder="Specific Address"  value="{{$user->billing_details ? $user->specific_address->city : null}}" required/>--}}
{{--                                  </div>--}}
{{--                                  <div class="col-md-6 form-group">--}}
{{--                                    <label for="zip">Zip</label>--}}
{{--                                    <input type="text" name="zip" class="form-control" placeholder="zip" value="{{$user->billing_details ? $user->specific_address->zip : null}}"  required />--}}
{{--                                  </div>--}}
{{--                                  <div class="col-md-6 form-group">--}}
{{--                                    <label for="zip">Country</label>--}}
{{--                                    <input type="text" name="country" class="form-control" placeholder="Country" value="{{$user->billing_details ? $user->specific_address->country : null}}"  required />--}}
{{--                                  </div>--}}
{{--                                </div>--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                      <div class="modal-footer">--}}
{{--                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
{{--                        <button type="submit" value="submit" class="btn btn-primary">Save changes</button>--}}
{{--                      </div>--}}
{{--                    </form>--}}
                </div>
              </div>
            </div>

       

 @endsection

@section('js')
<script>
  function showBillingAddressPopup(){
     $('#billingModal').modal('toggle')
  }
  function showShippingAddressPopup(){
     $('#shippingModal').modal('toggle')
  }
</script>
@endsection