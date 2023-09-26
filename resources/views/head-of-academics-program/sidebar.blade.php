<div id="sidebar" class='active'>
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
        <img src="{{ asset('assets/images/ojtis-logo1.png') }}" alt="" srcset="">
        </div>
        <div class="sidebar-menu">
        <ul class="menu">        
            <li class='sidebar-title'>{{ $user->last_name }}, {{ $user->first_name }} {{ $user->middle_name }} {{ $user->suffix }}</li>
            <li class="sidebar-item {{ request()->is('headofacademicsprogram/account', 'headofacademicsprogram/change-password') ? 'active' : '' }} has-sub">
                <a href="" class='sidebar-link'>
                    <i data-feather="user" width="20"></i> 
                    <span>Account</span>
                </a>
                <ul class="submenu"> 
                    <li>
                        <a href="{{ route('headofacadsprog-account') }}">Account Information</a>
                    </li>
                    <li>
                        <a href="{{ route('headofacadsprog-change') }}">Change Password</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item {{ request()->is('headofacademicsprogram/home', 'headofacademicsprogram/approved-letters', 'headofacademicsprogram/disapproved-letters') ? 'active' : '' }} has-sub">
                <a href="#" class='sidebar-link'>
                    <i data-feather="file-text" width="20"></i> 
                    <span>Recomendation Letter</span>
                </a> 
                <ul class="submenu"> 
                    <li>
                        <a href="{{ route('headofacadsprog-home') }}">Pending Recommendation Letter</a>
                    </li>
                    <li>
                        <a href="{{ route('headofacadsprog-approved') }}">Approved Recommendation Letter</a>
                    </li>
                    <li>
                        <a href="{{ route('headofacadsprog-disapproved') }}">Denied Recommendation Letter</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>