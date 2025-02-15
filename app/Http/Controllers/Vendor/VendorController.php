<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class VendorController extends Controller
{
    public function index(): View
    {
        $vendor = Auth::user();

        if (!$vendor) {
            abort(403, 'Unauthorized access');
        }

        return view('vendor.dashboard', compact('vendor'));
    }
}
