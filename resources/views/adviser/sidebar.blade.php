<div id="sidebar" class='active' >
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
        <img src="{{ asset('assets/images/ojtis-logo2.png') }}" alt="" srcset="">
        </div>
        <div class="sidebar-menu">
        <ul class="menu">        
            <li class='sidebar-title'>{{ $user->last_name }} {{ $user->first_name }} {{ $user->middle_name }} {{ $user->suffix }}</li>
            <li class="sidebar-item {{ request()->is('adviser/home') ? 'active' : '' }}">
                <a href="{{ route('adviser-home') }}" class='sidebar-link'>
                    <i data-feather="home" width="20"></i> 
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->is('adviser/account', 'adviser/change-password') ? 'active' : '' }} has-sub">
                <a href="" class='sidebar-link'>
                    <i data-feather="user" width="20"></i> 
                    <span>Account</span>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="{{ route('adviser-account') }}">Account Information</a>
                    </li>
                    <li>
                        <a href="{{ route('adviser-change') }}">Change Password</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item {{ request()->is('adviser/students', 'adviser/student-approval') ? 'active' : '' }} has-sub">
                <a href="" class='sidebar-link'>
                    <i data-feather="users" width="20"></i> 
                    <span>Students</span>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="{{ route('adviser-student') }}">Students</a>
                    </li>
                    <li>
                        <a href="{{ route('adviser-student-pending') }}">Account Approval</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item {{ request()->is('adviser/student-files/view-student-file') ? 'active' : '' }}">
                <a href="{{ route('adviser-students-file') }}" class='sidebar-link'>
                    <i data-feather="file" width="20"></i> 
                    <span>Overall Students' Files</span>
                </a>
            </li>
            {{-- <li class="sidebar-item {{ request()->is('adviser/company') ? 'active' : '' }}">
                <a href="{{ route('adviser-company') }}" class='sidebar-link'>
                    <i data-feather="grid" width="20"></i> 
                    <span>Companies</span>
                </a>
            </li> --}}
            <li class="sidebar-item {{ request()->is('adviser/announcements') ? 'active' : '' }}">
                <a href="{{ route('adviser-announcements') }}" class='sidebar-link'>
                    <i data-feather="calendar" width="20"></i> 
                    <span>Announcemnents</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->is('adviser/rooms', 'adviser/room/student-approval') ? 'active' : '' }} has-sub">
                <a href="" class='sidebar-link'>
                    <i data-feather="box" width="20"></i> 
                    <span>Class</span>
                </a>
                <ul class="submenu "> 
                   
                    <li>
                        <a href="{{ route('adviser-room') }}">Class List</a>
                    </li>
                    <li>
                        <a href="{{ route('adviser-studentApproval') }}">Student Approval</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item {{ request()->is('adviser/home/pending/moa','adviser/home/pending/letter') ? 'active' : ''}}">
                <a href="{{ route('adviser-moa') }}" class='sidebar-link'>
                    <i data-feather="loader" width="20"></i> 
                    <span>Approval</span>
                </a> 
            </li>
            <li class="sidebar-item {{ request()->is('adviser/home/pending/sign') ? 'active' : ''}}">
                <a href="{{ route('adviser-sign') }}" class='sidebar-link'>
                    <i data-feather="loader" width="20"></i> 
                    <span>Pending for Signature</span>
                </a> 
            </li>
            <li class="sidebar-item {{ request()->is('adviser/home/approved/moa','adviser/home/approved/letter') ? 'active' : ''}}">
                <a href="{{ route('adviser-moa-approved') }}" class='sidebar-link'>
                    <i data-feather="check" width="20"></i> 
                    <span>Approved Files</span>
                </a> 
            </li>
            {{-- <li class="sidebar-item {{ request()->is('adviser/home/denied/moa','adviser/home/denied/letter') ? 'active' : ''}}">
                <a href="{{ route('adviser-moa-denied') }}" class='sidebar-link'>
                    <i data-feather="x" width="20"></i> 
                    <span>Denied Files</span>
                </a> 
            </li> --}}
          
    </div>
    <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>