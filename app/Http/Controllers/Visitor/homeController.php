<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BloodBag;
use App\Models\Donation;
use App\Models\Donor;

class homeController extends Controller
{
    public function index()
    {
        return view('visitor.dashboard.home');
    }
    
    public function donorLogin()
    {
        return view('donor.auth.login');
    }
    
    public function homePageStatistics()
    {
        $donations = Donation::where('donationNo','LIKE','%'.'OD'.'%')->count();
        $donors = Donor::where('no','LIKE','%'.'OD'.'%')->where('status', '=', 'active')->count();
        
        $bloodBagsApos = BloodBag::where('bag_no','LIKE','%'.'OD'.'%')->where('status','=','available')->where('bloodGroup','=','A+')->count();
        $bloodBagsAneg = BloodBag::where('bag_no','LIKE','%'.'OD'.'%')->where('status','=','available')->where('bloodGroup','=','A-')->count();
        $bloodBagsBpos = BloodBag::where('bag_no','LIKE','%'.'OD'.'%')->where('status','=','available')->where('bloodGroup','=','B+')->count();
        $bloodBagsBneg = BloodBag::where('bag_no','LIKE','%'.'OD'.'%')->where('status','=','available')->where('bloodGroup','=','B-')->count();
        $bloodBagsABpos = BloodBag::where('bag_no','LIKE','%'.'OD'.'%')->where('status','=','available')->where('bloodGroup','=','AB+')->count();
        $bloodBagsABneg = BloodBag::where('bag_no','LIKE','%'.'OD'.'%')->where('status','=','available')->where('bloodGroup','=','AB-')->count();
        $bloodBagsOpos = BloodBag::where('bag_no','LIKE','%'.'OD'.'%')->where('status','=','available')->where('bloodGroup','=','O+')->count();
        $bloodBagsOneg = BloodBag::where('bag_no','LIKE','%'.'OD'.'%')->where('status','=','available')->where('bloodGroup','=','O-')->count();
        
        return response()->json([
            'donations' => $donations,
            'donors' => $donors,
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
