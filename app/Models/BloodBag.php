<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class BloodBag extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'blood_bags';

    protected $fillable = [
        'bag_no',
        'bloodGroup',
        'received_date',
        'received_time',
        'expiry_date',
        'status',
        'dateCheck',
        'hospital'
    ];
}
