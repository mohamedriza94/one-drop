<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignTag extends Model
{
    use HasFactory;
    
    protected $table = 'campaign_tags';
    
    protected $fillable = [
        'campaignNo',
        'tag',
    ];
}
