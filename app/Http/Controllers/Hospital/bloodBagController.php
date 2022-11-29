<?php

namespace App\Http\Controllers\Hospital;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Donation;
use App\Models\Donor;
use App\Models\Activity;
use App\Models\BloodBag;

class bloodBagController extends Controller
{
    public function index()
    {
        return view('hospital.dashboard.bloodBag');
    }

    public function fetchBloodBags()
    {
        $bloodBags = BloodBag::where('bag_no','LIKE','%'.'HS'.'%')->orderBy('id','DESC')->get();

        return response()->json([
            'blood_bags'=>$bloodBags
        ]);
    }

    public function fetchAvailableBloodBags()
    {
        $bloodBags = BloodBag::where('bag_no','LIKE','%'.'HS'.'%')->where('status','=','available')->orderBy('id','DESC')->get();

        return response()->json([
            'blood_bags'=>$bloodBags
        ]);
    }

    public function fetchExpiredBloodBags()
    {
        $bloodBags = BloodBag::where('bag_no','LIKE','%'.'HS'.'%')->where('status','=','expired')->orderBy('id','DESC')->get();

        return response()->json([
            'blood_bags'=>$bloodBags
        ]);
    }

    public function fetchUsedBloodBags()
    {
        $bloodBags = BloodBag::where('bag_no','LIKE','%'.'HS'.'%')->where('status','=','used')->orderBy('id','DESC')->get();

        return response()->json([
            'blood_bags'=>$bloodBags
        ]);
    }

    public function fetchCustomBloodBags($bloodGroup)
    {
        $bloodBags = BloodBag::where('bag_no','LIKE','%'.'HS'.'%')->where('status','=','available')->where('bloodGroup','=',$bloodGroup)->orderBy('id','DESC')->get();

        return response()->json([
            'blood_bags'=>$bloodBags
        ]);
    }
    
    public function fetchSingleBloodBag($bloodBagNo)
    {
        $bloodBags = BloodBag::join('donations', 'blood_bags.bag_no', '=', 'donations.bloodBagNo')
        ->join('donors', 'donations.donorNo', '=', 'donors.no')
        ->where('blood_bags.bag_no', $bloodBagNo)
        ->get();
        return response()->json([
            'blood_bags'=>$bloodBags
        ]);
    }

    public function fetchAvailableBlood($bloodGroup)
    {
        $checkbloodBags = BloodBag::where('bag_no','LIKE','%'.'HS'.'%')->where('status','=','available')->where('bloodGroup','=',$bloodGroup)->orderBy('id','DESC')->first();
        
        if($checkbloodBags)
        {
            $bloodBags = BloodBag::where('bag_no','LIKE','%'.'HS'.'%')->where('status','=','available')->where('bloodGroup','=',$bloodGroup)->orderBy('id','DESC')->get();
            
            return response()->json([
                'status'=>200,
                'blood_bags'=>$bloodBags
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404
            ]);
        }
    }
}
