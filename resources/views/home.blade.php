@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in - OJTIS</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    
    <link rel="shortcut icon" href="{{ asset('assets/images/pup-logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
</head>

<body>
    <div id="auth">
        
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-12 mx-auto">
                    <div class="card pt-4">
                        <div class="card-body">
                            <div class="text-center mb-5">
                                <img src="{{ asset('assets/images/pup-logo.png') }}" height="96" class='mb-4'>
                                <h1>Thank for signing up!</h1>
                                <h3>Pleas wait for verification.</h3>
                            </div>
                            <div class="clearfix">
                                <a class="dropdown-item" href="{{ route('logout') }}" 
                                onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <button class="btn btn-primary float-right" type="submit">Back to home</button>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
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
