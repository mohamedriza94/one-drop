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
    public function countUnreadMessages()
    {
        $messages = Message::where('sender','LIKE','%'.'ToStaff'.'%')->where('staff_side_status', '=', 'unread')->where('recipient_id', '=', auth()->guard('admin')->user()->no)->count();

        echo json_encode($messages);
    }

    public function countBloodRequests()
    {
        $bloodRequests = bloodRequest::where('status', '=', 'pending')->count();

        echo json_encode($bloodRequests);
    }

    public function countHospital()
    {
        $hospitals = Hospital::count();

        echo json_encode($hospitals);
    }

    public function countStaff()
    {
        $admins = Admin::where('role', '=', 'staff')->where('status', '=', 'active')->count();

        echo json_encode($admins);
    }
    
    public function countDonors()
    {
        $donors = Donor::where('no','LIKE','%'.'OD'.'%')->where('status', '=', 'active')->count();

        echo json_encode($donors);
    }
    
    public function countAppointments()
    {
        $appointments = Appointment::where('status', '=', 'pending')->count();

        echo json_encode($appointments);
    }
    
    public function countDonorRequests()
    {
        $donorRequests = DonorRequest::where('status', '=', 'pending')->count();

        echo json_encode($donorRequests);
    }
    
    public function countDonations()
    {
        $donations = Donation::where('donationNo','LIKE','%'.'OD'.'%')->count();

        echo json_encode($donations);
    }
    
    
    public function countBloodBags()
    {
        $bloodBags = BloodBag::where('bag_no','LIKE','%'.'OD'.'%')->where('status','=','available')->count();

        echo json_encode($bloodBags);
    }

    //blood groups
    public function countBloodBags_Apos()
    {
        $bloodBags = BloodBag::where('bag_no','LIKE','%'.'OD'.'%')->where('status','=','available')->where('bloodGroup','=','A+')->count();

        echo json_encode($bloodBags);
    }

    public function countBloodBags_Aneg()
    {
        $bloodBags = BloodBag::where('bag_no','LIKE','%'.'OD'.'%')->where('status','=','available')->where('bloodGroup','=','A-')->count();

        echo json_encode($bloodBags);
    }
    
    public function countBloodBags_Bpos()
    {
        $bloodBags = BloodBag::where('bag_no','LIKE','%'.'OD'.'%')->where('status','=','available')->where('bloodGroup','=','B+')->count();

        echo json_encode($bloodBags);
    }

    public function countBloodBags_Bneg()
    {
        $bloodBags = BloodBag::where('bag_no','LIKE','%'.'OD'.'%')->where('status','=','available')->where('bloodGroup','=','B-')->count();

        echo json_encode($bloodBags);
    }
    
    public function countBloodBags_ABpos()
    {
        $bloodBags = BloodBag::where('bag_no','LIKE','%'.'OD'.'%')->where('status','=','available')->where('bloodGroup','=','AB+')->count();

        echo json_encode($bloodBags);
    }

    public function countBloodBags_ABneg()
    {
        $bloodBags = BloodBag::where('bag_no','LIKE','%'.'OD'.'%')->where('status','=','available')->where('bloodGroup','=','AB-')->count();

        echo json_encode($bloodBags);
    }
    
    public function countBloodBags_Opos()
    {
        $bloodBags = BloodBag::where('bag_no','LIKE','%'.'OD'.'%')->where('status','=','available')->where('bloodGroup','=','O+')->count();

        echo json_encode($bloodBags);
    }

    public function countBloodBags_Oneg()
    {
        $bloodBags = BloodBag::where('bag_no','LIKE','%'.'OD'.'%')->where('status','=','available')->where('bloodGroup','=','O-')->count();

        echo json_encode($bloodBags);
    }
}
