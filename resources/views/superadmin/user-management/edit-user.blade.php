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
        @include('superadmin.sidebar')
        <div id="main">
            @include('superadmin.navbar')
            @include('sweetalert::alert')
            <div class="main-content container-fluid">
                <div class="page-title">
                    <h3>Update User</h3>
                </div>
                <section class="section">
                   
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4 class="card-title">
                                        {{ $users->last_name }} {{ $users->first_name }} {{ $users->middle_name }} {{ $users->suffix }}
                                    </h4>
                                </div>
                                <div class="card-body px-3 pb-5">
                                    <form action="{{ route('superadmin-users-update',$users->user_id) }}" method="POST" >
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col-lg-3 mb-2">
                                                <div class="form-group">
                                                    <label for="first_name">First Name</label>
                                                    <strong class="text" style="color:red">*</strong>
                                                    <input type="text" id="first_name" name="first_name" value="{{ $users->first_name }}" class="form-control @error('first_name') is-invalid @enderror" autocomplete="first_name" autofocus required>
                                                    @error('first_name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-3 mb-2">
                                                <div class="form-group">
                                                    <label for="middle_name">Middle Name</label>
                                                    <input type="text" id="middle_name" name="middle_name" value="{{ $users->middle_name }}" class="form-control @error('middle_name') is-invalid @enderror" autocomplete="middle_name">
                                                    @error('middle_name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-3 mb-2">
                                                <div class="form-group">
                                                    <label for="last_name">Last Name</label>
                                                    <strong class="text" style="color:red">*</strong>
                                                    <input type="text" id="last_name" name="last_name" value="{{ $users->last_name }}" class="form-control @error('last_name') is-invalid @enderror" autocomplete="last_name" required>
                                                    @error('last_name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-3 mb-2">
                                                <div class="form-group">
                                                    <label for="suffix">Suffix</label>
                                                    <input type="text" id="suffix" name="suffix" value="{{ $users->suffix }}" class="form-control @error('suffix') is-invalid @enderror" autocomplete="suffix">
                                                    @error('suffix')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-2">
                                                <div class="form-group">
                                                    <label for="inputAddress">Address</label>
                                                    <strong class="text" style="color:red">*</strong>
                                                    <input type="text" id="inputAddress" name="address" value="{{ $users->address }}" class="form-control @error('address') is-invalid @enderror" autocomplete="address" placeholder="1234 Main St" required>
                                                    @error('address')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            @if ($users->applying_as == "Student")
                                                <div class="col-lg-4 mb-2">
                                                    <div class="form-group">
                                                        <label for="student_number">Student Number</label>
                                                        <strong class="text" style="color:red">*</strong>
                                                        <input type="text" id="student_number" name="student_number" value="{{ $users->student_number }}" class="form-control @error('student_number') is-invalid @enderror" autocomplete="student_number" placeholder="2019-00000-TG-0" pattern="[0-9]{4}-[0-9]{5}-[A-Z]{2}-[0]{1}">
                                                        @error('student_number')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-8 mb-2">
                                                    <div class="form-group">
                                                        <label for="student_number">Course</label>
                                                        <strong class="text" style="color:red">*</strong>
                                                        <select name="course_id" id="course_id" class="form-select @error('course_id') is-invalid @enderror">
                                                            @foreach (\App\Models\Course::all() as $course)
                                                                <option value="{{ $course->course_id }}" @isset($users){{ $course->course_id == $users->course_id ? 'selected' : '' }} @endisset>
                                                                    {{ $course->course_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('course_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="col-lg-3 mb-2">
                                                <div class="form-group">
                                                    <label for="email">E-mail Address</label>
                                                    <strong class="text" style="color:red">*</strong>
                                                    <input type="text" id="email" name="email" value="{{ $users->email }}" class="form-control @error('email') is-invalid @enderror" autocomplete="email" required>
                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            @if ($users->applying_as == "Student")
                                                <div class="col-lg-3 mb-2">
                                                    <div class="form-group">
                                                        <label for="year_and_section">Year and Section</label>
                                                        <strong class="text" style="color:red">*</strong>
                                                        <input type="text" id="year_and_section" name="year_and_section" value="{{ $users->year_and_section }}" class="form-control @error('year_and_section') is-invalid @enderror" autocomplete="year_and_section" pattern="[0-5]{1}-[0-9]{1}" placeholder="Year-Section(1-1)">
                                                        @error('year_and_section')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="col-lg-3 mb-2">
                                                <div class="form-group">
                                                    <label for="date_of_birth">Date of Birth</label>
                                                    <strong class="text" style="color:red">*</strong>
                                                    <input type="date" id="date_of_birth" name="date_of_birth" value="{{ $users->date_of_birth }}" class="form-control @error('date_of_birth') is-invalid @enderror" autocomplete="date_of_birth" required>
                                                    @error('date_of_birth')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-3 mb-2">
                                                <div class="form-group">
                                                    <label for="contact_number">Contact Number</label>
                                                    <strong class="text" style="color:red">*</strong>
                                                    <input type="text" id="contact_number" name="contact_number" value="{{ $users->contact_number }}" class="form-control @error('contact_number') is-invalid @enderror" autocomplete="contact_number" required>
                                                    @error('contact_number')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>                                         
                                        </div>
                                        <a href="{{ route('superadmin-users') }}">Back to users</a>
                                        <div class="clearfix">
                                            <button class="btn btn-primary float-right" type="submit">Update</button>
                                        </div>
                                    </form>
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

    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>

@endsection
