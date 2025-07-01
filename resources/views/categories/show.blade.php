<x-app-layout>
    {{-- No need to include Tailwind again if already loaded in app layout --}}
    <script src="http://cdn.tailwindcss.com"></script> 

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-white">
                Products in "{{ $category->name }}"
            </h2>

            @if(auth()->user()->role === 0 || auth()->user()->role === 1)
                <a href="{{ route('products.create', ['category_id' => $category->id]) }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
                    + Add Product
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-6 max-w-6xl mx-auto">
        <div class="bg-white p-6 rounded shadow">
            @if($category->products->isEmpty())
                <p class="text-gray-500">No products found in this category.</p>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    @foreach($category->products as $product)
                        <div class="border rounded p-4">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}"
                                     class="h-60 w-full object-center px-4 py-2 rounded mb-2">
                            @endif

                            <h3 class="font-semibold text-lg">{{ $product->name }}</h3>
                            <p class="text-gray-600 text-sm">{{ $product->description }}</p>
                            <p class="text-blue-700 font-bold mt-2">KSh {{ number_format($product->price, 2) }}</p>
                        </div>
                    @endforeach
                </div>
            @endif
            
        </div>
        
    </div>
</x-app-layout>
