<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hospital;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

class hospitalController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.hospital');
    }

    public function addHospital(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'no' => ['required','string','max:255','unique:hospitals'],
            'landline' => ['required','numeric','digits_between:9,10','unique:hospitals'],
            'hospitalName' => ['required','max:100'],
            'address' => ['required','max:255','unique:hospitals'],
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
            $hospitals = new Hospital;
            $hospitals->no = $request->input('no');
            $hospitals->name = $request->input('hospitalName');
            $hospitals->address = $request->input('address');
            $hospitals->landline = $request->input('landline');
            $hospitals->description = $request->input('description');
            $hospitals->password = Hash::make($request->input('password'));

            $hospitals->save();

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
            'update_address' => ['required','max:255'],
            'update_landline' => ['required','numeric','digits_between:9,10'],
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
                $hospitals->name = $request->input('update_name');
                $hospitals->address = $request->input('update_address');
                $hospitals->landline = $request->input('update_landline');
                $hospitals->description = $request->input('update_description');

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
