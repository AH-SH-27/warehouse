<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Carbon\Carbon;
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
    
        $store = $vendor->store;
    
        if (!$store) {
            // Redirect vendor to a page to create a store or show a message
            return view('vendor.dashboard', [
                'vendor' => $vendor,
                'store' => null,
                'message' => 'You do not have a store yet. Please create one to start selling.'
            ]);
        }
    
        // Get date ranges
        $today = Carbon::today();
        $startOfWeek = Carbon::now()->startOfWeek();
        $startOfMonth = Carbon::now()->startOfMonth();
    
        // Get statistics
        $productsCount = $store->products()->count();
        $totalOrdersCount = $store->orders()->count();
        $todayOrdersCount = $store->orders()->whereDate('created_at', $today)->count();
        $weeklyOrdersCount = $store->orders()->whereBetween('created_at', [$startOfWeek, now()])->count();
        $monthlyOrdersCount = $store->orders()->whereBetween('created_at', [$startOfMonth, now()])->count();
    
        return view('vendor.dashboard', compact(
            'vendor', 
            'store', 
            'productsCount', 
            'totalOrdersCount', 
            'todayOrdersCount', 
            'weeklyOrdersCount', 
            'monthlyOrdersCount'
        ));
    }
    
}
