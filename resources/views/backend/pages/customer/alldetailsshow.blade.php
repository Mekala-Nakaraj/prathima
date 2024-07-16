@extends('backend.layout.app')
@section('title', 'Loan Details')
@section('css')
    <link href="{{ asset('backend/assets/css/loader.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/plugins/dropify/dropify.min.css') }}">
    <link href="{{ asset('backend/assets/css/pages/profile_edit.css" rel="stylesheet" type="text/css') }}" />
    <link href="{{ asset('backend/assets/css/loader.css" rel="stylesheet" type="text/css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/ui-elements/alert.css') }}">
@endsection


@section('navbar')
    <style>
        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            background: #ac0d0d;
        }

        .text-muted {
            color: red !important;
        }
    </style>
    <div class="sub-header-container">
        <header class="header navbar navbar-expand-sm">
            <ul class="navbar-nav flex-row">
                <li>
                    <div class="page-header">
                        <nav class="breadcrumb-one" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Admin</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span>Loan Details</span></li>
                            </ol>
                        </nav>
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav d-flex align-center ml-auto right-side-filter">
                <li class="nav-item more-dropdown">
                    <div class="input-group input-group-sm">
                        <input id="rangeCalendarFlatpickr" class="form-control flatpickr flatpickr-input active"
                            type="text" placeholder="Select Date">
                        <div class="input-group-append">
                            <span class="input-group-text bg-dark border-primary" id="basic-addon2">
                                <i class="lar la-calendar"></i>
                            </span>
                        </div>
                    </div>
                </li>
                <li class="nav-item more-dropdown">
                    <a href="javascript: void(0);" data-original-title="Reload Data" data-placement="bottom"
                        class="btn btn-primary dash-btn btn-sm ml-2 bs-tooltip">
                        <i class="las la-sync"></i>
                    </a>
                </li>
                <li class="nav-item custom-dropdown-icon">
                    <a href="javascript: void(0);" data-original-title="Filter" data-placement="bottom" id="customDropdown"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                        class="btn btn-primary dash-btn btn-sm ml-2 bs-tooltip">
                        <i class="las la-filter"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="customDropdown">
                        <a class="dropdown-item" data-value="Filter 1" href="javascript:void(0);">Filter 1</a>
                        <a class="dropdown-item" data-value="Filter 2" href="javascript:void(0);">Filter 2</a>
                        <a class="dropdown-item" data-value="Filter 3" href="javascript:void(0);">Filter 3</a>
                    </div>
                </li>
            </ul>
        </header>
    </div>
@endsection

