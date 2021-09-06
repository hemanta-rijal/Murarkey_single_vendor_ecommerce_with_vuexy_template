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
                            {{-- {{dd($order->total)}} --}}
                            <tr>
                              <td>{{$order->code}}</td>
                              <td>{{$order->created_at->format('d-M-Y')}}</td>
                              <td>
                                @if($order->payment_method=='paypal')
                                  {{-- {{getUsersSupportedCurrency() }} --}}
                                  {{env('PAYPAL_CURRENCY', 'AUD')}}
                                  {{-- {{number_format((float) convertCurrency($order->total), 2, '.', '')}} --}}
                                  {{number_format((float) convert($order->total), 2, '.', '')}}
                                @else
                                {{convert($order->total)}}
                                @endif
                                
                              </td>
                              <td>{{$order->payment_method}}</td>
                              <td>{{$order->status}}</td>
                              <td>
                                <div class="dropdown">
                                  <div class="row">
                                    <a  href="{{route('user.orders.show',$order->id)}}" style="color: #6610f2"><span class="fa fa-eye"></span></a>
                                    &nbsp;
                                    &nbsp;
                                    @if($order->status!='cancelled')
                                    <form action="{{route('user.my-orders.change-status',$order->id)}}" method="post">
                                      @csrf
                                      <input type="hidden" name="status" value="cancelled" />
                                      <button type="submit" style="color: #6610f2"><span class="fa fa-window-close"></span></button>
                                    </form>
                                    @endif
                                  </div>
                                </div>
                              </td>
                            </tr>
                            @endforeach
                            @endisset
                            
                            
                          </tbody>
                        </table>
                      </div>
                      {!! $orders->links('frontend.partials.pagination') !!}
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