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
        @include('director.sidebar')
        <div id="main">
            @include('director.navbar')
            @include('sweetalert::alert')
            <div class="main-content container-fluid">
                <div class="page-title">
                    <h3>Pending Recommendation Letter</h3>
                </div>
                <section class="section">
                
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                </div>
                                <div class="card-body px-0 pb-0">
                                    <div class="table-responsive">
                                        <table class='table mb-0' id="table1">
                                            <thead>
                                                <tr>
                                                    <th colspan="1">Student Name</th>
                                                    <th colspan="1">File Name</th>
                                                    <th colspan="1">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($letters->isNotEmpty())
                                                    @foreach ($letters as $letter)
                                                        <tr>
                                                            <td>{{ $letter->first_name }} {{ $letter->middle_name }} {{ $letter->last_name }} {{ $letter->suffix }}</td>
                                                            <td>{{ $letter->file_name }}</td>  
                                                            <td>
                                                                @include('director.modals.download-reclet')
                                                                <button type="button" class="btn btn-primary block" data-toggle="modal" data-target="#adviser-downloadfiles{{ $letter->file_id }}" title="Download">
                                                                    <i data-feather="download" width="20"></i>    
                                                                </button>
                                                                @include('director.modals.approved-rl')
                                                                <button type="button" class="btn btn-success block" data-toggle="modal" data-target="#approved-rl{{ $letter->file_id }}" title="Approve">
                                                                    <i data-feather="check" width="20"></i> 
                                                                </button>
                                                                @include('director.modals.disapproved-rl')
                                                                <button type="button" class="btn btn-danger block" data-toggle="modal" data-target="#disapproved-rl{{ $letter->file_id }}" title="Deny">
                                                                    <i data-feather="x" width="20"></i> 
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
            {{-- @include('director.footer') --}}
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
