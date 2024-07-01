<!DOCTYPE html>
<html>
@include('partials._head');

<body class="bg-gray-100">


    <div class="max-w-md mx-auto my-10 bg-white p-8 rounded-lg shadow-md">
        <form action="{{ route('Products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name:</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                @error('name')
                <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description:</label>
                <textarea id="description" name="description" required class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">{{ old('description') }}</textarea>
                <span id="descriptionCount" class="text-sm text-gray-600">0/500</span>
                @error('description')
                <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="price" class="block text-sm font-medium text-gray-700">Price:</label>
                <input type="number" id="price" name="price" value="{{ old('price') }}" required class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                @error('price')
                <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="category" class="block text-sm font-medium text-gray-700">Category:</label>
                <select id="category" name="category_id" required class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">Select a Category</option>
                    @foreach ($categories as $category)
                    <optgroup label="{{ $category->name }}">
                        @if($category->subcategories->count() > 0)
                        @foreach ($category->subcategories as $subcategory)
                        <option value="{{ $subcategory->id }}" {{ old('category_id') == $subcategory->id ? 'selected' : '' }}>{{ $subcategory->name }}</option>
                        @endforeach
                        @else
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endif
                    </optgroup>
                    @endforeach
                </select>
                @error('category_id')
                <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Image:</label>
                <input type="file" id="image" name="image" required class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                @error('image')
                <span class="text-red-500 text-xs italic">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Submit
            </button>
        </form>
    </div>

    <script>
        const descriptionTextarea = document.getElementById('description');
        const descriptionCountSpan = document.getElementById('descriptionCount');

        descriptionTextarea.addEventListener('input', function() {
            const currentLength = this.value.length;
            descriptionCountSpan.textContent = `${currentLength}/500`;

            // Optional: Add logic to enforce a maximum length
            if (currentLength > 500) {
                this.value = this.value.substring(0, 500);
                descriptionCountSpan.textContent = '500/500';
            }
        });

        // Initialize the counter based on the current content
        descriptionCountSpan.textContent = `${descriptionTextarea.value.length}/500`;
    </script>

    @include('partials._footer')
</body>

</html>