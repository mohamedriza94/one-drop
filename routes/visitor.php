<?php
use Illuminate\Support\Facades\Route;
Route::group([
    'prefix'=>'visitor', 
    'namespace'=>'App\Http\Controllers\Visitor', 
    'middleware'=>['web']], function(){
    
    //dashboard routes
    Route::group(['prefix' => 'dashboard'], function () {
        
        Route::get('/home', 'homeController@index')->name('visitor.home');
        Route::post('/makeARequest', 'requestController@makeARequest');
        Route::post('/makeDonorRequest', 'donorRequestController@makeDonorRequest');
        Route::post('/makeInquiry', 'inquiryController@makeInquiry');

    });

    
   
});