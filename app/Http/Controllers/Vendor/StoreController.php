<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class StoreController extends Controller
{
    // display create store page
    public function index(): View
    {
        return view('vendor.store.create',[
            'vendor' => Auth::user()
        ]);
    }

    // create new store
    public function store(Request $request)
    {
     $request->validate([
        'name'=>['required', 'string', 'max:255'],
        'description'=>['nullable', 'string'],
     ]);
     if(Auth::user()->store)
     {
        return redirect()->route('vendor.dashboard')->with('error','You already have a store');
     }

     Store::create([
        'vendor_id'=> Auth::id(),
        'name'=> $request->name,
        'description'=>$request->description,
     ]);

     return redirect()->route('vendor.dashboard')->with('success','Store created successfully');
    } 

    // direct vendor to edit store page
    public function edit(): View
    {
        $store = Auth::user()->store;
        if(!$store){
            return redirect()->route('vendor.dashboard')->with('error', 'No store found');
        }
        return view('vendor.store.edit', compact('store'));
    }

    // update store in data
    public function update(Request $request)
    {
        $store = Auth::user()->store;
        
        $request->validate([
            'name'=>['required', 'string', 'max:255'],
            'description'=>['nullable', 'string'],
         ]);

         $store->update([
            'name' => $request->name,
            'description' => $request->description,
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

        $store->delete();

        return redirect()->route('vendor.dashboard')->with('success', 'Store deleted successfully.');

    }
}
