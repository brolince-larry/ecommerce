<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to Ecommerce</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js -->
    <script src="//unpkg.com/alpinejs" defer></script>

    <style>
        .fade-out {
            animation: fadeOut 1s ease-in-out forwards;
        }

        @keyframes fadeOut {
            to {
                opacity: 0;
                visibility: hidden;
            }
        }

        .slide {
            transition: opacity 0.5s ease-in-out;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-900">

<!-- Preloader -->
<div id="preloader"
     class="fixed inset-0 bg-white z-50 flex items-center justify-center transition-opacity duration-700">
    <div class="animate-spin rounded-full h-16 w-16 border-4 border-indigo-600 border-t-transparent"></div>
</div>

<!-- Main App -->
<div x-data x-init="window.onload = () => {
    document.getElementById('preloader').classList.add('fade-out');
}">
    <div class="min-h-screen flex flex-col items-center justify-center px-4">
        <h1 class="text-4xl font-bold mb-6 text-indigo-700">Welcome to Our Ecommerce Platform</h1>

        <!-- Slideshow -->
        <div
            x-data="{
                slides: [
                    { image: '{{ asset('storage/products/hp.jpg') }}', caption: 'Shop the latest gadgets' },
                    { image: '{{ asset('storage/products/tecno.jpg') }}', caption: 'Fresh fashion for everyone' },
                    { image: '{{ asset('storage/products/coach.jpg') }}', caption: 'Home essentials made easy' }
                ],
                currentIndex: 0,
                init() {
                    setInterval(() => this.next(), 4000);
                },
                prev() {
                    this.currentIndex = (this.currentIndex - 1 + this.slides.length) % this.slides.length;
                },
                next() {
                    this.currentIndex = (this.currentIndex + 1) % this.slides.length;
                }
            }"
            class="relative w-full max-w-5xl h-[600px] rounded overflow-hidden shadow-xl mb-10"
        >
            <template x-for="(slide, index) in slides" :key="index">
                <div x-show="currentIndex === index" class="absolute inset-0 slide" x-transition>
                    <img :src="slide.image" class="w-full h-auto object-cover" alt="">
                    <div class="absolute bottom-0 bg-black bg-opacity-60 text-white text-lg p-4 w-full text-center"
                         x-text="slide.caption"></div>
                </div>
            </template>

            <button @click="prev"
                class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-60 text-gray-800 px-3 py-1 hover:bg-opacity-80">
                ‹
            </button>
            <button @click="next"
                class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-60 text-gray-800 px-3 py-1 hover:bg-opacity-80">
                ›
            </button>
        </div>

        <!-- Auth Buttons -->
        <div class="space-x-4">
            <a href="{{ route('login') }}"
               class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded shadow">Login</a>
            <a href="{{ route('register') }}"
               class="bg-gray-200 hover:bg-gray-300 text-indigo-700 px-6 py-2 rounded shadow">Register</a>
        </div>
    </div>
</div>

</body>
</html>
