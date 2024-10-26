<!DOCTYPE html>
<html>
@include('partials._head')

<body class="flex bg-gray-100">
    <!-- Sidebar -->
    @include('partials._adminSidebar')

    <!-- Main Content -->
    <div class="flex-1 flex flex-col min-h-screen">
        <!-- Header (Optional) -->
        <header class="bg-white shadow">
            <div class="container mx-auto py-6 px-4">
                <h1 class="text-3xl font-bold text-gray-900">Create Product</h1>
            </div>
        </header>

        <!-- Content -->
        <main class="flex-1">
            <div class="container mx-auto py-6 px-4">
                <!-- Form -->
                <div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-md">
                    <form action="{{ route('Products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <!-- Name Field -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Name:</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            @error('name')
                            <span class="text-red-500 text-xs italic">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Description Field -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Description:</label>
                            <textarea id="description" name="description" required class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">{{ old('description') }}</textarea>
                            <span id="descriptionCount" class="text-sm text-gray-600">0/500</span>
                            @error('description')
                            <span class="text-red-500 text-xs italic">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Price Field -->
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700">Price:</label>
                            <input type="number" id="price" name="price" value="{{ old('price') }}" required class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            @error('price')
                            <span class="text-red-500 text-xs italic">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Stock Field -->
                        <div>
                            <label for="stock" class="block text-sm font-medium text-gray-700">Stock:</label>
                            <input type="number" id="stock" name="stock" value="{{ old('stock') }}" required class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            @error('stock')
                            <span class="text-red-500 text-xs italic">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Category Field -->
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

                        <!-- Image Field -->
                        <div>
                            <label for="image" class="block text-sm font-medium text-gray-700">Image:</label>
                            <input type="file" id="image" name="image" required class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            @error('image')
                            <span class="text-red-500 text-xs italic">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Submit
                        </button>
                    </form>
                </div>
            </div>
        </main>

        <!-- Footer -->
        @include('partials._footer')
    </div>

    <!-- JavaScript for Toggling Sidebar and Description Counter -->
    <script>
        // Sidebar Toggle
        const menuButton = document.getElementById('menu-button');
        const sidebar = document.getElementById('sidebar');

        menuButton.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });

        // Description Counter
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
</body>

</html>
