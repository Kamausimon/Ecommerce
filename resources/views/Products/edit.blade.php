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
                <h1 class="text-3xl font-bold text-gray-900">Edit Product</h1>
            </div>
        </header>

        <!-- Content -->
        <main class="flex-1">
            <div class="container mx-auto py-6 px-4">
                <form action="{{ route('Products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-md">
                    @csrf
                    @method('PUT')
                    <!-- Product Name -->
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700">Product Name:</label>
                        <input type="text" name="name" id="name" value="{{ $product->name }}" class="w-full px-3 py-2 border rounded">
                    </div>
                    <!-- Category -->
                    <div class="mb-4">
                        <label for="category" class="block text-gray-700">Category:</label>
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
                    </div>
                    <!-- Description -->
                    <div class="mb-4">
                        <label for="description" class="block text-gray-700">Description:</label>
                        <textarea name="description" id="description" class="w-full px-3 py-2 border rounded">{{ $product->description }}</textarea>
                    </div>
                    <!-- Price -->
                    <div class="mb-4">
                        <label for="price" class="block text-gray-700">Price:</label>
                        <input type="text" name="price" id="price" value="{{ $product->price }}" class="w-full px-3 py-2 border rounded">
                    </div>
                    <!-- Stock -->
                    <div class="mb-4">
                        <label for="stock" class="block text-gray-700">Stock:</label>
                        <input type="text" name="stock" id="stock" value="{{ $product->stock }}" class="w-full px-3 py-2 border rounded">
                    </div>
                    <!-- Image -->
                    <div class="mb-4">
                        <label for="image" class="block text-gray-700">Product Image:</label>
                        <input type="file" name="image" id="image" class="w-full px-3 py-2 border rounded">
                        @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-20 h-20 mt-2">
                        @endif
                    </div>
                    <!-- Buttons -->
                    <div class="flex justify-between">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
                        <a href="{{ route('Admin.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Discard</a>
                    </div>
                </form>
            </div>
        </main>

        <!-- Footer -->
        @include('partials._footer')
    </div>

    <!-- JavaScript for Sidebar Toggle (if not already included) -->
    <script>
        // Sidebar Toggle
        const menuButton = document.getElementById('menu-button');
        const sidebar = document.getElementById('sidebar');

        menuButton.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });
    </script>
</body>

</html>
