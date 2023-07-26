<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;
use App\Models\Donor;
use App\Models\Activity;
use App\Models\BloodBag;
use App\Models\Appointment;
use App\Models\DonorRequest;
use App\Models\Message;
use App\Models\Admin;
use App\Models\Hospital;
use App\Models\Request as bloodRequest;

class countController extends Controller
{
    public function statistics()
    {
        if(auth()->guard('admin')->user()->role == 'admin')
        {
            $messages = Message::where('sender','LIKE','%'.'ToStaff'.'%')->where('reply_status', '=', '0')->where('admin_side_status', '=', 'unread')->where('recipient_id', '=', auth()->guard('admin')->user()->id)->count();
        }
        else
        {
            $messages = Message::where('sender','LIKE','%'.'ToStaff'.'%')->where('reply_status', '=', '0')->where('staff_side_status', '=', 'unread')->where('recipient_id', '=', auth()->guard('admin')->user()->id)->count();
        }
        
        $bloodRequests = bloodRequest::where('status', '=', 'pending')->count();
        $hospitals = Hospital::count();
        $admins = Admin::where('role', '=', 'staff')->where('status', '=', 'active')->count();
        $donors = Donor::where('no','LIKE','%'.'OD'.'%')->where('status', '=', 'active')->count();
        $appointments = Appointment::where('status', '=', 'pending')->count();
        $donorRequests = DonorRequest::where('status', '=', 'pending')->count();
        $donations = Donation::where('donationNo','LIKE','%'.'OD'.'%')->count();
        $bloodBags = BloodBag::where('bag_no','LIKE','%'.'OD'.'%')->where('status','=','available')->count();

        $bloodBagsApos = BloodBag::where('bag_no','LIKE','%'.'OD'.'%')
        ->where('status','=','available')->where('bloodGroup','=','A+')->count();
        
        $bloodBagsAneg = BloodBag::where('bag_no','LIKE','%'.'OD'.'%')
        ->where('status','=','available')->where('bloodGroup','=','A-')->count();
        
        $bloodBagsBpos = BloodBag::where('bag_no','LIKE','%'.'OD'.'%')
        ->where('status','=','available')->where('bloodGroup','=','B+')->count();
        
        $bloodBagsBneg = BloodBag::where('bag_no','LIKE','%'.'OD'.'%')
        ->where('status','=','available')->where('bloodGroup','=','B-')->count();
        
        $bloodBagsABpos = BloodBag::where('bag_no','LIKE','%'.'OD'.'%')
        ->where('status','=','available')->where('bloodGroup','=','AB+')->count();
        
        $bloodBagsABneg = BloodBag::where('bag_no','LIKE','%'.'OD'.'%')
        ->where('status','=','available')->where('bloodGroup','=','AB-')->count();
        
        $bloodBagsOpos = BloodBag::where('bag_no','LIKE','%'.'OD'.'%')
        ->where('status','=','available')->where('bloodGroup','=','O+')->count();
        
        $bloodBagsOneg = BloodBag::where('bag_no','LIKE','%'.'OD'.'%')
        ->where('status','=','available')->where('bloodGroup','=','O-')->count();
        

        return response()->json([
            'messages' => $messages, 
            'bloodRequests' => $bloodRequests, 
            'hospitals' => $hospitals,
            'admins' => $admins,
            'donors' => $donors,
            'appointments' => $appointments,
            'donorRequests' => $donorRequests,
            'donations' => $donations,
            'bloodBags' => $bloodBags,

            'bloodBagsApos' => $bloodBagsApos, 
            'bloodBagsAneg' => $bloodBagsAneg, 
            'bloodBagsBpos' => $bloodBagsBpos,
            'bloodBagsBneg' => $bloodBagsBneg,
            'bloodBagsABpos' => $bloodBagsABpos,
            'bloodBagsABneg' => $bloodBagsABneg,
            'bloodBagsOpos' => $bloodBagsOpos,
            'bloodBagsOneg' => $bloodBagsOneg
        ]);
    }
}
