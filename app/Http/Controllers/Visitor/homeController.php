<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class homeController extends Controller
{
    public function index()
    {
        return view('visitor.dashboard.home');
    }

    public function donorLogin()
    {
        return view('donor.auth.login');
    }
}
