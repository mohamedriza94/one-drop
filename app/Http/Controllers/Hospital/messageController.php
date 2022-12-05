<?php

namespace App\Http\Controllers\Hospital;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Message;
use App\Models\Hospital;
use App\Models\Donor;
use App\Models\Reply;
use Illuminate\Support\Facades\Validator;

class messageController extends Controller
{
    public function index()
    {
        return view('hospital.dashboard.message');
    }
    
    public function fetchStaffList()
    {
        $staff = Admin::where('hospital_id', '=', auth()->guard('hospital')->user()->no)->orderBy('id', 'DESC')->get();
        return response()->json([
            'staff'=>$staff,
        ]);
    }
    
    public function fetchDonorList()
    {
        $donors = Donor::where('status', '=', "active")->where('hospital', '=', auth()->guard('hospital')->user()->no)->orderBy('id', 'DESC')->get();
        return response()->json([
            'donor'=>$donors,
        ]);
    }
    
    public function moveToTrash(Request $request, $id)
    {
        $messages = Message::find($id);
        $hospital_side_status = "trash";
        
        $messages->hospital_side_status = $hospital_side_status;
        $messages->update();
        
        return response()->json([
            'status'=>200,
        ]);
    }
    
    public function fetchInbox()
    {
        $messages = Message::where('hospital_side_status', '=', "unread")->where('sender','LIKE','%'.'ToHospital'.'%')->where('recipient_id', '=', auth()->guard('hospital')->user()->no)->orderBy('id', 'DESC')->get();
        return response()->json([
            'messages'=>$messages,
        ]);
    }
    
    public function fetchSent()
    {
        $messages = Message::where('sender','LIKE','%'.'hospitalTo'.'%')->where('sender_id', '=', auth()->guard('hospital')->user()->no)->orderBy('id', 'DESC')->get();
        return response()->json([
            'messages'=>$messages,
        ]);
    }
    
    public function fetchTrash()
    {
        $messages = Message::where('hospital_side_status', '=', "trash")->where('recipient_id', '=', auth()->guard('hospital')->user()->no)->orWhere('sender_id', '=', auth()->guard('hospital')->user()->no)->orderBy('id', 'DESC')->get();
        return response()->json([
            'messages'=>$messages,
        ]);
    }
    
    public function fetchSingle($id)
    {
        $messages = Message::where('id', '=', $id)->first();
        if($messages)
        {
            return response()->json([
                'status'=>200,
                'messages'=>$messages,
            ]);
            
            $sender = $messages['sender'];
            
            //check sender or receiver and get their details
            if (strpos($sender, 'hospitalTo') == true) 
            {
                $recipient_id = $messages['recipient_id'];

                $staffDetails = Admin::where('id', '=', $recipient_id)->first();
                $donorDetails = Donor::where('id', '=', $recipient_id)->first();

                return response()->json([
                    'staffDetails'=>$staffDetails,
                    'donorDetails'=>$donorDetails,
                ]);
            }
            else if (strpos($sender, 'ToHospital') == true)
            {
                $sender_id = $messages['sender_id'];

                $staffDetails = Admin::where('id', '=', $sender_id)->first();
                $donorDetails = Donor::where('id', '=', $sender_id)->first();

                return response()->json([
                    'staffDetails'=>$staffDetails,
                    'donorDetails'=>$donorDetails,
                ]);
            }
            
        }
        else
        {
            return response()->json([
                'status'=>404,
            ]);
        }
    }
}
