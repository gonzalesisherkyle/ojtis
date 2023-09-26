<div id="sidebar" class='active'>
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
        <img src="{{ asset('assets/images/ojtis-logo2.png') }}">
        </div>
        <div class="sidebar-menu">
        <ul class="menu">        
            <li class='sidebar-title'>{{ $user->last_name }} {{ $user->first_name }} {{ $user->middle_name }} {{ $user->suffix }}</li>
            <li class="sidebar-item {{ request()->is('student/home') ? 'active' : '' }}">
                <a href="{{ route('student-home') }}" class='sidebar-link'>
                    <i data-feather="calendar" width="20"></i> 
                    <span>Announcements</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->is('student/company') ? 'active' : '' }}">
                <a href="{{ route('student-company') }}" class='sidebar-link'>
                    <i data-feather="grid" width="20"></i> 
                    <span>Companies</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->is('student/account', 'student/change-password') ? 'active' : '' }} has-sub">
                <a href="" class='sidebar-link'>
                    <i data-feather="user" width="20"></i> 
                    <span>Account</span>
                </a>
                <ul class="submenu"> 
                    <li>
                        <a href="{{ route('student-account') }}">Account Information</a>
                    </li>
                    <li>
                        <a href="{{ route('student-change') }}">Change Password</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item {{ request()->is('student/ojt_info') ? 'active' : '' }}">
                <a href="{{ route('student-ojt') }}" class='sidebar-link'>
                    <i data-feather="briefcase" width="20"></i> 
                    <span>OJT Information</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->is('student/uploading/upload') ? 'active' : '' }}">
                <a href="{{ route('student-upload') }}" class='sidebar-link'>
                    <i data-feather="file" width="20"></i> 
                    <span>Files</span>
                </a> 
            </li>
            <li class="sidebar-item {{ request()->is('student/rooms/index') ? 'active' : '' }}">
                <a href="{{ route('student-rooms') }}" class='sidebar-link'>
                    <i data-feather="home" width="20"></i> 
                    <span>Class</span>
                </a>
            </li>
        </ul>
    </div>
    <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>