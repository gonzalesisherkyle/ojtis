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
                    <h3>{{ $users->last_name }} {{ $users->first_name }} {{ $users->middle_name }} {{ $users->suffix }}</h3>
                </div>
                <section class="section">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4 class="card-title"> </h4>
                                </div>
                                <div class="card-body px-3 pb-5">
                                    <div class="row">
                                        <div class="col-lg-3 mb-2">
                                            <div class="form-group">
                                                <label for="first_name">First Name</label>
                                                <input type="text" id="first_name" name="first_name" value="{{ $users->first_name }}" class="form-control" autocomplete="first_name" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 mb-2">
                                            <div class="form-group">
                                                <label for="middle_name">Middle Name</label>
                                                <input type="text" id="middle_name" name="middle_name" value="{{ $users->middle_name }}" class="form-control" autocomplete="middle_name" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 mb-2">
                                            <div class="form-group">
                                                <label for="last_name">Last Name</label>
                                                <input type="text" id="last_name" name="last_name" value="{{ $users->last_name }}" class="form-control" autocomplete="last_name" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 mb-2">
                                            <div class="form-group">
                                                <label for="suffix">Suffix</label>
                                                <input type="text" id="suffix" name="suffix" value="{{ $users->suffix }}" class="form-control" autocomplete="suffix" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 mb-2">
                                            <div class="form-group">
                                                <label for="inputAddress">Address</label>
                                                <input type="text" id="inputAddress" name="address" value="{{ $users->address }}" class="form-control" autocomplete="address" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 mb-2">
                                            <div class="form-group">
                                                <label for="student_number">Student Number</label>
                                                <input type="text" id="student_number" name="student_number" value="{{ $users->student_number }}" class="form-control" autocomplete="student_number" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-8 mb-2">
                                            <div class="form-group">
                                                <label for="student_number">Course</label>
                                                <select name="course_id" id="course_id" class="form-select" disabled="true">
                                                    @foreach (\App\Models\Course::all() as $course)
                                                        <option value="{{ $course->course_id }}" @isset($users){{ $course->course_id == $users->course_id ? 'selected' : '' }} @endisset>
                                                            {{ $course->course_name }}
                                                        </option readonly>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 mb-2">
                                            <div class="form-group">
                                                <label for="email">E-mail Address</label>
                                                <input type="text" id="email" name="email" value="{{ $users->email }}" class="form-control" autocomplete="email" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 mb-2">
                                            <div class="form-group">
                                                <label for="year_and_section">Year and Section</label>
                                                <input type="text" id="year_and_section" name="year_and_section" value="{{ $users->year_and_section }}" class="form-control" autocomplete="year_and_section" pattern="[0-5]{1}-[0-9]{1}" placeholder="4-1" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 mb-2">
                                            <div class="form-group">
                                                <label for="date_of_birth">Date of Birth</label>
                                                <input type="date" id="date_of_birth" name="date_of_birth" value="{{ $users->date_of_birth }}" class="form-control" autocomplete="date_of_birth" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 mb-2">
                                            <div class="form-group">
                                                <label for="contact_number">Contact Number</label>
                                                <input type="text" id="contact_number" name="contact_number" value="{{ $users->contact_number }}" class="form-control" autocomplete="contact_number" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="{{ route('ojt-coordinator-student') }}">Back to students</a>
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

    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>

@endsection
