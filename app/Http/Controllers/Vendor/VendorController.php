<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class VendorController extends Controller
{
    public function index(): View
    {
        return view('vendor.dashboard',[
            'vendor' => Auth::user()
        ]);
    }
}
