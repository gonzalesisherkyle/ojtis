@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OJTIS</title>
    
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    
    <link rel="stylesheet" href="{{ asset('assets/vendors/simple-datatables/style.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/pup-logo.png') }}" type="image/x-icon">
    {{-- <style>
        /* The switch - the box around the slider */
        .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
        }

        /* Hide default HTML checkbox */
        .switch input {
        opacity: 0;
        width: 0;
        height: 0;
        }

        /* The slider */
        .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
        }

        .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
        }

        input:checked + .slider {
        background-color: #2196F3;
        }

        input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
        border-radius: 34px;
        }

        .slider.round:before {
        border-radius: 50%;
        }
    </style> --}}
</head>
<body>
    <div id="app">
        @include('adviser.sidebar')
        <div id="main">
            @include('adviser.navbar')   
            @include('sweetalert::alert')        
            <div class="main-content container-fluid">
                <div class="page-title">
                    <h3>Students' Files</h3>
                </div>
                <section class="section">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class='table table-striped' id="table1">
                                            <thead>
                                                <tr>
                                                    <th colspan="1" width=150>Student Name</th>
                                                    <th colspan="1" width=150>Course, Year & Section</th>
                                                    <th colspan="1" width=250>File Name</th>
                                                    <th colspan="1" width=100>Category</th>
                                                    <th colspan="1" width=100>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($users->isNotEmpty())
                                                    @foreach ($users as $file)
                                                        <tr>
                                                            <td>{{ $file->last_name }} {{ $file->first_name }} {{ $file->middle_name }} {{ $file->suffix }}</td> 
                                                            <td>{{ $file->course_abb }} {{ $file->year_and_section }}</td>
                                                            <td><a href="{{ route('adviser-downloadfiles', ['user' => $file->uploaded_by, 'file' => $file->file_name]) }}">{{ $file->file_name }}</a></td>           
                                                            <td>{{ $file->category_name }}</td>
                                                            <td style="text-align: center; vertical-align: middle;">
                                                                <form method="POST" action="{{ route('update-record') }}">
                                                                    @csrf
                                                                    <input type="hidden" name="id" value="{{ $file->file_id }}">
                                                                    <input type="checkbox" name="status" value="1" {{ $file->status == 1 ? 'checked' : '' }}><br>
                                                                    <button type="submit" class="btn btn-success block">Update</button>
                                                                </form>
                                                            </td>
                                                            {{-- <td>
                                                                @include('adviser.modals.download-file')
                                                                <button type="button" class="btn btn-primary block" data-toggle="modal" data-target="#adviser-downloadfiles{{ $file->file_id }}">
                                                                    Download  
                                                                </button>
                                                            </td>--}}
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr><td colspan="12">No files found!</td></tr>
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

    <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>

    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/js/vendors.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('input[name="checkbox_name"]').change(function() {
                var isChecked = $(this).is(':checked');
                var recordId = $('input[name="id"]').val();

                $.ajax({
                    url: '{{ route('update-record') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: recordId,
                        checkbox_name: isChecked ? 1 : 0
                    },
                    success: function(response) {
                        console.log(response);
                    }
                });
            });
        });
    </script>
</body>
</html>

@endsection
