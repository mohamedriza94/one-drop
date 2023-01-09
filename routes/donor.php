<?php
use Illuminate\Support\Facades\Route;
Route::group([
    'prefix'=>'donor', 
    'namespace'=>'App\Http\Controllers\Donor', 
    'middleware'=>['web']], function(){
        
        Route::get('/login', 'Auth\LoginController@showLoginForm')->name('donor.login');
        Route::post('/', 'Auth\LoginController@validateLogin')->name('donor.login.submit');
        Route::get('/forgotPassword', 'Auth\ForgotPasswordController@showForgotPassword')->name('donor.forgotPassword');
        Route::post('/sendVerificationCode/{email}', 'Auth\ForgotPasswordController@verifyEmail');
        Route::get('/verify/{typedCode}/{email}', 'Auth\ForgotPasswordController@verifyCode');
        Route::get('/resetPassword/{typedCode}/{email}/{password}', 'Auth\ForgotPasswordController@resetPassword');

        //set password route
        Route::get('setPassword/{no}', 'profileController@setPassword')->name('donor.setPassword'); //get page
        Route::post('setPassword/', 'profileController@submitPassword')->name('donor.setPassword.submit'); //form action
        
        Route::group(['middleware' => ['auth:donor']], function () {
            
            Route::post('/logout', 'Auth\LoginController@logout')->name('donor.logout');
            
            //dashboard routes
            Route::group(['prefix' => 'dashboard'], function () {
                
                //change password
                Route::put('/changePassword/{id}', 'profileController@changePassword');
                
                //url to dashboard page
                Route::get('/', 'DashboardController@index')->name('donor.dashboard');
                
                //blood requests routes
                Route::get('/fetchRequestHistory/{nic}', 'requestController@fetchRequestHistory');
                Route::get('/fetchRequestHistory/{nic}', 'requestController@fetchRequestHistory');
                
                //news routes
                Route::get('/news', 'newsController@index')->name('donor.news');
                
                //donation routes
                Route::get('/trackDonation/{id}', 'donationController@trackDonation');
                Route::get('/fetchDonationHistory', 'donationController@fetchDonationHistory');
                
                //HomePage statistics routes
                Route::get('/homePageStatistics', 'countController@homePageStatistics');

                //message routes
                Route::get('/message', 'messageController@index')->name('donor.message');
                Route::post('/sendMessage', 'messageController@sendMessage');
                Route::get('/fetchInbox', 'messageController@fetchInbox');
                Route::get('/fetchSent', 'messageController@fetchSent');
                Route::get('/fetchTrash', 'messageController@fetchTrash');
                Route::get('/fetchSingle/{id}', 'messageController@fetchSingle');
                Route::get('/fetchSenderOrReceiver/{senderOrReceiverId}/{sender}', 'messageController@fetchSenderOrReceiver');
                Route::post('/sendMessage', 'messageController@sendMessage');
                Route::put('/moveToTrash/{id}', 'messageController@moveToTrash');
                Route::put('/replyToMessage', 'messageController@replyToMessage');
                
                //notifications
                Route::get('/fetchNotifications', 'DashboardController@fetchNotifications');
                Route::put('/notifUpdate', 'DashboardController@notifUpdate');
                
            });
        });
    });