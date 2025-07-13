<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Branch;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Show the payment confirmation form.
     */
    public function confirm($orderId)
    {
        $order = Order::findOrFail($orderId);
        return view('payment.confirm', compact('order'));
    }

    /**
     * Process the payment and assign the nearest branch.
     */
    public function pay(Request $request, $orderId)
    {
        // Validate input fields based on selected payment method
        $request->validate([
            'method' => 'required|in:mpesa,bank,paypal',

            'mpesa_number' => [
                'required_if:method,mpesa',
                'nullable',
                'regex:/^(07|01)[0-9]{8}$/'
            ],

            'bank_account' => 'required_if:method,bank|nullable|digits_between:6,20',
            'paypal_email' => 'required_if:method,paypal|nullable|email',

            'lat' => 'nullable|numeric',
            'lng' => 'nullable|numeric',
        ]);

        $order = Order::findOrFail($orderId);

        // Prevent duplicate payments
        if ($order->status === 'paid') {
            return redirect()->route('customer.orders.index')
                ->with('info', 'Order is already paid.');
        }

        // Create the payment record
        Payment::create([
            'user_id'       => auth()->id(),
            'order_id'      => $order->id,
            'amount'        => $order->total,
            'method'        => $request->method,
            'mpesa_number'  => $request->mpesa_number,
            'bank_account'  => $request->bank_account,
            'paypal_email'  => $request->paypal_email,
            'latitude'           => $request->latitude,
            'longitude'           => $request->latitude,
            'status'        => 'paid',
        ]);

        // Assign nearest branch based on customer location
        if ($request->lat && $request->lng) {
            $nearestBranch = Branch::selectRaw('*, (6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance', [
                $request->latitude, $request->longitude, $request->latitude
            ])
            ->orderBy('distance')
            ->first();

            if ($nearestBranch) {
                $order->branch_id = $nearestBranch->id;
            }
        }

        // Mark order as paid and save
        $order->is_paid = true;
        $order->status = 'paid';
        $order->save();

        return redirect()->route('customer.orders.index')
            ->with('success', 'Your order has been received. Delivery will be done within 72 hours to the nearest branch.');
    }
}
