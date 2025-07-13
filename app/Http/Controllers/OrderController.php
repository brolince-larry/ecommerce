<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Show list of customer's orders.
     */
    public function index()
    {
        $orders = Order::with('payments','branch')->where('user_id', Auth::id())->latest()->paginate(10);
        return view('customer.orders.index', compact('orders'));
    }

    /**
     * Place a new order and clear the cart.
     */
    public function place(Request $request)
    {
        $user = Auth::user();
        $carts = Cart::where('user_id', $user->id)->get();

        if ($carts->isEmpty()) {
            return redirect()->route('customer.cart.index')->with('error', 'Your cart is empty.');
        }

        $total = 0;
        foreach ($carts as $item) {
            $total += $item->product->price * $item->quantity;
        }

        DB::transaction(function () use ($user, $carts, $total, $request) {
            $order = Order::create([
                'user_id'   => $user->id,
                'total'     => $total,
                'status'    => 'pending',
                'branch_id' => $request->branch_id ?? null,
            ]);

            foreach ($carts as $cartItem) {
                $order->orderItems()->create([
                    'product_id' => $cartItem->product_id,
                    'quantity'   => $cartItem->quantity ?? 1,
                ]);
            }

            Cart::where('user_id', $user->id)->delete();
        });

        return redirect()->route('customer.orders.index')->with(
            'success',
            'Your order has been received. Delivery will be done within 72 hours to the nearest branch!'
        );
    }

    /**
     * Show paid orders to admin.
     */
    public function paidOrder()
    {
        $orders = Order::whereHas('payments')
            ->with(['user', 'payments', 'orderItems.product', 'branch'])
            ->latest()
            ->get();

        return view('admin.paid-orders', compact('orders'));
    }
    //status of order
    public function updateStatus(Request $request, order $order)
    {
        $validStatuses = ['paid', 'processing', 'ready', 'delivered'];
        $request->validate([
            'status' => 'required|in:paid,processing,ready,delivered',
        ]);
        //get current and request status position
        $currentIndex = array_search($order->status, $validStatuses);
        $newIndex = array_search($request->status, $validStatuses);
        //prevent going back if status is delivered
        if ($order->status === 'delivered') {
            return response()->json(['success' => false, 'message' => 'Cannot update a delivered order.']);
        }
         if($newIndex===false || $newIndex<= $currentIndex){
            return response()->json('error','Invalid status transition');

         }
                 $order->status = $request->status;
        $order->save();
        return  response()->json(['success' => true]);
    }
}
