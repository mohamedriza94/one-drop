<?php
use Illuminate\Support\Facades\Route;
Route::group([
    'prefix'=>'donor', 
    'namespace'=>'App\Http\Controllers\Donor', 
    'middleware'=>['web']], function(){
        
    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('donor.login');
    Route::post('/', 'Auth\LoginController@validateLogin')->name('donor.login.submit');
    //Route::get('/forgotPassword', 'Auth\ForgotPasswordController@showForgotPassword')->name('donor.forgotPassword');
    //Route::post('/sendVerificationCode/{email}', 'Auth\ForgotPasswordController@verifyEmail');
    //Route::get('/verify/{typedCode}/{email}', 'Auth\ForgotPasswordController@verifyCode');
    //Route::get('/resetPassword/{typedCode}/{email}/{password}', 'Auth\ForgotPasswordController@resetPassword');

    Route::group(['middleware' => ['auth:donor']], function () {
    
    Route::post('/logout', 'Auth\LoginController@logout')->name('donor.logout');
    
    //dashboard routes
    Route::group(['prefix' => 'dashboard'], function () {
    
    //url to dashboard page
    Route::get('/', 'DashboardController@index')->name('donor.dashboard');
        });
    });
});