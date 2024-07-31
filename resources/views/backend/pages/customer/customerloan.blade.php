@extends('backend.layout.app')
@section('title', 'Customer loan')
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
                                <li class="breadcrumb-item active" aria-current="page"><span>Customer Loan List</span></li>
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
                    <th>Loan ID</th>
                    <th>Name</th>
                    <th>Loan Amount</th>
                    {{-- <th>Interest Rate</th>
                    <th>Due Date</th> --}}
                    <th>Agreed Status</th>
                    <th>Agreed Date</th>
                    <th>Payment Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usersLoans as $index => $userLoan)
                    @if (
                        $userLoan->userKyc &&
                            $userLoan->userKyc->field_manager_verified == 1 &&
                            $userLoan->userKyc->relationship_manager_verified == 1 &&
                            $userLoan->userKyc->is_verified == 1)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $userLoan->loan ? $userLoan->loan->loan_id : 'NA' }}</td>
                            <td>{{ $userLoan->user ? $userLoan->user->name : 'NA' }}</td>
                            <td>{{ $userLoan->loan ? $userLoan->loan->approved_loan_amount : 'NA' }}</td>
                            {{-- <td>
                                @if ($userLoan->loan)
                                    @php
                                        $dueDateInterestRate = json_decode($userLoan->loan->due_date_interest_rate, true);
                                    @endphp
                                    {{ $dueDateInterestRate[0]['interest_rate'] ?? 'NA' }}
                                @else
                                    NA
                                @endif
                            </td>
                            <td>
                                @if ($userLoan->loan)
                                    @php
                                        $dueDateInterestRate = json_decode($userLoan->loan->due_date_interest_rate, true);
                                    @endphp
                                    {{ $dueDateInterestRate[0]['due_date'] ?? 'NA' }}
                                @else
                                    NA
                                @endif
                            </td> --}}
                            <td>
                                @if ($userLoan->agreed)
                                    <span class="badge badge-success">Agreed</span>
                                @else
                                    <span class="badge badge-danger">Not Agreed</span>
                                @endif
                            </td>
                            <td>
                                @if ($userLoan->agreed_date)
                                    <span
                                        style="color: #336699;">{{ \Carbon\Carbon::parse($userLoan->agreed_date)->format('Y-m-d h:i:s A') }}</span>
                                @else
                                    <span style="color: #999999;">NA</span>
                                @endif
                            </td>
                            <td>
                                @if ($userLoan->payment_transaction)
                                    @if ($userLoan->payment_transaction === 'pending')
                                        <span class="badge badge-warning">Pending</span>
                                    @elseif ($userLoan->payment_transaction === 'processing')
                                        <span class="badge badge-info">Processing</span>
                                    @elseif ($userLoan->payment_transaction === 'deposit')
                                        <span class="badge badge-success">Deposited</span>
                                    @endif
                                @else
                                    <span class="badge badge-secondary">No Loan</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.ProfileDeatilsShow', ['id' => $userLoan->id]) }}"
                                    class="btn btn-primary btn-sm">
                                    <i class="las la-eye" style="font-size: 24px;"></i>
                                </a>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
@endsection



@section('modal')
@endsection


@section('script')
@endsection
