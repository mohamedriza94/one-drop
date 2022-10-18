<?php

namespace App\Http\Controllers\Admin\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Activity;
use App\Models\NewsAndUpdate;
use Illuminate\Support\Facades\File;

class newsController extends Controller
{
    public function index()
    {
        if(auth()->guard('admin')->user()->role == 'staff')
        {
        return view('admin.dashboard.staffControls.news');
        }
        else
        {
            return back();
        }
    }

    public function addNews(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'news_no' => ['required','string','max:255','unique:news_and_updates'],
            'title' => ['required','string','max:255'],
            'description' => ['required'],
            'thumbnail' => ['required','image'],
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
            $newsandupdates = new NewsAndUpdate;
            $newsandupdates->news_no = $request->input('news_no');
            $newsandupdates->title = $request->input('title');
            $newsandupdates->description = $request->input('description');
            
            $thumbnailPath = request('thumbnail')->store('news','public'); //get image path
            $newsandupdates->thumbnail = '/'.'storage/'.$thumbnailPath;

            $newsandupdates->status = $request->input('status');
            $newsandupdates->admin_id = auth()->user()->id;
            $newsandupdates->time = now();
            $newsandupdates->save();

            //record activity
            $activities = new Activity;
            $activities->user_id = auth()->guard('admin')->user()->id;
            $activities->task = 'Added News No. '.$request->input('news_no');
            $activities->date = NOW();
            $activities->time = NOW();
            $activities->save();

            return response()->json([
                'status'=>200,
                'message'=>'done'
            ]);
        }
    }

    public function fetchNewsAndUpdates()
    {
        $newsandupdates = NewsAndUpdate::orderBy('id', 'DESC')->orderBy('id', 'DESC')->get();
        return response()->json([
            'newsandupdates'=>$newsandupdates,
        ]);
    }

    public function fetchActiveNewsAndUpdates()
    {
        $newsandupdates = NewsAndUpdate::where('status', '=', "active")->orderBy('id', 'DESC')->get();
        return response()->json([
            'newsandupdates'=>$newsandupdates,
        ]);
    }
    
    public function fetchInactiveNewsAndUpdates()
    {
        $newsandupdates = NewsAndUpdate::where('status', '=', "inactive")->orderBy('id', 'DESC')->get();
        return response()->json([
            'newsandupdates'=>$newsandupdates,
        ]);
    }

    public function searchNews($input)
    {
        $newsandupdates = NewsAndUpdate::where('title','LIKE','%'.$input.'%')->orWhere('news_no','LIKE','%'.$input.'%')->orderBy('id', 'DESC')->get();
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
                'fetch_status'=>200,
                'newsandupdates'=>$newsandupdates,
            ]);
        }
        else
        {
            return response()->json([
                'fetch_status'=>404,
                'message'=>'Post Unavailable',
            ]);
        }
    }
    
    public function updateNews(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            //'id' => ['required'],
            'title' => ['required','string','max:255'],
            'description' => ['required'],
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
            $newsandupdates = NewsAndUpdate::find($id);

            if($newsandupdates)
            {
                $newsandupdates->title = $request->input('title');
                $newsandupdates->description = $request->input('description');
                
                If(request('thumbnail')!="")
                {
                $thumbnailPath = request('thumbnail')->store('news','public'); //get image path
                $newsandupdates->thumbnail = '/'.'storage/'.$thumbnailPath;
                }

                $newsandupdates->admin_id = auth()->user()->id;
                $newsandupdates->time = now();
                $newsandupdates->save();

                //record activity
                $activities = new Activity;
                $activities->user_id = auth()->guard('admin')->user()->id;
                $activities->task = 'Updated News No. '.$id;
                $activities->date = NOW();
                $activities->time = NOW();
                $activities->save();

                return response()->json([
                    'status'=>200,
                    'message'=>'done'
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

    public function changeStatus(Request $request, $id)
    {
        $newsandupdates = NewsAndUpdate::find($id);
        
        $newsandupdates->status = $request->input('status');
        $newsandupdates->update();

        //record activity
        $activities = new Activity;
        $activities->user_id = auth()->guard('admin')->user()->id;
        $activities->task = 'Updated status of News No. '.$id.' as <b>'.$request->input('status').'</b>';
        $activities->date = NOW();
        $activities->time = NOW();
        $activities->save();

        return response()->json([
            'status'=>200,
            'message'=>'done'
        ]);
    }

    public function deleteNews(Request $request,$id,$news_no)
    {
        $newsandupdates = NewsAndUpdate::find($id);
        
        if($newsandupdates)
        {
            $newsandupdates->delete();

            //record activity
            $activities = new Activity;
            $activities->user_id = auth()->guard('admin')->user()->id;
            $activities->task = 'Deleted News No. '.$id.'.';
            $activities->date = NOW();
            $activities->time = NOW();
            $activities->save();


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