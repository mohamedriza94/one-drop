<?php

namespace App\Http\Controllers\Admin\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Request as bloodRequest;
use App\Models\BloodBag;
use App\Models\Activity;
use App\Models\Invoice;
use Illuminate\Support\Facades\Mail;

use App\Mail\Staff\requestUpdateMail;

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
        $status = $request->input('status');
        $email = $request->input('email');
        $requests = bloodRequest::where('requestNo', $id)->update(['status' => $status]);
        
        $task = '';
        $requestUpdateMessage = '';
        
        if($status == 'waiting')
        {
            $requestUpdateMessage = 'Dear Requestor, Your Blood Request No. '.$id.' has been put on the waiting list due to 
            unavailability of blood at the moment. We will get back to you immediately once the blood becomes available. We are
            sorry for the inconvenience caused. Thank you for your understanding.';
            
            $task = 'Put Request No. '.$id.' on waiting list due to unavailability of blood';
        }
        else if($status == 'declined')
        {
            $requestUpdateMessage = 'Dear Requestor, Your Blood Request No. '.$id.' has been declined upon your request due to the 
            unavailability of blood at the moment. We are sorry for the inconvenience caused. Thank you for your understanding.';
            
            $task = 'Put Request No. '.$id.' on declined list due to unavailability of blood';
        }
        else if($status == 'requestedHospital')
        {
            $requestUpdateMessage = 'Dear Requestor, Your Blood Request No. '.$id.' has been put on the waiting list due to 
            unavailability of blood at the moment. We will get back to you immediately once the blood becomes available. We are
            sorry for the inconvenience caused. Thank you for your understanding.';
            
            $task = 'Forwarded Request No. '.$id.' to Hospital No. '.auth()->guard('admin')->user()->hospital_id.' due to unavailability of blood';
            
            $requests = bloodRequest::where('requestNo', $id)->update(['hospitalNo' => auth()->guard('admin')->user()->hospital_id, 'hospitalResponse' => 'pending']);
        }
        
        Mail::to($email)->send(new requestUpdateMail($requestUpdateMessage));
        
        //record activity
        $activities = new Activity;
        $activities->user_id = auth()->guard('admin')->user()->id;
        $activities->task = $task;
        $activities->date = NOW();
        $activities->time = NOW();
        $activities->save();
        
        return response()->json([
            'status'=>200
        ]);
    }
    
    public function fetchChosenBlood($bloodBagId)
    {
        $bloodBags = BloodBag::where('bag_no','=',$bloodBagId)->first();
        
        return response()->json([
            'blood_bags'=>$bloodBags
        ]);
    }
    
    public function acceptBloodRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'requestId' => ['required'],
            'bloodBagNo' => ['required'],
            'email' => ['required'],
        ]); //validate all the data
        
        if($validator->fails())
        {
            return response()->json([
                'status'=>400
            ]);
        }
        else
        {
            $requestId = $request->input('requestId');
            $bloodBagNo = $request->input('bloodBagNo');
            $email = $request->input('email');
            $requestStatus = 'fulfilled';
            $fulfilDate = NOW();
            
            $requests = bloodRequest::where('requestNo', $requestId)->update(['status' => $requestStatus,'fulfilDate' => $fulfilDate,'bloodBagNo' => $bloodBagNo]);
            
            $bloodBags = BloodBag::where('bag_no', $bloodBagNo)->update(['status' => 'used']);
            
            
            $requestUpdateMessage = 'Dear Requestor, Your Blood Request No. '.$requestId.' has been fulfilled with the Blood bag no.
            '.$bloodBagNo.'. Thank you.';
            
            $invoices = new Invoice;
            $invoices->requestNo = $request->input('requestNo');
            $invoices->date = $request->input('date');
            $invoices->time = $request->input('time');
            $invoices->fullname = $request->input('fullname');
            $invoices->nic = $request->input('nic');
            $invoices->email = $request->input('email');
            $invoices->telephone = $request->input('telephone');
            $invoices->bagNo = $request->input('bagNo');
            $invoices->bloodGroup = $request->input('bloodGroup');
            $invoices->expiryDate = $request->input('expiryDate');
            $invoices->staffName = $request->input('staffName');
            $invoices->staffTelephone = $request->input('staffTelephone');
            $invoices->save();
            
            Mail::to($email)->send(new requestUpdateMail($requestUpdateMessage));
            
            //record activity
            $activities = new Activity;
            $activities->user_id = auth()->guard('admin')->user()->id;
            $activities->task = 'Fulfilled Request No. '.$requestId.'';
            $activities->date = NOW();
            $activities->time = NOW();
            $activities->save();
            
            return response()->json([
                'status'=>200
            ]);
        }
    }
}
