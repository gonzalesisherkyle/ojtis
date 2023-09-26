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
        @include('ojt-coordinator.sidebar')
        <div id="main">
            @include('ojt-coordinator.navbar')
            @include('sweetalert::alert')
            <div class="main-content container-fluid">
                <div class="page-title">
                    <h3>Advisers</h3>
                </div>
                <section class="section">
                
                    <div class="row mb-4">
                        <div class="col-md-12">
            
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <button type="submit" id ="button" name = "print_checkbox" class="btn btn-info btn-sm block">Generate PDF</button>
                                    <h4 class="card-title"> </h4>
                                    @include('ojt-coordinator.advisers.modals.add-user')
                                    <button type="button" class="btn btn-success block" data-toggle="modal" data-target="#add-user">
                                        <i data-feather="plus" width="20"></i>   
                                    </button>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class='table table-striped' id="table1">
                                            <thead>
                                                <tr>                                       
                                                    <th colspan="1" width=250>Adviser Name</th>                                            
                                                    <th colspan="1" width=250>Email</th>                                            
                                                    <th colspan="1" width=150>Contact Number</th>
                                                    <th colspan="1" width=150>View Information</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                               
                                                @if ($adviser->isNotEmpty())
                                                    @foreach ($adviser as $user)
                                                        <tr>
                                                            <td>{{ $user->last_name }} {{ $user->first_name}} {{ $user->middle_name }} {{ $user->suffix }}</td>           
                                                            <td>{{ $user->email }}</td>                            
                                                            <td>{{ $user->contact_number }}</td>                            
                                                            <td>
                                                                <a href="{{ route('ojt-coordinator-view-adviser', $user->user_id) }}" class="btn btn-info btn-sm block">View
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr><td colspan="12" class="text-center">No student found!</td></tr>
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
            newWin.document.write("<center><h1>OJTIS</h1><p>Advisers</p> </center>");
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
