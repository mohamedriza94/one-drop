<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\Admin;


class activityController extends Controller
{
    public function index()
    {
        if(auth()->guard('admin')->user()->role == 'admin')
        {
            return view('admin.dashboard.activity');
        }
        else
        {
            return back();
        }
    }

    public function fetchActivities()
    {
        $activities = Activity::leftJoin('admins', 'admins.id', '=', 'activities.user_id')->orderBy('activities.id', 'DESC')->get();
        return response()->json([
            'activities'=>$activities,
        ]);
    }
}
