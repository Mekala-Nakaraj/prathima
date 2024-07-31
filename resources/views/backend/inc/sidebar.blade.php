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
                <li class="menu-title">Customer Management</li>
                <li class="menu {{ request()->is('CustomerManagement*') ? 'active' : '' }}">
                    <a href="{{ route('CustomerManagement') }}"
                        data-active="{{ request()->is('CustomerManagement*') ? 'true' : 'false' }}"
                        class="dropdown-toggle">
                        <div class="">
                            <i class="las la-user-plus"></i>
                            <span>Add Customer</span>
                        </div>
                    </a>
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
                <li class="menu-title">Manager Management</li>
                <li class="menu {{ request()->is('ManagerCreateShow*') ? 'active' : '' }}">
                    <a href="{{ route('ManagerCreateShow') }}"
                        data-active="{{ request()->is('ManagerCreateShow*') ? 'true' : 'false' }}"
                        class="dropdown-toggle">
                        <div class="">
                            <i class="las la-user-tie"></i>
                            <span>Add Manager</span>
                        </div>
                    </a>
                </li>
                <li class="menu {{ request()->is('ManagerShow*') ? 'active' : '' }}">
                    <a href="{{ route('ManagerShow') }}"
                        data-active="{{ request()->is('ManagerShow*') ? 'true' : 'false' }}" class="dropdown-toggle">
                        <div class="">
                            <i class="las la-users"></i>
                            <span>Manager List</span>
                        </div>
                    </a>
                </li>
                {{-- <li class="menu dropdown {{ request()->is('CustomerManagement*') ? 'active' : '' }}">
                    <a href="#RelationSubMenu" data-toggle="collapse"
                        aria-expanded="{{ request()->is('CustomerManagement*') ? 'true' : 'false' }}"
                        class="dropdown-toggle">
                        <div class="">
                            <i class="las la-user-friends"></i>
                            <span>Relation Manager</span>
                        </div>
                        <div>
                            <i class="las la-angle-right sidemenu-right-icon"></i>
                        </div>
                    </a>
                    <ul class="collapse list-unstyled submenu {{ request()->is('CustomerManagement*') ? 'show' : '' }}"
                        id="RelationSubMenu">
                        <li class="{{ request()->is('CustomerManagement*') ? 'active' : '' }}">
                            <a href="{{ route('dashboard') }}">Relation List</a>
                        </li>
                        <li class="{{ request()->is('CustomerManagement/AddCustomer*') ? 'active' : '' }}">
                            <a href="{{ route('dashboard') }}">Relation Manager 1</a>
                        </li>
                        <li class="{{ request()->is('CustomerManagement/EditCustomer*') ? 'active' : '' }}">
                            <a href="{{ route('dashboard') }}">Relation Manager 2</a>
                        </li>
                    </ul>
                </li>
                <li class="menu dropdown {{ request()->is('CustomerManagement*') ? 'active' : '' }}">
                    <a href="#FieldSubMenu" data-toggle="collapse"
                        aria-expanded="{{ request()->is('CustomerManagement*') ? 'true' : 'false' }}"
                        class="dropdown-toggle">
                        <div class="">
                            <i class="las la-user-cog"></i>
                            <span>Field Manager</span>
                        </div>
                        <div>
                            <i class="las la-angle-right sidemenu-right-icon"></i>
                        </div>
                    </a>
                    <ul class="collapse list-unstyled submenu {{ request()->is('CustomerManagement*') ? 'show' : '' }}"
                        id="FieldSubMenu">
                        <li class="{{ request()->is('CustomerManagement*') ? 'active' : '' }}">
                            <a href="{{ route('dashboard') }}">Field List</a>
                        </li>
                        <li class="{{ request()->is('CustomerManagement/AddCustomer*') ? 'active' : '' }}">
                            <a href="{{ route('dashboard') }}">Field Manager 1</a>
                        </li>
                        <li class="{{ request()->is('CustomerManagement/EditCustomer*') ? 'active' : '' }}">
                            <a href="{{ route('dashboard') }}">Field Manager 2</a>
                        </li>
                    </ul>
                </li>
                <li class="menu {{ request()->is('CustomerLoan*') ? 'active' : '' }}">
                    <a href="{{ route('CustomerLoan') }}"
                        data-active="{{ request()->is('CustomerLoan*') ? 'true' : 'false' }}"
                        class="dropdown-toggle">
                        <div class="">
                            <i class="las la-user-plus"></i>
                            <span>Customer Loan List</span>
                        </div>
                    </a>
                </li> --}}
                <li class="menu-title">Settings</li>
                <li class="menu {{ request()->is('settings.PaymentConf*') ? 'active' : '' }}">
                    <a href="{{ route('settings.PaymentConf') }}"
                        data-active="{{ request()->is('settings.PaymentConf*') ? 'true' : 'false' }}"
                        class="dropdown-toggle">
                        <div class="">
                            <i class="las la-cog"></i>
                            <span>Payment Setting</span>
                        </div>
                    </a>
                </li>

                <li class="menu {{ request()->is('settings.InitialLoanConfShow*') ? 'active' : '' }}">
                    <a href="{{ route('settings.InitialLoanConfShow') }}"
                        data-active="{{ request()->is('settings.InitialLoanConfShow*') ? 'true' : 'false' }}"
                        class="dropdown-toggle">
                        <div class="">
                            <i class="las la-cog"></i>
                            <span>Loan Setting</span>
                        </div>
                    </a>
                </li>
                <li class="menu {{ request()->is('settings.EmailConfShow*') ? 'active' : '' }}">
                    <a href="{{ route('settings.EmailConfShow') }}"
                        data-active="{{ request()->is('settings.EmailConfShow*') ? 'true' : 'false' }}"
                        class="dropdown-toggle">
                        <div class="">
                            <i class="las la-envelope"></i>
                            <span>Maill Conf</span>
                        </div>
                    </a>
                </li>
                <li class="menu {{ request()->is('settings.SMSConfShow*') ? 'active' : '' }}">
                    <a href="{{ route('settings.SMSConfShow') }}"
                        data-active="{{ request()->is('settings.SMSConfShow*') ? 'true' : 'false' }}"
                        {{-- data-active="{{ is_active_pattern('settings.SMSConfShow*', 'true') }}" --}} class="dropdown-toggle">
                        <div class="">
                            <i class="las la-sms"></i>
                            <span>SMS Conf</span>
                        </div>
                    </a>
                </li>
                <li class="menu {{ request()->is('settings.sanbox*') ? 'active' : '' }}">
                    <a href="{{ route('settings.sanbox') }}"
                        data-active="{{ request()->is('settings.sanbox*') ? 'true' : 'false' }}"
                        {{-- data-active="{{ is_active_pattern('settings.SMSConfShow*', 'true') }}" --}} class="dropdown-toggle">
                        <div class="">
                            <i class="las la-cog"></i>
                            <span>Sandbox</span>
                        </div>
                    </a>
                </li>
            @endif
            {{-- relation_manager --}}
            @if (Auth::user()->user_type == 'relation_manager')
                <li class="menu-title">Customer Management</li>
                <li class="menu {{ request()->is('Relation.RelationManagerCustomerKycShow*') ? 'active' : '' }}">
                    <a href="{{ route('Relation.RelationManagerCustomerKycShow') }}"
                        data-active="{{ request()->is('Relation.RelationManagerCustomerKycShow*') ? 'true' : 'false' }}"
                        class="dropdown-toggle">
                        <div class="">
                            <i class="las la-user-plus"></i>
                            <span>Customer Kyc</span>
                        </div>
                    </a>
                </li>
            @endif
            {{-- field_manager --}}
            @if (Auth::user()->user_type == 'field_manager')
                <li class="menu-title">Customer Management</li>
                <li class="menu {{ request()->is('field.FiledManagerCustomerKycShow*') ? 'active' : '' }}">
                    <a href="{{ route('field.FiledManagerCustomerKycShow') }}"
                        data-active="{{ request()->is('field.FiledManagerCustomerKycShow*') ? 'true' : 'false' }}"
                        class="dropdown-toggle">
                        <div class="">
                            <i class="las la-user-plus"></i>
                            <span>Customer Kyc</span>
                        </div>
                    </a>
                </li>
            @endif
        </ul>
    </nav>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    // Get current URL path
    const currentPath = window.location.pathname;

    // Define route to element ID mapping
    const routeToIdMapping = {
        '/dashboard': 'menu-dashboard',
        '/CustomerManagement': 'menu-CustomerManagement',
        '/CustomerKYC': 'menu-CustomerKYC',
        '/CustomerLoan': 'menu-CustomerLoan',
        '/ManagerCreateShow': 'menu-ManagerCreateShow',
        '/ManagerShow': 'menu-ManagerShow',
        '/settings.PaymentConf': 'menu-settings-PaymentConf',
        '/settings.InitialLoanConfShow': 'menu-settings-InitialLoanConfShow',
        '/settings.EmailConfShow': 'menu-settings-EmailConfShow',
        '/settings.SMSConfShow': 'menu-settings-SMSConfShow',
        '/Relation.RelationManagerCustomerKycShow': 'menu-RelationManagerCustomerKycShow',
        '/field.FiledManagerCustomerKycShow': 'menu-FiledManagerCustomerKycShow'
    };

    // Remove active class from all menu items
    document.querySelectorAll('.menu').forEach(function (menuItem) {
        menuItem.classList.remove('active');
    });

    // Add active class to the current menu item
    const currentMenuItemId = routeToIdMapping[currentPath];
    if (currentMenuItemId) {
        document.getElementById(currentMenuItemId).classList.add('active');
    }
});

</script>
