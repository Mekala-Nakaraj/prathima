@extends('backend.layout.LoginApp')

@section('title', 'Login')

@section('body-class', 'login-two')

@section('content')

@section('content')
    <div class="container-fluid login-two-container">
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

        <div class="row main-login-two">
            <div class="col-md-12 p-0">
                <div class="login-bg">
                    <div class="center-two-start">
                        <h6 class="right-bar-heading px-3 mt-2 text-dark text-center font-30 text-uppercase">Forgot Password?
                        </h6>

                        <!-- OTP Form -->
                        <form id="otpForm" method="POST" action="{{ route('sendOtp') }}"
                            style="display: {{ session('success') ? 'none' : 'block' }};">
                            @csrf
                            <div class="login-two-inputs mt-5 text-dark">
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
                                <input type="text" placeholder="Email or Phone Number" id="emailOrPhoneInput"
                                    name="email_or_phone" class="text-dark"
                                    value="{{ old('email_or_phone', session('input')) }}" required />
                                <i class="las la-envelope la-phone"></i>
                                <span class="text-danger" id="emailOrPhoneError" style="display:none;">Please enter a valid
                                    email or phone number.</span>
                            </div>
                            <div class="login-two-inputs mt-5 text-center d-flex">
                                <button class="ripple-button ripple-button-primary w-100 btn-login ml-3 mr-3" type="submit"
                                    id="getCodeButton">
                                    <div class="ripple-ripple js-ripple">
                                        <span class="ripple-ripple__circle"></span>
                                    </div>
                                    Get Validation Code
                                </button>
                            </div>
                        </form>

                        <!-- Password Reset Form -->
                        <div class="form-2" id="form-2" style="display: {{ session('success') ? 'block' : 'none' }};">
                            @if (session('success'))
                                <div class="alert alert-success mt-3">
                                    {{ session('success') }}
                                </div>
                                <p class="text-center text-dark mt-3 mb-3 font-14">A verification code has been sent to your
                                    email or phone</p>
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
                            <form id="resetPasswordForm" method="POST" action="{{ route('verifyOtp') }}">
                                @csrf
                                <input type="hidden" name="email_or_phone" value="{{ session('input') }}">
                                <div class="digit-group mt-5" data-group-name="digits" data-autosubmit="false"
                                    autocomplete="off">
                                    <input type="text" id="digit-1" name="otp[]" class="digit" maxlength="1"
                                        required />
                                    <input type="text" id="digit-2" name="otp[]" class="digit" maxlength="1"
                                        required />
                                    <input type="text" id="digit-3" name="otp[]" class="digit" maxlength="1"
                                        required />
                                    <span class="splitter">&ndash;</span>
                                    <input type="text" id="digit-4" name="otp[]" class="digit" maxlength="1"
                                        required />
                                    <input type="text" id="digit-5" name="otp[]" class="digit" maxlength="1"
                                        required />
                                    <input type="text" id="digit-6" name="otp[]" class="digit" maxlength="1"
                                        required />
                                </div>
                                <div class="login-two-inputs mt-4">
                                    <input type="password" placeholder="New Password" required id="newPassword"
                                        name="password" />
                                    <i class="las la-lock"></i>
                                    <span class="text-danger" id="passwordError" style="display:none;">Password must be at
                                        least 8 characters long and include at least one uppercase letter, one lowercase
                                        letter, one number, and one special character.</span>
                                </div>
                                <div class="login-two-inputs mt-3">
                                    <input type="password" placeholder="Confirm Password" required id="confirmPassword"
                                        name="password_confirmation" />
                                    <i class="las la-lock"></i>
                                    <span class="text-danger" id="confirmPasswordError" style="display:none;">Passwords do
                                        not match.</span>
                                    <span class="text-danger" id="otpError" style="display:none;">Invalid or expired OTP.
                                        Please try again.</span>
                                </div>
                                <div class="login-two-inputs text-center mt-4">
                                    <button class="ripple-button ripple-button-primary btn-lg btn-login" type="submit"
                                        id="changePasswordButton">
                                        <div class="ripple-ripple js-ripple">
                                            <span class="ripple-ripple__circle"></span>
                                        </div>
                                        Change Password
                                    </button>
                                </div>
                                <div class="login-two-inputs mt-3 text-center font-12 strong">
                                    <a href="javascript:void(0)" class="text-primary" id="changeEmailOrPhone">Change your
                                        email or phone number</a>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('resetPasswordForm').addEventListener('submit', function(event) {
            var newPassword = document.getElementById('newPassword').value;
            var confirmPassword = document.getElementById('confirmPassword').value;
            var passwordError = document.getElementById('passwordError');
            var confirmPasswordError = document.getElementById('confirmPasswordError');

            // Reset error messages
            passwordError.style.display = 'none';
            confirmPasswordError.style.display = 'none';

            // Password validation regex (if needed)
            // var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{8,}$/;

            if (newPassword !== confirmPassword) {
                event.preventDefault();
                confirmPasswordError.style.display = 'block';
                alert('Passwords do not match.');
            } else {
                // Passwords match, form will be submitted
               
            }
        });
        // document.getElementById('resetPasswordForm').addEventListener('submit', function(event) {
        //     var newPassword = document.getElementById('newPassword').value;
        //     var confirmPassword = document.getElementById('confirmPassword').value;
        //     var passwordError = document.getElementById('passwordError');
        //     var confirmPasswordError = document.getElementById('confirmPasswordError');

        //     // Reset error messages
        //     passwordError.style.display = 'none';
        //     confirmPasswordError.style.display = 'none';
        //     console.log('password')
        //     // Password validation regex
        //     // var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{8,}$/;

        //     if (!passwordRegex.test(newPassword)) {
        //         console.log('password match')
        //         passwordError.style.display = 'block';
        //         event.preventDefault();
        //     } else if (newPassword !== confirmPassword) {
        //         event.preventDefault();
        //         console.log('password not match')
        //         alert('Passwords do not match.');
        //         confirmPasswordError.style.display = 'block';
        //         event.preventDefault();
        //     } else {
        //         alert('Passwords match! Form will be submitted.');
        //     }
        // });

        document.getElementById('getCodeButton').addEventListener('click', function(event) {
            event.preventDefault();
            var emailOrPhone = document.getElementById('emailOrPhoneInput').value;
            if (emailOrPhone.length === 10 || emailOrPhone.includes('@')) {
                document.getElementById('otpForm').submit();
            } else {
                document.getElementById('emailOrPhoneError').style.display = 'block';
            }
        });

        document.getElementById('changeEmailOrPhone').addEventListener('click', function() {
            document.getElementById('form-2').style.display = 'none';
            document.getElementById('otpForm').style.display = 'block';
        });
    </script>
