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
        
        //set password route
        Route::get('staff/setPassword/{no}', 'staffController@setPassword')->name('admin.setPassword'); //get page
        Route::post('staff/setPassword/', 'staffController@submitPassword')->name('admin.setPassword.submit'); //form action
        
        Route::post('/auth/register', 'Auth\RegisterController@registerAdmin'); //not used for now
        
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
                Route::put('/staffChangeStatus/{id}', 'staffController@changeStatus');
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
                
                //admin news  
                Route::get('/news', 'newsController@index')->name('admin.news');
                Route::get('/adminFetchNews', 'newsController@adminFetchNews');
                Route::get('/adminSearchNews/{input}', 'newsController@adminSearchNews');
                Route::get('/adminfetchSingleNews/{id}', 'newsController@adminfetchSingleNews');
                
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
                Route::get('/fetchDonorList', 'Staff\messageController@fetchDonorList');
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
                
                //donor request management routes
                Route::get('staff/donorRequest', 'Staff\donorRequestController@index')->name('admin.staffControls.donorRequest');
                
                Route::get('/fetchDonorRequest', 'Staff\donorRequestController@fetchDonorRequest');
                Route::get('/fetchScheduledDonorRequest', 'Staff\donorRequestController@fetchScheduledDonorRequest');
                Route::get('/fetchDeclinedDonorRequest', 'Staff\donorRequestController@fetchDeclinedDonorRequest');
                Route::get('/fetchAcceptedDonorRequest', 'Staff\donorRequestController@fetchAcceptedDonorRequest');
                Route::get('/fetchPendingDonorRequest', 'Staff\donorRequestController@fetchPendingDonorRequest');
                Route::get('/searchDonorRequest/{input}', 'Staff\donorRequestController@searchDonorRequest');
                Route::post('/scheduleAppointment', 'Staff\donorRequestController@scheduleAppointment');
                Route::post('/rescheduleAppointment', 'Staff\donorRequestController@rescheduleAppointment');
                Route::get('/fetchSingleDonorRequest/{id}', 'Staff\donorRequestController@fetchSingleDonorRequest');
                
                //appointment management routes
                Route::get('staff/appointments', 'Staff\appointmentController@index')->name('admin.staffControls.appointments');
                
                Route::get('/fetchAppointment', 'Staff\appointmentController@fetchAppointment');
                Route::get('/fetchPendingAppointment', 'Staff\appointmentController@fetchPendingAppointment');
                Route::get('/fetchCompletedAppointment', 'Staff\appointmentController@fetchCompletedAppointment');
                Route::get('/fetchCancelledAppointment', 'Staff\appointmentController@fetchCancelledAppointment');
                Route::get('/searchAppointment/{input}', 'Staff\appointmentController@searchAppointment');
                Route::put('/cancelAppointment/{id}', 'Staff\appointmentController@cancelAppointment');
                Route::post('/registerDonor', 'Staff\appointmentController@registerDonor');
                Route::put('/declineDonorRequest/{id}', 'Staff\appointmentController@declineDonorRequest');
                
                //donor management routes
                Route::get('staff/donor', 'Staff\donorController@index')->name('admin.staffControls.donor');
                
                
                Route::get('/fetchDonor', 'Staff\donorController@fetchDonor');
                Route::get('/fetchActiveDonor', 'Staff\donorController@fetchActiveDonor');
                Route::get('/fetchInactiveDonor', 'Staff\donorController@fetchInactiveDonor');
                Route::get('/fetchSingleDonor/{id}', 'Staff\donorController@fetchSingleDonor');
                Route::get('/searchDonor/{input}', 'Staff\donorController@searchDonor');
                Route::put('/changeDonorStatus/{id}', 'Staff\donorController@changeDonorStatus');
                
                //blood request management routes
                Route::get('staff/bloodRequest', 'Staff\bloodRequestController@index')->name('admin.staffControls.bloodRequest');
                Route::get('/fetchRequest', 'Staff\bloodRequestController@fetchRequest');
                Route::get('/fetchPendingRequest', 'Staff\bloodRequestController@fetchPendingRequest');
                Route::get('/fetchWaitingRequest', 'Staff\bloodRequestController@fetchWaitingRequest');
                Route::get('/fetchFulfilledRequest', 'Staff\bloodRequestController@fetchFulfilledRequest');
                Route::get('/fetchDeclinedRequest', 'Staff\bloodRequestController@fetchDeclinedRequest');
                Route::get('/searchRequest/{input}', 'Staff\bloodRequestController@searchRequest');
                Route::get('/fetchSingleRequest/{id}', 'Staff\bloodRequestController@fetchSingleRequest');
                Route::get('/fetchAvailableBlood/{bloodGroup}', 'Staff\bloodRequestController@fetchAvailableBlood');
                Route::put('/requestChangeStatus/{id}', 'Staff\bloodRequestController@requestChangeStatus');
                Route::get('/fetchChosenBlood/{bloodBagId}', 'Staff\bloodRequestController@fetchChosenBlood');
                Route::get('/fetchHospitalProvidedBlood/{bloodBagId}', 'Staff\bloodRequestController@fetchHospitalProvidedBlood');
                Route::put('/acceptBloodRequest', 'Staff\bloodRequestController@acceptBloodRequest');
                
                //donation routes
                Route::get('staff/donate', 'Staff\donationController@OpenDonatePage')->name('admin.staffControls.donate');
                Route::get('/getDonor/{id}', 'Staff\donationController@getDonor');
                Route::post('/donate', 'Staff\donationController@donate');
                
                //donation details routes
                Route::get('staff/donation', 'Staff\donationController@index')->name('admin.staffControls.donation');
                Route::get('/fetchDonation', 'Staff\donationController@fetchDonation');
                
                //blood bag management routes
                Route::get('staff/bloodBag', 'Staff\bloodBagController@index')->name('admin.staffControls.bloodBag');
                Route::get('/fetchBloodBags', 'Staff\bloodBagController@fetchBloodBags');
                Route::get('/fetchAvailableBloodBags', 'Staff\bloodBagController@fetchAvailableBloodBags');
                Route::get('/fetchExpiredBloodBags', 'Staff\bloodBagController@fetchExpiredBloodBags');
                Route::get('/fetchUsedBloodBags', 'Staff\bloodBagController@fetchUsedBloodBags');
                Route::get('/fetchCustomBloodBags/{bloodGroup}', 'Staff\bloodBagController@fetchCustomBloodBags');
                Route::get('/fetchSingleBloodBag/{bloodBagNo}', 'Staff\bloodBagController@fetchSingleBloodBag');
                
                //donation tracking routes
                Route::get('staff/tracking', 'Staff\donationController@trackingPage')->name('admin.staffControls.tracking');
                Route::get('/trackDonation/{donationNo}', 'Staff\donationController@trackDonation');
                Route::get('/trackDonationReceiver/{receivedBloodBagNo}', 'Staff\donationController@trackDonationReceiver');
                
                //invoice routes
                Route::get('/invoice', 'Staff\invoiceController@index')->name('admin.invoice');
                Route::get('/getInvoice/{input}', 'Staff\invoiceController@searchRequest');
                
                //count routes
                Route::get('/statistics', 'countController@statistics');
                
                //notifications
                Route::get('/fetchNotifications', 'DashboardController@fetchNotifications');
                Route::put('/notifUpdate', 'DashboardController@notifUpdate');
                
                //campaign routes
                Route::get('/campaign', 'Staff\campaignController@index')->name('admin.staffControls.campaign');
                Route::get('/fetchCampaign', 'Staff\campaignController@fetchCampaign');
                Route::get('/searchCampaign/{input}', 'Staff\campaignController@searchCampaign');
                Route::get('/fetchActiveCampaign', 'Staff\campaignController@fetchActiveCampaign');
                Route::get('/fetchInactiveCampaign', 'Staff\campaignController@fetchInactiveCampaign');
                Route::get('/fetchEndedCampaign', 'Staff\campaignController@fetchEndedCampaign');
                Route::post('/newCampaign', 'Staff\campaignController@newCampaign');
                Route::get('/fetchSingleCampaign/{id}', 'Staff\campaignController@fetchSingleCampaign');
                Route::delete('/deleteCampaign/{campaignNo}', 'Staff\campaignController@deleteCampaign');
                Route::delete('/deleteCampaignPhoto/{id}', 'Staff\campaignController@deleteCampaignPhoto');
                Route::delete('/deleteCampaignTag/{id}', 'Staff\campaignController@deleteCampaignTag');
                Route::put('/changeStatus/{id}', 'Staff\campaignController@changeStatus');
                Route::post('/editCampaign', 'Staff\campaignController@editCampaign');
                Route::post('/addTag', 'Staff\campaignController@addTag');
                Route::post('/uploadPhoto', 'Staff\campaignController@uploadPhoto');
            });
            
        });
        
        
        
    });