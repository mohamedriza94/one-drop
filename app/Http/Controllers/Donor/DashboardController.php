<?php

namespace App\Http\Controllers\Donor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        return view('donor.dashboard.index');
    }
    
    public function fetchNotifications()
    {
        $ODDonorNotif = Notification::where('entity','LIKE','%'.'donor'.'%')->where('entity','LIKE','%'.auth()->guard('donor')->user()->no.'%')->orderBy('id', 'DESC')->limit(8)->get();
        $HSDonorNotif = Notification::where('entity','LIKE','%'.'HSDon'.'%')->where('entity','LIKE','%'.auth()->guard('donor')->user()->no.'%')->orderBy('id', 'DESC')->limit(8)->get();
        
        return response()->json([
            'ODDonorNotif'=>$ODDonorNotif,
            'HSDonorNotif'=>$HSDonorNotif
        ]);
    }

    public function notifUpdate(Request $request)
    {
        $notifications = Notification::where('id', $request->input('id'))->update(['status' => '1']);
    }
    
}
