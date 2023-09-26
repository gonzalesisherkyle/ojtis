@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OJTIS</title>
    
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    
    <link rel="stylesheet" href="{{ asset('assets/vendors/simple-datatables/style.css') }}">

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
                    <h3>{{ $student->last_name }} {{ $student->first_name }} {{ $student->middle_name }} {{ $student->suffix }}</h3>
                </div>
                <section class="section">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <a href="javascript:history.back()">Back to students</a>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class='table table-striped' id="table1">
                                            <thead>
                                                <tr>
                                                    <th colspan="1" width=150>Category</th>
                                                    <th colspan="1" width=250>File Name</th>
                                                    <th colspan="1" width=100>Date Uploaded</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($files->isNotEmpty())
                                                    @foreach ($files as $user)
                                                        <tr>
                                                            <td>{{ $user->category_name }}</td>
                                                            <td><a href="{{ route('download-files', ['user' => $user->user_id, 'file' => $user->file_name]) }}">{{ $user->file_name }}</a></td> 
                                                            <td>{{ $user->date_uploaded }}</td>  
                                                            {{-- <td>
                                                                @include('ojt-coordinator.student-files.modals.download')
                                                                <button type="button" class="btn btn-primary block" data-toggle="modal" data-target="#download-files{{ $user->file_id }}">
                                                                    Download   
                                                                </button>
                                                            </td>          --}}
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr><td colspan="12">No files found!</td></tr>
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

    <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>

    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/js/vendors.js') }}"></script>
</body>
</html>

@endsection
