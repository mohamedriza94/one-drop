<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Hospital;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class profileController extends Controller
{
    public function changeProfilePhoto(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'photo' => ['required','image'],
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
            $admins = Admin::find($id);
            
            if($admins)
            {
                If(request('photo')!="")
                {
                    $photoPath = request('photo')->store('admin','public'); //get image path
                    $admins->photo = '/'.'storage/'.$photoPath;
                }
                $admins->save();
                
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
    
    public function updateProfile(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nicNo' => ['required','max:12'],
            'fullname' => ['required','max:255'],
            'address' => ['required','max:255'],
            'dateOfBirth' => ['required'],
            'email' => ['required','string','max:255','email'],
            'telephone' => ['required','numeric','digits_between:9,10'],
            'gender' => ['required'],        
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
            $admins = Admin::find($id);
            
            if($admins)
            {
                $admins->nic = $request->input('nicNo');
                $admins->fullname = $request->input('fullname');
                $admins->address = $request->input('address');
                $admins->dateOfBirth = $request->input('dateOfBirth');
                $admins->email = $request->input('email');
                $admins->telephone = $request->input('telephone');
                $admins->gender = $request->input('gender');
                $admins->update();
                
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
    
    public function fetchProfile($id)
    {
        $admins = Admin::find($id);
        if($admins)
        {
            $assignedHospital = '';
            
            if(auth()->guard('admin')->user()->role == 'staff')
            {
                $assignedHospital = Hospital::where('no','=',auth()->guard('admin')->user()->hospital_id)->first();
            }
            
            if($assignedHospital == '')
            {
                $assignedHospital = 'You are not assigned to a hospital yet';
            }
            
            return response()->json([
                'status'=>200,
                'admins'=>$admins,
                'assignedHospital'=>$assignedHospital,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
            ]);
        }
        
        
    }
    
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
            $admins = Admin::find($id);
            
            if($admins)
            {
                $admins->password = Hash::make($request->input('password'));
                $admins->update();
                
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
}
