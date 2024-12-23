<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Produk Kami</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-b from-blue-50 to-blue-100 text-gray-800 font-sans">

    <!-- Container -->
    <div class="container mx-auto px-4 py-12">

        <!-- Header -->
        <header class="text-center mb-12">
            <h1 class="text-5xl font-extrabold text-blue-700 leading-tight">
                Selamat Datang di <span class="text-blue-600 underline">Toko Kami</span>
            </h1>
            <p class="text-lg text-gray-600 mt-4">
                Temukan produk terbaik untuk Anda dengan harga terbaik!
            </p>
            <div class="mt-6">
                <a href="#products" class="px-6 py-3 bg-blue-600 text-white rounded-md shadow-md hover:bg-blue-500 transition duration-300">
                    Lihat Produk
                </a>
            </div>
        </header>

        <!-- Produk Grid -->
        <section id="products" class="mb-16">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Produk Unggulan</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach ($products as $product)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden transform hover:scale-105 hover:shadow-xl transition duration-300 ease-in-out">
                    
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-56 object-cover rounded-t-lg">
                    
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-800">{{ $product->name }}</h3>
                        <p class="text-gray-600 mt-2 text-sm">{{ Str::limit($product->description, 100) }}</p>

                        <div class="mt-4 flex items-center">
                            @if($product->discounted_price && $product->discounted_price < $product->price)
                                <span class="text-lg font-bold text-gray-500 line-through mr-2">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            @endif
                            <span class="text-lg font-bold text-green-600">Rp {{ number_format($product->discounted_price ?? $product->price, 0, ',', '.') }}</span>
                        </div>

                        @if ($product->discount)
                            <div class="mt-2">
                                <span class="text-sm text-red-500">Diskon {{ $product->discount }}%</span>
                            </div>
                        @endif

                        <div class="mt-4">
                            <span class="text-sm text-gray-500">Stok: {{ $product->stock }}</span>
                        </div>

                        <div class="mt-6">
                            <a href="#" class="block bg-blue-600 text-white px-4 py-2 rounded-md text-center hover:bg-blue-500 transition duration-300 ease-in-out">
                                Beli Sekarang
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        <!-- Testimonial Section -->
        <section id="testimonials" class="mb-16">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Testimoni Pelanggan</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                @if ($testimonials->isNotEmpty())
                    @foreach ($testimonials as $testimonial)
                    <div class="bg-white shadow-md rounded-lg p-6 text-center hover:shadow-lg transform hover:-translate-y-2 transition duration-300">
                        <h3 class="text-xl font-semibold text-gray-800">{{ $testimonial->name }}</h3>
                        <p class="text-sm text-gray-600 mt-2 italic">"{{ $testimonial->comment }}"</p>
                        <div class="mt-4 flex justify-center">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $testimonial->rating)
                                    <span class="text-yellow-400 text-lg">&#9733;</span>
                                @else
                                    <span class="text-gray-300 text-lg">&#9733;</span>
                                @endif
                            @endfor
                        </div>
                    </div>
                    @endforeach
                @else
                    <p class="text-center text-gray-500">Belum ada testimoni.</p>
                @endif
            </div>

            <div class="text-center mt-6">
                <a href="{{ route('testimonials.index') }}" class="text-blue-600 hover:underline">
                    Lihat Semua Testimoni
                </a>
            </div>
        </section>

        <section id="submit-testimonial" class="my-16 bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold text-gray-800 text-center mb-6">Berikan Testimoni Anda</h2>
            <form action="{{ route('testimonials.store') }}" method="POST" class="max-w-lg mx-auto">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-medium mb-2">Nama Anda</label>
                    <input type="text" id="name" name="name" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="mb-4">
                    <label for="comment" class="block text-gray-700 font-medium mb-2">Komentar</label>
                    <textarea id="comment" name="comment" rows="4" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                </div>
                <div class="mb-4">
                    <label for="rating" class="block text-gray-700 font-medium mb-2">Rating</label>
                    <select id="rating" name="rating" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="" disabled selected>Pilih Rating</option>
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}">{{ $i }} Bintang</option>
                        @endfor
                    </select>
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-500 transition duration-300">
                    Kirim Testimoni
                </button>
            </form>
        </section>
        

        <!-- Footer -->
        <footer class="text-center py-6 bg-blue-700 text-white rounded-t-lg shadow-md">
            <p class="text-sm">&copy; {{ date('Y') }} Toko Kami. All rights reserved.</p>
        </footer>

    </div>

</body>
</html>
