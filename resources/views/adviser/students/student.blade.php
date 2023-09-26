@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OJTIS</title>
    
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.13.1/b-2.3.3/b-html5-2.3.3/b-print-2.3.3/datatables.min.css"/>
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
                    <h3>Students</h3>
                </div>
                <section class="section">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <button type="submit" id="button" name="print_checkbox" class="btn btn-info btn-sm block">Generate PDF</button>
                                    @include('adviser.modals.add-student')
                                    {{-- <button type="button" class="btn btn-success block" data-toggle="modal" data-target="#add-student">
                                        <i data-feather="plus" width="20"></i>   
                                    </button> --}}
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class='table table-striped' id="table1">
                                            <thead>
                                                <tr>
                                                    <th colspan="1" width=150>Student Number</th>                                               
                                                    <th colspan="1" width=200>Student Name</th>                                               
                                                    <th colspan="1" width=200>Email</th>                                               
                                                    <th colspan="1" width=100>Course</th>
                                                    <th colspan="1" width=150>View Information</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                               
                                                @if ($student->isNotEmpty())
                                                    @foreach ($student as $user)
                                                        <tr>
                                                            <td>{{ $user->student_number }}</td>
                                                            <td>{{ $user->last_name}} {{ $user->first_name }} {{ $user->middle_name }} {{ $user->suffix }}</td>           
                                                            <td>{{ $user->email }}</td>                            
                                                            <td>{{ $user->course_abb }} {{ $user->year_and_section }}</td>                            
                                                            <td>
                                                                <a href="{{ route('adviser-view-student', $user->student_id) }}" class="btn btn-info btn-sm block" title="View student information">
                                                                    View
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
    <script src="{{ asset('assets/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/js/vfs_fonts.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>  
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
    <script>
        function printData()
        {
            var divToPrint = document.getElementById("table1");
            newWin = window.open("");
            newWin.document.write("<center><h1>OJTIS</h1><p>Students</p> </center>");
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
    <script>
        function html_table_to_excel(type)
        {   
            var data = document.getElementById('table1');

            var file = XLSX.utils.table_to_book(data, {sheet: "sheet1"});

            XLSX.write(file, { bookType: type, bookSST: true, type: 'base64' });

            XLSX.writeFile(file, 'students.' + type);
        }

        const export_button = document.getElementById('export_button');

        export_button.addEventListener('click', () =>  {
            html_table_to_excel('xlsx');
    });
    </script>
</body>
</html>

@endsection
    