<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\View\View;

use function PHPUnit\Framework\isEmpty;

class PublicPagesController extends Controller
{
    public function stores(): View
    {
        $stores = Store::paginate(12);

        return view('stores', compact('stores'));
    }

    public function randomStores()
    {
        $randomStores = Store::inRandomOrder()->take(3)->get();
        return view('welcome', compact('randomStores'));
    }

    public function search(Request $request)
    {
        $searchName = $request->input('searchName');
        $searchType = $request->input('searchType');

        if ($searchType === 'stores') {
            $stores = Store::where('name', 'LIKE', "%{$searchName}%")->paginate(10);
            return view('stores', compact('stores'));
        } elseif ($searchType === 'products') {
            $products = Product::where('name', 'LIKE', "%{$searchName}%")
                ->with('store')
                ->paginate(20);
            return view('search-products', compact('products'));
        }

        return redirect()->route('welcome')->with('error', 'Invalid search type.');
    }

    public function searchProducts(Request $request, Store $store)
    {
        $searchName = $request->input('searchName');

        $categories = Category::whereHas('products', function ($query) use ($store) {
            $query->where('store_id', $store->id);
        })->get();

        $query = $store->products();

        $categoryId = $request->query('category');
        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        $products = $query->where('store_id', $store->id)
            ->where('name', 'LIKE', "%{$searchName}%")
            ->paginate(12);

        return view('products', compact('products', 'store', 'categories', 'categoryId'));
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

        $products = $query->paginate(12);

        return view('products', compact('products', 'store', 'categories', 'categoryId'));
    }
}
