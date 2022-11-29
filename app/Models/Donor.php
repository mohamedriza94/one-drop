<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Donor extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'donors';

    protected $fillable = [
        'no',
        'registered_date',
        'registered_time',
        'fullname',
        'photo',
        'nic',
        'address',
        'dateofbirth',
        'age',
        'gender',
        'telephone',
        'email',
        'status',
        'hospital',
        'bloodGroup',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
