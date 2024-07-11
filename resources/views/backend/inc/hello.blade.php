{{-- Sidebar --}}
<div class="sidebar-wrapper sidebar-theme">
    <nav id="sidebar">
        <ul class="navbar-item theme-brand flex-row text-center">
            <li class="nav-item theme-logo">
                <a href="{{ route('dashboard') }}">
                    {{-- <img src="{{ asset('backend/assets/img/logo.png') }}" class="navbar-logo" alt="logo"> --}}
                </a>
            </li>
            <li class="nav-item theme-text">
                <a href="{{ route('dashboard') }}"
                    class="nav-link {{ request()->is('dashboard*') ? 'active' : '' }}">Loan</a>
            </li>
        </ul>
        <ul class="list-unstyled menu-categories" id="accordionExample">
            <li class="menu {{ request()->is('dashboard*') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}" data-active="{{ request()->is('dashboard*') ? 'true' : 'false' }}"
                    aria-expanded="{{ request()->is('dashboard*') ? 'true' : 'false' }}" class="dropdown-toggle">
                    <div class="">
                        <i class="las la-home"></i>
                        <span>Dashboard</span>
                    </div>
                </a>
            </li>
            @if (Auth::user()->user_type == 'admin')
                <li class="menu dropdown {{ request()->is('RoleManagement*') ? 'active' : '' }}">
                    <a href="#roleManagementSubMenu" data-toggle="collapse" aria-expanded="{{ request()->is('RoleManagement*') ? 'true' : 'false' }}"
                        class="dropdown-toggle">
                        <div class="">
                            <i class="las la-users"></i>
                            <span>Role Management</span>
                        </div>
                    </a>
                    <ul class="collapse list-unstyled submenu {{ request()->is('RoleManagement*') ? 'show' : '' }}" id="roleManagementSubMenu">
                        <li class="{{ request()->is('RoleManagement/AddManager*') ? 'active' : '' }}">
                            <a href="{{ route('dashboard') }}">Add Manager</a>
                        </li>
                        <li class="{{ request()->is('RoleManagement/ListManager*') ? 'active' : '' }}">
                            <a href="{{ route('dashboard') }}">List Manager</a>
                        </li>
                        <li class="{{ request()->is('RoleManagement/AddRealationManager*') ? 'active' : '' }}">
                            <a href="{{ route('dashboard') }}">Add Realation Manager</a>
                        </li>
                        <li class="{{ request()->is('RoleManagement/ListRealationManager*') ? 'active' : '' }}">
                            <a href="{{ route('dashboard') }}">List Realation Manager</a>
                        </li>
                    </ul>
                </li>
                <li class="menu dropdown {{ request()->is('CustomerManagement*') ? 'active' : '' }}">
                    <a href="#customerSubMenu" data-toggle="collapse" aria-expanded="{{ request()->is('CustomerManagement*') ? 'true' : 'false' }}"
                        class="dropdown-toggle">
                        <div class="">
                            <i class="las la-user-plus"></i>
                            <span>Customer</span>
                        </div>
                        <div>
                            <i class="las la-angle-right sidemenu-right-icon"></i>
                        </div>
                    </a>
                    <ul class="collapse list-unstyled submenu {{ request()->is('CustomerManagement*') ? 'show' : '' }}" id="customerSubMenu">
                        <li class="{{ request()->is('CustomerManagement*') ? 'active' : '' }}">
                            <a href="{{ route('dashboard') }}">Customer List</a>
                        </li>
                        <li class="{{ request()->is('CustomerManagement/AddCustomer*') ? 'active' : '' }}">
                            <a href="{{ route('dashboard') }}">Add Customer</a>
                        </li>
                        <li class="{{ request()->is('CustomerManagement/EditCustomer*') ? 'active' : '' }}">
                            <a href="{{ route('dashboard') }}">Edit Customer</a>
                        </li>
                    </ul>
                </li>
                <li class="menu {{ request()->is('CustomerKYC*') ? 'active' : '' }}">
                    <a href="{{ route('CustomerKYC') }}"
                        data-active="{{ request()->is('CustomerKYC*') ? 'true' : 'false' }}" class="dropdown-toggle">
                        <div class="">
                            <i class="las la-user-check"></i>
                            <span>Customer KYC</span>
                        </div>
                    </a>
                </li>
                <li class="menu {{ request()->is('CustomerLoan*') ? 'active' : '' }}">
                    <a href="{{ route('CustomerLoan') }}"
                        data-active="{{ request()->is('CustomerLoan*') ? 'true' : 'false' }}" class="dropdown-toggle">
                        <div class="">
                            <i class="las la-money-check"></i>
                            <span>Customer Loan List</span>
                        </div>
                    </a>
                </li>
            @endif
            {{-- User --}}
            @if (Auth::user()->user_type == 'user')
            @endif
        </ul>
    </nav>
</div>
