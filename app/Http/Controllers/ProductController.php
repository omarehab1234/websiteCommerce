<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Validation\Rule;


class ProductController extends Controller
{
    function view(Product $product){
        

        return view('product.view',['product'=>$product]);
    }
    function showUser(){
        $products = Product::all();

        return view('product.indexUser',['products'=>$products]);
    }

    function show(){
        $products = Product::all();

        return view('product.index',['products'=>$products]);
    }

    function destroy(Product $product){
        Storage::disk("public")->delete($product->image);
        $product->delete();
        return back()->with('success', 'Product has been Deleted successfully.');
    }
    function showForm(){
        $categories = Category::all();

        return view('product.create',['categories'=>$categories]);
    }

    function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|min:3|max:100|unique:products,name',
            'description' => 'required|min:10',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'name.required' => 'Product name is required.',
            'name.min' => 'Product name must be at least 3 characters.',
            'description.required' => 'Description is required.',
            'price.required' => 'Price is required.',
            'price.numeric' => 'Price must be a number.',
            'category_id.required' => 'Please select a category.',
            'category_id.exists' => 'Selected category is invalid.',
            'quantity.required' => 'Quantity is required.',
            'quantity.integer' => 'Quantity must be a whole number.',
            'quantity.min' => 'Quantity cannot be negative.',
        ]);

        $validated['image'] = $request->file('image')->store('products', 'public');
        Product::create($validated);

        return redirect()->route('products.index')
        ->with('success', 'Product added successfully.');

    }
    function edit(Product $product){
        $categories = Category::all();

        return view('product.edit',['product'=>$product,'categories'=>$categories]);
    }

    function editProd(Product $product,Request $request){
        $validated = $request->validate([
            'name' => ['required',
                        'min:3',
                        'max:100',
                        Rule::unique('products', 'name')->ignore($product->id),
                    ],
            'description' => 'required|min:10',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'name.required' => 'Product name is required.',
            'name.min' => 'Product name must be at least 3 characters.',
            'description.required' => 'Description is required.',
            'price.required' => 'Price is required.',
            'price.numeric' => 'Price must be a number.',
            'category_id.required' => 'Please select a category.',
            'category_id.exists' => 'Selected category is invalid.',
            'quantity.required' => 'Quantity is required.',
            'quantity.integer' => 'Quantity must be a whole number.',
            'quantity.min' => 'Quantity cannot be negative.',
        ]);
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($product->image);

            $validated['image'] = $request->file('image')->store('products', 'public');
        }
        $product->update($validated);

        return redirect()->route('products.index')
        ->with('success', 'Product edited successfully.');

    }
}
