<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\PasswordReset;

use App\Mail\Admin\forgotPasswordMail;

class ForgotPasswordController extends Controller
{
    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function showForgotPassword()
    {
        return view('admin.auth.forgotPassword');
    }

    public function verifyEmail($email)
    {  
        $no = rand(1000000,9999999);
        $status = 'active';
        $code = rand(1515,9515);
        $admins = Admin::where('email', $email)->first();

        if($admins)
        {
            Mail::to($email)->send(new forgotPasswordMail($code));

            $passwordReset = new PasswordReset;
            $passwordReset->no = $no;
            $passwordReset->email = $email;
            $passwordReset->code = $code;
            $passwordReset->status = $status;
            $passwordReset->save();

            return response()->json([
                'status'=>200,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>400,
            ]);
        }
    } 

    public function verifyCode($typedCode, $email)
    {  
        $passwordReset = PasswordReset::where('email', $email)->where('code', $typedCode)
        ->where('status','active')->first();

        if($passwordReset)
        {
            $status = 'verified';
            $passwordReset->status = $status;
            $passwordReset->update();

            return response()->json([
                'status'=>200,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>400,
            ]);
        }
    }

    public function resetPassword($typedCode,$email,$password)
    {  
        $verifyToken = PasswordReset::where('email', $email)->where('code', $typedCode)
        ->where('status','verified')->first();

        if($verifyToken)
        { 
            $checkPasswordLength = strlen($password); //get string length

            if($checkPasswordLength > 5)
            {
                $hashedPassword = Hash::make($password);
                $admins = Admin::where('email', $email)->update(['password' => $hashedPassword]);

                $status = 'used';
                $verifyToken->status = $status;
                $verifyToken->update();

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
        else
        {
            return response()->json([
                'status'=>400,
            ]);
        }
    }
}
