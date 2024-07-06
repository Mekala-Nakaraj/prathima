<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\UserManagementController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

Route::controller(LoginController::class)->group(function () {
    Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    /* Forgotpassword */
    Route::get('/forget-password', [LoginController::class, 'ForgetPassword'])->name('ForgetPassword');
    /* Register */
    Route::get('/register', [LoginController::class, 'showRegisterForm'])->name('showRegisterForm');
    Route::post('/register', [LoginController::class, 'register'])->name('register');
    // Route::get('/send-otp', [LoginController::class, 'sendOtp'])->name('sendOtp');
    // Route::post('/send-otp', [LoginController::class, 'sendOtp'])->name('sendOtp');
    // Route::get('/verify-otp', [LoginController::class, 'verifyOtp'])->name('verifyOtp');
    // Route::post('/verify-otp', [LoginController::class, 'verifyOtp'])->name('verifyOtp');
    Route::get('forgot-password', [LoginController::class, 'showForgotPasswordForm'])->name('forgotPassword');
    Route::post('forgot-password/send-otp', [LoginController::class, 'sendOtp'])->name('sendOtp');
    Route::post('forgot-password/verify-otp', [LoginController::class, 'verifyOtp'])->name('verifyOtp');

    /* Login Redirect */
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [LoginController::class, 'dashboard'])->name('dashboard');
    });
   
});


Route::controller(ForgotPasswordController::class)->group(function () {
    Route::get('/forget-password', [ForgotPasswordController::class, 'ForgetPassword'])->name('ForgetPassword');
    // Route::get('/send-otp', [ForgotPasswordController::class, 'sendOtp'])->name('sendOtp');
    // Route::post('/send-otp', [ForgotPasswordController::class, 'sendOtp'])->name('sendOtp');
    // Route::get('/verify-otp', [ForgotPasswordController::class, 'verifyOtp'])->name('verifyOtp');
    // Route::post('/verify-otp', [ForgotPasswordController::class, 'verifyOtp'])->name('verifyOtp');
    Route::get('forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('forgotPassword');
    Route::post('forgot-password/send-otp', [ForgotPasswordController::class, 'sendOtp'])->name('sendOtp');
    Route::post('forgot-password/verify-otp', [ForgotPasswordController::class, 'verifyOtp'])->name('verifyOtp');
   
});

//User Management
Route::controller(UserManagementController::class)->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/profile', 'ProfileShow')->name('ProfileShow');
        Route::post('/profile', 'profileUpdate')->name('profileUpdate');
        Route::post('/profile-kyc', 'ProfileupdateKyc')->name('ProfileupdateKyc');
    

        Route::get('/admin/customer', 'CustomerManagement')->name('CustomerManagement');
        Route::post('/admin/customer', 'CustomerManagementStore')->name('CustomerManagementStore');
        Route::get('/admin/customer-kyc', 'CustomerKYC')->name('CustomerKYC');
        Route::post('/admin/customer-kyc/update/{user}', 'CustomerKYCVerified')->name('user.kyc.CustomerKYCVerified');

        /* customer loan */
        Route::get('/admin/customer/loan-list', 'CustomerLoan')->name('CustomerLoan');
    });
   
    // Route::post('/admin/customer-kyc', 'CustomerKYCVerified')->name('CustomerKYCVerified');
    
});