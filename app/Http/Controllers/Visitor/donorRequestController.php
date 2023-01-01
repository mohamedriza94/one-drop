<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\DonorRequest;
use App\Models\Notification;

class donorRequestController extends Controller
{
    public function makeDonorRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'donorRequestNo' => ['required','string','max:255','unique:donor_requests'],
            'nic' => ['required','string','between:10,12','unique:donor_requests'],
            'age' => ['required','numeric','max:45','min:18'],
            'dateOfBirth' => ['required','string','max:11'],
            'telephone' => ['required','numeric','digits_between:9,10','unique:donor_requests'],
            'email' => ['required','email','unique:donor_requests'],
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
            //splitting and imploding telephone input to filter our zeros and enter 0094
            $split_telephone_string = str_split($request->input('telephone'));
            $filteredArray = array_diff($split_telephone_string, [$split_telephone_string[0]]);
            $telephone_imploded = implode("", $filteredArray);
            $telephone_final_string = '+94'.$telephone_imploded;

            $donorRequests = new DonorRequest;
            $donorRequests->donorRequestNo = $request->input('donorRequestNo');
            $donorRequests->nic = $request->input('nic');
            $donorRequests->fullName = $request->input('fullName');
            $donorRequests->email = $request->input('email');
            $donorRequests->telephone = $telephone_final_string;
            $donorRequests->age = $request->input('age');
            $donorRequests->dateOfBirth = $request->input('dateOfBirth');
            $donorRequests->date = now();
            $donorRequests->time = now();
            $donorRequests->status = 'pending';
            
            $donorRequests->save();
            
            $notifications = new Notification;
            $notifications->notifNo = rand(100000,950000);
            $notifications->entity = 'commonStf';
            $notifications->text = 'New Donor Request ('.$request->input('donorRequestNo').')';
            $notifications->date = NOW();
            $notifications->time = NOW();
            $notifications->status = '0';
            $notifications->link = "dashboard/staff/donorRequest";
            $notifications->save();
            
            return response()->json([
                'status'=>200
            ]);
        }
    }
}
