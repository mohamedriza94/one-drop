<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function showRegisterForm()
    {
        return view('admin.auth.register');
    }

    public function registerAdmin(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'no' => ['required','string','max:255','unique:admins'],
            'telephone' => ['required','string','max:10','unique:admins'],
            'nic' => ['required','string','max:12','unique:admins'],
            'fullname' => ['required','string','max:255'],
            'email' => ['required','string','max:255','unique:admins','email'],
            'role' => ['required'],
            'photo' => ['required'],
            'password' => ['required','string','min:8'],
            'status' => ['required'],

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
            $admins = new Admin;
            $admins->no = $request->input('no');
            $admins->telephone = $request->input('telephone');
            $admins->nic = $request->input('nic');
            $admins->fullname = $request->input('fullname');
            $admins->email = $request->input('email');
            $admins->role = $request->input('role');
            $admins->photo = $request->input('photo');
            $admins->password = Hash::make($request->input('password'));
            $admins->status = $request->input('status');
            $admins->save();

            return response()->json([
                'status'=>200,
            ]);
        }
    }
}
