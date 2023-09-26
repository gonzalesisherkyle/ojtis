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
    <link rel="stylesheet" href="{{ asset('assets/vendors/simple-datatables/style.css') }}">
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
                    <h3>Student Room Approval</h3>
                </div>
                <section class="section">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4 class="card-title"></h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class='table table-striped' id="table1">
                                            <thead>
                                                <tr>
                                                    <th colspan="1" width=150>Room Name</th>
                                                    <th colspan="1" width=325>Student Name</th>                                               
                                                    <th colspan="1" width=325>Email</th>
                                                    <th colspan="1" width=250>Approve/Deny</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                               
                                                @if ($students->isNotEmpty())
                                                    @foreach ($students as $student)
                                                        <tr>
                                                            <td>{{ $student->room_name }}</td>
                                                            <td>{{ $student->last_name }} {{ $student->first_name }} {{ $student->middle_name }} {{ $student->suffix }}</td>           
                                                            <td>{{ $student->email }}</td>   
                                                            <td>
                                                                @include('adviser.modals.approve-student')
                                                                <button type="button" class="btn btn-success btn-sm block" data-toggle="modal" data-target="#approve-student{{ $student->user_id }}" tooltip="Change status">
                                                                    Approve   
                                                                </button>
                                                                @include('adviser.modals.disapprove-student')
                                                                <button type="button" class="btn btn-danger btn-sm block" data-toggle="modal" data-target="#disapprove-student{{ $student->user_id }}" tooltip="Change status" title="Deny">
                                                                    Deny  
                                                                </button>
                                                            </td>

                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr><td colspan="12" class="text-center">No results found!</td></tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
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
    <script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/js/vendors.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>

@endsection
