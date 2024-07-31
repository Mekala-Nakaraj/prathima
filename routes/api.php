<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/




Route::group(['namespace' => 'api'], function () {

    Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
        Route::post('sign-up', 'AuthController@register');
        Route::post('verifymail', 'AuthController@verifymailOTP');
        Route::post('verifynumber', 'AuthController@verifynumber');

        Route::post('login', 'AuthController@login');
        Route::post('send-otp','AuthController@sendOTP');

    });

    Route::group(['prefix' => 'loan', 'middleware' => 'auth:sanctum'], function () {
        Route::post('user-kyc', 'UserLoanController@user_kyc');
        Route::post('edit-kyc', 'UserLoanController@edit_kyc');
        Route::post('update-kyc', 'UserLoanController@update_kyc');
        Route::post('kyc-status', 'UserLoanController@kyc_status');
        Route::post('user-edit', 'UserLoanController@edit_user');
        Route::post('user-update', 'UserLoanController@user_update');

        Route::get('loan-details', 'UserLoanController@get_loan_details');

        Route::post('pan-verify', 'UserLoanController@pan_verify');
        Route::post('bank-verify', 'UserLoanController@bank_verify');
        Route::post('aadhaar-verify', 'UserLoanController@aadhaar_verify');
        Route::post('aadhaar-otp-verify', 'UserLoanController@aadhaar_otp');

        Route::get('initial-loan-amount', 'UserLoanController@loan_amount');
    });

    Route::group(['prefix' => 'user', 'middleware' => 'auth:sanctum'], function () {
        Route::get('get', 'UserController@get_user');
    });


});
