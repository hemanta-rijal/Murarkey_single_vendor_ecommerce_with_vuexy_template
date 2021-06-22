 @extends('frontend.user.partials.dashboard-layout')
 @section('dashboard-body')
 <div class="db-content">
     <div class="col-md-3 pull-right">
         {{-- <a href="#" class="btn btn-primary mt-4 justify-content-center">Edit Details</a> --}}
         <button type="button" class="btn btn-primary mt-4 ">
             Edit Details
                      </button>
                    </div>
                    <br>

     <div class="table-responsive">
         <table class="table">
                           
                      <tbody>
                        <tr>
                          <td>
                            Username
                          </td>
                          <td>
                            Amy Santiago
                          </td>
                        </tr>
                        <tr>
                          <td>
                            Shipping Address
                          </td>
                          <td>
                            Kathmandu, 32007, Nepal
                          </td>
                        </tr>

                        <tr>
                          <td>
                            Billing Address
                          </td>
                          <td>
                            Pokhara, 43007, Nepal
                          </td>
                        </tr>

                        <tr>
                          <td>email</td>
                          <td>amy99@gmail.com</td>

                        </tr>
                        <tr>
                          <td>Username</td>
                          <td>amy_santiago99</td>
                        </tr>

                        <tr>
                          <td>Phone Num</td>
                          <td>01-98645688</td>
                        </tr>


                        <tr>
                          <td>
                            Currency Type
                          </td>
                          <td>
                            <div class="currency-selected">
                              <img src="{{ asset('frontend/img/npflag.png" alt="">
                              Nepalese
                            </div>
                          </td>
                        </tr>

                      </tbody>
                    </table>
                  </div>
                </div>
 @endsection