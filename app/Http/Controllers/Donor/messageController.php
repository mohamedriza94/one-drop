<?php

namespace App\Http\Controllers\Donor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Message;
use App\Models\Hospital;
use App\Models\Donor;
use App\Models\Reply;
use Illuminate\Support\Facades\Validator;

class messageController extends Controller
{
    public function index()
    {
        return view('donor.dashboard.message');
    }
}
