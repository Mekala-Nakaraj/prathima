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
                    <h6 class="right-bar-heading px-3 mt-2 text-dark text-center font-30 text-uppercase">Login</h6>
                    <p class="text-center text-muted mt-1 mb-3 font-14">Please Log into your account</p>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Username (can be email or phone number) -->
                        <div class="login-two-inputs mt-5">
                            <input id="username" type="text" name="username" placeholder="Email or Phone Number"
                                required autofocus>
                            <i class="las la-user-alt"></i>
                        </div>

                        <!-- Password -->
                        <div class="login-two-inputs mt-4">
                            <input id="password" type="password" name="password" placeholder="Password" required>
                            <i class="las la-lock"></i>
                        </div>

                        <!-- Remember Me Checkbox (if needed) -->
                        <div class="login-two-inputs mt-4 check">
                            <div class="box">
                                <input id="remember" type="checkbox" name="remember">
                                <span class="check"></span>
                                <label for="remember">Remember me</label>
                            </div>
                        </div>

                        <!-- Login Button -->
                        <div class="login-two-inputs mt-5 text-center">
                            <button type="submit" class="ripple-button ripple-button-primary w-100 btn-login">
                                <div class="ripple-ripple js-ripple">
                                    <span class="ripple-ripple__circle"></span>
                                </div>
                                Login
                            </button>
                        </div>
                        @error('username')
                        <div class="alert alert-danger mt-3">{{ $message }}</div>
                        @enderror
                    </form>


                    <!-- Signup Link -->
                    {{-- <div class="text-center mt-3">
                        <a class="btn btn-sm btn-outline-primary btn-login" href="{{ route('register') }}" type="button">
                            Sign Up
                        </a>
                    </div> --}}

                    <!-- Forgot Password Link -->
                    <div class="mt-4 text-center font-12 strong">
                        <a href="" class="text-primary">Forgot your Password?</a>
                    </div>

                    <!-- Social Logins Section - Modify as per your layout -->
                    <div class="login-two-inputs mt-4">
                        <div class="find-us-container">
                            <p class="find-us text-center">Continue With</p>
                        </div>
                    </div>
                    <div class="login-two-inputs social-logins mt-4">
                        <div class="social-btn"><a href="javascript:void(0)" class="fb-btn"><i
                                    class="lab la-facebook-f"></i></a></div>
                        <div class="social-btn"><a href="javascript:void(0)" class="twitter-btn"><i
                                    class="lab la-twitter"></i></a></div>
                        <div class="social-btn"><a href="javascript:void(0)" class="google-btn"><i
                                    class="lab la-google-plus"></i></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <link href="{{ asset('assets/css/authentication/auth_2.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/loader.css') }}" rel="stylesheet" type="text/css" />
    <!-- Any additional styles specific to this page -->
@endsection

@section('scripts')
    <!-- Any additional scripts specific to this page -->
@endsection
