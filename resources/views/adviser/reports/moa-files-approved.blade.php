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
        td 
        {
            height: 50px; 
            width: 50px;
        }

        #cssTable td 
        {
            text-align: center; 
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <div id="app">
        @include('adviser.sidebar')
        <div id="main">
            @include('adviser.navbar')
            @include('sweetalert::alert')
            <div class="main-content container-fluid">
                <div class="page-title">
                    <h3>Approved Files</h3>
                </div>
                <div class="list-group list-group-horizontal-sm mb-1 text-center" role="tablist">
                    <a class="list-group-item list-group-item-action {{ request()->is('adviser/home/approved/moa') ? 'active' : '' }}" id="list-sunday-list"
                        href="{{ route('adviser-moa-approved') }}" role="tab">Memorandum of Agreement</a>
                    <a class="list-group-item list-group-item-action {{ request()->is('adviser/home/approved/letter') ? 'active' : '' }}" id="list-monday-list"
                        href="{{ route('adviser-letter-approved') }}" role="tab">Recommendation Letter</a>
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
                                                    <th colspan="1" width=300>File Name</th>
                                                    <th colspan="1" width=275>Status from OJT Coordinator</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($moa_files->isNotEmpty())
                                                    @foreach ($moa_files as $moa)
                                                        <tr>
                                                            <td>{{ $moa->last_name }} {{ $moa->first_name }} {{ $moa->middle_name }} {{ $moa->suffix }}</td>
                                                            <td>{{ $moa->course_abb }} {{ $moa->year_and_section }}</td>
                                                            <td><a href="{{ route('adviser-downloadfiles', ['user' => $moa->user_id, 'file' => $moa->file_name]) }}"> {{ $moa->file_name }}</td>
                                                            <td style="text-align: center; vertical-align: middle;">
                                                                @if ($moa->ojt_coordinator_approval == 'approved')
                                                                    <span class="badge bg-success">Approved</span> 
                                                                @elseif($moa->ojt_coordinator_approval == 'disapproved')
                                                                    <span class="badge bg-danger">Denied</span> 
                                                                @else
                                                                    <span class="badge bg-warning">Processing</span>  
                                                                @endif
                                                            </td>
                                                            {{-- <td>
                                                                @include('adviser.modals.download-moa')
                                                                <button type="button" class="btn btn-primary block" data-toggle="modal" data-target="#adviser-downloadfiles{{ $moa->file_id }}" title="Download">
                                                                    Download  
                                                                </button>
                                                            </td> --}}
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
    <script>
        function printData()
        {
            var divToPrint = document.getElementById("table1");
            newWin = window.open("");
            newWin.document.write("<center><h1>OJTIS</h1><p>Approved MOA</p> </center>");
            newWin.document.write("<style> th:nth-child(4){display:none;} </style>");
            newWin.document.write("<style> td:nth-child(4){display:none;} </style>");
            newWin.document.write("<style> th:nth-child(5){display:none;} </style>");
            newWin.document.write("<style> td:nth-child(5){display:none;} </style>");
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
