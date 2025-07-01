<x-app-layout>
    <script src="http://cdn.tailwindcss.com"></script>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-white">Create Category</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded p-6">
                <form method="POST" action="{{ route('categories.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-medium">Category Name</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                               class="w-full border border-gray-300 rounded px-4 py-2">
                        @error('name')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium">Description</label>
                        <textarea name="description" rows="4"
                                  class="w-full border border-gray-300 rounded px-4 py-2">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                            class="bg-green-600 hover:bg-green-700 text-blue-600 px-4 py-2 rounded">
                        Save Category
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
