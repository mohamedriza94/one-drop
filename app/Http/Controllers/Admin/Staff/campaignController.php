<?php

namespace App\Http\Controllers\Admin\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\CampaignTag;
use App\Models\Photo;
use Illuminate\Support\Facades\Validator;
use App\Models\Activity;
use Illuminate\Support\Facades\File;

class campaignController extends Controller
{
    public function index()
    {
        if(auth()->guard('admin')->user()->role == 'staff')
        {
            return view('admin.dashboard.staffControls.campaign');
        }
        else
        {
            return back();
        }
    }
    
    public function searchCampaign($input)
    {
        $campaigns = Campaign::where('title','LIKE','%'.$input.'%')->orderBy('id', 'DESC')->get();
        return response()->json([
            'campaigns'=>$campaigns,
        ]);
    }
    
    public function fetchCampaign()
    {
        $campaigns = Campaign::orderBy('id', 'DESC')->get();
        return response()->json([
            'campaigns'=>$campaigns,
        ]);
    }
    
    public function fetchActiveCampaign()
    {
        $campaigns = Campaign::where('status','=','active')->orderBy('id', 'DESC')->get();
        return response()->json([
            'campaigns'=>$campaigns,
        ]);
    }
    
    public function fetchInactiveCampaign()
    {
        $campaigns = Campaign::where('status','=','inactive')->orderBy('id', 'DESC')->get();
        return response()->json([
            'campaigns'=>$campaigns,
        ]);
    }
    
    public function fetchEndedCampaign()
    {
        $campaigns = Campaign::where('status','=','ended')->orderBy('id', 'DESC')->get();
        return response()->json([
            'campaigns'=>$campaigns,
        ]);
    }
    
    public function fetchSingleCampaign($id)
    {
        $campaigns = Campaign::find($id);
        $photos = Photo::where('campaignNo','=',$id)->orderBy('id', 'DESC')->get();
        $campaignTags = CampaignTag::where('campaignNo','=',$id)->orderBy('id', 'DESC')->get();

        return response()->json([
            'campaigns'=>$campaigns,
            'photos'=>$photos,
            'campaignTags'=>$campaignTags
        ]);
    }
    
    public function newCampaign(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required','string','max:255'],
            'description' => ['required'],
            'thumbnail' => ['required','image'],
            'status' => ['required'],
            'startDate' => ['required'],
            'endDate' => ['required'],
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
            $campaignNo = rand(000000,999999);
            
            $campaigns = new Campaign;
            $campaigns->no = $campaignNo;
            $campaigns->title = $request->input('title');
            $campaigns->description = $request->input('description');
            $campaigns->startDate = $request->input('startDate');
            
            $thumbnailPath = request('thumbnail')->store('campaign','public'); //get image path
            $campaigns->thumbnail = '/'.'storage/'.$thumbnailPath;
            
            $campaigns->endDate = $request->input('endDate');
            $campaigns->dateTime = NOW();
            $campaigns->status = $request->input('status');
            $campaigns->save();
            
            //record activity
            $activities = new Activity;
            $activities->user_id = auth()->guard('admin')->user()->id;
            $activities->task = 'Added Campaign No. '.$campaignNo;
            $activities->date = NOW();
            $activities->time = NOW();
            $activities->save();
            
            return response()->json([
                'status'=>200,
                'message'=>'done'
            ]);
        }
    }
    
    public function deleteCampaign(Request $request,$campaignNo)
    {
        $campaigns = Campaign::where('id','=',$campaignNo);
        $campaignTag = CampaignTag::where('campaignNo','=',$campaignNo);
        $photos = Photo::where('campaignNo','=',$campaignNo);
        
        if($campaigns)
        {
            $campaigns->delete();
            
            //record activity
            $activities = new Activity;
            $activities->user_id = auth()->guard('admin')->user()->id;
            $activities->task = 'Deleted Campaign with ID. '.$campaignNo.'.';
            $activities->date = NOW();
            $activities->time = NOW();
            $activities->save();
        }
        
        if($campaignTag)
        {
            $campaignTag->delete();
        }
        
        if($photos)
        {
            $photos->delete();
        }
    }
    
    public function deleteCampaignPhoto(Request $request,$id)
    {
        $photos = Photo::where('id','=',$id);
        
        if($photos)
        {
            $photos->delete();

            return response()->json([
                'status'=>200
            ]);
        }
    }
    
    public function deleteCampaignTag(Request $request,$id)
    {
        $campaignTag = CampaignTag::where('id','=',$id);
        
        if($campaignTag)
        {
            $campaignTag->delete();

            return response()->json([
                'status'=>200
            ]);
        }
    }
    
    public function changeStatus(Request $request, $id)
    {
        $campaigns = Campaign::find($id);
        
        $campaigns->status = $request->input('status');
        $campaigns->update();
        
        //record activity
        $activities = new Activity;
        $activities->user_id = auth()->guard('admin')->user()->id;
        $activities->task = 'Updated status of Campaign No. '.$id.' as <b>'.$request->input('status').'</b>';
        $activities->date = NOW();
        $activities->time = NOW();
        $activities->save();
    }
    
    public function editCampaign(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required','string','max:255'],
            'description' => ['required'],
            'startDate' => ['required'],
            'endDate' => ['required'],
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
            $campaigns = Campaign::find($request->input('no'));
            
            if($campaigns)
            {
                $campaigns->title = $request->input('title');
                $campaigns->description = $request->input('description');
                $campaigns->startDate = $request->input('startDate');
                
                If(request('thumbnail')!="")
                {
                    $thumbnailPath = request('thumbnail')->store('campaign','public'); //get image path
                    $campaigns->thumbnail = '/'.'storage/'.$thumbnailPath;
                }
                
                $campaigns->endDate = $request->input('endDate');
                $campaigns->dateTime = NOW();
                $campaigns->save();
                
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
    
    public function addTag(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required'],
            'tag' => ['required'],
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
            $campaignTag = new CampaignTag;
            $campaignTag->campaignNo = $request->input('id');
            $campaignTag->tag = $request->input('tag');
            $campaignTag->save();
            
            return response()->json([
                'status'=>200,
            ]);
        }
    }
    
    public function uploadPhoto(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required'],
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
            $photos = new Photo;
            $photos->campaignNo = $request->input('id');
            If(request('photo')!="")
            {
                $photoPath = request('photo')->store('campaign','public'); //get image path
                $photos->photo = '/'.'storage/'.$photoPath;
            }
            $photos->caption = $request->input('caption');
            $photos->save();
            
            return response()->json([
                'status'=>200,
            ]);
        }
    }
}
