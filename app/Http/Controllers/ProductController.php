<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Models\Godown;
use App\Models\Product;

class ProductController extends Controller
{   
    // Show Products List
    public function index()
    {
        $products = Product::with(['vendor', 'godown'])->paginate(10);
        return view('admin.pages.products.products', compact('products'));
    }

    // Show Add Product Page
    public function create()
    {
        $vendors = Vendor::all();
        $godowns = Godown::all();

        return view('admin.pages.products.add_product', compact('vendors', 'godowns'));
    }

    // Store Product
    public function store(Request $request)
    {
        $request->validate([
            'vendor_id' => 'required|exists:vendors,id',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'material_id' => 'required',
            'product_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'colors' => 'required|array',
            'quality_rating' => 'required',
            'rent_per_day' => 'required|numeric|min:0',
            'godown_id' => 'required|exists:godowns,id',
        ]);

        // Image Upload
        $imagePath = null;
        if ($request->hasFile('product_image')) {
            $imagePath = $request->file('product_image')->store('products', 'public');
        }

        Product::create([
            'vendor_id' => $request->vendor_id,
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'material_id' => $request->material_id,
            'image' => $imagePath,
            'colors' => json_encode($request->colors),
            'quality_rating' => $request->quality_rating,
            'rent_per_day' => $request->rent_per_day,
            'godown_id' => $request->godown_id,
        ]);

        return redirect()->route('admin.products.add')->with('success', 'Product Added Successfully!');
    }
}
