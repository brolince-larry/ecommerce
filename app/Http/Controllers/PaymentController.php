<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
     // Show payment confirmation view
    public function confirm($orderId)
    {
        $order = Order::findOrFail($orderId);
        return view('payment.confirm', compact('order'));
    }
    // Store payment for a given order
    public function pay(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);
        

        // Prevent double payment
        if ($order->status === 'paid') {
            return redirect()->route('customer.orders.index')
                             ->with('info', 'Order is already paid.');
        }

        // Simulate payment creation
        Payment::create([
            'user_id'  => auth()->id(),
            'order_id' => $order->id, // use property, NOT $order->id()
            'amount'   => $order->total,
            'method'   => 'simulated',
            'status'   => 'paid',
        ]);

        // Mark order as paid
        $order->update(['status' => 'paid']);

        return redirect()->route('customer.orders.index')
                         ->with('success', 'Payment successful!');
    }
}
