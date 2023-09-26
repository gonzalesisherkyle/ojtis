@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OJTIS</title>
    
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    
    <link rel="stylesheet" href="{{ asset('assets/vendors/chartjs/Chart.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/pup-logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
    <div id="app">
        @include('director.sidebar')
        <div id="main">
            @include('director.navbar')
            @include('sweetalert::alert')
            <div class="main-content container-fluid">
                <div class="page-title">
                    <h3>Change Password</h3>
                </div>
                <section class="section">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4 class="card-title"> </h4>
                                </div>
                                <div class="card-body px-3 pb-5">
                                    <form method="POST" action="{{ route('change-password') }}">
                                        @csrf 
                                        <div class="form-group row">
                                            <label for="password" class="col-md-4 col-form-label text-md-right">Current Password<strong class="text" style="color:red">*</strong></label>
                                            <div class="col-md-6">
                                                <input id="password" type="password" class="form-control" name="current_password" autocomplete="current-password" autofocus required>
                                                <i id="toggle_pwd1" class="fa fa-fw fa-eye-slash errspan"></i>
                                            </div>  
                                        </div>
                  
                                        <div class="form-group row">
                                            <label for="password" class="col-md-4 col-form-label text-md-right">New Password<strong class="text" style="color:red">*</strong></label>
                                            <div class="col-md-6">
                                                <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password" minlength="8" alphabet="A-Za-z0-9+_%@!$*~-" required>
                                                <i id="toggle_pwd2" class="fa fa-fw fa-eye-slash errspan"></i>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="password" class="col-md-4 col-form-label text-md-right">Confirm New Password<strong class="text" style="color:red">*</strong></label>
                                            <div class="col-md-6">
                                                <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password" required> 
                                                <i id="toggle_pwd3" class="fa fa-fw fa-eye-slash errspan"></i>
                                            </div>
                                        </div>
                   
                                        <div class="form-group row mb-0">
                                            <div class="col-md-6 offset-md-4">
                                                <button type="submit" class="btn btn-primary float-right">
                                                    Change
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            {{-- @include('adviser.footer') --}}
        </div>
    </div>
    <script src="{{ asset('assets/js/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    
    <script src="{{ asset('assets/vendors/chartjs/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>

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
        $(function () {
            $("#toggle_pwd2").click(function () {
                $(this).toggleClass("fa-eye fa-eye-slash");
               var type = $(this).hasClass("fa-eye") ? "text" : "password";
                $("#new_password").attr("type", type);
            });
        });
        $(function () {
            $("#toggle_pwd3").click(function () {
                $(this).toggleClass("fa-eye fa-eye-slash");
               var type = $(this).hasClass("fa-eye") ? "text" : "password";
                $("#new_confirm_password").attr("type", type);
            });
        });
    </script>
</body>
</html>

@endsection
