<?php

namespace App\Http\Controllers\Hospital;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Donation;
use App\Models\Donor;
use App\Models\Request as BloodRequest;
use App\Models\Activity;
use App\Models\BloodBag;
use Illuminate\Support\Facades\Mail;

use App\Mail\Hospital\donationNotificationMail;

class donationController extends Controller
{
    public function index()
    {
        return view('hospital.dashboard.donation');
    }

    public function trackingPage()
    {
        return view('hospital.dashboard.tracking');
    }

    public function OpenDonatePage()
    {
        return view('hospital.dashboard.donate');
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
            $donationNo = 'HSDO'.rand(415000,645000);
            $staffNo = auth()->guard('hospital')->user()->no;

            $bloodBagNo = 'HSBB'.rand(415000,645000);
            
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
            $hospitalName = auth()->guard('hospital')->user()->name;
            Mail::to($donorEmail)->send(new donationNotificationMail($todayDate,$hospitalName));

            //record activity
            $activities = new Activity;
            $activities->user_id = auth()->guard('hospital')->user()->id;
            $activities->task = 'Hospital No. '.auth()->guard('hospital')->user()->id.' Made a donation for Donor No. '.$request->input('donorNo').'.';
            $activities->date = NOW();
            $activities->time = NOW();
            $activities->save();

            return response()->json([
                'status'=>200
            ]);
        }
    }

    public function fetchDonation()
    {
        $donation = Donation::leftJoin('blood_bags', 'donations.bloodBagNo', '=', 'blood_bags.bag_no')->orderBy('donations.id','DESC')->get();

        return response()->json([
            'donations'=>$donation
        ]);
    }

    public function trackDonation($donationNo)
    {
        $donations = Donation::join('donors', 'donations.donorNo', '=', 'donors.no')
        ->join('blood_bags', 'donations.bloodBagNo', '=', 'blood_bags.bag_no')
        ->where('donations.donationNo', $donationNo)
        ->get(
            [
                //aliasing names
                'donors.no AS donorNo',
                'donors.photo AS photo',
                'donors.fullname AS fullname',
                'donors.address AS address',
                'donors.telephone AS telephone',
                'donors.email AS email',
                'donors.gender AS gender',
                'donors.dateofbirth AS dateofbirth',
                'donors.age AS age',
                'donors.status AS donorStatus',

                'donations.donationNo AS donationNo',
                'donations.date AS received_date',
                'donations.time AS received_time',
                
                'blood_bags.bag_no AS bag_no',
                'blood_bags.bloodGroup AS bloodGroup',
                'blood_bags.status AS blood_status',
            ]
        );
        return response()->json([
            'donations'=>$donations
        ]);
    }

    public function trackDonationReceiver($receivedBloodBagNo)
    {
        $requests = BloodRequest::where('bloodBagNo', $receivedBloodBagNo)->get();
        
        return response()->json([
            'requests'=>$requests
        ]);
    }
}
