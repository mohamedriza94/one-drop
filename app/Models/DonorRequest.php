<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class DonorRequest extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'donor_requests';

    protected $fillable = [
        'donorRequestNo',
        'nic',
        'fullName',
        'email',
        'telephone',
        'age',
        'dateOfBirth',
        'date',
        'time',
        'status',
    ];
}
