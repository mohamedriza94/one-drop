<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Request As BloodRequest;
use Illuminate\Support\Facades\Mail;
use App\Models\Notification;

use App\Mail\Visitor\bloodRequest As bloodRequesMail;


class requestController extends Controller
{
    public function makeARequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'requestNo' => ['required','string','max:255','unique:requests'],
            'nic' => ['required','string','between:10,12'],
            'bloodGroup' => ['required','string','max:255'],
            'telephone' => ['required','numeric','digits_between:9,10'],
            'email' => ['required','email'],
            'fullName' => ['required'],
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
            $requests = new BloodRequest;
            $requestNo = $request->input('requestNo');
            
            $requests->requestNo = $requestNo;
            $requests->nic = $request->input('nic');
            $requests->fullName = $request->input('fullName');
            $requests->email = $request->input('email');
            $requests->telephone = $request->input('telephone');
            $requests->bloodGroup = $request->input('bloodGroup');
            $requests->fulfilDate = '-';
            $requests->remark = '-';
            $requests->date = now();
            $requests->time = now();
            $requests->status = 'pending';

            $requests->save();

            $mailRequestNo = $request->input('requestNo');
            Mail::to($request->input('email'))->send(new bloodRequesMail($mailRequestNo));

            $notifications = new Notification;
            $notifications->notifNo = rand(100000,950000);
            $notifications->entity = 'staff';
            $notifications->text = 'New Blood Request ('.$requestNo.')';
            $notifications->date = NOW();
            $notifications->time = NOW();
            $notifications->status = '0';
            $notifications->save();
            
            return response()->json([
                'status'=>200
            ]);
        }
    }

    public function trackBloodRequest($id)
    {
        $isBloodRequestsExist = BloodRequest::select("*")->where("requestNo", $id)->exists();

        if($isBloodRequestsExist)
        {
            $bloodrequests = BloodRequest::where('requestNo', '=', $id)->get();

            return response()->json([
                'status' => 200,
                'bloodrequests'=>$bloodrequests
            ]);
        }
        else
        {
            return response()->json([
                'status' => 400
            ]);
        }
    }
}
