@extends('backend.layout.app')

@section('title', 'Customer')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/plugins/table/datatable/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/plugins/table/datatable/dt-global_style.css') }}">
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
                                <li class="breadcrumb-item active" aria-current="page"><span>Customer</span></li>
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
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 layout-spacing">
                        <div class="widget-content widget-content-area">
                            <!-- Button to show the form -->
                            <div class="text-start">
                                <button type="button" class="btn btn-primary mb-2 mr-2" onclick="showCustomerForm()">
                                    Create a Customer
                                </button>
                                @if (session('success'))
                                    <div class="alert alert-success mt-3">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @if ($errors->any())
                                    <div class="alert alert-danger mt-3">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Form --}}
        <div class="container-fluid" id="customerFormContainer" style="display: none;">
            <div class="row">
                <div class="col-lg-12 layout-spacing">
                    <div class="statbox widget box box-shadow mb-4">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Create a Customer</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <form id="customerForm" action="{{ route('CustomerManagementStore') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-lg-4">
                                        <label>Username:</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" placeholder="Enter username" value="{{ old('name') }}"
                                            required>
                                        <span class="form-text text-muted">Please enter your username</span>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Email:</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            name="email" placeholder="Enter email" value="{{ old('email') }}" required>
                                        <span class="form-text text-muted">Please enter your email</span>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Contact:</label>
                                        <input type="text"
                                            class="form-control @error('phone_number') is-invalid @enderror"
                                            name="phone_number" placeholder="Enter contact number"
                                            value="{{ old('phone_number') }}" required>
                                        <span class="form-text text-muted">Please enter your contact number</span>
                                        @error('phone_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- <div class="form-group row">
                                    <div class="col-lg-4">
                                        <label>Password:</label>
                                        <input type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            placeholder="Enter password" required>
                                        <span class="form-text text-muted">Please enter your password</span>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Confirm Password:</label>
                                        <input type="password"
                                            class="form-control @error('password_confirmation') is-invalid @enderror"
                                            name="password_confirmation" placeholder="Confirm password" required>
                                        <span class="form-text text-muted">Please confirm your password</span>
                                        @error('password_confirmation')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div> --}}
                                <div class="form-group row">
                                    <div class="col-lg-4">
                                        <label>Pincode:</label>
                                        <input type="text" class="form-control @error('pincode') is-invalid @enderror"
                                            name="pincode" placeholder="Enter pincode" value="{{ old('pincode') }}"
                                            required>
                                        <span class="form-text text-muted">Please enter your pincode</span>
                                        @error('pincode')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-4">
                                        <label>City:</label>
                                        <input type="text" class="form-control @error('city') is-invalid @enderror"
                                            name="city" placeholder="Enter city" value="{{ old('city') }}"
                                            required>
                                        <span class="form-text text-muted">Please enter your city</span>
                                        @error('city')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-4">
                                        <label>District:</label>
                                        <input type="text" class="form-control @error('district') is-invalid @enderror"
                                            name="district" placeholder="Enter district" value="{{ old('district') }}"
                                            required>
                                        <span class="form-text text-muted">Please enter your district</span>
                                        @error('district')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-4">
                                        <label>State:</label>
                                        <input type="text" class="form-control @error('state') is-invalid @enderror"
                                            name="state" placeholder="Enter state" value="{{ old('state') }}"
                                            required>
                                        <span class="form-text text-muted">Please enter your state</span>
                                        @error('state')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Country:</label>
                                        <input type="text" class="form-control @error('country') is-invalid @enderror"
                                            name="country" placeholder="Enter country" value="{{ old('country') }}"
                                            required>
                                        <span class="form-text text-muted">Please enter your country</span>
                                        @error('country')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Gas Bill:</label>
                                        <input type="file"
                                            class="form-control @error('gas_bill') is-invalid @enderror" name="gas_bill"
                                            required>
                                        <span class="form-text text-muted">Please upload your gas bill (PDF)</span>
                                        @error('gas_bill')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-4">
                                        <label>Salary Slip:</label>
                                        <input type="file"
                                            class="form-control @error('salary_slip') is-invalid @enderror"
                                            name="salary_slip" required>
                                        <span class="form-text text-muted">Please upload your salary slip (PDF)</span>
                                        @error('salary_slip')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Gas Bill Number:</label>
                                        <input type="text"
                                            class="form-control @error('gas_bill_number') is-invalid @enderror"
                                            name="gas_bill_number" placeholder="Enter gas bill number"
                                            value="{{ old('gas_bill_number') }}" required>
                                        <span class="form-text text-muted">Please enter your gas bill number</span>
                                        @error('gas_bill_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Salary Slip Number:</label>
                                        <input type="text"
                                            class="form-control @error('salary_slip_number') is-invalid @enderror"
                                            name="salary_slip_number" placeholder="Enter salary slip number"
                                            value="{{ old('salary_slip_number') }}" required>
                                        <span class="form-text text-muted">Please enter your salary slip number</span>
                                        @error('salary_slip_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="widget-footer text-right">
                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                    <button type="button" class="btn btn-outline-primary"
                                        onclick="hideCustomerForm()">Cancel</button>
                                </div>
                            </form>


                        </div>
                    </div>
                </div>



            </div>
        </div>
        {{-- Table --}}
        <div class="col-lg-12 layout-spacing">
            <div class="widget-content widget-content-area">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Pincode</th>
                                <th>City</th>
                                <th>District</th>
                                <th>State</th>
                                <th>Gas Bill</th>
                                <th>Gas Bill Document</th>
                                <th>Salary Slip</th>
                                <th>Salary Slip Document</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $index => $user)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone_number }}</td>
                                    <td>{{ $user->pincode }}</td>
                                    <td>{{ $user->city }}</td>
                                    <td>{{ $user->district }}</td>
                                    <td>{{ $user->state }}</td>
                                    <td>{{ $user->gas_bill_number }}</td>
                                    <td>
                                        @if ($user->gas_bill_path)
                                            <a href="{{ asset('public/' . $user->gas_bill_path) }}" target="_blank">View PDF</a>
                                        @else
                                            No Document
                                        @endif
                                    </td>
                                    <td>{{ $user->salary_slip_number }}</td>
                                    <td>
                                        @if ($user->salary_slip_path)
                                            <a href="{{ asset('public/' . $user->salary_slip_path) }}" target="_blank">View PDF</a>
                                        @else
                                            No Document
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-primary btn-sm">Edit</button>
                                        <button class="btn btn-danger btn-sm">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- {{ $users->links() }} --}}
                </div>
            </div>
        </div>


    </div>

