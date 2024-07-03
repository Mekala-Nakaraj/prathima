<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
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

    /* Login Redirect */
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [LoginController::class, 'dashboard'])->name('dashboard');
    });
   
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
    });
   
    // Route::post('/admin/customer-kyc', 'CustomerKYCVerified')->name('CustomerKYCVerified');
    
});