@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')
<h1 class="text-3xl font-bold text-blue-800 mb-6">Detail Produk</h1>
<div class="bg-white shadow-md rounded-lg p-6">
    <p><strong>Nama:</strong> {{ $product->name }}</p>
    <p><strong>Deskripsi:</strong> {{ $product->description }}</p>
    <p><strong>Harga:</strong> Rp {{ number_format($product->price, 0, ',', '.') }}</p>
    <p><strong>Diskon:</strong> {{ $product->discount }}%</p>
    <p><strong>Stok:</strong> {{ $product->stock }}</p> 
    <p><strong>Ukuran:</strong> {{ $product->size ? $product->size : 'Tidak tersedia' }}</p>
    <p><strong>Gambar:</strong></p>
    @if ($product->image)
        <img src="{{ asset('storage/product_images/' . $product->image) }}" alt="Gambar Produk" class="w-48 h-48 object-cover rounded-md">
    @else
        <p class="text-gray-500">Tidak ada gambar</p>
    @endif
</div>

<a href="{{ route('admin.products.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition duration-200">
    Kembali
</a>
@endsection
