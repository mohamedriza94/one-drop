<?php

namespace App\Http\Controllers\Admin\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;

class invoiceController extends Controller
{
    public function index()
    {
        if(auth()->guard('admin'))
        {
        return view('admin.dashboard.staffControls.invoice');
        }
        else
        {
            return back();
        }
    }
    
    public function searchRequest($input)
    {
        $invoices = Invoice::where('requestNo','=',$input)->get();
        return response()->json([
            'invoices'=>$invoices,
        ]);
    }
}