@endsection




@endsection

@section('styles')
<link href="{{ asset('assets/css/authentication/auth_2.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/css/loader.css') }}" rel="stylesheet" type="text/css" />
<!-- Any additional styles specific to this page -->
@endsection

@section('scripts')
{{-- <script>
    document.getElementById('getCodeButton').addEventListener('click', function() {
        var phoneNumber = document.getElementById('phoneNumberInput').value;
        if (phoneNumber.length === 10) {
            // Send AJAX request to send OTP
            fetch('/send-otp', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        phone_number: phoneNumber
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.querySelector('.form-1').style.display = 'none';
                        document.querySelector('.form-2').style.display = 'block';
                        Swal.fire({
                            icon: 'success',
                            title: 'OTP Sent!',
                            text: 'A verification code has been sent to your phone.'
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Failed to Send OTP',
                            text: data.message || 'Please try again.'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed to Send OTP',
                        text: 'Please try again later.'
                    });
                });
        } else {
            document.getElementById('phoneError').style.display = 'block';
        }
    });

    document.getElementById('changePasswordButton').addEventListener('click', function() {
        var otp = [
            document.getElementById('digit-1').value,
            document.getElementById('digit-2').value,
            document.getElementById('digit-3').value,
            document.getElementById('digit-4').value,
            document.getElementById('digit-5').value,
            document.getElementById('digit-6').value
        ].join('');
        var newPassword = document.getElementById('newPassword').value;
        var confirmPassword = document.getElementById('confirmPassword').value;

        if (newPassword !== confirmPassword) {
            Swal.fire({
                icon: 'error',
                title: 'Passwords do not match!',
                text: 'Please check your passwords.'
            });
            return;
        }

        // Send AJAX request to verify OTP and change password
        fetch('/verify-otp', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    otp: otp,
                    password: newPassword
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Password Changed!',
                        text: 'Your password has been changed successfully.'
                    }).then(() => {
                        window.location.href = '/login';
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed to Change Password',
                        text: data.message || 'Please verify your OTP and try again.'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Failed to Change Password',
                    text: 'Please try again later.'
                });
            });
    });
</script> --}}

{{-- <script>
    // resources/js/forget-password.js

    // Function to show OTP form and hide phone number form
    function showOtpForm() {
        $('.form-2').hide();
        $('#otpForm').hide();
    }

    // Function to handle digit inputs and auto-submit form
    $(document).ready(function() {
        $('.digit').keyup(function() {
            if ($(this).val().length == $(this).attr('maxlength')) {
                $(this).next('.digit').focus();
            }

            // Check if all digits are filled
            var allFilled = true;
            $('.digit').each(function() {
                if ($(this).val().length != $(this).attr('maxlength')) {
                    allFilled = false;
                    return false;
                }
            });

            if (allFilled) {
                $('#resetPasswordForm').submit();
            }
        });

        // Change phone number link click event
        $('#changePhoneNumber').click(function() {
            $('.form-2').hide();
            $('#otpForm').show();
        });
    });
</script> --}}


@endsection
