@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="cache-control" content="private, max-age=0, no-cache, must-revalidate">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="expires" content="0">
    <title>OJTIS</title>
    
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    
    <link rel="stylesheet" href="{{ asset('assets/vendors/chartjs/Chart.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/pup-logo.png') }}" type="image/x-icon">
</head>
<body>
    <div id="app">
        @include('adviser.sidebar')
        <div id="main">
            @include('adviser.navbar')
            @include('sweetalert::alert')
            <div class="main-content container-fluid">
                <div class="page-title">
                    <h3>Dashboard</h3>
                </div>  
                <div class="row mb-2">
                    <a href="{{ route('adviser-student-pending') }}" class="col-12 col-md-3">
                        <div>
                            <div class="card card-statistic">
                                <div class="card-body p-0">
                                    <div class="d-flex flex-column">
                                        <div class='px-3 py-3 d-flex justify-content-between'>
                                            <h3 class='card-title'>Account Approval</h3>
                                        </div>
                                        <div class="chart-wrapper">
                                            @if ($account == NULL)
                                                <br>
                                                <h1 style="color: white"><center>0</center></h1>
                                            @else
                                                <br>
                                                <h1 style="color: white"><center>{{ count($account) }}</center></h1>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('adviser-student') }}" class="col-12 col-md-3">
                        <div>
                            <div class="card card-statistic">
                                <div class="card-body p-0">
                                    <div class="d-flex flex-column">
                                        <div class='px-3 py-3 d-flex justify-content-between'>
                                            <h3 class='card-title'>Students</h3>
                                        </div>
                                        <div class="chart-wrapper">
                                            @if ($students == NULL)
                                                <br>
                                                <h1 style="color: white"><center>0</center></h1>
                                            @else
                                                <br>
                                                <h1 style="color: white"><center>{{ count($students) }}</center></h1>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('adviser-moa') }}" class="col-12 col-md-3">
                        <div>
                            <div class="card card-statistic">
                                <div class="card-body p-0">
                                    <div class="d-flex flex-column">
                                        <div class='px-3 py-3 d-flex justify-content-between'>
                                            <h3 class='card-title'>Pending MOA</h3>
                                        </div>
                                        <div class="chart-wrapper">
                                            @if ($moa == NULL)
                                                <br>
                                                <h1 style="color: white"><center>0</center></h1>
                                            @else
                                                <br>
                                                <h1 style="color: white"><center>{{ count($moa) }}</center></h1>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('adviser-letter') }}" class="col-12 col-md-3">
                        <div>
                            <div class="card card-statistic">
                                <div class="card-body p-0">
                                    <div class="d-flex flex-column">
                                        <div class='px-3 py-3 d-flex justify-content-between'>
                                            <h3 class='card-title'>Pending Letter</h3>
                                        </div>
                                        <div class="chart-wrapper">
                                            @if ($letter == NULL)
                                                br>
                                                <h1 style="color: white"><center>0</center></h1>
                                            @else
                                                <br>
                                                <h1 style="color: white"><center>{{ count($letter) }}</center></h1>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('adviser-moa-approved') }}"  class="col-12 col-md-3">
                        <div>
                            <div class="card card-statistic">
                                <div class="card-body p-0">
                                    <div class="d-flex flex-column">
                                        <div class='px-3 py-3 d-flex justify-content-between'>
                                            <h3 class='card-title'>Approved MOA</h3>
                                        </div>
                                        <div class="chart-wrapper">
                                            @if ($appmoa == NULL)
                                                <br>
                                                <h1 style="color: white"><center>0</center></h1>
                                            @else
                                                <br>
                                                <h1 style="color: white"><center>{{ count($appmoa) }}</center></h1>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('adviser-letter-approved') }}" class="col-12 col-md-3">
                        <div>
                            <div class="card card-statistic">
                                <div class="card-body p-0">
                                    <div class="d-flex flex-column">
                                        <div class='px-3 py-3 d-flex justify-content-between'>
                                            <h3 class='card-title'>Approved Letter</h3>
                                        </div>
                                        <div class="chart-wrapper">
                                            @if ($appletter == NULL)
                                                <br>
                                                <h1 style="color: white"><center>0</center></h1>
                                            @else
                                                <br>
                                                <h1 style="color: white"><center>{{ count($appletter) }}</center></h1>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('adviser-studentApproval') }}" class="col-12 col-md-3">
                        <div>
                            <div class="card card-statistic">
                                <div class="card-body p-0">
                                    <div class="d-flex flex-column">
                                        <div class='px-3 py-3 d-flex justify-content-between'>
                                            <h3 class='card-title'>Room Approval</h3>
                                        </div>
                                        <div class="chart-wrapper">
                                            @if ($pending == NULL)
                                                <br>
                                                <h1 style="color: white"><center>0</center></h1>
                                            @else
                                                <br>
                                                <h1 style="color: white"><center>{{ count($pending) }}</center></h1>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    
    <script src="{{ asset('assets/vendors/chartjs/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>

    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>

@endsection
