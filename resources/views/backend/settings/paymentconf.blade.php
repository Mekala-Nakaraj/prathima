@extends('backend.layout.app')
@section('title', 'payment conf')
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
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Payment</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span>Payment Configuration</span></li>
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
        <div class="layout-top-spacing mb-2">
            <div class="col-md-12">
                <div class="row">
                    <div class="container p-0">
                        <div class="row layout-top-spacing">
                            <div class="col-lg-12 layout-spacing">
                                <div class="statbox widget box box-shadow mb-4">
                                    <div class="widget-header">
                                        <div class="row">
                                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                                <h4>Payment Configuration</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widget-content widget-content-area">
                                        <form action="{{ route('settings.PaymentConfStore') }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-6 mb-4">
                                                    <label class="col-form-label">Payment Gateway Title</label>
                                                    <select class="form-control" id="live_payment_gateway_title"
                                                        name="live_payment_gateway_title" required>
                                                        <option value="razerpay"
                                                            {{ old('live_payment_gateway_title', $settings->where('key', 'live_payment_gateway_title')->first()->value ?? '') == 'razerpay' ? 'selected' : '' }}>
                                                            Razerpay</option>
                                                    </select>
                                                    {{-- <small class="form-text text-muted">Select the payment gateway title for
                                                    the test configuration</small> --}}
                                                </div>
                                                <div class="col-lg-6 mb-4">
                                                    <label class="col-form-label">API Key</label>
                                                    <input type="text" class="form-control" id="razerpay_live_api_key"
                                                        name="razerpay_live_api_key"
                                                        value="{{ old('razerpay_live_api_key', $settings->where('key', 'razerpay_live_api_key')->first()->value ?? '') }}"
                                                        placeholder="Enter live API key" required>
                                                    {{-- <small class="form-text text-muted">Enter live API key for Razerpay</small> --}}
                                                </div>
                                                <div class="col-lg-6 mb-4">
                                                    <label class="col-form-label">API Secret Key</label>
                                                    <input type="text" class="form-control"
                                                        id="razerpay_live_api_secret_key"
                                                        name="razerpay_live_api_secret_key"
                                                        value="{{ old('razerpay_live_api_secret_key', $settings->where('key', 'razerpay_live_api_secret_key')->first()->value ?? '') }}"
                                                        placeholder="Enter live API secret key" required>
                                                    {{-- <small class="form-text text-muted">Enter live API secret key for
                                                    Razerpay</small> --}}
                                                </div>
                                                <div class="col-lg-6 mb-4">
                                                    <label class="col-form-label">Mode</label>
                                                    <select class="form-control" id="live_mode" name="live_mode" required>
                                                        <option value="live"
                                                            {{ old('live_mode', $settings->where('key', 'live_mode')->first()->value ?? '') == 'live' ? 'selected' : '' }}>
                                                            Live</option>
                                                        <option value="test"
                                                            {{ old('live_mode', $settings->where('key', 'live_mode')->first()->value ?? '') == 'test' ? 'selected' : '' }}>
                                                            Test</option>
                                                    </select>
                                                    {{-- <small class="form-text text-muted">Select the mode for the live
                                                    configuration</small> --}}
                                                </div>
                                            </div>
                                            <div class="widget-footer text-right">
                                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                                <button type="reset" class="btn btn-outline-primary">Cancel</button>
                                            </div>
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
@endsection



@section('modal')
@endsection


@section('script')

    <script src="{{ asset('backend/assets/js/loader.js') }}"></script>
    <script src="{{ asset('backend/plugins/dropify/dropify.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/pages/profile_edit.js') }}"></script>
@endsection
