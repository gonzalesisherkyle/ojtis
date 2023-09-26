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
                    <h3>Classes</h3>
                </div>
                <section class="section">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4 class="card-title"></h4>
                                    @include('adviser.modals.add-room')
                                    <button type="button" class="btn btn-success block" data-toggle="modal" data-target="#add-room">
                                        <i data-feather="plus" width="20"></i>   
                                    </button>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class='table table-striped' id="table1">
                                            <thead>
                                                <tr>
                                                    <th colspan="1" width=180>Class Name</th>                                               
                                                    <th colspan="1" width=180>Course</th>
                                                    <th colspan="1" width=180>Status</th>
                                                    <th colspan="1" width=300>Edit/View</th>
                                                    <th colspan="1" width=180>Remove Class</th>
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
                                                            <td>
                                                                @include('adviser.modals.update-room')
                                                                <button type="button" class="btn btn-primary btn-sm block" data-toggle="modal" data-target="#update-room{{ $room->room_id }}" tooltip="Change status" title="Edit">
                                                                    Edit  
                                                                </button>
                                                                <a href="{{ route('adviser-viewRoom', $room->room_id) }}" class="btn btn-info btn-sm block" title="View">
                                                                    View
                                                                </a>
                                                            </td>
                                                            <td>
                                                                @include('adviser.modals.delete-room')
                                                                <button type="button" class="btn btn-danger btn-sm block" data-toggle="modal" data-target="#delete-room{{ $room->room_id }}" title="Delete">
                                                                    Remove  
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
