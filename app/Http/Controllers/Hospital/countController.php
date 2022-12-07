<?php

namespace App\Http\Controllers\Hospital;

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
        $messages = Message::where('sender','LIKE','%'.'ToHospital'.'%')->where('hospital_side_status', '=', 'unread')->where('recipient_id', '=', auth()->guard('hospital')->user()->no)->count();
        $bloodRequests = bloodRequest::where('hospitalResponse', '=', 'pending')->where('hospitalNo','=', auth()->guard('hospital')->user()->no)->count();
        $donors = Donor::where('no','LIKE','%'.'HS'.'%')->where('hospital', '=', auth()->guard('hospital')->user()->no)->where('status', '=', 'active')->count();
        $donations = Donation::join('donors', 'donations.donorNo', '=', 'donors.no')->where('donors.hospital', auth()->guard('hospital')->user()->no)->count();
        $bloodBags = BloodBag::where('bag_no','LIKE','%'.'HS'.'%')->where('status','=','available')->where('hospital','=', auth()->guard('hospital')->user()->no)->count();

        $bloodBagsApos = BloodBag::where('bag_no','LIKE','%'.'HSOD'.'%')->where('status','=','available')->where('bloodGroup','=','A+')->where('hospital','=', auth()->guard('hospital')->user()->no)->count();
        $bloodBagsAneg = BloodBag::where('bag_no','LIKE','%'.'HS'.'%')->where('status','=','available')->where('bloodGroup','=','A-')->where('hospital','=', auth()->guard('hospital')->user()->no)->count();
        $bloodBagsBpos = BloodBag::where('bag_no','LIKE','%'.'HS'.'%')->where('status','=','available')->where('bloodGroup','=','B+')->where('hospital','=', auth()->guard('hospital')->user()->no)->count();
        $bloodBagsBneg = BloodBag::where('bag_no','LIKE','%'.'HS'.'%')->where('status','=','available')->where('bloodGroup','=','B-')->where('hospital','=', auth()->guard('hospital')->user()->no)->count();
        $bloodBagsABpos = BloodBag::where('bag_no','LIKE','%'.'HS'.'%')->where('status','=','available')->where('bloodGroup','=','AB+')->where('hospital','=', auth()->guard('hospital')->user()->no)->count();
        $bloodBagsABneg = BloodBag::where('bag_no','LIKE','%'.'HS'.'%')->where('status','=','available')->where('bloodGroup','=','AB-')->where('hospital','=', auth()->guard('hospital')->user()->no)->count();
        $bloodBagsOpos = BloodBag::where('bag_no','LIKE','%'.'HS'.'%')->where('status','=','available')->where('bloodGroup','=','O+')->where('hospital','=', auth()->guard('hospital')->user()->no)->count();
        $bloodBagsOneg = BloodBag::where('bag_no','LIKE','%'.'HS'.'%')->where('status','=','available')->where('bloodGroup','=','O-')->where('hospital','=', auth()->guard('hospital')->user()->no)->count();

        return response()->json([
            'messages' => $messages, 
            'bloodRequests' => $bloodRequests, 
            'donors' => $donors,
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
