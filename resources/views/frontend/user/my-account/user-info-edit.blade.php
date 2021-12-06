@extends('frontend.user.partials.dashboard-layout')
@section('dashboard-body')
	<div class="db-content">
		<div class="db-content">
			<div class="row">
				<div class="col">
					<div class="card">
						<div class="card-body">
							<h5 class="card-title">Billing Information</h5>
							<p class="card-text">
							<ul class="list-group list-group-flush">
								@if ($user->billing_details)
									<li class="list-group-item"><b>Country :</b> {{ $user->billing_details->country }}
									</li>
									<li class="list-group-item"><b>State :</b> {{ $user->billing_details->state }}</li>
									<li class="list-group-item"><b>City :</b> {{ $user->billing_details->city }}</li>
									<li class="list-group-item"><b>Specific Address
											:</b> {{ $user->billing_details->specific_address }}</li>
									{{-- <li class="list-group-item"><b>Zip :</b> {{ $user->billing_details->zip }}</li> --}}
								@else
									<li class="list-group-item" style="color: red">Billing details not updated yet</li>
								@endif
							</ul>
							</p>
							<button type="button" class="btn btn-primary mt-4 justify-content-center" onclick="showBillingAddressPopup()">
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
								@if ($user->shipment_details)

									<li class="list-group-item"><b>Country :</b> {{ $user->shipment_details->country }}
									</li>
									<li class="list-group-item"><b>State :</b> {{ $user->shipment_details->state }}</li>
									<li class="list-group-item"><b>City :</b> {{ $user->shipment_details->city }}</li>
									<li class="list-group-item"><b>Specific Address
											:</b> {{ $user->shipment_details->specific_address }}</li>
									{{-- <li class="list-group-item"><b>Zip :</b> {{ $user->shipment_details->zip }}</li> --}}
								@else
									<li class="list-group-item" style="color: red">Shipment details not updated yet</li>
								@endif
							</ul>
							</p>
							<button type="button" class="btn btn-primary mt-4 justify-content-center" onclick="showShippingAddressPopup()">
								Edit Details
							</button>
						</div>
					</div>
				</div>

			</div>
		</div>
		<div class="table-responsive">
			<form id="basicInfoForm" action="{{ route('update.user-info', $user->id) }}" method="POST">
				@method('put')
				@csrf

				<div class="col-md-12">
					<p><b>Basic Information </b></p>
					<div class="row">
						<div class="form-group col-md-6">
							<label for="">First Name</label>
							<input type="text" name="first_name" class="form-control" placeholder="First Name" value="{{ $user->first_name }}" required />
						</div>
						<div class="form-group col-md-6">
							<label for="">Last Name</label>
							<input type="text" name="last_name" class="form-control" placeholder="Last Name" value="{{ $user->last_name }}" required />
						</div>
						<div class="form-group col-md-6">
							<label for="">Preferred Currency</label>
							<div class="currency-selected">
								<select name="supported_currency" class="form-control" id="">
									<option value="aud" {{ $user->supported_currency == 'aud' ? 'selected' : '' }}><img src="{{ asset('frontend/img/ausflag.png') }}" alt="">AUD
									</option>
									<option value="nrs" {{ $user->supported_currency == 'nrs' ? 'selected' : '' }}><img src="{{ asset('frontend/img/npflag.png') }}" alt="">NRS
									</option>
								</select>
							</div>
						</div>


						<div class="form-group col-md-6">
							<label for="">Phone Number</label>
							<input type="tel" name="phone_number" class="form-control" placeholder="Phone Number" value="{{ $user->phone_number }}" required />
						</div>


						<div class="form-group col-md-6">

							<div class="form-group has-success has-feedback">
								<label for="">Email</label>
								<input type="text" name="email" id="emailFiled" class="form-control" placeholder="Email" value="{{ $user->email }}" required />
								<span class="glyphicon glyphicon-warning-sign form-control-feedback"></span>
								<input type="hidden" id="previousEmail" value="{{ $user->email }}">
							</div>
						</div>
					</div>
				</div>
				<div class="form-group pull-right">
					<button type="button" class="btn btn-primary mt-4 justify-content-center" id="btnSubmitInfoForm" onclick="checkEmailVerification()">
						Update
					</button>
				</div>
			</form>
		</div>


	</div>

	@include('frontend.partials.address.billingAddressPopup')
	@include('frontend.partials.address.shippingAddressPopup')
@endsection

@section('js')
	<script>
	 function showBillingAddressPopup() {
	  $('#billingModal').modal('toggle');
	 }

	 function showShippingAddressPopup() {
	  $('#shippingModal').modal('toggle');
	 }

	 $("#btnSubmitInfoForm").click(function(event) {
	  var currentEmail = $('#emailFiled').val();
	  var previousEmail = $('#previousEmail').val();
	  if (currentEmail !== previousEmail) {
	   if (confirm(
	     "Email you have provided is different. Therefore, if you update your details with new email, you will be logged out and you must verify your email throuh the verificaion link we have sent to your new email."
	    )) {
	    event.preventDefault();
	    $("#basicInfoForm").submit();
	   }
	  }
	  $("#basicInfoForm").submit();
	 });
	</script>
@endsection
