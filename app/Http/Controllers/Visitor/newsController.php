<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\NewsAndUpdate;
use App\Models\Campaign;
use App\Models\CampaignTag;
use App\Models\Photo;

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
    
    public function fetchUpdates_ForHomePage()
    {
        $newsandupdates = NewsAndUpdate::where('status', '=', "active")->orderBy('id', 'DESC')->limit(3)->get();
        $campaigns = Campaign::where('status','=','active')->orderBy('id', 'DESC')->limit(3)->get();
        
        return response()->json([
            'newsandupdates'=>$newsandupdates,
            'campaigns'=>$campaigns
        ]);
    }
    
    public function fetchCampainTags_ForHomePage($campaignId)
    {
        $campaignTags = CampaignTag::where('campaignNo','=',$campaignId)->orderBy('id', 'DESC')->get();

        return response()->json([
            'campaignTags'=>$campaignTags
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

    public function seeCampaignPage($id)
    {
        $campaigns = Campaign::where('id','=',$id)->first();
        $campaignTags = CampaignTag::where('campaignNo','=',$id)->get();
        $photos = Photo::where('campaignNo','=',$id)->get();

        return view('visitor.dashboard.seeCampaign')->with('campaigns', $campaigns)->with('campaignTags', $campaignTags)->with('photos', $photos);

    }
}
