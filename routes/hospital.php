<?php
use Illuminate\Support\Facades\Route;
Route::group([
    'prefix'=>'hospital', 
    'namespace'=>'App\Http\Controllers\Hospital', 
    'middleware'=>['web']], function(){
        
    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('hospital.login');
    Route::post('/', 'Auth\LoginController@validateLogin')->name('hospital.login.submit');
    Route::get('/forgotPassword', 'Auth\ForgotPasswordController@showForgotPassword')->name('hospital.forgotPassword');
    Route::post('/sendVerificationCode/{email}', 'Auth\ForgotPasswordController@verifyEmail');
    Route::get('/verify/{typedCode}/{email}', 'Auth\ForgotPasswordController@verifyCode');
    Route::get('/resetPassword/{typedCode}/{email}/{password}', 'Auth\ForgotPasswordController@resetPassword');

   
    Route::group(['middleware' => ['auth:hospital']], function () {
    
        Route::post('/logout', 'Auth\LoginController@logout')->name('hospital.logout');
    
        //dashboard routes
        Route::group(['prefix' => 'dashboard'], function () {
            
            //url to dashboard page
            Route::get('/', 'DashboardController@index')->name('hospital.dashboard');
        });
    });
});