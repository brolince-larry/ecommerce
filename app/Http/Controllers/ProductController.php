<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    //authorization
    private function authorizeRole(){
        $role= Auth::user()->role;
        if(!in_array($role, [0,1])){
            abort(403, 'Unauthorized accessed');
        }
    }
    //show all products
    public function index(){
        $products= Product::with('category')->latest()->paginate(10);
        return view('products.index', compact('products'));
    }
    //create a product
    public function create(Request $request){
        $this->authorizeRole();
        $categories =Category::all();
        //select that coming from categories
        $selectedCategory = $request->query('category_id');
        return  view('products.create', compact('categories', 'selectedCategory'));

    }
     public function show(Product $product)
    {
        return view('customer.products.show', compact('product'));
    }
    //store new product
    public function store(Request $request){
        $this->authorizeRole();
        $validated = $request->validate([
            'name'=>'required|string',
            'description'=>'nullable|string',
            'price'=>'required|numeric',
            'category_id'=>'required|exists:categories,id',
            'image'=>'nullable|image|max:2048'
        ]);
        //handle image upload
        if($request->hasFile('image')){
            $validated['image']= $request->file('image')->store('products', 'public');

        }
        Product::create($validated);
        return redirect()->route('products.index')->with('success', 'product created successful');
    }
}
