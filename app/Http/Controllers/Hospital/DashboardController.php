<?php

namespace App\Http\Controllers\Hospital;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        return view('hospital.dashboard.index');
    }

    public function fetchNotifications()
    {
        $notifications = Notification::where('entity','LIKE','%'.'hospital'.'%')->where('entity','LIKE','%'.auth()->guard('hospital')->user()->no.'%')->orderBy('id', 'DESC')->limit(8)->get();
        
        return response()->json([
            'notifications'=>$notifications
        ]);
    }

    public function notifUpdate(Request $request)
    {
        $notifications = Notification::where('id', $request->input('id'))->update(['status' => '1']);
    }
}
