@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-blue-800 mb-6">Edit Produk</h1>
    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-6">
        @csrf
        @method('PUT')
        
        <!-- Nama Produk -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-medium mb-2">Nama</label>
            <input type="text" name="name" id="name" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                   value="{{ $product->name }}" required>
        </div>

        <!-- Deskripsi -->
        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-medium mb-2">Deskripsi</label>
            <textarea name="description" id="description" rows="4" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $product->description }}</textarea>
        </div>

        <!-- Harga -->
        <div class="mb-4">
            <label for="price" class="block text-gray-700 font-medium mb-2">Harga</label>
            <input type="number" name="price" id="price" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                   value="{{ $product->price }}" required oninput="calculateDiscountedPrice()">
        </div>

        <!-- Stok -->
        <div class="mb-4">
            <label for="stock" class="block text-gray-700 font-medium mb-2">Stok</label>
            <input type="number" name="stock" id="stock" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                   value="{{ $product->stock }}" required min="0">
        </div>

        <!-- Diskon -->
        <div class="mb-4">
            <label for="discount" class="block text-gray-700 font-medium mb-2">Diskon (%)</label>
            <input type="number" name="discount" id="discount" min="0" max="100" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                   value="{{ $product->discount }}" oninput="calculateDiscountedPrice()">
        </div>

        <!-- Harga Setelah Diskon -->
        <div class="mb-4">
            <label for="discounted_price" class="block text-gray-700 font-medium mb-2">Harga Setelah Diskon</label>
            <input type="text" name="discounted_price" id="discounted_price" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                   value="Rp {{ number_format($product->price - ($product->price * $product->discount / 100), 0, ',', '.') }}" readonly>
        </div>

        <!-- Gambar -->
        <div class="mb-6">
            <label for="image" class="block text-gray-700 font-medium mb-2">Gambar</label>
            <input type="file" name="image" id="image" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            @if ($product->image)
                <p class="mt-2 text-gray-600">Gambar saat ini:</p>
                <img src="{{ asset('storage/' . $product->image) }}" alt="Gambar Produk" class="w-32 h-32 object-cover rounded-md mt-2">
            @endif
        </div>

        <!-- Tombol Aksi -->
        <div class="flex justify-end space-x-4">
            <a href="{{ route('admin.products.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition duration-200">
                Batal
            </a>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-200">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>

<script>
    // Fungsi untuk menghitung harga setelah diskon
    function calculateDiscountedPrice() {
        var price = parseFloat(document.getElementById('price').value);
        var discount = parseFloat(document.getElementById('discount').value);
        if (price && discount >= 0 && discount <= 100) {
            var discountedPrice = price - (price * discount / 100);
            document.getElementById('discounted_price').value = 'Rp ' + discountedPrice.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        } else {
            document.getElementById('discounted_price').value = 'Rp 0';
        }
    }

    // Call the function to set the initial discounted price on page load
    calculateDiscountedPrice();
</script>
@endsection
