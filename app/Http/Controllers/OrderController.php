<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the user's orders.
     */
    public function index()
    {
        // Get orders for the authenticated user, newest first, paginated
        $orders = Order::where('user_id', Auth::id())
                       ->latest()
                       ->paginate(10);

        // Correct: use view() instead of redirect() when showing a page
        return view('customer.orders.index', compact('orders'));
    }

    /**
     * Place a new order from the cart items.
     */
    public function place()
    {
        // Fetch all cart items for the authenticated user
        $carts = Cart::where('user_id', Auth::id())->get();

        // If the cart is empty, redirect to the cart page with an error message
        if ($carts->isEmpty()) {
            return redirect()->route('customer.cart.index')
                             ->with('error', 'Your cart is empty. Please add items before placing an order.');
        }

        // Calculate the total cost of items in the cart
        $total = 0;
        foreach ($carts as $item) {
            $total += $item->product->price * $item->quantity;
        }

        // Use DB transaction to ensure atomicity
        DB::transaction(function () use ($total, $carts) {
            // Create the order
            $order = Order::create([
                'user_id' => Auth::id(),
                'total' => $total,
                'status' => 'pending',
            ]);

            // Optionally: store ordered items in a separate order_items table here

            // Clear the user's cart
            Cart::where('user_id', Auth::id())->delete();
        });

        // Redirect to orders page with success message
        return redirect()->route('customer.orders.index')
                         ->with('success', 'Order placed successfully.');
    }
}
