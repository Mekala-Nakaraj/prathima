@extends('backend.layout.app')
@section('title', 'admin')
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
    <div class="layout-px-spacing">
        <div class="layout-top-spacing mb-2">
            <div class="col-md-12">
                <div class="row">
                    <div class="container p-0">
                        <div class="row layout-top-spacing date-table-container">
                            <!-- Datatable with export options -->
                            <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                                <div class="widget-content widget-content-area br-6">
                                    {{-- <h4 class="table-header">Export Datatable</h4> --}}
                                    <div class="table-responsive mb-4">
                                        <table id="export-dt" class="table table-hover" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Loan Amount</th>
                                                    <th>Relationship Manager Verified</th>
                                                    <th>Field Manager Verified</th>

                                                    <th>Loan Approved</th>
                                                    <th>Status</th>
                                                    <th>Reason</th>
                                                    <th>Aadhar No</th>
                                                    <th>Pan No</th>
                                                    <th>Account No</th>
                                                    <th>IFSC No</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($users as $index => $user)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>{{ $user->phone_number ?: 'NA' }}</td>
                                                        <td>{{ $user->loan_amount ?: 'NA' }}</td>

                                                        <td>
                                                            @if ($user->kyc)
                                                                @if ($user->kyc->relationship_manager_verified)
                                                                    <span class="badge badge-success">Approved</span>
                                                                @else
                                                                    <span class="badge badge-danger">Rejected</span>
                                                                @endif
                                                            @else
                                                                <span class="badge badge-warning">Proccing...</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($user->kyc)
                                                                @if ($user->kyc->field_manager_verified)
                                                                    <span class="badge badge-success">Approved</span>
                                                                @else
                                                                    <span class="badge badge-danger">Rejected</span>
                                                                @endif
                                                            @else
                                                                <span class="badge badge-warning">Proccing...</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($user->kyc)
                                                                @if ($user->kyc->relationship_manager_verified == 0)
                                                                    <span class="badge badge-warning">Relationship Manager
                                                                        Processing</span>
                                                                @elseif ($user->kyc->relationship_manager_verified == 0)
                                                                    <span class="badge badge-warning">Filed Manager
                                                                        Processing</span>
                                                                @elseif ($user->kyc->relationship_manager_verified == 1 && $user->kyc->field_manager_verified == 1)
                                                                    <span class="badge badge-success">Approved</span>
                                                                @elseif (
                                                                    $user->kyc->is_verified == 1 &&
                                                                        $user->kyc->relationship_manager_verified == 1 &&
                                                                        $user->kyc->field_manager_verified == 1)
                                                                    <span class="badge badge-success">admin
                                                                        Approved</span>
                                                                @elseif ($user->kyc->is_verified == 0)
                                                                    <span class="badge badge-danger">admin
                                                                        Rejected</span>
                                                                @elseif ($user->kyc->relationship_manager_verified == 1 && $user->kyc->field_manager_verified == 0)
                                                                    <span class="badge badge-warning">Relation Manager
                                                                        Processing</span>
                                                                @elseif ($user->kyc->field_manager_verified == 0)
                                                                    <span class="badge badge-warning">Field Manager
                                                                        Processing</span>
                                                                @else
                                                                    <span class="badge badge-warning">Processing...</span>
                                                                @endif
                                                            @else
                                                                <span class="badge badge-warning">Processing...</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <form
                                                                action="{{ route('user.kyc.CustomerKYCVerified', ['user' => $user->id]) }}"
                                                                method="POST" id="kyc-form-{{ $user->id }}">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <div class="custom-control custom-switch">
                                                                        <input type="hidden" name="is_verified"
                                                                            value="0">
                                                                        <!-- Hidden input for unchecked state -->
                                                                        <input type="checkbox"
                                                                            class="custom-control-input kyc-switch"
                                                                            id="verified_{{ $user->id }}"
                                                                            name="is_verified" value="1"
                                                                            {{ $user->kyc && $user->kyc->is_verified ? 'checked' : '' }}>
                                                                        <label class="custom-control-label"
                                                                            for="verified_{{ $user->id }}">Verified</label>
                                                                    </div>
                                                                </div>
                                                                <div class="loading-spinner"
                                                                    id="spinner-{{ $user->id }}"
                                                                    style="display: none;"></div>
                                                            </form>
                                                        </td>


                                                        <td>
                                                            <div class="form-group">
                                                                <label for="reason">Reason</label>
                                                                <textarea class="form-control" id="reason" name="reason">{{ $user->kyc->reason ?? '' }}</textarea>
                                                            </div>
                                                        </td>
                                                        <td>{{ $user->kyc->aadhar_number ?? 'NA' }}</td>
                                                        <td>{{ $user->kyc->pan_number ?? 'NA' }}</td>
                                                        <td>{{ $user->kyc->account_number ?? 'NA' }}</td>
                                                        <td>{{ $user->kyc->ifsc_code ?? 'NA' }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
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

<style>
    .loading-spinner {
        display: inline-block;
        width: 24px;
        height: 24px;
        border: 3px solid rgba(0, 0, 0, 0.3);
        border-radius: 50%;
        border-top-color: #000;
        animation: spin 1s ease-in-out infinite;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const switches = document.querySelectorAll('.kyc-switch');

        switches.forEach(switchElement => {
            switchElement.addEventListener('change', function() {

                const formId = this.id.replace('verified_', 'kyc-form-');
                const spinnerId = this.id.replace('verified_', 'spinner-');

                document.getElementById(spinnerId).style.display = 'block';

                document.getElementById(formId).submit();
            });
        });
    });
</script>



@section('modal')
@endsection


@section('script')
@endsection
