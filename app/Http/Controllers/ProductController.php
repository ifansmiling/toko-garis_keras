<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all(); 
        return view('admin.products.index', compact('products')); 
    }

    public function showProducts()
    {
        $products = Product::all()->map(function ($product) {
            if ($product->discount && $product->price) {
                $product->discounted_price = $product->price - ($product->price * $product->discount / 100);
            } else {
                $product->discounted_price = $product->price;
            }
            return $product;
        });
    
        $testimonials = Testimonial::take(3)->get();
    
        return view('welcome', compact('products', 'testimonials'));
    }
    

    public function create()
    {
        return view('admin.products.create'); 
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric',
        'discount' => 'nullable|integer|min:0|max:100',
        'stock' => 'required|integer|min:0', 
        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', 
    ]);
    
    $price = $request->price;
    $discount = $request->discount;
    $discountedPrice = $price - (($price * $discount) / 100);

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('product_images', 'public'); 
        $validated['image'] = $imagePath; 
    }

    $validated['discounted_price'] = $discountedPrice;

    Product::create($validated);

    return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function show(Product $product)
    {
        return response()->json($product);
    }

    public function update(Request $request, Product $product)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric',
        'discount' => 'nullable|integer|min:0|max:100',
        'stock' => 'required|integer|min:0', // Validasi stok
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
    ]);
    
    $price = $request->price;
    $discount = $request->discount;
    $discountedPrice = $price - (($price * $discount) / 100);

    $product->name = $validated['name'];
    $product->description = $validated['description'];
    $product->price = $validated['price'];
    $product->discount = $validated['discount'];
    $product->stock = $validated['stock']; 
    $product->discounted_price = $discountedPrice;

    if ($request->hasFile('image')) {
        if ($product->image) {
            Storage::delete('public/product_images/' . $product->image);
        }

        $imageName = time() . '.' . $request->image->extension();
        $request->image->storeAs('public/product_images', $imageName);

        $product->image = $imageName;
    }

    $product->save();

    return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }
    
    public function destroy(Product $product)
    {
        if ($product->image && Storage::exists('public/' . $product->image)) {
            Storage::delete('public/' . $product->image);
        }
    
        $product->delete();
    
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
    }
}
