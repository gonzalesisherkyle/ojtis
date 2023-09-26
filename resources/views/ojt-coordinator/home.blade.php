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
</head>
<body>
    <div id="app">
        @include('ojt-coordinator.sidebar')
        <div id="main">
            @include('ojt-coordinator.navbar')
            @include('sweetalert::alert')
            <div class="main-content container-fluid">
                <div class="page-title">
                    <h3>Dashboard</h3>
                </div>
                <div class="row mb-2">
                    <div class="col-12 col-md-3">
                        <div class="card card-statistic">
                            <div class="card-body p-0">
                                <div class="d-flex flex-column">
                                    <div class='px-3 py-3 d-flex justify-content-between'>
                                        <h3 class='card-title'><a href="{{ route('ojt-coordinator-adviser') }}" style="color: white">Advisers</a></h3>
                                    </div>
                                    <div class="chart-wrapper">
                                        @if ($advisers == NULL)
                                            <br>
                                            <h1 style="color: white"><center>0</center></h1>
                                        @else
                                            <br>
                                            <h1 style="color: white"><center>{{ count($advisers) }}</center></h1>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="card card-statistic">
                            <div class="card-body p-0">
                                <div class="d-flex flex-column">
                                    <div class='px-3 py-3 d-flex justify-content-between'>
                                        <h3 class='card-title'><a href="{{ route('ojt-coordinator-student') }}" style="color: white">Students</a></h3>
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
                    <div class="col-12 col-md-3">
                        <div class="card card-statistic">
                            <div class="card-body p-0">
                                <div class="d-flex flex-column">
                                    <div class='px-3 py-3 d-flex justify-content-between'>
                                        <h3 class='card-title'><a href="{{ route('pending-moa') }}" style="color: white">Pending Approval</a></h3>
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
                    <div class="col-12 col-md-3">
                        <div class="card card-statistic">
                            <div class="card-body p-0">
                                <div class="d-flex flex-column">
                                    <div class='px-3 py-3 d-flex justify-content-between'>
                                        <h3 class='card-title'><a href="{{ route('approved-moa') }}" style="color: white">Approved MOA</a></h3>
                                    </div>
                                    <div class="chart-wrapper">
                                        @if ($pending == NULL)
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
                </div>
            </div>
            {{-- @include('ojt-coordinator.footer') --}}
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
