<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BloodBag;

class countsController extends Controller
{
    public function countBloodBags()
    {
        $bloodBags = BloodBag::where('bag_no','LIKE','%'.'OD'.'%')->where('status','=','available')->get();

        return response()->json([
            'blood_bags'=>$bloodBags
        ]);
    }
}
