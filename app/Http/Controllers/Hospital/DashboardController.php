<?php

namespace App\Http\Controllers\Hospital;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Hospital;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        return view('hospital.dashboard.index');
    }

    public function fetchNotifications()
    {
        $notifications = Notification::where('entity','LIKE','%'.'hospital'.'%')->where('entity','LIKE','%'.auth()->guard('hospital')->user()->no.'%')->orderBy('id', 'DESC')->limit(8)->get();
        
        return response()->json([
            'notifications'=>$notifications
        ]);
    }

    public function notifUpdate(Request $request)
    {
        $notifications = Notification::where('id', $request->input('id'))->update(['status' => '1']);
    }

    
    public function setPassword($no)
    {
        return view('hospital.auth.setPassword')->with('no',$no);
    }
    
    public function submitPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            
            'no' => ['required','exists:hospitals,no'],
            'password' => 'required|min:6|confirmed',
            
        ]); //validate all the data

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }
        else
        {
            $hospitals = Hospital::where('no','=',$request->input('no'))->first();

            $hospitals->password = Hash::make($request->input('password'));
            $hospitals->save();

            return redirect()->back()->with('message', 'PASSWORD RESET SUCCESSFULLY!');
        }
    }
}
