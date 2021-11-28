<div class="modal fade bd-example-modal-lg" id="shippingModal" tabindex="-1" role="dialog"
     aria-labelledby="shippingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="shippingModalLabel">Shipping Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{route('update.shipment-detail')}}" method="POST">
                @csrf
                @method('put')
                <div class="modal-body">
                    <p class="card-text">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="zip">Country</label>
                            <select id="discount-vertical" class="form-control" name="country"
                                    aria-placeholder="Country" required>
                                @foreach (get_countries() as $id=>$country)
                                    <option value="{{$country}}" {{$country=="Nepal" ? 'selected' : '' }} {{$user->shipment_details ? ($user->shipment_details->country==$country ? "selected"  : '' ) : null  }}>{{$country}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="name">State</label>
                            <input type="text" name="state" class="form-control" placeholder="State"
                                   value="{{ $user->shipment_details ? $user->shipment_details->state : null }}"
                                   required/>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="name">City</label>
                            <input type="text" name="city" class="form-control" placeholder="City"
                                   value="{{$user->shipment_details ? $user->shipment_details->city : null }}"
                                   required/>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="address">Specific Address</label>
                            <input type="text" name="specific_address" class="form-control"
                                   placeholder="Specific Address"
                                   value="{{$user->shipment_details ? $user->shipment_details->specific_address : null}}"
                                   required/>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="Phone Number">Phone Number</label>
                            <input type="text" name="phone_number" class="form-control" placeholder="Phone Number"
                                   value="{{($user->shipment_details && isset($user->billing_details->phone_number) ? $user->billing_details->phone_number : $user->phone_number) ? $user->phone_number : null}}"/>
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
