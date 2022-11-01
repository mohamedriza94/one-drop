<?php

namespace App\Http\Controllers\Admin\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Donation;
use App\Models\Donor;
use App\Models\Activity;
use App\Models\BloodBag;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class bloodBagController extends Controller
{
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
    }
}
