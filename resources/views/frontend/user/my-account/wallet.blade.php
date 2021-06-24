 @extends('frontend.user.partials.dashboard-layout')
 @section('dashboard-body')
  <div class="db-cards">
                <div class="db-card green">
                 <div class="left">
                  <h2>Rs. 2560</h2>
                  <p>Amount in wallet
                  </p>
                 </div>
                 <div class="icon">
                  <i class="fa fa-money"></i>
                 </div>
                </div>

                <div id="load-wallet-btn" class="db-card">

                  <div class="icon">
                    <i class="fa fa-plus"></i>
                  </div>

                  <p>Load Wallet</p>
                 </div>


              </div>
                <div class="db-content">
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead class="">
                        <tr>
                          <th>#</th>
                          <th>Date</th>
                          <th>Amount</th>
                          <th>Type</th>
                          <th>Status</th>
                          <th>Accumulated</th>
                          <th>Remarks</th>

                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($transactions as $transaction)
                        <tr>
                          <td>{{++$loop->index}}</td>
                          <td>{{$transaction->created_at->format('d,M-Y')}}</td>
                          <td>NPR. {{$transaction->amount}}</td>
                          <td>{{$transaction->transaction_type}}</td>
                          
                          <td>
                            @if ($transaction->status)
                            <i class="fa fa-check-circle" style="color:green"></i>
                            @else
                            <i class="fa fa-times-circle" style="color: red"></i>
                            @endif
                          </td>
                          <td>NPR. {{$transaction->total_amount}}</td>
                          <td class="paymethod-cell">
                            @if ($transaction->payment_method =="esewa")
                              <img src="{{ asset('frontend/img/esewa.png')  }}" alt="esewa">
                              @elseif($transaction->payment_method =="khalti")
                              <img src="{{ asset('frontend/img/khalti.jpg')  }}" alt="khalti">
                              @elseif($transaction->payment_method =="paypal")
                              <img src="{{ asset('frontend/img/paypal.png')  }}" alt="paypal">
                              @else
                              <img src="{{get_site_logo()}}" alt="{{get_meta_by_key('site_name')}}">
                              @endif
                              {{$transaction->description}}</td>
                            </tr> 
                          @endforeach

                      </tbody>
                    </table>
                  </div>
                </div>


                <div class="modal fade" id="loadWalletModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                          Recharge Wallet
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                      <form action="{{route('user.my-account.load-wallet')}}" method="POST">
                        @csrf
                        <div class="form-group row">
                          <label for="inputPassword" class="col-sm-5 col-form-label">Amount</label>
                          <div class="col-sm-7">
                            <input type="number" step="0.01" class="form-control" name="amount" id="walletLoadAmt" placeholder="Amount">
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="inputPassword" class="col-sm-5 col-form-label">Payment Method</label>
                          <div class="col-sm-7">
                            <!-- <select class="custom-select">
                              <option selected>Select Payment Method</option>
                              <option value="1">Khalti</option>
                              <option value="2">Esewa</option>

                            </select> -->

                            <div id="payment-type">
                              @if (get_meta_by_key('esewa_status')=="on")
                              <label>
                                <input type="radio" name="payment_method"  value="esewa"  required/>
                                <div>
                                    <img alt="esewa" title="esewa" src="{{ asset('frontend/img/esewa.png') }}">
                                </div>
                              </label>
                              @endif
                              @if (get_meta_by_key('paypal_status')=="on")
                              <label>
                                <input type="radio" name="payment_method"  value="paypal"  required/>
                                <div>
                                    <img alt="paypal" title="paypal" src="{{ asset('frontend/img/paypal.png') }}">
                                </div>
                              </label>
                              @endif
                              @if (get_meta_by_key('paypal_status')=="on")
                               <label>
                                <input type="radio" name="payment_method"  value="khalti"  required/>
                                <div>
                                    <img alt="Khalti" title="Khalit" src="{{ asset('frontend/img/khalti.jpg') }}">
                                </div>
                              </label>
                              @endif
                             
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancel</button>
                          <button type="submit" class="btn btn-primary" value="submit">Confirm</button>
                        </div>
                      </form>
                      </div>
                    </div>
                  </div>
                </div>
 @endsection