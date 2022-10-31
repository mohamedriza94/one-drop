<?php

namespace App\Http\Controllers\Hospital;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Donor;
use App\Models\Activity;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

use App\Mail\Hospital\registeredHospitalDonorMail;

class donorRegistrationController extends Controller
{
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
            $hospitalDonorNumber = 'HS'.$request->input('no');
            $hospitalDonorPassword = rand(1500000,9515959);
            $hospitalDonorEmail = $request->input('email');
            
            Mail::to($request->input('email'))->send(new registeredHospitalDonorMail($hospitalDonorEmail, $hospitalDonorPassword));
            
            $donors = new Donor;
            $donors->no = $hospitalDonorNumber;
            $donors->fullname = $request->input('fullname');
            $donors->nic = $request->input('nic');
            $donors->address = $request->input('address');
            $donors->dateofbirth = $request->input('dateofbirth');
            $donors->age = $request->input('age');
            $donors->gender = $request->input('gender');
            $donors->telephone = $request->input('telephone');
            $donors->email = $request->input('email');
            $donors->status = 'active';
            $donors->hospital = auth()->guard('hospital')->user()->no;
            $donors->password = Hash::make($hospitalDonorPassword);
            $donors->registered_date = NOW();
            $donors->registered_time = NOW();

            If(request('photo')!="")
            {
                $photoPath = request('photo')->store('donor','public'); //get image path
                $donors->photo = '/'.'storage/'.$photoPath;
            }

            $donors->save();

            //record activity
            $activities = new Activity;
            $activities->user_id = auth()->guard('hospital')->user()->no;
            $activities->task = 'Hospital Registered Donor No. '.$hospitalDonorNumber.'.';
            $activities->date = NOW();
            $activities->time = NOW();
            $activities->save();

            return response()->json([
                'status'=>200
            ]);
        }
    }
}
