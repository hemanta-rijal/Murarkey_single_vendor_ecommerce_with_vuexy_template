@extends('frontend.user.partials.dashboard-layout')
@section('dashboard-body')
    <div class="db-cards">
        <div class="db-card green">
            <div class="left">
                <h2>{{countCartForUser()}}</h2>
                <p>Product In cart
                </p>
            </div>
            <div class="icon">
                <i class="fa fa-shopping-bag"></i>
            </div>
        </div>

        <div class="db-card blue">
            <div class="left">
                <h2>0</h2>
                <p>Products In Wishlist
                </p>
            </div>
            <div class="icon">
                <i class="fa fa-heart"></i>
            </div>
        </div>


        <div class="db-card orange">
            <div class="left">
                <h2><span>Rs</span> {{getWalletTotal()}}</h2>
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
                <h2>{{getOrdersTotal()}}</h2>
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
                                <li class="list-group-item"><b>Country :</b> {{$user->billing_details->country}}</li>
                                <li class="list-group-item"><b>State :</b> {{$user->billing_details->state}}</li>
                                <li class="list-group-item"><b>City :</b> {{$user->billing_details->city}}</li>
                                <li class="list-group-item"><b>Specific Address
                                        :</b> {{$user->billing_details->specific_address}}</li>
                                <li class="list-group-item"><b>Phone Number :</b> {{$user->billing_details->phone_number}}</li>
                            @else
                                <li class="list-group-item" style="color: red">Billing details not updated yet</li>
                            @endif
                        </ul>
                        </p>
                        {{-- <a href="#" class="btn btn-primary mt-4 justify-content-center">Edit Details</a> --}}
                        <button type="button" class="btn btn-primary mt-4 justify-content-center"
                                onclick="showBillingAddressPopup()">
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

                                <li class="list-group-item"><b>Country :</b> {{$user->shipment_details->country}}</li>
                                <li class="list-group-item"><b>State :</b> {{$user->shipment_details->state}}</li>
                                <li class="list-group-item"><b>City :</b> {{$user->shipment_details->city}}</li>
                                <li class="list-group-item"><b>Specific Address
                                        :</b> {{$user->shipment_details->specific_address}}</li>
                                <li class="list-group-item"><b>Phone Number :</b> {{$user->shipment_details->phone_number}}</li>
                            @else
                                <li class="list-group-item" style="color: red">Shipment details not updated yet</li>
                            @endif
                        </ul>
                        </p>
                        <button type="button" class="btn btn-primary mt-4 justify-content-center"
                                onclick="showShippingAddressPopup()">
                            Edit Details
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @include('frontend.partials.address.billingAddressPopup')
    @include('frontend.partials.address.shippingAddressPopup')


@endsection

@section('js')
    <script>
        function showBillingAddressPopup() {
            $('#billingModal').modal('toggle')
        }

        function showShippingAddressPopup() {
            $('#shippingModal').modal('toggle')
        }

        function updateProfile() {
            var check = confirm("Are you sure you want to update Profile Picture?");
            if (check == true) {
                document.getElementById('updateUserProfilePicture').submit();
            }
            // document.getElementById('profilePicture').src = window.URL.createObjectURL(this.files[0]);
        }
    </script>
@endsection