<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class StoreController extends Controller
{
    // display create store page
    public function index(): View
    {
        return view('vendor.store.create', [
            'vendor' => Auth::user()
        ]);
    }

    // create new store
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);
        if (Auth::user()->store) {
            return redirect()->route('vendor.dashboard')->with('error', 'You already have a store');
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('store_images', $imageName, 'public');
        }



        Store::create([
            'vendor_id' => Auth::id(),
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->route('vendor.dashboard')->with('success', 'Store created successfully');
    }

    public function edit(): View
    {
        $store = Auth::user()->store;
        if (!$store) {
            return redirect()->route('vendor.dashboard')->with('error', 'No store found');
        }
        return view('vendor.store.edit', compact('store'));
    }

    public function update(Request $request)
    {
        $store = Auth::user()->store;

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $oldImage = $store->image;
        $imagePath = $oldImage;

        if ($request->hasFile('image')) {
            if ($oldImage) {
                Storage::disk('public')->delete($oldImage);
            }
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('store_images', $imageName, 'public');
        }

        $store->update([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->route('vendor.dashboard')->with('success', 'Store updated successfully.');
    }

    // delete store
    public function destroy()
    {
        $store = Auth::user()->store;

        if (!$store) {
            return redirect()->route('vendor.dashboard')->with('error', 'No store found.');
        }


        $oldImage = $store->image;
        if ($oldImage) {
            Storage::disk('public')->delete($oldImage);
        }
        $store->delete();

        return redirect()->route('vendor.dashboard')->with('success', 'Store deleted successfully.');
    }
}
