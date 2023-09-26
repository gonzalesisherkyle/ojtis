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
                    <h3>Ready for Signature</h3>
                </div>
                <section class="section">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <button type="submit" id ="button" name = "print_checkbox" class="btn btn-info btn-sm block">Generate PDF</button>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class='table table-striped' id="table1">
                                            <thead>
                                                <tr>
                                                    <th colspan="1" width=200>Student Name</th>
                                                    <th colspan="1" width=150>Course</th>
                                                    <th colspan="1" width=400>File Name</th>
                                                    <th colspan="1" width=150>Notify</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($users->isNotEmpty())
                                                    @foreach ($users as $user)
                                                        <tr>
                                                            <td>{{ $user->last_name }} {{ $user->first_name }} {{ $user->middle_name }} {{ $user->suffix }}</td> 
                                                            <td>{{ $user->course_abb }} {{ $user->year_and_section }}</td>
                                                            <td>{{ $user->file_name }}</td>           
                                                            {{-- <td>
                                                                @include('ojt-coordinator.student-files.modals.download-moa')
                                                                <button type="button" class="btn btn-secondary block" data-toggle="modal" data-target="#download-files{{ $user->user_id }}">
                                                                    Download   
                                                                </button>
                                                            </td>    --}}
                                                            <td>
                                                                @include('ojt-coordinator.student-files.modals.notify')
                                                                <button type="button" class="btn btn-info block" data-toggle="modal" data-target="#ojt-notify{{ $user->file_id }}" >
                                                                    Notify   
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
            {{-- @include('ojt-coordinator.footer') --}}
        </div>
    </div>
    <script src="{{ asset('assets/js/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>

    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/js/vendors.js') }}"></script>
    <script>
        function printData()
        {
            var divToPrint = document.getElementById("table1");
            newWin = window.open("");
            newWin.document.write("<center><h1>OJTIS</h1><p>Students</p> </center>");
            newWin.document.write("<style> th:nth-child(4){display:none;} </style>");
            newWin.document.write("<style> td:nth-child(4){display:none;} </style>");
            newWin.document.write(divToPrint.outerHTML);
            newWin.document.close();
            newWin.print();
            //newWin.close();   
        }
    
        document.querySelector("#button").addEventListener("click", function(){
          printData();
        });
    </script>
</body>
</html>

@endsection