@endsection

<script>
    document.getElementById('customerForm').addEventListener('submit', function(event) {
        event.preventDefault();

        // Password and confirm password validation
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirmPassword').value;

        if (password !== confirmPassword) {
            alert("Passwords do not match")
            document.getElementById('passwordError').textContent = "Passwords do not match.";
            document.getElementById('confirmPasswordError').textContent = "Passwords do not match.";
            return;
        } else {
            document.getElementById('passwordError').textContent = "";
            document.getElementById('confirmPasswordError').textContent = "";
        }

        let formData = new FormData(this);
        for (const entry of formData.entries()) {
            console.log(entry[0] + ': ' + entry[1]);
        }
        hideCustomerForm();
    });
    // Function to show the customer form
    function showCustomerForm() {
        document.getElementById('customerFormContainer').style.display = 'block';
    }

    // Function to hide the customer form
    function hideCustomerForm() {
        document.getElementById('customerFormContainer').style.display = 'none';
    }
</script>
<script>
    document.getElementById('customerForm').addEventListener('submit', function(event) {
        event.preventDefault();

        // Password and confirm password validation
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirmPassword').value;

        if (password !== confirmPassword) {
            alert("Passwords do not match")
            document.getElementById('passwordError').textContent = "Passwords do not match.";
            document.getElementById('confirmPasswordError').textContent = "Passwords do not match.";
            // console.log(password)
            return;
        } else {
            document.getElementById('passwordError').textContent = "";
            document.getElementById('confirmPasswordError').textContent = "";
        }

        let formData = new FormData(this);
        for (const entry of formData.entries()) {
            console.log(entry[0] + ': ' + entry[1]);
        }
        hideCustomerForm();
    });
