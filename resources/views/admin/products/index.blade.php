@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-blue-800 mb-6 text-center">Daftar Produk</h1>

    <a href="{{ route('admin.products.create') }}" 
       class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition duration-200 mb-6 inline-flex items-center space-x-2 mx-auto block">
        <i class="fas fa-plus"></i>
        <span>Tambah Produk</span>
    </a>

    <div class="overflow-x-auto shadow-lg rounded-lg mx-auto">
        <table class="w-full text-left bg-white rounded-lg shadow-md">
            <thead class="bg-blue-500 text-white">
                <tr>
                    <th class="px-6 py-3 text-sm font-medium text-center">No</th>
                    <th class="px-6 py-3 text-sm font-medium text-center">Nama</th>
                    <th class="px-6 py-3 text-sm font-medium text-center">Gambar</th>
                    <th class="px-6 py-3 text-sm font-medium text-center">Harga</th>
                    <th class="px-6 py-3 text-sm font-medium text-center">Diskon</th>
                    <th class="px-6 py-3 text-sm font-medium text-center">Harga Setelah Diskon</th>
                    <th class="px-6 py-3 text-sm font-medium text-center">Stok</th>
                    <th class="px-6 py-3 text-sm font-medium text-center">Ukuran</th> <!-- Kolom Size -->
                    <th class="px-6 py-3 text-sm font-medium text-center">Aksi</th>
                </tr>
            </thead>            
            <tbody>
                @forelse ($products as $product)
                <tr class="border-b hover:bg-blue-50">
                    <td class="px-6 py-4 text-center text-sm">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 text-center text-sm">{{ $product->name }}</td>
                    <td class="px-6 py-4 text-center text-sm">
                        @if ($product->images)
                            <div class="flex space-x-2 justify-center">
                                @foreach (json_decode($product->images, true) as $image)
                                    <img src="{{ asset('storage/' . $image) }}" alt="Gambar Produk" class="w-16 h-16 object-cover rounded-md">
                                @endforeach
                            </div>
                        @else
                            <span class="text-gray-500">Tidak ada gambar</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-center text-sm">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 text-center text-sm">{{ $product->discount }}%</td>
                    <td class="px-6 py-4 text-center text-sm">Rp {{ number_format($product->price * (1 - $product->discount / 100), 0, ',', '.') }}</td>
                    <td class="px-6 py-4 text-center text-sm">{{ $product->stock }}</td>
                    <td class="px-6 py-4 text-center text-sm">{{ $product->size ?? 'N/A' }}</td> <!-- Kolom Ukuran -->
                    <td class="px-6 py-4 text-center text-sm">
                        <div class="flex justify-center items-center space-x-2">
                            <a href="{{ route('admin.products.edit', $product->id) }}" 
                               class="bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600 text-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <button class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 text-sm" 
                                    onclick="openModal({{ $product->id }})" 
                                    data-name="{{ $product->name }}"
                                    data-price="{{ number_format($product->price, 0, ',', '.') }}"
                                    data-discount="{{ $product->discount }}"
                                    data-stock="{{ $product->stock }}"
                                    data-size="{{ $product->size }}"
                                    data-description="{{ $product->description }}"
                                    data-images="{{ json_encode(json_decode($product->images, true) ?? []) }}">
                                <i class="fas fa-info-circle"></i> Lihat
                            </button>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 text-sm"
                                        onclick="return confirm('Hapus produk ini?')">
                                    <i class="fas fa-trash-alt"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="px-4 py-2 text-center text-gray-500">
                        Belum Ada Produk
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div id="productModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center hidden z-50">
    <div class="bg-white p-8 rounded-2xl shadow-2xl w-11/12 max-w-4xl relative">
        <button onclick="closeModal()" 
                class="absolute top-4 right-4 bg-red-500 text-white w-10 h-10 rounded-full flex justify-center items-center hover:bg-red-600 transition duration-300 shadow-md">
            <i class="fas fa-times text-xl"></i>
        </button>

        <div class="flex flex-col md:flex-row items-center space-y-6 md:space-y-0 md:space-x-8">
            <div class="flex-shrink-0 w-full md:w-1/2 relative">
                <div id="modalImagesCarousel" class="relative w-full h-96">
                    <button id="prevImage" class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-gray-300 p-3 rounded-full text-gray-700 hover:bg-gray-400 z-10 shadow-md">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <img id="carouselImage" src="" alt="Gambar Produk" class="w-full h-full object-contain rounded-lg shadow-md">
                    <button id="nextImage" class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-gray-300 p-3 rounded-full text-gray-700 hover:bg-gray-400 z-10 shadow-md">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
            <div class="flex-grow w-full md:w-1/2 text-center md:text-left font-poppins">
                <h2 id="modalProductName" class="text-4xl font-bold text-blue-800 mb-4 leading-tight">Nama Produk</h2>
                <p id="modalProductPrice" class="text-xl text-gray-800 font-semibold mb-2">Harga: </p>
                <p id="modalProductDiscount" class="text-lg text-green-600 font-semibold mb-2">Diskon: </p>
                <p id="modalProductStock" class="text-lg text-gray-700 font-semibold mb-2">Stok: </p>
                <p id="modalProductSize" class="text-lg text-gray-700 font-semibold mb-2">Ukuran: </p>
                <p id="modalProductDescription" class="text-base text-gray-600 leading-relaxed">Deskripsi: </p>
            </div>
        </div>
        <div class="mt-8 text-center">
            <button onclick="closeModal()" 
                    class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-8 py-3 rounded-full font-bold hover:shadow-lg transition duration-300">
                Tutup
            </button>
        </div>
    </div>
</div>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
    .font-poppins {
        font-family: 'Poppins', sans-serif;
    }
</style>


<script>
    let currentImageIndex = 0;
    let images = [];

    function openModal(productId) {
    const productButton = document.querySelector(`button[onclick="openModal(${productId})"]`);
    const name = productButton.getAttribute('data-name');
    const price = productButton.getAttribute('data-price');
    const discount = productButton.getAttribute('data-discount');
    const stock = productButton.getAttribute('data-stock');
    const size = productButton.getAttribute('data-size');
    const description = productButton.getAttribute('data-description');
    images = JSON.parse(productButton.getAttribute('data-images'));

    currentImageIndex = 0;
    updateCarousel();

    document.getElementById('modalProductName').textContent = name;
    document.getElementById('modalProductPrice').textContent = `Harga: Rp ${price}`;
    document.getElementById('modalProductDiscount').textContent = `Diskon: ${discount}%`;
    document.getElementById('modalProductStock').textContent = `Stok: ${stock}`;
    document.getElementById('modalProductDescription').textContent = description;
    document.getElementById('modalProductSize').textContent = `Ukuran: ${size || 'N/A'}`;

    document.getElementById('productModal').classList.remove('hidden');
}


    function closeModal() {
        document.getElementById('productModal').classList.add('hidden');
    }

    function updateCarousel() {
        if (images.length > 0) {
            document.getElementById('carouselImage').src = `{{ asset('storage') }}/${images[currentImageIndex]}`;
        } else {
            document.getElementById('carouselImage').src = '';
        }
    }

    document.getElementById('prevImage').addEventListener('click', () => {
        currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
        updateCarousel();
    });

    document.getElementById('nextImage').addEventListener('click', () => {
        currentImageIndex = (currentImageIndex + 1) % images.length;
        updateCarousel();
    });
</script>

@endsection
