<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{!! config('app.name') !!} | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{!! asset('assets/css/admin.css') !!}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="{!! url('/') !!}">kabmart</a>
    </div>

    <!-- /.login-logo -->
    <div class="login-box-body">
        <form action="{!! route('admin.login') !!}" method="post">
            <div class="login-box-body">
                <p class="login-box-msg">Sign in to start your session</p>


                {!! csrf_field() !!}


                @if ($errors->has('email'))
                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                @endif
                <div class="form-group has-feedback">
                    <input type="email" name="email" class="form-control" placeholder="Email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>


                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <a href="/admin/password/reset">Forget Password</a>
                        </div>
                    </div>

                    <!-- /.col -->
                    <div class="col-xs-4 ">
                        <input type="submit" class="btn btn-primary btn-flat" value="Sign In">
                    </div>


                </div>
        </form>
    </div>

</div>
<script src="{!! asset('assets/js/admin.js') !!}"></script>
<!-- iCheck -->
</body>
</html>