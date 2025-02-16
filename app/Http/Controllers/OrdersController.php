<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('dashboard'); // nothing remove later if not used 
    }

    public function clientOrders(): View
    {
        $orders = Order::where('client_id', Auth::id())
            ->with(['items.product', 'store'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('orders', compact('orders'));
    }

    public function vendorOrders(): View
    {
        $vendorStore = Auth::user()->store->id;

        $orders = Order::where('store_id', $vendorStore)
            ->with('client', 'items.product')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('vendor.order.index', compact('orders'));
    }

    public function updateOrderStatus(Request $request, Order $order)
    {
        if (!Auth::user()->store->find($order)) {
            return redirect()->route('vendor.orders')->with('error', 'Unauthorized action.');
        }

        if (in_array($order->status, ['rejected', 'completed'])) {
            return back()->with('error', 'You cannot change the status of a completed or rejected order.');
        }

        $request->validate([
            'status' => 'required|in:pending,processing,shipped,completed,rejected',
        ]);

        // Increment the taken quantity when making order if order is rejected
        if ($request->status == 'rejected') {
            foreach ($order->items as $item) {
                $item->product->increment('stock_quantity', $item->quantity);
            }
        }

        $order->update(['status' => $request->status]);

        return redirect()->route('vendor.orders')->with('success', 'Order status updated.');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Get data from page
        $cart = $request->input('cart');

        if (empty($cart) || !is_array($cart)) {
            return response()->json(['error' => 'Cart is empty'], 400);
        }

        $client = Auth::user();

        if ($client->role !== 'client') {
            return response()->json(['error' => 'Ordering is allowed by clients only'], 400);
        }

        $totalPrice = 0;
        $orderItems = [];

        foreach ($cart as $item) {
            $product = Product::find($item['id']);

            if (!$product || $product->stock_quantity < $item['quantity']) {
                return response()->json(['error' => "Insufficient stock for {$item['name']}"], 400);
            }

            $totalPrice += $product->price * $item['quantity'];

            $orderItems[] = [
                'product_id' => $product->id,
                'quantity' => $item['quantity'],
                'price' => $product->price,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Remove from stock
            $product->decrement('stock_quantity', $item['quantity']);
        }

        // Get store id 
        $storeId = Product::find($cart[0]['product_id'])->store_id;


        // Create order & Set default status
        $order = Order::create([
            'client_id' => $client->id,
            'total_price' => $totalPrice,
            'status' => 'pending',
            'store_id' => $storeId,
        ]);

        // Save order items
        foreach ($orderItems as &$orderItem) {
            $orderItem['order_id'] = $order->id;
        }
        OrderItem::insert($orderItems);

        return response()->json(['message' => 'Order placed successfully!', 'order_id' => $order->id], 200);
    }


    /**
     * Display the specified resource.
     */
    public function show(Order $orders)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $orders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $orders)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $orders)
    {
        //
    }
}
