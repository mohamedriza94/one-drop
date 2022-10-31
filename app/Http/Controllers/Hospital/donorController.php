<?php

namespace App\Http\Controllers\hospital;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Donor;
use App\Models\Activity;

class donorController extends Controller
{
    public function index(Request $request)
    {
        return view('hospital.dashboard.donor');
    }

    public function fetchDonor()
    {
        $donors = Donor::where('hospital','=', auth()->guard('hospital')->user()->no)->where('no','LIKE','%'.'HS'.'%')->orderBy('id', 'DESC')->get();
        return response()->json([
            'donors'=>$donors,
        ]);
    }

    public function fetchActiveDonor()
    {
        $donors = Donor::where('hospital','=', auth()->guard('hospital')->user()->no)->where('no','LIKE','%'.'HS'.'%')->where('status', '=', "active")->orderBy('id', 'DESC')->get();
        return response()->json([
            'donors'=>$donors,
        ]);
    }

    public function fetchInactiveDonor()
    {
        $donors = Donor::where('hospital','=', auth()->guard('hospital')->user()->no)->where('no','LIKE','%'.'HS'.'%')->where('status', '=', "inactive")->orderBy('id', 'DESC')->get();
        return response()->json([
            'donors'=>$donors,
        ]);
    }

    public function fetchSingleDonor($id)
    {
        $donors = Donor::where('hospital','=', auth()->guard('hospital')->user()->no)->where('no','LIKE','%'.'HS'.'%')->where('no', '=', $id)->orderBy('id', 'DESC')->get();
        return response()->json([
            'donors'=>$donors,
        ]);
    }

    public function searchDonor($input)
    {
        $donors = Donor::where('hospital','=', auth()->guard('hospital')->user()->no)->where('no','LIKE','%'.'HS'.'%')->where('nic','LIKE','%'.$input.'%')->orWhere('telephone','LIKE','%'.$input.'%')->orderBy('id', 'DESC')->get();
        return response()->json([
            'donors'=>$donors,
        ]);
    }

    public function changeDonorStatus(Request $request, $id)
    {
        $donors = Donor::where('hospital','=', auth()->guard('hospital')->user()->no)->where('no','LIKE','%'.'HS'.'%')->where('no', $id)->update(['status' => $request->input('status')]);

        //record activity
        $activities = new Activity;
        $activities->user_id = auth()->guard('hospital')->user()->no;
        $activities->task = 'Updated status of Hospital Donor No. '.$id.' as <b>'.$request->input('status').'</b>';
        $activities->date = NOW();
        $activities->time = NOW();
        $activities->save();

        return response()->json([
            'status'=>200,
            'message'=>'done'
        ]);
    }
}
