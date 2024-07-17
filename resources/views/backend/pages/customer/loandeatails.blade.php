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

                                            {{-- Form to update additional fields --}}
                                            <form
                                                action="{{ route('admin.store.LoanDeatilsstore', ['user' => $user->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')

                                                <h6 class="text-muted mt-4">Loan Approved</h6>
                                                <p class="badge badge-warning"><strong>Loan Amount:</strong> {{ $user->kyc->loan_amount ?: 'NA' }}</p>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group ">
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
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="interest_rate">Interest Rate</label>
                                                            <div id="interest_rate_container">
                                                                @if (old('interest_rate'))
                                                                    @foreach (old('interest_rate') as $index => $rate)
                                                                        <input type="number" name="interest_rate[]"
                                                                            class="form-control mb-4 @error('interest_rate.' . $index) is-invalid @enderror"
                                                                            value="{{ $rate }}"
                                                                            placeholder="Interest Rate" required>
                                                                    @endforeach
                                                                @elseif(isset($user->loan->interest_rate))
                                                                    @foreach (json_decode($user->loan->interest_rate) as $index => $rate)
                                                                        <input type="number" name="interest_rate[]"
                                                                            class="form-control mb-4 @error('interest_rate.' . $index) is-invalid @enderror"
                                                                            value="{{ $rate }}"
                                                                            placeholder="Interest Rate" required>
                                                                    @endforeach
                                                                @else
                                                                    <input type="number" name="interest_rate[]"
                                                                        class="form-control mb-4 @error('interest_rate.0') is-invalid @enderror"
                                                                        value="" placeholder="Interest Rate"
                                                                        required>
                                                                @endif
                                                            </div>
                                                            <button type="button" id="add_interest_rate"
                                                                class="btn btn-primary">Add Another Interest Rate</button>
                                                            @error('interest_rate.*')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="due_date">Due Dates</label>
                                                            <div id="due_date_container">
                                                                @if (old('due_date'))
                                                                    @foreach (old('due_date') as $index => $date)
                                                                        <div class="due-date-wrapper">
                                                                            <select name="due_date[]"
                                                                                class="form-control mb-4 @error('due_date.' . $index) is-invalid @enderror"
                                                                                required>
                                                                                <option value="" disabled>Select Due
                                                                                    Date</option>
                                                                                <option value="15"
                                                                                    {{ $date == 15 ? 'selected' : '' }}>15
                                                                                    days</option>
                                                                                <option value="30"
                                                                                    {{ $date == 30 ? 'selected' : '' }}>1
                                                                                    month</option>
                                                                                <option value="60"
                                                                                    {{ $date == 60 ? 'selected' : '' }}>2
                                                                                    months</option>
                                                                                <option value="90"
                                                                                    {{ $date == 90 ? 'selected' : '' }}>3
                                                                                    months</option>
                                                                                <option value="120"
                                                                                    {{ $date == 120 ? 'selected' : '' }}>4
                                                                                    months</option>
                                                                                <option value="150"
                                                                                    {{ $date == 150 ? 'selected' : '' }}>5
                                                                                    months</option>
                                                                                <option value="180"
                                                                                    {{ $date == 180 ? 'selected' : '' }}>6
                                                                                    months</option>
                                                                            </select>
                                                                        </div>
                                                                    @endforeach
                                                                @elseif(isset($user->loan->due_date))
                                                                    @foreach (json_decode($user->loan->due_date) as $index => $date)
                                                                        <div class="due-date-wrapper">
                                                                            <select name="due_date[]"
                                                                                class="form-control mb-4 @error('due_date.' . $index) is-invalid @enderror"
                                                                                required>
                                                                                <option value="" disabled>Select Due
                                                                                    Date</option>
                                                                                <option value="15"
                                                                                    {{ $date == 15 ? 'selected' : '' }}>15
                                                                                    days</option>
                                                                                <option value="30"
                                                                                    {{ $date == 30 ? 'selected' : '' }}>1
                                                                                    month</option>
                                                                                <option value="60"
                                                                                    {{ $date == 60 ? 'selected' : '' }}>2
                                                                                    months</option>
                                                                                <option value="90"
                                                                                    {{ $date == 90 ? 'selected' : '' }}>3
                                                                                    months</option>
                                                                                <option value="120"
                                                                                    {{ $date == 120 ? 'selected' : '' }}>4
                                                                                    months</option>
                                                                                <option value="150"
                                                                                    {{ $date == 150 ? 'selected' : '' }}>5
                                                                                    months</option>
                                                                                <option value="180"
                                                                                    {{ $date == 180 ? 'selected' : '' }}>6
                                                                                    months</option>
                                                                            </select>
                                                                        </div>
                                                                    @endforeach
                                                                @else
                                                                    <div class="due-date-wrapper">
                                                                        <select name="due_date[]"
                                                                            class="form-control mb-4 @error('due_date.0') is-invalid @enderror"
                                                                            required>
                                                                            <option value="" disabled selected>Select
                                                                                Due Date</option>
                                                                            <option value="15">15 days</option>
                                                                            <option value="30">1 month</option>
                                                                            <option value="60">2 months</option>
                                                                            <option value="90">3 months</option>
                                                                            <option value="120">4 months</option>
                                                                            <option value="150">5 months</option>
                                                                            <option value="180">6 months</option>
                                                                        </select>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <button type="button" id="add_due_date"
                                                                class="btn btn-primary">Add Another Due Date</button>
                                                            @error('due_date.*')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
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

                                            <script>
                                                document.getElementById('add_interest_rate').addEventListener('click', function() {
                                                    var container = document.getElementById('interest_rate_container');
                                                    var newInputWrapper = document.createElement('div');
                                                    newInputWrapper.className = 'input-group mb-4';
                                                    var newInput = document.createElement('input');
                                                    newInput.type = 'number';
                                                    newInput.name = 'interest_rate[]';
                                                    newInput.className = 'form-control';
                                                    newInput.placeholder = 'Interest Rate';
                                                    newInput.required = true;

                                                    var cancelButton = document.createElement('button');
                                                    cancelButton.type = 'button';
                                                    cancelButton.className = 'btn btn-danger';
                                                    cancelButton.innerText = 'Cancel';
                                                    cancelButton.addEventListener('click', function() {
                                                        container.removeChild(newInputWrapper);
                                                    });

                                                    newInputWrapper.appendChild(newInput);
                                                    newInputWrapper.appendChild(cancelButton);
                                                    container.appendChild(newInputWrapper);
                                                });

                                                document.getElementById('add_due_date').addEventListener('click', function() {
                                                    var container = document.getElementById('due_date_container');
                                                    var newSelectWrapper = document.createElement('div');
                                                    newSelectWrapper.className = 'input-group mb-4';

                                                    var newSelect = document.createElement('select');
                                                    newSelect.name = 'due_date[]';
                                                    newSelect.className = 'form-control';
                                                    newSelect.required = true;

                                                    var options = [{
                                                            value: '',
                                                            text: 'Select Due Date',
                                                            disabled: true,
                                                            selected: true
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
                                                        },
                                                    ];

                                                    options.forEach(function(optionData) {
                                                        var option = document.createElement('option');
                                                        option.value = optionData.value;
                                                        option.text = optionData.text;
                                                        if (optionData.disabled) option.disabled = true;
                                                        if (optionData.selected) option.selected = true;
                                                        newSelect.appendChild(option);
                                                    });

                                                    var cancelButton = document.createElement('button');
                                                    cancelButton.type = 'button';
                                                    cancelButton.className = 'btn btn-danger';
                                                    cancelButton.innerText = 'Cancel';
                                                    cancelButton.addEventListener('click', function() {
                                                        container.removeChild(newSelectWrapper);
                                                    });

                                                    newSelectWrapper.appendChild(newSelect);
                                                    newSelectWrapper.appendChild(cancelButton);
                                                    container.appendChild(newSelectWrapper);
                                                });
                                            </script>



                                        @endif
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





@section('modal')
@endsection


@section('script')

    <script src="{{ asset('backend/assets/js/loader.js') }}"></script>
    <script src="{{ asset('backend/plugins/dropify/dropify.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/pages/profile_edit.js') }}"></script>
@endsection
