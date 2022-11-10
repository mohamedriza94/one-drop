<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Donation extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'donations';

    protected $fillable = [
        'donationNo',
        'donorNo',
        'staffNo',
        'date',
        'time',
        'venue',
        'bloodBagNo',
        'hospitalDonatedTo',
    ];
}
