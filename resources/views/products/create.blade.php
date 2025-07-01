<x-app-layout>
    <script src="http://cdn.tailwindcss.com"></script>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-white">Create Product</h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto">
        <div class="bg-white p-6 rounded shadow">
            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                    <ul class="list-disc pl-5 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Product Name --}}
                <div class="mb-4">
                    <label class="block font-medium text-gray-700">Product Name</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="w-full border border-gray-300 rounded px-4 py-2">
                </div>

                {{-- Description --}}
                <div class="mb-4">
                    <label class="block font-medium text-gray-700">Description</label>
                    <textarea name="description" rows="3"
                        class="w-full border border-gray-300 rounded px-4 py-2">{{ old('description') }}</textarea>
                </div>

                {{-- Price --}}
                <div class="mb-4">
                    <label class="block font-medium text-gray-700">Price (KSh)</label>
                    <input type="number" step="0.01" name="price" value="{{ old('price') }}"
                        class="w-full border border-gray-300 rounded px-4 py-2">
                </div>

                {{-- Category --}}
                <div class="mb-4">
                    <label class="block font-medium text-gray-700">Category</label>
                    <select name="category_id" class="w-full border border-gray-300 rounded px-4 py-2">
                        <option value="">-- Select Category --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $selectedCategory ?? '') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Image --}}
                <div class="mb-4">
                    <label class="block font-medium text-gray-700">Product Image</label>
                    <input type="file" name="image"
                        class="w-full border border-gray-300 rounded px-4 py-2 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                </div>

                {{-- Submit --}}
                <div class="mt-6">
                    <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded shadow">
                        Save Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
