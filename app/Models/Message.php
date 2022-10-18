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
        'staff_side_status',
        'admin_side_status',
        'hospital_side_status',
        'donor_side_status',
        'other_status',
        'reply_status',
        'sender_id',
        'recipientId',
    ];

}
