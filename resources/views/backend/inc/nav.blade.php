{{-- Header --}}
<div class="header-container fixed-top">
    <header class="header navbar navbar-expand-sm">
        <ul class="navbar-item theme-brand flex-row  text-center">
            <li class="nav-item">
                <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom">
                    <i class="las la-bars"></i>
                </a>
            </li>
        </ul>
        <ul class="navbar-item flex-row ml-md-0 ml-auto">
            <li class="nav-item align-self-center search-animated">
                <i class="las la-search toggle-search"></i>
                <form class="form-inline search-full form-inline search" action="pages_search_result.html"
                    role="search">
                    <div class="search-bar">
                        <input type="text" class="form-control search-form-control  ml-lg-auto"
                            placeholder="Search here">
                    </div>
                </form>
            </li>
            <!-- <li class="nav-item dropdown megamenu-dropdown d-none d-lg-flex">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle d-flex align-center text-primary"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Mega Menu <i class="las la-angle-down font-11 ml-1"></i>
                </a>
                <div class="dropdown-menu megamenu">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="font-17 mt-0">Applications</h5>
                                    <ul class="list-unstyled megamenu-list">
                                        <li class="font-15 mb-1"><a href="apps_ecommerce.html">Ecommerce</a></li>
                                        <li class="font-15 mb-1"><a href="apps_chat.html">Chat</a></li>
                                        <li class="font-15 mb-1"><a href="apps_mail.html">Email</a></li>
                                        <li class="font-15 mb-1"><a href="apps_file_manager.html">File Manager</a></li>
                                        <li class="font-15 mb-1"><a href="apps_calendar.html">Calender</a></li>
                                        <li class="font-15 mb-1"><a href="apps_notes.html">Notes</a></li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="font-17 mt-0">Extra Pages</h5>
                                    <ul class="list-unstyled megamenu-list">
                                        <li class="font-15 mb-1"><a href="pages_contact_us.html">Contact Us</a></li>
                                        <li class="font-15 mb-1"><a href="pages_faq.html">FAQ</a></li>
                                        <li class="font-15 mb-1"><a href="pages_helpdesk.html">Helpdesk</a></li>
                                        <li class="font-15 mb-1"><a href="pages_pricing_2.html">Pricing</a></li>
                                        <li class="font-15 mb-1"><a href="pages_search_result.html">Search Result</a>
                                        </li>
                                        <li class="font-15 mb-1"><a href="pages_privacy_policy.html">Privacy Policy</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="p-lg-1">
                                <div class="row no-gutters">
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="assets/img/company-1.jpg" alt="slack">
                                            <span>Cube</span>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="assets/img/company-2.jpg" alt="Github">
                                            <span>HTech</span>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="assets/img/company-3.jpg" alt="dribbble">
                                            <span>Inovation</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="row no-gutters">
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="assets/img/company-4.jpg" alt="bitbucket">
                                            <span>Circle</span>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="assets/img/company-5.jpg" alt="dropbox">
                                            <span>Techno</span>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="assets/img/company-6.jpg" alt="G Suite">
                                            <span>T Logy</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li> -->
        </ul>
        <ul class="navbar-item flex-row ml-md-auto">
            <li class="nav-item dropdown fullscreen-dropdown d-none d-lg-flex">
                <a class="nav-link full-screen-mode" href="javascript:void(0);">
                    <i class="las la-compress" id="fullScreenIcon"></i>
                </a>
            </li>
            <li class="nav-item dropdown language-dropdown">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="language-dropdown"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="las la-language"></i>
                </a>
                <div class="dropdown-menu position-absolute" aria-labelledby="language-dropdown">
                    <a class="dropdown-item d-flex" href="javascript:void(0);">
                        <img src="assets/img/flag/usa-flag.png" class="flag-width" alt="flag">
                        <span class="align-self-center">&nbsp;English</span>
                    </a>
                    <a class="dropdown-item d-flex" href="javascript:void(0);">
                        <img src="assets/img/flag/spain-flag.png" class="flag-width" alt="flag">
                        <span class="align-self-center">&nbsp;Spanish</span>
                    </a>
                    <a class="dropdown-item d-flex" href="javascript:void(0);">
                        <img src="assets/img/flag/france-flag.png" class="flag-width" alt="flag">
                        <span class="align-self-center">&nbsp;French</span>
                    </a>
                    <a class="dropdown-item d-flex" href="javascript:void(0);">
                        <img src="assets/img/flag/saudi-arabia-flag.png" class="flag-width" alt="flag">
                        <span class="align-self-center">&nbsp;Arabic</span>
                    </a>
                </div>
            </li>
            <li class="nav-item dropdown message-dropdown">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="messageDropdown"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="las la-envelope"></i>
                </a>
                <div class="dropdown-menu position-absolute" aria-labelledby="messageDropdown">
                    <div class="nav-drop is-notification-dropdown">
                        <div class="inner">
                            <div class="nav-drop-header">
                                <span class="text-black font-12 strong">3 new mails</span>
                                <a class="text-muted font-12" href="#">
                                    Mark all read
                                </a>
                            </div>
                            <div class="nav-drop-body account-items pb-0">
                                <a class="account-item">
                                    <div class="media">
                                        <div class="user-img">
                                            <img class="rounded-circle avatar-xs" src="assets/img/profile-11.jpg"
                                                alt="profile">
                                        </div>
                                        <div class="media-body">
                                            <div class="">
                                                <h6 class="text-primary font-13 mb-0 strong">Jennifer Queen</h6>
                                                <p class="m-0 mt-1 font-10 text-muted">Permission Required</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a class="account-item marked-read">
                                    <div class="media">
                                        <div class="user-img">
                                            <img class="rounded-circle avatar-xs" src="assets/img/profile-10.jpg"
                                                alt="profile">
                                        </div>
                                        <div class="media-body">
                                            <div class="">
                                                <h6 class="text-primary font-13 mb-0 strong">Lara Smith</h6>
                                                <p class="m-0 mt-1 font-10 text-muted">Invoice needed</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <a class="account-item marked-read">
                                    <div class="media">
                                        <div class="user-img">
                                            <img class="rounded-circle avatar-xs" src="assets/img/profile-9.jpg"
                                                alt="profile">
                                        </div>
                                        <div class="media-body">
                                            <div class="">
                                                <h6 class="text-primary font-13 mb-0 strong">Victoria Williamson</h6>
                                                <p class="m-0 mt-1 font-10 text-muted">Account need to be synced</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <hr class="account-divider">
                                <div class="text-center">
                                    <a class="text-primary strong font-13" href="apps_mail.html">View All</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown notification-dropdown">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle position-relative"
                    id="notificationDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="las la-bell"></i>
                    <div class="blink">
                        <div class="circle"></div>
                    </div>
                </a>
                <div class="dropdown-menu position-absolute" aria-labelledby="notificationDropdown">
                    <div class="nav-drop is-notification-dropdown">
                        <div class="inner">
                            <div class="nav-drop-header">
                                <span class="text-black font-12 strong">5 Notifications</span>
                                <a class="text-muted font-12" href="#">
                                    Clear All
                                </a>
                            </div>
                            <div class="nav-drop-body account-items pb-0">
                                <a class="account-item" href="apps_ecommerce_orders.html">
                                    <div class="media align-center">
                                        <div class="icon-wrap">
                                            <i class="las la-box font-20"></i>
                                        </div>
                                        <div class="media-content ml-3">
                                            <h6 class="font-13 mb-0 strong">2 New orders placed</h6>
                                            <p class="m-0 mt-1 font-10 text-muted">10 sec ago</p>
                                        </div>
                                    </div>
                                </a>
                                <a class="account-item" href="javascript:void(0)">
                                    <div class="media align-center">
                                        <div class="icon-wrap">
                                            <i class="las la-user-plus font-20"></i>
                                        </div>
                                        <div class="media-content ml-3">
                                            <h6 class="font-13 mb-0 strong">New User registered</h6>
                                            <p class="m-0 mt-1 font-10 text-muted">5 minute ago</p>
                                        </div>
                                    </div>
                                </a>
                                <a class="account-item" href="apps_tickets.html">
                                    <div class="media align-center">
                                        <div class="icon-wrap">
                                            <i class="las la-grin-beam font-20"></i>
                                        </div>
                                        <div class="media-content ml-3">
                                            <h6 class="font-13 mb-0 strong">21 Queries solved</h6>
                                            <p class="m-0 mt-1 font-10 text-muted">1 hour ago</p>
                                        </div>
                                    </div>
                                </a>
                                <a class="account-item" href="javascript:void(0)">
                                    <div class="media align-center">
                                        <div class="icon-wrap">
                                            <i class="las la-cloud-download-alt font-20"></i>
                                        </div>
                                        <div class="media-content ml-3">
                                            <h6 class="font-13 mb-0 strong">New update available</h6>
                                            <p class="m-0 mt-1 font-10 text-muted">1 day ago</p>
                                        </div>
                                    </div>
                                </a>
                                <hr class="account-divider">
                                <div class="text-center">
                                    <a class="text-primary strong font-13" href="pages_notifications.html">View
                                        All</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown user-profile-dropdown">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    {{-- <img src="assets/img/profile-16.jpg" alt="avatar"> --}}
                    <i class="las la-user font-24 " style=" font-size: 20px;  color: #f12020de;"></i>
                    @if (auth()->check())
                        <span class="text-primary font-12">{{ auth()->user()->name }} <i
                                class="las la-angle-down"></i></span>
                    @endif
                </a>
                <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
                    <div class="nav-drop is-account-dropdown">
                        <div class="inner">
                            <div class="nav-drop-header">
                                @if (auth()->check())
                                    <span class="text-primary font-15">Welcome {{ auth()->user()->name }}!</span>
                                @endif
                            </div>
                            <div class="nav-drop-body account-items pb-0">
                                <a id="profile-link" class="account-item" href="{{ route('ProfileShow') }}">
                                    <div class="media align-center">
                                        <div class="media-left">
                                            <div class="image">
                                                {{-- <img class="rounded-circle avatar-xs" src="assets/img/profile-16.jpg"
                                                    alt=""> --}}
                                                <i class="las la-user font-20"></i>
                                            </div>
                                        </div>
                                        <div class="media-content ml-3">
                                            @if (auth()->check())
                                                <h6 class="font-13 mb-0 strong">{{ auth()->user()->name }}</h6>
                                                <small>{{ auth()->user()->name }}</small>
                                            @endif
                                        </div>
                                        <div class="media-right">
                                            <i data-feather="check"></i>
                                        </div>
                                    </div>
                                </a>
                                <a class="account-item" href="{{ route('ProfileShow') }}">
                                    <div class="media align-center">
                                        <div class="icon-wrap">
                                            <i class="las la-user font-20"></i>
                                        </div>
                                        <div class="media-content ml-3">
                                            <h6 class="font-13 mb-0 strong">My KYC</h6>
                                        </div>
                                    </div>
                                </a>
                                <a class="account-item" href="pages_timeline.html">
                                    <div class="media align-center">
                                        <div class="icon-wrap">
                                            <i class="las la-briefcase font-20"></i>
                                        </div>
                                        <div class="media-content ml-3">
                                            <h6 class="font-13 mb-0 strong">My Activity</h6>
                                        </div>
                                    </div>
                                </a>
                                <a class="account-item settings">
                                    <div class="media align-center">
                                        <div class="icon-wrap">
                                            <i class="las la-cog font-20"></i>
                                        </div>
                                        <div class="media-content ml-3">
                                            <h6 class="font-13 mb-0 strong">Settings</h6>
                                        </div>
                                    </div>
                                </a>
                                <a class="account-item" href="auth_lock_screen_3.html">
                                    <div class="media align-center">
                                        <div class="icon-wrap">
                                            <i class="las la-lock font-20"></i>
                                        </div>
                                        <div class="media-content ml-3">
                                            <h6 class="font-13 mb-0 strong">Lock Screen</h6>
                                        </div>
                                    </div>
                                </a>
                                <hr class="account-divider">
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                                <a class="account-item" href="#"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <div class="media align-center">
                                        <div class="icon-wrap">
                                            <i class="las la-sign-out-alt font-20"></i>
                                        </div>
                                        <div class="media-content ml-3">
                                            <h6 class="font-13 mb-0 strong">Logout</h6>
                                        </div>
                                    </div>
                                </a>
                                {{-- <a class="account-item" href="auth_login_3.html">
                                    <div class="media align-center">
                                        <div class="icon-wrap">
                                            <i class="las la-sign-out-alt font-20"></i>
                                        </div>
                                        <div class="media-content ml-3">
                                            <h6 class="font-13 mb-0 strong ">Logout</h6>
                                        </div>
                                    </div>
                                </a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
        <ul class="navbar-item flex-row">
            <li class="nav-item dropdown header-setting">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle rightbarCollapse"
                    data-placement="bottom">
                    <i class="las la-sliders-h"></i>
                </a>
            </li>
        </ul>
    </header>
</div>
