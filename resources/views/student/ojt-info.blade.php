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
        @include('student.sidebar')
        <div id="main">
            @include('student.navbar')
            @include('sweetalert::alert')
            <div class="main-content container-fluid">
                <div class="page-title">
                    <h3>OJT  Information</h3>
                </div>
                <section class="section">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4 class="card-title"> </h4>
                                </div>
                                <div class="card-body px-3 pb-5">
                                    <form action="{{ route('student-ojt-update') }}" method="POST" >
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            @if ($info == null)
                                                <div class="col-lg-3 mb-2">
                                                    <div class="form-group">
                                                        <label for="company_name">Company Name</label>
                                                        <strong class="text" style="color:red">*</strong>
                                                        <input type="text" id="company_name" name="company_name" value="" class="form-control @error('company_name') is-invalid @enderror" autocomplete="company_name" autofocus required>
                                                        @error('company_name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-9 mb-2">
                                                    <div class="form-group">
                                                        <label for="company_address">Company Address</label>
                                                        <strong class="text" style="color:red">*</strong>
                                                        <input type="text" id="company_address" name="company_address" value="" class="form-control @error('company_address') is-invalid @enderror" autocomplete="company_address">
                                                        @error('company_address')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 mb-2">
                                                    <div class="form-group">
                                                        <label for="nature_of_bus">Nature of Business</label>
                                                        <strong class="text" style="color:red">*</strong>
                                                        <input type="text" id="nature_of_bus" name="nature_of_bus" value="" class="form-control @error('nature_of_bus') is-invalid @enderror" autocomplete="nature_of_bus" placeholder="Educational Institution, Government Agency, Telecommunication, Travel Agency, Hotel and Hospitality Service, Food Service, BPOs, NGOs, POS, etc." required>
                                                        @error('nature_of_bus')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 mb-2">
                                                    <div class="form-group">
                                                        <label for="nature_of_link">Nature of Networking or Linkages</label>
                                                        <strong class="text" style="color:red">*</strong>
                                                        <input type="text" id="nature_of_link" name="nature_of_link" value="" class="form-control @error('nature_of_link') is-invalid @enderror" autocomplete="nature_of_link" placeholder="Academic Linkages, Benefactors, Research and Extension Linkage, Educational and Cultural Exchange, Government Agencies Partners, National/Institutional Membership, Non-Government Organizations Partners, OJT/Training Stations etc." required>
                                                        @error('nature_of_link')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 mb-2">
                                                    <div class="form-group">
                                                        <label for="level">Level</label>
                                                        <strong class="text" style="color:red">*</strong>
                                                        <input type="text" id="level" name="level" value="" class="form-control @error('level') is-invalid @enderror" autocomplete="level" placeholder="Internation, National, Regional, Local" required>
                                                        @error('level')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 mb-2">
                                                    <div class="form-group">
                                                        <label for="start_date">Start Date</label>
                                                        <strong class="text" style="color:red">*</strong>
                                                        <input type="date" id="start_date" name="start_date" value="" class="form-control @error('start_date') is-invalid @enderror" autocomplete="start_date" required>
                                                        @error('start_date')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 mb-2">
                                                    <div class="form-group">
                                                        <label for="finish_date">End Date</label>
                                                        <strong class="text" style="color:red">*</strong>
                                                        <input type="date" id="finish_date" name="finish_date" value="" class="form-control @error('finish_date') is-invalid @enderror" autocomplete="finish_date" required>
                                                        @error('finish_date')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 mb-2">
                                                    <div class="form-group">
                                                        <label for="report_time">Report Time</label>
                                                        <strong class="text" style="color:red">*</strong>
                                                        <input type="text" id="report_time" name="report_time" value="" class="form-control @error('report_time') is-invalid @enderror" placeholder="8:00 AM - 5:00 PM (Monday - Friday)">
                                                        @error('report_time')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="divider">
                                                    <div class="divider-text">Contact Information</div>
                                                </div>
                                                <div class="col-lg-4 mb-2">
                                                    <div class="form-group">
                                                        <label for="contact_name">Contact Name</label>
                                                        <strong class="text" style="color:red">*</strong>
                                                        <input type="text" id="contact_name" name="contact_name" value="" class="form-control @error('contact_name') is-invalid @enderror" autocomplete="contact_name" required>
                                                        @error('contact_name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 mb-2">
                                                    <div class="form-group">
                                                        <label for="contact_position">Contact Position</label>
                                                        <strong class="text" style="color:red">*</strong>
                                                        <input type="text" id="contact_position" name="contact_position" value="" class="form-control @error('contact_position') is-invalid @enderror" autocomplete="contact_position" required>
                                                        @error('contact_position')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 mb-2">
                                                    <div class="form-group">
                                                        <label for="contact_number">Contact Number</label>
                                                        <strong class="text" style="color:red">*</strong>
                                                        <input type="text" id="contact_number" name="contact_number" value="" class="form-control @error('contact_number') is-invalid @enderror" autocomplete="contact_number" required>
                                                        @error('contact_number')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>  
                                            @else
                                                <div class="col-lg-3 mb-2">
                                                    <div class="form-group">
                                                        <label for="company_name">Company Name</label>
                                                        <strong class="text" style="color:red">*</strong>
                                                        <input type="text" id="company_name" name="company_name" value="{{ $info->company_name }}" class="form-control @error('company_name') is-invalid @enderror" autocomplete="company_name" autofocus required>
                                                        @error('company_name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-9 mb-2">
                                                    <div class="form-group">
                                                        <label for="company_address">Company Address</label>
                                                        <strong class="text" style="color:red">*</strong>
                                                        <input type="text" id="company_address" name="company_address" value="{{ $info->company_address }}" class="form-control @error('company_address') is-invalid @enderror" autocomplete="company_address">
                                                        @error('company_address')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 mb-2">
                                                    <div class="form-group">
                                                        <label for="nature_of_bus">Nature of Business</label>
                                                        <strong class="text" style="color:red">*</strong>
                                                        <input type="text" id="nature_of_bus" name="nature_of_bus" value="{{ $info->nature_of_bus }}" class="form-control @error('nature_of_bus') is-invalid @enderror" autocomplete="nature_of_bus" placeholder="Educational Institution, Government Agency, Telecommunication, Travel Agency, Hotel and Hospitality Service, Food Service, BPOs, NGOs, POS, etc." required>
                                                        @error('nature_of_bus')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 mb-2">
                                                    <div class="form-group">
                                                        <label for="nature_of_link">Nature of Networking or Linkages</label>
                                                        <strong class="text" style="color:red">*</strong>
                                                        <input type="text" id="nature_of_link" name="nature_of_link" value="{{ $info->nature_of_link }}" class="form-control @error('nature_of_link') is-invalid @enderror" autocomplete="nature_of_link" placeholder="Academic Linkages, Benefactors, Research and Extension Linkage, Educational and Cultural Exchange, Government Agencies Partners, National/Institutional Membership, Non-Government Organizations Partners, OJT/Training Stations etc." required>
                                                        @error('nature_of_link')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 mb-2">
                                                    <div class="form-group">
                                                        <label for="level">Level</label>
                                                        <strong class="text" style="color:red">*</strong>
                                                        <input type="text" id="level" name="level" value="{{ $info->level }}" class="form-control @error('level') is-invalid @enderror" autocomplete="level" placeholder="Internation, National, Regional, Local" required>
                                                        @error('level')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 mb-2">
                                                    <div class="form-group">
                                                        <label for="start_date">Start Date</label>
                                                        <strong class="text" style="color:red">*</strong>
                                                        <input type="date" id="start_date" name="start_date" value="{{ $info->start_date }}" class="form-control @error('start_date') is-invalid @enderror" autocomplete="start_date" required>
                                                        @error('start_date')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 mb-2">
                                                    <div class="form-group">
                                                        <label for="finish_date">End Date</label>
                                                        <strong class="text" style="color:red">*</strong>
                                                        <input type="date" id="finish_date" name="finish_date" value="{{ $info->finish_date}}" class="form-control @error('finish_date') is-invalid @enderror" autocomplete="finish_date" required>
                                                        @error('finish_date')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 mb-2">
                                                    <div class="form-group">
                                                        <label for="report_time">Report Time</label>
                                                        <strong class="text" style="color:red">*</strong>
                                                        <input type="text" id="report_time" name="report_time" value="{{ $info->report_time }}" class="form-control @error('report_time') is-invalid @enderror" placeholder="8:00 AM - 5:00 PM (Monday - Friday)">
                                                        @error('report_time')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="divider">
                                                    <div class="divider-text">Contact Information</div>
                                                </div>
                                                <div class="col-lg-4 mb-2">
                                                    <div class="form-group">
                                                        <label for="contact_name">Contact Name</label>
                                                        <strong class="text" style="color:red">*</strong>
                                                        <input type="text" id="contact_name" name="contact_name" value="{{ $info->contact_name }}" class="form-control @error('contact_name') is-invalid @enderror" autocomplete="contact_name" required>
                                                        @error('contact_name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 mb-2">
                                                    <div class="form-group">
                                                        <label for="contact_position">Contact Position</label>
                                                        <strong class="text" style="color:red">*</strong>
                                                        <input type="text" id="contact_position" name="contact_position" value="{{ $info->contact_position }}" class="form-control @error('contact_position') is-invalid @enderror" autocomplete="contact_position" required>
                                                        @error('contact_position')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 mb-2">
                                                    <div class="form-group">
                                                        <label for="contact_number">Contact Number</label>
                                                        <strong class="text" style="color:red">*</strong>
                                                        <input type="text" id="contact_number" name="contact_number" value="{{ $info->contact_number }}" class="form-control @error('contact_number') is-invalid @enderror" autocomplete="contact_number" required>
                                                        @error('contact_number')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>  
                                            @endif                        
                                        </div>
                                        {{-- <a href="{{ route('superadmin-users') }}">Back to users</a> --}}
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
