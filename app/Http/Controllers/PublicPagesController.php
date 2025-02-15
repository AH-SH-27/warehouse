<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublicPagesController extends Controller
{
    public function stores(): View
    {
        $stores = Store::paginate(10);
        return view('stores', compact('stores'));
    }

    public function productsByStore(Request $request, Store $store): View
    {
        $query = $store->products();

        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }

        $products = $query->paginate(10);

        return view('products', compact('products', 'store'));
    }
}
