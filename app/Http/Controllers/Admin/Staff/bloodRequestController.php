<?php

namespace App\Http\Controllers\Admin\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Request as bloodRequest;
use App\Models\BloodBag;
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
    
    public function fetchSingleRequest($id)
    {
        $requests = bloodRequest::find($id);
        if($requests)
        {
            return response()->json([
                'status'=>200,
                'requests'=>$requests,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
            ]);
        }
    }
    
    public function fetchAvailableBlood($bloodGroup)
    {
        $checkbloodBags = BloodBag::where('bag_no','LIKE','%'.'OD'.'%')->where('status','=','available')->where('bloodGroup','=',$bloodGroup)->orderBy('id','DESC')->first();
        
        if($checkbloodBags)
        {
            $bloodBags = BloodBag::where('bag_no','LIKE','%'.'OD'.'%')->where('status','=','available')->where('bloodGroup','=',$bloodGroup)->orderBy('id','DESC')->get();
            
            return response()->json([
                'status'=>200,
                'blood_bags'=>$bloodBags
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404
            ]);
        }
    }

    public function requestChangeStatus(Request $request, $id)
    {
        $requests = bloodRequest::find($id);
        
        $requests->status = $request->input('status');
        $requests->update();

        //record activity
        $activities = new Activity;
        $activities->user_id = auth()->guard('admin')->user()->id;
        $activities->task = 'Put Request No. '.$id.' on waiting list due to unavailability of blood';
        $activities->date = NOW();
        $activities->time = NOW();
        $activities->save();

        return response()->json([
            'status'=>200
        ]);
    }
    
}
