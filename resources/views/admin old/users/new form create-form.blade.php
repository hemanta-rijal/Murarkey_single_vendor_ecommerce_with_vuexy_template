
<form action="{{route('admin.users.store')}}" method="POST" enctype="multipart/form-data">
<div class="row">
    
    <div class="col-md-10">
        <div class="form-group col-md-6">
            <label class="first_name">First Name<span style="color:red">*</span></label>
            <input type="text" class="form-control" name="user[first_name]" id="first_name" placeholder="first name"/>    
            @error($errors)
            <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
            @enderror
        </div>
        <div class="form-group col-md-6">
            <label class="last_name">Last Name<span style="color:red">*</span></label>
            <input type="text" class="form-control" name="user[last_name]" id="first_name" placeholder="last name"/>    
            @error($errors)
            <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
            @enderror
        </div>
        <div class="form-group col-md-6">
            <label class="email">Email<span style="color:red">*</span></label>
            <input type="email" class="form-control" name="user[email]" id="email" placeholder="email "/>    
            @error($errors)
            <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
            @enderror
        </div>
        <div class="form-group col-md-6">
            <label class="phone_number">Phone No<span style="color:red">*</span></label>
            <input type="tel" class="form-control" name="user[phone_number]" id="phone_number" placeholder="phone number"/>    
            @error($errors)
            <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
            @enderror
        </div>
        <div class="form-group col-md-6">
            <label class="password">Password<span style="color:red">*</span></label>
            <input type="password" class="form-control" name="user[password]" id="password" placeholder="password"/>    
            @error($errors)
            <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
            @enderror
        </div>
        <div class="form-group col-md-6">
            <label class="password_confirmation">Confirm Password<span style="color:red">*</span></label>
            <input type="password" class="form-control" name="user[password_confirmation]" id="password_confirmation" placeholder="confirm password"/>    
            @error($errors)
            <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
            @enderror
        </div>
        <div class="form-group col-md-6">
            <label class="form-check-label" for="gridCheck1">
                User Verified
            </label>
            <input class="form-check-input" name="user[verified]" type="hidden" id="verified" value="off">
            <input class="form-check-input" name="user[verified]" type="checkbox" id="maintenance_mode" value="on" >
            @error($errors)
            <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
            @enderror
        </div>
        <div class="form-group col-md-6">
            <label class="first_name">Role<span style="color:red">*</span></label>
            <select class="form-control" name="user[role]" id="first_name" onchange="roleChangeListener(this)">
                <option value="ordinary_user">Ordinary User</option>
                <option value="main-seller">Main Seller Company</option>
                <option value="associate-seller">Associate Seller Company</option>
            </select>
            @error($errors)
            <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
            @enderror
        </div>
        
    </div>
</div>

<div class="panel panel-default"
     id="seller-div" {!! old('user.role') == 'associate-seller' ||  old('user.role') == 'main-seller' ?: 'style="display:none"' !!}>
    <div class="panel-heading">Seller Info</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-8">
            <div class="form-group col-md-6">
            <label class="first_name">Role<span style="color:red">*</span></label>
            <select class="form-control" name="user[role]" id="first_name" onchange="("roleChangeListener('this')")">
                @foreach (Config::get('auth.roles') as $role)
                    <option value="role">{{$role}}</option>
                @endforeach
            </select>
            @error($errors)
            <span class="err-msg" style="color:red">{{$errors->first('body')}}</span>               
            @enderror
        </div>
            </div>
        </div>
    </div>
</div>

<div class="panel panel-default" id="company-div" {!! old('user.role') == 'main-seller' ?: 'style="display:none"' !!}>
    <div class="panel-heading">Company Info</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-8">
                
            </div>
        </div>
    </div>
</div>


<div class="panel panel-default"
     id="company-selector-div" {!! old('user.role') == 'associate-seller' ?: 'style="display:none"' !!}>
    <div class="panel-heading">Company Selector</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-8">
            
            </div>
        </div>
    </div>
</div>

<div class="row">
    
</div>


