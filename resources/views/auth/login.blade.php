@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In - OJTIS</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    
    <link rel="shortcut icon" href="{{ asset('assets/images/pup-logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style type="text/css">
        
        .errspan {
            float: right;
            margin-right: 6px;
            margin-top: -25px;
            position: relative;
            z-index: 2;
        }
        #loader {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            background: rgba(0,0,0,0.75) url("{{ asset('assets/images/VAyR.gif') }}") no-repeat center center;
            z-index: 99999;
        }
    </style>
    
</head>

<body>
    @include('sweetalert::alert')
    <div id='loader'></div>
    <div id="auth">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-12 mx-auto">
                    <div class="card pt-4">
                        <div class="card-body">
                            <div class="text-center mb-5">
                                <img src="{{ asset('assets/images/pup-logo.png') }}" height=96><br>
                                <img src="{{ asset('assets/images/ojtis-logo.png') }}" height=96 class="img-fluid">
                                <h3>Log In</h3>
                            </div>
                            <form action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="form-group position-relative">
                                    <label for="email">E-mail Address</label>
                                    <div class="position-relative">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>                               
                                </div>
                                <div class="form-group position-relative">
                                    <div class="clearfix">
                                        <label for="password">Password</label>
                                        <a href="{{ route('forgot-password') }}" class='float-right'>
                                            <small>Forgot password?</small>
                                        </a>
                                    </div>
                                    <div class="position-relative">
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required autocomplete="current-password">
                                        <i id="toggle_pwd1" style="color: black" class="fa fa-fw fa-eye-slash errspan"></i>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class='form-check clearfix my-4'>
                                    <div class="checkbox float-left">
                                        <input type="checkbox" id="remember" class='form-check-input' name="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label for="remember">Stay logged in</label>
                                    </div>
                                    <a href="{{ route('register') }}" class='float-right'>
                                        <small>Student? Don't have an account?</small>
                                    </a>
                                </div>
                                
                                <div class="clearfix">
                                    <button class="btn btn-primary float-right" type="submit">Log In</button>
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
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $("#toggle_pwd1").click(function () {
                $(this).toggleClass("fa-eye fa-eye-slash");
               var type = $(this).hasClass("fa-eye") ? "text" : "password";
                $("#password").attr("type", type);
            });
        });
    </script>
    <script>
        $(function() {
            $( "form" ).submit(function() {
                $('#loader').show();
            });
        });
    </script>
</body>

</html>

@endsection
