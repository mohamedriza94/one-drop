<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Activity extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'activities';

    protected $fillable = [
        'task',
        'date',
        'time',
        'user_id',
    ];
}
