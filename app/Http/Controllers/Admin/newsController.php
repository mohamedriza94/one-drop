<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsAndUpdate;
use App\Models\Admin;

class newsController extends Controller
{
    public function index()
    {
        if(auth()->guard('admin')->user()->role == 'admin')
        {
            return view('admin.dashboard.news');
        }
        else
        {
            return back();
        }
    }
    
    public function adminFetchNews()
    {
        $newsandupdates = NewsAndUpdate::orderBy('id', 'DESC')->get();
        return response()->json([
            'newsandupdates'=>$newsandupdates,
        ]);
    }
    
    public function adminSearchNews($input)
    {
        $newsandupdates = NewsAndUpdate::where('title','LIKE','%'.$input.'%')->orderBy('id', 'DESC')->get();
        return response()->json([
            'newsandupdates'=>$newsandupdates,
        ]);
    }
    
    public function adminfetchSingleNews($id)
    {
        $newsandupdates = NewsAndUpdate::find($id);

        $staffId = $newsandupdates['admin_id'];
        
        $staffMember = Admin::find($staffId);

        return response()->json([
            'newsandupdates'=>$newsandupdates,
            'staffMember'=>$staffMember
        ]);
    }
}
