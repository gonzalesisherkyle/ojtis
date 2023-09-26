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
        @include('student.sidebar')
        <div id="main">
            @include('student.navbar')
            @include('sweetalert::alert')
            <div class="main-content container-fluid">
                <div class="page-title">
                    <h3>Class</h3>
                </div>
                <section class="section">
                    <div class="row mb-4">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class='card-heading p-1 pl-1'>Available Class</h3>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class='table table-striped' id="table1">
                                            <thead>
                                                <tr>
                                                    <th colspan="1" width=150>Class Name</th>
                                                    <th colspan="1" width=100>Course</th>                 
                                                    <th colspan="1" width=150>Class Status</th>                 
                                                    <th colspan="1" width=250>Join/View</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($rooms->isNotEmpty())
                                                    @foreach ($rooms as $room)
                                                        <tr>
                                                            <td>{{ $room->room_name }}</td>  
                                                            <td>{{ $room->course_abb }}</td>   
                                                            <td>
                                                                @if ($room->room_status == 'open')
                                                                    <span class="badge bg-success">{{ $room->room_status }} </span></td>  
                                                                @elseif($room->room_status == 'closed')
                                                                    <span class="badge bg-danger">{{ $room->room_status }} </span></td>  
                                                                @else
                                                                    <span class="badge bg-warning">{{ $room->room_status }} </span></td>  
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @include('student.modals.join-room')
                                                                <button type="button" class="btn 
                                                                @if ($room->room_status == 'closed')
                                                                    disabled
                                                                @elseif ($room->room_status == 'inactive')
                                                                    disabled
                                                                @endif btn-primary btn-sm block" data-toggle="modal" data-target="#join-room{{ $room->room_id }}" tooltip="Change status">
                                                                    Join
                                                                </button>
                                                                @include('student.modals.view-room')
                                                                <button type="button" class="btn btn-info btn-sm block" data-toggle="modal" data-target="#view-room{{ $room->room_id }}">
                                                                    View  
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
                        <div class="col-md-4">
                            <div class="card ">
                                <div class="card-header">
                                    <h3 class='card-heading p-1 pl-1'>My Class</h3>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class='table table-striped' id="table1">
                                            <thead>
                                                <tr>
                                                    <th colspan="1">Class Name</th> 
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($myRooms->isNotEmpty())
                                                    @foreach ($myRooms as $myRoom)
                                                        <tr>
                                                            <td>{{ $myRoom->room_name }}</td>                                
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
            {{-- @include('student.footer') --}}
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
