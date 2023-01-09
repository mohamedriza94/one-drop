<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hospital;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

use App\Mail\Admin\hospitalCredentials;

class hospitalController extends Controller
{
    public function index()
    {
        if(auth()->guard('admin')->user()->role == 'admin')
        {
            return view('admin.dashboard.hospital');
        }
        else
        {
            return back();
        }
    }

    public function addHospital(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'no' => ['required','string','max:255','unique:hospitals'],
            'landline' => ['required','numeric','digits_between:9,10','unique:hospitals'],
            'hospitalName' => ['required','max:100'],
            'address' => ['required','max:255','unique:hospitals'],
            'email' => ['required','email','unique:hospitals'],
            'password' => ['required','string','min:6'],
            
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
            //splitting and imploding telephone input to filter our zeros and enter 0094
            $split_telephone_string = str_split($request->input('landline'));
            $filteredArray = array_diff($split_telephone_string, [$split_telephone_string[0]]);
            $telephone_imploded = implode("", $filteredArray);
            $telephone_final_string = '+94'.$telephone_imploded;

            $hospitalNo = $request->input('no');
            $hospitalPassword = route('hospital.setPassword', ['no' => $request->input('no')]);

            $hospitals = new Hospital;
            $hospitals->no = $request->input('no');
            $hospitals->name = $request->input('hospitalName');
            $hospitals->address = $request->input('address');
            $hospitals->landline = $telephone_final_string;
            $hospitals->description = $request->input('description');
            $hospitals->email = $request->input('email');
            $hospitals->password = Hash::make($request->input('password'));

            $hospitals->save();

            Mail::to($request->input('email'))->send(new hospitalCredentials($hospitalNo, $hospitalPassword));

            return response()->json([
                'status'=>200
            ]);
        }
    }

    public function fetchHospital()
    {
        $hospitals = Hospital::orderBy('id', 'DESC')->get();
        return response()->json([
            'hospitals'=>$hospitals,
        ]);
    }

    public function fetchSingleHospital($id)
    {
        $hospitals = Hospital::find($id);
        if($hospitals)
        {
            return response()->json([
                'status'=>200,
                'hospitals'=>$hospitals,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
            ]);
        }
    }

    public function updateHospital(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'update_name' => ['required','max:100'],
            'address' => ['required','max:255'],
            'landline' => ['required','numeric','digits_between:9,10'],
            'email' => ['required','email'],
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
            $hospitals = Hospital::find($id);;

            if($hospitals)
            {
                //splitting and imploding telephone input to filter our zeros and enter 0094
                $split_telephone_string = str_split($request->input('landline'));
                $filteredArray = array_diff($split_telephone_string, [$split_telephone_string[0]]);
                $telephone_imploded = implode("", $filteredArray);
                $telephone_final_string = '+94'.$telephone_imploded;
                
                $hospitals->name = $request->input('update_name');
                $hospitals->address = $request->input('address');
                $hospitals->landline = $telephone_final_string;
                $hospitals->description = $request->input('update_description');
                $hospitals->email = $request->input('email');

                $hospitals->save();

                return response()->json([
                    'status'=>200
                ]);
            }
            else
            {
                return response()->json([
                    'status'=>404,
                ]);
            }
            
        }
    }

    public function deleteHospital(Request $request, $id)
    {
        $hospitals = Hospital::find($id);
        
        if($hospitals)
        {
            $hospitals->delete();

            return response()->json([
                'status'=>200,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
            ]);
        }
    }
}
