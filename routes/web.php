<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\FieldManagerController;
use App\Http\Controllers\RelationManagerController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\SettingsController;

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

//FieldManagerController
Route::controller(FieldManagerController::class)->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/field-manager-dashboard', 'FieldManagerShow')->name('FieldManagerShow');
        Route::get('/field-manager/customer', 'FiledManagerCustomerKycShow')->name('field.FiledManagerCustomerKycShow');
        Route::post('/field-manager/customer-approve/{user}', 'updateFieldManagerVerification')->name('filed.kyc.CustomerKYCVerified');
    });   
});

//RelationManagerController
Route::controller(RelationManagerController::class)->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/relation-manager-dashboard', 'RelationManagerShow')->name('RelationManagerShow');
        Route::get('/relation-manager/customer', 'RelationManagerCustomerKycShow')->name('Relation.RelationManagerCustomerKycShow');
        Route::post('/relation-manager/customer/{user}', 'updateRelationManagerVerification')->name('Relation.kyc.CustomerKYCVerified');
    });   
});

// LoanController
Route::controller(LoanController::class)->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/admin/loan-details/{id}', 'LoanDeatilsShow')->name('admin.LoanDeatilsShow');
        Route::put('/admin/loan-details/{user}', 'LoanDeatilsstore')->name('admin.store.LoanDeatilsstore');
        Route::get('/admin/customer/profile-list/{id}', 'ProfileDeatilsShow')->name('admin.ProfileDeatilsShow');
    });   
});

// SettingsController
Route::controller(SettingsController::class)->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/admin/settings/payment-conf', 'PaymentConf')->name('settings.PaymentConf');
        Route::post('/admin/settings/payment-conf/update', 'PaymentConfStore')->name('settings.PaymentConfStore');
        Route::get('/admin/settings/loan-conf/initial-loan', 'InitialLoanConfShow')->name('settings.InitialLoanConfShow');
        Route::post('/admin/settings/loan-conf/initial-loan/update', 'InitialLoanConf')->name('settings.InitialLoanConf');
        Route::get('/admin/settings/mail-conf', 'EmailConfShow')->name('settings.EmailConfShow');
        Route::post('/admin/settings/mail-conf/update', 'EmailConfStore')->name('settings.EmailConfStore');
        Route::get('/admin/settings/sms-conf', 'SMSConfShow')->name('settings.SMSConfShow');
        Route::post('/admin/settings/sms-conf/update', 'SMSConfStore')->name('settings.SMSConfStore');

        Route::get('/admin/settings/sandbox', 'Sandbox')->name('settings.sanbox');
        Route::post('/admin/settings/sandbox-update', 'SandboxUpdate')->name('settings.sanbox.store');

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
        Route::post('/admin/customer-kyc/{user}', 'CustomerKYCReson')->name('user.kyc.CustomerKYCReson');

        /* customer loan */
        Route::get('/admin/customer/loan-list', 'CustomerLoan')->name('CustomerLoan');

        //Manager
        Route::get('/admin/manager/manager-create', 'ManagerCreateShow')->name('ManagerCreateShow');
        Route::get('/admin/manager/manager-list', 'ManagerShow')->name('ManagerShow');
        Route::post('/admin/manager/manager-create', 'ManagerCreateStore')->name('ManagerCreateStore');
        
    });
   
    // Route::post('/admin/customer-kyc', 'CustomerKYCVerified')->name('CustomerKYCVerified');
    
});

//CustomerKYCController
// Route::controller(CustomerKYCController::class)->group(function () {
//     Route::middleware('auth')->group(function () {
//         // Route::get('/admin/customer', 'CustomerManagement')->name('CustomerManagement');
//         // Route::post('/admin/customer', 'CustomerManagementStore')->name('CustomerManagementStore');
//         Route::get('/admin/customer-kyc', 'CustomerKYC')->name('CustomerKYC');
     
//     });
   
    
// });


