<?php

namespace App\Http\Controllers\Hospital;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Request as bloodRequest;
use App\Models\Activity;

class bloodRequestController extends Controller
{
    public function index()
    {
        return view('hospital.dashboard.bloodRequest');
    }
    
    public function fetchRequest()
    {
        $requests = bloodRequest::where('hospitalNo','=',auth()->guard('hospital')->user()->no)->orderBy('id', 'DESC')->get();
        return response()->json([
            'requests'=>$requests,
        ]);
    }
    
    public function fetchPendingRequest()
    {
        $requests = bloodRequest::where('hospitalResponse','=','pending')->where('hospitalNo','=',auth()->guard('hospital')->user()->no)->orderBy('id', 'DESC')->get();
        return response()->json([
            'requests'=>$requests,
        ]);
    }
    
    public function fetchRespondedRequest()
    {
        $requests = bloodRequest::where('hospitalResponse','=','responded')->where('hospitalNo','=',auth()->guard('hospital')->user()->no)->orderBy('id', 'DESC')->get();
        return response()->json([
            'requests'=>$requests,
        ]);
    }
    
    public function searchRequest($input)
    {
        $requests = bloodRequest::where('requestNo','LIKE','%'.$input.'%')->where('hospitalNo','=',auth()->guard('hospital')->user()->no)->orderBy('id', 'DESC')->get();
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
    
    public function declineBloodRequest(Request $request)
    {
        $remark = 'Blood Not Available';
        $requestNo = $request->input('requestNo');
        $status = 'responded';
        
        $requests = bloodRequest::where('requestNo', $requestNo)->update(['hospitalResponse' => $status, 'remark' => $remark]);
        
        return response()->json([
            'status'=>200,
        ]);
    }
    
    public function acceptBloodRequest(Request $request)
    {
        $remark = 'Blood Provided';
        $requestNo = $request->input('requestNo');
        $status = 'responded';
        
        $requests = bloodRequest::where('requestNo', $requestNo)->update(['hospitalResponse' => $status, 'remark' => $remark, 'bloodBagNo' => $request->input('bloodBagNo')]);
        
        return response()->json([
            'status'=>200,
        ]);
    }
}
