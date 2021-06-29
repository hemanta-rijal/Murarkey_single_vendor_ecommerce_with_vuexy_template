 @extends('frontend.user.partials.dashboard-layout')
 @section('dashboard-body')
 <div class="db-content">
      <div class="table-responsive">
        <form action="{{route('user.change-password.update')}}" method="POST">
            @method('put')
            @csrf
                       <p for=""><b>Change Password</b></p>
                           <div class="col-md-12">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="">Current Password</label>
                                    <input type="text" name="current_password" class="form-control " placeholder="Current Password"  />
                                  </div>
                                <div class="form-group col-md-12">
                                    <label for="">New Password</label>
                                    <input type="text" name="password" class="form-control " placeholder="New Password"   required/>
                                  </div>
                                  <div class="form-group col-md-12">
                                    <label for="">Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control " placeholder="Confirm Password"  />
                                  </div>
                            </div>
                            <button type="submit" class="btn btn-success mt-4 justify-content-center" value="submit" >
                                        Update Password
                              </button>
                           </div>

        </form>
      </div>
  </div>
 @endsection
