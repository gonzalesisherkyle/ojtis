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
        @include('superadmin.sidebar')
        <div id="main">
            @include('superadmin.navbar')
            @include('sweetalert::alert')
            <div class="main-content container-fluid">
                <div class="page-title">
                    <h3>Courses</h3>
                </div>
                <section class="section">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4 class="card-title"></h4>
                                    <div class="d-flex ">
                                        @include('superadmin.courses.modals.create')
                                        <button type="button" class="btn btn-success block" data-toggle="modal" data-target="#add-course">
                                            <i data-feather="plus"></i>
                                         </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class='table table-striped' id="table1">
                                            <thead>
                                                <tr>
                                                    <th colspan="1" width=750>Course</th>
                                                    <th colspan="1" width=200>Acronym</th>
                                                    <th colspan="1" width=350>Edit/Remove</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($courses->isNotEmpty())
                                                    @foreach ($courses as $course)
                                                        <tr>
                                                            <td>{{ $course->course_name }}</td>
                                                            <td>{{ $course->course_abb }}</td>
                                                            <td>
                                                                @include('superadmin.courses.modals.edit')
                                                                <button type="button" class="btn btn-primary block" data-toggle="modal" data-target="#edit-course{{ $course->course_id }}">
                                                                    Edit
                                                                </button>                                                    
                                                                @include('superadmin.courses.modals.delete')
                                                                <button type="button" class="btn btn-danger block" data-toggle="modal" data-target="#delete-course{{ $course->course_id }}">
                                                                    Remove
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr><td class="text-center" colspan="12">No results found!</td></tr>
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
    <script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/js/vendors.js') }}"></script>
    <script src="{{ asset('assets/vendors/chartjs/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>

@endsection
