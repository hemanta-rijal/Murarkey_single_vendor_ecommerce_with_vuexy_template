 @extends('frontend.user.partials.dashboard-layout')
 @section('dashboard-body')
               
          <div class="db-content">
                <div class="row">
                  <div class="col">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title">Billing Address</h5>
                        <form action="{{route('update.billing-detail')}}" method="POST">
                          @method('put')
                          @csrf
                          <p class="card-text">
                            <ul class="list-group list-group-flush">
                              <li class="list-group-item">
                                <label for="billing-name">Billing Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Billing Name"  value="{{$user->billing_details->name}}""  required/>
                              </li>
                              <li class="list-group-item">
                                <input type="text" name="address" class="form-control" placeholder="Billing Address"  value="{{$user->billing_details->address}} " required/>
                              </li>
                              <li class="list-group-item">
                                <input type="text" name="email" class="form-control"  placeholder="email" value="{{$user->billing_details->email}}"  required/>
                              </li>
                              <li class="list-group-item">
                                <input type="text" name="phone_number" class="form-control" placeholder="phone" value="{{$user->billing_details->phone_number}}"  required />
                              </li>
                              <li class="list-group-item">
                                <input type="text" name="city" class="form-control" placeholder="city" value="{{$user->billing_details->city}}"  required />
                              </li>
                              <li class="list-group-item">
                                <input type="text" name="zip" class="form-control" placeholder="zip" value="{{$user->billing_details->zip}}"  required />
                              </li>
                            </ul>
                          </p>
                        {{-- <a href="#" class="btn btn-primary mt-4 justify-content-center">Edit Details</a> --}}
                        {{-- <a href="#" class="btn btn-primary mt-4 justify-content-center" value="submit">Update Details</a> --}}
                        <button class="btn btn-primary mt-4 justify-content-center" value="submit">Update Details</button>
                      </form>
                      </div>
                    </div>
                  </div>
                  
                </div>
            </div>
 @endsection