</script>
<script>
    $(document).ready(function() {
        $('#basic-dt').DataTable({
            "language": {
                "paginate": {
                    "previous": "<i class='las la-angle-left'></i>",
                    "next": "<i class='las la-angle-right'></i>"
                }
            },
            "lengthMenu": [5, 10, 15, 20],
            "pageLength": 5
        });
        $('#dropdown-dt').DataTable({
            "language": {
                "paginate": {
                    "previous": "<i class='las la-angle-left'></i>",
                    "next": "<i class='las la-angle-right'></i>"
                }
            },
            "lengthMenu": [5, 10, 15, 20],
            "pageLength": 5
        });
        $('#last-page-dt').DataTable({
            "pagingType": "full_numbers",
            "language": {
                "paginate": {
                    "first": "<i class='las la-angle-double-left'></i>",
                    "previous": "<i class='las la-angle-left'></i>",
                    "next": "<i class='las la-angle-right'></i>",
                    "last": "<i class='las la-angle-double-right'></i>"
                }
            },
            "lengthMenu": [3, 6, 9, 12],
            "pageLength": 3
        });
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var min = parseInt($('#min').val(), 10);
                var max = parseInt($('#max').val(), 10);
                var age = parseFloat(data[3]) || 0; // use data for the age column
                if ((isNaN(min) && isNaN(max)) ||
                    (isNaN(min) && age <= max) ||
                    (min <= age && isNaN(max)) ||
                    (min <= age && age <= max)) {
                    return true;
                }
                return false;
            }
        );
        var table = $('#range-dt').DataTable({
            "language": {
                "paginate": {
                    "previous": "<i class='las la-angle-left'></i>",
                    "next": "<i class='las la-angle-right'></i>"
                }
            },
            "lengthMenu": [5, 10, 15, 20],
            "pageLength": 5
        });
        $('#min, #max').keyup(function() {
            table.draw();
        });
        $('#export-dt').DataTable({
            dom: '<"row"<"col-md-6"B><"col-md-6"f> ><""rt> <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>>',
            buttons: {
                buttons: [{
                        extend: 'copy',
                        className: 'btn btn-primary'
                    },
                    {
                        extend: 'csv',
                        className: 'btn btn-primary'
                    },
                    {
                        extend: 'excel',
                        className: 'btn btn-primary'
                    },
                    {
                        extend: 'pdf',
                        className: 'btn btn-primary'
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-primary'
                    }
                ]
            },
            "language": {
                "paginate": {
                    "previous": "<i class='las la-angle-left'></i>",
                    "next": "<i class='las la-angle-right'></i>"
                }
            },
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 7
        });
        // Add text input to the footer
        $('#single-column-search tfoot th').each(function() {
            var title = $(this).text();
            $(this).html('<input type="text" class="form-control" placeholder="Search ' + title +
                '" />');
        });
        // Generate Datatable
        var table = $('#single-column-search').DataTable({
            "language": {
                "paginate": {
                    "previous": "<i class='las la-angle-left'></i>",
                    "next": "<i class='las la-angle-right'></i>"
                }
            },
            "lengthMenu": [5, 10, 15, 20],
            "pageLength": 5
        });
        // Search
        table.columns().every(function() {
            var that = this;
            $('input', this.footer()).on('keyup change', function() {
                if (that.search() !== this.value) {
                    that
                        .search(this.value)
                        .draw();
                }
            });
        });
        var table = $('#toggle-column').DataTable({
            "language": {
                "paginate": {
                    "previous": "<i class='las la-angle-left'></i>",
                    "next": "<i class='las la-angle-right'></i>"
                }
            },
            "lengthMenu": [5, 10, 15, 20],
            "pageLength": 5
        });
        $('a.toggle-btn').on('click', function(e) {
            e.preventDefault();
            // Get the column API object
            var column = table.column($(this).attr('data-column'));
            // Toggle the visibility
            column.visible(!column.visible());
            $(this).toggleClass("toggle-clicked");
        });
    });
</script>


@section('modal')
@endsection

@section('script')

    <script src="{{ asset('backend/plugins/table/datatable/datatables.js') }}"></script>

    <script src="{{ asset('backend/plugins/table/datatable/button-ext/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/table/datatable/button-ext/jszip.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/table/datatable/button-ext/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/table/datatable/button-ext/buttons.print.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/table/datatable/button-ext/pdfmake.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/table/datatable/button-ext/vfs_fonts.js') }}"></script>
@endsection
