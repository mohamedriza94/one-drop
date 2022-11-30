<?php

namespace App\Http\Controllers\Donor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;
use App\Models\BloodBag;

class donationController extends Controller
{
    public function trackDonation($id)
    {
        $isDonationExist = Donation::select("*")->where("donationNo", $id)->where("donorNo", auth()->guard('donor')->user()->no)->exists();
        
        if($isDonationExist)
        {
            $donations = Donation::join('donors', 'donations.donorNo', '=', 'donors.no')
            ->join('blood_bags', 'donations.bloodBagNo', '=', 'blood_bags.bag_no')
            ->where('donations.donationNo', $id)
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
                    'blood_bags.expiry_date AS expDate',
                    'blood_bags.bloodGroup AS bloodGroup',
                    'blood_bags.status AS blood_status',
                    ]
                );
                
                return response()->json([
                    'donations'=>$donations
                ]);
            }
            else
            {
                return response()->json([
                    'status' => 400
                ]);
            }
        }
        
        public function fetchDonationHistory()
        {
            $donations = Donation::join('blood_bags', 'donations.bloodBagNo', '=', 'blood_bags.bag_no')->where('donations.donorNo', '=', auth()->guard('donor')->user()->no)->get();
            
            return response()->json([
                'donations'=>$donations
            ]);
        }
    }
