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
    public function homePageStatistics()
    {
        $donorType = auth()->guard('donor')->user()->hospital;

        if(is_null($donorType))
        {
            $donorType = "OD";
        }
        else
        {
            $donorType = "HS";
        }
        
        $donationsMade = Donation::where('donationNo','LIKE','%'.$donorType.'%')->where('donorNo','=',auth()->guard('donor')->user()->no)->count();
        $bloodRequestsMade = bloodRequest::where('status', '=', 'pending')->where('nic','=',auth()->guard('donor')->user()->nic)->count();
        $donations = Donation::where('donationNo','LIKE','%'.$donorType.'%')->count();
        $donors = Donor::where('no','LIKE','%'.'OD'.'%')->where('status', '=', 'active')->count();
        $bloodBags = BloodBag::where('bag_no','LIKE','%'.$donorType.'%')->where('status','=','available')->count();

        $bloodBagsApos = BloodBag::where('bag_no','LIKE','%'.$donorType.'%')->where('status','=','available')->where('bloodGroup','=','A+')->count();
        $bloodBagsAneg = BloodBag::where('bag_no','LIKE','%'.$donorType.'%')->where('status','=','available')->where('bloodGroup','=','A-')->count();
        $bloodBagsBpos = BloodBag::where('bag_no','LIKE','%'.$donorType.'%')->where('status','=','available')->where('bloodGroup','=','B+')->count();
        $bloodBagsBneg = BloodBag::where('bag_no','LIKE','%'.$donorType.'%')->where('status','=','available')->where('bloodGroup','=','B-')->count();
        $bloodBagsABpos = BloodBag::where('bag_no','LIKE','%'.$donorType.'%')->where('status','=','available')->where('bloodGroup','=','AB+')->count();
        $bloodBagsABneg = BloodBag::where('bag_no','LIKE','%'.$donorType.'%')->where('status','=','available')->where('bloodGroup','=','AB-')->count();
        $bloodBagsOpos = BloodBag::where('bag_no','LIKE','%'.$donorType.'%')->where('status','=','available')->where('bloodGroup','=','O+')->count();
        $bloodBagsOneg = BloodBag::where('bag_no','LIKE','%'.$donorType.'%')->where('status','=','available')->where('bloodGroup','=','O-')->count();
        
        //check if donor has donated previosly
        $isDonationExist = Donation::select("*")->where("donorNo", auth()->guard('donor')->user()->no)->exists();

        if($isDonationExist)
        {
            $donationDate = Donation::join('donors', 'donations.donorNo', '=', 'donors.no')
            ->join('blood_bags', 'donations.bloodBagNo', '=', 'blood_bags.bag_no')
            ->where('donors.no', auth()->guard('donor')->user()->no)
            ->first();
            
            $nextDate = date('Y-m-d', strtotime($donationDate['expiry_date']. ' + 15 days'));
            
            return response()->json([
                'donationsMade' => $donationsMade, 
                'bloodRequestsMade' => $bloodRequestsMade, 
                'donations' => $donations,
                'donors' => $donors,
                'bloodBags' => $bloodBags,
                
                'bloodBagsApos' => $bloodBagsApos, 
                'bloodBagsAneg' => $bloodBagsAneg, 
                'bloodBagsBpos' => $bloodBagsBpos,
                'bloodBagsBneg' => $bloodBagsBneg,
                'bloodBagsABpos' => $bloodBagsABpos,
                'bloodBagsABneg' => $bloodBagsABneg,
                'bloodBagsOpos' => $bloodBagsOpos,
                'bloodBagsOneg' => $bloodBagsOneg,
                
                'nextDate'=>$nextDate
            ]);
    
        }
        else
        {
            $nextDate = 'N/A';
            
            return response()->json([
                'donationsMade' => $donationsMade, 
                'bloodRequestsMade' => $bloodRequestsMade, 
                'donations' => $donations,
                'donors' => $donors,
                'bloodBags' => $bloodBags,
                
                'bloodBagsApos' => $bloodBagsApos, 
                'bloodBagsAneg' => $bloodBagsAneg, 
                'bloodBagsBpos' => $bloodBagsBpos,
                'bloodBagsBneg' => $bloodBagsBneg,
                'bloodBagsABpos' => $bloodBagsABpos,
                'bloodBagsABneg' => $bloodBagsABneg,
                'bloodBagsOpos' => $bloodBagsOpos,
                'bloodBagsOneg' => $bloodBagsOneg,
                
                'nextDate'=>$nextDate
            ]);
    
        }

        

        
    }
}
