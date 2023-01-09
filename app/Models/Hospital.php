<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Hospital extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'hospitals';

    protected $fillable = [
        'no',
        'name',
        'address',
        'landline',
        'description',
        'email',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
