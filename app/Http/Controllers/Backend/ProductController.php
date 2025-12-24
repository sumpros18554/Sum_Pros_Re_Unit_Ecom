<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display product list
     */
    public function index()
    {
        $products = Product::orderBy('product_id')->get();
        return view('backend.product.index', compact('products'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        return view('backend.product.form');
    }

    /**
     * Store new product
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:100',
            'description' => 'nullable|string|max:500',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'status'      => 'required|in:ACTIVE,INACTIVE',
        ]);

         // Handle image upload if a new file is provided
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('frontend/assets/images');
            $file->move($destinationPath, $filename);
            $validated['image_url'] = 'frontend/assets/images/' . $filename;
        }

        Product::create($validated);

        return redirect()->route('backend.products.index')
            ->with('success', '🎉 Product has been added successfully!');
    }

    /**
     * Show edit form
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('backend.product.form', compact('product'));
    }

    /**
     * Update product
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Validate input
        $validated = $request->validate([
            'name'        => 'required|string|max:100',
            'description' => 'nullable|string|max:500',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'status'      => 'required|in:ACTIVE,INACTIVE',
        ]);

        // Handle image upload if a new file is provided
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('frontend/assets/images');
            $file->move($destinationPath, $filename);
            $validated['image_url'] = 'frontend/assets/images/' . $filename;
        }

        $product->update($validated);

        return redirect()->route('backend.products.index')
            ->with('success', '✅ Product has been updated successfully!');
    }


    /**
     * Delete product
     */
    public function destroy($id)
    {
        Product::findOrFail($id)->delete();

        return redirect()->route('backend.products.index')
            ->with('success', '🗑️ Product has been deleted successfully.');
    }
}
