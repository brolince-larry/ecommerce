<x-app-layout>
    <script src="http://cdn.tailwindcss.com"></script>
    <script src="unpkg.com/aplinejs" defer></script>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-white leading-tight">
            {{ __('Customer Dashboard') }}
        </h2>
    </x-slot>

    <div class="flex min-h-screen bg-gray-100">
     

        <!-- Main Content -->
        <main class="flex-1 py-10 px-6">
            <div class="max-w-6xl mx-auto space-y-6">
                <div class="bg-white shadow rounded-lg p-6 text-gray-800">
                    <h3 class="text-2xl font-semibold mb-2">Welcome, {{ Auth::user()->name }}!</h3>
                    <p class="mb-4">You're logged in as a <strong>Customer</strong>.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <a href="{{ route('products.index') }}" class="bg-blue-100 hover:bg-blue-200 transition rounded p-4 shadow">
                            <h4 class="text-lg font-bold text-blue-700">Browse Products</h4>
                            <p class="text-sm text-gray-700">Explore available items and add to your cart.</p>
                        </a>

                        <a href="{{ route('customer.cart.index') }}" class="bg-green-100 hover:bg-green-200 transition rounded p-4 shadow">
                            <h4 class="text-lg font-bold text-green-700">View Cart</h4>
                            <p class="text-sm text-gray-700">Review items in your shopping cart.</p>
                        </a>

                        <a href="{{ route('customer.orders.index') }}" class="bg-yellow-100 hover:bg-yellow-200 transition rounded p-4 shadow">
                            <h4 class="text-lg font-bold text-yellow-700">Order History</h4>
                            <p class="text-sm text-gray-700">Check the status and history of your orders.</p>
                        </a>
                    </div>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>
