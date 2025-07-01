<x-app-layout>
    <script src="http://cdn.tailwindcss.com"></script>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-white">All Categories</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded p-6">

                @if(session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-800 border border-green-300 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @php $userRole = auth()->user()->role; @endphp

                @if($userRole === 0 || $userRole === 1)
                    <div class="mb-4 text-right">
                        <a href="{{ route('categories.create') }}"
                           class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded shadow">
                            + New Category
                        </a>
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="min-w-full border text-sm divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="p-2 text-left">#</th>
                                <th class="p-2 text-left">Name</th>
                                <th class="p-2 text-left">Description</th>
                                 <th class="p-2 text-left">products</th>
                                <th class="p-2 text-left">Created</th>
                                <th class="p-2 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($categories as $category)
                                <tr class="hover:bg-gray-50">
                                    <td class="p-2">{{ $category->id }}</td>
                                    <td class="p-2">{{ $category->name }}</td>
                                    <td class="p-2">{{ $category->description }}</td>
                                    <td class="p-2">
    <a href="{{ route('categories.show', $category) }}" class="text-indigo-600 hover:underline">
        View Products
    </a>
</td>
                                    <td class="p-2">{{ $category->created_at->format('d M Y') }}</td>
                                    <td class="p-2 space-x-2">
                                        <a href="{{ route('categories.edit', $category) }}"
                                           class="text-blue-600 hover:underline">Edit</a>

                                        <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    onclick="return confirm('Are you sure you want to delete this category?')"
                                                    class="text-red-600 hover:underline">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-4 text-center text-gray-500">No categories found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
