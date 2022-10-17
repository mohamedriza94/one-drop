<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Reply extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'replies';

    protected $fillable = [
        'reply_no',
        'reply',
        'date',
        'time',
        'status',
        'message_no',
    ];
}
