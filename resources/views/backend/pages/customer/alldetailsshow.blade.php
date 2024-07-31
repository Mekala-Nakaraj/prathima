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
                                            <i
                                                class="las la-user user-profile-icon font-20 img-thumbnail rounded-circle"></i>
                                        </div>
                                        <h6 class="text-muted text-start">Personal Information</h6>
                                        <p class="text-start"><strong>Full Name:</strong> {{ $userLoan->user->name }}</p>
                                        <p class="text-start"><strong>Email:</strong> {{ $userLoan->user->email }}</p>
                                        <p class="text-start"><strong>Phone Number:</strong>
                                            {{ $userLoan->user->phone_number }}</p>
                                        <h6 class="text-muted text-start">KYC Information</h6>
                                        @if ($userLoan->userKyc && $userLoan->userKyc->reason)
                                            <p class="text-start badge badge-danger">
                                                <strong>
                                                    Reject Reason:
                                                </strong>
                                            </p>
                                            <p class="text-start text-primary">
                                                {{ $userLoan->userKyc->reason ?? '-' }}
                                            </p>
                                        @endif
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
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="widget widget-chart-one">
                                <div class="widget-content">
                                    <div class="agent-info text-center">
                                        <h6 class="text-muted text-start">Bank Information</h6>
                                        <p class="text-start">
                                            <strong>
                                                Account Holder Name:
                                            </strong>
                                            {{ $userLoan->userKyc->account_holder_name ?? 'NA' }}
                                        </p>
                                        <p class="text-start">
                                            <strong>
                                                Bank Name:
                                            </strong>
                                            {{ $userLoan->userKyc->bank_name ?? 'NA' }}
                                        </p>
                                        <p class="text-start">
                                            <strong>
                                                Account Number:
                                            </strong>
                                            {{ $userLoan->userKyc->account_number ?? 'NA' }}
                                        </p>
                                        <p class="text-start">
                                            <strong>
                                                IFSC Code:
                                            </strong>
                                            {{ $userLoan->userKyc->ifsc_code ?? 'NA' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            {{--  --}}
                            <div class="widget widget-chart-one">
                                <div class="widget-content">
                                    <div class="agent-info text-center">
                                        <h2 class="text-muted text-start">Loan Details</h1>
                                            <p class="text-start"><strong class="text-primary">Loan Amount:
                                                    ₹{{ $principal ?? 'NA' }}</strong></p>
                                            <p class="text-start"><strong class="text-primary">Total Interest:
                                                    ₹{{ $total_interest ?? 'NA' }}</strong></p>
                                            <p class="text-start"><strong class="text-primary">Total Amount (Loan +
                                                    Interest): ₹{{ $total_repayment ?? 'NA' }}</strong></p>
                                            <p class="text-start">
                                                <strong class="text-primary">
                                                    Loan Duration:
                                                    @if ($loan_duration < 30)
                                                        {{ $loan_duration }} days
                                                    @else
                                                        {{ round($loan_duration / 30) }}
                                                        month{{ round($loan_duration / 30) > 1 ? 's' : '' }}
                                                    @endif
                                                </strong>
                                            </p>
                                            <p class="text-start"><strong class="text-primary">Loan days:
                                                    {{ $loan_duration ?? 'NA' }} days </strong></p>
                                            <p class="text-start"><strong class="text-primary">EMI:
                                                    ₹{{ $emi ?? 'NA' }}</strong></p>
                                            <p class="text-start"><strong class="text-primary badge badge-success">Profit:
                                                    ₹{{ $profit ?? 'NA' }}</strong></p>

                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#emiModal">
                                                View EMI Details
                                            </button>
                                            <button type="button" class="btn btn-success" data-toggle="modal"
                                                data-target="#emiModal">
                                                Pay Now
                                            </button>
                                            {{-- MOdel --}}
                                            <div class="modal fade" id="emiModal" tabindex="-1" role="dialog"
                                                aria-labelledby="emiModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="emiModalLabel">EMI Details</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Due Date</th>
                                                                        <th>EMI</th>
                                                                        <th>Principal</th>
                                                                        <th>Interest</th>
                                                                        <th>Outstanding Principal</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($emi_details as $detail)
                                                                        <tr>
                                                                            <td>{{ $detail['due_date'] }}</td>
                                                                            <td>₹{{ number_format($detail['emi'], 2) ?? 'NA' }}
                                                                            </td>
                                                                            <td>₹{{ number_format($detail['principal'], 2) ?? 'NA' }}
                                                                            </td>
                                                                            <td>₹{{ number_format($detail['interest'], 2) ?? 'NA' }}
                                                                            </td>
                                                                            <td>₹{{ number_format($detail['outstanding_principal'], 2) ?? 'NA' }}
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <style>
                                                            .table tbody tr:nth-child(even) {
                                                                background-color: #f2f2f2;
                                                            }

                                                            .table tbody tr.current-month {
                                                                background-color: #d4edda;
                                                            }
                                                        </style>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary"
                                                                data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
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
