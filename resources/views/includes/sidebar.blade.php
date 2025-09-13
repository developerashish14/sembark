<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div class="toggle-icon ms-auto">
    </div>
</div>
        @php
            $usr = Auth::guard('users')->user();
            
        @endphp
    <ul class="metismenu" id="menu">
       
        <li class="{{ (Route::is('dashboard')) ? 'sidebarActiveLink' : '' }}">
            <a href="{{ route('dashboard') }}">
                <div class="parent-icon"><i class='bx bx-home-alt'></i>
                </div>
                <div class="menu-title">Url Shortner</div>
            </a>
        </li>
        
        @if ($usr->role == 'superadmin')
        <li class="{{ (Route::is('client')) ? 'sidebarActiveLink' : '' }}">
            <a href="{{ route('client') }}">
                <div class="parent-icon"><i class='bx bx-home-alt'></i>
                </div>
                <div class="menu-title">Client</div>
            </a>
        </li>
        @endif
        @if ($usr->role == 'admin')
        <li class="{{ (Route::is('team-member')) ? 'sidebarActiveLink' : '' }}">
            <a href="{{ route('team-member') }}">
                <div class="parent-icon"><i class='bx bx-home-alt'></i>
                </div>
                <div class="menu-title">Team Member</div>
            </a>
        </li>
        @endif
       

        <li>
            <a href="{{ route('logout') }}">
                <div class="parent-icon"><i class='bx bx-log-out-circle'></i>
                </div>
                <div class="menu-title">logout</div>
            </a>
        </li>

        
       
    </ul>
</div>