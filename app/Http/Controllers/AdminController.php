<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function adminProducts(){
        $products = Products::all();
        return view('admin.dashboard', compact('products')); // Pass products to the view
    }


    public function create(Request $request){

        return view('admin.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric'],
            'image' => ['required', 'image'],
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('images', 'public'); // Store image in 'public/images' directory
        }

        // Create product
        Products::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Product created successfully.');
    }

    public function edit($id){
        $product = Products::findOrFail($id);
        return view('admin.update',compact('product'));
    }
    public function update(Request $request, $id)
    {
        $product = Products::findOrFail($id);
    
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric'],
            'image' => ['nullable', 'image'], // Make image optional
        ]);
    
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('images', 'public');
            $product->image = $imagePath;
        }
    
        $product->save();
        return redirect()->route('admin.dashboard')->with('success', 'Product updated successfully.');
    }
    
    

    public function destroy($id)
    {
        $product = Products::findOrFail($id);
        $product->delete();

        // Return a JSON response for API calls
        if (request()->wantsJson()) {
            return response()->json(['message' => 'Product deleted successfully.'], 200);
        }

        // Redirect for web requests
        return redirect()->route('admin.dashboard')->with('success', 'Product deleted successfully.');
    }

}
