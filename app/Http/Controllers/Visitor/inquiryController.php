<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Notification;

class inquiryController extends Controller
{
    public function makeInquiry(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required','email'],
            'subject' => ['required','string','max:255'],
            'message' => ['required','string'],
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
            $messageNo = rand (9950000,10000000);

            $messages = new Message;
            $messages->message_no = $messageNo;
            $messages->sender = 'otherToStaff';
            $messages->subject = $request->input('subject');
            $messages->message = $request->input('message');

            $messages->date = now();
            $messages->time = now();
            
            $messages->staff_side_status = 'unread';
            $messages->admin_side_status = '';
            $messages->hospital_side_status = '';
            $messages->donor_side_status = '';
            $messages->other_status = 'sent';
            $messages->reply_status = '0';
            $messages->sender_id = $request->input('email');
            $messages->recipient_id = '-';

            $messages->save();

            $notifications = new Notification;
            $notifications->notifNo = rand(100000,950000);
            $notifications->entity = 'commonStf';
            $notifications->text = 'New Inquiry ('.$messageNo.')';
            $notifications->date = NOW();
            $notifications->time = NOW();
            $notifications->status = '0';
            $notifications->link = "dashboard/staff/message";
            $notifications->save();

            return response()->json([
                'status'=>200
            ]);
        }
    }
}
