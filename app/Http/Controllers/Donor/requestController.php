<?php

namespace App\Http\Controllers\Donor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Request As BloodRequest;

class requestController extends Controller
{
    public function fetchRequestHistory($nic)
    {
        $bloodrequests = BloodRequest::where('nic', '=', $nic)->get();
        
        return response()->json([
            'bloodrequests'=>$bloodrequests
        ]);
    }
}
