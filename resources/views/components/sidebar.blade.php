@php
    $role = Auth::user()->role;
@endphp

<div x-data="{ sidebarOpen: false }" class="flex min-h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside :class="sidebarOpen ? 'block' : 'hidden md:block'" class="w-64 bg-slate-500 border-r border-fuchsia-200 shadow-md min-h-screen">
        <div class="p-6 text-white text-xl font-bold border-b relative">
            @if($role === 0)
                Admin Panel
            @elseif($role === 1)
                Seller Panel
            @else
                Customer Panel
            @endif

            <!-- Mobile close button -->
             <button @click="sidebarOpen = true"
        class="md:hidden fixed top-4 left-4 z-50 px-3 py-2 bg-indigo-700 text-white rounded shadow">
        ☰ Menu
    </button>
        </div>

        <nav class="px-4 mt-4 space-y-2 text-white">
            @if($role === 0)
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded hover:bg-indigo-600">Dashboard</a>
                <a href="{{ route('categories.index') }}" class="block px-4 py-2 rounded hover:bg-indigo-600">Categories</a>
                <a href="{{ route('products.index') }}" class="block px-4 py-2 rounded hover:bg-indigo-600">All Products</a>

            @elseif($role === 1)
                <a href="{{ route('products.index') }}" class="block px-4 py-2 rounded hover:bg-indigo-600">Products</a>
                <a href="{{ route('categories.index') }}" class="block px-4 py-2 rounded hover:bg-indigo-600">Categories</a>

            @else
                <a href="{{ route('products.index') }}" class="block px-4 py-2 rounded hover:bg-indigo-600">Browse Products</a>
                <a href="{{ route('customer.cart.index') }}" class="block px-4 py-2 rounded hover:bg-indigo-600">View Cart</a>
                <a href="{{ route('customer.orders.index') }}" class="block px-4 py-2 rounded hover:bg-indigo-600">Order History</a>
            @endif
        </nav>

        <!-- Account Settings Dropdown -->
        <div x-data="{ open: false }" class="relative mt-4 px-4 text-white">
            <button @click="open = !open" class="w-full text-left px-4 py-2 rounded hover:bg-indigo-700 font-medium">
                Account Settings ▾
            </button>
            <div x-show="open" class="mt-1 ml-2 space-y-1 bg-white text-black rounded shadow-md p-2">
                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm hover:bg-gray-100">Profile Settings</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:text-red-800">Logout</button>
                </form>
            </div>
        </div>
    </aside>
   
</div>
