<?php

namespace App\Http\Controllers\Admin\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Donor;
use App\Models\Activity;
use Illuminate\Support\Facades\Mail;

class donorController extends Controller
{
    public function index()
    {
        if(auth()->guard('admin')->user()->role == 'staff')
        {
        return view('admin.dashboard.staffControls.donor');
        }
        else
        {
            return back();
        }
    }

    public function fetchDonor()
    {
        $donors = Donor::where('no','LIKE','%'.'OD'.'%')->orderBy('id', 'DESC')->get();
        return response()->json([
            'donors'=>$donors,
        ]);
    }

    public function fetchActiveDonor()
    {
        $donors = Donor::where('no','LIKE','%'.'OD'.'%')->where('status', '=', "active")->orderBy('id', 'DESC')->get();
        return response()->json([
            'donors'=>$donors,
        ]);
    }

    public function fetchInactiveDonor()
    {
        $donors = Donor::where('no','LIKE','%'.'OD'.'%')->where('status', '=', "inactive")->orderBy('id', 'DESC')->get();
        return response()->json([
            'donors'=>$donors,
        ]);
    }

    public function fetchSingleDonor($id)
    {
        $donors = Donor::where('no','LIKE','%'.'OD'.'%')->where('no', '=', $id)->orderBy('id', 'DESC')->get();
        return response()->json([
            'donors'=>$donors,
        ]);
    }

    public function searchDonor($input)
    {
        $donors = Donor::where('no','LIKE','%'.'OD'.'%')->where('nic','LIKE','%'.$input.'%')->orWhere('telephone','LIKE','%'.$input.'%')->orderBy('id', 'DESC')->get();
        return response()->json([
            'donors'=>$donors,
        ]);
    }

    public function changeDonorStatus(Request $request, $id)
    {
        $donors = Donor::where('no', $id)->update(['status' => $request->input('status')]);

        //record activity
        $activities = new Activity;
        $activities->user_id = auth()->guard('admin')->user()->id;
        $activities->task = 'Updated status of Donor No. '.$id.' as <b>'.$request->input('status').'</b>';
        $activities->date = NOW();
        $activities->time = NOW();
        $activities->save();

        return response()->json([
            'status'=>200,
            'message'=>'done'
        ]);
    }
}
