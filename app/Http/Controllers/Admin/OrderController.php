<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function paidOrder(){
        //fetch all orders paid with customer details
        $orders = Order::where('status', 'paid')->with('user')->latest()->paginate(10);
        return view('admin.orders.paid', compact('orders'));
        
    }
}
