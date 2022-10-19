<?php

namespace App\Http\Controllers\Donor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        return view('donor.dashboard.index');
    }
}
