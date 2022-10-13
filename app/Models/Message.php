<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Message extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'messages';

    protected $fillable = [
        'message_no',
        'sender',
        'subject',
        'message',
        'date',
        'time',
        'status',
        'reply_status',
        'sender_id',
    ];

}
