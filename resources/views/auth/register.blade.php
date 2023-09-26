@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - OJTIS</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="assets/vendors/choices.js/choices.min.css" />
    <link rel="shortcut icon" href="{{ asset('assets/images/pup-logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    @include('sweetalert::alert')
    <div id="auth">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-12 mx-auto">
                    <div class="card pt-4">
                        <div class="card-body">
                            <a href="{{ route('home') }}">Back to login</a>
                            <div class="text-center mb-5">
                                <img src="{{ asset('assets/images/pup-logo.png') }}" height=96><br>
                                <img src="{{ asset('assets/images/ojtis-logo.png') }}" height=96 class="img-fluid">
                                <h3>Register</h3>
                            </div>
                            <form action="{{ route('pending') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 mb-2">
                                        <div class="form-group">
                                            <label for="last_name">Last Name</label>
                                            <strong class="text" style="color:red">*</strong>
                                            <input type="text" id="last_name" name="last_name" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-2">
                                        <div class="form-group">
                                            <label for="first_name">First Name</label>
                                            <strong class="text" style="color:red">*</strong>
                                            <input type="text" id="first_name" name="first_name" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group>
                                        <label for="email">E-mail Address</label>
                                        <strong class="text" style="color:red">*</strong>
                                        <div class="position-relative">
                                            <input type="email" class="form-control" id="email" name="email" required>
                                        </div>        
                                    </div>    
                                    <div class="col-lg-6 mb-2">
                                        <div class="form-group">
                                            <label for="course_id">Course</label>
                                            <strong class="text" style="color:red">*</strong>
                                            <select name="course_id" id="course_id" class="form-select" required>
                                                @foreach (\App\Models\Course::all() as $course)
                                                    <option value="{{ $course->course_id }}">
                                                        {{ $course->course_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>    
                                    </div>
                                    <div class="col-lg-6 mb-2">
                                        <div class="form-group">
                                            <label for="year_and_section">Year and Section</label>
                                            <strong class="text" style="color:red">*</strong>
                                            <input type="text" id="year_and_section" name="year_and_section" class="form-control" pattern="[0-5]{1}-[0-9]{1}" placeholder="4-1" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="adviser">Adviser</label>   
                                        <strong class="text" style="color:red">*</strong>        
                                        <select class="choices form-select" name="adviser" id="adviser" required>
                                            @foreach ($advisers as $adviser)
                                                <option value="{{ $adviser->user_id }}">
                                                    {{ $adviser->last_name }}, {{ $adviser->first_name }} {{ $adviser->middle_name }}
                                                </option>
                                            @endforeach
                                        </select>   
                                    </div>     
                                </div>                   
                                <div class="clearfix">
                                    <button class="btn btn-primary float-right" type="submit">Register</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="assets/vendors/choices.js/choices.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $("#toggle_pwd1").click(function () {
                $(this).toggleClass("fa-eye fa-eye-slash");
               var type = $(this).hasClass("fa-eye") ? "text" : "password";
                $("#password").attr("type", type);
            });
        });
    </script>
</body>

</html>

@endsection
