@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-lg">
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">Tambah Produk</h1>
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Nama Produk -->
        <div class="mb-4">
            <label for="name" class="block text-lg font-medium text-gray-700">Nama Produk</label>
            <input type="text" name="name" id="name" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <!-- Deskripsi -->
        <div class="mb-4">
            <label for="description" class="block text-lg font-medium text-gray-700">Deskripsi</label>
            <textarea name="description" id="description" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
        </div>

        <!-- Harga -->
        <div class="mb-4">
            <label for="price" class="block text-lg font-medium text-gray-700">Harga</label>
            <input type="number" name="price" id="price" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <!-- Diskon -->
        <div class="mb-4">
            <label for="discount" class="block text-lg font-medium text-gray-700">Diskon (%)</label>
            <input type="number" name="discount" id="discount" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" min="0" max="100">
        </div>

        <!-- Harga Setelah Diskon -->
        <div class="mb-4">
            <label for="discounted_price" class="block text-lg font-medium text-gray-700">Harga Setelah Diskon</label>
            <input type="text" id="discounted_price" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" readonly>
        </div>

        <!-- Stok -->
        <div class="mb-4">
            <label for="stock" class="block text-lg font-medium text-gray-700">Stok</label>
            <input type="number" name="stock" id="stock" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" min="0" required>
        </div>

        <!-- Ukuran -->
        <div class="mb-4">
            <label for="size" class="block text-lg font-medium text-gray-700">Ukuran</label>
            <select name="size" id="size" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <option value="" disabled selected>Pilih Ukuran</option>
                <option value="S">S</option>
                <option value="M">M</option>
                <option value="L">L</option>
                <option value="XL">XL</option>
                <option value="XXL">XXL</option>
            </select>
        </div>

        <!-- Gambar Produk -->
        <div class="mb-6">
            <label for="images" class="block text-lg font-medium text-gray-700">Gambar Produk</label>
            <input type="file" name="images[]" id="images" multiple class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            <p class="mt-2 text-sm text-gray-500">Anda dapat mengunggah lebih dari satu gambar.</p>
        </div>        

        <!-- Tombol Aksi -->
        <div class="flex justify-between">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Simpan
            </button>
            <a href="{{ route('admin.products.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-md shadow-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500">
                Batal
            </a>
        </div>

        <!-- Script untuk Menghitung Harga Setelah Diskon -->
        <script>
            document.getElementById('price').addEventListener('input', calculateDiscountedPrice);
            document.getElementById('discount').addEventListener('input', calculateDiscountedPrice);
        
            function calculateDiscountedPrice() {
                var price = parseFloat(document.getElementById('price').value) || 0;
                var discount = parseFloat(document.getElementById('discount').value) || 0;
                var discountedPrice = price - (price * discount / 100);
                document.getElementById('discounted_price').value = discountedPrice.toFixed(2);
            }
        </script>
    </form>
</div>
@endsection
