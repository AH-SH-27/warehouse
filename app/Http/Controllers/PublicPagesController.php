<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
        $categories = Category::whereHas('products', function ($query) use ($store) {
            $query->where('store_id', $store->id);
        })->get();

        $query = $store->products();

        $categoryId = $request->query('category');
        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        $products = $query->paginate(10);

        return view('products', compact('products', 'store', 'categories', 'categoryId'));
    }
}
