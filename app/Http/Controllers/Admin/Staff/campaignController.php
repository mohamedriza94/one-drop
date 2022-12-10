<?php

namespace App\Http\Controllers\Admin\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class campaignController extends Controller
{
    public function index()
    {
        if(auth()->guard('admin')->user()->role == 'staff')
        {
            return view('admin.dashboard.staffControls.campaign');
        }
        else
        {
            return back();
        }
    }
}
