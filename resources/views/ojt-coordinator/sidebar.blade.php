<div id="sidebar" class='active'>
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
        <img src="{{ asset('assets/images/ojtis-logo2.png') }}" alt="" srcset="">
        </div>
        <div class="sidebar-menu">
        <ul class="menu">        
            <li class='sidebar-title'>{{ $user->last_name }} {{ $user->first_name }} {{ $user->middle_name }} {{ $user->suffix }}</li>
            <li class="sidebar-item {{ request()->is('ojt-coordinator/home') ? 'active' : '' }}">
                <a href="{{ route('ojt-coordinator-home') }}" class='sidebar-link'>
                    <i data-feather="home" width="20"></i> 
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->is('ojt-coordinator/account', 'ojt-coordinator/change-password') ? 'active' : '' }} has-sub">
                <a href="" class='sidebar-link'>
                    <i data-feather="user" width="20"></i> 
                    <span>Account</span>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="{{ route('ojt-coordinator-account') }}">Account Information</a>
                    </li>
                    <li>
                        <a href="{{ route('ojt-coordinator-change') }}">Change Password</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item {{ request()->is('ojt-coordinator/students') ? 'active' : '' }}">
                <a href="{{ route('ojt-coordinator-student') }}" class='sidebar-link'>
                    <i data-feather="users" width="20"></i> 
                    <span>Students</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->is('ojt-coordinator/advisers') ? 'active' : '' }}">
                <a href="{{ route('ojt-coordinator-adviser') }}" class='sidebar-link'>
                    <i data-feather="users" width="20"></i> 
                    <span>Advisers</span>
                </a>
            </li>
            <li class="sidebar-item {{ request()->is('ojt-coordinator/student-files/view-student-file') ? 'active' : '' }}">
                <a href="{{ route('students-file') }}" class='sidebar-link'>
                    <i data-feather="file" width="20"></i> 
                    <span>Overall Students' Files</span>
                </a>
            </li>
            {{-- <li class="sidebar-item {{ request()->is('ojt-coordinator/downloadable') ? 'active' : '' }}">
                <a href="{{ route('ojt-coordinator-downloadable') }}" class='sidebar-link'>
                    <i data-feather="download" width="20"></i> 
                    <span>Upload Downloadable</span>
                </a>
            </li> --}}
            <li class="sidebar-item {{ request()->is('ojt-coordinator/student-files/pending-moa', 'ojt-coordinator/student-files/approved-moa', 'ojt-coordinator/student-files/disapproved-moa') ? 'active' : '' }} has-sub">
                <a href="#" class='sidebar-link'>
                    <i data-feather="file-text" width="20"></i> 
                    <span>Memorandum of Agreement</span>
                </a> 
                <ul class="submenu"> 
                    <li>
                        <a href="{{ route('pending-moa') }}">Pending</a>
                    </li>
                    <li>
                        <a href="{{ route('readied-moa') }}">Pending for Signature</a>
                    </li>
                    <li>
                        <a href="{{ route('approved-moa') }}">Approved</a>
                    </li>
                    {{-- <li>
                        <a href="{{ route('disapproved-moa') }}">Denied</a>
                    </li> --}}
                </ul>
            </li>
            <li class="sidebar-item {{ request()->is('ojt-coordinator/company') ? 'active' : '' }}">
                <a href="{{ route('ojt-coordinator-company') }}" class='sidebar-link'>
                    <i data-feather="grid" width="20"></i> 
                    <span>Companies</span>
                </a>
            </li>
        </ul>
    </div>
    <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>