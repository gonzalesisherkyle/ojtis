@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - OJTIS</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="{{ asset('assets/images/pup-logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">

    <style type="text/css">
        .errspan {
            float: right;
            margin-right: 6px;
            margin-top: -25px;
            position: relative;
            z-index: 2;
        }
    </style>
</head>

<body>
    @include('sweetalert::alert')
    <div id="auth">
        <<div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-12 mx-auto">
                    <div class="card py-4">
                        <div class="card-body">
                            <div class="text-center mb-5">
                                <img src="{{ asset('assets/images/pup-logo.png') }}" height=96><br>
                                <img src="{{ asset('assets/images/ojtis-logo.png') }}" height=96 class="img-fluid">
                                <h3>Reset Password</h3>
                            </div>
                            <form method="POST" action="{{ route('update-password') }}">
                                @csrf
                                <input type="hidden" name="email" value="{{ $email ?? old('email') }}">
                                <div class="form-group">
                                    <label for="password" ">Password</label>
                                    <input id="password" type="password" class="form-control" name="password" autocomplete="new-password" minlength="8" alphabet="A-Za-z0-9+_%@!$*~-" required autofocus>
                                    <i id="toggle_pwd1" class="fa fa-fw fa-eye-slash errspan"></i>
                                </div>
                                <div class="form-group  ">
                                    <label for="password-confirm">Confirm Password</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password" required >
                                    <i id="toggle_pwd2" class="fa fa-fw fa-eye-slash errspan"></i>
                                </div>
                                <div class="clearfix">
                                    <button type="submit" class="btn btn-primary float-right">
                                        Reset Password
                                    </button>
                                </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            $("#toggle_pwd1").click(function () {
                $(this).toggleClass("fa-eye fa-eye-slash");
               var type = $(this).hasClass("fa-eye") ? "text" : "password";
                $("#password").attr("type", type);
            });
        });
        $(function () {
            $("#toggle_pwd2").click(function () {
                $(this).toggleClass("fa-eye fa-eye-slash");
               var type = $(this).hasClass("fa-eye") ? "text" : "password";
                $("#password-confirm").attr("type", type);
            });
        });
    </script>
</body>
</html>

@endsection
