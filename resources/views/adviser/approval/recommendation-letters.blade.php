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
                    <h3>Pending Approval</h3>
                </div>
                <div class="list-group list-group-horizontal-sm mb-1 text-center" role="tablist">
                    <a class="list-group-item list-group-item-action {{ request()->is('adviser/home/pending/moa') ? 'active' : '' }}" id="list-sunday-list"
                        href="{{ route('adviser-moa') }}" role="tab">Memorandum of Agreement</a>
                    <a class="list-group-item list-group-item-action {{ request()->is('adviser/home/pending/letter') ? 'active' : '' }}" id="list-monday-list"
                        href="{{ route('adviser-letter') }}" role="tab">Recommendation Letter</a>
                </div>
                <section class="section">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    {{-- <h4 class="card-title">Pending Approval</h4> --}}
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class='table table-striped' id="table1">
                                            <thead>
                                                <tr>
                                                    <th colspan="1" width=100>Student Name</th>
                                                    <th colspan="1" width=100>Course</th>
                                                    <th colspan="1" width=200>File Name</th>
                                                    <th colspan="1" width=250>Approve/Deny</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($rLetters->isNotEmpty())
                                                    @foreach ($rLetters as $letter)
                                                        <tr>
                                                            <td>{{ $letter->last_name }} {{ $letter->first_name }} {{ $letter->middle_name }} {{ $letter->suffix }}</td>
                                                            <td>{{ $letter->course_abb }} {{ $letter->year_and_section }}</td>    
                                                            <td><a href="{{ route('adviser-downloadfiles', ['user' => $letter->user_id, 'file' => $letter->file_name]) }}">{{ $letter->file_name }}</a></td>    
                                                            <td>
                                                                @include('adviser.modals.approved-rl')
                                                                <button type="button" class="btn btn-success block" data-toggle="modal" data-target="#approved-rl{{ $letter->file_id }}" title="Approve">
                                                                    Pending for Signature 
                                                                </button>
                                                                @include('adviser.modals.disapproved-rl')
                                                                <button type="button" class="btn btn-danger block" data-toggle="modal" data-target="#disapproved-rl{{ $letter->file_id }}" title="Deny">
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
            {{-- @include('superadmin.footer') --}}
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
