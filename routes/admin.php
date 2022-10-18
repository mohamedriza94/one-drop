<?php
use Illuminate\Support\Facades\Route;
Route::group([
    'prefix'=>'admin', 
    'namespace'=>'App\Http\Controllers\Admin', 
    'middleware'=>['web']], function(){
        
    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('/', 'Auth\LoginController@validateLogin')->name('admin.login.submit');
    Route::get('/forgotPassword', 'Auth\ForgotPasswordController@showForgotPassword')->name('admin.forgotPassword');
    Route::post('/sendVerificationCode/{email}', 'Auth\ForgotPasswordController@verifyEmail');
    Route::get('/verify/{typedCode}/{email}', 'Auth\ForgotPasswordController@verifyCode');
    Route::get('/resetPassword/{typedCode}/{email}/{password}', 'Auth\ForgotPasswordController@resetPassword');

    Route::post('/auth/register', 'Auth\RegisterController@registerAdmin');
    
    Route::group(['middleware' => ['auth:admin']], function () {
    
    Route::post('/logout', 'Auth\LoginController@logout')->name('admin.logout');
    
    //dashboard routes
    Route::group(['prefix' => 'dashboard'], function () {
    
    //url to dashboard page
    Route::get('/', 'DashboardController@index')->name('admin.dashboard');

    //profile management routes
    Route::post('/changeProfilePhoto/{id}', 'profileController@changeProfilePhoto');
    Route::get('/fetchProfile/{id}', 'profileController@fetchProfile');
    Route::put('/updateProfile/{id}', 'profileController@updateProfile');
    Route::put('/changePassword/{id}', 'profileController@changePassword');
    
    //===========================================================================
    //Admin routes---------------------------------------------------------------
    //
    //staff management routes
    Route::get('/staff', 'staffController@index')->name('admin.staff');
    Route::post('/insertStaff', 'staffController@addStaff');
    Route::get('/fetchStaff', 'staffController@fetchStaff');
    Route::get('/fetchActiveStaff', 'staffController@fetchActiveStaff');
    Route::get('/fetchInactiveStaff', 'staffController@fetchInactiveStaff');
    Route::get('/searchStaff/{input}', 'staffController@searchStaff');
    Route::get('/fetchSingleStaff/{id}', 'staffController@fetchSingleStaff');
    Route::put('/changeStatus/{id}', 'staffController@changeStatus');
    Route::post('/updateStaff/{id}', 'staffController@updateStaff');
    Route::delete('/deleteStaff/{id}', 'staffController@deleteStaff');
    Route::get('/fetchHospitalToAssign', 'staffController@fetchHospitalToAssign');
    Route::put('/appoint/{id}', 'staffController@appoint');
    Route::get('/fetchAssignedHospital/{id}', 'staffController@fetchAssignedHospital');

    //hospital management routes
    Route::get('/hospital', 'hospitalController@index')->name('admin.hospital');
    Route::post('/insertHospital', 'hospitalController@addHospital');
    Route::get('/fetchHospital', 'hospitalController@fetchHospital');
    Route::get('/fetchSingleHospital/{id}', 'hospitalController@fetchSingleHospital');
    Route::post('/updateHospital/{id}', 'hospitalController@updateHospital');
    Route::delete('/deleteHospital/{id}', 'hospitalController@deleteHospital');

    //message management routes
    Route::get('/staffMessage', 'staffMessageController@index')->name('admin.staffMessage');

    Route::get('/fetchStafflist', 'staffMessageController@fetchStafflist');
    Route::get('/fetchHospitallist', 'staffMessageController@fetchHospitallist');
    Route::post('/staff_sendMessage', 'staffMessageController@staff_sendMessage');
    Route::get('/staff_fetchInboxMessages', 'staffMessageController@staff_fetchInboxMessages');
    Route::get('/staff_fetchTrashMessages', 'staffMessageController@staff_fetchTrashMessages');
    Route::get('/staff_fetchSentMessages/{senderId}', 'staffMessageController@staff_fetchSentMessages');
    Route::put('/staff_MoveToTrash/{id}', 'staffMessageController@staff_moveToTrash');
    Route::get('/staff_fetchSingleMessage/{id}', 'staffMessageController@staff_fetchSingleMessage');
    Route::get('/staff_fetchSender/{senderId}/{sender}', 'staffMessageController@staff_fetchSender');

    //universal message reply route
    Route::post('/replyToMessage', 'staffMessageController@replyToMessage');
    Route::get('/fetchReply/{messageId}', 'staffMessageController@fetchReply');
    Route::put('/viewedReplyUpdateStatus/{id}', 'staffMessageController@viewedReplyUpdateStatus');
    
    //===========================================================================
    //Staff routes---------------------------------------------------------------
    //
    //message management routes 
    Route::get('staff/message', 'Staff\messageController@index')->name('admin.staffControls.message');

    Route::post('/sendMessage', 'Staff\messageController@sendMessage');
    Route::get('/fetchInboxMessages/{authId}', 'Staff\messageController@fetchInboxMessages');
    Route::get('/fetchSentMessages/{authId}', 'Staff\messageController@fetchSentMessages');
    Route::get('/fetchTrashMessages/{authId}', 'Staff\messageController@fetchTrashMessages');
    Route::get('/fetchSingleMessage/{id}', 'Staff\messageController@fetchSingleMessage');
    Route::get('/fetchSender/{senderId}/{sender}', 'Staff\messageController@fetchSender');
    Route::put('/moveToTrash/{id}', 'Staff\messageController@moveToTrash');

    
    //activity log routes
    Route::get('/activity', 'activityController@index')->name('admin.activity');
    Route::get('/fetchActivities', 'activityController@fetchActivities');


    //news and updates management routes
    Route::get('staff/news', 'Staff\newsController@index')->name('admin.staffControls.news');
    
    Route::post('/addNews', 'Staff\newsController@addNews');
    Route::get('/fetchNewsAndUpdates', 'Staff\newsController@fetchNewsAndUpdates');
    Route::get('/fetchActiveNewsAndUpdates', 'Staff\newsController@fetchActiveNewsAndUpdates');
    Route::get('/fetchInactiveNewsAndUpdates', 'Staff\newsController@fetchInactiveNewsAndUpdates');
    Route::get('/searchNews/{input}', 'Staff\newsController@searchNews');
    Route::get('/fetchSingleNews/{id}', 'Staff\newsController@fetchSingleNews');
    Route::post('/updateNews/{id}', 'Staff\newsController@updateNews');
    Route::put('/changeStatus/{id}', 'Staff\newsController@changeStatus');
    Route::delete('/deleteNews/{id}/{news_no}', 'Staff\newsController@deleteNews');
    });

    });

    
   
});