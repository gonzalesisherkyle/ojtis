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
    <style>
        .column-left{ float: left; width: 33%; }
        .column-right1{ float: right; width: 33%; }
        .form-file{ display: inline-block; width: 33%; }

        @media screen and (max-width: 960px) 
        {
            .column-left{ float: none; width: 100%; }
            .column-right1{ float: none; width: 100%; }
            .form-file{ display: block; width: 100%; }
        }
    </style>
</head>
<body>
    <div id="app">
        @include('ojt-coordinator.sidebar')
        <div id="main">
            @include('ojt-coordinator.navbar')
            @include('sweetalert::alert')
            <div class="main-content container-fluid">
                <div class="page-title">
                    <h3>Downloadable</h3>
                </div>
                <div class="divider"></div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="column-right">
                            <button class="btn btn-primary float-right" type="submit">Upload</button>
                        </div>
                        <br>
                        <div id="show_file">
                            <div class="row mb-3">
                                <div class="form-file">
                                    <input type="file" class="custom-file-input" id="files" aria-describedby="files" name="file" required>
                                </div>
                            </div>        
                        </div>
                    </form>
                </div>   
                <section class="section">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class='table table-striped' id="table1">
                                            <thead>
                                                <tr>
                                                    <th colspan="1" width=500>File Name</th>
                                                    <th colspan="1" width=200>Date Uploaded</th>
                                                    <th colspan="1" width=200>Remove File</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($files->isNotEmpty())
                                                    @foreach ($files as $file)
                                                        <tr>
                                                            <td>{{ $file->file_name }}</td> 
                                                            <td>{{ $file->date_uploaded }}</td>
                                                            <td>
                                                                @include('ojt-coordinator.modals.remove-file')
                                                                <button type="button" class="btn btn-danger btn-sm block" data-toggle="modal" data-target="#remove-file{{ $file->file_id }}">
                                                                    Remove  
                                                                </button>
                                                            </td>     
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr><td colspan="12" class="text-center">No files found!</td></tr>
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
    <script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/js/vendors.js') }}"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
</body>
</html>

@endsection
