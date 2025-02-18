@extends('backend.layout.app')
@section('title', 'Profile')
@section('css')
    <link href="{{ asset('backend/assets/css/loader.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/plugins/dropify/dropify.min.css') }}">
    <link href="{{ asset('backend/assets/css/pages/profile_edit.css" rel="stylesheet" type="text/css') }}" />
@endsection

@section('navbar')
    <style>
        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            background: #ac0d0d;
        }
    </style>
    <div class="sub-header-container">
        <header class="header navbar navbar-expand-sm">
            <ul class="navbar-nav flex-row">
                <li>
                    <div class="page-header">
                        <nav class="breadcrumb-one" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">My Account</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span>Profile</span></li>
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
    <div class="layout-px-spacing ">
        <div class="account-settings-container layout-top-spacing">
            <div class="account-content">
                <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                            <div id="general-info" class="section general-info">
                                <div class="info">
                                    <div class="d-flex mt-2">
                                        <div class="profile-edit-left col-lg-4">
                                            <div class="tab-options-list">
                                                <div class="nav flex-column nav-pills mb-sm-0 mb-3 text-center mx-auto"
                                                    id="profile-tab" role="tablist" aria-orientation="vertical">
                                                    <a class="nav-link btn mb-3" id="profile-tab" data-toggle="pill"
                                                        href="#profile" role="tab" aria-controls="profile"
                                                        aria-selected="true"><i class="las la-info"></i>Profile</a>
                                                    <a class="nav-link text-center btn mb-2 active" id="profile-kyc-tab"
                                                        data-toggle="pill" href="#profile-kyc" role="tab"
                                                        aria-controls="profile-kyc" aria-selected="false"><i
                                                            class="las la-suitcase"></i>KYC</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="profile-edit-right col-lg-8">
                                            <div class="tab-content" id="profile-tabContent">
                                                <!-- Profile Form -->
                                                <div class="tab-pane fade " id="profile" role="tabpanel"
                                                    aria-labelledby="profile-tab">
                                                    <div
                                                        class="col-xl-12 col-lg-12 col-md-8 col-sm-12 col-12 layout-spacing">
                                                        @if (session('success'))
                                                            <div class="alert alert-success mt-3">
                                                                {{ session('success') }}
                                                            </div>
                                                        @endif
                                                        <div class="widget widget-chart-one">
                                                            <div class="widget-content">
                                                                <div class="agent-info text-center">
                                                                    <div class="agent-img pb-3">
                                                                        {{-- <img src="assets/img/profile-5.jpg"
                                                                            class="img-thumbnail rounded-circle"
                                                                            alt="image"> --}}
                                                                        <style>
                                                                            .user-profile-icon {
                                                                                font-size: 8rem;
                                                                            }
                                                                        </style>
                                                                        <i
                                                                            class="las la-user user-profile-icon font-20 img-thumbnail rounded-circle"></i>
                                                                    </div>
                                                                    @if (auth()->check())
                                                                        <h5 class="text-dark">{{ auth()->user()->name }}
                                                                        </h5>
                                                                        <p>{{ auth()->user()->email }}</p>
                                                                        <h6 class="mb-3 mt-3"><span
                                                                                class="text-primary pr-2"><i
                                                                                    class="fa fa-phone"></i></span> (+91)
                                                                            {{ auth()->user()->phone_number }}</h6>
                                                                    @endif
                                                                </div>
                                                                <form action="{{ route('profileUpdate') }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <div class="form-row">
                                                                        <div class="form-group col-md-6">
                                                                            <label for="name">Full Name</label>
                                                                            <input type="text" name="name"
                                                                                class="form-control"
                                                                                value="{{ old('name', $user->name) }}">
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <label for="email">Email Address</label>
                                                                            <input type="email" name="email"
                                                                                class="form-control"
                                                                                value="{{ old('email', $user->email) }}"
                                                                                disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="form-group col-md-6">
                                                                            <label for="phone">Phone Number</label>
                                                                            <input type="text" name="phone"
                                                                                class="form-control"
                                                                                value="{{ old('phone', $user->phone) }}"
                                                                                disabled>
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <label for="role">Role</label>
                                                                            <input type="text" name="role"
                                                                                class="form-control"
                                                                                value="{{ old('role', $user->role) }}"
                                                                                disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="form-group col-md-6">
                                                                            <label for="pincode">Pincode</label>
                                                                            <input type="text" name="pincode"
                                                                                class="form-control"
                                                                                value="{{ old('pincode', $user->pincode) }}"
                                                                                disabled>
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <label for="city">City</label>
                                                                            <input type="text" name="city"
                                                                                class="form-control"
                                                                                value="{{ old('city', $user->city) }}"
                                                                                disabled>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="form-group col-md-6">
                                                                            <label for="state">State</label>
                                                                            <input type="text" name="state"
                                                                                class="form-control"
                                                                                value="{{ old('state', $user->state) }}"
                                                                                disabled>
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <label for="country">Country</label>
                                                                            <input type="text" name="country"
                                                                                class="form-control"
                                                                                value="{{ old('country', $user->country) }}"
                                                                                disabled>
                                                                        </div>
                                                                    </div>
                                                                    <button type="submit" class="btn btn-primary">Update
                                                                        profile</button>

                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- KYC Form -->
                                                <div class="tab-pane fade show active" id="profile-kyc" role="tabpanel"
                                                    aria-labelledby="profile-kyc-tab">
                                                    <form action="{{ route('ProfileupdateKyc') }}" method="POST"
                                                        id="ProfileupdateKyc" class="ProfileupdateKyc">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="work-section">
                                                                    <div class="row">
                                                                        <div class="col-lg-6 col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="aadhar_number">Aadhar
                                                                                    Number</label>
                                                                                <input type="number" name="aadhar_number"
                                                                                    class="form-control mb-4"
                                                                                    placeholder="Aadhar Number"
                                                                                    maxlength="12" pattern="\d{12}"
                                                                                    title="Aadhar number must be 12 digits"
                                                                                    required
                                                                                    value="{{ old('aadhar_number', $user->kyc->aadhar_number ?? '') }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6 col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="pan_number">PAN Number</label>
                                                                                <input type="text" name="pan_number"
                                                                                    id="pan_number"
                                                                                    class="form-control mb-4 @error('pan_number') is-invalid @enderror"
                                                                                    placeholder="PAN Number"
                                                                                    pattern="[A-Z0-9]{10}"
                                                                                    title="Please enter a 10-character PAN number with capital letters only"
                                                                                    maxlength="10" required
                                                                                    value="{{ old('pan_number', $user->kyc->pan_number ?? '') }}">
                                                                                <small class="text-muted">Example:
                                                                                    ABCDE1234F</small>

                                                                                @if (session('success'))
                                                                                    <div class="alert alert-success">
                                                                                        {{ session('success') }}
                                                                                    </div>
                                                                                @endif
                                                                                @if (session('error'))
                                                                                    <div class="alert alert-danger">
                                                                                        {{ session('error') }}
                                                                                    </div>
                                                                                @endif
                                                                            </div>
                                                                        </div>


                                                                        <div class="col-lg-6 col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="account_number">Account
                                                                                    Number</label>
                                                                                <input type="text"
                                                                                    name="account_number"
                                                                                    pattern="[0-9]{15}"
                                                                                    title="Please enter Valid Account Number"
                                                                                    class="form-control mb-4"
                                                                                    class="form-control mb-4 @error('pan_number') is-invalid @enderror"
                                                                                    maxlength="15"
                                                                                    placeholder="Account Number" required
                                                                                    value="{{ old('account_number', $user->kyc->account_number ?? '') }}">

                                                                                @if (session('success'))
                                                                                    <div class="alert alert-success">
                                                                                        {{ session('success') }}
                                                                                    </div>
                                                                                @endif
                                                                                @if (session('error'))
                                                                                    <div class="alert alert-danger">
                                                                                        {{ session('error') }}
                                                                                    </div>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6 col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="ifsc_code">IFSC Code</label>
                                                                                <input type="text" name="ifsc_code"
                                                                                    class="form-control mb-4"
                                                                                    placeholder="IFSC Code" required
                                                                                    value="{{ old('ifsc_code', $user->kyc->ifsc_code ?? '') }}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        @if ($user->kyc)
                                                            @if ($user->kyc->is_verified == 0)
                                                                <div class="alert alert-danger mt-3">
                                                                    Your KYC has been rejected. Please review and update
                                                                    your information.
                                                                </div>
                                                            @elseif ($user->kyc->is_verified == 1)
                                                                <div class="alert alert-success mt-3">
                                                                    Your KYC has been approved. Further modifications are
                                                                    currently disabled.
                                                                </div>
                                                                <!-- Disable form inputs when KYC is approved -->
                                                                <script>
                                                                    // Disable form inputs
                                                                    document.addEventListener('DOMContentLoaded', function() {
                                                                        var form = document.getElementById('ProfileupdateKyc');
                                                                        if (form) {
                                                                            var formInputs = form.querySelectorAll('input');
                                                                            formInputs.forEach(function(input) {
                                                                                input.setAttribute('disabled', 'disabled');
                                                                            });
                                                                        }
                                                                    });
                                                                </script>
                                                            @elseif ($user->kyc->status == 'pending')
                                                                <div class="alert alert-warning mt-3">
                                                                    Your KYC is pending review.
                                                                </div>
                                                            @else
                                                                <div class="alert alert-warning mt-3">
                                                                    Your KYC details are not submitted.
                                                                </div>
                                                            @endif
                                                        @else
                                                            <div class="alert alert-warning mt-3">
                                                                Your KYC details are not submitted.
                                                            </div>
                                                        @endif

                                                        <button type="submit" class="btn btn-primary mt-4">Save KYC
                                                            Details</button>
                                                    </form>
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

@section('modal')
@endsection


@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var panInput = document.getElementById('pan_number');

            panInput.addEventListener('input', function() {
                var currentValue = this.value;
                var newValue = currentValue.toUpperCase(); // Convert input to uppercase

                if (currentValue !== newValue) {
                    this.value = newValue; // Update input value to uppercase
                }
            });
        });
    </script>

    <script src="{{ asset('backend/assets/js/loader.js') }}"></script>
    <script src="{{ asset('backend/plugins/dropify/dropify.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/pages/profile_edit.js') }}"></script>
@endsection
