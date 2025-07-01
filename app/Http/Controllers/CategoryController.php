<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    //private auth
    private function authorizeRole(){
        $role =Auth::user()->role;
        if(!in_array($role, [0,1])){
            abort(403, 'Unauthorized access');
        }
    }
    // Show all categories (any authenticated user)
    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return view('categories.index', compact('categories'));
    }

    // Show create form (admin & seller only)
    public function create()
    {
        $this->authorizeRole();

        return view('categories.create');
    }

    // Store new category (admin & seller only)
    public function store(Request $request)
    {
        $this->authorizeRole();

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string|max:1000',
        ]);

        Category::create($validated);

        return redirect()->route('categories.index')->with('success', 'Category has been created.');
    }

    // Show edit form (admin & seller only)
    public function edit(Category $category)
    {
        $this->authorizeRole();

        return view('categories.edit', compact('category'));
    }
     //show category with products
     public function show(Category $category){
        //load category wih its products
        $category ->load('products');
        return view('categories.show',compact('category'));

     }
    // Update the category (admin & seller only)
    public function update(Request $request, Category $category)
    {
        $this->authorizeRole();

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string|max:1000',
        ]);

        $category->update($validated);

        return redirect()->route('categories.index')->with('success', 'Category has been updated successfully.');
    }

    // Delete a category (admin & seller only)
    public function destroy(Category $category)
    {
        $this->authorizeRole();

        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category has been deleted.');
    }

    
}
