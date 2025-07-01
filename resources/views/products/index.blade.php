<x-app-layout>
    <script src="http://cdn.tailwindcss.com"></script>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">Browse Products</h2>
    </x-slot>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach($products as $product)
                    <div class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition duration-300">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-auto object-cover  object-center">
                        @else
                            <div class="w-full h-60 bg-gray-200 flex items-center justify-center text-gray-500">No Image</div>
                        @endif
                        <div class="p-4">
                            <h3 class="text-lg font-bold mb-1 text-gray-800">{{ $product->name }}</h3>
                            <p class="text-sm text-gray-600 mb-2">KSh {{ number_format($product->price, 2) }}</p>
                            <a href="{{ route('customer.products.show', $product->id) }}" class="inline-block mt-2 text-sm text-indigo-600 hover:text-indigo-800 font-medium">View Details</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-6">{{ $products->links() }}</div>
        </div>
    </div>
</x-app-layout>
