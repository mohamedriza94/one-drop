<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\NewsAndUpdate;

class newsController extends Controller
{
    public function index()
    {
        return view('visitor.dashboard.news');
    }

    public function fetchNewsAndUpdates()
    {
        $newsandupdates = NewsAndUpdate::where('status', '=', "active")->orderBy('id', 'DESC')->get();
        return response()->json([
            'newsandupdates'=>$newsandupdates,
        ]);
    }

    public function fetchSingleNews($id)
    {
        $newsandupdates = NewsAndUpdate::find($id);
        if($newsandupdates)
        {
            return response()->json([
                'status'=>200,
                'newsandupdates'=>$newsandupdates
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'Post Unavailable'
            ]);
        }
    }
}
