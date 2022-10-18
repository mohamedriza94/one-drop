<?php

namespace App\Http\Controllers\Admin\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Message;
use Illuminate\Support\Facades\Validator;

class messageController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.staffControls.message');
    }

    public function sendMessage(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'sender' => ['required'],
            'senderId' => ['required'],
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
            $isExist = Admin::select("*")->where("id", $request->input('senderId'))->exists();
            
            if ($isExist) 
            {
                $messageNo = rand(1500000,9515959);
                $admin_side_status = 'unread';
                $staff_side_status = 'sent';
                $reply_status = '0';
                $date = NOW();

                $messages = new Message;
                $messages->message_no = $messageNo;
                $messages->sender = $request->input('sender');
                $messages->subject = $request->input('subject');
                $messages->message = $request->input('message');
                $messages->date = $date;
                $messages->time = $date;

                $messages->admin_side_status = $admin_side_status;
                $messages->staff_side_status = $staff_side_status;
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
                    'status'=>404,
                    'errors'=>$validator->messages()
                ]);
            }
        }
    }

    public function fetchSentMessages($senderId)
    {
        $messages = Message::where('staff_side_status', '=', "sent")->where('sender','LIKE','%'.'staffTo'.'%')->where('sender_id', '=', $senderId)->orderBy('id', 'DESC')->get();
        return response()->json([
            'messages'=>$messages,
        ]);
    }

    public function fetchTrashMessages($senderId)
    {
        $messages = Message::where('staff_side_status', '=', "trash")->where('sender_id', '=', $senderId)->orderBy('id', 'DESC')->get();
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
        if($sender=="staffToAdmin")
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
        else
        {

        }
    }

    public function moveToTrash(Request $request, $id)
    {
        $messages = Message::find($id);
        $staff_side_status = "trash";
        
        $messages->staff_side_status = $staff_side_status;
        $messages->update();

        return response()->json([
            'status'=>200,
        ]);
    }
}
