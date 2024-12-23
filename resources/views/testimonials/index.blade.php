<!-- resources/views/testimonials/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semua Testimoni</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-b from-blue-50 to-blue-100 text-gray-800 font-sans">

    <div class="container mx-auto px-4 py-12">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Semua Testimoni</h2>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
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
        </div>

        <div class="text-center mt-8">
            <a href="{{ url('/') }}" class="text-blue-600 hover:underline">Kembali ke Beranda</a>
        </div>
    </div>

</body>
</html>
