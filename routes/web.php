<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Vendor\StoreController;
use App\Http\Controllers\Vendor\VendorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'rolemanager:client'])->name('dashboard');

Route::get('/admin/dashboard', function () {
    return view('admin');
})->middleware(['auth', 'verified', 'rolemanager:admin'])->name('admin');

Route::middleware(['auth', 'verified', 'rolemanager:vendor'])->group(function(){
    Route::get('/vendor/dashboard',[VendorController::class, 'index'])->name('vendor.dashboard');
    Route::get('/vendor/store',[StoreController::class, 'index'])->name('vendor.store.create');
    Route::post('/vendor/store',[StoreController::class, 'store'])->name('vendor.store.store');
    Route::get('/vendor/store/edit',[StoreController::class, 'edit'])->name('vendor.store.edit');
    Route::post('/vendor/store/update',[StoreController::class, 'update'])->name('vendor.store.update');
    Route::post('/vendor/store/delete',[StoreController::class, 'destroy'])->name('vendor.store.delete');
    Route::resource('/vendor/category', CategoryController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
