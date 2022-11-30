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
                
                
                //donor request management routes
                Route::post('/registerDonor', 'donorRegistrationController@registerDonor');
                
                //donor management routes
                Route::get('/donor', 'donorController@index')->name('hospital.donor');
                Route::get('/fetchDonor', 'donorController@fetchDonor');
                Route::get('/fetchActiveDonor', 'donorController@fetchActiveDonor');
                Route::get('/fetchInactiveDonor', 'donorController@fetchInactiveDonor');
                Route::get('/fetchSingleDonor/{id}', 'donorController@fetchSingleDonor');
                Route::get('/searchDonor/{input}', 'donorController@searchDonor');
                Route::put('/changeDonorStatus/{id}', 'donorController@changeDonorStatus');
                
                
                //blood bag management routes
                Route::get('/bloodBag', 'bloodBagController@index')->name('hospital.bloodBag');
                Route::get('/fetchBloodBags', 'bloodBagController@fetchBloodBags');
                Route::get('/fetchAvailableBloodBags', 'bloodBagController@fetchAvailableBloodBags');
                Route::get('/fetchExpiredBloodBags', 'bloodBagController@fetchExpiredBloodBags');
                Route::get('/fetchUsedBloodBags', 'bloodBagController@fetchUsedBloodBags');
                Route::get('/fetchCustomBloodBags/{bloodGroup}', 'bloodBagController@fetchCustomBloodBags');
                Route::get('/fetchSingleBloodBag/{bloodBagNo}', 'bloodBagController@fetchSingleBloodBag');
                
                //donation routes
                Route::get('/donate', 'donationController@OpenDonatePage')->name('hospital.donate');
                Route::get('/getDonor/{id}', 'donationController@getDonor');
                Route::post('/donate', 'donationController@donate');
                
                //donation details routes
                Route::get('/donation', 'donationController@index')->name('hospital.donation');
                Route::get('/fetchDonation', 'donationController@fetchDonation');
                
                //bloodRequest Routes
                Route::get('/bloodRequest', 'bloodRequestController@index')->name('hospital.bloodRequest');
                Route::get('/fetchRequest', 'bloodRequestController@fetchRequest');
                Route::get('/fetchPendingRequest', 'bloodRequestController@fetchPendingRequest');
                Route::get('/fetchRespondedRequest', 'bloodRequestController@fetchRespondedRequest');
                Route::get('/fetchRequest', 'bloodRequestController@fetchRequest');
                Route::get('/searchRequest/{input}', 'bloodRequestController@searchRequest');
                Route::get('/fetchSingleRequest/{id}', 'bloodRequestController@fetchSingleRequest');
                Route::put('/declineBloodRequest', 'bloodRequestController@declineBloodRequest');
                Route::put('/acceptBloodRequest', 'bloodRequestController@acceptBloodRequest');
                
                //bloodRequest - check blood availability
                Route::get('/fetchAvailableBlood/{bloodGroup}', 'bloodBagController@fetchAvailableBlood');
                
                //count routes
                Route::get('/otherCounts', 'countController@otherCounts');
                
                //blood group count routes
                Route::get('/countBloodBags_cat', 'countController@countBloodBags_cat');
                
                
                
                //donation tracking routes
                Route::get('/tracking', 'donationController@trackingPage')->name('hospital.tracking');
                Route::get('/trackDonation/{donationNo}', 'donationController@trackDonation');
                Route::get('/trackDonationReceiver/{receivedBloodBagNo}', 'donationController@trackDonationReceiver');
            });
        });
    });