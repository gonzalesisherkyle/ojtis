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
                    <h3>Announcements</h3>
                </div>
                @if ($announcements->isNotEmpty())
                    @foreach ($announcements as $mess)
                        <div class="row">
                            <div class="col-xl-12 col-md-6 col-sm-12">
                                <div class="card" >
                                    <div class="card-content">
                                        <div class="card-body">
                                            <h4 class="card-title">{{ $mess->title }}</h4>
                                            <p class="card-text">
                                                {{ $mess->body}}
                                            </p>
                                            <?php 
                                            $fileName = $mess->file_name;
                                            $ext = substr(strrchr($fileName, '.'), 1);
                                        ?>
                                        @if ($ext == 'jpg')
                                            <img src="{{ asset('/Files/' . $mess->first_name . '-' . $mess->last_name . '/' . $mess->file_name) }}" height="auto" onclick='window.open(this.src)'>
                                        @elseif (($ext == 'jpeg'))
                                            <img src="{{ asset('/Files/' . $mess->first_name . '-' . $mess->last_name . '/' . $mess->file_name) }}" height="auto" onclick='window.open(this.src)'>
                                        @elseif (($ext == 'png'))
                                            <img src="{{ asset('/Files/' . $mess->first_name . '-' . $mess->last_name . '/' . $mess->file_name) }}" height="auto" onclick='window.open(this.src)'>
                                        @elseif (($ext == 'gif'))
                                            <img src="{{ asset('/Files/' . $mess->first_name . '-' . $mess->last_name . '/' . $mess->file_name) }}" height="auto" onclick='window.open(this.src)'>
                                        @else
                                            <a href="{{ asset('/Files/' . $mess->first_name . '-' . $mess->last_name . '/' . $mess->file_name) }}" target="_blank">{{ $mess->file_name }}</a>
                                        @endif
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex justify-content-between">
                                        <small>{{ $mess->last_name }} {{ $mess->first_name }} {{ $mess->middle_name }} {{ $mess->suffix }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <h4 style="text-align: center">No announcements yet!</h4>          
                @endif

                {{-- <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <h3 class='card-heading p-1 pl-1'>Announcements</h3>
                        </div>
                        <div class="card-body px-0 pb-0">
                            <div class="table-responsive">
                                <table class='table mb-0' id="table1">
                                    <thead>
                                        <tr>
                                            <th colspan="1">Date announced</th>
                                            <th colspan="1">Room Name</th>                                              
                                            <th colspan="1">Professor</th>                                              
                                            <th colspan="1">About</th>                                              
                                            <th colspan="1">Message</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
                                        @if ($announcements->isNotEmpty())
                                            @foreach ($announcements as $announcement)
                                                <tr>
                                                    <td>{{ $announcement->created_at }}</td>
                                                    <td>{{ $announcement->room_name }}</td>
                                                    <td>{{ $announcement->first_name }} {{ $announcement->middle_name }} {{ $announcement->last_name }}</td>                       
                                                    <td>{{ $announcement->title }}</td>              
                                                    <td>{{ $announcement->body}}</td>
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
                </section> --}}
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
