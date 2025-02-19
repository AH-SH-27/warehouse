<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\View\View;

class AdminController extends Controller
{

    public function index(): View
    {
        $clients = User::where('role', 'client')->count();
        $vendors = User::where('role', 'vendor')->count();
        $admins = User::where('role', 'admin')->count();

        $stores = Store::count();

        $products = Product::count();

        $orders = Order::count();

        $today = Carbon::today();
        $startOfWeek = Carbon::now()->startOfWeek();
        $startOfMonth = Carbon::now()->startOfMonth();

        $ordersToday = Order::whereDate('created_at', $today)->count();
        $ordersThisWeek = Order::whereBetween('created_at', [$startOfWeek, now()])->count();
        $ordersThisMonth = Order::whereBetween('created_at', [$startOfMonth, now()])->count();

        $newStoresThisMonth = Store::whereBetween('created_at', [$startOfMonth, now()])->count();
        $newClientsThisMonth = User::where('role', 'client')->whereBetween('created_at', [$startOfMonth, now()])->count();
        $newVendorsThisMonth = User::where('role', 'vendor')->whereBetween('created_at', [$startOfMonth, now()])->count();

        return view('admin.dashboard', compact(
            'clients', 'vendors', 'admins', 'stores', 'products', 'orders',
            'ordersToday', 'ordersThisWeek', 'ordersThisMonth',
            'newStoresThisMonth', 'newClientsThisMonth', 'newVendorsThisMonth'
        ));
    }

    public function listUsers()
    {
        $users = User::whereIn('role', ['vendor', 'client'])->paginate(10);
        
        return view('admin.users', compact('users'));
    }

    public function deleteUser(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }

    public function promoteToAdmin(User $user)
    {
        $user->update(['role' => 'admin']);

        return redirect()->route('admin.users')->with('success', 'User promoted to admin.');
    }

    public function listStores()
    {
        $stores = Store::with('vendor')->paginate(10);
        return view('admin.stores', compact('stores'));
    }

    public function deleteStore(Store $store)
    {
        $store->delete();
        
        return redirect()->route('admin.stores')->with('success', 'Store deleted successfully.');
    }

    public function listOrders()
    {
        $orders = Order::with('client')->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.orders.index', compact('orders'));
    }

    public function orderDetails(Order $order)
    {
        $order->load(['client', 'items.product']);

        return view('admin.orders.details', compact('order'));
    }
}
