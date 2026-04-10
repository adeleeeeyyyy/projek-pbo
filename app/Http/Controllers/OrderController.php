<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->with('items.product')->latest()->get();
        return view('orders.index', compact('orders'));
    }

    public function create(Request $request)
    {
        $selectedIds = $request->input('selected_items', []);
        
        $query = Cart::where('user_id', Auth::id())->with('product');
        
        if (!empty($selectedIds)) {
            $query->whereIn('id', $selectedIds);
        }
        
        $cartItems = $query->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Please select at least one item to checkout.');
        }

        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        return view('checkout.index', compact('cartItems', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string|min:10',
            'payment_method' => 'required|in:cod,card',
            'cart_item_ids' => 'required|array',
            'cart_item_ids.*' => 'exists:carts,id'
        ]);

        $cartItems = Cart::where('user_id', Auth::id())
            ->whereIn('id', $request->cart_item_ids)
            ->with('product')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index');
        }

        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        DB::transaction(function () use ($cartItems, $total, $request) {
            $order = Order::create([
                'user_id' => Auth::id(),
                'total_price' => $total,
                'shipping_address' => $request->shipping_address,
                'payment_method' => $request->payment_method,
                'status' => 'pending'
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price
                ]);
            }

            // Only delete the items that were checked out
            Cart::whereIn('id', $request->cart_item_ids)->delete();
        });

        return redirect()->route('orders.index')->with('success', 'Order placed successfully!');
    }
}
