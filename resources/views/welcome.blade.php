<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Produk Kami</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/@aminerm/hot-toast@2.0.0/dist/index.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@aminerm/hot-toast@2.0.0/dist/index.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs" defer></script>
</head>
<body class="bg-neutral-950 font-sans" x-data="{ showModal: false, selectedProduct: null, showReceipt: false, receiptData: {} }">
    @include('frontend.component.navbar')
    @include('frontend.section.banner')
    @include('frontend.section.about')

    <div class="container mx-auto px-4 py-12">
        <!-- Produk Grid -->
        <section id="products" class="mb-16">
            <h2 class="text-3xl font-bold text-center text-gray-200 mb-8">Produk Unggulan</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-10">
                @foreach ($products as $product)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden duration-500 hover:scale-105 hover:shadow-2xl cursor-pointer" @click="showModal = true; selectedProduct = {{ json_encode($product) }}">
                    <img src="{{ asset('storage/' . json_decode($product->images)[0]) }}" alt="{{ $product->name }}" class="h-64 w-full object-cover object-center" onerror="this.src='/placeholder-image.jpg';">
                    <div class="p-4">
                        <h3 class="text-lg font-bold text-gray-900 truncate">{{ $product->name }}</h3>
                        <p class="text-sm text-gray-600 mt-2">
                            <strong>Ukuran:</strong> {{ $product->size ? $product->size : 'Tidak tersedia' }}
                        </p>
                        <div class="flex items-center justify-between mt-2">
                            <p class="text-lg font-semibold text-green-500">
                                Rp {{ number_format($product->discounted_price ?? $product->price, 0, ',', '.') }}
                            </p>
                            @if($product->discounted_price && $product->discounted_price < $product->price)
                                <del class="text-sm text-gray-500">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </del>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        
        <!-- Modal Produk -->
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" 
            x-show="showModal" 
            x-transition:enter="transition ease-out duration-300" 
            x-transition:enter-start="opacity-0 scale-90" 
            x-transition:enter-end="opacity-100 scale-100" 
            x-transition:leave="transition ease-in duration-300" 
            x-transition:leave-start="opacity-100 scale-100" 
            x-transition:leave-end="opacity-0 scale-90" 
            style="display: none;" 
            x-data="{ currentIndex: 0 }">

            <div class="relative bg-white rounded-lg shadow-2xl p-8 max-w-3xl w-full font-sans">
                <!-- Close Button -->
                <button class="absolute top-4 right-4 text-gray-500 hover:text-gray-800 text-2xl font-bold focus:outline-none" @click="showModal = false">
                    &times;
                </button>

                <!-- Modal Content -->
                <div class="flex flex-col lg:flex-row">
                    <!-- Image Section -->
                    <div class="lg:w-1/2">
                        <template x-if="selectedProduct.images && selectedProduct.images.length > 0">
                            <div>
                                <!-- Main Image -->
                                <div class="mb-4">
                                    <img :src="'/storage/' + JSON.parse(selectedProduct.images)[currentIndex]" 
                                        alt="Gambar Produk" 
                                        class="h-64 w-full object-cover rounded-lg border border-gray-300 shadow-sm">
                                </div>

                                <!-- Image Preview -->
                                <div class="flex gap-2">
                                    <template x-for="(image, index) in JSON.parse(selectedProduct.images)" :key="index">
                                        <img :src="'/storage/' + image" 
                                            alt="Preview" 
                                            class="h-16 w-16 object-cover rounded-lg border cursor-pointer hover:shadow-md transition-all duration-200 ease-in-out" 
                                            :class="{ 'border-blue-500 shadow-lg': index === currentIndex }" 
                                            @click="currentIndex = index">
                                    </template>
                                </div>
                            </div>
                        </template>
                        <p class="text-gray-500 mt-4 text-sm italic" x-show="!selectedProduct.images || JSON.parse(selectedProduct.images).length === 0">
                            Tidak ada gambar untuk produk ini.
                        </p>
                    </div>
                    
                    <!-- Detail Section -->
                    <div class="lg:ml-6 lg:w-1/2">
                        <h3 class="text-2xl font-extrabold text-gray-800 mb-4" 
                        style="font-family: 'Poppins', sans-serif;" 
                        x-text="selectedProduct.name"></h3>
                        <p class="text-sm text-gray-600 mb-4" 
                        style="font-family: 'Inter', sans-serif;">
                        <strong>Ukuran:</strong> <span x-text="selectedProduct.size || 'Tidak tersedia'"></span>
                    </p>
                        <p class="text-gray-600 mb-4 leading-relaxed text-sm" 
                        style="font-family: 'Inter', sans-serif;" 
                        x-text="selectedProduct.description || 'Tidak ada deskripsi produk.'"></p>
                        <p class="text-lg font-bold text-green-600 mb-4" 
                        style="font-family: 'Poppins', sans-serif;">
                        Harga: Rp <span x-text="new Intl.NumberFormat('id-ID').format(selectedProduct.discounted_price || selectedProduct.price)"></span>
                    </p>
                    
                    

                        <button class="w-full bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600 transition-all duration-300 text-lg font-semibold shadow-md focus:outline-none" 
                            style="font-family: 'Poppins', sans-serif;" 
                            @click="showModal = false; showReceipt = true; receiptData = { name: selectedProduct.name, price: selectedProduct.discounted_price || selectedProduct.price }">
                            Check Out
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <style>
            /* Tambahkan animasi untuk gambar */
            img {
                transition: transform 0.3s ease, border 0.3s ease;
            }

            img:hover {
                transform: scale(1.1);
            }

        </style>

        <!-- Modal Struk -->
        <div 
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" 
            x-show="showReceipt" 
            x-transition:enter="transition ease-out duration-300" 
            x-transition:enter-start="opacity-0 scale-90" 
            x-transition:enter-end="opacity-100 scale-100" 
            x-transition:leave="transition ease-in duration-300" 
            x-transition:leave-start="opacity-100 scale-100" 
            x-transition:leave-end="opacity-0 scale-90" 
            style="display: none;">
            <div class="relative bg-white rounded-lg shadow-2xl p-6 w-full max-w-md text-gray-800">
                <button 
                    class="absolute top-4 right-4 text-gray-600 hover:text-gray-900 text-2xl font-bold focus:outline-none" 
                    @click="showReceipt = false">
                    &times;
                </button>
                
                <!-- Receipt Content -->
                <div id="receipt-content" class="w-full">
                    <!-- Header Struk -->
                    <div class="text-center border-b-2 border-gray-300 pb-4">
                        <h1 class="text-2xl font-bold text-gray-700">Garis Keras Store</h1>
                        <p class="text-sm text-gray-600">Jl. Merpati No. 123, Pemalang</p>
                        <p class="text-sm text-gray-600">Telp: 0812-3456-7890</p>
                    </div>

                    <!-- Informasi Transaksi -->
                    <div class="mt-4">
                        <p class="text-sm"><strong>Nomor Invoice:</strong> <span x-text="Date.now()"></span></p>
                        <p class="text-sm"><strong>Tanggal:</strong> <span x-text="new Date().toLocaleDateString('id-ID')"></span></p>
                    </div>

                    <!-- Daftar Barang -->
                    <table class="w-full mt-4 text-sm">
                        <thead>
                            <tr class="text-left border-b-2 border-gray-300">
                                <th class="py-2">Nama Barang</th>
                                <th class="py-2 text-center">Jumlah</th>
                                <th class="py-2 text-right">Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="py-2" x-text="selectedProduct.name"></td>
                                <td class="py-2 text-center">1</td>
                                <td class="py-2 text-right" x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(selectedProduct.discounted_price || selectedProduct.price)"></td>
                            </tr>
                            <tr>
                                <td class="py-2" colspan="2" class="text-left font-semibold">Ukuran</td>
                                <td class="py-2 text-right" x-text="selectedProduct.size || 'Tidak tersedia'"></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2" class="text-right font-semibold pt-4">Total</td>
                                <td class="text-right font-semibold pt-4" x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(selectedProduct.discounted_price || selectedProduct.price)"></td>
                            </tr>
                        </tfoot>
                    </table>

                    <!-- Pesan Terima Kasih -->
                    <div class="mt-6 text-center border-t-2 border-gray-300 pt-4 text-gray-600">
                        <p class="text-sm">Terima kasih telah berbelanja di</p>
                        <p class="text-lg font-semibold text-gray-800">Garis Keras Store</p>
                        <p class="text-sm">Semoga harimu menyenangkan!</p>
                    </div>

                    <!-- Tombol Cetak -->
                    <div class="mt-6 text-center">
                        <button 
                            class="px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg hover:from-blue-600 hover:to-blue-700 transition duration-300"
                            onclick="printReceipt()">
                            Cetak Struk
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function printReceipt() {
            const receiptContent = document.getElementById('receipt-content').innerHTML;
            const printWindow = window.open('', '_blank');
            printWindow.document.open();
            printWindow.document.write(`
                <html>
                    <head>
                        <title>Struk Pembelian</title>
                    </head>
                    <body onload="window.print(); window.close();">
                        ${receiptContent}
                    </body>
                </html>
            `);
            printWindow.document.close();
        }
    </script>
    @include('frontend.section.faq')

    <!-- Testimonial Section -->
    <section id="testimonials" class="mb-16">

        @include('frontend.section.testimoni')

        <div class="container mx-auto px-4 py-2">
            <div class="text-center">
                <a href="{{ route('testimonials.index') }}" class="inline-block mt-6 px-8 py-3 bg-yellow-500 text-black font-semibold rounded-lg shadow hover:bg-yellow-600 transition duration-300 text-center">
                    Lihat Semua Testimoni
                </a>

                </a>
            </div>
        </div>
    </section>

    @if(session('toast'))
    <script>
        // Wait for the page to be fully loaded, then show the toast
        window.onload = function() {
            HotToast.success('{{ session('
                toast ') }}');
        }

    </script>
    @endif

    <form action="{{ route('testimonials.store') }}" method="POST" class="max-w-lg mx-auto">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-white font-medium mb-2">Nama Anda</label>
            <input type="text" id="name" name="name" class="w-full px-4 py-2 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-white bg-gray-800" required>
        </div>
        <div class="mb-4">
            <label for="comment" class="block text-white font-medium mb-2">Komentar</label>
            <textarea id="comment" name="comment" rows="4" class="w-full px-4 py-2 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-white bg-gray-800" required></textarea>
        </div>
        <div class="mb-4">
            <label for="rating" class="block text-white font-medium mb-2">Rating</label>
            <select id="rating" name="rating" class="w-full px-4 py-2 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-white bg-gray-800" required>
                <option value="" disabled selected>Pilih Rating</option>
                @for ($i = 1; $i <= 5; $i++) <option value="{{ $i }}">{{ $i }} Bintang</option>
                    @endfor
            </select>
        </div>
        <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-500 transition duration-300">
            Kirim Testimoni
        </button>
    </form>
    </section>


    @include('frontend.component.footer')
</body>
</html>