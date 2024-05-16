<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::get();
        return view("admin.products", compact('products'));
    }

    public function store(Request $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->free = $request->free;
        $product->save();
        
        return redirect()->back()->with('product', 'Product has been created successfully!');
    }

    public function update(Request $request, string $id)
    {
        $product = Product::where('id', $id)->first();
        $product->update($request->all());

        return redirect()->back()->with('product', 'Product has been updated successfully!');
    }

    public function destroy(string $id)
    {
        $product = Product::where('id', $id)->first();
        $product->delete();
        return redirect()->back()->with('product', 'Product has been deleted successfully!');
    }
}
