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

            if ($product->images) {
                $product->image_urls = collect(json_decode($product->images))->map(function ($image) {
                    return asset('storage/product_images/' . $image);
                });
            } else {
                $product->image_urls = null;
            }

            return $product;
        });

        $testimonials = Testimonial::latest()->take(3)->get();

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
            'size' => 'nullable|string|max:50',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $price = $request->price;
        $discount = $request->discount;
        $discountedPrice = $price - (($price * $discount) / 100);

        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('product_images', 'public');
                $imagePaths[] = $imagePath;
            }
        }

        $validated['images'] = json_encode($imagePaths);
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
            'stock' => 'required|integer|min:0',
            'size' => 'nullable|string|max:50',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $price = $request->price;
        $discount = $request->discount;
        $discountedPrice = $price - (($price * $discount) / 100);

        // Update basic product information
        $product->name = $validated['name'];
        $product->description = $validated['description'];
        $product->price = $validated['price'];
        $product->discount = $validated['discount'];
        $product->stock = $validated['stock'];
        $product->size = $validated['size'];
        $product->discounted_price = $discountedPrice;

        // Handle image updates
        $existingImages = json_decode($product->images, true) ?? [];
        $newImagePaths = [];

        if ($request->hasFile('images')) {
            // Delete old images
            foreach ($existingImages as $oldImage) {
                if (Storage::exists('public/' . $oldImage)) {
                    Storage::delete('public/' . $oldImage);
                }
            }

            // Save new images
            foreach ($request->file('images') as $image) {
                $newImagePath = $image->store('product_images', 'public');
                $newImagePaths[] = $newImagePath;
            }

            $product->images = json_encode($newImagePaths);
        } else {
            // Use existing images if no new images are uploaded
            $product->images = json_encode($existingImages);
        }

        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $images = json_decode($product->images, true) ?? [];
        foreach ($images as $image) {
            if (Storage::exists('public/' . $image)) {
                Storage::delete('public/' . $image);
            }
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
    }
}
