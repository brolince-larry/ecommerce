<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-white">Edit Category</h2>
    </x-slot>
<script src="http://cdn.tailwindcss.com"></script>
    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded p-6">
                <form method="POST" action="{{ route('categories.update', $category->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block font-medium">Category Name</label>
                        <input type="text" name="name" value="{{ old('name', $category->name) }}"
                               class="w-full border border-gray-300 rounded px-4 py-2">
                        @error('name')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium">Description</label>
                        <textarea name="description" rows="4"
                                  class="w-full border border-gray-300 rounded px-4 py-2">{{ old('description', $category->description) }}</textarea>
                        @error('description')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                        Update Category
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
