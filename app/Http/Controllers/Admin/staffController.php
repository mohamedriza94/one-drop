<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Hospital;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

use App\Mail\Admin\sendStaffPassword;

class staffController extends Controller
{
    public function index()
    {
        if(auth()->guard('admin')->user()->role == 'admin')
        {
            return view('admin.dashboard.staff');
        }
        else
        {
            return back();
        }
    }
    
    public function addStaff(Request $request)
    {
        $validator = Validator::make($request->all(), [
            
            'no' => ['required','string','max:255','unique:admins'],
            'nic' => ['required','string','between:10,12','unique:admins'],
            'telephone' => ['required','numeric','digits_between:9,10','unique:admins'],
            'fullName' => ['required'],
            'address' => ['required','max:255'],
            'dateOfBirth' => ['required','max:12'],
            'gender' => ['required'],
            'photo' => ['required','image'],
            'email' => ['required','string','max:255','email','unique:admins'],
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
            $staffPassword = route('admin.setPassword', ['no' => $request->input('no')]);
            $staffEmail = $request->input('email');
            $role = 'staff';
            
            //splitting and imploding telephone input to filter our zeros and enter 0094
            $split_telephone_string = str_split($request->input('telephone'));
            $filteredArray = array_diff($split_telephone_string, [$split_telephone_string[0]]);
            $telephone_imploded = implode("", $filteredArray);
            $telephone_final_string = '+94'.$telephone_imploded;
            
            Mail::to($request->input('email'))->send(new sendStaffPassword($staffEmail, $staffPassword));
            
            $admins = new Admin;
            $admins->no = $request->input('no');
            $admins->nic = $request->input('nic');
            $admins->telephone = $telephone_final_string;
            $admins->fullname = $request->input('fullName');
            $admins->address = $request->input('address');
            $admins->dateofbirth = $request->input('dateOfBirth');
            $admins->gender = $request->input('gender');
            $admins->password = Hash::make($staffPassword);
            $admins->role = $role;
            
            If(request('photo')!="")
            {
                $photoPath = request('photo')->store('staff','public'); //get image path
                $admins->photo = '/'.'storage/'.$photoPath;
            }
            
            $admins->email = $request->input('email');
            $admins->status = $request->input('status');
            $admins->save();
            
            return response()->json([
                'status'=>200
            ]);
        }
    }
    
    public function fetchStaff()
    {
        $admins = Admin::where('role', '=', "staff")->orderBy('id', 'DESC')->get();
        return response()->json([
            'admins'=>$admins,
        ]);
    }
    
    public function fetchActiveStaff()
    {
        $admins = Admin::where('role', '=', "staff")->where('status', '=', "active")->orderBy('id', 'DESC')->get();
        return response()->json([
            'admins'=>$admins,
        ]);
    }
    
    public function fetchInactiveStaff()
    {
        $admins = Admin::where('role', '=', "staff")->where('status', '=', "inactive")->orderBy('id', 'DESC')->get();
        return response()->json([
            'admins'=>$admins,
        ]);
    }
    
    public function searchStaff($input)
    {
        $admins = Admin::where('role', '=', "staff")->Where('nic','LIKE','%'.$input.'%')->orderBy('id', 'DESC')->get();
        return response()->json([
            'admins'=>$admins,
        ]);
    }
    
    public function fetchSingleStaff($id)
    {
        $admins = Admin::find($id);
        if($admins)
        {
            return response()->json([
                'status'=>200,
                'admins'=>$admins,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
            ]);
        }
    }
    
    public function changeStatus(Request $request, $id)
    {
        $admins = Admin::where('id', $id)->update(['status' => $request->input('status')]);
        
        return response()->json([
            'status'=>200
        ]);
    }
    
    public function updateStaff(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            
            'update_nic' => ['required','string','between:10,12'],
            'update_telephone' => ['required','numeric','digits_between:9,10'],
            'update_fullName' => ['required'],
            'update_address' => ['required','max:255'],
            'update_dateOfBirth' => ['required','max:12'],
            'update_email' => ['required','string','max:255','email'],
            
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
            $admins = Admin::find($id);;
            
            if($admins)
            {
                //splitting and imploding telephone input to filter our zeros and enter 0094
                $split_telephone_string = str_split($request->input('update_telephone'));
                $filteredArray = array_diff($split_telephone_string, [$split_telephone_string[0]]);
                $telephone_imploded = implode("", $filteredArray);
                $telephone_final_string = '+94'.$telephone_imploded;
                
                $admins->nic = $request->input('update_nic');
                $admins->telephone = $telephone_final_string;
                $admins->fullname = $request->input('update_fullName');
                $admins->address = $request->input('update_address');
                $admins->dateofbirth = $request->input('update_dateOfBirth');
                
                If(request('update_photo')!="")
                {
                    $photoPath = request('update_photo')->store('staff','public'); //get image path
                    $admins->photo = '/'.'storage/'.$photoPath;
                }
                
                $admins->email = $request->input('update_email');
                $admins->save();
                
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
    
    public function deleteStaff(Request $request, $id)
    {
        $admins = Admin::find($id);
        
        if($admins)
        {
            $admins->delete();
            
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
    
    public function fetchHospitalToAssign()
    {
        $hospitals = Hospital::orderBy('id', 'DESC')->get();
        return response()->json([
            'hospitals'=>$hospitals,
        ]);
    }
    
    public function appoint(Request $request, $id)
    {
        $isExist = Hospital::select("*")->where("no", $request->input('hospital_id'))->exists();
        
        if ($isExist) {
            
            $admins = Admin::find($id);
            
            $admins->hospital_id = $request->input('hospital_id');
            $admins->update();
            
            return response()->json([
                'status'=>200,
            ]);
            
        }else{
            return response()->json([
                'status'=>400,
            ]);
        }
    }
    
    public function fetchAssignedHospital($id)
    {
        $hospitals = Hospital::where("no",'=', $id)->first();
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
    
    public function setPassword($no)
    {
        return view('admin.auth.setPassword')->with('no',$no);
    }
    
    public function submitPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            
            'no' => ['required','exists:admins'],
            'password' => 'required|min:6|confirmed',
            
        ]); //validate all the data

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator);
        }
        else
        {
            $admins = Admin::where('no','=',$request->input('no'))->first();

            $admins->password = Hash::make($request->input('password'));
            $admins->save();

            return redirect()->back()->with('message', 'PASSWORD RESET SUCCESSFULLY!');
        }
    }
}