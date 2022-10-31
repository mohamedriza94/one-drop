<?php

namespace App\Http\Controllers\Admin\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Request as bloodRequest;
use App\Models\Activity;
use Illuminate\Support\Facades\Mail;

class bloodRequestController extends Controller
{
    public function index()
    {
        if(auth()->guard('admin')->user()->role == 'staff')
        {
        return view('admin.dashboard.staffControls.bloodRequest');
        }
        else
        {
            return back();
        }
    }
    
    public function fetchRequest()
    {
        $requests = bloodRequest::orderBy('id', 'DESC')->get();
        return response()->json([
            'requests'=>$requests,
        ]);
    }

    public function fetchPendingRequest()
    {
        $requests = bloodRequest::where('status', '=', 'pending')->orderBy('id', 'DESC')->get();
        return response()->json([
            'requests'=>$requests,
        ]);
    }

    public function fetchWaitingRequest()
    {
        $requests = bloodRequest::where('status', '=', 'waiting')->orderBy('id', 'DESC')->get();
        return response()->json([
            'requests'=>$requests,
        ]);
    }

    public function fetchFulfilledRequest()
    {
        $requests = bloodRequest::where('status', '=', 'fulfilled')->orderBy('id', 'DESC')->get();
        return response()->json([
            'requests'=>$requests,
        ]);
    }

    public function fetchDeclinedRequest()
    {
        $requests = bloodRequest::where('status', '=', 'declined')->orderBy('id', 'DESC')->get();
        return response()->json([
            'requests'=>$requests,
        ]);
    }
    
    public function searchRequest($input)
    {
        $requests = bloodRequest::where('nic','LIKE','%'.$input.'%')->orWhere('telephone','LIKE','%'.$input.'%')->orWhere('requestNo','LIKE','%'.$input.'%')->orderBy('id', 'DESC')->get();
        return response()->json([
            'requests'=>$requests,
        ]);
    }

}
