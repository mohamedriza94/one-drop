<?php

namespace App\Http\Controllers\Admin\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Donor;
use App\Models\DonorRequest;
use App\Models\Appointment;
use App\Models\Activity;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

use App\Mail\Staff\registeredDonorMail;
use App\Mail\Staff\declinedDonorEmail;

class appointmentController extends Controller
{
    public function index()
    {
        if(auth()->guard('admin')->user()->role == 'staff')
        {
        return view('admin.dashboard.staffControls.appointments');
        }
        else
        {
            return back();
        }
    }

    public function fetchAppointment()
    {
        $appointments = Appointment::where('appointment_no','LIKE','%'.'OD'.'%')->orderBy('id', 'DESC')->get();
        return response()->json([
            'appointments'=>$appointments,
        ]);
    }

    public function fetchPendingAppointment()
    {
        $appointments = Appointment::where('appointment_no','LIKE','%'.'OD'.'%')->where('status', '=', "pending")->orderBy('id', 'DESC')->get();
        return response()->json([
            'appointments'=>$appointments,
        ]);
    }

    public function fetchCompletedAppointment()
    {
        $appointments = Appointment::where('appointment_no','LIKE','%'.'OD'.'%')->where('status', '=', "completed")->orderBy('id', 'DESC')->get();
        return response()->json([
            'appointments'=>$appointments,
        ]);
    }

    public function fetchCancelledAppointment()
    {
        $appointments = Appointment::where('appointment_no','LIKE','%'.'OD'.'%')->where('status', '=', "cancelled")->orderBy('id', 'DESC')->get();
        return response()->json([
            'appointments'=>$appointments,
        ]);
    }

    public function searchAppointment($input)
    {
        $appointments = Appointment::where('appointment_no','LIKE','%'.$input.'%')->orderBy('id', 'DESC')->get();
        return response()->json([
            'appointments'=>$appointments,
        ]);
    }

    public function cancelAppointment(Request $request, $id)
    {
        $appointments = Appointment::where('appointment_no', $id)->update(['status' => 'cancelled']);

        //record activity
        $activities = new Activity;
        $activities->user_id = auth()->guard('admin')->user()->id;
        $activities->task = 'Cancelled Appointment No. '.$id.'.';
        $activities->date = NOW();
        $activities->time = NOW();
        $activities->save();
    }

    public function declineDonorRequest(Request $request, $id)
    {
        $donorRequestDeclineId = $id;
        Mail::to($request->input('email'))->send(new declinedDonorEmail($donorRequestDeclineId));

        $appointments = Appointment::where('donorRequestNo', $id)->update(['status' => 'cancelled']);
        $donorRequests = donorRequest::where('donorRequestNo', $id)->update(['status' => 'declined']);


        //record activity
        $activities = new Activity;
        $activities->user_id = auth()->guard('admin')->user()->id;
        $activities->task = 'Declined Donor Request No. '.$id.'.';
        $activities->date = NOW();
        $activities->time = NOW();
        $activities->save();

        return response()->json([
            'status'=>200,
        ]);
    }

    public function registerDonor(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'no' => ['required','string','max:255','unique:donors'],
            'fullname' => ['required'],
            'photo' => ['required','image'],
            'nic' => ['required','string','between:10,12','unique:donors'],
            'address' => ['required'],
            'dateofbirth' => ['required','max:12'],
            'age' => ['required'],
            'bloodGroup' => ['required'],
            'gender' => ['required'],
            'telephone' => ['required','numeric','digits_between:9,10','unique:donors'],
            'email' => ['required','string','max:255','email','unique:donors'],
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
            $donorNumber = 'OD'.$request->input('no');
            $donorPassword = route('donor.setPassword', ['no' => $request->input('no')]);
            $donorEmail = $request->input('email');
            
            //splitting and imploding telephone input to filter our zeros and enter 0094
            $split_telephone_string = str_split($request->input('telephone'));
            $filteredArray = array_diff($split_telephone_string, [$split_telephone_string[0]]);
            $telephone_imploded = implode("", $filteredArray);
            $telephone_final_string = '+94'.$telephone_imploded;

            Mail::to($request->input('email'))->send(new registeredDonorMail($donorEmail, $donorPassword));
            
            $donors = new Donor;
            $donors->no = $donorNumber;
            $donors->fullname = $request->input('fullname');
            $donors->nic = $request->input('nic');
            $donors->address = $request->input('address');
            $donors->dateofbirth = $request->input('dateofbirth');
            $donors->age = $request->input('age');
            $donors->gender = $request->input('gender');
            $donors->telephone = $telephone_final_string;
            $donors->email = $request->input('email');
            $donors->status = 'active';
            $donors->bloodGroup = $request->input('bloodGroup');
            $donors->password = Hash::make($donorPassword);
            $donors->registered_date = NOW();
            $donors->registered_time = NOW();

            If(request('photo')!="")
            {
                $photoPath = request('photo')->store('donor','public'); //get image path
                $donors->photo = '/'.'storage/'.$photoPath;
            }

            $donors->save();

            $appointments = Appointment::where('donorRequestNo', $request->input('donorRequestNo'))->update(['status' => 'completed']);
            $donorRequests = DonorRequest::where('donorRequestNo', $request->input('donorRequestNo'))->update(['status' => 'accepted']);

            //record activity
            $activities = new Activity;
            $activities->user_id = auth()->guard('admin')->user()->id;
            $activities->task = 'Registered Donor No. '.$donorNumber.'.';
            $activities->date = NOW();
            $activities->time = NOW();
            $activities->save();

            return response()->json([
                'status'=>200
            ]);
        }
    }
}
