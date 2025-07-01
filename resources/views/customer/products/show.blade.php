<x-app-layout>
    <script src="http://cdn.tailwindcss.com"></script>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">Product Details</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded p-6">
                <h3 class="text-2xl font-bold mb-2">{{ $product->name }}</h3>
                <p class="text-gray-600 mb-4">{{ $product->description }}</p>
                <p class="text-xl text-indigo-700 font-semibold">KSh {{ number_format($product->price, 2) }}</p>
                <form method="POST" action="{{ route('customer.cart.add') }}" class="mt-4">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <label for="quantity" class="block font-medium">Quantity</label>
                    <input type="number" name="quantity" value="1" min="1" class="border px-2 py-1 rounded w-20">
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded ml-2">Add to Cart</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
