@extends('backend.layout.LoginApp')

@section('title', 'Login')

@section('body-class', 'login-two')


@section('content')
    <div class="container-fluid login-two-container">
        <div class="row main-login-two">
            <div class="col-xl-8 col-lg-7 col-md-7 d-none d-md-block p-0">
                <div class="login-bg">
                    <!-- Your existing left content -->
                </div>
            </div>
            <div class="col-xl-4 col-lg-5 col-md-5 p-0">
                <div class="login-two-start">
                    <h6 class="right-bar-heading px-3 mt-2 text-dark text-center font-30 text-uppercase">Registration</h6>
                    <p id="step-info" class="text-center text-muted mt-1 mb-3 font-14">Step 1 of 4 - Basic Details</p>
                    <form id="registration-form" method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Step 1: Basic Details -->
                        <div id="step-1" class="form-step">
                            <div class="login-two-inputs mt-3">
                                <input id="name" type="text" name="name" placeholder="Name" required autofocus>
                                <i class="las la-user-alt"></i>
                            </div>
                            <div class="login-two-inputs mt-3">
                                <input id="email" type="email" name="email" placeholder="Email" required>
                                <i class="las la-envelope"></i>
                            </div>
                            <div class="login-two-inputs mt-3">
                                <input id="alternative_email" type="email" name="alternative_email"
                                       placeholder="Alternative Email">
                                <i class="las la-envelope"></i>
                            </div>
                            <div class="login-two-inputs mt-3">
                                <input id="phone_number" type="text" name="phone_number" placeholder="Phone Number"
                                       required>
                                <i class="las la-mobile-alt"></i>
                            </div>
                            <div class="login-two-inputs mt-3 d-flex align-items-center">
                                <input id="otp_phone" type="text" name="otp_phone" placeholder="OTP (Phone Number)">
                                <button type="button" id="send-otp" class="btn btn-sm btn-primary ml-2">Send OTP</button>
                                <i class="las la-mobile-alt ml-2"></i>
                            </div>
                            <div class="form-navigation mt-4 text-center">
                                <button type="button" id="next-1" class="ripple-button ripple-button-primary btn-login">
                                    Next
                                </button>
                            </div>
                        </div>

                        <!-- Step 2: Location Details -->
                        <div id="step-2" class="form-step" style="display: none;">
                            <div class="login-two-inputs mt-3">
                                <input id="pincode" type="text" name="pincode" placeholder="Pincode" required>
                                <i class="las la-map-marker-alt"></i>
                            </div>
                            <div class="login-two-inputs mt-3">
                                <input id="city" type="text" name="city" placeholder="City" required>
                                <i class="las la-city"></i>
                            </div>
                            <div class="login-two-inputs mt-3">
                                <input id="district" type="text" name="district" placeholder="District" required>
                                <i class="las la-building"></i>
                            </div>
                            <div class="login-two-inputs mt-3">
                                <input id="state" type="text" name="state" placeholder="State" required>
                                <i class="las la-flag"></i>
                            </div>
                            <div class="login-two-inputs mt-3">
                                <input id="country" type="text" name="country" placeholder="Country" required>
                                <i class="las la-globe"></i>
                            </div>
                            <div class="form-navigation mt-4 text-center">
                                <button type="button" id="prev-2" class="ripple-button ripple-button-primary btn-login">
                                    Previous
                                </button>
                                <button type="button" id="next-2" class="ripple-button ripple-button-primary btn-login">
                                    Next
                                </button>
                            </div>
                        </div>

                        <!-- Step 3: Documents -->
                        <div id="step-3" class="form-step" style="display: none;">
                            <div class="login-two-inputs mt-3">
                                <input id="gas_bill" type="text" name="gas_bill" placeholder="Gas Bill">
                                <i class="las la-file-invoice-dollar"></i>
                            </div>
                            <div class="login-two-inputs mt-3">
                                <input id="salary_slip" type="text" name="salary_slip" placeholder="Salary Slip">
                                <i class="las la-file-invoice"></i>
                            </div>
                            <div class="form-navigation mt-4 text-center">
                                <button type="button" id="prev-3" class="ripple-button ripple-button-primary btn-login">
                                    Previous
                                </button>
                                <button type="button" id="next-3" class="ripple-button ripple-button-primary btn-login">
                                    Next
                                </button>
                            </div>
                        </div>

                        <!-- Step 4: Password -->
                        <div id="step-4" class="form-step" style="display: none;">
                            <div class="login-two-inputs mt-3">
                                <input id="password" type="password" name="password" placeholder="Password" required>
                                <i class="las la-lock"></i>
                            </div>
                            <div class="login-two-inputs mt-3">
                                <input id="password_confirmation" type="password" name="password_confirmation"
                                       placeholder="Confirm Password" required>
                                <i class="las la-lock"></i>
                            </div>
                            <div class="form-navigation mt-4 text-center">
                                <button type="button" id="prev-4" class="ripple-button ripple-button-primary btn-login">
                                    Previous
                                </button>
                                <button type="submit" class="ripple-button ripple-button-primary btn-login">
                                    Register
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('registration-form');
            const steps = form.querySelectorAll('.form-step');
            const stepInfo = document.getElementById('step-info');
            let currentStep = 0;
            let generatedOTP = '';

            // Function to generate a random 6-digit OTP
            function generateOTP() {
                return Math.floor(100000 + Math.random() * 900000);
            }

            // Function to send OTP (simulated for demo)
            function sendOTP() {
                generatedOTP = generateOTP(); // Generate OTP
                alert(`OTP sent to your phone number: ${generatedOTP}`);
            }

            // Function to validate OTP
            function validateOTP() {
                const otpInput = document.getElementById('otp_phone');
                const otpValue = otpInput.value.trim();

                if (otpValue === generatedOTP.toString()) {
                    return true;
                } else {
                    alert('Invalid OTP. Please enter the correct OTP.');
                    return false;
                }
            }

            function showStep(step) {
                steps.forEach((s, index) => {
                    if (index === step) {
                        s.style.display = 'block';
                    } else {
                        s.style.display = 'none';
                    }
                });
                updateStepInfo(step);
            }

            function updateStepInfo(step) {
                stepInfo.textContent = `Step ${step + 1} of ${steps.length} - ${getStepTitle(step)}`;
            }

            function getStepTitle(step) {
                switch (step) {
                    case 0:
                        return 'Basic Details';
                    case 1:
                        return 'Location Details';
                    case 2:
                        return 'Upload Documents';
                    case 3:
                        return 'Create Password';
                    default:
                        return '';
                }
            }

            function validateStep(step) {
                switch (step) {
                    case 0:
                        return true; // Basic validation for Step 1
                    case 1:
                        return true; // Basic validation for Step 2
                    case 2:
                        return true; // Basic validation for Step 3
                    case 3:
                        return validateOTP(); // Validate OTP for Step 4
                    default:
                        return true;
                }
            }

            function nextStep() {
                if (validateStep(currentStep)) {
                    currentStep++;
                    showStep(currentStep);
                }
            }

            function prevStep() {
                currentStep--;
                showStep(currentStep);
            }

            // Button event listeners
            document.getElementById('next-1').addEventListener('click', nextStep);
            document.getElementById('next-2').addEventListener('click', nextStep);
            document.getElementById('next-3').addEventListener('click', nextStep);
            document.getElementById('prev-2').addEventListener('click', prevStep);
            document.getElementById('prev-3').addEventListener('click', prevStep);
            document.getElementById('prev-4').addEventListener('click', prevStep);
            document.getElementById('send-otp').addEventListener('click', sendOTP);
        });
    </script>
@endsection




@section('styles')
    <link href="{{ asset('assets/css/authentication/auth_2.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/loader.css') }}" rel="stylesheet" type="text/css" />
    <!-- Any additional styles specific to this page -->
@endsection

@section('scripts')
    <!-- Any additional scripts specific to this page -->
@endsection
