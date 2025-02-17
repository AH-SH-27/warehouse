<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicPagesController;
use App\Http\Controllers\Vendor\StoreController;
use App\Http\Controllers\Vendor\VendorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'rolemanager:client'])->name('dashboard');

Route::middleware(['auth', 'verified', 'rolemanager:client'])->group(function () {
    Route::get('/cart', function () {
        return view('cart');
    })->name('cart');
    Route::get('/orders', [OrdersController::class, 'clientOrders'])->name('orders.clientOrders');
    Route::post('/orders/create', [OrdersController::class, 'store'])->name('orders.store');
});

Route::get('/stores', [PublicPagesController::class, 'stores'])->name('public.stores');
Route::get('/stores/{store}/products', [PublicPagesController::class, 'productsByStore'])->name('public.store.products');


Route::middleware(['auth', 'verified', 'rolemanager:vendor'])->group(function () {
    Route::get('/vendor/dashboard', [VendorController::class, 'index'])->name('vendor.dashboard');
    Route::get('/vendor/store', [StoreController::class, 'index'])->name('vendor.store.create');
    Route::post('/vendor/store', [StoreController::class, 'store'])->name('vendor.store.store');
    Route::get('/vendor/store/edit', [StoreController::class, 'edit'])->name('vendor.store.edit');
    Route::post('/vendor/store/update', [StoreController::class, 'update'])->name('vendor.store.update');
    Route::post('/vendor/store/delete', [StoreController::class, 'destroy'])->name('vendor.store.delete');
    Route::resource('/vendor/category', CategoryController::class);
    Route::resource('/vendor/product', ProductController::class);
    Route::get('/vendor/orders', [OrdersController::class, 'vendorOrders'])->name('vendor.orders');
    Route::post('/vendor/orders/update-status/{order}', [OrdersController::class, 'updateOrderStatus'])->name('vendor.orders.updateStatus');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified', 'rolemanager:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminController::class, 'listUsers'])->name('admin.users');
    Route::delete('/admin/users/{user}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
    Route::post('/admin/users/{user}/promote', [AdminController::class, 'promoteToAdmin'])->name('admin.users.promote');
    Route::get('/admin/stores', [AdminController::class, 'listStores'])->name('admin.stores');
    Route::delete('/admin/stores/{store}', [AdminController::class, 'deleteStore'])->name('admin.stores.delete');
    Route::get('/admin/orders', [AdminController::class, 'listOrders'])->name('admin.orders');
    Route::get('/admin/orders/{order}', [AdminController::class, 'orderDetails'])->name('admin.orders.details');
});


require __DIR__ . '/auth.php';
