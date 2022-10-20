<?php

namespace App\Http\Controllers\Donor\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Models\Donor;
use App\Models\PasswordReset;

use App\Mail\Donor\forgotPasswordMail;

class ForgotPasswordController extends Controller
{
    protected function guard()
    {
        return Auth::guard('donor');
    }

    public function showForgotPassword()
    {
        return view('donor.auth.forgotPassword');
    }

    public function verifyEmail($email)
    {  
        $no = rand(1000000,9999999);
        $status = 'active';
        $donorCode = rand(1515,9515);
        $donors = Donor::where('email', $email)->first();

        if($donors)
        {
            Mail::to($email)->send(new forgotPasswordMail($donorCode));

            $passwordReset = new PasswordReset;
            $passwordReset->no = $no;
            $passwordReset->email = $email;
            $passwordReset->code = $donorCode;
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
                $donors = Donor::where('email', $email)->update(['password' => $hashedPassword]);

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
