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
    public function countUnreadMessages()
    {
        $messages = Message::where('sender','LIKE','%'.'ToHospital'.'%')->where('hospital_side_status', '=', 'unread')->where('recipient_id', '=', auth()->guard('hospital')->user()->id)->count();

        echo json_encode($messages);
    }

    public function countBloodRequests()
    {
        $bloodRequests = bloodRequest::where('hospitalResponse', '=', 'pending')->where('hospitalNo','=', auth()->guard('hospital')->user()->id)->count();

        echo json_encode($bloodRequests);
    }

    public function countDonors()
    {
        $donors = Donor::where('no','LIKE','%'.'HS'.'%')->where('hospital', '=', auth()->guard('hospital')->user()->id)->where('status', '=', 'active')->count();

        echo json_encode($donors);
    }
    
    public function countDonations()
    {
        $donations = Donation::join('donors', 'donations.donorNo', '=', 'donors.no')->where('donors.hospital', auth()->guard('hospital')->user()->id)->count();

        echo json_encode($donations);
    }
    
    
    public function countBloodBags()
    {
        $bloodBags = BloodBag::where('bag_no','LIKE','%'.'HS'.'%')->where('status','=','available')->where('hospital','=', auth()->guard('hospital')->user()->id)->count();

        echo json_encode($bloodBags);
    }

    //blood groups
    public function countBloodBags_Apos()
    {
        $bloodBags = BloodBag::where('bag_no','LIKE','%'.'HSOD'.'%')->where('status','=','available')->where('bloodGroup','=','A+')->where('hospital','=', auth()->guard('hospital')->user()->id)->count();
        echo json_encode($bloodBags);
    }

    public function countBloodBags_Aneg()
    {
        $bloodBags = BloodBag::where('bag_no','LIKE','%'.'HS'.'%')->where('status','=','available')->where('bloodGroup','=','A-')->where('hospital','=', auth()->guard('hospital')->user()->id)->count();
        echo json_encode($bloodBags);
    }
    
    public function countBloodBags_Bpos()
    {
        $bloodBags = BloodBag::where('bag_no','LIKE','%'.'HS'.'%')->where('status','=','available')->where('bloodGroup','=','B+')->where('hospital','=', auth()->guard('hospital')->user()->id)->count();
        echo json_encode($bloodBags);
    }

    public function countBloodBags_Bneg()
    {
        $bloodBags = BloodBag::where('bag_no','LIKE','%'.'HS'.'%')->where('status','=','available')->where('bloodGroup','=','B-')->where('hospital','=', auth()->guard('hospital')->user()->id)->count();
        echo json_encode($bloodBags);
    }
    
    public function countBloodBags_ABpos()
    {
        $bloodBags = BloodBag::where('bag_no','LIKE','%'.'HS'.'%')->where('status','=','available')->where('bloodGroup','=','AB+')->where('hospital','=', auth()->guard('hospital')->user()->id)->count();
        echo json_encode($bloodBags);
    }

    public function countBloodBags_ABneg()
    {
        $bloodBags = BloodBag::where('bag_no','LIKE','%'.'HS'.'%')->where('status','=','available')->where('bloodGroup','=','AB-')->where('hospital','=', auth()->guard('hospital')->user()->id)->count();
        echo json_encode($bloodBags);
    }
    
    public function countBloodBags_Opos()
    {
        $bloodBags = BloodBag::where('bag_no','LIKE','%'.'HS'.'%')->where('status','=','available')->where('bloodGroup','=','O+')->where('hospital','=', auth()->guard('hospital')->user()->id)->count();
        echo json_encode($bloodBags);
    }

    public function countBloodBags_Oneg()
    {
        $bloodBags = BloodBag::where('bag_no','LIKE','%'.'HS'.'%')->where('status','=','available')->where('bloodGroup','=','O-')->where('hospital','=', auth()->guard('hospital')->user()->id)->count();
        echo json_encode($bloodBags);
    }
}
