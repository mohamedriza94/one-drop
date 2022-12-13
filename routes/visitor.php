<?php
use Illuminate\Support\Facades\Route;
Route::group([
    'prefix'=>'visitor', 
    'namespace'=>'App\Http\Controllers\Visitor', 
    'middleware'=>['web']], function(){
        
        //dashboard routes
        Route::group(['prefix' => 'dashboard'], function () {
            
            //index route
            Route::get('/home', 'homeController@index')->name('visitor.home');
            
            //blood requests routes
            Route::post('/makeARequest', 'requestController@makeARequest');
            Route::get('/trackBloodRequest/{id}', 'requestController@trackBloodRequest');
            
            //donor requests routes
            Route::post('/makeDonorRequest', 'donorRequestController@makeDonorRequest');
            
            //message routes
            Route::post('/makeInquiry', 'inquiryController@makeInquiry');
            
            //news routes
            Route::get('/news', 'newsController@index')->name('visitor.news');
            Route::get('/fetchNewsAndUpdates', 'newsController@fetchNewsAndUpdates');
            Route::get('/fetchUpdates_ForHomePage', 'newsController@fetchUpdates_ForHomePage');
            Route::get('/fetchCampainTags_ForHomePage/{campaignId}', 'newsController@fetchCampainTags_ForHomePage');
            Route::get('/fetchSingleNews/{id}', 'newsController@fetchSingleNews');

            //see campaigns
            Route::get('/seeCampaign/{id}', 'newsController@seeCampaignPage');
            
            //navigate to donor login
            Route::get('/donorLogin', 'homeController@donorLogin')->name('visitor.donorLogin');
            
            //HomePage statistics routes
            Route::get('/homePageStatistics', 'homeController@homePageStatistics');
        });
        
        
        
    });