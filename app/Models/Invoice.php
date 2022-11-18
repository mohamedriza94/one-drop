<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Invoice extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'invoices';

    protected $fillable = [
        'requestNo',
        'date',
        'time',
        'fullname',
        'nic',
        'email',
        'telephone',
        'bagNo',
        'bloodGroup',
        'expiryDate',
        'staffName',
        'staffTelephone',
    ];
}
