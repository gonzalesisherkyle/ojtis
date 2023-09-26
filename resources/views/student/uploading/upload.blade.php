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
        .column-left{ float: left; width: 33%; }
        .column-right1{ float: right; width: 33%; }
        .form-file{ display: inline-block; width: 33%; }

        @media screen and (max-width: 960px) 
        {
            .column-left{ float: none; width: 100%; }
            .column-right1{ float: none; width: 100%; }
            .form-file{ display: block; width: 100%; }
        }
    </style>
</head>
<body>
    <div id="app">
        @include('student.sidebar')
        <div id="main">
            @include('student.navbar')
            @include('sweetalert::alert')
            <div class="main-content container-fluid">
                <div class="page-title">
                    <h3>Upload OJT Files</h3>
                </div>
                <div class="divider"></div>
                <div class="card-body">
                    <form action="{{ route('student-upload-file') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="column-right">
                            <button class="btn btn-success add_file_btn" >Add Files</button>
                            <button class="btn btn-primary float-right" type="submit">Upload</button>
                        </div>
                        <br>
                        <div id="show_file">
                            <div class="row mb-3">
                                <div class="column-left">
                                    <select class="form-select" name="category_id[]" id="category_id">
                                        @foreach (\App\Models\File_Categories::all() as $category)
                                            <option value="{{ $category->category_id }}">
                                                {{ $category->category_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-file">
                                    <input type="file" class="custom-file-input" id="files" aria-describedby="files" name="file[]" required>
                                </div>
                            </div>        
                        </div>
                    </form>
                </div>   
                <section class="section">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4>Your Files</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class='table table-striped' id="table1">
                                            <thead>
                                                <tr>
                                                    <th colspan="1" width=200>Category</th>
                                                    <th colspan="1" width=500>File Name</th>
                                                    <th colspan="1" width=200>Date Uploaded</th>
                                                    <th colspan="1" width=100>Status</th>
                                                    <th colspan="1">Remove File</th>
                                                    <th colspan="1">Upload Approved Files</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($files->isNotEmpty())
                                                    @foreach ($files as $file)
                                                        <tr>
                                                            <td>{{ $file->category_name }}</td>
                                                            <td>{{ $file->file_name }}</td> 
                                                            <td>{{ $file->date_uploaded }}</td>
                                                            <td style="text-align: center; vertical-align: middle;">
                                                                @if ($file->category_id == 9)
                                                                    @if ($file->adviser_approval == 'approved')
                                                                        @if ($file->signed_approval == 'approved')
                                                                            @if ($file->notary_approval == 'approved')
                                                                                <span class="badge bg-success">Approved</span>
                                                                            @else
                                                                                <span class="badge bg-warning">Processing</span>                                                                              
                                                                            @endif
                                                                        @else
                                                                            <span class="badge bg-warning">Processing</span>   
                                                                        @endif
                                                                    @else
                                                                        <span class="badge bg-warning">Processing</span>   
                                                                    @endif
                                                                @elseif ($file->category_id == 8)
                                                                    @if ($file->adviser_approval == 'approved')
                                                                        @if ($file->signed_approval == 'approved')
                                                                            <span class="badge bg-success">Approved</span>
                                                                        @else
                                                                            <span class="badge bg-warning">Processing</span>   
                                                                        @endif
                                                                    @else
                                                                        <span class="badge bg-warning">Processing</span>   
                                                                    @endif
                                                                @else
                                                                    @if ($file->status == 0 || NULL)
                                                                        <span class="badge bg-warning">Processing</span> 
                                                                    @else
                                                                        <span class="badge bg-success">Approved</span>  
                                                                    @endif	
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @include('student.modals.remove-file')
                                                                <button type="button" class="btn btn-danger btn-sm block" data-toggle="modal" data-target="#remove-file{{ $file->file_id }}">
                                                                    Remove  
                                                                </button>
                                                            </td>
                                                            <td>
                                                                @include('student.uploading.modals.reupload-moa')
                                                                @if ($file->category_id == 9)
                                                                    @if ($file->adviser_approval == 'approved')
                                                                        @if ($file->signed_approval == 'approved')
                                                                            @if ($file->notary_approval == 'approved')
                                                                                <button type="button" class="btn btn-secondary block" data-toggle="modal" data-target="#reupload-moa{{ $file->file_id }}" title="Upload">
                                                                                    Upload
                                                                                </button>
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                @endif

                                                                @if ($file->category_id == 8)
                                                                    @if ($file->adviser_approval == 'approved')
                                                                        @if ($file->signed_approval == 'approved')
                                                                            <button type="button" class="btn btn-secondary block" data-toggle="modal" data-target="#reupload-moa{{ $file->file_id }}" title="Upload">
                                                                                Upload
                                                                            </button>
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                                
                                                            </td>      
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr><td colspan="12" class="text-center">No files found!</td></tr>
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
            {{-- @include('student.footer') --}}
        </div>
    </div>

    <script src="{{ asset('assets/js/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/vendors/chartjs/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/js/vendors.js') }}"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
    <script>
        $(document).ready(function(){
            $(".add_file_btn").click(function(e){
                e.preventDefault();
                $("#show_file").prepend(`
                            <div class="row mb-3">
                                <div class="column-left">
                                    <select class="form-select" name="category_id[]" id="category_id">
                                        @foreach (\App\Models\File_Categories::all() as $category)
                                            <option value="{{ $category->category_id }}">
                                                {{ $category->category_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-file">
                                    <input type="file" class="custom-file-input" id="files" aria-describedby="files" name="file[]" required>
                                </div>
                                <div class="column-right1">
                                    <button class="btn btn-danger remove_file_btn" >Remove</button>
                                </div>
                            </div> `);
            });

            $(document).on('click', '.remove_file_btn', function(e){
                e.preventDefault();
                let row_item = $(this).parent().parent();
                $(row_item).remove();
            });
        }); 
    </script>
</body>
</html>

@endsection
