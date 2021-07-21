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
                          <th>Method </th>
                          <th>Status</th>
                          <th>Options</th>
                        </tr>
                      </thead>
                      <tbody>
                        @isset($orders)
                            @foreach ($orders as $order)
                            <tr>
                              <td>{{$order->code}}</td>
                              <td>{{$order->created_at->format('d-M-Y')}}</td>
                              <td>NPR. {{$order->total}}</td>
                              <td>{{$order->payment_method}}</td>
                              <td>{{$order->status}}</td>
                              <td>
                                <div class="dropdown">
                                  <a class="dropdown-item" href="{{route('user.orders.show',$order->id)}}" style="color: #6610f2">view</a>
                                </div>
                              </td>
                            </tr>
                            @endforeach
                        @endisset


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