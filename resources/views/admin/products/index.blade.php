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
                    <th class="px-6 py-3 text-sm font-medium text-center">Harga Setelah Diskon</th> <!-- Kolom baru -->
                    <th class="px-6 py-3 text-sm font-medium text-center">Stok</th>
                    <th class="px-6 py-3 text-sm font-medium text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                <tr class="border-b hover:bg-blue-50">
                    <td class="px-6 py-4 text-center text-sm">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 text-center text-sm">{{ $product->name }}</td>
                    <td class="px-6 py-4 text-center text-sm">
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="Gambar Produk" class="w-16 h-16 object-cover rounded-md mx-auto">
                        @else
                            <span class="text-gray-500">Tidak ada gambar</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-center text-sm">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 text-center text-sm">{{ $product->discount }}%</td>
                    <td class="px-6 py-4 text-center text-sm">Rp {{ number_format($product->price * (1 - $product->discount / 100), 0, ',', '.') }}</td> <!-- Harga setelah diskon -->
                    <td class="px-6 py-4 text-center text-sm">{{ $product->stock }}</td>
                    <td class="px-6 py-4 text-center text-sm">
                        <div class="flex justify-center items-center space-x-2">
                            <a href="{{ route('admin.products.edit', $product->id) }}" 
                               class="bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600 text-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <button class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 text-sm" 
                                    onclick="openModal({{ $product->id }})">
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
                    <td colspan="8" class="px-4 py-2 text-center text-gray-500">
                        Belum Ada Produk
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div id="productModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white p-6 rounded-lg w-1/2">
        <h2 id="modalProductName" class="text-2xl font-bold text-blue-900 mb-4 text-center">Nama Produk</h2>
        <div id="modalProductImage" class="mb-4 text-center">
            <img src="" alt="Gambar Produk" class="w-full h-64 object-cover rounded-md">
        </div>
        <p id="modalProductPrice" class="mb-4 text-center">Harga: </p>
        <p id="modalProductDiscount" class="mb-4 text-center">Diskon: </p>
        <p id="modalProductStock" class="mb-4 text-center">Stok: </p>
        <p id="modalProductDescription" class="mb-4 text-center">Deskripsi: </p>
        <button onclick="closeModal()" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition duration-200">
            <i class="fas fa-times"></i> Tutup
        </button>
    </div>
</div>

<script>
    function openModal(productId) {
        @foreach ($products as $product)
            if (productId === {{ $product->id }}) {
                document.getElementById('modalProductName').textContent = '{{ $product->name }}';
                document.getElementById('modalProductImage').innerHTML = `<img src="{{ asset('storage/' . $product->image) }}" alt="Gambar Produk" class="w-full h-64 object-cover rounded-md">`;
                document.getElementById('modalProductPrice').textContent = 'Harga: Rp {{ number_format($product->price, 0, ',', '.') }}';
                document.getElementById('modalProductDiscount').textContent = 'Diskon: {{ $product->discount }}%';
                document.getElementById('modalProductStock').textContent = 'Stok: {{ $product->stock }}';
                document.getElementById('modalProductDescription').textContent = 'Deskripsi: {{ $product->description }}';
            }
        @endforeach
        document.getElementById('productModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('productModal').classList.add('hidden');
    }
</script>
@endsection
