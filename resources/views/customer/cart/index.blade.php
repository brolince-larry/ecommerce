<x-app-layout>
    <x-slot name="header">
        <script src="http://cdn.tailwindcss.com"></script>
        <h2 class="font-semibold text-xl text-white leading-tight">Your Cart</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow rounded">
                @if(session('success'))
                    <div class="mb-4 text-green-600">{{ session('success') }}</div>
                @endif
                @forelse($carts as $item)
                    <div class="flex justify-between border-b py-2">
                        <div>
                            <h4 class="font-bold">{{ $item->product->name }}</h4>
                            <p class="text-sm">{{ $item->product->description }}</p>
                        </div>
                        <div>
                            <span class="text-indigo-600 font-bold">Qty: {{ $item->quantity }}</span>
                            <form method="POST" action="{{ route('customer.cart.remove', $item->id) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button class="ml-2 text-red-600">Remove</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-600">Your cart is empty.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
