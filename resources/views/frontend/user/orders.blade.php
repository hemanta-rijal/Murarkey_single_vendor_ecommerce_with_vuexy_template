 @extends('frontend.user.partials.dashboard-layout')
 @section('dashboard-body')
  <div class="db-content">
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead class="thead-">
                        <tr>
                          <th>Code</th>
                          <th>Date</th>
                          <th>Amount</th>
                          <th>Delivery Status</th>

                          <th>Payment Status</th>

                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>20215654548</td>
                          <td>09-06-2021</td>
                          <td>NPR. 57,080</td>
                          <td>On Delivery</td>
                          <td>Paid</td>
                          <td>

                            <div class="dropdown">
                              <button
                              class="dropdown-toggle"
                              type="button"

                              data-toggle="dropdown"
                              aria-haspopup="true"
                              aria-expanded="false"
                              >
                              <i class="fa fa-ellipsis-v" aria-hidden="true"></i>

                              </button>
                              <div
                                class="dropdown-menu"
                                aria-labelledby="dropdownMenuButton"
                              >
                                <a class="dropdown-item" href="#">Edit</a>
                                <a class="dropdown-item" href="#"
                                  >Delete</a
                                >

                              </div>
                            </div>
                          </td>
                        </tr>

                        <tr>
                          <td>20215654548</td>
                          <td>09-06-2021</td>
                          <td>NPR. 57,080</td>
                          <td>On Delivery</td>
                          <td>Paid</td>
                          <td>

                            <div class="dropdown">
                              <button
                              class="dropdown-toggle"
                              type="button"

                              data-toggle="dropdown"
                              aria-haspopup="true"
                              aria-expanded="false"
                              >
                              <i class="fa fa-ellipsis-v" aria-hidden="true"></i>

                              </button>
                              <div
                                class="dropdown-menu"
                                aria-labelledby="dropdownMenuButton"
                              >
                                <a class="dropdown-item" href="#">Edit</a>
                                <a class="dropdown-item" href="#"
                                  >Delete</a
                                >

                              </div>
                            </div>
                          </td>
                        </tr>


                        <tr>
                          <td>20215654548</td>
                          <td>09-06-2021</td>
                          <td>NPR. 57,080</td>
                          <td>On Delivery</td>
                          <td>Paid</td>
                          <td>

                            <div class="dropdown">
                              <button
                              class="dropdown-toggle"
                              type="button"

                              data-toggle="dropdown"
                              aria-haspopup="true"
                              aria-expanded="false"
                              >
                              <i class="fa fa-ellipsis-v" aria-hidden="true"></i>

                              </button>
                              <div
                                class="dropdown-menu"
                                aria-labelledby="dropdownMenuButton"
                              >
                                <a class="dropdown-item" href="#">Edit</a>
                                <a class="dropdown-item" href="#"
                                  >Delete</a
                                >

                              </div>
                            </div>
                          </td>
                        </tr>



                        <tr>
                          <td>20215654548</td>
                          <td>09-06-2021</td>
                          <td>NPR. 57,080</td>
                          <td>On Delivery</td>
                          <td>Paid</td>
                          <td>

                            <div class="dropdown">
                              <button
                              class="dropdown-toggle"
                              type="button"

                              data-toggle="dropdown"
                              aria-haspopup="true"
                              aria-expanded="false"
                              >
                              <i class="fa fa-ellipsis-v" aria-hidden="true"></i>

                              </button>
                              <div
                                class="dropdown-menu"
                                aria-labelledby="dropdownMenuButton"
                              >
                                <a class="dropdown-item" href="#">Edit</a>
                                <a class="dropdown-item" href="#"
                                  >Delete</a
                                >

                              </div>
                            </div>
                          </td>
                        </tr>



                        <tr>
                          <td>20215654548</td>
                          <td>09-06-2021</td>
                          <td>NPR. 57,080</td>
                          <td>On Delivery</td>
                          <td>Paid</td>
                          <td>

                            <div class="dropdown">
                              <button
                              class="dropdown-toggle"
                              type="button"

                              data-toggle="dropdown"
                              aria-haspopup="true"
                              aria-expanded="false"
                              >
                              <i class="fa fa-ellipsis-v" aria-hidden="true"></i>

                              </button>
                              <div
                                class="dropdown-menu"
                                aria-labelledby="dropdownMenuButton"
                              >
                                <a class="dropdown-item" href="#">Edit</a>
                                <a class="dropdown-item" href="#"
                                  >Delete</a
                                >

                              </div>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
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