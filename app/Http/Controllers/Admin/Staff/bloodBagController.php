<?php

namespace App\Http\Controllers\Admin\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Donation;
use App\Models\Donor;
use App\Models\Activity;
use App\Models\BloodBag;
use App\Models\Notification;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class bloodBagController extends Controller
{
    public function index()
    {
        if(auth()->guard('admin')->user()->role == 'staff')
        {
            return view('admin.dashboard.staffControls.bloodBag');
        }
        else
        {
            return back();
        }
    }
    
    public function checkBloodExpiryDate()
    {
        $bloodBags = BloodBag::where('status', '!=', 'expired')->where('status', '!=', 'used')->where('dateCheck','=','unchecked')->orderBy('id', 'DESC')->first();
        
        $expiryDate = $bloodBags['expiry_date'];
        $fetchedBloodBagNo = $bloodBags['id'];
        
        $result = Carbon::createFromFormat('Y-m-d', $expiryDate)->isPast();
        
        if($result=="0") //not expired
        {
            $updateNotExpired = BloodBag::where('id', $fetchedBloodBagNo)->update(['dateCheck' => 'checked']);
        }
        else if($result=="1")//expired
        {
            $updateExpired = BloodBag::where('id', $fetchedBloodBagNo)->update(['status' => 'expired','dateCheck' => 'checked']);
        }
    }
    
    public function updateCheckStatus()
    {
        BloodBag::where('status', '!=', 'expired')->where('status', '!=', 'used')->where('dateCheck', '=', 'checked')->update(['dateCheck' => 'unchecked']);
        
        $notifications = new Notification;
        $notifications->notifNo = rand(100000,950000);
        $notifications->entity = 'commonStf';
        $notifications->text = 'Blood Bag Expired';
        $notifications->date = NOW();
        $notifications->time = NOW();
        $notifications->status = '0';
        $notifications->link = "#";
        $notifications->save();
    }
    
    public function fetchBloodBags()
    {
        $bloodBags = BloodBag::where('bag_no','LIKE','%'.'OD'.'%')->orderBy('id','DESC')->get();
        
        return response()->json([
            'blood_bags'=>$bloodBags
        ]);
    }
    
    public function fetchAvailableBloodBags()
    {
        $bloodBags = BloodBag::where('bag_no','LIKE','%'.'OD'.'%')->where('status','=','available')->orderBy('id','DESC')->get();
        
        return response()->json([
            'blood_bags'=>$bloodBags
        ]);
    }
    
    public function fetchExpiredBloodBags()
    {
        $bloodBags = BloodBag::where('bag_no','LIKE','%'.'OD'.'%')->where('status','=','expired')->orderBy('id','DESC')->get();
        
        return response()->json([
            'blood_bags'=>$bloodBags
        ]);
    }
    
    public function fetchUsedBloodBags()
    {
        $bloodBags = BloodBag::where('bag_no','LIKE','%'.'OD'.'%')->where('status','=','used')->orderBy('id','DESC')->get();
        
        return response()->json([
            'blood_bags'=>$bloodBags
        ]);
    }
    
    public function fetchCustomBloodBags($bloodGroup)
    {
        $bloodBags = BloodBag::where('bag_no','LIKE','%'.'OD'.'%')
        ->where('status','=','available')->where('bloodGroup','=',$bloodGroup)
        ->orderBy('id','DESC')->get();
        
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
}
