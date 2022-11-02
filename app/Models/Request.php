<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Request extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'requests';

    protected $fillable = [
        'requestNo',
        'nic',
        'fullName',
        'email',
        'telephone',
        'bloodGroup',
        'date',
        'time',
        'status',
        'fulfilDate',
        'remark',
        'bloodBagNo',
    ];
}
