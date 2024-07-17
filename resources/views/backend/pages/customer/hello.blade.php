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
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                            @if (session('success'))
                                <div class="alert alert-success mt-3">
                                    {{ session('success') }}
                                </div>
                            @endif
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
                                        @if (auth()->check())
                                            <h6 class="text-muted">Personal Information</h6>
                                            <p><strong>Full Name:</strong> {{ $user->name ?: 'NA' }}</p>
                                            <p><strong>Email:</strong> {{ $user->email ?: 'NA' }}</p>
                                            <p><strong>Phone Number:</strong> {{ $user->phone_number ?: 'NA' }}</p>
                                            <p><strong>Pincode:</strong> {{ $user->pincode ?: 'NA' }}</p>
                                            <p><strong>City:</strong> {{ $user->city ?: 'NA' }}</p>
                                            <p><strong>State:</strong> {{ $user->state ?: 'NA' }}</p>
                                            <p><strong>Country:</strong> {{ $user->country ?: 'NA' }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                            <div class="widget widget-chart-one">
                                <div class="widget-content">
                                    <div class="agent-info text-center">
                                        @if (auth()->check())
                                            <h6 class="text-muted">KYC Information</h6>
                                            <p><strong>PAN Number:</strong>
                                                {{ $user->kyc ? $user->kyc->pan_number ?? 'NA' : '-' }}</p>
                                            <p><strong>Loan Amount:</strong> {{ $user->kyc->loan_amount ?: 'NA' }}</p>
                                            <p><strong>Relationship Manager Verified:</strong>
                                                @if ($user->kyc && $user->kyc->relationship_manager_verified)
                                                    <span class="text-success">Approved</span>
                                                @else
                                                    <span class="text-warning">Pending</span>
                                                @endif
                                            </p>
                                            <p><strong>Field Manager Verified:</strong>
                                                @if ($user->kyc && $user->kyc->field_manager_verified)
                                                    <span class="text-success">Approved</span>
                                                @else
                                                    <span class="text-warning">Pending</span>
                                                @endif
                                            </p>
                                            <p><strong>KYC Status:</strong>
                                                @if ($user->kyc && $user->kyc->is_verified)
                                                    <span class="text-success">Verified</span>
                                                @else
                                                    <span class="text-warning">Pending</span>
                                                @endif
                                            </p>
                                            <p><strong>KYC Reject Reason:</strong>
                                                {{ $user->kyc ? $user->kyc->reason ?? '-' : '-' }}</p>

                                            {{-- Form to update additional fields --}}
                                            <form
                                                action="{{ route('admin.store.LoanDeatilsstore', ['user' => $user->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')

                                                <h6 class="text-muted mt-4">Loan Approved</h6>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="interest_rate">Interest Rate</label>
                                                            <input type="text" name="interest_rate" id="interest_rate"
                                                                class="form-control mb-4 @error('interest_rate') is-invalid @enderror"
                                                                value="{{ old('interest_rate', $user->loan->interest_rate ?? '') }}"
                                                                placeholder="Interest Rate" required>
                                                            @error('interest_rate')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="approved_loan_amount">Approved Loan Amount</label>
                                                            <input type="number" name="approved_loan_amount"
                                                                id="approved_loan_amount"
                                                                class="form-control mb-4 @error('approved_loan_amount') is-invalid @enderror"
                                                                value="{{ old('approved_loan_amount', $user->loan->approved_loan_amount ?? '') }}"
                                                                placeholder="Approved Loan Amount" required>
                                                            @error('approved_loan_amount')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="start_date">Start Date</label>
                                                            <input type="date" name="start_date" id="start_date"
                                                                class="form-control mb-4 @error('start_date') is-invalid @enderror"
                                                                value="{{ old('start_date', isset($user->loan->start_date) ? \Carbon\Carbon::parse($user->loan->start_date)->format('Y-m-d') : '') }}"
                                                                placeholder="Start Date" required>
                                                            @error('start_date')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <button type="button" class="btn btn-primary"
                                                                data-toggle="modal" data-target="#dueDateModal">
                                                                Add Due Date Period
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="agreement">Agreement</label>
                                                            <textarea name="agreement" id="agreements" class="form-control" rows="5" required>{{ old('agreement', $user->loan->agreement ?? '') }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary mt-3">Update Loan</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal for Due Date Period -->
                        <div class="modal fade" id="dueDateModal" tabindex="-1" role="dialog"
                            aria-labelledby="dueDateModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="dueDateModalLabel">Add Due Date Period</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div id="interest_months_container">
                                            <div class="input-group mb-3">
                                                <input type="number" name="interest_rate[]" class="form-control mb-4"
                                                    placeholder="Interest Rate" required>
                                                <input type="number" name="months[]" class="form-control mb-4"
                                                    placeholder="Months" required>
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary remove-period"
                                                        type="button">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-primary" id="add_interest_months">Add
                                            Another Period</button>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Save
                                            changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                            document.getElementById('add_interest_months').addEventListener('click', function() {
                                var container = document.getElementById('interest_months_container');
                                var newPeriod = document.createElement('div');
                                newPeriod.classList.add('input-group', 'mb-3');
                                newPeriod.innerHTML = `
                                    <input type="number" name="interest_rate[]" class="form-control mb-4" placeholder="Interest Rate" required>
                                    <input type="number" name="due_date[]" class="form-control mb-4" placeholder="Months" required>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary remove-period" type="button">Remove</button>
                                    </div>
                                `;
                                container.appendChild(newPeriod);
                            });

                            document.getElementById('interest_months_container').addEventListener('click', function(event) {
                                if (event.target.classList.contains('remove-period')) {
                                    event.target.closest('.input-group').remove();
                                }
                            });
                        </script>



                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection





@section('modal')
@endsection


@section('script')

    <script src="{{ asset('backend/assets/js/loader.js') }}"></script>
    <script src="{{ asset('backend/plugins/dropify/dropify.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/pages/profile_edit.js') }}"></script>
@endsection
