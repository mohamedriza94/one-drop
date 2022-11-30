<?php

namespace App\Http\Controllers\Donor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BloodBag;
use App\Models\Donation;
use App\Models\Donor;
use App\Models\Request as bloodRequest;


class countController extends Controller
{
    //blood groups
    public function countBloodBags_cat()
    {
        $bloodBagsApos = BloodBag::where('bag_no','LIKE','%'.'OD'.'%')->where('status','=','available')->where('bloodGroup','=','A+')->count();
        $bloodBagsAneg = BloodBag::where('bag_no','LIKE','%'.'OD'.'%')->where('status','=','available')->where('bloodGroup','=','A-')->count();
        $bloodBagsBpos = BloodBag::where('bag_no','LIKE','%'.'OD'.'%')->where('status','=','available')->where('bloodGroup','=','B+')->count();
        $bloodBagsBneg = BloodBag::where('bag_no','LIKE','%'.'OD'.'%')->where('status','=','available')->where('bloodGroup','=','B-')->count();
        $bloodBagsABpos = BloodBag::where('bag_no','LIKE','%'.'OD'.'%')->where('status','=','available')->where('bloodGroup','=','AB+')->count();
        $bloodBagsABneg = BloodBag::where('bag_no','LIKE','%'.'OD'.'%')->where('status','=','available')->where('bloodGroup','=','AB-')->count();
        $bloodBagsOpos = BloodBag::where('bag_no','LIKE','%'.'OD'.'%')->where('status','=','available')->where('bloodGroup','=','O+')->count();
        $bloodBagsOneg = BloodBag::where('bag_no','LIKE','%'.'OD'.'%')->where('status','=','available')->where('bloodGroup','=','O-')->count();
        
        return response()->json([
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
    
    public function otherCounts()
    {
        $donationsMade = Donation::where('donationNo','LIKE','%'.'OD'.'%')->where('donorNo','=',auth()->guard('donor')->user()->no)->count();
        $bloodRequestsMade = bloodRequest::where('status', '=', 'pending')->where('nic','=',auth()->guard('donor')->user()->nic)->count();
        $donations = Donation::where('donationNo','LIKE','%'.'OD'.'%')->count();
        $donors = Donor::where('no','LIKE','%'.'OD'.'%')->where('status', '=', 'active')->count();
        $bloodBags = BloodBag::where('bag_no','LIKE','%'.'OD'.'%')->where('status','=','available')->count();

        return response()->json([
            'donationsMade' => $donationsMade, 
            'bloodRequestsMade' => $bloodRequestsMade, 
            'donations' => $donations,
            'donors' => $donors,
            'bloodBags' => $bloodBags
        ]);
    }
  
    public function getNextDonationDate()
    {
        $donations = Donation::join('donors', 'donations.donorNo', '=', 'donors.no')
        ->join('blood_bags', 'donations.bloodBagNo', '=', 'blood_bags.bag_no')
        ->where('donors.no', auth()->guard('donor')->user()->no)
        ->first();
        
        $nextDate = date('Y-m-d', strtotime($donations['expiry_date']. ' + 15 days'));
        
        return response()->json([
            'nextDate'=>$nextDate
        ]);
    }
}
