<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //get all products in cart
    public function index(){
        $carts =Cart::with('product')
        ->where('user_id', Auth::id())
        ->get();
        return view('customer.cart.index', compact('carts'));
    }
    public function add(Request $request){
        $validated =$request->validate([
            'product_id' =>'required|exists:products,id',
            'quantity'=>'required|integer|min:1'
        ]);
        $item = Cart::updateOrCreate(
            ['user_id'=>Auth::id(),
            'product_id'=>$validated['product_id']],
            ['quantity'=>$validated['quantity']]
        );
        $item->update();
        return redirect()->route('customer.cart.index')->with('success', 'item added to a caart.');
    }
    public function remove($id){
        $item = Cart::where('id',$id)->where('user_id', Auth::id())->firstOrFail();
        $item->delete();
        return redirect()->route('customer.cart.index')->with('success','cart has been deleted successfully');

    }
}
