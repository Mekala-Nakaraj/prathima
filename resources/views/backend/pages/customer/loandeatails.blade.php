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
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
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
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6 col-12">
                                                    <p><strong>Full Name:</strong> {{ $user->name ?: 'NA' }}</p>
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-12">
                                                    <p><strong>Email:</strong> {{ $user->email ?: 'NA' }}</p>
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-12">
                                                    <p><strong>Phone Number:</strong> {{ $user->phone_number ?: 'NA' }}</p>
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-12">
                                                    <p><strong>Gender:</strong> {{ $user->gender ?: 'NA' }}</p>
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-12">
                                                    <p><strong>Date Of Birth:</strong> {{ $user->dob ?: 'NA' }}</p>
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-12">
                                                    <p><strong>House Type:</strong> {{ $user->house_type ?: 'NA' }}</p>
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-12">
                                                    <p><strong>Company Name:</strong> {{ $user->company_name ?: 'NA' }}</p>
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-12">
                                                    <p><strong>Company Email:</strong> {{ $user->company_email ?: 'NA' }}
                                                    </p>
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-12">
                                                    <p><strong>Pincode:</strong> {{ $user->pincode ?: 'NA' }}</p>
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-12">
                                                    <p><strong>City:</strong> {{ $user->city ?: 'NA' }}</p>
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-12">
                                                    <p><strong>State:</strong> {{ $user->state ?: 'NA' }}</p>
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-12">
                                                    <p><strong>Country:</strong> {{ $user->country ?: 'NA' }}</p>
                                                </div>
                                            </div>
                                            <h6 class="text-muted">Documents</h6>
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6 col-12">
                                                    <p><strong>PAN Number:</strong>
                                                        {{ $user->kyc ? $user->kyc->pan_number ?? 'NA' : 'NA' }}</p>
                                                    <p>
                                                        <strong>PAN Proof:</strong>
                                                        @if ($user->kyc && $user->kyc->pan_file)
                                                            <a href="{{ url($user->kyc->pan_file) }}" target="_blank"
                                                                class="text-secondary">Open Document</a>
                                                        @else
                                                            {{ $user->kyc ? 'NA' : 'NA' }}
                                                        @endif
                                                    </p>
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-12">
                                                    <p><strong>Aadhar Number:</strong>
                                                        {{ $user->kyc ? $user->kyc->aadhar_number ?? 'NA' : 'NA' }}</p>
                                                    <p>
                                                        <strong>Aadhar Proof:</strong>
                                                        @if ($user->kyc && $user->kyc->aadhar_file)
                                                            <a href="{{ url($user->kyc->aadhar_file) }}" target="_blank"
                                                                class="text-secondary">Open Document</a>
                                                        @else
                                                            {{ $user->kyc ? 'NA' : 'NA' }}
                                                        @endif
                                                    </p>
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-12">
                                                    <p><strong>Property Tax Receipt:</strong>
                                                        @if ($user->kyc && $user->kyc->property_tax_recipt)
                                                            <a href="{{ url($user->kyc->property_tax_recipt) }}"
                                                                target="_blank" class="text-secondary">Open Document</a>
                                                        @else
                                                            {{ $user->kyc ? 'NA' : 'NA' }}
                                                        @endif
                                                    </p>
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-12">
                                                    <p><strong>Rental Agreement:</strong>
                                                        @if ($user->kyc && $user->kyc->rental_agreement)
                                                            <a href="{{ url($user->kyc->rental_agreement) }}"
                                                                target="_blank" class="text-secondary">Open Document</a>
                                                        @else
                                                            {{ $user->kyc ? 'NA' : 'NA' }}
                                                        @endif
                                                    </p>
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-12">
                                                    <p><strong>Smart Card:</strong>
                                                        @if ($user->kyc && $user->kyc->smart_card_file)
                                                            <a href="{{ url($user->kyc->smart_card_file) }}"
                                                                target="_blank" class="text-secondary">Open Document</a>
                                                        @else
                                                            {{ $user->kyc ? 'NA' : 'NA' }}
                                                        @endif
                                                    </p>
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-12">
                                                    <p><strong>Driving License File:</strong>
                                                        @if ($user->kyc && $user->kyc->driving_license_file)
                                                            <a href="{{ url($user->kyc->driving_license_file) }}"
                                                                target="_blank" class="text-secondary">Open Document</a>
                                                        @else
                                                            {{ $user->kyc ? 'NA' : 'NA' }}
                                                        @endif
                                                    </p>
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-12">
                                                    <p><strong>Recent Gas Bill:</strong>
                                                        @if ($user->kyc && $user->kyc->recent_gas_bill)
                                                            <a href="{{ url($user->kyc->recent_gas_bill) }}"
                                                                target="_blank" class="text-secondary">Open Document</a>
                                                        @else
                                                            {{ $user->kyc ? 'NA' : 'NA' }}
                                                        @endif
                                                    </p>
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-12">
                                                    <p><strong>Recent Broadband Bill:</strong>
                                                        @if ($user->kyc && $user->kyc->recent_broadband_bill)
                                                            <a href="{{ url($user->kyc->recent_broadband_bill) }}"
                                                                target="_blank" class="text-secondary">Open Document</a>
                                                        @else
                                                            {{ $user->kyc ? 'NA' : 'NA' }}
                                                        @endif
                                                    </p>
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-12">
                                                    <p><strong>Pay Slip:</strong>
                                                        @if ($user->kyc && $user->kyc->pay_slip)
                                                            <a href="{{ url($user->kyc->pay_slip) }}" target="_blank"
                                                                class="text-secondary">Open Document</a>
                                                        @else
                                                            {{ $user->kyc ? 'NA' : 'NA' }}
                                                        @endif
                                                    </p>
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-12">
                                                    <p><strong>Id Card:</strong>
                                                        @if ($user->kyc && $user->kyc->id_card)
                                                            <a href="{{ url($user->kyc->id_card) }}" target="_blank"
                                                                class="text-secondary">Open Document</a>
                                                        @else
                                                            {{ $user->kyc ? 'NA' : 'NA' }}
                                                        @endif
                                                    </p>
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-12">
                                                    <p><strong>PF Member Passbook:</strong>
                                                        @if ($user->kyc && $user->kyc->pf_member_passbook)
                                                            <a href="{{ url($user->kyc->pf_member_passbook) }}"
                                                                target="_blank" class="text-secondary">Open Document</a>
                                                        @else
                                                            {{ $user->kyc ? 'NA' : 'NA' }}
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                            
                                            <h6 class="text-muted">KYC Information</h6>
                                            <div class="row">
                                                <div class="col-md-4 col-sm-6 col-12">
                                                    <p><strong>Relationship Manager Verified:</strong>
                                                        @if ($user->kyc && $user->kyc->relationship_manager_verified)
                                                            <span class="badge badge-success">Approved</span>
                                                        @else
                                                            <span class="badge badge-warning">Pending</span>
                                                        @endif
                                                    </p>
                                                </div>
                                                <div class="col-md-4 col-sm-6 col-12">
                                                    <p><strong>Field Manager Verified:</strong>
                                                        @if ($user->kyc && $user->kyc->field_manager_verified)
                                                            <span class="badge badge-success">Approved</span>
                                                        @else
                                                            <span class="badge badge-warning">Pending</span>
                                                        @endif
                                                    </p>
                                                </div>
                                                <div class="col-md-4 col-sm-6 col-12">
                                                    <p><strong>KYC Status:</strong>
                                                        @if ($user->kyc && $user->kyc->is_verified)
                                                            <span class="badge badge-success">Verified</span>
                                                        @else
                                                            <span class="badge badge-warning">Pending</span>
                                                        @endif
                                                    </p>
                                                </div>
                                                @if ($user->kyc && $user->kyc->reason)
                                                    <div class="col-md-4 col-sm-6 col-12">
                                                        <p><strong>KYC Reject Reason:</strong> {{ $user->kyc->reason }}</p>
                                                    </div>
                                                @endif
                                            </div>
                                            <h6 class="text-muted">Bank Details</h6>
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6 col-12">
                                                    <p><strong>Bank Name:</strong> {{ $user->kyc->bank_name ?: 'NA' }}</p>
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-12">
                                                    <p><strong>Account Number:</strong>
                                                        {{ $user->kyc->account_number ?: 'NA' }}</p>
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-12">
                                                    <p><strong>IFSC Code:</strong> {{ $user->kyc->ifsc_code ?: 'NA' }}</p>
                                                </div>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (Auth::user()->user_type == 'admin')
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                                <div class="widget widget-chart-one">
                                    <div class="widget-content">
                                        <div class="agent-info text-center">
                                            @if (auth()->check())
                                                <form
                                                    action="{{ route('admin.store.LoanDeatilsstore', ['user' => $user->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')

                                                    {{-- <h6 class="text-muted mt-4">Loan Approved</h6> --}}
                                                    <p>Loan Amount:
                                                        <strong id='loan_amount' class="badge badge badge-success">
                                                            {{ $user->kyc->loan_amount ?: 'NA' }}</strong>
                                                    </p>

                                                    <div class="row">
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
                                                                <label for="approved_loan_amount"
                                                                    style="color: green;">Approved Loan Amount</label>
                                                                <input type="number" name="approved_loan_amount"
                                                                    id="approved_loan_amount"
                                                                    class="form-control mb-4 @error('approved_loan_amount') is-invalid @enderror"
                                                                    value="{{ old('approved_loan_amount', $user->loan->approved_loan_amount ?? '') }}"
                                                                    placeholder="Approved Loan Amount" required
                                                                    style="color: green;"
                                                                    max="{{ $user->kyc->loan_amount ?? '' }}">
                                                                <p class="badge badge-warning">Approved loan amount should not
                                                                    exceed: <span
                                                                        class="badge badge-warning">{{ $user->kyc->loan_amount ?: 'NA' }}</span>
                                                                </p>
                                                                @error('approved_loan_amount')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                                        <script>
                                                            document.addEventListener('DOMContentLoaded', function() {
                                                                const approvedLoanInput = document.getElementById('approved_loan_amount');
                                                                const maxLoanAmount = parseFloat(document.getElementById('loan_amount').textContent);

                                                                approvedLoanInput.addEventListener('input', function() {
                                                                    const approvedLoanAmount = parseFloat(this.value);
                                                                    if (approvedLoanAmount > maxLoanAmount) {
                                                                        Swal.fire({
                                                                            icon: 'warning',
                                                                            title: 'Invalid Amount',
                                                                            html: '<span style="color: red;">Approved loan amount should not exceed </span>' +
                                                                                '<span style="color: orange; font-weight: bold;">' + maxLoanAmount +
                                                                                '</span>',
                                                                        });
                                                                        this.value = '';
                                                                    }
                                                                });
                                                            });
                                                        </script>

                                                        <div class="col-md-12 col-lg-12">
                                                            <div class="form-group">
                                                                <label for="interest_rate">Interest Rate</label>
                                                                <div id="interest_rate_container">
                                                                    @php
                                                                        $interestRates = old(
                                                                            'interest_rate',
                                                                            json_decode(
                                                                                $user->loan->due_date_interest_rate ?? '[]',
                                                                                true,
                                                                            ),
                                                                        );
                                                                        if (
                                                                            is_null($interestRates) ||
                                                                            empty($interestRates)
                                                                        ) {
                                                                            $interestRates = [
                                                                                ['interest_rate' => '', 'due_date' => ''],
                                                                            ];
                                                                        }
                                                                    @endphp
                                                                    @foreach ($interestRates as $index => $rate)
                                                                        <div class="row mb-2">
                                                                            <div class="col">
                                                                                <input type="number" name="interest_rate[]"
                                                                                    class="form-control"
                                                                                    value="{{ $rate['interest_rate'] ?? '' }}"
                                                                                    placeholder="Interest Rate" required>
                                                                            </div>
                                                                            <div class="col">
                                                                                <select name="due_date[]" class="form-control"
                                                                                    required>
                                                                                    <option value="" disabled
                                                                                        {{ !isset($rate['due_date']) ? 'selected' : '' }}>
                                                                                        Select Due Date</option>
                                                                                    <option value="15"
                                                                                        {{ isset($rate['due_date']) && $rate['due_date'] == 15 ? 'selected' : '' }}>
                                                                                        15 days</option>
                                                                                    <option value="30"
                                                                                        {{ isset($rate['due_date']) && $rate['due_date'] == 30 ? 'selected' : '' }}>
                                                                                        1 month</option>
                                                                                    <option value="60"
                                                                                        {{ isset($rate['due_date']) && $rate['due_date'] == 60 ? 'selected' : '' }}>
                                                                                        2 months</option>
                                                                                    <option value="90"
                                                                                        {{ isset($rate['due_date']) && $rate['due_date'] == 90 ? 'selected' : '' }}>
                                                                                        3 months</option>
                                                                                    <option value="120"
                                                                                        {{ isset($rate['due_date']) && $rate['due_date'] == 120 ? 'selected' : '' }}>
                                                                                        4 months</option>
                                                                                    <option value="150"
                                                                                        {{ isset($rate['due_date']) && $rate['due_date'] == 150 ? 'selected' : '' }}>
                                                                                        5 months</option>
                                                                                    <option value="180"
                                                                                        {{ isset($rate['due_date']) && $rate['due_date'] == 180 ? 'selected' : '' }}>
                                                                                        6 months</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="col-12 mb-5">
                                                            <button type="button" id="add_interest_due_date"
                                                                class="btn btn-primary">Add Another Interest Rate and Due
                                                                Date</button>
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

                                                <script>
                                                    document.getElementById('add_interest_due_date').addEventListener('click', function() {
                                                        var interestRateContainer = document.getElementById('interest_rate_container');

                                                        var newRow = document.createElement('div');
                                                        newRow.setAttribute('class', 'row mb-2');

                                                        var newInterestRate = document.createElement('input');
                                                        newInterestRate.setAttribute('type', 'number');
                                                        newInterestRate.setAttribute('name', 'interest_rate[]');
                                                        newInterestRate.setAttribute('class', 'form-control');
                                                        newInterestRate.setAttribute('placeholder', 'Interest Rate');
                                                        newInterestRate.setAttribute('required', true);

                                                        var newDueDate = document.createElement('select');
                                                        newDueDate.setAttribute('name', 'due_date[]');
                                                        newDueDate.setAttribute('class', 'form-control');
                                                        newDueDate.setAttribute('required', true);
                                                        var options = [{
                                                                value: '',
                                                                text: 'Select Due Date',
                                                                disabled: true
                                                            },
                                                            {
                                                                value: '15',
                                                                text: '15 days'
                                                            },
                                                            {
                                                                value: '30',
                                                                text: '1 month'
                                                            },
                                                            {
                                                                value: '60',
                                                                text: '2 months'
                                                            },
                                                            {
                                                                value: '90',
                                                                text: '3 months'
                                                            },
                                                            {
                                                                value: '120',
                                                                text: '4 months'
                                                            },
                                                            {
                                                                value: '150',
                                                                text: '5 months'
                                                            },
                                                            {
                                                                value: '180',
                                                                text: '6 months'
                                                            }
                                                        ];

                                                        options.forEach(function(optionData) {
                                                            var option = document.createElement('option');
                                                            option.value = optionData.value;
                                                            option.text = optionData.text;
                                                            newDueDate.appendChild(option);
                                                        });

                                                        var col1 = document.createElement('div');
                                                        col1.setAttribute('class', 'col');
                                                        col1.appendChild(newInterestRate);

                                                        var col2 = document.createElement('div');
                                                        col2.setAttribute('class', 'col');
                                                        col2.appendChild(newDueDate);

                                                        newRow.appendChild(col1);
                                                        newRow.appendChild(col2);

                                                        var removeIcon = document.createElement('i');
                                                        removeIcon.setAttribute('class', 'las la-times-circle text-danger ml-2 remove-icon');
                                                        removeIcon.style.cursor = 'pointer';
                                                        removeIcon.addEventListener('click', function() {
                                                            interestRateContainer.removeChild(newRow);
                                                        });

                                                        newRow.appendChild(removeIcon);

                                                        interestRateContainer.appendChild(newRow);
                                                    });
                                                </script>

                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        {{-- <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                            <div class="widget widget-chart-one">
                                <div class="widget-content">
                                    <div class="agent-info text-center">
                                        @if (auth()->check())
                                            <h6 class="text-muted">KYC Information</h6>
                                            <p><strong>PAN Number:</strong>
                                                {{ $user->kyc ? $user->kyc->pan_number ?? 'NA' : '-' }}</p>
                                            <p><strong>Relationship Manager Verified:</strong>
                                                @if ($user->kyc && $user->kyc->relationship_manager_verified)
                                                    <span class="badge badge-success">Approved</span>
                                                @else
                                                    <span class="badge badge-warning">Pending</span>
                                                @endif
                                            </p>
                                            <p><strong>Field Manager Verified:</strong>
                                                @if ($user->kyc && $user->kyc->field_manager_verified)
                                                    <span class="badge badge-success">Approved</span>
                                                @else
                                                    <span class="badge badge-warning">Pending</span>
                                                @endif
                                            </p>
                                            <p><strong>KYC Status:</strong>
                                                @if ($user->kyc && $user->kyc->is_verified)
                                                    <span class="badge badge-success">Verified</span>
                                                @else
                                                    <span class="badge badge-warning">Pending</span>
                                                @endif
                                            </p>
                                            <p><strong>KYC Reject Reason:</strong>
                                                {{ $user->kyc ? $user->kyc->reason ?? '-' : '-' }}</p>
                                            <form
                                                action="{{ route('admin.store.LoanDeatilsstore', ['user' => $user->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')

                                                <h6 class="text-muted mt-4">Loan Approved</h6>
                                                <p class="badge badge-warning"><strong>Loan Amount:</strong>
                                                    {{ $user->kyc->loan_amount ?: 'NA' }}</p>

                                                <div class="row">
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
                                                            <label for="approved_loan_amount"
                                                                style="color: green;">Approved Loan Amount</label>
                                                            <input type="number" name="approved_loan_amount"
                                                                id="approved_loan_amount"
                                                                class="form-control mb-4 @error('approved_loan_amount') is-invalid @enderror"
                                                                value="{{ old('approved_loan_amount', $user->loan->approved_loan_amount ?? '') }}"
                                                                placeholder="Approved Loan Amount" required
                                                                style="color: green;">
                                                            @error('approved_loan_amount')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 col-lg-12">
                                                        <div class="form-group">
                                                            <label for="interest_rate">Interest Rate</label>
                                                            <div id="interest_rate_container">
                                                                @foreach (old('interest_rate', $user->loan->due_date_interest_rate ?? []) as $index => $rate)
                                                                    <div class="row mb-2">
                                                                        <div class="col">
                                                                            <input type="number" name="interest_rate[]"
                                                                                class="form-control"
                                                                                value="{{ $rate['interest_rate'] ?? '' }}"
                                                                                placeholder="Interest Rate" required>
                                                                        </div>
                                                                        <div class="col">
                                                                            <select name="due_date[]" class="form-control"
                                                                                required>
                                                                                <option value="" disabled>Select Due
                                                                                    Date</option>
                                                                                <option value="15"
                                                                                    {{ $rate['due_date'] == 15 ? 'selected' : '' }}>
                                                                                    15 days</option>
                                                                                <option value="30"
                                                                                    {{ $rate['due_date'] == 30 ? 'selected' : '' }}>
                                                                                    1 month</option>
                                                                                <option value="60"
                                                                                    {{ $rate['due_date'] == 60 ? 'selected' : '' }}>
                                                                                    2 months</option>
                                                                                <option value="90"
                                                                                    {{ $rate['due_date'] == 90 ? 'selected' : '' }}>
                                                                                    3 months</option>
                                                                                <option value="120"
                                                                                    {{ $rate['due_date'] == 120 ? 'selected' : '' }}>
                                                                                    4 months</option>
                                                                                <option value="150"
                                                                                    {{ $rate['due_date'] == 150 ? 'selected' : '' }}>
                                                                                    5 months</option>
                                                                                <option value="180"
                                                                                    {{ $rate['due_date'] == 180 ? 'selected' : '' }}>
                                                                                    6 months</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 mb-5">
                                                        <button type="button" id="add_interest_due_date"
                                                            class="btn btn-primary">Add Another Interest Rate and Due
                                                            Date</button>
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

                                            <script>
                                                document.getElementById('add_interest_due_date').addEventListener('click', function() {
                                                    var interestRateContainer = document.getElementById('interest_rate_container');

                                                    var newRow = document.createElement('div');
                                                    newRow.setAttribute('class', 'row mb-2');

                                                    var newInterestRate = document.createElement('input');
                                                    newInterestRate.setAttribute('type', 'number');
                                                    newInterestRate.setAttribute('name', 'interest_rate[]');
                                                    newInterestRate.setAttribute('class', 'form-control');
                                                    newInterestRate.setAttribute('placeholder', 'Interest Rate');
                                                    newInterestRate.setAttribute('required', true);

                                                    var newDueDate = document.createElement('select');
                                                    newDueDate.setAttribute('name', 'due_date[]');
                                                    newDueDate.setAttribute('class', 'form-control');
                                                    newDueDate.setAttribute('required', true);
                                                    var options = [{
                                                            value: '',
                                                            text: 'Select Due Date',
                                                            disabled: true
                                                        },
                                                        {
                                                            value: '15',
                                                            text: '15 days'
                                                        },
                                                        {
                                                            value: '30',
                                                            text: '1 month'
                                                        },
                                                        {
                                                            value: '60',
                                                            text: '2 months'
                                                        },
                                                        {
                                                            value: '90',
                                                            text: '3 months'
                                                        },
                                                        {
                                                            value: '120',
                                                            text: '4 months'
                                                        },
                                                        {
                                                            value: '150',
                                                            text: '5 months'
                                                        },
                                                        {
                                                            value: '180',
                                                            text: '6 months'
                                                        }
                                                    ];

                                                    options.forEach(function(optionData) {
                                                        var option = document.createElement('option');
                                                        option.value = optionData.value;
                                                        option.text = optionData.text;
                                                        newDueDate.appendChild(option);
                                                    });

                                                    var col1 = document.createElement('div');
                                                    col1.setAttribute('class', 'col');
                                                    col1.appendChild(newInterestRate);

                                                    var col2 = document.createElement('div');
                                                    col2.setAttribute('class', 'col');
                                                    col2.appendChild(newDueDate);

                                                    newRow.appendChild(col1);
                                                    newRow.appendChild(col2);

                                                    var removeIcon = document.createElement('i');
                                                    removeIcon.setAttribute('class', 'las la-times-circle text-danger ml-2 remove-icon');
                                                    removeIcon.style.cursor = 'pointer';
                                                    removeIcon.addEventListener('click', function() {
                                                        interestRateContainer.removeChild(newRow);
                                                    });

                                                    newRow.appendChild(removeIcon);

                                                    interestRateContainer.appendChild(newRow);
                                                });
                                            </script>

                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div> --}}
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
