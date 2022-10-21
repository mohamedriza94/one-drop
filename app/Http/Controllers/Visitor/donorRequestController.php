<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\DonorRequest;

class donorRequestController extends Controller
{
    public function makeDonorRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'donorRequestNo' => ['required','string','max:255','unique:donor_requests'],
            'nic' => ['required','string','between:10,12','unique:donor_requests'],
            'age' => ['required','numeric','max:45','min:18'],
            'dateOfBirth' => ['required','string','max:11'],
            'telephone' => ['required','numeric','digits_between:9,10','unique:donor_requests'],
            'email' => ['required','email','unique:donor_requests'],
            'fullName' => ['required'],
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
            $donorRequests = new DonorRequest;
            $donorRequests->donorRequestNo = $request->input('donorRequestNo');
            $donorRequests->nic = $request->input('nic');
            $donorRequests->fullName = $request->input('fullName');
            $donorRequests->email = $request->input('email');
            $donorRequests->telephone = $request->input('telephone');
            $donorRequests->age = $request->input('age');
            $donorRequests->dateOfBirth = $request->input('dateOfBirth');
            $donorRequests->date = now();
            $donorRequests->time = now();
            $donorRequests->status = 'pending';

            $donorRequests->save();

            return response()->json([
                'status'=>200
            ]);
        }
    }
}
