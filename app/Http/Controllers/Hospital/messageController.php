<?php

namespace App\Http\Controllers\Hospital;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Message;
use App\Models\Hospital;
use App\Models\Donor;
use App\Models\Reply;
use App\Models\Notification;
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
            'messages'=>$messages
        ]);
    }
    
    public function fetchSent()
    {
        $messages = Message::where('hospital_side_status', '=', "sent")->where('sender','LIKE','%'.'hospitalTo'.'%')->where('sender_id', '=', auth()->guard('hospital')->user()->no)->orderBy('id', 'DESC')->get();
        return response()->json([
            'messages'=>$messages
        ]);
    }
    
    public function fetchTrash()
    {
        $hospital = auth()->guard('hospital')->user()->no;
        
        $messages = Message::where([
            ['recipient_id',$hospital],
            ['hospital_side_status','trash'],
            ['sender','LIKE','%'.'ToHospital'.'%']
            ])->orWhere([
                ['sender_id',$hospital],
                ['hospital_side_status','trash'],
                ['sender','LIKE','%'.'hospitalTo'.'%']
                ])->orderBy('id', 'DESC')->get();
                
                return response()->json([
                    'messages'=>$messages,
                ]);
    }
    
    public function fetchSingle($id)
    {
        $messages = Message::where('id', '=', $id)->first();
        if($messages['reply_status'] != '0')
        {
            $messages = Message::join('replies', 'messages.id', '=', 'replies.message_no')->where('messages.id', '=', $id)->first();
            return response()->json([
                'status'=>200,
                'messages'=>$messages,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>200,
                'messages'=>$messages,
            ]);
        }
    }
    
    public function fetchSenderOrReceiver($senderOrReceiverId,$sender)
    {
        if($sender=="hospitalToStaff" || $sender=="staffToHospital")
        {
            $admins = Admin::find($senderOrReceiverId);
            if($admins)
            {
                return response()->json([
                    'admins'=>$admins,
                ]);
            }
        }
        else if($sender=="hospitalToDonor" || $sender=="donorToHospital")
        {
            $donors = Donor::where('id','=',$senderOrReceiverId)->first();
            if($donors)
            {
                return response()->json([
                    'status'=>200,
                    'donors'=>$donors,
                ]);
            }
            else
            {
                return response()->json([
                    'status'=>404,
                ]);
            }
        }
    }
    
    public function sendMessage(Request $request)
    {
        $senderType = $request->input('sender');
        
        if($senderType=="hospitalToStaff" || $senderType == "hospitalToDonor")
        {
            $validator = Validator::make($request->all(), [
                
                'sender' => ['required'],
                'recipientId' => ['required'],
                'subject' => ['required','string','max:100'],
                'message' => ['required','string','max:255'],
                
            ]); //validate all the data
        }
        else if($senderType == "hospitalToAdmin")
        {
            $validator = Validator::make($request->all(), [
                
                'sender' => ['required'],
                'subject' => ['required','string','max:100'],
                'message' => ['required','string','max:255'],
                
            ]); //validate all the data
        }
        
        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages()
            ]);
        }
        else
        {
            
            $messageNo = rand(1500000,9515959);
            
            
            $staff_side_status = ""; $admin_side_status = "";
            $hospital_side_status = ""; $donor_side_status = "";
            $other_status = ""; $reply_status = '0';
            
            if($senderType=="hospitalToStaff")
            {
                $staff_side_status = "unread";
                $hospital_side_status = "sent";
                
                $notifications = new Notification;
                $notifications->notifNo = rand(100000,950000);
                $notifications->entity = 'staff '.$request->input('recipientId');;
                $notifications->text = 'Message Received ('.$messageNo.')';
                $notifications->date = NOW();
                $notifications->time = NOW();
                $notifications->status = '0';
                $notifications->link = "dashboard/staff/message";
                $notifications->save();
            }
            else if($senderType == "hospitalToDonor")
            {
                $donor_side_status = "unread";
                $hospital_side_status = "sent";
                
                //notifications
                $getDonorNoForNotification = Donor::where('id','=',$request->input('recipientId'))->first();
                $notificationDonorNo = $getDonorNoForNotification['no'];

                $notifications = new Notification;
                $notifications->notifNo = rand(100000,950000);
                $notifications->entity = 'HSDon '.$notificationDonorNo;
                $notifications->text = 'Message Received ('.$messageNo.')';
                $notifications->date = NOW();
                $notifications->time = NOW();
                $notifications->status = '0';
                $notifications->link = "dashboard/message";
                $notifications->save();
            }
            else if($senderType == "hospitalToAdmin")
            {
                $admin_side_status = "unread";
                $hospital_side_status = "sent";
                
                $notifications = new Notification;
                $notifications->notifNo = rand(100000,950000);
                $notifications->entity = 'admin';
                $notifications->text = 'Message Received ('.$messageNo.')';
                $notifications->date = NOW();
                $notifications->time = NOW();
                $notifications->status = '0';
                $notifications->link = "dashboard/staffMessage";
                $notifications->save();
            }
            
            $date = NOW();
            
            $messages = new Message;
            
            $messages->message_no = $messageNo;
            $messages->sender = $request->input('sender');
            $messages->subject = $request->input('subject');
            $messages->message = $request->input('message');
            $messages->recipient_id = $request->input('recipientId');
            
            $messages->date = $date;
            $messages->time = $date;
            
            $messages->staff_side_status = $staff_side_status;
            $messages->admin_side_status = $admin_side_status;
            $messages->hospital_side_status = $hospital_side_status;
            $messages->donor_side_status = $donor_side_status;
            $messages->other_status = $other_status;
            $messages->reply_status = $reply_status;
            
            $messages->sender_id = auth()->guard('hospital')->user()->no;
            
            $messages->save();
            
            return response()->json([
                'status'=>200
            ]);
        }
    }
    
    public function replyToMessage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            
            'reply' => ['required'],
            'message_no' => ['required','unique:replies'],
            
        ]); //validate all the data
        
        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages()
            ]);
        }
        else
        {
            $isMessageIdExist = Message::select("*")->where("id", $request->input('message_no'))->exists();
            
            if ($isMessageIdExist) 
            {
                $replyNo = rand(1500000,9515959);
                
                $date = NOW();
                
                $replies = new Reply;
                
                $replies->reply_no = $replyNo;
                $replies->reply = $request->input('reply');
                
                $replies->date = $date;
                $replies->time = $date;
                
                $replies->status = '-';
                
                $replies->message_no = $request->input('message_no');
                
                $replies->save();
                
                $messages = Message::find($request->input('message_no'));
                $reply_status = "1";
                
                $messages->reply_status = $reply_status;
                $messages->update();
                
                return response()->json([
                    'status'=>200
                ]);
            }
            else
            {
                return response()->json([
                    'status'=>300,
                ]);
            }
        }
    }
}

