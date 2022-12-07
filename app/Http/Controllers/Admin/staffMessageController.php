<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Message;
use App\Models\Hospital;
use App\Models\Activity;
use App\Models\Reply;
use App\Models\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

use App\Mail\Admin\otherMessage;

class staffMessageController extends Controller
{
    public function index()
    {
        if(auth()->guard('admin')->user()->role == 'admin')
        {
            return view('admin.dashboard.staffMessage');
        }
        else
        {
            return back();
        }
    }
    
    public function staff_sendMessage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            
            'sender' => ['required'],
            'senderId' => ['required'],
            'recipientId' => ['required'],
            'subject' => ['required','string','max:100'],
            'message' => ['required','string','max:255'],
            
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
            $isSenderIdExist = Admin::select("*")->where("id", $request->input('senderId'))->exists();
            
            if ($isSenderIdExist) 
            {
                $messageNo = rand(1500000,9515959);
                
                $senderType = $request->input('sender');
                
                $staff_side_status = ""; $admin_side_status = "";
                $hospital_side_status = ""; $donor_side_status = "";
                $other_status = ""; $reply_status = '0';
                
                if($senderType == "adminToStaff")
                {
                    $admin_side_status="sent";
                    $staff_side_status="unread";
                    
                    
                    $isRecipientIdExist = Admin::select("*")->where("id", $request->input('recipientId'))->exists();
                    
                    if($isRecipientIdExist)
                    {
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
                        
                        $messages->sender_id = $request->input('senderId');
                        $messages->save();
                        
                        $notifications = new Notification;
                        $notifications->notifNo = rand(100000,950000);
                        $notifications->entity = 'staff '.$request->input('recipientId');
                        $notifications->text = 'Message from Admin ('.$messageNo.')';
                        $notifications->date = NOW();
                        $notifications->time = NOW();
                        $notifications->status = '0';
                        $notifications->link = "dashboard/staff/message";
                        $notifications->save();
                        
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
                else if($senderType == "adminToHospital")
                {
                    $admin_side_status="sent";
                    $hospital_side_status="unread";
                    
                    $isRecipientIdExist = Hospital::select("*")->where("no", $request->input('recipientId'))->exists();
                    
                    if($isRecipientIdExist)
                    {
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
                        
                        $messages->sender_id = $request->input('senderId');
                        
                        $messages->save();
                        
                        $notifications = new Notification;
                        $notifications->notifNo = rand(100000,950000);
                        $notifications->entity = 'hospital '.$request->input('recipientId');
                        $notifications->text = 'Message from Admin ('.$messageNo.')';
                        $notifications->date = NOW();
                        $notifications->time = NOW();
                        $notifications->status = '0';
                        $notifications->link = "dashboard/message";
                        $notifications->save();
                        
                        return response()->json([
                            'status'=>200
                        ]);
                    }
                    else
                    {
                        return response()->json([
                            'status'=>301,
                        ]);
                    }
                }
                else if($senderType == "adminToOther")
                {
                    $admin_side_status= "sent";
                    $other_status = "0";
                    
                    $otherSubject = $request->input('subject'); 
                    $otherMessage = $request->input('message');
                    $mailSender = 'Administrator';
                    
                    if(Mail::to($request->input('recipientId'))->send(new otherMessage($otherSubject, $otherMessage, $mailSender)))
                    {
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
                        
                        $messages->sender_id = $request->input('senderId');
                        
                        $messages->save();
                        
                        return response()->json([
                            'status'=>200
                        ]);
                    }
                    else
                    {
                        return response()->json([
                            'status'=>301,
                        ]);
                    }
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
    
    public function staff_fetchInboxMessages()
    {
        $messages = Message::where('admin_side_status', '=', "unread")->where('sender','LIKE','%'.'ToAdmin'.'%')->orderBy('id', 'DESC')->get();
        return response()->json([
            'messages'=>$messages,
        ]);
    }
    
    public function staff_moveToTrash(Request $request, $id)
    {
        $messages = Message::find($id);
        $admin_side_status = "trash";
        
        $messages->admin_side_status = $admin_side_status;
        $messages->update();
        
        return response()->json([
            'status'=>200,
        ]);
    }
    
    public function staff_fetchTrashMessages()
    {
        $messages = Message::where('admin_side_status', '=', "trash")->orderBy('id', 'DESC')->get();
        return response()->json([
            'messages'=>$messages,
        ]);
    }
    
    public function staff_fetchSentMessages($senderId)
    {
        $messages = Message::where('admin_side_status', '=', "sent")->where('sender_id', '=', $senderId)->orderBy('id', 'DESC')->get();
        return response()->json([
            'messages'=>$messages,
        ]);
    }
    
    public function fetchStafflist()
    {
        $admins = Admin::where('role', '=', "staff")->orderBy('id', 'DESC')->get();
        return response()->json([
            'admins'=>$admins,
        ]);
    }
    
    public function fetchHospitallist()
    {
        $hospitals = Hospital::orderBy('id', 'DESC')->get();
        return response()->json([
            'hospitals'=>$hospitals,
        ]);
    }
    
    public function staff_fetchSingleMessage($id)
    {
        $messages = Message::find($id);
        if($messages)
        {
            return response()->json([
                'status'=>200,
                'messages'=>$messages,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
            ]);
        }
    }
    
    public function staff_fetchSender($senderId,$sender)
    {
        if($sender=="adminToStaff" || $sender=="staffToAdmin")
        {
            $admins = Admin::find($senderId);
            if($admins)
            {
                return response()->json([
                    'status'=>200,
                    'admins'=>$admins,
                ]);
            }
            else
            {
                return response()->json([
                    'status'=>404,
                ]);
            }
        }
        else if($sender=="adminToHospital" || $sender=="hospitalToAdmin")
        {
            $hospitals = Hospital::where('no','=',$senderId)->first();
            if($hospitals)
            {
                return response()->json([
                    'status'=>200,
                    'hospitals'=>$hospitals,
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
                
                //record activity
                $authenticatedUser = auth()->guard('admin')->user()->role;
                if($authenticatedUser == 'staff')
                {
                    $activities = new Activity;
                    $activities->user_id = auth()->guard('admin')->user()->id;
                    $activities->task = 'Replied to message No. '.$request->input('message_no').'.';
                    $activities->date = NOW();
                    $activities->time = NOW();
                    $activities->save();
                }
                
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
    
    public function fetchReply($messageId)
    {
        $replies = Reply::where('message_no', '=', $messageId)->get();
        return response()->json([
            'replies'=>$replies,
        ]);
    }
    
    public function viewedReplyUpdateStatus(Request $request, $id)
    {
        $messages = Message::find($id);
        
        $messages->reply_status = '2';
        $messages->update();
        
        return response()->json([
            'status'=>200
        ]);
    }
}
