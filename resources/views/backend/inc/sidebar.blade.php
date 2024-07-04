{{-- Side bar --}}
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
                <li class="menu-title">Customer Management</li>
                <li class="menu {{ request()->is('CustomerManagement*') ? 'active' : '' }}">
                    <a href="{{ route('CustomerManagement') }}"
                        data-active="{{ request()->is('CustomerManagement*') ? 'true' : 'false' }}"
                        class="dropdown-toggle">
                        <div class="">
                            <i class="las la-user-plus"></i>
                            <span>Customer</span>
                        </div>
                    </a>
                </li>
                <li class="menu {{ request()->is('CustomerKYC*') ? 'active' : '' }}">
                    <a href="{{ route('CustomerKYC') }}"
                        data-active="{{ request()->is('CustomerKYC*') ? 'true' : 'false' }}" class="dropdown-toggle">
                        <div class="">
                            <i class="las la-user-plus"></i>
                            <span>Customer KYC</span>
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
