<x-app-layout>
    <script src="http://cdn.tailwindcss.com"></script>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-white leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="flex min-h-screen bg-gray-200">
       

        <!-- Main Content -->
        <main class="flex-1 py-10 px-6">
            <div class="max-w-6xl mx-auto space-y-6">
                <div class="bg-white shadow rounded-lg p-6 text-gray-800">
                    <h3 class="text-2xl font-semibold mb-2">Welcome, {{ Auth::user()->name }}!</h3>
                    <p class="mb-4">You're logged in as <strong>Admin</strong>.</p>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <a href="{{ route('categories.index') }}" class="bg-indigo-100 hover:bg-indigo-200 transition rounded p-4 shadow">
                            <h4 class="text-lg font-bold text-indigo-700">Manage Categories</h4>
                            <p class="text-sm text-gray-700">View, create, edit, or delete categories.</p>
                        </a>
                        <a href="{{ route('dashboard') }}" class="bg-green-100 hover:bg-green-200 transition rounded p-4 shadow">
                            <h4 class="text-lg font-bold text-green-700">Manage Users</h4>
                            <p class="text-sm text-gray-700">Admin, Seller, Customer accounts.</p>
                        </a>
                        <a href="#" class="bg-yellow-100 hover:bg-yellow-200 transition rounded p-4 shadow">
                            <h4 class="text-lg font-bold text-yellow-700">Other Management</h4>
                            <p class="text-sm text-gray-700">Placeholder for future sections.</p>
                        </a>
                    </div>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>
