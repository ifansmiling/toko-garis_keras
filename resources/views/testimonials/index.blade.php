<!-- resources/views/testimonials/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semua Testimoni</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-black text-gray-200 font-sans">

    <div class="container mx-auto px-4 py-12">
        <h2 class="text-4xl font-bold text-center text-white mb-8">Semua Testimoni</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            @foreach ($testimonials as $testimonial)
            <div class="bg-gray-800 shadow-lg rounded-lg p-6 text-center hover:shadow-2xl transform hover:-translate-y-2 transition duration-300">
                <h3 class="text-xl font-semibold text-white">{{ $testimonial->name }}</h3>
                <p class="text-sm text-gray-400 mt-2 italic">"{{ $testimonial->comment }}"</p>
                <div class="mt-4 flex justify-center">
                    @for ($i = 1; $i <= 5; $i++) @if ($i <=$testimonial->rating)
                        <span class="text-yellow-400 text-lg">&#9733;</span>
                        @else
                        <span class="text-gray-500 text-lg">&#9733;</span>
                        @endif
                        @endfor
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-8">
            <a href="{{ url('/') }}" class="inline-block mt-6 px-8 py-3 bg-yellow-500 text-black font-semibold rounded-lg shadow hover:bg-yellow-600 transition duration-300 text-center">Kembali ke Beranda</a>

        </div>
    </div>

</body>
</html>

