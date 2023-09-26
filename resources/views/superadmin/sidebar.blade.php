<div id="sidebar" class='active'>
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
        <img src="{{ asset('assets/images/ojtis-logo2.png') }}" srcset="">
        </div>
        <div class="sidebar-menu">
        <ul class="menu">        
            <li class='sidebar-title'>{{ $user->last_name }} {{ $user->first_name }} {{ $user->middle_name }} {{ $user->suffix }}</li>
            <li class="sidebar-item {{ request()->is('superadmin/home') ? 'active' : '' }}">
                <a href="{{ route('superadmin-home') }}" class='sidebar-link'>
                    <i data-feather="home" width="20"></i> 
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item  {{ request()->is('superadmin/usermanagement/users') ? 'active' : '' }}">
                <a href="{{ route('superadmin-users') }}" class='sidebar-link'>
                    <i data-feather="user" width="20"></i> 
                    <span>User Accounts</span>
                </a>
            </li>
            {{-- <li class="sidebar-item  {{ request()->is('superadmin/account-verifications') ? 'active' : '' }}">
                <a href="{{ route('superadmin-account-verification') }}" class='sidebar-link'>
                    <i data-feather="user-check" width="20"></i> 
                    <span>Account Verfication</span>
                </a>
            </li> --}}
            <li class="sidebar-item  has-sub">
                <a href="#" class='sidebar-link'>
                    <i data-feather="briefcase" width="20"></i> 
                    <span>Maintenance</span>
                </a>
                <ul class="submenu ">
                    <li>
                        <a href="{{ route('superadmin-courses') }}">Courses</a>
                    </li>
                    <li>
                        <a href="{{ route('superadmin-categories') }}">File Categories</a>
                    </li>
                </ul>
            </li>
           
        </ul>
    </div>
    <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>