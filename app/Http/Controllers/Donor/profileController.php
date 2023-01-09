<?php

namespace App\Http\Controllers\Donor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donor;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class profileController extends Controller
{
    public function changePassword(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
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
            $donors = Donor::find($id);

            if($donors)
            {
                $donors->password = Hash::make($request->input('password'));
                $donors->update();

                return response()->json([
                    'status'=>200
                ]);
            }
            else
            {
                return response()->json([
                    'status'=>404
                ]);
            }
        }
    }
    
    public function setPassword($no)
    {
        return view('donor.auth.setPassword')->with('no',$no);
    }
    
    public function submitPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            
            'no' => ['required','exists:donors'],
            'password' => 'required|min:6|confirmed',
            
        ]); //validate all the data

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }
        else
        {
            $donors = Donor::where('no','=',$request->input('no'))->first();

            $donors->password = Hash::make($request->input('password'));
            $donors->save();

            return redirect()->back()->with('message', 'PASSWORD RESET SUCCESSFULLY!');
        }
    }
}
