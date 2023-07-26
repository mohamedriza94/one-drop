<?php

namespace App\Http\Controllers\Admin\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Message;
use App\Models\Hospital;
use App\Models\Donor;
use App\Models\Notification;
use App\Models\Activity;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

use App\Mail\Admin\otherMessage;


class messageController extends Controller
{
    public function index()
    {
        if(auth()->guard('admin')->user()->role == 'staff')
        {
            return view('admin.dashboard.staffControls.message');
        }
        else
        {
            return back();
        }
    }
    
    public function fetchDonorList()
    {
        $donors = Donor::where('status', '=', "active")->where('no','LIKE','%'.'OD'.'%')->orderBy('id', 'DESC')->get();
        return response()->json([
            'donor'=>$donors,
        ]);
    }
    
    public function sendMessage(Request $request)
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
                
                if($senderType == "staffToAdmin")
                {
                    $staff_side_status="sent";
                    $admin_side_status="unread";
                    
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
                    
                    //record activity
                    $activities = new Activity;
                    $activities->user_id = auth()->guard('admin')->user()->id;
                    $activities->task = 'Sent a message to Administrator';
                    $activities->date = NOW();
                    $activities->time = NOW();
                    $activities->save();
                    
                    $notifications = new Notification;
                    $notifications->notifNo = rand(100000,950000);
                    $notifications->entity = 'admin';
                    $notifications->text = 'Message from Staff ('.$messageNo.')';
                    $notifications->date = NOW();
                    $notifications->time = NOW();
                    $notifications->status = '0';
                    $notifications->link = "dashboard/staffMessage";
                    $notifications->save();
                    
                    return response()->json([
                        'status'=>200
                    ]);
                    
                }
                else if($senderType == "staffToHospital")
                {
                    $staff_side_status="sent";
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
                        
                        //record activity
                        $activities = new Activity;
                        $activities->user_id = auth()->guard('admin')->user()->id;
                        $activities->task = 'Sent a message to Hospital No. '.$request->input('recipientId');
                        $activities->date = NOW();
                        $activities->time = NOW();
                        $activities->save();
                        
                        $notifications = new Notification;
                        $notifications->notifNo = rand(100000,950000);
                        $notifications->entity = 'hospital '.$request->input('recipientId');
                        $notifications->text = 'Message from Staff ('.$messageNo.')';
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
                else if($senderType == "staffToDonor")
                {
                    $staff_side_status="sent";
                    $donor_side_status="unread";
                    
                    
                    $isRecipientIdExist = Donor::select("*")->where("id", $request->input('recipientId'))->exists();
                    
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
                        
                        //record activity
                        $activities = new Activity;
                        $activities->user_id = auth()->guard('admin')->user()->id;
                        $activities->task = 'Sent a message to Donor';
                        $activities->date = NOW();
                        $activities->time = NOW();
                        $activities->save();

                        //notifications
                        $getDonorNoForNotification = Donor::where('id','=',$request->input('recipientId'))->first();
                        $notificationDonorNo = $getDonorNoForNotification['no'];
                        
                        $notifications = new Notification;
                        $notifications->notifNo = rand(100000,950000);
                        $notifications->entity = 'donor '.$notificationDonorNo;
                        $notifications->text = 'Message from Life Saver ('.$messageNo.')';
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
                else if($senderType == "staffToOther")
                {
                    $staff_side_status= "sent";
                    $other_status = "0";
                    
                    $otherSubject = $request->input('subject'); 
                    $otherMessage = $request->input('message');
                    $mailSender = 'Staff';
                    
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
                        
                        //record activity
                        $activities = new Activity;
                        $activities->user_id = auth()->guard('admin')->user()->id;
                        $activities->task = 'Sent a message to '.$request->input('recipientId');
                        $activities->date = NOW();
                        $activities->time = NOW();
                        $activities->save();
                        
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
    
    public function fetchInboxMessages($authId)
    {
        $messages = Message::where('recipient_id', '=', $authId)->where('staff_side_status', '=', "unread")->where('sender','LIKE','%'.'ToStaff'.'%')
        ->orWhere('recipient_id', '=', '-')->orderBy('id', 'DESC')->get();
        
        return response()->json([
            'messages'=>$messages,
        ]);
    }
    
    public function fetchSentMessages($authId)
    {
        $messages = Message::where('sender_id', '=', $authId)->where('staff_side_status', '=', "sent")->orderBy('id', 'DESC')->get();
        return response()->json([
            'messages'=>$messages,
        ]);
    }
    
    public function moveToTrash(Request $request, $id)
    {
        $messages = Message::find($id);
        $staff_side_status = "trash";
        
        $messages->staff_side_status = $staff_side_status;
        $messages->update();
        
        //record activity
        $activities = new Activity;
        $activities->user_id = auth()->guard('admin')->user()->id;
        $activities->task = 'Moved message No. '.$id.' to trash';
        $activities->date = NOW();
        $activities->time = NOW();
        $activities->save();
        
        return response()->json([
            'status'=>200,
        ]);
    }
    
    public function fetchTrashMessages($authId)
    {
        $messages = Message::where([
            ['recipient_id',$authId],
            ['staff_side_status','trash'],
            ['sender','LIKE','%'.'ToStaff'.'%']
            ])->orWhere([
                ['sender_id',$authId],
                ['staff_side_status','trash'],
                ['sender','LIKE','%'.'staffTo'.'%']
                ])->orWhere([
                    ['recipient_id','-']
                    ])->orderBy('id', 'DESC')->get();
                    
                    return response()->json([
                        'messages'=>$messages,
                    ]);
                }
                
                public function fetchSingleMessage($id)
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
                
                public function fetchSender($senderId,$sender)
                {
                    if($sender=="staffToHospital" || $sender=="hospitalToStaff")
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
                    else if($sender=="staffToDonor" || $sender=="donorToStaff")
                    {
                        $donors = Donor::find($senderId);
                        if($donors)
                        {
                            return response()->json([
                                'status'=>200,
                                'donor'=>$donors,
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
            }