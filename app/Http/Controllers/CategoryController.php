<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $categories = Auth::user()->store->categories ?? collect();
        return view('vendor.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('vendor.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255']
        ]);
        $store = Store::where('vendor_id', Auth::id())->firstOrFail();

        Category::create([
            'store_id' => $store->id,
            'name' => $request->name,
        ]);

        return redirect()->route('category.index')->with('success', 'Category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        if ($category->store->vendor_id !== Auth::id()) {
            abort(403);
        }
        return  view('vendor.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        if ($category->store->vendor_id !== Auth::id()) {
            abort(403);
        }
        $request->validate([
            'name' => ['required', 'string', 'max:255']
        ]);

        $category->update(['name' => $request->name]);

        return redirect()->route('category.index')->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if ($category->store->vendor_id !== Auth::id()) {
            abort(403);
        }

        $category->delete();

        return redirect()->route('category.index')->with('success', 'Category deleted successfully');
    }
}
