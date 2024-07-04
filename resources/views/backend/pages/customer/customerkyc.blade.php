@extends('backend.layout.app')
@section('title', 'Customer KYC')
@section('css')
@endsection

@section('navbar')
    <div class="sub-header-container">
        <header class="header navbar navbar-expand-sm">
            <ul class="navbar-nav flex-row">
                <li>
                    <div class="page-header">
                        <nav class="breadcrumb-one" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Customer Management</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span>Customer KYC</span></li>
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
    <div class="layout-top-spacing mb-2">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Aadhar No</th>
                    <th>Pan No</th>
                    <th>Account No</th>
                    <th>Status</th>
                    <th>KYC Verified</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone_number ?: 'NA' }}</td>
                        <td>{{ $user->kyc->aadhar_number ?? 'NA' }}</td>
                        <td>{{ $user->kyc->pan_number ?? 'NA' }}</td>
                        <td>{{ $user->kyc->account_number ?? 'NA' }}</td>
                        <td>
                            @if ($user->kyc)
                                @if ($user->kyc->is_verified)
                                    <span class="badge badge-success">Approved</span>
                                @else
                                    <span class="badge badge-danger">Rejected</span>
                                @endif
                            @else
                                <span class="badge badge-warning">Not Submitted</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('user.kyc.CustomerKYCVerified', ['user' => $user->id]) }}"
                                method="POST">
                                @csrf
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="is_verified"
                                        id="verified_{{ $user->id }}" value="1"
                                        {{ $user->kyc && $user->kyc->is_verified ? 'checked' : '' }}>
                                    <label class="form-check-label" for="verified_{{ $user->id }}">Verified</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="is_verified"
                                        id="unverified_{{ $user->id }}" value="0"
                                        {{ $user->kyc && !$user->kyc->is_verified ? 'checked' : '' }}>
                                    <label class="form-check-label" for="unverified_{{ $user->id }}">Unverified</label>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('modal')
@endsection


@section('script')
@endsection
