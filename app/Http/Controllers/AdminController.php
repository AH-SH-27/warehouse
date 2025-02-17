<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{

    public function index(): View
    {
        return view('admin.dashboard');
    }

    public function listUsers()
    {
        $users = User::whereIn('role', ['vendor', 'client'])->get();
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
        $stores = Store::with('vendor')->get();
        return view('admin.stores', compact('stores'));
    }

    public function deleteStore(Store $store)
    {
        $store->delete();

        return redirect()->route('admin.stores')->with('success', 'Store deleted successfully.');
    }

    public function listOrders()
    {
        $orders = Order::with('client')->orderBy('created_at', 'desc')->get();

        return view('admin.orders.index', compact('orders'));
    }

    public function orderDetails(Order $order)
    {
        $order->load(['client', 'items.product']);

        return view('admin.orders.details', compact('order'));
    }
}
