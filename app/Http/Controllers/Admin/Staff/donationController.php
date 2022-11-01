<?php

namespace App\Http\Controllers\Admin\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Donation;
use App\Models\Donor;
use App\Models\Activity;
use App\Models\BloodBag;
use Illuminate\Support\Facades\Mail;

use App\Mail\Admin\donationNotificationMail;

class donationController extends Controller
{
    public function OpenDonatePage()
    {
        if(auth()->guard('admin')->user()->role == 'staff')
        {
        return view('admin.dashboard.staffControls.donate');
        }
        else
        {
            return back();
        }
    }

    public function getDonor($id)
    {
        $donors = Donor::where('no','LIKE','%'.'HS'.'%')->where('nic','LIKE','%'.$id.'%')->orderBy('id', 'DESC')->get();
        
        return response()->json([
            'donors'=>$donors,
            'status'=>200
        ]);
    }

    public function donate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'donorNo' => ['required','string','max:255'],
            'bloodGroup' => ['required','string','max:3'],
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
            $donationNo = 'ODDO'.rand(415000,645000);
            $staffNo = auth()->guard('admin')->user()->no;

            $bloodBagNo = 'ODBB'.rand(415000,645000);
            
            $donations = new Donation;
            $donations->donationNo = $donationNo;
            $donations->donorNo = $request->input('donorNo');
            $donations->staffNo = $staffNo;
            $donations->date = NOW();
            $donations->time = NOW();
            $donations->bloodBagNo = $bloodBagNo;
            $donations->save();

            $bloodBags = new BloodBag;
            $bloodBags->bag_no = $bloodBagNo;
            $bloodBags->bloodGroup = $request->input('bloodGroup');
            $bloodBags->received_date = NOW();
            $bloodBags->received_time = NOW();
            
            $bloodBags->expiry_date = Date('Y-m-d', strtotime('+41 days'));
            $bloodBags->status = 'available';
            $bloodBags->dateCheck = 'unchecked';
            $bloodBags->save();

            $fetchdonorEmail = Donor::where('no', '=', $request->input('donorNo'))->first();
            $donorEmail = $fetchdonorEmail['email'];
            $todayDate = Date('Y-m-d');
            Mail::to($donorEmail)->send(new donationNotificationMail($todayDate));

            //record activity
            $activities = new Activity;
            $activities->user_id = auth()->guard('admin')->user()->id;
            $activities->task = 'Made a donation for Donor No. '.$request->input('donorNo').'.';
            $activities->date = NOW();
            $activities->time = NOW();
            $activities->save();

            return response()->json([
                'status'=>200
            ]);
        }
    }
}
