<?php
use Illuminate\Support\Facades\Route;
Route::group([
    'prefix'=>'hospital', 
    'namespace'=>'App\Http\Controllers\Hospital', 
    'middleware'=>['web']], function(){
        
    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('hospital.login');
    Route::post('/', 'Auth\LoginController@validateLogin')->name('hospital.login.submit');
   
    Route::group(['middleware' => ['auth:hospital']], function () {
    
        Route::post('/logout', 'Auth\LoginController@logout')->name('hospital.logout');
    
        //dashboard routes
        Route::group(['prefix' => 'dashboard'], function () {
            
            //url to dashboard page
            Route::get('/', 'DashboardController@index')->name('hospital.dashboard');
        });
    });
});