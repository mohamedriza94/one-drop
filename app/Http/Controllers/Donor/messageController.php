<?php

namespace App\Http\Controllers\Donor;

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
        return view('donor.dashboard.message');
    }
    
    public function sendMessage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            
            'sender' => ['required'],
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
            $messageNo = rand(1500000,9515959);
            $senderType = $request->input('sender');
            
            $staff_side_status = ""; $admin_side_status = "";
            $hospital_side_status = ""; $donor_side_status = "";
            $other_status = ""; $reply_status = '0';
            
            if($senderType=="donorToStaff")
            {
                $donor_side_status = "sent";
                $staff_side_status = "unread";
                
                $notifications = new Notification;
                $notifications->notifNo = rand(100000,950000);
                $notifications->entity = 'commonStf';
                $notifications->text = 'Message from Donor ('.$messageNo.')';
                $notifications->date = NOW();
                $notifications->time = NOW();
                $notifications->status = '0';
                $notifications->link = "dashboard/staff/message";
                $notifications->save();
            }
            else if($senderType == "donorToHospital")
            {
                $donor_side_status = "sent";
                $hospital_side_status = "unread";
                
                $notifications = new Notification;
                $notifications->notifNo = rand(100000,950000);
                $notifications->entity = 'hospital '.$request->input('recipientId');
                $notifications->text = 'Message from Donor ('.$messageNo.')';
                $notifications->date = NOW();
                $notifications->time = NOW();
                $notifications->status = '0';
                $notifications->link = "dashboard/message";
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
            
            $messages->sender_id = auth()->guard('donor')->user()->id;
            
            $messages->save();
            
            return response()->json([
                'status'=>200
            ]);
        }
    }
    
    public function fetchInbox()
    {
        $messages = Message::where('donor_side_status', '=', "unread")->where('recipient_id', '=', auth()->guard('donor')->user()->id)->orderBy('id', 'DESC')->get();
        return response()->json([
            'messages'=>$messages
        ]);
    }
    
    public function fetchSent()
    {
        $messages = Message::where('donor_side_status', '=', "sent")->where('sender_id', '=', auth()->guard('donor')->user()->id)->orderBy('id', 'DESC')->get();
        return response()->json([
            'messages'=>$messages
        ]);
    }
    
    public function fetchTrash()
    {
        $donor = auth()->guard('donor')->user()->id;
        
        $messages = Message::where([
            ['recipient_id',$donor],
            ['donor_side_status','trash']
            ])->orWhere([
                ['sender_id',$donor],
                ['donor_side_status','trash']
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
                    $messages = Message::join('replies', 'messages.id', '=', 'replies.message_no')->where('messages.id', '=', $id)->first(
                        [
                            //aliasing names
                            'messages.id AS id',
                            'messages.subject AS subject',
                            'messages.message AS message',
                            'messages.date AS date',
                            'messages.time AS time',
                            'messages.donor_side_status AS donor_side_status',
                            'messages.reply_status AS reply_status',
                            'messages.sender_id AS sender_id',
                            'messages.recipient_id AS recipient_id',
                            'messages.message_no AS message_no',
                            'messages.sender AS sender',
                            'replies.reply AS reply',
                            ]
                        );
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
                    $admin = Admin::find($senderOrReceiverId);
                    if($admin)
                    {
                        return response()->json([
                            'admin'=>$admin
                        ]);
                    }
                    
                    $hospital = Hospital::where('no', '=', $senderOrReceiverId)->first();
                    if($hospital)
                    {
                        return response()->json([
                            'hospital'=>$hospital
                        ]);
                    }
                }
                
                public function moveToTrash(Request $request, $id)
                {
                    $messages = Message::find($id);
                    $donor_side_status = "trash";
                    
                    $messages->donor_side_status = $donor_side_status;
                    $messages->update();
                    
                    return response()->json([
                        'status'=>200,
                    ]);
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
