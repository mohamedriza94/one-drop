<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Admin;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $view_data['title'] = 'Dashboard';
        return view('admin.dashboard.index')->with($view_data);
    }

    public function fetchNotifications()
    {
        if(auth()->guard('admin')->user()->role == 'admin')
        {
            $notifications = Notification::where('entity','LIKE','%'.'admin'.'%')->orderBy('id', 'DESC')->limit(8)->get();
        }
        else
        {
            $notifications = Notification::where('entity','LIKE','%'.'staff'.'%')->where('entity','LIKE','%'.auth()->guard('admin')->user()->id.'%')->orWhere('entity','LIKE','%'.'commonStf'.'%')->orderBy('id', 'DESC')->limit(4)->get();
        }

        return response()->json([
            'notifications'=>$notifications
        ]);
    }

    public function notifUpdate(Request $request)
    {
        $notifications = Notification::where('id', $request->input('id'))->update(['status' => '1']);
    }
}