@section('content')
    <div class="layout-px-spacing">
        <div class="account-settings-container layout-top-spacing">
            <div class="account-content">
                <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                    <div class="row">
                        <div class="col-12">
                            @if (session('success'))
                                <div class="alert alert-success mt-3">
                                    {{ session('success') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="widget widget-chart-one">
                                <div class="widget-content">
                                    <div class="agent-info text-center">
                                        <div class="agent-img pb-3">
                                            {{-- Display a default profile image or icon --}}
                                            <style>
                                                .user-profile-icon {
                                                    font-size: 10rem;
                                                }
                                            </style>
                                            <i class="las la-user user-profile-icon font-20 img-thumbnail rounded-circle"></i>
                                        </div>
                                        <h6 class="text-muted text-start">Personal Information</h6>
                                        <p class="text-start"><strong>Full Name:</strong> {{ $userLoan->user->name }}</p>
                                        <p class="text-start"><strong>Email:</strong> {{ $userLoan->user->email }}</p>
                                        <p class="text-start"><strong>Phone Number:</strong> {{ $userLoan->user->phone_number }}</p>
                                        <p class="text-start"><strong>Pincode:</strong> {{ $userLoan->user->pincode }}</p>
                                        <p class="text-start"><strong>City:</strong> {{ $userLoan->user->city }}</p>
                                        <p class="text-start"><strong>State:</strong> {{ $userLoan->user->state }}</p>
                                        <p class="text-start"><strong>Country:</strong> {{ $userLoan->user->country }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="widget widget-chart-one">
                                <div class="widget-content">
                                    <div class="agent-info text-center">
                                        <h6 class="text-muted text-start">KYC Information</h6>
                                        <p class="text-start"><strong>PAN Number:</strong> {{ $userLoan->userKyc->pan_number ?? 'NA' }}</p>
                                        <p class="text-start"><strong>Relationship Manager Verified:</strong>
                                            @if ($userLoan->userKyc)
                                                @if ($userLoan->userKyc->relationship_manager_verified == 1)
                                                    <span class="badge badge-success">Approved</span>
                                                @elseif ($userLoan->userKyc->relationship_manager_verified == 0 && $userLoan->userKyc->is_verified == 0)
                                                    <span class="badge badge-danger">Rejected</span>
                                                @else
                                                    <span class="badge badge-warning">Processing...</span>
                                                @endif
                                            @else
                                                <span class="badge badge-warning">Processing...</span>
                                            @endif
                                        </p>
                                        <p class="text-start"><strong>Field Manager Verified:</strong>
                                            @if ($userLoan->userKyc)
                                                @if ($userLoan->userKyc->field_manager_verified == 1)
                                                    <span class="badge badge-success">Approved</span>
                                                @elseif ($userLoan->userKyc->field_manager_verified == 0 && $userLoan->userKyc->is_verified == 0)
                                                    <span class="badge badge-danger">Rejected</span>
                                                @else
                                                    <span class="badge badge-warning">Processing...</span>
                                                @endif
                                            @else
                                                <span class="badge badge-warning">Processing...</span>
                                            @endif
                                        </p>
                                        <p class="text-start"><strong>KYC Status:</strong>
                                            @if ($userLoan->userKyc)
                                                @if ($userLoan->userKyc->is_verified == 1)
                                                    <span class="badge badge-success">Approved</span>
                                                @elseif ($userLoan->userKyc->field_manager_verified == 0 && $userLoan->userKyc->relationship_manager_verified == 0)
                                                    <span class="badge badge-danger">Rejected</span>
                                                @else
                                                    <span class="badge badge-warning">Processing...</span>
                                                @endif
                                            @else
                                                <span class="badge badge-warning">Processing...</span>
                                            @endif
                                        </p>
                                        <p class="text-start"><strong>KYC Reject Reason:</strong> {{ $userLoan->userKyc->reason ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="widget widget-chart-one">
                                <div class="widget-content">
                                    <div class="agent-info text-center">
                                        <h6 class="text-muted text-start">Loan Details</h6>
                                        <p class="text-start"><strong>Interest Rate:</strong> <span class="badge badge-success">{{ $userLoan->loan->interest_rate ?? 'NA' }}%</span> </p>
                                        <p class="text-start badge badge-warning"><strong>Inital Loan Amount:</strong> <span class="">{{ $userLoan->userKyc->loan_amount ?? 'NA' }}</span> </p>
                                        <p class="text-start"><strong>Approved Loan Amount:</strong> <span class="badge badge-success">{{ $userLoan->loan->approved_loan_amount ?? 'NA' }}</span> </p>
                                        <p class="text-start badge badge-warning"><strong>Start Date:</strong>  <span>{{ $userLoan->loan->start_date ?? 'NA' }}</span></p>
                                        <p class="text-start badge badge-danger"><strong >Due Date:</strong> <span>{{ $userLoan->loan->due_date ?? 'NA' }}</span> </p>
                                        {{-- <p class="text-start"><strong>Agreement:</strong> {{ $userLoan->loan->agreement ?? 'NA' }}</p> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




@section('script')

    <script src="{{ asset('backend/assets/js/loader.js') }}"></script>
    <script src="{{ asset('backend/plugins/dropify/dropify.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/pages/profile_edit.js') }}"></script>
@endsection
