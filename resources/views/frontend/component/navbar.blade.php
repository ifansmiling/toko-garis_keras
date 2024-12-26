<header class="sticky top-0 z-50 bg-black ">
    <div class="container mx-auto px-4 py-2 flex justify-between items-center">
        <div class="logo">
            <img src="{{ asset('img/kkk.jpg') }}" alt="LBS Logo" class="h-[80px]">
        </div>
        <button class="text-white md:hidden z-50" onclick="toggleMenu()">
            <i class="fas fa-bars"></i>
        </button>
        <nav id="menu" class="hidden absolute top-full right-0 left-0 md:relative md:flex md:space-x-6 md:ml-auto text-white bg-black md:bg-transparent rounded-md md:rounded-none shadow-md md:shadow-none">
            <ul class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-6 p-4 md:p-0">
                <li>
                    <a href="#" class="hover:text-yellow-500 flex items-center">
                        <i class="fas fa-info-circle mr-2"></i>About Us </a>
                </li>
                <li>
                    <a href="#products" class="hover:text-yellow-500 flex items-center">
                        <i class="fas fa-box-open mr-2"></i>Product </a>
                </li>
                <li>
                    <a href="#faq" class="hover:text-yellow-500 flex items-center">
                        <i class="fas fa-question-circle mr-2"></i>FAQ </a>
                </li>
                <li>
                    <a href="#testimonial" class="hover:text-yellow-500 flex items-center">
                        <i class="fas fa-comment-dots mr-2"></i>Testimonial </a>
                </li>
                <li>
                    <a href="#contact" class="hover:text-yellow-500 flex items-center">
                        <i class="fas fa-envelope mr-2"></i>Contact Us </a>
                </li>
            </ul>
        </nav>
    </div>
</header>

