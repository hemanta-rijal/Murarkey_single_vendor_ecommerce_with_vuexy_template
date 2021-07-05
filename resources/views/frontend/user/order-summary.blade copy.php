 @extends('frontend.user.partials.dashboard-layout')
 {{-- {{$order.$order->items->first()}} --}}
 @section('dashboard-body')
 <!-- Shopping Cart Section Begin -->
        <section class="ordersummary-section spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                            <div class="ordersummary-left">
                                <div class="order-summary">
                                    <h2>Order summary</h2>


                                       <table class="table">
                                           <tbody>
                                               <tr>
                                                   <td>Order Code</td>
                                                   <td>{{$order->code}}</td>
                                               </tr>
                                               <tr>
                                                   <td>Order date</td>
                                                   <td>{{$order->created_at->format('d-m-Y  h:i A')}}</td>
                                               </tr>
                                               <tr>
                                                   <td>Customer</td>
                                                   <td>{{$order->user->name}}</td>
                                               </tr>
                                               <tr>
                                                   <td>Order Status</td>
                                                   <td>{{$order->status}}</td>
                                               </tr>
                                               <tr>
                                                   <td>Email</td>
                                                   <td>{{$order->user->email}}</td>
                                               </tr>
                                               <tr>
                                                   <td>Total order amount</td>
                                                   <td>NPR {{$order->total}}</td>
                                               </tr>
                                               <tr>
                                                   <td>Shipping Address</td>
                                                   <td>{{$order->user->shipment_details->specific_address}}</td>
                                               </tr>
                                               <tr>
                                                   <td>Contact</td>
                                                   <td>{{$order->user->phone_number ?? '-'}}</td>
                                               </tr>
                                               <tr>
                                                   <td>Payment Method</td>
                                                   <td>{{$order->payment_method}}</td>
                                               </tr>

                                           </tbody>
                                       </table>


                                </div>

                                <div class="order-summary">
                                    <h2>Order details</h2>

                                    <div class="order-detail">
                                          <table class="table">
                                            <thead>
                                                <th>#</th>
                                                <th>
                                                    item
                                                </th>
                                                <th>
                                                    name
                                                </th>
                                                <th>Quantity</th>
                                                {{-- <th>Delivery type</th> --}}
                                                <th>Price</th>
                                            </thead>
                                            <tbody>
                                                @foreach ($order->items as $item)
                                                <tr>
                                                    <td>{{++$loop->index}}</td>
                                                    <td>
                                                        <div class="item">
                                                            <img src="{{$item->options['photo']}}" alt="product-img">
                                                        </div>
                                                    </td>
                                                    <td>
                                                            {{$item->product->name}}
                                                    </td>
                                                    <td>
                                                        {{$item->qty}}
                                                    </td>
                                                    {{-- <td>
                                                        {{$item->}}
                                                    </td> --}}
                                                    <td>
                                                        NPR. {{$item->price}}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>


                                </div>
                            </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="ordersummary-right">
                            <div class="order-summary">
                                <h2>Order Amount</h2>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>Subtotal</td>
                                            <td>NPR. {{getOrderSummary($order)['subTotal']}}</td>
                                        </tr>
                                        <tr>
                                            <td>Shipping</td>
                                            <td>NPR. {{getOrderSummary($order)['subTotal']}}</td>
                                        </tr>
                                        <tr>
                                            <td>TAX</td>
                                            <td>NPR. {{getOrderSummary($order)['tax']}}</td>
                                        </tr>
                                        <tr>
                                            <td><Strong>Total</Strong></td>
                                            <td><strong>NPR. {{getOrderSummary($order)['total']}}</strong></td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                            <a href="" class="btn btn-primary">
                                Export to Excel
                            </a>

                            <a href="/user/orders/{{$order->id}}/download-summary" target="_blank" class="btn btn-outline-primary mt-3">
                                Download pdf
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Shopping Cart Section End -->
 @endsection

@section('js')

@endsection