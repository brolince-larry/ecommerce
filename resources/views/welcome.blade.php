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
    </style>
</head>
<body class="bg-gray-50 text-gray-900 font-sans">

<!-- Preloader -->
<div id="preloader" class="fixed inset-0 bg-white z-50 flex items-center justify-center">
    <div class="animate-spin rounded-full h-16 w-16 border-4 border-indigo-600 border-t-transparent"></div>
</div>

<!-- Main Content -->
<div x-data x-init="window.onload = () => document.getElementById('preloader').classList.add('fade-out')">
    <div class="min-h-screen flex flex-col items-center justify-center text-center px-4">
        <!-- Title -->
        <h1 class="text-5xl font-extrabold text-indigo-700 mb-4">Welcome to ShopSmart</h1>
        <p class="text-lg text-gray-600 mb-8 max-w-xl">Your one-stop online shop for electronics, fashion, home essentials, and more.</p>

        <!-- Slideshow -->
        <div
            x-data="{
                slides: [
                    { image: '{{ asset('storage/products/hp.jpg') }}', caption: 'Latest Gadgets & Tech' },
                    { image: '{{ asset('storage/products/tecno.jpg') }}', caption: 'Trendy Fashion Deals' },
                    { image: '{{ asset('storage/products/coach.jpg') }}', caption: 'Home Essentials Made Easy' }
                ],
                currentIndex: 0,
                init() {
                    setInterval(() => this.currentIndex = (this.currentIndex + 1) % this.slides.length, 5000);
                }
            }"
            class="relative w-full max-w-4xl h-96 mb-10 overflow-hidden rounded-lg shadow-lg"
        >
            <template x-for="(slide, index) in slides" :key="index">
                <div x-show="currentIndex === index" class="absolute inset-0 transition-opacity duration-700">
                    <img :src="slide.image" class="w-full h-full object-cover" alt="">
                    <div class="absolute bottom-0 bg-black bg-opacity-60 text-white text-lg p-4 w-full"
                         x-text="slide.caption"></div>
                </div>
            </template>
        </div>

        <!-- Auth Buttons -->
        <div class="flex space-x-6">
            <a href="{{ route('login') }}"
               class="bg-indigo-600 hover:bg-indigo-700 text-white text-lg font-medium px-6 py-3 rounded-lg shadow transition">Login</a>
            <a href="{{ route('register') }}"
               class="bg-white border border-indigo-600 text-indigo-700 hover:bg-indigo-50 text-lg font-medium px-6 py-3 rounded-lg shadow transition">Register</a>
        </div>
    </div>
</div>

</body>
</html>
