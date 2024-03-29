<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Appointment extends Model
{
    use HasFactory, Notifiable;
    
    protected $table = 'appointments';

    protected $fillable = [
        'appointment_no',
        'date',
        'time',
        'venue',
        'status',
        'donorRequestNo',
    ];
}
