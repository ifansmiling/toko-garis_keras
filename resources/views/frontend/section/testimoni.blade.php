<section id="testimonial" class="bg-neutral-950 py-16">

    <div class="max-w-7xl mx-auto px-6 lg:px-8 flex flex-col lg:flex-row items-center lg:items-start gap-12">
        <!-- Section Header -->
        <div class="lg:w-1/2">
            <h2 class="text-3xl lg:text-4xl font-bold text-white">
                We believe our products speak for themselves 

            </h2>
            <p class="mt-4 text-lg text-gray-300">
                But don’t just take our word for it.
                <br>
                Check out our customer testimonials!
            </p>

        </div>

        <!-- Testimonial Slider -->
        <div class="lg:w-1/2 w-full">
            <div class="swiper">
                <div class="swiper-wrapper flex lg:flex-row flex-col gap-6">
                    <!-- Testimonial Item -->
                    @foreach ($testimonials as $testimonial)
                    <div class="swiper-slide bg-gray-800 p-6 shadow-md rounded-lg border border-gray-700 w-full sm:w-auto">
                        <div class="flex items-center gap-2 mb-4">
                            <!-- Stars -->
                            @for ($i = 1; $i <= 5; $i++) <span class="{{ $i <= $testimonial->rating ? 'text-yellow-400' : 'text-gray-600' }}">
                                &#9733;
                                </span>
                                @endfor
                        </div>
                        <h3 class="mt-2 text-xl font-semibold text-white">
                            {{ $testimonial->comment }}
                        </h3>
                        <p class="mt-4 text-sm font-medium text-gray-500">
                            — {{ $testimonial->name }}
                        </p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

