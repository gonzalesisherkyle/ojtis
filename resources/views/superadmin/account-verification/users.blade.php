@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Super Admin</title>
    
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
            
            <div class="main-content container-fluid">
                <div class="page-title">
                    <h3>User Management - Users</h3>
                </div>
                <section class="section">
                    <div class="row mb-4">
                        <div class="col-md-12">
                           
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4 class="card-title">Account Applicants</h4>
                                    <div class="d-flex ">
                                        <i data-feather="download"></i>
                                    </div>
                                </div>
                                <div class="card-body px-0 pb-0">
                                    <div class="table-responsive">
                                        <table class='table mb-0' id="table1">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Applying as</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                               
                                                @if ($users->isNotEmpty())
                                                    @foreach ($users as $user)
                                                        <tr>
                                                            <td>{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</td>
                                                            <td>{{ $user->email }}</td>
                                                            <td>{{ $user->applying_as }}</td>
                                                            <td>
                                                              
                                                                @include('superadmin.account-verification.modals.approved')
                                                                <button type="button" class="btn btn-primary block" data-toggle="modal" data-target="#approve-applicant{{ $user->user_id }}">
                                                                    <i data-feather="check"></i> Approve
                                                                </button>
                                                                
                                                                <a role="button" class="btn btn-sm btn-info"
                                                                href="{{ route('superadmin-users-show', $user->user_id) }}">
                                                                <i class="fas fa-eye"></i> View </a>

                                                               
                                                                @include('superadmin.account-verification.modals.disapproved')
                                                                <button type="button" class="btn btn-danger block" data-toggle="modal" data-target="#disapprove-applicant{{ $user->user_id }}">
                                                                    <i data-feather="x"></i> Disapprove
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
            @include('superadmin.footer')
        </div>
    </div>
    <script src="{{ asset('assets/js/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    
    <script src="{{ asset('assets/vendors/chartjs/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('assets/vendors/simple=datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/js/vendors.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/js/vendors.js') }}"></script>
</body>
</html>

@endsection
