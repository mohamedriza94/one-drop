<?php

namespace App\Http\Controllers\Admin\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\DonorRequest;
use App\Models\Appointment;
use App\Models\Activity;

class donorRequestController extends Controller
{
    public function index()
    {
        if(auth()->guard('admin')->user()->role == 'staff')
        {
        return view('admin.dashboard.staffControls.donorRequest');
        }
        else
        {
            return back();
        }
    }

    public function fetchDonorRequest()
    {
        $donorRequests = DonorRequest::orderBy('id', 'DESC')->get();
        return response()->json([
            'donorRequests'=>$donorRequests,
        ]);
    }

    public function fetchScheduledDonorRequest()
    {
        $donorRequests = DonorRequest::where('status', '=', "scheduled")->orderBy('id', 'DESC')->get();
        return response()->json([
            'donorRequests'=>$donorRequests,
        ]);
    }

    public function fetchDeclinedDonorRequest()
    {
        $donorRequests = DonorRequest::where('status', '=', "declined")->orderBy('id', 'DESC')->get();
        return response()->json([
            'donorRequests'=>$donorRequests,
        ]);
    }

    public function fetchAcceptedDonorRequest()
    {
        $donorRequests = DonorRequest::where('status', '=', "accepted")->orderBy('id', 'DESC')->get();
        return response()->json([
            'donorRequests'=>$donorRequests,
        ]);
    }

    public function fetchPendingDonorRequest()
    {
        $donorRequests = DonorRequest::where('status', '=', "pending")->orderBy('id', 'DESC')->get();
        return response()->json([
            'donorRequests'=>$donorRequests,
        ]);
    }

    public function searchDonorRequest($input)
    {
        $donorRequests = DonorRequest::where('nic','LIKE','%'.$input.'%')->orWhere('telephone','LIKE','%'.$input.'%')->orderBy('id', 'DESC')->get();
        return response()->json([
            'donorRequests'=>$donorRequests,
        ]);
    }

    public function scheduleAppointment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'donorRequestNo' => ['required','string','max:255','unique:appointments'],
            'appointment_no' => ['required','string','max:15','unique:appointments'],
            'appointmentDate' => ['required'],
            'appointmentTime' => ['required'],
            'appointmentVenue' => ['required'],
        ]); //validate all the data

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages()
            ]);
        }
        else
        {
            $appointments = new Appointment;
            $appointments->donorRequestNo = $request->input('donorRequestNo');
            $appointments->appointment_no = $request->input('appointment_no');
            $appointments->date = $request->input('appointmentDate');
            $appointments->time = $request->input('appointmentTime');
            $appointments->venue = $request->input('appointmentVenue');
            $appointments->status = 'Pending';

            $appointments->save();

            //record activity
            $activities = new Activity;
            $activities->user_id = auth()->guard('admin')->user()->id;
            $activities->task = 'Scheduled appointment to Donor Request No. '.$request->input('donorRequestNo');
            $activities->date = NOW();
            $activities->time = NOW();
            $activities->save();

            return response()->json([
                'status'=>200
            ]);
        }
    }
}
