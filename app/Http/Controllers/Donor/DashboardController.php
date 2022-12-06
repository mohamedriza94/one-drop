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
        $ODDonorNotif = Notification::where('entity','LIKE','%'.'donor'.'%')->get();
        $HSDonorNotif = Notification::where('entity','LIKE','%'.'HSDon'.'%')->where('entity','LIKE','%'.auth()->guard('donor')->user()->id.'%')->get();
        
        return response()->json([
            'ODDonorNotif'=>$ODDonorNotif,
            'HSDonorNotif'=>$HSDonorNotif
        ]);
    }
    
}
