<?php

namespace App\Http\Controllers;
use App\Models\Product;

use Illuminate\Http\Request;    


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust file types and size as needed
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category' => 'required',
        ]);

        $product = new Product($request->all());

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName =  $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $product->image = $imageName;
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust file types and size as needed
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category' => 'required',
        ]);

        $product = Product::find($id);

        $product->fill($request->all());
        dd($request);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $product->image = $imageName;
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
    
        // Soft delete the product
        $product->delete();
    
        // If you want to force delete, uncomment the following line
        // $product->forceDelete();
    
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    // public function search(Request $request)
    // {
    //     $searchTerm = $request->input('search');
    //     $products = Product::where('name', 'like', "%$searchTerm%")
    //                         ->orWhere('description', 'like', "%$searchTerm%")
    //                         ->orWhere('category', 'like', "%$searchTerm%")
    //                         ->get();
    
    //     return view('products.index', compact('products', 'searchTerm'));
    // }
    
    public function search(Request $request)
    {
        $searchTerm = $request->input('query');
        $products = Product::where('name', 'like', '%'.$searchTerm.'%')->get();

        return view('products.index', compact('products', 'searchTerm'));
        
        // return view('search', compact('products', 'searchTerm'));
    }
    

    public function show($id)
    {
        $product = Product::find($id);
        return view('products.search', compact('product'));
}

    
    public function restore($id)
    {
            
    }
    
}
