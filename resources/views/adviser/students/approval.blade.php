@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OJTIS</title>

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/vendors/chartjs/Chart.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/simple-datatables/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/pup-logo.png') }}" type="image/x-icon">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
</head>
<body>
    <div id="app">
        @include('adviser.sidebar')
        <div id="main">
            @include('adviser.navbar')
            @include('sweetalert::alert')
            <div class="main-content container-fluid">
                <div class="page-title">
                    <h3>Pending for approval</h3>
                </div>
                <section class="section">
                    <div class="row mb-4">
                        <div class="col-md-12">                
                            <div class="card">
                                <form action="{{ route('adviser-creates') }}" method="post">
                                    @csrf
                                <div class="card-header d-flex justify-content-between align-items-center">                           
                                    <button type="submit" class="btn btn-success send-email">Approve Selected</button>
                                </div>
                                <div class="card-body">
                                    <input type="checkbox" name="select-all" id="select-all"> Select all
                                    <div class="table-responsive">
                                        <table class='table table-striped' id="table1">
                                            <thead>
                                                
                                                <tr>
                                                    <th colspan="1"></th>
                                                    <th colspan="1">Student Name</th>
                                                    <th colspan="1">Email</th>
                                                    <th colspan="1">Course and Section</th>
                                                    <th colspan="1">Approve/Deny</th>
                                                </tr>
                                            </thead>
                                            <tbody>    
                                                @if ($pending->isNotEmpty())
                                                    @foreach ($pending as $students)
                                                        <tr>
                                                            <td><input type="checkbox" class="students-checkbox" name="students[]" value="{{ $students->reg_id }}"></td></form>
                                                            <td>{{ $students->last_name}} {{ $students->first_name }}</td>
                                                            <td>{{ $students->email}}</td>
                                                            <td>{{ $students->course_abb}} {{$students->year_and_section}}</td>
                                                            <td>
                                                                @include('adviser.modals.accept-student')
                                                                <button type="button" class="btn btn-success block" data-toggle="modal" data-target="#accept-student{{ $students->reg_id }}">
                                                                    Approve
                                                                </button>
                                                                @include('adviser.modals.deny-student')
                                                                <button type="button" class="btn btn-danger block" data-toggle="modal" data-target="#deny-student{{ $students->reg_id }}">
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
    <script type="text/javascript">
        $('#select-all').click(function(event) {   
            if(this.checked) {
                // Iterate each checkbox
                $(':checkbox').each(function() {
                    this.checked = true;                        
                });
            } else {
                $(':checkbox').each(function() {
                    this.checked = false;                       
                });
            }
        }); 
    </script>
</body>
</html>

@endsection
