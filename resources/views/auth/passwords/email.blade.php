@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - OJTIS</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    
    <link rel="shortcut icon" href="{{ asset('assets/images/pup-logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
</head>

<body>
    @include('sweetalert::alert')
    <div id="auth">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-12 mx-auto">
                    <div class="card py-4">
                        <div class="card-body">
                            <a href="{{ route('home') }}">Back to login</a>
                            <div class="text-center mb-5">
                                <img src="{{ asset('assets/images/pup-logo.png') }}" height=96><br>
                                <img src="{{ asset('assets/images/ojtis-logo.png') }}" height=96 class="img-fluid">
                                <h3>Forgot Password</h3>
                                <p>Please enter your email to receive password reset link.</p>
                            </div>
                            <form action="{{ route('forgot-password-link') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                </div>

                                <div class="clearfix">
                                    <button class="btn btn-primary float-right" type="submit">Send</button>
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
</body>

</html>

@endsection
