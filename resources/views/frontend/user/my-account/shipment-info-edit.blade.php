@extends('frontend.user.partials.dashboard-layout')
@section('dashboard-body')

    <div class="db-content">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Shipping Address</h5>
                        <form action="{{route('update.shipment-detail')}}" method="POST">
                            @csrf
                            @method('put')
                            <p class="card-text">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <input type="text" name="name" class="form-control" placeholder="Shipping Name"
                                           value="{{$user->shipment_details->name}}" required/>
                                </li>
                                <li class="list-group-item">
                                    <input type="text" name="address" class="form-control"
                                           placeholder="Shipping Address" value="{{$user->shipment_details->address}}"
                                           required/>
                                </li>
                                <li class="list-group-item">
                                    <input type="text" name="email" class="form-control" placeholder="email"
                                           value="{{$user->shipment_details->email}}" required/>
                                </li>
                                <li class="list-group-item">
                                    <input type="text" name="phone" class="form-control" placeholder="phone"
                                           value="{{$user->shipment_details->phone_number}}" required/>
                                </li>
                                <li class="list-group-item">
                                    <input type="text" name="city" class="form-control" placeholder="city"
                                           value="{{$user->shipment_details->city}}" required/>
                                </li>
                                <li class="list-group-item">
                                    <input type="text" name="zip" class="form-control" placeholder="zip"
                                           value="{{$user->shipment_details->zip}}" required/>
                                </li>
                            </ul>
                            {{-- <a href="#" class="btn btn-primary mt-4 justify-content-center">Edit Details</a> --}}
                            <button class="btn btn-primary mt-4 justify-content-center" value="submit">Update Details
                            </button>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection