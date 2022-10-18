<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class NewsAndUpdate extends Model
{
    use HasFactory, Notifiable;
    
    protected $table='news_and_updates';
    
    protected $fillable = [
        
        'news_no',
        'title',
        'description',
        'thumbnail',
        'status',
        'admin_id',
        'time'
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

}