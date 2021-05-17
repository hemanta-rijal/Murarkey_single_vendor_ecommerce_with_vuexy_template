<div class="remodal" data-remodal-id="login-modal" role="dialog" aria-labelledby="modal1Title"
     aria-describedby="modal1Desc" style="max-width: 465px;">
    <div class="signup_block">
        <div class="signin_block no_border">
       <!--      <a href="{!! route('facebook.login') !!}" class="btn signin_fb facebook-bg wid_100 m-b-15"><i
                        class="fa fa-facebook f-s-20 white pull-left"></i> Sign In with Facebook</a> -->
         <!--    <div style="width: 100%; height: 13px; border-bottom: 1px solid #e2e2e2; text-align: center">
                                       <span style="font-size: 14px; background-color: #fff; padding: 0 10px;"> -->
                                           <!-- OR --> <!--Padding is optional-->
                                      <!--  </span>
            </div> -->

            {!! Form::open(['class' => 'login_form', 'route' => 'login']) !!}
            @if($errors->has('email') || $errors->has('password'))
                <div class="form-group">

                    <p class="warning_box plz_fill">
                        ! Please complete all required fields
                    </p>

                </div>
            @endif

            <div class="form-group">
                {!! Form::email('email', null, ['class'=>"form-control", 'placeholder'=>"Enter Email Address"]) !!}
                @if ($errors->has('email'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                @endif
            </div>
            <div class="form-group">
                {!! Form::password('password', ['class'=>"form-control", 'placeholder'=>"Enter Password"]) !!}
            </div>

            <div class="checkbox">
                <label class="pull-left">
                    <input type="checkbox" value="" class="pum_checkbox">
                    Remember Me
                </label>
                <a href="{{ route('login') }}#forget-password" class=" pull-right">Forgot Password?</a>
                <div class="clearfix"></div>
            </div>


            <button type="submit" class="btn btn-primary wid_100 p-14">Sign In</button>
            </form>
            <p class="text-center m-t-15">New Member ? <a href="{{ route('register') }}"
                                                                           class="pcolor">Register</a> Here
            </p>

        </div>
    </div>
</div>
